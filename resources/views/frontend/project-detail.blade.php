@extends('layouts.app')
@section('title', $project->title)

@section('content')
<section class="bg-gradient-to-br from-gray-900 to-indigo-950 py-20">
    <div class="max-w-4xl mx-auto px-4">
        <div class="mb-4">
            <a href="{{ route('projects') }}" class="text-gray-400 hover:text-white text-sm"><i class="fas fa-arrow-left mr-1"></i>Back to Projects</a>
        </div>
        <div class="flex items-start justify-between">
            <div>
                <span class="text-xs bg-blue-500/20 text-blue-300 border border-blue-500/30 px-3 py-1 rounded-full mb-3 inline-block">{{ $project->category }}</span>
                <h1 class="text-4xl font-black text-white mb-3">{{ $project->title }}</h1>
                <p class="text-gray-400 text-lg">{{ $project->description }}</p>
            </div>
        </div>
        <div class="flex flex-wrap gap-3 mt-6">
            @if($project->demo_url)
            <a href="{{ $project->demo_url }}" target="_blank" class="bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-medium hover:bg-blue-700 transition-colors">
                <i class="fas fa-external-link-alt mr-2"></i>Live Demo
            </a>
            @endif
            @if($project->github_url)
            <a href="{{ $project->github_url }}" target="_blank" class="bg-gray-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium hover:bg-gray-600 transition-colors">
                <i class="fab fa-github mr-2"></i>Source Code
            </a>
            @endif
        </div>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        @if($project->image)
        <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-72 object-cover rounded-2xl shadow-xl mb-10">
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-xs text-gray-400 mb-1">Status</p>
                <span class="text-sm font-semibold {{ $project->status === 'completed' ? 'text-green-600' : 'text-blue-600' }}">{{ ucfirst(str_replace('_', ' ', $project->status)) }}</span>
            </div>
            @if($project->start_date)
            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-xs text-gray-400 mb-1">Timeline</p>
                <p class="text-sm font-semibold text-gray-800">{{ $project->start_date->format('M Y') }} {{ $project->end_date ? '– ' . $project->end_date->format('M Y') : '– Present' }}</p>
            </div>
            @endif
            @if($project->tech_stack)
            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-xs text-gray-400 mb-1">Technologies</p>
                <div class="flex flex-wrap gap-1 mt-1">
                    @foreach(explode(',', $project->tech_stack) as $tech)
                        <span class="text-xs bg-blue-50 text-blue-700 px-2 py-0.5 rounded-full">{{ trim($tech) }}</span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        @if($project->detail)
        <div class="prose max-w-none mb-10">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Project Overview</h2>
            <p class="text-gray-600 leading-relaxed">{{ $project->detail }}</p>
        </div>
        @endif

        @if($related->count() > 0)
        <div class="mt-16 border-t border-gray-100 pt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($related as $rel)
                <a href="{{ route('projects.detail', $rel->id) }}" class="card-hover block bg-gray-50 rounded-xl p-4">
                    <p class="font-semibold text-gray-800 mb-1">{{ $rel->title }}</p>
                    <p class="text-xs text-gray-400 line-clamp-2">{{ $rel->description }}</p>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
