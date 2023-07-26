<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Strength;
use App\Models\Weak;
use App\Models\Oppotunity;
use App\Models\Threat;
use Illuminate\Http\Request;

class SOWTController extends Controller
{
    public function storeStrength(Request $request){
        $all_strengths=$request->strength;
       
        foreach ($all_strengths as $value) {
            $strength=new Strength;
            $strength->strength=$value['value'];
            $strength->company_id=$request->company_id;
            $strength->save(); 
        }
        $strengths=Strength::where('company_id',$request->company_id)->get();
        // return $strengths;
        return ["Strength data saved",$strengths];
    }
    public function storeWeak(Request $request){
        // $alldetails =Company::findOrFail($request->company_id);
        $all_weak=$request->weak;
        foreach ($all_weak as $value) {
            $data=new Weak;
            $data->weak=$value['value'];
            $data->company_id=$request->company_id;
            $data->save(); 
        }
        $weaks=Weak::where('company_id',$request->company_id)->get();
        return ['Weak added successfully',$weaks]; 
    }
    public function storeOppotunity(Request $request){
        $all_oppotunities=$request->all();
        // return $all_oppotunities;
        $all_oppotunity=$request->oppotunity;
        // return $all_oppotunity;
        foreach ($all_oppotunity as $value) {
            $data=new Oppotunity;
            $data->oppotunity=$value['value'];
            $data->company_id=$request->company_id;
            $data->save(); 
        }
        $oppotunities=Oppotunity::where('company_id',$request->company_id)->get();
        return ["Oppotunity data saved",$oppotunities];
    }
    public function storeThreat(Request $request){
        $all_threats=$request->all();
        $all_threat=$request->treat;
            foreach ($all_threat as $value) {
            $data=new Threat;
            $data->treat=$value['value'];
            $data->company_id=$request->company_id;
            $data->save(); 
        }
        $threats=Threat::where('company_id',$request->company_id)->get();
        return ["Threat data saved",$threats];

    }
    public function Updatestrength(Request $request){
        $strength=Strength::find($request->strength_id);
        // return $strength;
        $input=$request->all();
        $strength->update($input);
    }
    public function UpdateWeak(Request $request){
        $weak=Weak::find($request->weak_id);
        // return $strength;
        $input=$request->all();
        $weak->update($input);
    }
    public function UpdateOppotunity(Request $request){
        $oppotunity=Oppotunity::find($request->oppotunity_id);
        //  return $oppotunity;
        $input=$request->all();
        $oppotunity->update($input);
    }
    public function UpdateThreat(Request $request){
        $threat=Threat::find($request->threat_id);
        $input=$request->all();
        $threat->update($input);
    }
    public function delete_added_strength(Request $request, $id) {
        // return $id;
        $query = Strength::findOrFail($id);
        // return $query;
        $query->delete();
        return 'Strength deleted';
    }
    public function delete_added_weak(Request $request, $id) {
        // return $id;
        $query = Weak::findOrFail($id);
        // return $query;
        $query->delete();
        return 'Weak deleted';
    }
    public function delete_added_oppoyunity(Request $request, $id) {
        // return $id;
        $query = Oppotunity::findOrFail($id);
        // return $query;
        $query->delete();
        return 'Oppotunity deleted';
    }
    public function delete_added_threat(Request $request, $id) {
        // return $id;
        $query = Threat::findOrFail($id);
        // return $query;
        $query->delete();
        return 'Threat deleted';
    }
}
