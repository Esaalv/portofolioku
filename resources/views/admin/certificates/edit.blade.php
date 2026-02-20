@extends('layouts.admin')
@section('title', 'Edit Certificate')
@section('page-title', 'Edit Certificate')

@section('content')
<div class="max-w-2xl">
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
    <form action="{{ route('admin.certificates.update', $certificate->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Certificate Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $certificate->title) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Issuing Organization</label>
                <input type="text" name="issuer" value="{{ old('issuer', $certificate->issuer) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Category</label>
                <input type="text" name="category" value="{{ old('category', $certificate->category) }}" list="cert-categories" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>
                <datalist id="cert-categories"><option value="Technology"><option value="Cloud"><option value="DevOps"><option value="Frontend"><option value="Backend"></datalist>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Credential ID</label>
                <input type="text" name="credential_id" value="{{ old('credential_id', $certificate->credential_id) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Credential URL</label>
                <input type="url" name="credential_url" value="{{ old('credential_url', $certificate->credential_url) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Issued Date</label>
                <input type="date" name="issued_date" value="{{ old('issued_date', $certificate->issued_date->format('Y-m-d')) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Expiry Date</label>
                <input type="date" name="expiry_date" value="{{ old('expiry_date', $certificate->expiry_date?->format('Y-m-d')) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Certificate Image</label>
                @if($certificate->image)
                    <img src="{{ asset('storage/' . $certificate->image) }}" class="w-24 h-16 object-cover rounded-lg mb-2">
                @endif
                <input type="file" name="image" accept="image/*" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm">
            </div>
            <div>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="has_expiry" value="1" {{ $certificate->has_expiry ? 'checked' : '' }} class="w-4 h-4 text-indigo-600 rounded">
                    <span class="text-sm font-medium text-gray-700">Has Expiry Date</span>
                </label>
            </div>
            <div>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ $certificate->is_featured ? 'checked' : '' }} class="w-4 h-4 text-indigo-600 rounded">
                    <span class="text-sm font-medium text-gray-700">Featured</span>
                </label>
            </div>
        </div>
        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
            <a href="{{ route('admin.certificates.index') }}" class="text-gray-600 hover:text-gray-800 text-sm"><i class="fas fa-arrow-left mr-1"></i>Back</a>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl text-sm font-medium hover:bg-indigo-700 transition-colors"><i class="fas fa-save mr-1"></i>Save Changes</button>
        </div>
    </form>
</div>
</div>
@endsection
