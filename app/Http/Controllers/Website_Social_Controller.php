<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Social_Network;
use App\Models\Website_Publication;
use Illuminate\Http\Request;

class Website_Social_Controller extends Controller
{
    public function storeWebsiteDetails(Request $request){
        // $alldetails =Company::findOrFail($request->company_id);
        $all_website=$request->all();
        Website_Publication::create($all_website);
        // return $all_website;
        $websites=Website_Publication::where('company_id',$request->company_id)->get();
        return ['website Details saved Successfully',$websites]; 
    }
    public function storeNetworkDetails(Request $request){
        // $alldetails =Company::findOrFail($request->company_id);
        $all_network=$request->all();
        Social_Network::create($all_network);
        // return $all_network;
        $networks=Social_Network::where('company_id',$request->company_id)->get();
        return ['Network details saved successfully',$networks]; 
    }
    public function UpdateWebsiteDetails(Request $request){
        $website=Website_Publication::find($request->website_id);
        // return $competitive;
        $input=$request->all();
        $website->update($input);
    }
    public function UpdateNetworkDetails(Request $request){
        $network=Social_Network::find($request->network_id);
        // return $competitive;
        $input=$request->all();
        $network->update($input);
    }
    public function delete_added_website($id) {
        $query = Website_Publication::findOrFail($id);
        $query->delete();
        return 'Website detail deleted';
    }
    public function delete_added_network($id) {
        $query = Social_Network::findOrFail($id);
        $query->delete();
        return 'Network detail deleted';
    }
}
