<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'support_id', 'name', 'email', 'phone', 'category', 'subject', 'message', 'status', 'reply', 'replied_by', 'replied_at'
    ];

    protected $casts = [
        'replied_at' => 'datetime',
    ];
}
