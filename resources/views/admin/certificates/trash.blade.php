@extends('layouts.admin')
@section('title', 'Certificates Trash')
@section('page-title', 'Certificates Trash')

@section('content')
<div class="flex items-center justify-between mb-5">
    <p class="text-sm text-gray-500">{{ $certificates->total() }} deleted certificates</p>
    <a href="{{ route('admin.certificates.index') }}" class="text-indigo-600 text-sm hover:underline"><i class="fas fa-arrow-left mr-1"></i>Back to Certificates</a>
</div>
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Certificate</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Deleted</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($certificates as $cert)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">
                    <p class="font-medium text-sm text-gray-800">{{ $cert->title }}</p>
                    <p class="text-xs text-gray-400">{{ $cert->issuer }}</p>
                </td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $cert->deleted_at->diffForHumans() }}</td>
                <td class="px-6 py-4 text-right">
                    <form action="{{ route('admin.certificates.restore', $cert->id) }}" method="POST" class="inline">
                        @csrf @method('PATCH')
                        <button type="submit" class="text-green-600 hover:text-green-800 text-sm font-medium"><i class="fas fa-undo mr-1"></i>Restore</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="3" class="px-6 py-12 text-center text-gray-400">Trash is empty.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($certificates->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">{{ $certificates->links() }}</div>
    @endif
</div>
@endsection
