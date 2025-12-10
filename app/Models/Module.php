<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'assembly_time_blocks',
        'cost',
        'image_path',
        'properties',
    ];

    // Cast the specific properties column to be handled as an array/object
    protected $casts = [
        'properties' => 'array', 
        'cost' => 'decimal:2',
        'assembly_time_blocks' => 'integer',
    ];
}