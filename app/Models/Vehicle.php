<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'chassis_module_id',
        'drive_module_id',
        'wheels_module_id',
        'steering_module_id',
        'seats_module_id',
    ];
    
    // Define relationships to fetch module details
    public function chassis(): BelongsTo
    {
        return $this->belongsTo(Module::class, 'chassis_module_id');
    }

    public function drive(): BelongsTo
    {
        return $this->belongsTo(Module::class, 'drive_module_id');
    }

    public function wheels(): BelongsTo
    {
        return $this->belongsTo(Module::class, 'wheels_module_id');
    }

    public function steering(): BelongsTo
    {
        return $this->belongsTo(Module::class, 'steering_module_id');
    }

    public function seats(): BelongsTo
    {
        return $this->belongsTo(Module::class, 'seats_module_id');
    }
    
    // You can also add accessors here to calculate total cost/time
    public function getTotalCostAttribute(): float
    {
        $cost = 0;
        foreach (['chassis', 'drive', 'wheels', 'steering', 'seats'] as $relation) {
            if ($this->$relation) {
                $cost += $this->$relation->cost;
            }
        }
        return $cost;
    }
}