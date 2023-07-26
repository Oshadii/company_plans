<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Competitive extends Model
{
    use HasFactory;
    protected $primaryKey='competitive_id';
    protected $fillable=[
        'id',
        'company',
        'complete_product',
        'other_ways',
        'company_id'
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
