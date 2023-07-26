<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sratergytechnology extends Model
{
    use HasFactory;
    protected $primaryKey='stratergytech_id';
    protected $fillable=[
        'id',
        'product',
        'price',
        'promotion',
        'people',
        'process',
        'physical_evidence',
        'crm',
        'email_sw',
        'automation',
        'blogging',
        'admanage_sw',
        'social_media_manage',
        'vedio_host_sw',
        'company_id'
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
