<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    use HasFactory;

    // Add all fields jo mass assign karna hai
    protected $fillable = [
        'user_id',
        'book_id',
        'term',
        'status',
    ];

    // Optional: relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}

