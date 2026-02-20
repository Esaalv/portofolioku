@extends('layouts.app')
@section('title', 'Projects')

@section('content')
<section class="bg-gradient-to-br from-gray-900 to-indigo-950 py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-black text-white mb-4">My <span class="gradient-text">Projects</span></h1>
        <p class="text-gray-400 max-w-xl mx-auto">Real-world solutions built with passion and precision</p>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Category filter -->
        <div class="flex flex-wrap gap-2 mb-10 justify-center">
            <a href="{{ route('projects') }}" class="px-5 py-2 rounded-full text-sm font-medium bg-blue-600 text-white transition-all">All</a>
            @foreach($categories as $cat)
            <a href="{{ route('projects') }}?category={{ $cat }}" class="px-5 py-2 rounded-full text-sm font-medium border border-gray-200 text-gray-600 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all">{{ $cat }}</a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($projects as $project)
            <div class="card-hover bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                <div class="h-48 bg-gradient-to-br from-indigo-500 to-purple-600 relative">
                    @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center"><i class="fas fa-laptop-code text-white/30 text-5xl"></i></div>
                    @endif
                    <div class="absolute top-3 left-3 flex items-center space-x-2">
                        <span class="bg-white/20 backdrop-blur-sm text-white text-xs px-2.5 py-1 rounded-full">{{ $project->category }}</span>
                        @if($project->is_featured)<span class="bg-amber-500/80 text-white text-xs px-2 py-1 rounded-full"><i class="fas fa-star"></i></span>@endif
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="font-bold text-gray-900">{{ $project->title }}</h3>
                        <span class="text-xs px-2 py-1 rounded-full ml-2 flex-shrink-0
                            {{ $project->status === 'completed' ? 'bg-green-100 text-green-700' : ($project->status === 'in_progress' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600') }}">
                            {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                        </span>
                    </div>
                    <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $project->description }}</p>
                    @if($project->tech_stack)
                    <div class="flex flex-wrap gap-1 mb-4">
                        @foreach(array_slice(explode(',', $project->tech_stack), 0, 3) as $tech)
                            <span class="text-xs bg-blue-50 text-blue-700 px-2 py-0.5 rounded-full">{{ trim($tech) }}</span>
                        @endforeach
                    </div>
                    @endif
                    <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                        <a href="{{ route('projects.detail', $project->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Details <i class="fas fa-arrow-right ml-1"></i></a>
                        <div class="flex space-x-2">
                            @if($project->github_url)<a href="{{ $project->github_url }}" target="_blank" class="text-gray-400 hover:text-gray-700"><i class="fab fa-github"></i></a>@endif
                            @if($project->demo_url)<a href="{{ $project->demo_url }}" target="_blank" class="text-gray-400 hover:text-blue-600"><i class="fas fa-external-link-alt"></i></a>@endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-20 text-gray-400">
                <i class="fas fa-folder-open text-5xl mb-4 block"></i>
                <p>No projects found.</p>
            </div>
            @endforelse
        </div>

        @if($projects->hasPages())
        <div class="mt-10 flex justify-center">{{ $projects->links() }}</div>
        @endif
    </div>
</section>
@endsection
