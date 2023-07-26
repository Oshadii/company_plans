<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website_Publication extends Model
{
    use HasFactory;
    protected $primaryKey='website_id';
    protected $fillable=[
        'id',
        'website_purpose',
        'website_metrics',
        'company_id'
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
