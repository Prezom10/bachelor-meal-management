@extends('layouts.admin')

@section('admin-content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Notice Management</h2>

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.notices.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Create New Notice
        </a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        @if ($notices->isEmpty())
            <p class="text-gray-600">No notices created yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Title</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Content</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Created By</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notices as $notice)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $notice->title }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ Str::limit($notice->content, 50) }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $notice->user->name }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">
                                    <a href="{{ route('admin.notices.edit', $notice) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                    <form action="{{ route('admin.notices.destroy', $notice) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this notice?');">
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