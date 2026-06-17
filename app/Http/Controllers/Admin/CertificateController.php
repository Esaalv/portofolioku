<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    private function checkAuth()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        return null;
    }

    public function index()
    {
        if ($r = $this->checkAuth()) return $r;
        $certificates = Certificate::where('user_id', session('admin_user_id'))->latest()->paginate(10);
        return view('admin.certificates.index', compact('certificates'));
    }

    public function trash()
    {
        if ($r = $this->checkAuth()) return $r;
        $certificates = Certificate::where('user_id', session('admin_user_id'))
            ->onlyTrashed()->latest('deleted_at')->paginate(10);
        return view('admin.certificates.trash', compact('certificates'));
    }

    public function create()
    {
        if ($r = $this->checkAuth()) return $r;
        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        if ($r = $this->checkAuth()) return $r;
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'credential_id' => 'nullable|string|max:255',
            'credential_url' => 'nullable|url|max:255',
            'issued_date' => 'required|date',
            'expiry_date' => 'nullable|date|after:issued_date',
            'has_expiry' => 'nullable|boolean',
            'category' => 'required|string|max:100',
            'is_featured' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);
        $validated['user_id'] = session('admin_user_id');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['has_expiry'] = $request->boolean('has_expiry');
        
        if ($request->hasFile('image')) {
            try {
                $uploadedFile = cloudinary()->upload(
                    $request->file('image')->getRealPath(),
                    [
                        'folder' => 'portfolio/certificates',
                        'quality' => 'auto',
                        'overwrite' => true,
                        'resource_type' => 'auto'
                    ]
                );
                $validated['image'] = $uploadedFile['secure_url'];
            } catch (\Exception $e) {
                return back()->with('error', 'Failed to upload image: ' . $e->getMessage());
            }
        }
        
        Certificate::create($validated);
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate added successfully!');
    }

    public function edit($id)
    {
        if ($r = $this->checkAuth()) return $r;
        $certificate = Certificate::where('user_id', session('admin_user_id'))->findOrFail($id);
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, $id)
    {
        if ($r = $this->checkAuth()) return $r;
        $certificate = Certificate::where('user_id', session('admin_user_id'))->findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'credential_id' => 'nullable|string|max:255',
            'credential_url' => 'nullable|url|max:255',
            'issued_date' => 'required|date',
            'expiry_date' => 'nullable|date|after:issued_date',
            'has_expiry' => 'nullable|boolean',
            'category' => 'required|string|max:100',
            'is_featured' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['has_expiry'] = $request->boolean('has_expiry');
        
        if ($request->hasFile('image')) {
            try {
                $uploadedFile = cloudinary()->upload(
                    $request->file('image')->getRealPath(),
                    [
                        'folder' => 'portfolio/certificates',
                        'quality' => 'auto',
                        'overwrite' => true,
                        'resource_type' => 'auto'
                    ]
                );
                $validated['image'] = $uploadedFile['secure_url'];
            } catch (\Exception $e) {
                return back()->with('error', 'Failed to upload image: ' . $e->getMessage());
            }
        }
        
        $certificate->update($validated);
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate updated successfully!');
    }

    public function destroy($id)
    {
        if ($r = $this->checkAuth()) return $r;
        $certificate = Certificate::where('user_id', session('admin_user_id'))->findOrFail($id);
        $certificate->delete();
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate moved to trash!');
    }

    public function restore($id)
    {
        if ($r = $this->checkAuth()) return $r;
        $certificate = Certificate::where('user_id', session('admin_user_id'))->onlyTrashed()->findOrFail($id);
        $certificate->restore();
        return redirect()->route('admin.certificates.trash')->with('success', 'Certificate restored successfully!');
    }
}