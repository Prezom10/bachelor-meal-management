<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\User;
use App\Http\Requests\NoticeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NoticeMail;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::all();
        return view('admin.notice_manage', compact('notices'));
    }

    public function create()
    {
        return view('admin.notice_create');
    }

    public function store(NoticeRequest $request)
    {
        $notice = Notice::create([
            'user_id' => null,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // Send notice email to all approved users
        $approvedUsers = User::where('is_approved', true)->get();
        foreach ($approvedUsers as $user) {
            Mail::to($user->email)->send(new NoticeMail($notice));
        }

        return redirect()->route('admin.notices.index')->with('success', 'Notice created and sent successfully.');
    }

    public function edit(Notice $notice)
    {
        return view('admin.notice_edit', compact('notice'));
    }

    public function update(NoticeRequest $request, Notice $notice)
    {
        $notice->update($request->validated());
        return redirect()->route('admin.notices.index')->with('success', 'Notice updated successfully.');
    }

    public function destroy(Notice $notice)
    {
        $notice->delete();
        return redirect()->route('admin.notices.index')->with('success', 'Notice deleted successfully.');
    }
}