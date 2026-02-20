@extends('layouts.app')

@section('title', 'Contact Me')

@section('content')
<section class="py-20 hero-gradient min-h-screen flex items-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Get In Touch</h2>
            <p class="text-gray-400">Have questions or want to collaborate? Send your message below.</p>
        </div>

        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/10 shadow-2xl">
            {{-- Bagian notifikasi dikomentari karena Formspree akan mengarahkan ke halaman sukses mereka sendiri --}}
            {{-- @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/20 border border-green-500/50 rounded-xl text-green-400 text-sm flex items-center">
                    <i class="fas fa-check-circle mr-3"></i>
                    {{ session('success') }}
                </div>
            @endif --}}

            {{-- Ganti action ke URL Formspree --}}
            <form action="https://formspree.io/f/{{ env('FORMSPREE_URL') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Full name</label>
                        <input type="text" name="name" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 transition-all" placeholder="Enter your name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                        <input type="email" name="_replyto" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 transition-all" placeholder="example@gmail.com">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Subject</label>
                    <input type="text" name="subject" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 transition-all" placeholder="The topic of your message">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Message</label>
                    <textarea name="message" rows="5" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 transition-all" placeholder="Write your message here..."></textarea>
                </div>

                {{-- Opsi: Halaman Redirect Setelah Kirim --}}
                <input type="hidden" name="_next" value="{{ route('home') }}">

                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-4 rounded-xl shadow-lg transform hover:-translate-y-1 transition-all">
                    <i class="fas fa-paper-plane mr-2"></i>Send Message Now
                </button>
            </form>
        </div>
    </div>
</section>
@endsection