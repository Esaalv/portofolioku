<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Certificate;
use App\Models\User;

class HomeController extends Controller
{
    private function getUser()
    {
        return User::first();
    }

    public function index()
    {
        $user = $this->getUser();
        $profile = $user ? Profile::where('user_id', $user->id)->first() : null;
        $featuredProjects = $user ? Project::where('user_id', $user->id)->where('is_featured', true)->latest()->take(3)->get() : collect();
        $featuredSkills = $user ? Skill::where('user_id', $user->id)->where('is_featured', true)->orderBy('sort_order')->take(6)->get() : collect();
        $featuredCertificates = $user ? Certificate::where('user_id', $user->id)->where('is_featured', true)->latest()->take(3)->get() : collect();
        return view('frontend.home', compact('profile', 'featuredProjects', 'featuredSkills', 'featuredCertificates'));
    }

    public function about()
    {
        $user = $this->getUser();
        $profile = $user ? Profile::where('user_id', $user->id)->first() : null;
        $skills = $user ? Skill::where('user_id', $user->id)->orderBy('category')->orderBy('sort_order')->get()->groupBy('category') : collect();
        return view('frontend.about', compact('profile', 'skills'));
    }

    public function skills()
    {
        $user = $this->getUser();
        $profile = $user ? Profile::where('user_id', $user->id)->first() : null;
        $skills = $user ? Skill::where('user_id', $user->id)->orderBy('sort_order')->get()->groupBy('category') : collect();
        return view('frontend.skills', compact('profile', 'skills'));
    }

    public function projects()
    {
        $user = $this->getUser();
        $profile = $user ? Profile::where('user_id', $user->id)->first() : null;
        $projects = $user ? Project::where('user_id', $user->id)->latest()->paginate(6) : collect();
        $categories = $user ? Project::where('user_id', $user->id)->distinct()->pluck('category') : collect();
        return view('frontend.projects', compact('profile', 'projects', 'categories'));
    }

    public function projectDetail($id)
    {
        $user = $this->getUser();
        $profile = $user ? Profile::where('user_id', $user->id)->first() : null;
        $project = Project::findOrFail($id);
        $related = Project::where('user_id', $project->user_id)
            ->where('category', $project->category)
            ->where('id', '!=', $project->id)
            ->take(3)->get();
        return view('frontend.project-detail', compact('profile', 'project', 'related'));
    }

    public function certificates()
    {
        $user = $this->getUser();
        $profile = $user ? Profile::where('user_id', $user->id)->first() : null;
        $certificates = $user ? Certificate::where('user_id', $user->id)->latest()->paginate(9) : collect();
        return view('frontend.certificates', compact('profile', 'certificates'));
    }
}