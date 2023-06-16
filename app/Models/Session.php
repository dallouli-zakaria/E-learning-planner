<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Session extends Model
{
    use HasFactory;
    protected $table = 'session';

    public function prof(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function matier(): BelongsTo
    {
        return $this->belongsTo(Matier::class, 'matier_id', 'id');
    }


    public function students(): HasMany
    {
        return $this->hasMany(SessionUser::class);
    }
}
