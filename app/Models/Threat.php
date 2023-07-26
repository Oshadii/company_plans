<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Threat extends Model
{
    use HasFactory;
    protected $primaryKey='threat_id';
    protected $fillable=[
        'id',
        'treat',
        'company_id'
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
