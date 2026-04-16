<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'old_status',
        'new_status',
        'note',
        'actor'
    ];

    // 🔥 relasi ke ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}