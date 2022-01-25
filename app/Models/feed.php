<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feed extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'published_date',
        'link',
        'guid',
        'description'
    ];
}
