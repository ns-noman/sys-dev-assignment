<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDetails extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'masterID',
        'checkListID'
    ];
}
