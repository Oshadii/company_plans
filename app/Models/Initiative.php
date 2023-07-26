<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
class Initiative extends Model
{
    use HasFactory;
    protected $primaryKey='intitiative_id';
    protected $fillable=[
        'id',
        'descripion',
        'initiative_goal',
        'metrics_measure',
        'company_id'
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
