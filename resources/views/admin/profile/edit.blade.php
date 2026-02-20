@extends('layouts.admin')
@section('title', 'Edit Profile')
@section('page-title', 'Edit Profile')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Full Name <span class="text-red-500">*</span></label>
                <input type="text" name="full_name" value="{{ old('full_name', $profile->full_name) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 @error('full_name') border-red-400 @enderror" required>
                @error('full_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Professional Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $profile->title) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Tagline</label>
                <input type="text" name="tagline" value="{{ old('tagline', $profile->tagline) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" placeholder="A short catchy phrase about you">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Bio <span class="text-red-500">*</span></label>
                <textarea name="bio" rows="4" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>{{ old('bio', $profile->bio) }}</textarea>
                @error('bio')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email', $profile->email) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Location</label>
                <input type="text" name="location" value="{{ old('location', $profile->location) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Website</label>
                <input type="url" name="website" value="{{ old('website', $profile->website) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">GitHub URL</label>
                <input type="url" name="github" value="{{ old('github', $profile->github) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">LinkedIn URL</label>
                <input type="url" name="linkedin" value="{{ old('linkedin', $profile->linkedin) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Twitter URL</label>
                <input type="url" name="twitter" value="{{ old('twitter', $profile->twitter) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Instagram URL</label>
                <input type="url" name="instagram" value="{{ old('instagram', $profile->instagram) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Years of Experience</label>
                <input type="number" name="years_experience" value="{{ old('years_experience', $profile->years_experience) }}" min="0" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Projects Completed</label>
                <input type="number" name="projects_completed" value="{{ old('projects_completed', $profile->projects_completed) }}" min="0" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Clients Served</label>
                <input type="number" name="clients_served" value="{{ old('clients_served', $profile->clients_served) }}" min="0" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Profile Avatar</label>
                @if($profile->avatar)
                    <img src="{{ asset('storage/' . $profile->avatar) }}" class="w-16 h-16 rounded-xl object-cover mb-2">
                @endif
                <input type="file" name="avatar" accept="image/*" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm">
                <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP. Max 2MB.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Resume (PDF)</label>
                @if($profile->resume)
                    <a href="{{ asset('storage/' . $profile->resume) }}" target="_blank" class="text-indigo-600 text-xs hover:underline block mb-2"><i class="fas fa-file-pdf mr-1"></i>Current Resume</a>
                @endif
                <input type="file" name="resume" accept=".pdf" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm">
                <p class="text-xs text-gray-400 mt-1">PDF only. Max 5MB.</p>
            </div>
            <div class="md:col-span-2">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="available_for_hire" value="1" {{ $profile->available_for_hire ? 'checked' : '' }} class="w-4 h-4 text-indigo-600 rounded">
                    <span class="text-sm font-medium text-gray-700">Available for Hire</span>
                </label>
            </div>
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
            <a href="{{ route('admin.profile.index') }}" class="text-gray-600 hover:text-gray-800 text-sm"><i class="fas fa-arrow-left mr-1"></i>Back</a>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-colors">
                <i class="fas fa-save mr-1"></i>Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
