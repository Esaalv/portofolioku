<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // WAJIB ADA

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
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:5|max:5000',
        ]);

        $validated['ip_address'] = $request->ip();
        
    
        Message::create($validated);

        // Send Email via SMTP Brevo
        try {
            Mail::raw("Pesan Baru dari: " . $request->name . "\nEmail: " . $request->email . "\nSubject: " . $request->subject . "\n\nIsi Pesan:\n" . $request->message, function ($message) use ($request) {
                $message->to('esacanoealviank@gmail.com') // Email tujuan
                        ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                        ->subject('New Contact: ' . $request->subject);
            });

            return redirect()->route('contact')->with('success', 'Pesan tersimpan dan email terkirim!');

        } catch (\Exception $e) {
            // Jika email gagal tapi database berhasil
            return redirect()->route('contact')->with('success', 'Pesan tersimpan di dashboard (Email gagal: ' . $e->getMessage() . ')');
        }
    }
}