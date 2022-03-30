<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'assignmentDate',
        'status',
        'isDue',
        'dueDate',
        'assignmentUserId',
        'assignedBy'
    ];
}
