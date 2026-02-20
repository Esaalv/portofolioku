@extends('layouts.admin')
@section('title', 'Add Certificate')
@section('page-title', 'Add New Certificate')

@section('content')
<div class="max-w-2xl">
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
    <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Certificate Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Issuing Organization <span class="text-red-500">*</span></label>
                <input type="text" name="issuer" value="{{ old('issuer') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Category <span class="text-red-500">*</span></label>
                <input type="text" name="category" value="{{ old('category') }}" list="cert-categories" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>
                <datalist id="cert-categories"><option value="Technology"><option value="Cloud"><option value="DevOps"><option value="Frontend"><option value="Backend"><option value="Framework"><option value="Database"></datalist>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Credential ID</label>
                <input type="text" name="credential_id" value="{{ old('credential_id') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Credential URL</label>
                <input type="url" name="credential_url" value="{{ old('credential_url') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Issued Date <span class="text-red-500">*</span></label>
                <input type="date" name="issued_date" value="{{ old('issued_date') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Expiry Date</label>
                <input type="date" name="expiry_date" value="{{ old('expiry_date') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Certificate Image</label>
                <input type="file" name="image" accept="image/*" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm">
            </div>
            <div>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="has_expiry" value="1" {{ old('has_expiry') ? 'checked' : '' }} class="w-4 h-4 text-indigo-600 rounded">
                    <span class="text-sm font-medium text-gray-700">Has Expiry Date</span>
                </label>
            </div>
            <div>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="w-4 h-4 text-indigo-600 rounded">
                    <span class="text-sm font-medium text-gray-700">Featured</span>
                </label>
            </div>
        </div>
        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
            <a href="{{ route('admin.certificates.index') }}" class="text-gray-600 hover:text-gray-800 text-sm"><i class="fas fa-arrow-left mr-1"></i>Back</a>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-colors"><i class="fas fa-plus mr-1"></i>Add Certificate</button>
        </div>
    </form>
</div>
</div>
@endsection
