<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMaterials extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'projectID',
        'projectName',
        'materialID',
        'materialName',
        'quantity',
        'rate',
        'unit',
        'total',
        'date',
        'createdByID',
        'createdByName'
    ];
}
