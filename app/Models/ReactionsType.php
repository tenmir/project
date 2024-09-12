<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReactionsType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
    ];

    public function reaction()
    {
        return $this->belongsTo(Reaction::class);
    }
}
