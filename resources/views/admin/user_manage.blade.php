@extends('layouts.admin')

@section('admin-content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">User Management</h2>

    <div class="bg-white p-6 rounded-lg shadow-md">
        @if ($users->isEmpty())
            <p class="text-gray-600">No users registered yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Approved</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $user->name }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $user->email }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ ucfirst($user->role) }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">
                                    @if ($user->is_approved)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Yes</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">No</span>
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">
                                    @if (!$user->is_approved)
                                        <form action="{{ route('admin.users.approve', $user) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900 mr-2">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.users.reject', $user) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="text-yellow-600 hover:text-yellow-900 mr-2">Reject</button>
                                        </form>
                                    @endif
                                    <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection