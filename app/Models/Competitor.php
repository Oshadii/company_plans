<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    use HasFactory;
    protected $primaryKey='competitor_id';
    protected $fillable=[
        'id',
        'competitor_name',
        'competitor_strength',
        'competitor_weak',
        'counterpoint',
        'company_id'
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
