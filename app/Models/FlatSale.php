<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlatSale extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'clientID',
        'clientName',
        'projectID',
        'projectName',
        'flatID',
        'flatName',
        'bookingAmount',
        'totalPrice',
        'installmentTotal',
        'numOfInstallment',
        'perInstallment',
        'date',
        'instStartingDate',
        'note',
        'createdByID',
        'createdByName',  
        'resale',  
    ];
}
