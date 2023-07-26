<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Competitor;
use Illuminate\Http\Request;

class CompetitorController extends Controller
{
    public function storeCompetitor(Request $request){
        // dd($request->company_id);
        // $company =Company::findOrFail($request->company_id);
        // dd($company);
        $company=$request->all();
        Competitor::create($company);
        $competitors=Competitor::where('company_id',$request->company_id)->get();
        return ['Competitor saved successfully',$competitors]; 
    }
    public function UpdateCompetitor(Request $request){
        $competitor=Competitor::find($request->competitor_id);
        $input=$request->all();
        $competitor->update($input);
        return 'Competitor updated';
    }
    public function delete_added_competitor($id) {
        $query = Competitor::findOrFail($id);
        $query->delete();
        return 'Prepared_by deleted';
    }
}
