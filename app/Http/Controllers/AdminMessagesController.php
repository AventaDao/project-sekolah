<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class AdminMessagesController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    public function reply(Request $request, Message $message)
    {
        $data = $request->validate([
            'reply' => 'required|string',
        ]);

        $message->update([
            'reply' => $data['reply'],
            'status' => 'replied',
            'replied_by' => auth()->id() ?? null,
            'replied_at' => Carbon::now(),
        ]);

        // Send reply email to user
        try {
            Mail::raw($data['reply'], function ($m) use ($message) {
                $m->to($message->email)
                  ->subject($message->support_id . ' - Balasan: ' . $message->subject);
            });
        } catch (\Exception $e) {
            return back()->with('status', 'Balasan disimpan, namun pengiriman email gagal.');
        }

        return back()->with('status', 'Balasan berhasil dikirim.');
    }
}
