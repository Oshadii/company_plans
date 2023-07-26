<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Prepared_by;
use Illuminate\Http\Request;

class Prepared_byController extends Controller
{
    public function storePreparedBy(Request $request){
        $company=$request->all();
        Prepared_by::create($company);
        $prepared=Prepared_by::where('company_id',$request->company_id)->get();
        return ['Details saved successfully',$prepared]; 
    }

    public function UpdatePreparedBy(Request $request){
        $prepared_by=Prepared_by::find($request->prepared_by_id);
        $input=$request->all();
        $prepared_by->update($input);
    }
    public function delete_added_prepared_by($id) {
        $query = Prepared_by::findOrFail($id);
        $query->delete();
        return 'Prepared_by deleted';
    }
}
