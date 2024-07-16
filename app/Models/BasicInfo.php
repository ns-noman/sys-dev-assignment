<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicInfo extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'companyID',
        'title',
        'email',
        'phone',
        'address',
        'logo',
    ];
}
