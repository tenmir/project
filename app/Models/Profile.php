<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'second_name', 'bio','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
