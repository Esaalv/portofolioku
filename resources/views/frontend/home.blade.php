@extends('layouts.app')
@section('title', 'Home')
@section('description', $profile ? $profile->tagline : 'Full Stack Web Developer')

@section('content')
<!-- Hero Section -->
<section class="hero-gradient min-h-screen flex items-center relative overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-fade-in">
                @if($profile)
                    <div class="inline-flex items-center space-x-2 bg-blue-500/20 border border-blue-500/30 rounded-full px-4 py-1.5 mb-6">
                        <div class="w-2 h-2 bg-green-400 rounded-full {{ $profile->available_for_hire ? 'animate-pulse' : '' }}"></div>
                        <span class="text-blue-300 text-sm">{{ $profile->available_for_hire ? 'Available for hire' : 'Currently busy' }}</span>
                    </div>
                    <h1 class="text-5xl lg:text-6xl font-black text-white leading-tight mb-4">
                        Hi, I'm <span class="gradient-text">{{ explode(' ', $profile->full_name)[0] }}</span>
                    </h1>
                    <p class="text-xl text-blue-200 font-medium mb-4">{{ $profile->title }}</p>
                    <p class="text-gray-400 text-lg leading-relaxed mb-8">{{ $profile->tagline }}</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('projects') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3.5 rounded-xl font-semibold hover:shadow-lg hover:shadow-blue-500/25 transition-all duration-300">
                            <i class="fas fa-laptop-code mr-2"></i>View My Work
                        </a>
                        <a href="{{ route('contact') }}" class="border border-white/20 text-white px-8 py-3.5 rounded-xl font-semibold hover:bg-white/10 transition-all duration-300">
                            <i class="fas fa-envelope mr-2"></i>Get In Touch
                        </a>
                    </div>
                    <div class="flex items-center space-x-6 mt-10">
                        <div class="text-center">
                            <p class="text-3xl font-bold text-white">{{ $profile->years_experience }}+</p>
                            <p class="text-gray-400 text-xs">Years Exp.</p>
                        </div>
                        <div class="w-px h-10 bg-white/20"></div>
                        <div class="text-center">
                            <p class="text-3xl font-bold text-white">{{ $profile->projects_completed }}+</p>
                            <p class="text-gray-400 text-xs">Projects</p>
                        </div>
                        <div class="w-px h-10 bg-white/20"></div>
                        <div class="text-center">
                            <p class="text-3xl font-bold text-white">{{ $profile->clients_served }}+</p>
                            <p class="text-gray-400 text-xs">Clients</p>
                        </div>
                    </div>
                @else
                    <h1 class="text-5xl font-black text-white">Welcome to My Portfolio</h1>
                    <p class="text-gray-400 mt-4">Profile coming soon.</p>
                @endif
            </div>
            <div class="hidden lg:flex justify-center">
                <div class="relative">
                    <div class="w-72 h-72 rounded-full bg-gradient-to-br from-blue-500/20 to-purple-500/20 border border-white/10 flex items-center justify-center">
                        @if($profile && $profile->avatar)
                            <img src="{{ asset('storage/' . $profile->avatar) }}" class="w-64 h-64 rounded-full object-cover" alt="Profile">
                        @else
                            <i class="fas fa-user text-white/20 text-8xl"></i>
                        @endif
                    </div>
                    <!-- Floating skill badges -->
                    @foreach($featuredSkills->take(3) as $i => $skill)
                    <div class="absolute {{ $i === 0 ? '-top-4 -right-4' : ($i === 1 ? 'top-1/2 -right-12' : '-bottom-4 -right-4') }} bg-gray-800 border border-white/10 rounded-xl px-3 py-2 flex items-center space-x-2">
                        <div class="w-2 h-2 rounded-full" style="background:{{ $skill->color }}"></div>
                        <span class="text-white text-xs font-medium">{{ $skill->name }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Skills -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">What I <span class="gradient-text">Do Best</span></h2>
            <p class="text-gray-500 max-w-xl mx-auto">Technologies and tools I use to build exceptional digital experiences</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach($featuredSkills as $skill)
            <div class="card-hover text-center p-5 rounded-2xl border border-gray-100 hover:border-blue-200">
                <div class="w-12 h-12 rounded-xl mx-auto mb-3 flex items-center justify-center" style="background-color: {{ $skill->color }}20">
                    <span class="text-lg font-bold" style="color: {{ $skill->color }}">{{ strtoupper(substr($skill->name, 0, 2)) }}</span>
                </div>
                <p class="font-semibold text-sm text-gray-800">{{ $skill->name }}</p>
                <p class="text-xs text-gray-400">{{ $skill->level }}%</p>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('skills') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">View all skills <i class="fas fa-arrow-right ml-1"></i></a>
        </div>
    </div>
</section>

<!-- Featured Projects -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured <span class="gradient-text">Projects</span></h2>
            <p class="text-gray-500 max-w-xl mx-auto">A showcase of my best work — real solutions that make a difference</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($featuredProjects as $project)
            <div class="card-hover bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                <div class="h-48 bg-gradient-to-br from-indigo-500 to-purple-600 relative overflow-hidden">
                    @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-full object-cover" alt="{{ $project->title }}">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-laptop-code text-white/40 text-5xl"></i>
                        </div>
                    @endif
                    <div class="absolute top-3 right-3">
                        <span class="bg-white/20 backdrop-blur-sm text-white text-xs px-2.5 py-1 rounded-full">{{ $project->category }}</span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-gray-900 mb-2">{{ $project->title }}</h3>
                    <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $project->description }}</p>
                    <div class="flex flex-wrap gap-1 mb-4">
                        @foreach(array_slice(explode(',', $project->tech_stack ?? ''), 0, 3) as $tech)
                            <span class="text-xs bg-blue-50 text-blue-700 px-2 py-0.5 rounded-full">{{ trim($tech) }}</span>
                        @endforeach
                    </div>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('projects.detail', $project->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Learn more <i class="fas fa-arrow-right ml-1"></i></a>
                        <div class="flex space-x-2">
                            @if($project->github_url)<a href="{{ $project->github_url }}" target="_blank" class="text-gray-400 hover:text-gray-700"><i class="fab fa-github"></i></a>@endif
                            @if($project->demo_url)<a href="{{ $project->demo_url }}" target="_blank" class="text-gray-400 hover:text-gray-700"><i class="fas fa-external-link-alt"></i></a>@endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('projects') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-xl font-semibold hover:shadow-lg transition-all">View All Projects</a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-blue-600 to-purple-700">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-white mb-4">Let's Build Something Amazing</h2>
        <p class="text-blue-200 text-lg mb-8">Have a project in mind? I'd love to hear about it and discuss how we can work together.</p>
        <a href="{{ route('contact') }}" class="bg-white text-blue-600 px-10 py-4 rounded-xl font-bold text-lg hover:shadow-xl transition-all inline-block">
            Start a Conversation <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>
</section>
@endsection
