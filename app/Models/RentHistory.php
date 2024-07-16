<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentHistory extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'companyID',
        'projectID',
        'flatID',
        'renterID',
        'rent',
        'from',
        'to',
    ];
}
