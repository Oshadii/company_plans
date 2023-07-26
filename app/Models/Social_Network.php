<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social_Network extends Model
{
    use HasFactory;
    protected $primaryKey='network_id';
    protected $fillable=[
        'id',
        'network_purpose',
        'network_metrics',
        'company_id'
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
