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
        'properties',
        'assembly_time_blocks',
        'cost',
        'image',
    ];

    // Cast the specific properties column to be handled as an array/object
    protected $casts = [
        'properties' => 'array',
        'cost' => 'decimal:2',
        'assembly_time_blocks' => 'integer',
        'cost' => 'decimal:2'
    ];

    public function getFormattedCostAttribute()
    {
        return '€' . number_format($this->cost, 2, ',', '.');
    }

    public function isChassis()
    {
        return $this->type === 'chassis';
    }

    public function isDrive()
    {
        return $this->type === 'drive';
    }
}
