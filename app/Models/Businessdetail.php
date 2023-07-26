<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Businessdetail extends Model
{
    use HasFactory;
    protected $primaryKey='b_id';
    protected $fillable=[
        'id',
        'purpose',
        'core_val',
        'team_structure',
        'product_offer',
        'service_offer',
        'pricing_model',
        'target_market',
        'buyer_pearsona',
        'location_analysis',
        'position',
        'acquisition',
        'marketing_tools',
        'sales_meth',
        'sales_structure',
        'sales_channel',
        'sales_tech',
        'leagal_structure',
        'legal_consideration',
        'startup_cost',
        'sales_forcast',
        'analysis',
        'projected_pl',
        'funding_require',
        'company_id'
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }

}
