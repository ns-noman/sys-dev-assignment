<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'companyID',
        'projectID',
        'renterID',
        'flatName',
        'rent',
        'status',
    ];
}
