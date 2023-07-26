<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;


class Industry extends Model
{
    use HasFactory;
    protected $primaryKey='industry_id';
    protected $fillable=[
        'id',
        'industry',
        'description',
        'company_id'
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
