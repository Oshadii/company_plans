<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\Businessdetail;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function storeBusinessDetails(Request $request){
        // dd($company);
        $alldetails=$request->all();
        Businessdetail::create($alldetails);
        // $company =Company::findOrFail($request->company_id);
        // $company->business_plan_filled=true;
        // $company->save();
        return redirect('/companylist')->with('message','business details stored successfully!!!!');
    }
}
