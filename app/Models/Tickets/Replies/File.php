<?php

namespace App\Models\Tickets\Replies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    use HasFactory;

    protected $table = 'ticket_reply_files';

    protected $fillable = ['name', 'path', 'ticket_reply_id'];

    public function reply(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Ticket\Reply::class);
    }
}
