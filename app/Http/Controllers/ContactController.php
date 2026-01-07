<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Message;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'category' => 'required|string|max:100',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'consent' => 'accepted',
        ]);

        // Generate unique support ID
        $supportId = '#support' . str_pad(Message::count() + 1, 5, '0', STR_PAD_LEFT);

        // Simpan pesan ke database
        $message = Message::create([
            'support_id' => $supportId,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'category' => $data['category'] ?? null,
            'subject' => $data['subject'],
            'message' => $data['message'],
            'status' => 'new',
        ]);

        $to = config('mail.from.address', env('MAIL_FROM_ADDRESS', 'admin@example.com'));

        $body = "Pesan dari: {$data['name']} ({$data['email']})\nTelepon: " . ($data['phone'] ?? '-') . "\nKategori: {$data['category']}\n\nSubjek: {$data['subject']}\n\nPesan:\n{$data['message']}";

        try {
            Mail::raw($body, function ($m) use ($to, $data, $supportId) {
                $m->to($to)
                  ->subject($supportId . ' - ' . $data['subject'])
                  ->replyTo($data['email'], $data['name']);
            });
        } catch (\Exception $e) {
            // tetap sukses karena pesan sudah disimpan
            return back()->with('status', 'Pesan disimpan, namun pengiriman email gagal.');
        }

        return back()->with('status', 'Pesan berhasil dikirim. Terima kasih.');
    }
}
