@extends('layouts.admin')
@section('title', 'Projects')
@section('page-title', 'Manage Projects')

@section('content')
<div class="flex items-center justify-between mb-5">
    <p class="text-sm text-gray-500">{{ $projects->total() }} total projects</p>
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.projects.trash') }}" class="text-gray-500 hover:text-gray-700 text-sm border border-gray-200 px-4 py-2 rounded-xl">
            <i class="fas fa-trash-alt mr-1"></i>Trash
        </a>
        <a href="{{ route('admin.projects.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-colors">
            <i class="fas fa-plus mr-1"></i>Add Project
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Project</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Featured</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($projects as $project)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center space-x-3">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" class="w-10 h-10 rounded-lg object-cover">
                        @else
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-laptop-code text-indigo-500 text-sm"></i>
                            </div>
                        @endif
                        <div>
                            <p class="font-medium text-sm text-gray-800">{{ $project->title }}</p>
                            <p class="text-xs text-gray-400 truncate w-48">{{ $project->description }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4"><span class="text-xs px-2.5 py-1 bg-blue-100 text-blue-700 rounded-full">{{ $project->category }}</span></td>
                <td class="px-6 py-4">
                    <span class="text-xs px-2.5 py-1 rounded-full
                        {{ $project->status === 'completed' ? 'bg-green-100 text-green-700' : ($project->status === 'in_progress' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600') }}">
                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    @if($project->is_featured)<span class="text-amber-500 text-sm"><i class="fas fa-star"></i></span>@else<span class="text-gray-300 text-sm"><i class="fas fa-star"></i></span>@endif
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="text-indigo-600 hover:text-indigo-800 text-sm mr-3"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="inline" onsubmit="return confirm('Move project to trash?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400">No projects yet. <a href="{{ route('admin.projects.create') }}" class="text-indigo-600 hover:underline">Add your first project.</a></td></tr>
            @endforelse
        </tbody>
    </table>
    @if($projects->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">{{ $projects->links() }}</div>
    @endif
</div>
@endsection
