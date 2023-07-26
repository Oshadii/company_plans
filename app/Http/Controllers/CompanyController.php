<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Budget;
use App\Models\Businessdetail;
use App\Models\Sratergytechnology;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function companylist(){
        // $company=Company::paginate(3);
        $company=Company::all();
        return view("pages.company.company")->with('com',$company);
    }

    public function addCompanyDetails(){
        return view("pages.company.add");
    }

    public function companyStore(Request $request){

        $validated = $request->validate([
            'name' => 'required',
            'telephone'=>'required',
            'address'=>'required',
            'current_year'=>'required',
            'location_hq'=>'required',
            'location_satellite'=>'required',
            'mission'=>'required',
            'goal'=>'required',
            'objective'=>'required',
            'vision'=>'required',
            'email'=>'required',
            'logo'=>'required',

        ]);
        
        $alldetails=$request->all();

        $fileName=time().request()->file('logo')->getClientOriginalName();
        $file = request()->file('logo');
        $path = public_path().'/img'.'/';
        $uplaod = $file->move($path,$fileName);
        // dd($uplaod);
        $alldetails['logo']='img/'.$fileName;
        $alldetails['business_plan_filled']=false;
        $alldetails['market_plan_filled']=false;
       
        Company::create($alldetails);
        return redirect('/companylist')->with('message','New Company Saved!!');
        
    }

    public function addMarketingPlan($id){
        $company=Company::find($id);

        $all_strengths = DB::table('companies')
        ->join('strengths', 'strengths.company_id', '=', 'companies.id')
        ->where('strengths.company_id', '=', $id)
        ->get();

        return view('pages.company.create_marketing')->with('company',$company)->with('strengths',$all_strengths);
    }

    public function addBusinessPlan($id){
        $all_prepare_by = DB::table('companies')
        ->join('prepared_bies', 'prepared_bies.company_id', '=', 'companies.id')
        ->where('prepared_bies.company_id', '=', $id)
        ->get();

        $company=Company::find($id);
        return view('pages.company.create_business')->with('company',$company)->with('prepared_by',$all_prepare_by);
    }

    public function Edit_Business_Plan(Request $request,$id){
        $company=Company::find($id);
        // dd($company);

        $all_details = DB::table('companies')
        ->join('businessdetails', 'businessdetails.company_id', '=', 'companies.id')
        ->where('businessdetails.company_id', '=', $id)
        ->get();
        // dd($all_details);

        $all_prepare_by = DB::table('companies')
        ->join('prepared_bies', 'prepared_bies.company_id', '=', 'companies.id')
        ->where('prepared_bies.company_id', '=', $id)
        ->get();

        $all_summary = DB::table('companies')
        ->join('executive__summaries', 'executive__summaries.company_id', '=', 'companies.id')
        ->where('executive__summaries.company_id', '=', $id)
        ->get();

        $all_competitor = DB::table('companies')
        ->join('competitors', 'competitors.company_id', '=', 'companies.id')
        ->where('competitors.company_id', '=', $id)
        ->get();

        return view('pages.company.update_business_plan')->with('company',$company)->with('all_details',$all_details)
        ->with('prepared_by',$all_prepare_by)->with('summaries',$all_summary)->with('competitors',$all_competitor);
    }

    public function Edit_Marketing_Plan(Request $request,$id){
        $company=Company::find($id);
        // dd($company);

        $all_details = DB::table('companies')
        ->join('sratergytechnologies', 'sratergytechnologies.company_id', '=', 'companies.id')
        ->where('sratergytechnologies.company_id', '=', $id)
        ->get();
        // dd($all_details);

        $all_author = DB::table('companies')
        ->join('authors', 'authors.company_id', '=', 'companies.id')
        ->where('authors.company_id', '=', $id)
        ->get();

        // dd($all_author);

        $all_marketing_leaders = DB::table('companies')
        ->join('marketingleaders', 'marketingleaders.company_id', '=', 'companies.id')
        ->where('marketingleaders.company_id', '=', $id)
        ->get();

        $all_strengths = DB::table('companies')
        ->join('strengths', 'strengths.company_id', '=', 'companies.id')
        ->where('strengths.company_id', '=', $id)
        ->get();

        $all_weaknesses = DB::table('companies')
        ->join('weaks', 'weaks.company_id', '=', 'companies.id')
        ->where('weaks.company_id', '=', $id)
        ->get();

        $all_oppotunities = DB::table('companies')
        ->join('oppotunities', 'oppotunities.company_id', '=', 'companies.id')
        ->where('oppotunities.company_id', '=', $id)
        ->get();

        $all_threats = DB::table('companies')
        ->join('threats', 'threats.company_id', '=', 'companies.id')
        ->where('threats.company_id', '=', $id)
        ->get();

        $all_initiatives = DB::table('companies')
        ->join('initiatives', 'initiatives.company_id', '=', 'companies.id')
        ->where('initiatives.company_id', '=', $id)
        ->get();

        $all_industries = DB::table('companies')
        ->join('industries', 'industries.company_id', '=', 'companies.id')
        ->where('industries.company_id', '=', $id)
        ->get();

        $all_pearsonas = DB::table('companies')
        ->join('pearsonas', 'pearsonas.company_id', '=', 'companies.id')
        ->where('pearsonas.company_id', '=', $id)
        ->get();

        $all_competitives = DB::table('companies')
        ->join('competitives', 'competitives.company_id', '=', 'companies.id')
        ->where('competitives.company_id', '=', $id)
        ->get();

        // return $all_competitives;

        $all_websites = DB::table('companies')
        ->join('website__publications', 'website__publications.company_id', '=', 'companies.id')
        ->where('website__publications.company_id', '=', $id)
        ->get();


        $all_networks = DB::table('companies')
        ->join('social__networks', 'social__networks.company_id', '=', 'companies.id')
        ->where('social__networks.company_id', '=', $id)
        ->get();

        $budget = DB::table('companies')
        ->join('budgets', 'budgets.company_id', '=', 'companies.id')
        ->where('budgets.company_id', '=', $id)
        ->get()->first();

        // return $budget;

        return view('pages.company.update_Marketing_plan')->with('company',$company)->with('all_engagement_details',$all_details)
        ->with('authors',$all_author)->with('leaders',$all_marketing_leaders)->with('strengths',$all_strengths)
        ->with('weaks',$all_weaknesses)->with('oppotunities',$all_oppotunities)->with('threats',$all_threats)
        ->with('initiatives',$all_initiatives)->with('industries',$all_industries)->with('pearsonas',$all_pearsonas)
        ->with('competitives',$all_competitives)->with('websites',$all_websites)->with('networks',$all_networks)
        ->with('budget',$budget);
    }

    public function Update_Business_Plan(Request $request){
        // dd($request->all());
        // $all=Company::find($request->id);
        $alldetails=Businessdetail::find($request->b_id);
        // dd($alldetails);        
        $input=$request->all();
        // dd($input);
        $alldetails->update($input);

        return redirect('/companylist')->with('message','Updated successfully!!');     
    }

    public function Update_Marketing_Plan(Request $request){
        $alldetails=Sratergytechnology::find($request->stratergytech_id);
        $input=$request->all();
        $alldetails->update($input);
        return redirect()->back()->with('message', 'details updated');     
    }
    public function Delete_Company($id) {
        // return $id;
        $company = company::findOrFail($id);
        $company->delete();
        return redirect()->back()->with('message','Company Deleted!!!!!!!!');
    }
}
