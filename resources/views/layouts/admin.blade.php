<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | Portfolio Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .sidebar-link { transition: all 0.2s ease; }
        .sidebar-link:hover, .sidebar-link.active { background: rgba(99,102,241,0.15); color: #818cf8; }
        .sidebar-link.active { border-left: 3px solid #6366f1; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100">
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 flex flex-col flex-shrink-0">
        <div class="p-5 border-b border-gray-800">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                <div class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-code text-white text-sm"></i>
                </div>
                <div>
                    <p class="text-white font-bold text-sm">Portfolio Admin</p>
                    <p class="text-gray-400 text-xs">{{ session('admin_user', 'Admin') }}</p>
                </div>
            </a>
        </div>
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider px-3 mb-2">Main</p>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-300 text-sm">
                <i class="fas fa-tachometer-alt w-4"></i><span>Dashboard</span>
            </a>
            <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider px-3 mb-2 mt-4">Content</p>
            <a href="{{ route('admin.profile.index') }}" class="sidebar-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }} flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-300 text-sm">
                <i class="fas fa-user w-4"></i><span>Profile</span>
            </a>
            <a href="{{ route('admin.skills.index') }}" class="sidebar-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }} flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-300 text-sm">
                <i class="fas fa-code-branch w-4"></i><span>Skills</span>
            </a>
            <a href="{{ route('admin.projects.index') }}" class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }} flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-300 text-sm">
                <i class="fas fa-laptop-code w-4"></i><span>Projects</span>
            </a>
            <a href="{{ route('admin.certificates.index') }}" class="sidebar-link {{ request()->routeIs('admin.certificates.*') ? 'active' : '' }} flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-300 text-sm">
                <i class="fas fa-certificate w-4"></i><span>Certificates</span>
            </a>
            <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider px-3 mb-2 mt-4">Communication</p>
            <a href="{{ route('admin.messages.index') }}" class="sidebar-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }} flex items-center justify-between px-3 py-2.5 rounded-lg text-gray-300 text-sm">
                <div class="flex items-center space-x-3"><i class="fas fa-envelope w-4"></i><span>Messages</span></div>
                @php $unread = \App\Models\Message::where('is_read',false)->count(); @endphp
                @if($unread > 0)<span class="bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ $unread }}</span>@endif
            </a>
            <div class="border-t border-gray-800 mt-4 pt-4">
                <a href="{{ route('home') }}" target="_blank" class="sidebar-link flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-400 text-sm">
                    <i class="fas fa-external-link-alt w-4"></i><span>View Portfolio</span>
                </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="sidebar-link w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-400 text-sm hover:text-red-400">
                        <i class="fas fa-sign-out-alt w-4"></i><span>Logout</span>
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top bar -->
        <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between flex-shrink-0">
            <h1 class="text-xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-500">{{ date('l, d F Y') }}</span>
                <div class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                    <span class="text-white text-sm font-bold">{{ strtoupper(substr(session('admin_user', 'A'), 0, 1)) }}</span>
                </div>
            </div>
        </header>

        <!-- Content area -->
        <main class="flex-1 overflow-y-auto p-6">
            @if(session('success'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center justify-between">
                    <div class="flex items-center"><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</div>
                    <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700"><i class="fas fa-times"></i></button>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center justify-between">
                    <div class="flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}</div>
                    <button onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700"><i class="fas fa-times"></i></button>
                </div>
            @endif
            @if(session('info'))
                <div class="mb-4 bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-xl flex items-center justify-between">
                    <div class="flex items-center"><i class="fas fa-info-circle mr-2"></i>{{ session('info') }}</div>
                    <button onclick="this.parentElement.remove()" class="text-blue-500 hover:text-blue-700"><i class="fas fa-times"></i></button>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>
@stack('scripts')
</body>
</html>
