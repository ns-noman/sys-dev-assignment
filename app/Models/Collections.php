<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collections extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'clientID',
        'projectID',
        'flatID',
        'date',
        'amount',
        'transactionMethod',
        'note',
        'createdByID',
        'createdByName',
        'status',
    ];
}
