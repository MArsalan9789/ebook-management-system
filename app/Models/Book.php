<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Mass assignment ke liye allowed fields
    protected $fillable = [
        'title',
        'author',
        'category',
        'price',
        'status',
        'file',
        'cover',
        'is_free',
        'preview_file',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
