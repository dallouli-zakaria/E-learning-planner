<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionUser extends Model
{
    use HasFactory;
    protected $table = 'user_session';

    protected $fillable = [
        'user_id',
        'session_id',
        'attended',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class, 'session_id', 'id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
