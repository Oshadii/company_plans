<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Initiative;
use Illuminate\Http\Request;

class InitiativeController extends Controller
{
    public function storeInitiativeDetails(Request $request){
        // dd($request->company_id);
        // $company =Company::findOrFail($request->company_id);
        // dd($company);
        $business_initiatives=$request->all();
        Initiative::create($business_initiatives);
        $initiatives=Initiative::where('company_id',$request->company_id)->get();
        return ['Business Initiatives Saved Successfully',$initiatives]; 
    }

    public function UpdateInitiativeDetails(Request $request){
        $initiative=Initiative::find($request->intitiative_id);
        $input=$request->all();
        $initiative->update($input);
    }
    public function delete_added_initiative($id) {
        // return $id;
        $query = Initiative::findOrFail($id);
        $query->delete();
        return 'Initiative deleted';
    }
}
