<?php

namespace App\Models\Tickets\Replies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reply extends Model
{
    use HasFactory;

    protected $table = 'ticket_replies';

    protected $fillable = ['message', 'ticket_id', 'user_id'];

    protected $searchables = ['message'];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Tickets\Ticket::class, 'ticket_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Users\User::class, 'user_id');
    }

    public function files(): HasMany
    {
        return $this->hasMany(\App\Models\Ticket\Replies\File::class, 'reply_id');
    }
}
