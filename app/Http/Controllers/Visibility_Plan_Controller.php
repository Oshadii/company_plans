<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visibility_touchpoints;
use App\Models\Visibility_details;
use App\Models\Parent_Visibility_Plan;
use App\Models\Company;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\DB;

class Visibility_Plan_Controller extends Controller
{
    public function visibility_plan(){

        $parent_visibitity=Parent_Visibility_Plan::where('is_submitted',false)->first();
        if($parent_visibitity==null){
            $parent_visibitity=new Parent_Visibility_Plan();
            $parent_visibitity->is_submitted=false;
            $parent_visibitity->save();
        }
        $touchpoints=Visibility_touchpoints::where('parent_visibility_plan_id',$parent_visibitity->id)->get();
        // dd($parent_visibitity);
        // dd($alltouchpoints);
        return view("pages.visibility_plan")->with('touchpoints',$touchpoints)->with('parent',$parent_visibitity);
    }
    
    public function Store_Touchpoint(Request $request){

        $validated = $request->validate([
            'touchpoint' => 'required',

        ]);

        $alltouchpoints=$request->all();
        // dd($alltouchpoints);
        $alltouchpoints['details_filled']=false;
        Visibility_touchpoints::create($alltouchpoints);
        return redirect()->back();
    }

    public function Add_visibility_Plan_Details($id){
        // dd($touchpoint_id);
        $alltouchpoints=Visibility_touchpoints::find($id);
        // dd($alltouchpoints);
        // $alltouchpoints =Visibility_touchpoints::findOrFail($request->touchpoint_id);
        return view("pages.add_visibility_plan_details")->with('touchpoint',$alltouchpoints);
    }

    public function Store_Visibility_Plan(Request $request){
        $touchpoint =Visibility_touchpoints::find($request->touchpoint_id);
        // $alldetails=$request->all();
        // dd($alldetails);
        // dd($request->touchpoint_id);
        $matrics=[];
        $target_results=[];
        for ($i=1; $i <= $request->counter-1; $i++) { 
            array_push($matrics,$request['metrics_to_measure'.$i]);
            array_push($target_results,$request['target_result'.$i]);
        };
        $string_matric = implode(', ', $matrics);
        $string_target_result = implode(', ', $target_results);
        $alldetails=$request->all();
        $alldetails['metrics_to_measure']=$string_matric;
        $alldetails['target_result']=$string_target_result;

        Visibility_details::create($alldetails);
// dd($touchpoint);
        $touchpoint->details_filled=true;
        $touchpoint->save();

        return redirect('visibility_plan')->with('message','Data saved successfully'); 
    }

    public function Store_Parent_Visibility_Plan(Request $request){
        $parent_visibitity =Parent_Visibility_Plan::find($request->id);
        $parent_visibitity->started_date=$request->started_date;
        $parent_visibitity->company_name=$request->company_name;
        $parent_visibitity->company_id=$request->company_id;
        $parent_visibitity->save();
        
        return redirect()->back()->with('message','start date set');
    }

    public function set_end_date(Request $request){
        $parent_visibitity =Parent_Visibility_Plan::find($request->id);
        $parent_visibitity->end_date=$request->end_date;
        $parent_visibitity->save();
        
        return redirect()->back()->with('message','end date set');
    }

    public function submit(Request $request){
        $parent_visibitity =Parent_Visibility_Plan::find($request->id);
        $parent_visibitity->is_submitted=true;
        $parent_visibitity->save();
        
        return redirect()->back()->with('message','Visibility plan saved');
    }
    
    public function Update_visibility_Plan_Details(Request $request,$id){
      
        $alltouchpoints=Visibility_touchpoints::find($id);
        // dd($alltouchpoints);
        
        $all =Visibility_details::find($request->id);
        // $all = DB::table('visibility_details')->where('touchpoint_id',$id)->get();
        // $all = Visibility_details::where('touchpoint_id',$id)->get();
        return view("pages.update_visibility_plan_details")->with('touchpoint',$alltouchpoints)->with('visibility_detail',$all);
    }

    public function Update_touchpoint_name(Request $request){
        // dd($request->all());
        $all=Visibility_touchpoints::find($request->id);
        // dd($all);        
        $input=$request->all();
        $all->update($input);
        return redirect()->back()->with('message','Touchpoint name updated successfully');     
    }
    public function Update_visibility_details(Request $request){
        $all =Visibility_details::find($request->id);
        // dd($all);

        $matrics=[];
        $target_results=[];
        for ($i=1; $i <= $request->counter-1; $i++) { 
            array_push($matrics,$request['metrics_to_measure'.$i]);
            array_push($target_results,$request['target_result'.$i]);
        };
        $string_matric = implode(', ', $matrics);
        $string_target_result = implode(', ', $target_results);
        $alldetails=$request->all();
        $alldetails['metrics_to_measure']=$string_matric;
        $alldetails['target_result']=$string_target_result;

        // dd($alldetails);
        $all->update($alldetails);
        return redirect()->back()->with('message','data updated successfully');    
    }

    public function View_Vsibility_Plan(Request $request,$id){
        $all=Parent_Visibility_Plan::find($id);
        // dd($all);

        // $touch =Visibility_touchpoints::find($request->id)->get();
        // $all_touchpoint=DB::table('parent__visibility__plans')
        // ->join('visibility_touchpoints', 'parent__visibility__plans.id', '=', 'visibility_touchpoints.parent_visibility_plan_id')
        // ->select('parent__visibility__plans.*', 'visibility_touchpoints.*')
        // ->get();

        $touch = DB::table('parent__visibility__plans')
        ->join('visibility_touchpoints', 'visibility_touchpoints.parent_visibility_plan_id', '=', 'parent__visibility__plans.id')
        ->where('visibility_touchpoints.parent_visibility_plan_id', '=', $id)
        ->get();
        // dd($touch);


        $detail = DB::table('parent__visibility__plans')
        ->join('visibility_touchpoints', 'visibility_touchpoints.parent_visibility_plan_id', '=', 'parent__visibility__plans.id')
        ->join('visibility_details', 'visibility_details.touchpoint_id', '=', 'visibility_touchpoints.id')
        ->where('visibility_touchpoints.parent_visibility_plan_id', '=', $id)
        ->get();
        // dd($detail);
        return view("pages.complete_visibility_plan")->with('parent',$all)->with('touchpoints',$touch)->with('visibility_detail',$detail);
    }


}
