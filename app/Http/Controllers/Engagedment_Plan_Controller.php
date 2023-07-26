<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Engagement_touchpoint;
use App\Models\Engagement_detail;
use App\Models\Parent_Engagement;
use Illuminate\Support\Facades\DB;

class Engagedment_Plan_Controller extends Controller
{
    public function Engagedment_plan(){

        $parent_engagement=Parent_Engagement::where('is_submitted',false)->first();
        if($parent_engagement==null){
            $parent_engagement=new Parent_Engagement();
            $parent_engagement->is_submitted=false;
            $parent_engagement->save();
        }
        $touchpoints=Engagement_touchpoint::where('parent_engagement_id',$parent_engagement->id)->get();
        // dd($parent_engagement);
        // dd($touchpoints);
        return view("pages.engagement_plan")->with('en_touchpoints',$touchpoints)->with('enparent',$parent_engagement);

    }
    public function Store_Engagedment_Touchpoint(Request $request){

        $validated = $request->validate([
            'engagement_touchpoint' => 'required',

        ]);

        $alltouchpoints=$request->all();
        $alltouchpoints['details_filled']=false;
        Engagement_touchpoint::create($alltouchpoints);
        return redirect()->back();
    }
    public function Add_Engagedment_Plan_Details($id){
        $alltouchpoints=Engagement_touchpoint::find($id);
        // dd($alltouchpoints);
        return view("pages.add_engagement_plan_details")->with('en_touchpoint',$alltouchpoints);
    }
    public function Store_Engagement_Plan(Request $request){
        $touchpoint =Engagement_touchpoint::find($request->engagement_touchpoint_id);
        // $alldetails=$request->all();
        // dd($alldetails);
        // dd($request->touchpoint_id);
        $key_results=[];
        $target_result=[];
        $engagement_objectives=[];

        for ($i=1; $i <= $request->count-1; $i++) { 
            array_push($key_results,$request['key_result'.$i]);
            array_push($target_result,$request['target_result'.$i]);
        };
        for ($i=1; $i <= $request->counter-1; $i++) { 
            array_push($engagement_objectives,$request['engagement_objective'.$i]);
        };

        $string_key = implode(', ', $key_results);
        $string_target_results = implode(', ', $target_result);
        $string_engagement_object=implode(',',$engagement_objectives);

        $alldetails=$request->all();
        $alldetails['key_result']=$string_key;
        $alldetails['target_result']=$string_target_results;
        $alldetails['engagement_objective']=$string_engagement_object;
        // dd($alldetails);
        Engagement_detail::create($alldetails);

        $touchpoint->details_filled=true;
        $touchpoint->save();

        return redirect('Engagedment_plan'); 
    }
    public function engagement_start(Request $request){
        $parent_engagement =Parent_Engagement::find($request->id);
        // dd($parent_engagement);
        $parent_engagement->started_date=$request->started_date;
        $parent_engagement->company_name=$request->company_name;
        $parent_engagement->company_id=$request->company_id;
        $parent_engagement->save();
        
        return redirect()->back()->with('message','start date set successfully');
    }
    public function engagement_end(Request $request){
        $parent_engagement =Parent_Engagement::find($request->id);
        $parent_engagement->end_date=$request->end_date;
        $parent_engagement->save();
        
        return redirect()->back()->with('message','End date set successfully'); 
    }
    public function engagement_submit(Request $request){
        $parent_engagement =Parent_Engagement::find($request->id);
        $parent_engagement->is_submitted=true;
        $parent_engagement->save();
        
        return redirect()->back()->with('message','Engagement plan saved successfully'); 
    }
    public function Update_Engagement_Plan_Details(Request $request,$id){
        $alltouchpoints=Engagement_touchpoint::find($id);
        $all =Engagement_detail::find($request->id);
        // $all =Engagement_detail::where($request->engagement_touchpoint_id)->first();

        // $metrics=explode(',',$all->metrics_to_measure);
        // $length=count($metrics);
        // for ($i=0; $i <= $length; $i++) { 
        //     $data=$metrics.$i;
        // };
        // dd($all);
        // dd($alltouchpoints);
        return view("pages.update_engagement_plan")->with('en_touchpoint',$alltouchpoints)->with('details',$all);
    }
    public function Update_engagement_details(Request $request){
        $all =Engagement_detail::find($request->id);
        // dd($all);

        $key_results=[];
        $target_result=[];
        $engagement_objectives=[];

        for ($i=1; $i <= $request->count-1; $i++) { 
            array_push($key_results,$request['key_result'.$i]);
            array_push($target_result,$request['target_result'.$i]);
        };
        for ($i=1; $i <= $request->counter-1; $i++) { 
            array_push($engagement_objectives,$request['engagement_objective'.$i]);
        };

        $string_key = implode(', ', $key_results);
        $string_target_results = implode(', ', $target_result);
        $string_engagement_object=implode(',',$engagement_objectives);

        $alldetails=$request->all();
        $alldetails['key_result']=$string_key;
        $alldetails['target_result']=$string_target_results;
        $alldetails['engagement_objective']=$string_engagement_object;
        

        // dd($alldetails);
        $all->update($alldetails);
        return redirect()->back();    
    }

    public function View_Engagement_Plan(Request $request,$id){
        $all=Parent_Engagement::find($id);
        // dd($all);

        $touch = DB::table('parent__engagements')
        ->join('engagement_touchpoints', 'engagement_touchpoints.parent_engagement_id', '=', 'parent__engagements.id')
        ->where('engagement_touchpoints.parent_engagement_id', '=', $id)
        ->get();
        // dd($touch);


        $detail = DB::table('parent__engagements')
        ->join('engagement_touchpoints', 'engagement_touchpoints.parent_engagement_id', '=', 'parent__engagements.id')
        ->join('engagement_details', 'engagement_details.engagement_touchpoint_id', '=', 'engagement_touchpoints.id')
        ->where('engagement_touchpoints.parent_engagement_id', '=', $id)
        ->get();
        // dd($detail);
        return view("pages.complete_engagement_plan")->with('enparent',$all)->with('en_touchpoint',$touch)->with('details',$detail);

    }
}
