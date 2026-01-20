<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Services\ActivityLogger;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use App\Mail\ReplyMessageMail;

class AdminMessagesController extends Controller
{
    protected $activityLogger;

    public function __construct(ActivityLogger $activityLogger)
    {
        $this->activityLogger = $activityLogger;
    }
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

        // Log support reply to Firebase
        $this->activityLogger->logSupport('reply_contact', $message->support_id, [
            'support_id' => $message->support_id,
            'replied_to_email' => $message->email,
            'replied_to_name' => $message->name,
            'reply_status' => 'replied',
            'replied_by_id' => auth()->id(),
            'replied_by' => auth()->user()?->name
        ]);

        // Send reply email to user with styled template
        try {
            Mail::to($message->email)->send(new ReplyMessageMail($message, $data['reply'], $message->support_id));
            return back()->with('status', 'Balasan berhasil dikirim.');
        } catch (\Exception $e) {
            \Log::error('Email reply failed: ' . $e->getMessage());
            return back()->with('status', 'Balasan disimpan, namun pengiriman email gagal: ' . $e->getMessage());
        }
    }
}
