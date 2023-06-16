<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Matier extends Model
{
    use HasFactory;
    protected $table = 'matier';

    protected $fillable = [
        'title'
    ];



    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }

}
