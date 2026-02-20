@extends('layouts.admin')
@section('title', 'Edit Project')
@section('page-title', 'Edit Project')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Project Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $project->title) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Short Description <span class="text-red-500">*</span></label>
                <textarea name="description" rows="3" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>{{ old('description', $project->description) }}</textarea>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Detailed Description</label>
                <textarea name="detail" rows="5" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">{{ old('detail', $project->detail) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Category</label>
                <select name="category" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>
                    @foreach(['Web','Mobile','API','SaaS','Desktop','Other'] as $cat)
                        <option value="{{ $cat }}" {{ old('category', $project->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
                <select name="status" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>
                    <option value="completed" {{ old('status', $project->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="in_progress" {{ old('status', $project->status) === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="planned" {{ old('status', $project->status) === 'planned' ? 'selected' : '' }}>Planned</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Tech Stack</label>
                <input type="text" name="tech_stack" value="{{ old('tech_stack', $project->tech_stack) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" placeholder="Comma-separated">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}" min="0" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Demo URL</label>
                <input type="url" name="demo_url" value="{{ old('demo_url', $project->demo_url) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">GitHub URL</label>
                <input type="url" name="github_url" value="{{ old('github_url', $project->github_url) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Start Date</label>
                <input type="date" name="start_date" value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">End Date</label>
                <input type="date" name="end_date" value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Project Image</label>
                @if($project->image)
                    <img src="{{ asset('storage/' . $project->image) }}" class="w-24 h-16 object-cover rounded-lg mb-2">
                @endif
                <input type="file" name="image" accept="image/*" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm">
                <p class="text-xs text-gray-400 mt-1">Leave empty to keep current image.</p>
            </div>
            <div class="md:col-span-2">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ $project->is_featured ? 'checked' : '' }} class="w-4 h-4 text-indigo-600 rounded">
                    <span class="text-sm font-medium text-gray-700">Featured Project</span>
                </label>
            </div>
        </div>
        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
            <a href="{{ route('admin.projects.index') }}" class="text-gray-600 hover:text-gray-800 text-sm"><i class="fas fa-arrow-left mr-1"></i>Back</a>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-colors">
                <i class="fas fa-save mr-1"></i>Update Project
            </button>
        </div>
    </form>
</div>
@endsection
