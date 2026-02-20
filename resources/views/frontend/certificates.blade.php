@extends('layouts.app')
@section('title', 'Certificates')

@section('content')
<section class="bg-gradient-to-br from-gray-900 to-indigo-950 py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-black text-white mb-4">My <span class="gradient-text">Certificates</span></h1>
        <p class="text-gray-400 max-w-xl mx-auto">Professional certifications and achievements that validate my expertise</p>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($certificates as $cert)
            <div class="card-hover bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                @if($cert->image)
                    <img src="{{ asset('storage/' . $cert->image) }}" class="w-full h-44 object-cover">
                @else
                    <div class="h-44 bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center">
                        <i class="fas fa-certificate text-white/40 text-6xl"></i>
                    </div>
                @endif
                <div class="p-5">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="font-bold text-gray-900 text-sm">{{ $cert->title }}</h3>
                        @if($cert->is_featured)<span class="text-amber-500 ml-2"><i class="fas fa-star"></i></span>@endif
                    </div>
                    <p class="text-blue-600 text-sm font-medium mb-2">{{ $cert->issuer }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-400"><i class="fas fa-calendar mr-1"></i>{{ $cert->issued_date->format('M Y') }}</span>
                        @if($cert->is_expired)
                            <span class="text-xs px-2 py-0.5 bg-red-100 text-red-700 rounded-full">Expired</span>
                        @elseif($cert->has_expiry && $cert->expiry_date)
                            <span class="text-xs px-2 py-0.5 bg-green-100 text-green-700 rounded-full">Valid</span>
                        @else
                            <span class="text-xs px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full">Lifetime</span>
                        @endif
                    </div>
                    @if($cert->credential_url)
                    <a href="{{ $cert->credential_url }}" target="_blank" class="mt-3 flex items-center text-xs text-gray-500 hover:text-blue-600 transition-colors">
                        <i class="fas fa-external-link-alt mr-1"></i>Verify Credential
                        @if($cert->credential_id)<span class="ml-1 text-gray-400">({{ $cert->credential_id }})</span>@endif
                    </a>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-20 text-gray-400">
                <i class="fas fa-certificate text-5xl mb-4 block"></i>
                <p>No certificates yet.</p>
            </div>
            @endforelse
        </div>
        @if($certificates->hasPages())
        <div class="mt-10 flex justify-center">{{ $certificates->links() }}</div>
        @endif
    </div>
</section>
@endsection
