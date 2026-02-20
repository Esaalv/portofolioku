<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    private function checkAuth()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        return null;
    }

    public function index()
    {
        if ($r = $this->checkAuth()) return $r;
        $projects = Project::where('user_id', session('admin_user_id'))
            ->orderBy('sort_order')->latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function trash()
    {
        if ($r = $this->checkAuth()) return $r;
        $projects = Project::where('user_id', session('admin_user_id'))
            ->onlyTrashed()->latest('deleted_at')->paginate(10);
        return view('admin.projects.trash', compact('projects'));
    }

    public function create()
    {
        if ($r = $this->checkAuth()) return $r;
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        if ($r = $this->checkAuth()) return $r;
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'detail' => 'nullable|string',
            'tech_stack' => 'nullable|string|max:500',
            'demo_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'status' => 'required|in:completed,in_progress,planned',
            'category' => 'required|string|max:100',
            'is_featured' => 'nullable|boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $validated['user_id'] = session('admin_user_id');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['slug'] = Str::slug($request->title) . '-' . Str::random(5);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($validated);
        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
    }

    public function edit($id)
    {
        if ($r = $this->checkAuth()) return $r;
        $project = Project::where('user_id', session('admin_user_id'))->findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        if ($r = $this->checkAuth()) return $r;
        $project = Project::where('user_id', session('admin_user_id'))->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'detail' => 'nullable|string',
            'tech_stack' => 'nullable|string|max:500',
            'demo_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'status' => 'required|in:completed,in_progress,planned',
            'category' => 'required|string|max:100',
            'is_featured' => 'nullable|boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            if ($project->image) Storage::disk('public')->delete($project->image);
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    public function destroy($id)
    {
        if ($r = $this->checkAuth()) return $r;
        $project = Project::where('user_id', session('admin_user_id'))->findOrFail($id);
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project moved to trash!');
    }

    public function restore($id)
    {
        if ($r = $this->checkAuth()) return $r;
        $project = Project::where('user_id', session('admin_user_id'))->onlyTrashed()->findOrFail($id);
        $project->restore();
        return redirect()->route('admin.projects.trash')->with('success', 'Project restored successfully!');
    }
}