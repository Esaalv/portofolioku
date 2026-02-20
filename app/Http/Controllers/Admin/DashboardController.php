<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Certificate;
use App\Models\Message;
use App\Models\Profile;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $userId = session('admin_user_id');

        $stats = [
            'skills' => Skill::where('user_id', $userId)->count(),
            'projects' => Project::where('user_id', $userId)->count(),
            'certificates' => Certificate::where('user_id', $userId)->count(),
            'messages' => Message::count(),
            'unread_messages' => Message::where('is_read', false)->count(),
            'featured_projects' => Project::where('user_id', $userId)->where('is_featured', true)->count(),
        ];

        $profile = Profile::where('user_id', $userId)->first();

        $skillsByCategory = Skill::where('user_id', $userId)
            ->selectRaw('category, count(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category')
            ->toArray();

        $projectsByCategory = Project::where('user_id', $userId)
            ->selectRaw('category, count(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category')
            ->toArray();

        $projectsByStatus = Project::where('user_id', $userId)
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $recentMessages = Message::latest()->take(5)->get();
        $recentProjects = Project::where('user_id', $userId)->latest()->take(5)->get();

        $monthlyMessages = Message::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[] = $monthlyMessages[$i] ?? 0;
        }

        return view('admin.dashboard', compact(
            'stats', 'profile', 'skillsByCategory', 'projectsByCategory',
            'projectsByStatus', 'recentMessages', 'recentProjects', 'monthlyData'
        ));
    }
}