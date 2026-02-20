@extends('layouts.admin')
@section('title', 'Certificates')
@section('page-title', 'Manage Certificates')

@section('content')
<div class="flex items-center justify-between mb-5">
    <p class="text-sm text-gray-500">{{ $certificates->total() }} total certificates</p>
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.certificates.trash') }}" class="text-gray-500 hover:text-gray-700 text-sm border border-gray-200 px-4 py-2 rounded-xl"><i class="fas fa-trash-alt mr-1"></i>Trash</a>
        <a href="{{ route('admin.certificates.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-colors"><i class="fas fa-plus mr-1"></i>Add Certificate</a>
    </div>
</div>
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Certificate</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Issuer</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Issued</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($certificates as $cert)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">
                    <p class="font-medium text-sm text-gray-800">{{ $cert->title }}</p>
                    <span class="text-xs px-2 py-0.5 bg-purple-100 text-purple-700 rounded-full">{{ $cert->category }}</span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $cert->issuer }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $cert->issued_date->format('M Y') }}</td>
                <td class="px-6 py-4">
                    @if($cert->is_expired)
                        <span class="text-xs px-2 py-1 bg-red-100 text-red-700 rounded-full">Expired</span>
                    @elseif($cert->has_expiry)
                        <span class="text-xs px-2 py-1 bg-green-100 text-green-700 rounded-full">Valid until {{ $cert->expiry_date->format('M Y') }}</span>
                    @else
                        <span class="text-xs px-2 py-1 bg-blue-100 text-blue-700 rounded-full">No Expiry</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.certificates.edit', $cert->id) }}" class="text-indigo-600 hover:text-indigo-800 text-sm mr-3"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.certificates.destroy', $cert->id) }}" method="POST" class="inline" onsubmit="return confirm('Move to trash?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400">No certificates yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($certificates->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">{{ $certificates->links() }}</div>
    @endif
</div>
@endsection
