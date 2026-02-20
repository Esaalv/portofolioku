@extends('layouts.app')
@section('title', 'Skills')

@section('content')
<section class="bg-gradient-to-br from-gray-900 to-indigo-950 py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-black text-white mb-4">My <span class="gradient-text">Skills</span></h1>
        <p class="text-gray-400 max-w-xl mx-auto">Technologies, frameworks, and tools I've mastered over the years</p>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @foreach($skills as $category => $categorySkills)
        <div class="mb-16">
            <div class="flex items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">{{ $category }}</h2>
                <span class="ml-3 text-sm bg-blue-100 text-blue-700 px-3 py-1 rounded-full">{{ $categorySkills->count() }} skills</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @foreach($categorySkills as $skill)
                <div class="card-hover bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: {{ $skill->color }}20">
                                <span class="font-bold text-sm" style="color: {{ $skill->color }}">{{ strtoupper(substr($skill->name, 0, 2)) }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">{{ $skill->name }}</p>
                                @if($skill->is_featured)<span class="text-xs text-amber-600"><i class="fas fa-star"></i> Featured</span>@endif
                            </div>
                        </div>
                        <span class="text-2xl font-bold" style="color: {{ $skill->color }}">{{ $skill->level }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2">
                        <div class="h-2 rounded-full skill-bar" style="width: {{ $skill->level }}%; background-color: {{ $skill->color }}"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
