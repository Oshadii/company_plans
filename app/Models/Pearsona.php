<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Pearsona extends Model
{
    use HasFactory;
    protected $primaryKey='persona_id';
    protected $fillable=[
        'id',
        'persona',
        'descript',
        'company_id'
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
