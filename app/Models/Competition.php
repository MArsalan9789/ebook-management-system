<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Submission;


class Competition extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'type',
        'end_date',
        'prize',
    ];


    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
