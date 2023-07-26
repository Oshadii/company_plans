<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Author extends Model
{
    use HasFactory;
    protected $primaryKey='author_id';
    protected $fillable=[
        'name',
        'email',
        'company_id'
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
