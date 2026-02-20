@extends('layouts.app')
@section('title', 'About')

@section('content')
<section class="bg-gradient-to-br from-gray-900 to-indigo-950 py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-black text-white mb-4">About <span class="gradient-text">Me</span></h1>
        <p class="text-gray-400 max-w-xl mx-auto">Passionate developer crafting digital experiences with modern technologies</p>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($profile)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">
            <div>
                <div class="w-64 h-64 rounded-3xl overflow-hidden shadow-2xl mx-auto lg:mx-0">
                    @if($profile->avatar)
                        <img src="{{ asset('storage/' . $profile->avatar) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            <i class="fas fa-user text-white text-6xl"></i>
                        </div>
                    @endif
                </div>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $profile->full_name }}</h2>
                <p class="text-blue-600 font-semibold mb-4">{{ $profile->title }}</p>
                <p class="text-gray-600 leading-relaxed mb-6">{{ $profile->bio }}</p>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div><span class="text-gray-500 text-sm">Email:</span> <p class="text-gray-800 text-sm font-medium">{{ $profile->email }}</p></div>
                    <div><span class="text-gray-500 text-sm">Location:</span> <p class="text-gray-800 text-sm font-medium">{{ $profile->location ?? '—' }}</p></div>
                    <div><span class="text-gray-500 text-sm">Phone:</span> <p class="text-gray-800 text-sm font-medium">{{ $profile->phone ?? '—' }}</p></div>
                    <div><span class="text-gray-500 text-sm">Status:</span> <p class="text-sm font-medium {{ $profile->available_for_hire ? 'text-green-600' : 'text-gray-500' }}">{{ $profile->available_for_hire ? 'Available for hire' : 'Not available' }}</p></div>
                </div>
                <div class="flex space-x-3">
                    @if($profile->github)<a href="{{ $profile->github }}" target="_blank" class="w-10 h-10 bg-gray-900 text-white rounded-xl flex items-center justify-center hover:bg-blue-600 transition-colors"><i class="fab fa-github"></i></a>@endif
                    @if($profile->linkedin)<a href="{{ $profile->linkedin }}" target="_blank" class="w-10 h-10 bg-blue-700 text-white rounded-xl flex items-center justify-center hover:bg-blue-800 transition-colors"><i class="fab fa-linkedin-in"></i></a>@endif
                    @if($profile->twitter)<a href="{{ $profile->twitter }}" target="_blank" class="w-10 h-10 bg-sky-500 text-white rounded-xl flex items-center justify-center hover:bg-sky-600 transition-colors"><i class="fab fa-twitter"></i></a>@endif
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-3 gap-6 mb-20">
            <div class="text-center p-8 bg-blue-50 rounded-2xl">
                <p class="text-5xl font-black text-blue-600">{{ $profile->years_experience }}+</p>
                <p class="text-gray-600 mt-2 font-medium">Years of Experience</p>
            </div>
            <div class="text-center p-8 bg-purple-50 rounded-2xl">
                <p class="text-5xl font-black text-purple-600">{{ $profile->projects_completed }}+</p>
                <p class="text-gray-600 mt-2 font-medium">Projects Completed</p>
            </div>
            <div class="text-center p-8 bg-green-50 rounded-2xl">
                <p class="text-5xl font-black text-green-600">{{ $profile->clients_served }}+</p>
                <p class="text-gray-600 mt-2 font-medium">Happy Clients</p>
            </div>
        </div>
        @endif

        <!-- Skills Summary -->
        @foreach($skills as $category => $categorySkills)
        <div class="mb-12">
            <h3 class="text-xl font-bold text-gray-800 mb-6">{{ $category }}</h3>
            <div class="space-y-4">
                @foreach($categorySkills as $skill)
                <div>
                    <div class="flex justify-between mb-1.5">
                        <span class="text-sm font-medium text-gray-700">{{ $skill->name }}</span>
                        <span class="text-sm text-gray-500">{{ $skill->level }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
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
