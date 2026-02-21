<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; 

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
        // brevo
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:5|max:5000',
        ]);

        // save in dashboard
        $validated['ip_address'] = $request->ip();
        \App\Models\Message::create($validated);

        // send via smtp server
        try {
            \Illuminate\Support\Facades\Http::withHeaders([
                'api-key' => env('BREVO_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.brevo.com/v3/smtp/email', [
                'sender' => ['name' => 'alviesa', 'email' => 'esacanoealviank@gmail.com'],
                'to' => [['email' => 'esacanoealviank@gmail.com']],
                'subject' => 'Pesan Baru: ' . $request->subject,
                'textContent' => "Dari: {$request->name} ({$request->email})\n\n{$request->message}"
            ]);

            return redirect()->route('contact')->with('success', 'Terima Kasih Telah Menghubungi!');

        } catch (\Exception $e) {
            // Server Notif
            return redirect()->route('contact')->with('success', 'Pesan Telah diterima terima kasih.');
        }
    }
}