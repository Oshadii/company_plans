<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Sratergytechnology;
use Illuminate\Http\Request;

class StratergyAndTechnologyController extends Controller
{
    public function storeStratergyAndTechnology(Request $request){
        // dd($request->company_id);
       
        // dd($company);
        $alldetails=$request->all();
        Sratergytechnology::create($alldetails);
        $company =Company::findOrFail($request->company_id);
        $company->market_plan_filled=true;
        $company->save();
        return redirect('/companylist')->with('message','marketing plan saved successfully!!!'); 
    }
}
