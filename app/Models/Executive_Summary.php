<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Executive_Summary extends Model
{
    use HasFactory;
    protected $primaryKey='summary_id';
    protected $fillable=[
        'id',
        'history',
        'over_view',
        'financial_project',
        'investors',
        'company_id'
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
