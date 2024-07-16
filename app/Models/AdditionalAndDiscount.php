<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalAndDiscount extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'clientID',
        'projectID',
        'flatID',
        'date',
        'additional',
        'discount',
        'transactionMethod',
        'note',
        'createdByID',
        'createdByName',
        'status',
    ];
}
