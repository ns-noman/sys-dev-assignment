<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostUpdate extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'postID',
        'updateNo',
        'userID',
        'title',
        'description1',
        'description2',
        'description3',
    ];
}
