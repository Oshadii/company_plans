<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Visibility_details;
use App\Models\Parent_Visibility_Plan;

class Visibility_touchpoints extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'parent_visibility_plan_id',
        'touchpoint',
        'details_filled'

    ];
    public function Visibility_details(){
        return $this->hasOne(Visibility_details::class,'touchpoint_id','id');
    }
    public function Parent_Visibility_Plan(){
        return $this->belongsTo(Parent_Visibility_Plan::class);
    }  

}
