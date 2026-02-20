@extends('layouts.admin')
@section('title', 'Add Skill')
@section('page-title', 'Add New Skill')

@section('content')
<div class="max-w-2xl">
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
    <form action="{{ route('admin.skills.store') }}" method="POST" class="space-y-5">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Skill Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 @error('name') border-red-400 @enderror" required>
                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Category <span class="text-red-500">*</span></label>
                <input type="text" name="category" value="{{ old('category') }}" list="categories" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required placeholder="e.g. Backend, Frontend">
                <datalist id="categories">
                    <option value="Backend"><option value="Frontend"><option value="Database"><option value="DevOps"><option value="Tools"><option value="Mobile">
                </datalist>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Proficiency Level (1-100) <span class="text-red-500">*</span></label>
                <input type="number" name="level" value="{{ old('level', 80) }}" min="1" max="100" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Color</label>
                <div class="flex items-center space-x-2">
                    <input type="color" name="color" value="{{ old('color', '#3B82F6') }}" class="w-12 h-10 border border-gray-200 rounded-lg cursor-pointer">
                    <input type="text" id="colorText" value="{{ old('color', '#3B82F6') }}" class="flex-1 border border-gray-200 rounded-xl px-4 py-2.5 text-sm" placeholder="#3B82F6">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div class="flex items-center pt-6">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="w-4 h-4 text-indigo-600 rounded">
                    <span class="text-sm font-medium text-gray-700">Featured on Homepage</span>
                </label>
            </div>
        </div>
        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
            <a href="{{ route('admin.skills.index') }}" class="text-gray-600 hover:text-gray-800 text-sm"><i class="fas fa-arrow-left mr-1"></i>Back</a>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-colors">
                <i class="fas fa-plus mr-1"></i>Add Skill
            </button>
        </div>
    </form>
</div>
</div>
@endsection
