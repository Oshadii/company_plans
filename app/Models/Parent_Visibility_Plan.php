<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Visibility_touchpoints;
class Parent_Visibility_Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'started_date',
        'end_date',
        'issubmitted'

    ];
    public function Visibility_touchpoints(){
        return $this->hasMany(Visibility_touchpoints::class,'parent_visibility_plan_id','id');
    } 
}
