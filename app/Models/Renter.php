<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renter extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'companyID',
        'projectID',
        'name',
        'contact',
        'email',
        'address',
        'password',
        'advance',
        'prevBal',
        'note',
    ];
}
