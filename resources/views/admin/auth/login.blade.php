<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap'); body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-900 via-indigo-950 to-gray-900 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl mb-4 shadow-lg">
                <i class="fas fa-code text-white text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-white">Portfolioku</h1>
            <p class="text-gray-400 text-sm mt-1">Sign in to manage your portfolio</p>
        </div>

        <!-- Credentials hint
        <div class="bg-indigo-900/40 border border-indigo-700/50 rounded-xl p-4 mb-6">
            <p class="text-indigo-300 text-xs font-semibold uppercase tracking-wider mb-2"><i class="fas fa-key mr-1"></i> Demo Credentials</p>
            <div class="space-y-1">
                <p class="text-gray-300 text-sm"><span class="text-gray-500">Email:</span> <span class="font-mono text-indigo-300">admin@portfolio.com</span></p>
                <p class="text-gray-300 text-sm"><span class="text-gray-500">Password:</span> <span class="font-mono text-indigo-300">password123</span></p>
            </div>
        </div> -->

        <!-- Login Form -->
        <div class="bg-white/10 backdrop-blur-sm border border-white/10 rounded-2xl p-8">
            @if($errors->any())
                <div class="mb-4 bg-red-500/20 border border-red-500/30 text-red-300 px-4 py-3 rounded-xl text-sm">
                    <i class="fas fa-exclamation-triangle mr-1"></i> {{ $errors->first() }}
                </div>
            @endif
            @if(session('success'))
                <div class="mb-4 bg-green-500/20 border border-green-500/30 text-green-300 px-4 py-3 rounded-xl text-sm">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-500"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full bg-white/10 border border-white/20 text-white placeholder-gray-500 rounded-xl pl-10 pr-4 py-3 text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                            placeholder="Enter your email">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-500"></i>
                        </div>
                        <input type="password" name="password" required
                            class="w-full bg-white/10 border border-white/20 text-white placeholder-gray-500 rounded-xl pl-10 pr-4 py-3 text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                            placeholder="••••••••">
                    </div>
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold py-3 rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-indigo-500/25">
                    <i class="fas fa-sign-in-alt mr-2"></i>Sign In to Admin Panel
                </button>
            </form>
        </div>
        <p class="text-center text-gray-500 text-sm mt-6">
            <a href="{{ route('home') }}" class="hover:text-gray-300 transition-colors"><i class="fas fa-arrow-left mr-1"></i>Back to Portfolio</a>
        </p>
    </div>
</body>
</html>
