<?php

namespace App\Models;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'picture',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function searchByName($query)
    {
        return self::where('title', 'like', '%' . $query . '%')->get();
    }

}