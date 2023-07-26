<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Executive_Summary;
use Illuminate\Http\Request;

class E_SummaryController extends Controller
{
    public function storeSummary(Request $request){
        $com =Company::findOrFail($request->company_id);
        $com->business_plan_filled=true;
        $com->save();
        $company=$request->all();
        Executive_Summary::create($company);
        return 'Successfully saved details'; 
    }
    public function UpdateSummary(Request $request){
        $summary=Executive_Summary::find($request->summary_id);
        $input=$request->all();
        $summary->update($input);
    }
}
