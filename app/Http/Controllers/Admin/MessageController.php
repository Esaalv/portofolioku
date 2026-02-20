<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private function checkAuth()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        return null;
    }

    public function index()
    {
        if ($r = $this->checkAuth()) return $r;
        $messages = Message::latest()->paginate(15);
        $unreadCount = Message::where('is_read', false)->count();
        return view('admin.messages.index', compact('messages', 'unreadCount'));
    }

    public function show($id)
    {
        if ($r = $this->checkAuth()) return $r;
        $message = Message::findOrFail($id);
        if (!$message->is_read) {
            $message->update(['is_read' => true, 'read_at' => now()]);
        }
        return view('admin.messages.show', compact('message'));
    }

    public function destroy($id)
    {
        if ($r = $this->checkAuth()) return $r;
        Message::findOrFail($id)->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully!');
    }

    public function markRead($id)
    {
        if ($r = $this->checkAuth()) return $r;
        Message::findOrFail($id)->update(['is_read' => true, 'read_at' => now()]);
        return back()->with('success', 'Message marked as read.');
    }
}