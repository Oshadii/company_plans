<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Visibility_touchpoints;
class Visibility_details extends Model
{
    use HasFactory;
    protected $fillable = [
        'current_status',
        'desired_status',
        'way_to_bridge_gap',
        'budget_allocated',
        'metrics_to_measure',
        'target_result',
        'other_resources',
        'touchpoint_id'

    ]; 
    public function Visibility_touchpoints(){
        return $this->belongsTo(Visibility_touchpoints::class);
    }
}
