@extends('layouts.admin')
@section('title', 'Create Profile')
@section('page-title', 'Create Profile')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
    <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Full Name <span class="text-red-500">*</span></label>
                <input type="text" name="full_name" value="{{ old('full_name') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>
                @error('full_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Professional Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Tagline</label>
                <input type="text" name="tagline" value="{{ old('tagline') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Bio <span class="text-red-500">*</span></label>
                <textarea name="bio" rows="4" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>{{ old('bio') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Location</label>
                <input type="text" name="location" value="{{ old('location') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Website</label>
                <input type="url" name="website" value="{{ old('website') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Profile Avatar</label>
                <input type="file" name="avatar" accept="image/*" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Resume (PDF)</label>
                <input type="file" name="resume" accept=".pdf" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm">
            </div>
            <div class="md:col-span-2">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="available_for_hire" value="1" checked class="w-4 h-4 text-indigo-600 rounded">
                    <span class="text-sm font-medium text-gray-700">Available for Hire</span>
                </label>
            </div>
        </div>
        <div class="flex justify-end pt-4 border-t border-gray-100">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-colors">
                <i class="fas fa-plus mr-1"></i>Create Profile
            </button>
        </div>
    </form>
</div>
@endsection
