<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Marketingleader;
class MarketingLeaderController extends Controller
{
    public function storeMarketingLeaders(Request $request){
        $market_leader=$request->all();
        Marketingleader::create($market_leader);
        $market_leaders=Marketingleader::where('company_id',$request->company_id)->get();
        return ['Market Leader added successfully',$market_leaders];
    }
    public function UpdateMarketLeader(Request $request){
        $market_leader=Marketingleader::find($request->id);
        $input = $request->all();
        $market_leader->update($input); 
    }
    public function delete_added_market_leader($id) {
        $query = Marketingleader::findOrFail($id);
        $query->delete();
        return 'Threat deleted';
    }
}

