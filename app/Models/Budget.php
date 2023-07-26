<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;
    protected $primaryKey='budget_id';
    protected $fillable=[
        'id',
        'expense_name',
        'estimated_price',
        'company_id'
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
