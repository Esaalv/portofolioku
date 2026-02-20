@extends('layouts.admin')
@section('title', 'Messages')
@section('page-title', 'Messages')

@section('content')
<div class="flex items-center justify-between mb-5">
    <p class="text-sm text-gray-500">{{ $messages->total() }} total messages · <span class="text-red-500 font-medium">{{ $unreadCount }} unread</span></p>
</div>
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">From</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Subject</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Received</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($messages as $msg)
            <tr class="hover:bg-gray-50 {{ !$msg->is_read ? 'bg-blue-50/50' : '' }}">
                <td class="px-6 py-4">
                    <p class="font-medium text-sm text-gray-800 {{ !$msg->is_read ? 'font-bold' : '' }}">{{ $msg->name }}</p>
                    <p class="text-xs text-gray-400">{{ $msg->email }}</p>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center space-x-2">
                        @if(!$msg->is_read)<span class="w-2 h-2 bg-blue-500 rounded-full flex-shrink-0"></span>@endif
                        <span class="text-sm text-gray-700 truncate w-48">{{ $msg->subject }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $msg->created_at->diffForHumans() }}</td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="text-indigo-600 hover:text-indigo-800 text-sm mr-3"><i class="fas fa-eye"></i></a>
                    <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this message?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-6 py-12 text-center text-gray-400">No messages yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($messages->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">{{ $messages->links() }}</div>
    @endif
</div>
@endsection
