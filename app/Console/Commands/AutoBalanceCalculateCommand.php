<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Meal;
use App\Models\Market;
use App\Models\Statement;
use Illuminate\Support\Facades\Mail;
use App\Mail\MonthlyStatementMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AutoBalanceCalculateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meal:calculate-balance {--month= : The month to calculate balance for (YYYY-MM)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates monthly meal and market balances for all users.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $targetMonth = $this->option('month') ? Carbon::parse($this->option('month')) : Carbon::now();
        $monthString = $targetMonth->format('Y-m');

        $users = User::where('is_approved', true)->get();

        foreach ($users as $user) {
            $totalMeals = $user->meals()
                               ->whereYear('date', $targetMonth->year)
                               ->whereMonth('date', $targetMonth->month)
                               ->where('is_approved', true)
                               ->sum(DB::raw('lunch + dinner'));

            $totalMarket = $user->markets()
                                ->whereYear('date', $targetMonth->year)
                                ->whereMonth('date', $targetMonth->month)
                                ->where('is_approved', true)
                                ->sum('amount');

            // Assuming a fixed meal cost for simplicity, or you can fetch it from settings
            $mealCostPerMeal = 30; // Example: 30 units per meal
            $totalMealCost = $totalMeals * $mealCostPerMeal;

            $balance = $totalMarket - $totalMealCost;

            $statement = Statement::updateOrCreate(
                ['user_id' => $user->id, 'month' => $monthString],
                [
                    'total_meals' => $totalMeals,
                    'total_market' => $totalMarket,
                    'balance' => $balance,
                ]
            );

            // Send monthly statement email
            Mail::to($user->email)->send(new MonthlyStatementMail($statement));
        }

        $this->info('Monthly balances calculated and statements sent for ' . $monthString);
    }
}