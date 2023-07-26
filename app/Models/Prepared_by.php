<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prepared_by extends Model
{
    use HasFactory;
    protected $primaryKey='prepared_by_id';
    protected $fillable=[
        'id',
        'name',
        'email',
        'role',
        'company_id'
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
