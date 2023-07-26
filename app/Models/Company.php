<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Marketingleader;
use App\Models\Businessdetail;
use App\Models\Author;
use App\Models\Initiative;
use App\Models\Industry;
use App\Models\Pearsona;
use App\Models\Competitive;
use App\Models\Strength;
use App\Models\Weak;
use App\Models\Oppotunity;
use App\Models\Threat;
use App\Models\Sratergytechnology;
use App\Models\Social_Network;
use App\Models\Website_Publication;
use App\Models\Budget;
use App\Models\Prepared_by;
use App\Models\Competitor;
use App\Models\Executive_Summary;





class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
        'telephone',
        'address',
        'objective',
        'vision',
        'location_hq',
        'location_satellite',
        'mission',
        'goal',
        'email',
        'current_year',
        'business_plan_filled',
        'market_plan_filled'
    ];
    
    public function Businessdetails(){
        return $this->hasOne(Businessdetail::class,'company_id','b_id');
    }
    public function Marketingleaders(){
        return $this->hasMany(Marketingleader::class,'company_id','id');
    }
    public function Authors(){
        return $this->hasMany(Author::class,'company_id','author_id');
    }
    public function Initiatives(){
        return $this->hasMany(Initiative::class,'company_id','intitiative_id');
    }
    public function Industries(){
        return $this->hasMany(Industry::class,'company_id','industry_id');
    }
    public function Pearsonas(){
        return $this->hasMany(Pearsona::class,'company_id','persona_id');
    }
    public function Competitives(){
        return $this->hasMany(Competitive::class,'company_id','competitive_id');
    }
    public function Strengths(){
        return $this->hasMany(Strength::class,'company_id','strength_id');
    }
    public function Weaks(){
        return $this->hasMany(Weak::class,'company_id','weak_id');
    }
    public function Oppotunities(){
        return $this->hasMany(Oppotunity::class,'company_id','oppotunity_id');
    }
    public function Threats(){
        return $this->hasMany(Threat::class,'company_id','threat_id');
    }
    public function Sratergytechnologies(){
        return $this->hasMany(Sratergytechnology::class,'company_id','stratergytech_id');
    }
    public function Social_Networks(){
        return $this->hasMany(Social_Network::class,'company_id','network_id');
    }
    public function Website_Publications(){
        return $this->hasMany(Website_Publication::class,'company_id','website_id');
    }
    public function Budgets(){
        return $this->hasMany(Budget::class,'company_id','budget_id');
    }
    public function Prepared_bies(){
        return $this->hasMany(Prepared_by::class,'company_id','prepared_by_id');
    }
    public function Competitors(){
        return $this->hasMany(Competitor::class,'company_id','competitor_id');
    }
    public function Executive_Summaries(){
        return $this->hasMany(Executive_Summary::class,'company_id','summary_id');
    }

    // $abc=Abc::with('Sratergytechnologies')->where('id',1)->get();
}
