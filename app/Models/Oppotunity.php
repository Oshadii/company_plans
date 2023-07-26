<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oppotunity extends Model
{
    use HasFactory;
    protected $primaryKey='oppotunity_id';
    protected $fillable=[
        'id',
        'oppotunity',
        'company_id'
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
