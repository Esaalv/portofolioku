<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    private function checkAuth()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        return null;
    }

    public function index()
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $profile = Profile::where('user_id', session('admin_user_id'))->first();
        return view('admin.profile.index', compact('profile'));
    }

    public function create()
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $profile = Profile::where('user_id', session('admin_user_id'))->first();
        if ($profile) return redirect()->route('admin.profile.edit')->with('info', 'Profile already exists. Edit it instead.');
        return view('admin.profile.create');
    }

    public function store(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:500',
            'bio' => 'required|string',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:30',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'years_experience' => 'nullable|integer|min:0',
            'projects_completed' => 'nullable|integer|min:0',
            'clients_served' => 'nullable|integer|min:0',
            'available_for_hire' => 'nullable|boolean',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'resume' => 'nullable|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }
        if ($request->hasFile('resume')) {
            $validated['resume'] = $request->file('resume')->store('resumes', 'public');
        }

        $validated['user_id'] = session('admin_user_id');
        $validated['available_for_hire'] = $request->boolean('available_for_hire');
        Profile::create($validated);

        return redirect()->route('admin.profile.index')->with('success', 'Profile created successfully!');
    }

    public function edit()
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $profile = Profile::where('user_id', session('admin_user_id'))->firstOrFail();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;
        $profile = Profile::where('user_id', session('admin_user_id'))->firstOrFail();

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:500',
            'bio' => 'required|string',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:30',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'years_experience' => 'nullable|integer|min:0',
            'projects_completed' => 'nullable|integer|min:0',
            'clients_served' => 'nullable|integer|min:0',
            'available_for_hire' => 'nullable|boolean',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'resume' => 'nullable|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('avatar')) {
            if ($profile->avatar) Storage::disk('public')->delete($profile->avatar);
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }
        if ($request->hasFile('resume')) {
            if ($profile->resume) Storage::disk('public')->delete($profile->resume);
            $validated['resume'] = $request->file('resume')->store('resumes', 'public');
        }

        $validated['available_for_hire'] = $request->boolean('available_for_hire');
        $profile->update($validated);

        return redirect()->route('admin.profile.index')->with('success', 'Profile updated successfully!');
    }
}