<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Engagement_detail;
use App\Models\Parent_Engagement;
class Engagement_touchpoint extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'parent_engagement_id',
        'engagement_touchpoint',
        'details_filled'

    ];
    public function Engagement_details(){
        return $this->hasOne(Engagement_detail::class,'engagement_touchpoint_id','id');
    } 
    public function Parent_Engagements(){
        return $this->belongsTo(Parent_Engagement::class);
    } 
}
