<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Strength extends Model
{
    use HasFactory;
    protected $primaryKey='strength_id';
    protected $fillable=[
        'id',
        'strength',
        'company_id'
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
