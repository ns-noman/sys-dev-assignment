<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'projectID',
        'projectName',
        'expenseHeadID',
        'expenseHeadName',
        'amount',
        'note',
        'date',
        'createdByID',
        'createdByName',
    ];
}
