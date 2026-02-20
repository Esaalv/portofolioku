@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<!-- KPI Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-laptop-code text-blue-600"></i>
            </div>
            <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-full">Active</span>
        </div>
        <p class="text-3xl font-bold text-gray-800">{{ $stats['projects'] }}</p>
        <p class="text-sm text-gray-500 mt-1">Total Projects</p>
        <p class="text-xs text-blue-600 mt-2"><i class="fas fa-star"></i> {{ $stats['featured_projects'] }} featured</p>
    </div>
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 bg-purple-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-code-branch text-purple-600"></i>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-800">{{ $stats['skills'] }}</p>
        <p class="text-sm text-gray-500 mt-1">Total Skills</p>
        <p class="text-xs text-purple-600 mt-2"><i class="fas fa-layer-group"></i> {{ count($skillsByCategory) }} categories</p>
    </div>
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 bg-amber-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-certificate text-amber-600"></i>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-800">{{ $stats['certificates'] }}</p>
        <p class="text-sm text-gray-500 mt-1">Certificates</p>
        <p class="text-xs text-amber-600 mt-2"><i class="fas fa-award"></i> Professionally certified</p>
    </div>
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 bg-rose-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-envelope text-rose-600"></i>
            </div>
            @if($stats['unread_messages'] > 0)
                <span class="text-xs font-medium text-white bg-red-500 px-2 py-1 rounded-full">{{ $stats['unread_messages'] }} new</span>
            @endif
        </div>
        <p class="text-3xl font-bold text-gray-800">{{ $stats['messages'] }}</p>
        <p class="text-sm text-gray-500 mt-1">Messages</p>
        <p class="text-xs text-rose-600 mt-2"><i class="fas fa-bell"></i> {{ $stats['unread_messages'] }} unread</p>
    </div>
</div>

<!-- Charts -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-6">
    <!-- Monthly Messages Chart -->
    <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h3 class="font-semibold text-gray-800 mb-4">Monthly Messages ({{ date('Y') }})</h3>
        <canvas id="messagesChart" height="100"></canvas>
    </div>
    <!-- Projects by Category -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h3 class="font-semibold text-gray-800 mb-4">Projects by Category</h3>
        <canvas id="projectsChart" height="180"></canvas>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
    <!-- Recent Messages -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-800">Recent Messages</h3>
            <a href="{{ route('admin.messages.index') }}" class="text-indigo-600 text-sm hover:underline">View all</a>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($recentMessages as $msg)
            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                <div class="flex items-start justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-sm text-gray-800 {{ !$msg->is_read ? 'font-bold' : '' }}">{{ $msg->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ $msg->subject }}</p>
                    </div>
                    <div class="ml-3 text-right flex-shrink-0">
                        <p class="text-xs text-gray-400">{{ $msg->created_at->diffForHumans() }}</p>
                        @if(!$msg->is_read)<span class="inline-block w-2 h-2 bg-blue-500 rounded-full mt-1"></span>@endif
                    </div>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-gray-400 text-sm">No messages yet</div>
            @endforelse
        </div>
    </div>

    <!-- Recent Projects -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-800">Recent Projects</h3>
            <a href="{{ route('admin.projects.index') }}" class="text-indigo-600 text-sm hover:underline">View all</a>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($recentProjects as $project)
            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-sm text-gray-800 truncate">{{ $project->title }}</p>
                        <p class="text-xs text-gray-500">{{ $project->category }}</p>
                    </div>
                    <span class="ml-3 text-xs px-2 py-1 rounded-full flex-shrink-0
                        {{ $project->status === 'completed' ? 'bg-green-100 text-green-700' : ($project->status === 'in_progress' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700') }}">
                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                    </span>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-gray-400 text-sm">No projects yet</div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Monthly Messages Chart
    new Chart(document.getElementById('messagesChart'), {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [{
                label: 'Messages',
                data: {{ json_encode(array_values($monthlyData)) }},
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99,102,241,0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#6366f1',
                pointRadius: 4,
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
    });

    // Projects by Category Chart
    const projCategories = {!! json_encode(array_keys($projectsByCategory)) !!};
    const projValues = {!! json_encode(array_values($projectsByCategory)) !!};
    new Chart(document.getElementById('projectsChart'), {
        type: 'doughnut',
        data: {
            labels: projCategories,
            datasets: [{
                data: projValues,
                backgroundColor: ['#6366f1','#8b5cf6','#a78bfa','#c4b5fd','#3b82f6','#60a5fa'],
                borderWidth: 0,
            }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom', labels: { padding: 10, font: { size: 11 } } } }, cutout: '65%' }
    });
</script>
@endpush
