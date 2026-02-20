<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/img/Favicon.png') }}?v={{ time() }}">
    <title>@yield('title', 'Portfolio') | {{ $profile->full_name ?? 'Esa Canoe Alvian Karim' }}</title>
    <meta name="description" content="@yield('description', 'Full Stack Web Developer - Laravel, Vue.js, React')">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 50:'#eff6ff',100:'#dbeafe',500:'#3b82f6',600:'#2563eb',700:'#1d4ed8',800:'#1e40af',900:'#1e3a8a' },
                        accent: { 400:'#a78bfa',500:'#8b5cf6',600:'#7c3aed' }
                    },
                    fontFamily: { sans: ['Inter','system-ui','sans-serif'] }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        .gradient-text { background: linear-gradient(135deg, #3b82f6, #8b5cf6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .hero-gradient { background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.15); }
        .nav-link { transition: color 0.2s ease; }
        .skill-bar { transition: width 1s ease-in-out; }
        .animate-fade-in { animation: fadeIn 0.6s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        html { scroll-behavior: smooth; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 font-sans antialiased">

<nav class="fixed top-0 w-full z-50 bg-white/90 backdrop-blur-sm border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-sm">AE</span>
                </div>
                <span class="font-bold text-gray-900 text-lg">{{ $profile->full_name ?? 'Esa Canoe Alvian Karim' }}</span>
            </a>
            
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="nav-link text-sm font-medium {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">Home</a>
                <a href="{{ route('about') }}" class="nav-link text-sm font-medium {{ request()->routeIs('about') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">About</a>
                <a href="{{ route('skills') }}" class="nav-link text-sm font-medium {{ request()->routeIs('skills') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">Skills</a>
                <a href="{{ route('projects') }}" class="nav-link text-sm font-medium {{ request()->routeIs('projects') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">Projects</a>
                <a href="{{ route('certificates') }}" class="nav-link text-sm font-medium {{ request()->routeIs('certificates') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">Certificates</a>
                <a href="{{ route('contact') }}" class="nav-link text-sm font-medium {{ request()->routeIs('contact') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">Contact</a>
                
                {{-- Tombol Admin Desktop --}}
                @if(session('admin_logged_in'))
                    <div class="flex items-center space-x-4 border-l pl-6 ml-2">
                        <a href="{{ route('admin.dashboard') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:shadow-lg transition-all">Admin Panel</a>
                        <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-red-600 text-sm font-medium transition-colors" title="Logout">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            <button id="menuBtn" class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <div id="mobileMenu" class="hidden md:hidden pb-4">
            <div class="flex flex-col space-y-2">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600">Home</a>
                <a href="{{ route('about') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600">About</a>
                <a href="{{ route('skills') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600">Skills</a>
                <a href="{{ route('projects') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600">Projects</a>
                <a href="{{ route('certificates') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600">Certificates</a>
                <a href="{{ route('contact') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600">Contact</a>
                
                {{-- Tombol Admin Mobile --}}
                @if(session('admin_logged_in'))
                    <hr class="my-2 border-gray-100">
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-medium bg-blue-600 text-white">Admin Panel</a>
                    <form action="{{ route('admin.logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50">Logout</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</nav>

<main class="pt-16">
    @yield('content')
</main>

<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
        <div class="md:col-span-2">
            <div class="flex items-center space-x-2 mb-4">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-sm">AE</span>
                </div>
                <span class="font-bold text-lg">{{ $profile->full_name ?? 'Esa Canoe Alvian Karim' }}</span>
            </div>
            <p class="text-gray-400 text-sm leading-relaxed mb-4">{{ $profile->bio ?? 'Full Stack Web Developer passionate about building elegant, scalable web solutions.' }}</p>
            <div class="flex space-x-3">
                <a href="{{ $profile->github ?? '#' }}" class="w-9 h-9 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:text-white hover:bg-blue-600 transition-all"><i class="fab fa-github"></i></a>
                <a href="{{ $profile->twitter ?? '#' }}" class="w-9 h-9 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:text-white hover:bg-sky-400 transition-all"><i class="fab fa-twitter"></i></a>
                {{-- Instagram & LinkedIn disembunyikan sesuai permintaan --}}
            </div>
        </div>
        <div>
            <h4 class="font-semibold text-sm uppercase tracking-wider text-gray-300 mb-4">Navigation</h4>
            <ul class="space-y-2">
                <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white text-sm transition-colors">Home</a></li>
                <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white text-sm transition-colors">About Me</a></li>
                <li><a href="{{ route('skills') }}" class="text-gray-400 hover:text-white text-sm transition-colors">Skills</a></li>
                <li><a href="{{ route('projects') }}" class="text-gray-400 hover:text-white text-sm transition-colors">Projects</a></li>
                <li><a href="{{ route('certificates') }}" class="text-gray-400 hover:text-white text-sm transition-colors">Certificates</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-semibold text-sm uppercase tracking-wider text-gray-300 mb-4">Contact</h4>
            <ul class="space-y-2">
                <li class="flex items-center space-x-2 text-gray-400 text-sm"><i class="fas fa-envelope w-4"></i><span>{{ $profile->email ?? 'admin@portfolio.com' }}</span></li>
                <li class="flex items-center space-x-2 text-gray-400 text-sm"><i class="fas fa-phone w-4"></i><span>{{ $profile->phone ?? '+62 812-3456-7890' }}</span></li>
                <li class="flex items-center space-x-2 text-gray-400 text-sm"><i class="fas fa-map-marker-alt w-4"></i><span>{{ $profile->location ?? 'Jakarta, Indonesia' }}</span></li>
                <li class="mt-3"><a href="{{ route('contact') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition-colors">Send Message</a></li>
            </ul>
        </div>
    </div>
    <div class="border-t border-gray-800 py-6 text-center">
        <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} {{ $profile->full_name ?? 'Esa Canoe Alvian Karim' }}. All rights reserved.</p>
    </div>
</footer>

<script>
    document.getElementById('menuBtn').addEventListener('click', function() {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    });
</script>
@stack('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Cek jika ada session success
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Oke'
        });
    @endif

    // Cek jika ada session error
    @if(session('error'))
        Swal.fire({
            title: 'Error!',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonText: 'Tutup'
        });
    @endif
</script>
</body>
</html>