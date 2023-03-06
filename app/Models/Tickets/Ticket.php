<?php

namespace App\Models\Tickets;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $table = 'tickets';

    protected $fillable = [
        'ticket_code', 'subject', 'description', 'is_follow_up', 'client_name',
        'client_email', 'client_phone', 'with_email', 'user_id', 'department_id',
        'type_id', 'status_id', 'priority_id', 'concern_id',
        'status_updated_at', 'resolved_at'
    ];

    protected $searchables = [
        'ticket_code', 'subject', 'description'
    ];

    protected $casts = [
        'status_updated_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Users\User::class, 'user_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Common\Department::class, 'department_id');
    }

    public function concern(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Tickets\Concern::class, 'concern_id');
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Tickets\Priority::class, 'priority_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Tickets\Status::class, 'status_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Tickets\Type::class, 'type_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(\App\Models\Tickets\Reply::class, 'ticket_id');
    }

    public function files(): HasMany
    {
        return $this->hasMany(\App\Models\Tickets\File::class, 'ticket_id');
    }
}
