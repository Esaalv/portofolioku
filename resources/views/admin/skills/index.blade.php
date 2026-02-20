@extends('layouts.admin')
@section('title', 'Skills')
@section('page-title', 'Manage Skills')

@section('content')
<div class="flex items-center justify-between mb-5">
    <div>
        <p class="text-sm text-gray-500">{{ $skills->total() }} skills across {{ $categories->count() }} categories</p>
    </div>
    <a href="{{ route('admin.skills.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-colors">
        <i class="fas fa-plus mr-1"></i>Add Skill
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Skill</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Level</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Featured</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($skills as $skill)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 rounded-full flex-shrink-0" style="background-color: {{ $skill->color }}"></div>
                        <span class="font-medium text-sm text-gray-800">{{ $skill->name }}</span>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="text-xs px-2.5 py-1 bg-gray-100 text-gray-700 rounded-full">{{ $skill->category }}</span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center space-x-2">
                        <div class="flex-1 bg-gray-200 rounded-full h-1.5 w-24">
                            <div class="h-1.5 rounded-full" style="width: {{ $skill->level }}%; background-color: {{ $skill->color }}"></div>
                        </div>
                        <span class="text-xs text-gray-600">{{ $skill->level }}%</span>
                    </div>
                </td>
                <td class="px-6 py-4">
                    @if($skill->is_featured)
                        <span class="text-xs px-2 py-1 bg-amber-100 text-amber-700 rounded-full"><i class="fas fa-star mr-1"></i>Featured</span>
                    @else
                        <span class="text-xs text-gray-400">—</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.skills.edit', $skill->id) }}" class="text-indigo-600 hover:text-indigo-800 text-sm mr-3"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.skills.destroy', $skill->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this skill?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400">No skills found. <a href="{{ route('admin.skills.create') }}" class="text-indigo-600 hover:underline">Add your first skill.</a></td></tr>
            @endforelse
        </tbody>
    </table>
    @if($skills->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">{{ $skills->links() }}</div>
    @endif
</div>
@endsection
