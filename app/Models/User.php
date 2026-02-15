<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Book;
use App\Models\Wishlist;
use App\Models\Subscription;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ✅ User has many subscriptions
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    // ✅ User subscribed books
    public function subscribedBooks()
    {
        return $this->belongsToMany(Book::class, 'subscriptions', 'user_id', 'book_id')
                    ->withPivot('term', 'status')
                    ->wherePivot('status', 'active');
    }
}
