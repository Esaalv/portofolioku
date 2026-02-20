<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    private function checkAuth()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        return null;
    }

    public function index()
    {
        if ($r = $this->checkAuth()) return $r;
        $skills = Skill::where('user_id', session('admin_user_id'))
            ->orderBy('sort_order')->orderBy('category')->paginate(15);
        $categories = Skill::where('user_id', session('admin_user_id'))->distinct()->pluck('category');
        return view('admin.skills.index', compact('skills', 'categories'));
    }

    public function create()
    {
        if ($r = $this->checkAuth()) return $r;
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        if ($r = $this->checkAuth()) return $r;
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'level' => 'required|integer|min:1|max:100',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:20',
            'sort_order' => 'nullable|integer|min:0',
            'is_featured' => 'nullable|boolean',
        ]);
        $validated['user_id'] = session('admin_user_id');
        $validated['is_featured'] = $request->boolean('is_featured');
        Skill::create($validated);
        return redirect()->route('admin.skills.index')->with('success', 'Skill added successfully!');
    }

    public function edit($id)
    {
        if ($r = $this->checkAuth()) return $r;
        $skill = Skill::where('user_id', session('admin_user_id'))->findOrFail($id);
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, $id)
    {
        if ($r = $this->checkAuth()) return $r;
        $skill = Skill::where('user_id', session('admin_user_id'))->findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'level' => 'required|integer|min:1|max:100',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:20',
            'sort_order' => 'nullable|integer|min:0',
            'is_featured' => 'nullable|boolean',
        ]);
        $validated['is_featured'] = $request->boolean('is_featured');
        $skill->update($validated);
        return redirect()->route('admin.skills.index')->with('success', 'Skill updated successfully!');
    }

    public function destroy($id)
    {
        if ($r = $this->checkAuth()) return $r;
        $skill = Skill::where('user_id', session('admin_user_id'))->findOrFail($id);
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted successfully!');
    }
}