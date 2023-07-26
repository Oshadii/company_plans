<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Engagement_touchpoint;
class Parent_Engagement extends Model
{
    use HasFactory;
    protected $fillable = [
        'started_date',
        'end_date',
        'issubmitted'

    ];
    public function Engagement_touchpoints(){
        return $this->hasMany(Engagement_touchpoint::class,'parent_engagement_id','id');
    } 
}
