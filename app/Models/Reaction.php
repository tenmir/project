<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'type',
        'reactions_type_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function reactionsType()
    {
        return $this->belongsTo(ReactionsType::class);
    }
}
