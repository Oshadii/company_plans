<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Engagement_touchpoint;

class Engagement_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'presence',
        'followership',
        'recency',
        'responsiveness',
        'competitor_analysis',
        'engagement_objective',
        'need_to_be_done',
        'key_result',
        'target_result',
        'budget_allocated',
        'engagement_touchpoint_id'

    ]; 
    public function Engagement_touchpoints(){
        return $this->belongsTo(Engagement_touchpoint::class);
    }
}
