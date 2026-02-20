@extends('layouts.admin')
@section('title', 'Profile')
@section('page-title', 'My Profile')

@section('content')
@if($profile)
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-10 relative">
        <div class="flex items-end space-x-6">
            <div class="w-24 h-24 rounded-2xl border-4 border-white overflow-hidden bg-gray-200 flex-shrink-0">
                @if($profile->avatar)
                    <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-indigo-200 flex items-center justify-center">
                        <i class="fas fa-user text-indigo-500 text-3xl"></i>
                    </div>
                @endif
            </div>
            <div class="text-white">
                <h2 class="text-2xl font-bold">{{ $profile->full_name }}</h2>
                <p class="text-indigo-200">{{ $profile->title }}</p>
                <p class="text-indigo-300 text-sm mt-1">{{ $profile->tagline }}</p>
            </div>
        </div>
    </div>
    <div class="p-8">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-3">
                <span class="text-sm px-3 py-1 rounded-full {{ $profile->available_for_hire ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                    <i class="fas fa-circle text-xs mr-1 {{ $profile->available_for_hire ? 'text-green-500' : 'text-gray-400' }}"></i>
                    {{ $profile->available_for_hire ? 'Available for Hire' : 'Not Available' }}
                </span>
            </div>
            <a href="{{ route('admin.profile.edit') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-colors">
                <i class="fas fa-edit mr-1"></i>Edit Profile
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="text-center p-4 bg-blue-50 rounded-xl">
                <p class="text-3xl font-bold text-blue-600">{{ $profile->years_experience }}</p>
                <p class="text-sm text-gray-500">Years Experience</p>
            </div>
            <div class="text-center p-4 bg-purple-50 rounded-xl">
                <p class="text-3xl font-bold text-purple-600">{{ $profile->projects_completed }}</p>
                <p class="text-sm text-gray-500">Projects Completed</p>
            </div>
            <div class="text-center p-4 bg-green-50 rounded-xl">
                <p class="text-3xl font-bold text-green-600">{{ $profile->clients_served }}</p>
                <p class="text-sm text-gray-500">Clients Served</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold text-gray-800 mb-3">Contact Information</h3>
                <div class="space-y-2">
                    <p class="text-sm"><span class="text-gray-500">Email:</span> <span class="text-gray-800">{{ $profile->email }}</span></p>
                    <p class="text-sm"><span class="text-gray-500">Phone:</span> <span class="text-gray-800">{{ $profile->phone ?? '—' }}</span></p>
                    <p class="text-sm"><span class="text-gray-500">Location:</span> <span class="text-gray-800">{{ $profile->location ?? '—' }}</span></p>
                    <p class="text-sm"><span class="text-gray-500">Website:</span> <span class="text-gray-800">{{ $profile->website ?? '—' }}</span></p>
                </div>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800 mb-3">Social Links</h3>
                <div class="space-y-2">
                    <p class="text-sm"><span class="text-gray-500">GitHub:</span> <a href="{{ $profile->github }}" target="_blank" class="text-indigo-600 hover:underline text-xs truncate block">{{ $profile->github ?? '—' }}</a></p>
                    <p class="text-sm"><span class="text-gray-500">LinkedIn:</span> <a href="{{ $profile->linkedin }}" target="_blank" class="text-indigo-600 hover:underline text-xs truncate block">{{ $profile->linkedin ?? '—' }}</a></p>
                    <p class="text-sm"><span class="text-gray-500">Twitter:</span> <a href="{{ $profile->twitter }}" target="_blank" class="text-indigo-600 hover:underline text-xs truncate block">{{ $profile->twitter ?? '—' }}</a></p>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <h3 class="font-semibold text-gray-800 mb-2">Bio</h3>
            <p class="text-gray-600 text-sm leading-relaxed">{{ $profile->bio }}</p>
        </div>
    </div>
</div>
@else
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
        <i class="fas fa-user-plus text-gray-400 text-2xl"></i>
    </div>
    <h3 class="text-lg font-semibold text-gray-800 mb-2">No Profile Yet</h3>
    <p class="text-gray-500 text-sm mb-6">Create your portfolio profile to get started.</p>
    <a href="{{ route('admin.profile.create') }}" class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl font-medium hover:bg-indigo-700 transition-colors">
        <i class="fas fa-plus mr-2"></i>Create Profile
    </a>
</div>
@endif
@endsection
