<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function index()
    {
        $user = User::first();
        $profile = $user ? Profile::where('user_id', $user->id)->first() : null;
        return view('frontend.contact', compact('profile'));
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email:rfc,dns|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:5|max:5000',
        ], [
            'email.email' => 'Format email tidak valid atau domain tidak ditemukan.',
            'message.min' => 'Pesan minimal harus 5 karakter.',
        ]);

       
        $validated['ip_address'] = $request->ip();
        Message::create($validated);

        try {
            
            
            $response = Http::withoutVerifying()->post(env('FORMSPREE_URL'), [
                'name'     => $request->name,
                'email'    => $request->email,
                'subject'  => $request->subject,
                'message'  => $request->message,
                '_subject' => 'Pesan Baru: ' . $request->subject,
            ]);

            if ($response->successful()) {
                return redirect()->route('contact')->with('success', 'Pesan Anda telah mendarat di email saya!');
            }
            
            // formspree
            return redirect()->route('contact')->with('success', 'Pesan tersimpan di sistem kami.');

        } catch (\Exception $e) {
           
            return redirect()->route('contact')->with('success', 'Terima kasih! Pesan Anda sudah terkirim ke database kami.');
        }
    }
}