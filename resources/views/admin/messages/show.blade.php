@extends('layouts.admin')
@section('title', 'View Message')
@section('page-title', 'Message Detail')

@section('content')
<div class="max-w-2xl">
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-5">
        <h2 class="text-white font-bold text-lg">{{ $message->subject }}</h2>
        <p class="text-indigo-200 text-sm mt-1">From: {{ $message->name }} &lt;{{ $message->email }}&gt;</p>
    </div>
    <div class="p-6">
        <div class="flex items-center justify-between text-sm text-gray-500 mb-6 pb-4 border-b border-gray-100">
            <span><i class="fas fa-clock mr-1"></i>{{ $message->created_at->format('l, d F Y - H:i') }}</span>
            <span class="px-2 py-1 rounded-full text-xs {{ $message->is_read ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                {{ $message->is_read ? 'Read' : 'Unread' }}
            </span>
        </div>
        <div class="prose max-w-none">
            <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $message->message }}</p>
        </div>
        <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
            <a href="{{ route('admin.messages.index') }}" class="text-gray-600 hover:text-gray-800 text-sm"><i class="fas fa-arrow-left mr-1"></i>Back to Messages</a>
            <div class="flex items-center space-x-3">
                <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-blue-700">
                    <i class="fas fa-reply mr-1"></i>Reply via Email
                </a>
                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-100 text-red-600 px-4 py-2 rounded-xl text-sm font-medium hover:bg-red-200">
                        <i class="fas fa-trash mr-1"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
