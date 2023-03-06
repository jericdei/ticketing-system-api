<?php

namespace App\Models\Users;

use App\Traits\Queryable;
use App\Traits\Searchable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable, SoftDeletes, Searchable, Queryable;

    protected $table = 'users';

    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'username',
        'email', 'password', 'company_name', 'company_address',
        'position_id', 'department_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
    ];

    protected $searchables = [
        'first_name', 'middle_name', 'last_name', 'username', 'email',
    ];

    protected $allowedFields = [
        'id', 'first_name', 'middle_name', 'last_name', 'username',
        'email', 'password', 'company_name', 'company_address',
        'position_id', 'department_id', 'email_verified_at', 'last_login',
        'position.id', 'position.name', 'position.created_at', 'position.updated_at',
        'department.id', 'department.name', 'department.created_at', 'department.updated_at'
    ];

    protected $allowedFilters = [
        'first_name', 'middle_name', 'last_name', 'email', 'username'
    ];

    protected $allowedIncludes = [
        'position', 'department'
    ];

    public function position(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Users\Position::class, 'position_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Common\Department::class, 'department_id');
    }
}
