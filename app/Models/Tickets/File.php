<?php

namespace App\Models\Tickets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    use HasFactory;

    protected $table = 'ticket_files';

    protected $fillable = ['name', 'path', 'ticket_id'];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Tickets\Ticket::class, 'ticket_id');
    }
}
