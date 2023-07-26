<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Industry;
use App\Models\Pearsona;
use App\Models\Competitive;


class TargetMarketController extends Controller
{
    public function storeIndustryDetails(Request $request){
        $industry=$request->all();
        Industry::create($industry);
        $industries=Industry::where('company_id',$request->company_id)->get();
        return ['Industry Details Saved Successfully',$industries]; 
    }
    public function storePersonaDetails(Request $request){
        $buyerpeasonar=$request->all();
        Pearsona::create($buyerpeasonar);
        $pearsonas=Pearsona::where('company_id',$request->company_id)->get();
        return ['Buyer pearsona Details Saved',$pearsonas]; 
    }
    public function storeCompetitiveDetails(Request $request){
        // dd($request->company_id);
        // $company =Company::findOrFail($request->company_id);
        // dd($company);
        $all_competitive=$request->all();
        Competitive::create($all_competitive);
        $competitives=Competitive::where('company_id',$request->company_id)->get();
        return ['Competitive Details saved Successfully',$competitives]; 
    }

    public function UpdateIndustryDetails(Request $request){
        $industry=Industry::find($request->industry_id);
        $input=$request->all();
        $industry->update($input);
    }
    public function UpdatePersonaDetails(Request $request){
        $pearsona=Pearsona::find($request->persona_id);
        $input=$request->all();
        $pearsona->update($input);
    }
    public function UpdateCompetitiveDetails(Request $request){
        $competitive=Competitive::find($request->competitive_id);
        // return $competitive;
        $input=$request->all();
        $competitive->update($input);
    }
    public function delete_added_industry($id) {
        $query = Industry::findOrFail($id);
        $query->delete();
        return 'Industry deleted';
    }
    public function delete_added_pearsona($id) {
        $query = Pearsona::findOrFail($id);
        $query->delete();
        return 'pearsona detail deleted';
    }
    public function delete_added_competitive($id) {
        $query = Competitive::findOrFail($id);
        $query->delete();
        return 'Competitive detail deleted';
    }
}
