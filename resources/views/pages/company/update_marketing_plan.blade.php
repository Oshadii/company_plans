@extends('layouts.user_type.auth')
@section('content')
<html lang="en">

    {{-- @include('libraries.style') --}}
    @include('libraries.script')
   
<style>
            
  #regForm {
  background-color: #ffffff;
  margin: 100px auto;
  padding: 40px;
  width: 70%;
  min-width: 300px;
  }

  /* Style the input fields */
  input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
  }

  /* Mark input boxes that gets an error on validation: */
  input.invalid {
  background-color: #ffdddd;
  }

  /* Hide all steps by default: */
  .tab {
  display: none;
  }

  /* Make circles that indicate the steps of the form: */
  .step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
  }

  /* Mark the active step: */
  .step.active {
  opacity: 1;
  }

  /* Mark the steps that are finished and valid: */
  .step.finish {
  background-color: #04AA6D;
  }
  .page-title{
            font-size: 6vh;
        color: #8588e7;
        padding-top: 3vh;
        padding-left: 60vh;
        }
        .page-title2{
            font-size: 3vh;
        color: #5dbedc;
        padding-top: 4vh;
        }
        .para{
            font-size: 2vh;
        color: #cc1023;
        padding-left: 1cm;
        }
</style>

{{-- message --}}
@if(session()->has('message'))
<p class="alert alert-success"> {{ session()->get('message') }}</p>
@endif
{{-- message  end--}}

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <p>Marketing Plan of :{{$company->name}}</p>
  
      {{-- AUTHOR DETAILS TAB --}}
      <div class="tab">
        <h6 class="page-title2">1. Author Details:</h6>

        <table class="table table-secondary table-striped">
          <thead>
            <tr>
              <th>Author Name</th>
              <th>Author Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="author_body">
            @foreach ($authors as $key=>$author)
            <tr id="saved_author_delete{{$author->author_id}}">
              <td><input type="hidden" name="author_id" id="{{'author_id_'.$key}}" class="form-control" value="{{$author->author_id}}" >
                <input type="text" name="name" class="form-control" id="{{'author_name_'.$key}}" value="{{$author->name}}" ></td>
              <td><input type="email" name="email" class="form-control" id="{{'author_email_'.$key}}" value="{{$author->email}}"></td>
              <td>
                <a href="#" class="btn btn-danger btn-sm" onclick="delete_added_author('{{$author->author_id}}')"><i class="ni ni-fat-remove">remove</i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <div class="input-group w-60">
          <button type="button" onclick="update_author({{count($authors)}})" class="btn btn-info btn-sm">Update Author</button>
        </div><br>

        <div class="input-group">
          <input type="text" name="name" class="form-control" id="author_name" placeholder="Auhor Name">
          <input type="email" name="email" class="form-control" id="author_email" placeholder="Author Email">
        </div><br>
        <button type="button" onclick="save_author()" class="btn btn-info btn-sm">Save Author</button>                                   
      </div>

      {{-- MARKETING LEADER DETAILS TAB --}}
      <div class="tab">
        <h6 class="page-title2">2. Marketing Leader Details:</h6>

        <table class="table table-secondary table-striped">
          <thead>
            <tr>
              <th>Market Leader Name</th>
              <th>market Leader Job</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="leader_body">
            @foreach ($leaders as $key=>$leader)
            <tr id="saved_market_leader_delete{{$leader->id}}">
              <td><input type="hidden" name="id" id="{{'id_'.$key}}" class="form-control" value="{{$leader->id}}" >
                <input type="text" name="name" class="form-control" id="{{'leader_name_'.$key}}" value="{{$leader->name}}"></td>
              <td><input type="text" name="job" class="form-control" id="{{'leader_job_'.$key}}" value="{{$leader->job}}"></td>
              <td><input type="text" name="description" class="form-control" id="{{'leader_description_'.$key}}" value="{{$leader->description}}"></td>
              <td><a href="#" class="btn btn-danger btn-sm" onclick="delete_added_market_leader('{{$leader->id}}')"><i class="ni ni-fat-remove">remove</i></a></td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <div class="input-group w-60">
            <button type="button" onclick="update_market_leader({{count($leaders)}})"  class="btn btn-info btn-sm">Update Details</button>
        </div>

        <div class="input-group">
          <input type="text" name="name" class="form-control" id="leader_name" placeholder="Marketing Leader Name">
          <input type="text" name="job" class="form-control" id="leader_job" placeholder="job title of Marketing Leader">
        </div><br>
        <div class="input-group w-60">
          <input type="text" name="description" class="form-control" id="leader_description" placeholder="brief job description of Marketing Leader">
        </div><br>
        <div class="input-group w-60">
          <button type="button" onclick="save_market_leader()"  class="btn btn-info">Save Details</button>
        </div>

      </div>

      {{-- SOWT ANALYSIS-l TAB --}}
      <div class="tab">
        <h6 class="page-title2">3. SWOT Analysis-l:</h6>
          <div class="row">
            {{-- -------------------------UPDATE STRENGTHS------------------------------------------------- --}}
            <div class="col-md-6">
              <div class="form-group">
                <h6>Strengths :</h6>
                <div class="form-group">
                  <table class="table table-secondary table-striped">
                    <thead>
                      
                    </thead>
                    <tbody id="strength_body">
                      @foreach ($strengths as $key=>$strength)                
                      <tr id="saved_strength_delete{{$strength->strength_id}}">
                        <td><input type="hidden" name="strength_id" id="{{'strength_id_'.$key}}" class="form-control" value="{{$strength->strength_id}}" >
                          <input type="text" name="strength" id="{{'strength_'.$key}}" class="form-control" value="{{$strength->strength}}">
                        </td>
                        <td>
                          <a href="#" class="btn btn-danger btn-sm" onclick="delete_added_strength('{{$strength->strength_id}}')"><i class="ni ni-fat-remove">remove</i></a>
                          <input type="hidden" name="strength_id" id="{{'strength_id_'.$key}}" class="form-control" value="{{$strength->strength_id}}" >
                        </td>
                      </tr>
                      @endforeach

                      <tr>
                        <td>update above data</td>
                        <td><button type="button" onclick="update_strength({{count($strengths)}})" class="btn btn-info btn-sm">Update</button></td>
                      </tr>
                    </tbody>
                  </table>
                  <form action="#" id="strength_form" onsubmit="return false;">
                    <table class="table table-secondary table-striped">
                      <thead>
                        <tr>
                          <th>
                            <button onclick="addStrength(1)" class="btn btn-success"><i class="ni ni-fat-add">Add more strengths</i></button>
                            <input type="hidden" id="s_count" value="1">
                          </th>
                          <th><button type="button" onclick="save_strength()" class="btn btn-info btn-sm">Save</button></th>
                        </tr>
                      </thead>
                      <tbody id="strengths">
                        <tr>
                          <td><input type="text" name="strength1" id="strength1" class="form-control" placeholder="Company Srengths"></td>
                          <td><button id="strength_delete_button1" onclick="deleteStrength(1)" class="btn btn-danger btn-sm"><i class="ni ni-fat-remove">remove</i></button></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                </div>                                    
              </div>
            </div>

            {{-- --------------------------------------UPDATE WEAKS------------------------------------------------- --}}

            <div class="col-md-6">
              <div class="form-group">
                  <h6>Weaks :</h6>
                  <div class="form-group">
                  <table class="table table-secondary table-striped">
                    <thead>
                      
                    </thead>
                    <tbody id="weak_body">
                      @foreach ($weaks as $key=>$weak)                
                      <tr id="saved_weak_delete{{$weak->weak_id}}">
                        <td><input type="hidden" name="weak_id" id="{{'weak_id_'.$key}}" class="form-control" value="{{$weak->weak_id}}" >
                          <input type="text" name="weak" id="{{'weak_'.$key}}" class="form-control" value="{{$weak->weak}}">
                        </td>
                        <td>
                          <a href="#" class="btn btn-danger btn-sm" onclick="delete_added_weak('{{$weak->weak_id}}')"><i class="ni ni-fat-remove">remove</i></a>
                          <input type="hidden" name="weak_id" id="{{'weak_id_'.$key}}" class="form-control" value="{{$weak->weak_id}}" >
                        </td>
                      </tr>
                      @endforeach

                      <tr>
                        <td>update above data</td>
                        <td><button type="button" onclick="update_weak({{count($weaks)}})" class="btn btn-info btn-sm">Update</button></td>
                      </tr>
                    </tbody>
                  </table>
                  <form action="#" id="weak_form" onsubmit="return false;">
                    <table class="table table-secondary table-striped">
                      <thead>
                        <tr>
                          <th>
                            <button onclick="add_weak(1)" class="btn btn-success"><i class="ni ni-fat-add">Add more weaks</i></button>
                            <input type="hidden" id="w_count" value="1">
                          </th>
                          <th><button type="button" onclick="save_weak()" class="btn btn-info btn-sm">Save</button></th>
                        </tr>
                      </thead>
                      <tbody id="weaks">
                        <tr>
                          <td><input type="text" name="weak1" id="weak1" class="form-control" placeholder="Company Weaknesses"></td>
                          <td><button id="weak_delete_button1" onclick="deleteWeak(1)" class="btn btn-danger btn-sm"><i class="ni ni-fat-remove">remove</i></button></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>

      {{-- SWOT ANALYSIS-ll TAB --}}
      <div class="tab">
        <h6 class="page-title2">3. SWOT Analysis-ll:</h6>
        <div class="row">                 
        {{-- --------------------------------------UPDATE OPPOTUNITY------------------------------------------------- --}}
          <div class="col-md-6">
            <div class="form-group">
              <h6>Oppotunities :</h6>
              <div class="form-group">
                <table class="table table-secondary table-striped">
                  <thead>
                    
                  </thead>
                  <tbody id="oppotunity_body">
                    @foreach ($oppotunities as $key=>$opp)                
                    <tr id="saved_oppotunity_delete{{$opp->oppotunity_id}}">
                      <td><input type="hidden" name="oppotunity_id" id="{{'oppotunity_id_'.$key}}" class="form-control" value="{{$opp->oppotunity_id}}" >
                        <input type="text" name="oppotunity" id="{{'oppotunity_'.$key}}" class="form-control" value="{{$opp->oppotunity}}">
                      </td>
                      <td>
                        <a href="#" class="btn btn-danger btn-sm" onclick="delete_added_oppotunity('{{$opp->oppotunity_id}}')"><i class="ni ni-fat-remove">remove</i></a>
                        <input type="hidden" name="oppotunity_id" id="{{'oppotunity_id_'.$key}}" class="form-control" value="{{$opp->oppotunity_id}}" > 
                      </td>
                    </tr>
                    @endforeach

                    <tr>
                      <td>update above data</td>
                      <td><button type="button" onclick="update_oppotunity({{count($oppotunities)}})" class="btn btn-info btn-sm">Update</button></td>
                    </tr>
                  </tbody>
                </table>
                <form action="#" id="oppotunity_form" onsubmit="return false;">
                  <table class="table table-secondary table-striped">
                    <thead>
                      <tr>
                        <th>
                          <button onclick="add_oppotunity(1)" class="btn btn-success"><i class="ni ni-fat-add">Add more oppotunity</i></button>
                          <input type="hidden" id="o_count" value="1">
                        </th>
                        <th><button type="button" onclick="save_oppotunity()" class="btn btn-info btn-sm">Save</button></th>
                      </tr>
                    </thead>
                    <tbody id="opps">
                      <tr>
                        <td><input type="text" name="oppotunity1" id="oppotunity1" class="form-control" placeholder="Company Oppotunities"></td>
                        <td><button id="oppotunity_delete_button1" onclick="deleteOppotunity(1)" class="btn btn-danger btn-sm"><i class="ni ni-fat-remove">remove</i></button></td>
                      </tr>
                    </tbody>
                  </table>
                </form>
              </div>                                    
            </div>
          </div>
          
          {{-- --------------------------------------UPDATE THREAT------------------------------------------------- --}}
          <div class="col-md-6">
            <div class="form-group">
              <h6>Threats :</h6>
              <div class="form-group">
                <table class="table table-secondary table-striped">
                  <thead>
                    
                  </thead>
                  <tbody id="threat_body">
                    @foreach ($threats as $key=>$threat)                
                    <tr id="saved_threat_delete{{$threat->threat_id}}">
                      <td><input type="hidden" name="threat_id" id="{{'threat_id_'.$key}}" class="form-control" value="{{$threat->threat_id}}" >
                        <input type="text" name="treat" id="{{'treat_'.$key}}" class="form-control" value="{{$threat->treat}}">
                      </td>
                      <td>
                        <a href="#" class="btn btn-danger btn-sm" onclick="delete_added_threat('{{$threat->threat_id}}')"><i class="ni ni-fat-remove">remove</i></a>
                        <input type="hidden" name="threat_id" id="{{'threat_id_'.$key}}" class="form-control" value="{{$threat->threat_id}}" > 
                      </td>
                    </tr>
                    @endforeach

                    <tr>
                      <td>update above data</td>
                      <td><button type="button" onclick="update_threat({{count($threats)}})" class="btn btn-info btn-sm">Update</button></td>
                    </tr>
                  </tbody>
                </table>
                <form action="#" id="threat_form" onsubmit="return false;">
                  <table class="table table-secondary table-striped">
                    <thead>
                      <tr>
                        <th>
                          <button onclick="add_threat(1)" class="btn btn-success"><i class="ni ni-fat-add">Add more threat</i></button>
                          <input type="hidden" id="t_count" value="1">
                        </th>
                        <th><button type="button" onclick="save_threat()" class="btn btn-info btn-sm">Save</button></th>
                      </tr>
                    </thead>
                    <tbody id="threats">
                      <tr>
                        <td><input type="text" name="treat1" id="treat1" class="form-control" placeholder="Company Threats"></td>
                        <td><button id="threat_delete_button1" onclick="deleteThreat(1)" class="btn btn-danger btn-sm"><i class="ni ni-fat-remove">remove</i></button></td>
                      </tr>
                    </tbody>
                  </table>
                </form>
              </div>                                    
            </div>
          </div>
        </div>  
      </div>
                                          
      {{-- BUSINESS INITIATIVES --}}
      <div class="tab">
        <h6 class="page-title2">4. Business Initiatives:</h6>
        <table class="table table-secondary table-striped">
          <thead>

          </thead>
          <tbody id="initiative_body">
            @foreach ($initiatives as $key=>$initiative)
            <tr id="saved_business_initiative_delete1{{$initiative->intitiative_id}}">
              <th>Description</th>
              <td>
                <input type="hidden" name="intitiative_id" id="{{'intitiative_id_'.$key}}" class="form-control" value="{{$initiative->intitiative_id}}" >
                <input type="text" name="descripion" id="{{'descripion_'.$key}}" class="form-control" value="{{$initiative->descripion}}">
              </td>
              <td rowspan="3"><a href="#" class="btn btn-danger btn-sm" onclick="delete_added_initiative('{{$initiative->intitiative_id}}')"><i class="ni ni-fat-remove">remove</i></a></td>
            </tr>
            <tr id="saved_business_initiative_delete2{{$initiative->intitiative_id}}">
              <th>Goal of initiative</th>
              <td>
                <input type="text" name="initiative_goal" id="{{'initiative_goal_'.$key}}" class="form-control" value="{{$initiative->initiative_goal}}">
              </td>
            </tr>
            <tr id="saved_business_initiative_delete3{{$initiative->intitiative_id}}">
              <th>Metrics to measure success</th>
              <td>
                <input type="text" name="metrics_measure" id="{{'metrics_measure_'.$key}}" class="form-control" value="{{$initiative->metrics_measure}}">
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <button type="button" onclick="update_business_initiatives({{count($initiatives)}})" class="btn btn-info btn-sm">Update Deatils</button>

        <div class="input-group w-80">
          <h6>Description:</h6>
        </div>
        <div class="input-group w-80">
          <input type="text" name="descripion" id="descripion" class="form-control" placeholder="Example: Over the next 12 months, we’ll work on building a blog property that becomes a go-to resource for our customers’ burning questions – and our number-one source of leads month over month.]">
        </div><br>
        <div class="input-group w-80">
          <h6>Goal of initiative:</h6>
        </div>
        <div class="input-group w-80">
          <input type="text" name="initiative_goal" id="initiative_goal" class="form-control" placeholder="Example: To increase our website’s rank on Google and create critical top-of-the-funnel marketing content that helps our sales team start more conversations with prospects">
        </div><br>
        <div class="input-group w-80">
          <h6>Metrics to measure success:</h6>
        </div>
        <div class="input-group w-80">
            <input type="text" name="metrics_measure" id="metrics_measure" class="form-control" placeholder="Example: 50,000 organic page views per month / 10 content downloads per month">
        </div><br><br>
        <button type="button" onclick="save_business_initiatives()" class="btn btn-info btn-sm">Add Deatils</button>

      </div>

      {{-- INDUSTRIES --}}
      <div class="tab">
        <h6 class="page-title2">5. Industries:</h6>
        <table class="table table-secondary table-striped">
          <thead>
            <tr>
              <th>Industry name</th>
              <th>Description</th>
              <th>action</th>
            </tr>
          </thead>
          <tbody id="industry_body">
            @foreach ($industries as $key=>$industry)
            <tr id="saved_business_industry_delete{{$industry->industry_id}}">
              <td>
                <input type="hidden" name="industry_id" id="{{'industry_id_'.$key}}" class="form-control" value="{{$industry->industry_id}}" >
                <input type="text" name="industry" id="{{'industry_'.$key}}" class="form-control" value="{{$industry->industry}}">
              </td>
              <td>
                <input type="text" name="description" id="{{'description_'.$key}}" class="form-control" value="{{$industry->description}}">
              </td>
              <td>
                <a href="#" class="btn btn-danger btn-sm" onclick="delete_added_industry('{{$industry->industry_id}}')"><i class="ni ni-fat-remove">remove</i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <button type="button" onclick="update_industries({{count($industries)}})" class="btn btn-info btn-sm">Update Dtails</button>                  
    
        <div class="input-group w-80">
          <h6>Industry name:</h6>
        </div>
        <div class="input-group w-80">
          <input type="text" name="industry" id="industry" class="form-control" placeholder="industry">
        </div><br>
        <div class="input-group w-80">
          <h6>Description:</h6>
        </div>
        <div class="input-group w-80">
          <input type="text" name="description" id="description" class="form-control" placeholder="This includes sub-industries business might target. [Example: Industry 1: Food and Beverage. This includes bar & grills]">
        </div><br><br>
        <button type="button" onclick="save_industries()" class="btn btn-info btn-sm">Save Dtails</button>

      </div>

      {{-- BUYER PEARSONA --}}
      <div class="tab">
        <h6 class="page-title2">6. Buyer Personas:</h6>
        <table class="table table-secondary table-striped">
          <thead>
            <tr>
              <th>Buyer Personas name</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="pearsona_body">
            @foreach ($pearsonas as $key=>$pearsona)
            <tr id="saved_business_pearsona_delete{{$pearsona->persona_id}}">
              <td>
                <input type="hidden" name="persona_id" id="{{'persona_id_'.$key}}" class="form-control" value="{{$pearsona->persona_id}}" >
                <input type="text" name="persona" id="{{'persona_'.$key}}" class="form-control" value="{{$pearsona->persona}}">
              </td>
              <td>
                <input type="text" name="descript" id="{{'descript_'.$key}}" class="form-control" value="{{$pearsona->descript}}">
              </td>
              <td>
                <a href="#" class="btn btn-danger btn-sm" onclick="delete_added_pearsona('{{$pearsona->persona_id}}')"><i class="ni ni-fat-remove">remove</i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
            
        <div class="input-group w-60">
          <button type="button" onclick="update_buyer_pearsonas({{count($pearsonas)}})" class="btn btn-info btn-sm">Update Details</button>
        </div><br>

        <div class="input-group w-80">
          <h6>Buyer Personas name:</h6>
        </div>
        <div class="input-group w-80">
          <input type="text" name="persona" id="persona" class="form-control" placeholder="industry">
        </div><br>
        <div class="input-group w-80">
          <h6>Description:</h6>
        </div>
        <div class="input-group w-80">
          <input type="text" name="descript" id="descript" class="form-control" placeholder="industry">
        </div><br>
        <div class="input-group w-60">
          <button type="button" onclick="save_buyer_pearsonas()" class="btn btn-info btn-sm">Save Details</button>
      </div><br>
    </div>

      {{-- COMPETITIVE ANALYSIS --}}
      <div class="tab">
        <h6 class="page-title2">7. Competitive Analysis:</h6>

        <table class="table table-secondary table-striped">
          <thead>

          </thead>
          <tbody id="competitive_body">
            @foreach ($competitives as $key=>$competitive)
            <tr id="saved_business_competitive_delete1{{$competitive->competitive_id}}">
              <th>Company</th>
              <td>
                <input type="hidden" name="competitive_id" id="{{'competitive_id_'.$key}}" class="form-control" value="{{$competitive->competitive_id}}" >
                <input type="text" name="company" id="{{'company_'.$key}}" class="form-control" value="{{$competitive->company}}">              </td>
              <td rowspan="3"><a href="#" class="btn btn-danger btn-sm" onclick="delete_added_competitive('{{$competitive->competitive_id}}')"><i class="ni ni-fat-remove">remove</i></a></td>
            </tr>
            <tr id="saved_business_competitive_delete2{{$competitive->competitive_id}}">
              <th>Products we compete with</th>
              <td>
                <input type="text" name="complete_product" id="{{'complete_product_'.$key}}" class="form-control" value="{{$competitive->complete_product}}">
              </td>
            </tr>
            <tr id="saved_business_competitive_delete3{{$competitive->competitive_id}}">
              <th>Other ways we compete</th>
              <td>
                <input type="text" name="other_ways" id="{{'other_ways_'.$key}}" class="form-control" value="{{$competitive->other_ways}}">
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="input-group w-60">
          <button type="button" onclick="update_competitive_analysis({{count($competitives)}})" class="btn btn-info btn-sm">Update Details</button>
        </div><br>

        <div class="input-group w-80">
          <h6>Company:</h6>
        </div>
        <div class="input-group w-80">
          <input type="text" name="company" id="company" class="form-control" placeholder="Company">
        </div><br>
        <div class="input-group w-80">
          <h6>Products we compete with:</h6>
        </div>
        <div class="input-group w-80">
          <input type="text" name="complete_product" id="complete_product" class="form-control" placeholder="This competitor’s product/service, what it does, and what it might do better than yours">
        </div><br>
        <div class="input-group w-80">
          <h6>Other ways we compete:</h6>
        </div>
        <div class="input-group w-80">
          <input type="text" name="other_ways" id="other_ways" class="form-control" placeholder="Example: This competitor has a blog that ranks highly on Google for many of the same keywords we would like to write content on">
        </div><br><br>
        <button type="button" onclick="save_competitive_analysis()" class="btn btn-info btn-sm">save Details</button>

      </div>
        
      {{-- WEBSITE PUBLICATION --}}
      <div class="tab">
        <h6 class="page-title2">8. Website/Publication :</h6>
        <table class="table table-secondary table-striped">
          <thead>
            <tr>
              <th>Purpose of channel</th>
              <th>Metrics to measure success</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="website_body">
            @foreach ($websites as $key=>$website)
            <tr id="saved_business_website_delete{{$website->website_id}}">
              <td>
                <input type="hidden" name="website_id" id="{{'website_id_'.$key}}" class="form-control" value="{{$website->website_id}}" >
                <input type="text" name="website_purpose" id="{{'website_purpose_'.$key}}" class="form-control" value="{{$website->website_purpose}}">
              </td>
              <td>
                <input type="text" name="website_metrics" id="{{'website_metrics_'.$key}}" class="form-control" value="{{$website->website_metrics}}">
              </td>
              <td>
                <a href="#" class="btn btn-danger btn-sm" onclick="delete_added_website('{{$website->website_id}}')"><i class="ni ni-fat-remove">remove</i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="input-group w-60">
          <button type="button" onclick="update_website_publication({{count($websites)}})" class="btn btn-info btn-sm">Update Details</button>
        </div><br>

        <div class="input-group w-80">
          <h6>Purpose of channel:</h6>
        </div>
        <div class="input-group w-80">
          <input type="text" name="website_purpose" id="website_purpose" class="form-control" placeholder="Example: Brand Awareness">
        </div><br>
        <div class="input-group w-80">
          <h6>Metrics to measure success:</h6>
        </div>
        <div class="input-group w-80">
          <input type="text" name="website_metrics" id="website_metrics" class="form-control" placeholder="Example: 50,000 unique page views per month">
        </div><br><br>
        <button type="button" onclick="save_website_publication()" class="btn btn-info btn-sm">Save Details</button>

      </div>

      {{-- SOCIAL NETWORK --}}
      <div class="tab">
        <h6 class="page-title2">9. Social Network :</h6>

        <table class="table table-secondary table-striped">
          <thead>
            <tr>
              <th>Purpose of channel</th>
              <th>Metrics to measure success</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="network_body">
            @foreach ($networks as $key=>$network)
            <tr id="saved_business_network_delete{{$network->network_id}}">
              <td>
                <input type="hidden" name="network_id" id="{{'network_id_'.$key}}" class="form-control" value="{{$network->network_id}}" >
                <input type="text" name="network_purpose" id="{{'network_purpose_'.$key}}" class="form-control" value="{{$network->network_purpose}}">              </td>
              <td>
                <input type="text" name="network_metrics" id="{{'network_metrics_'.$key}}" class="form-control" value="{{$network->network_metrics}}">
              </td>
              <td>
                <a href="#" class="btn btn-danger btn-sm" onclick="delete_added_network('{{$network->network_id}}')"><i class="ni ni-fat-remove">remove</i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="input-group w-60">
          <button type="button" onclick="update_social_network({{count($networks)}})" class="btn btn-info btn-sm">Update Details</button>
        </div><br>

        <div class="input-group w-80">
          <h6>Purpose of channel:</h6>
        </div>
        <div class="input-group w-80">
          <input type="text" name="network_purpose" id="network_purpose" class="form-control" placeholder="Example: Brand Awareness">
        </div><br>
        <div class="input-group w-80">
          <h6>Metrics to measure success:</h6>
        </div>
        <div class="input-group w-80">
            <input type="text" name="network_metrics" id="network_metrics" class="form-control" placeholder="Example: 50,000 unique page views per month">
        </div><br><br>
        <button type="button" onclick="save_social_network()" class="btn btn-info btn-sm">save Details</button>

      </div>

      {{-- BUDGET --}}
      <div class="tab">
        <h6 class="page-title2">10. Budget:</h6>
        <form action="#" method="post" autocomplete="off">
            @csrf
            <div class="input-group w-60">
                <input type="hidden" name="company_id" class="form-control" value="{{$company->id}}">
            </div><br>

            <div class="btn-group">
              <input type="button" onclick="insert_Row()" value="Insert a row"  class="btn btn-warning" style="float: right;">
            </div><br><br>
            <div class="input-group w-60">
              <p>(Enter whole budget again if you want to update this page.)</p>
              <table class="table table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Marketing Expense Name</th>
                    <th>Estimated Price</th>
                  </tr>
                </thead>
                <tbody id="budgets">
                  <input type="hidden" name="budget_id" id="budget_id" class="form-control" value="{{$budget->budget_id}}" > 
                  <td>
                    @foreach(explode(',', $budget->expense_name) as $info)
                      <option>{{$info}}</option>
                    @endforeach
                  </td>
                  <td>
                    @foreach(explode(',', $budget->estimated_price) as $info)
                      <option>{{$info}}</option>
                    @endforeach
                  </td>
                </tbody>                      
              </table>
            </div>
            <div class="input-group w-60">
              <button type="button" onclick="save_budget()" class="btn btn-info btn-md">Update budget</button>
            </div><br>
            <input name="counter" type="hidden" id="counter" value="1">
        </form>
      </div>

      {{-- MARKET STRATERGEY AND MARKETING TECHNOLOGY --}}
      <div class="tab">
        <h6 class="page-title2">11. Market Strategy:</h6>
        <form action="{{route('Update_Marketing_Plan')}}" method="post" autocomplete="off">
            @csrf
            <div class="input-group w-60">
              <input type="hidden" name="company_id" id="company_id" class="form-control" value="{{$company->id}}">
            </div><br>
            @foreach ($all_engagement_details as $detail)
            <div class="input-group w-60">
              <h6>Product:</h6>
          </div>
          <div class="form-group">
              <input type="hidden" name="stratergytech_id" class="form-control" value="{{$detail->stratergytech_id}}">
              <textarea class="form-control" name="product" rows="5" >{{$detail->product}}</textarea>    
          </div><br>
          <div class="input-group w-60">
              <h6>Price:</h6>
          </div>
          <div class="form-group">
              <textarea class="form-control" name="price" rows="5">{{$detail->price}}</textarea>    
          </div><br>
          <div class="input-group w-60">
            <h6>Promotion:</h6>
          </div>
          <div class="form-group">
              <textarea class="form-control" name="promotion" rows="5">{{$detail->promotion}}</textarea>    
          </div><br>
          <div class="input-group w-60">
            <h6>People:</h6>
          </div>
          <div class="form-group">
              <textarea class="form-control" name="people" rows="5">{{$detail->people}}</textarea>    
          </div><br>
          <div class="input-group w-60">
            <h6>Process:</h6>
          </div>
          <div class="form-group">
              <textarea class="form-control" name="process" rows="5">{{$detail->process}}</textarea>    
          </div><br>
          <div class="input-group w-60">
            <h6>Physical Evidence:</h6>
          </div>
          <div class="form-group">
              <textarea class="form-control" name="physical_evidence" rows="5">{{$detail->physical_evidence}}</textarea>    
          </div><br>
        {{-- </form> --}}
        {{-- </div> --}}

        {{-- <div class="tab"> --}}
        <h6 class="page-title2">12. Marketing Technology:</h6><br>
        {{-- <form action="#" method="post" autocomplete="off">
            @csrf --}}
            {{-- <div class="input-group w-60">
                <input type="hidden" name="company_id" class="form-control" value="{{$company->id}}">
            </div><br> --}}
            <div class="input-group w-60">
              <h6>Marketing CRM:</h6>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="crm" rows="5">{{$detail->crm}}</textarea>    
            </div><br>
            <div class="input-group w-60">
              <h6>Email Marketing Software:</h6>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="email_sw" rows="5">{{$detail->email_sw}}</textarea>    
            </div><br>
            <div class="input-group w-60">
              <h6>Marketing Automation Software:</h6>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="automation" rows="5">{{$detail->automation}}</textarea>    
            </div><br>
            <div class="input-group w-60">
              <h6>Blogging Software:</h6>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="blogging" rows="5">{{$detail->blogging}}</textarea>    
            </div><br>
            <div class="input-group w-60">
              <h6>Advertising Management Software:</h6>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="admanage_sw" rows="5">{{$detail->admanage_sw}}</textarea>    
            </div><br>
            <div class="input-group w-60">
              <h6>Social Media Management Software:</h6>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="social_media_manage" rows="5">{{$detail->social_media_manage}}</textarea>    
            </div><br>
            <div class="input-group w-60">
              <h6>Video Hosting Software:</h6>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="vedio_host_sw" rows="5">{{$detail->vedio_host_sw}}</textarea>    
            </div><br>
            @endforeach
            <div class="input-group w-60">
                <button type="submit" class="btn btn-info btn-sm">Update Marketing Plan</button>
            </div><br>

        </form>
      </div>

      <div style="overflow:auto;">
        <div style="float:right;">
          <button class="btn btn-light" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
          <button class="btn btn-light" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
        </div>
      </div>

      </div>
          <div style="text-align:center;margin-top:40px;">
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
      </div>
    </div>
  </div>
</div>


<script>
  function insert_Row(){
      var counter=document.getElementById('counter').value;
      var budgets=$("#budgets");
      budgets.append('<tr><td><textarea name="expense_name_'+counter+'" id="expense_name_'+counter+'" cols="65" rows="1"></textarea></td>'+'<td><textarea name="estimated_price_'+counter+'" id="estimated_price_'+counter+'" cols="65" rows="1"></textarea></td></tr>');      
      counter++;
      document.getElementById('counter').value=counter;
  }

  //////////////////////////AUTHOR FUNCTION START//////////////////////////////////////////////////////////////////

  function update_author(count) {
    console.log(count);
    var author_id = $("#author_id").val();
    var author_name = $("#author_name").val();
    var author_email = $("#author_email").val();
    var company_id = $("#company_id").val();

    // $("#author_name").val('');
    // $("#author_email").val('');
    for (let index = 0; index < count; index++) {
      $.ajax({
          type: 'POST',
          url: '/updateAuthors',
          data: {
              "_token": "{{ csrf_token() }}",
              "author_id":$("#author_id_"+index).val(),
              "name":$("#author_name_"+index).val(),
              "email":$("#author_email_"+index).val(),
              "company_id":$("#company_id"+index).val(),

          },

          success: function(response) {
            console.log(response);
                    
          }, error: function(data) {
              console.log(data);
          }
      });
      Swal.fire({
              position: 'middle',
              icon: 'success',
              title: "Updated authors successfully",
              showConfirmButton: false,
              timer: 1500
            });
    }

      
  }

  function delete_added_author(id) {
    var author_id = $("#author_id").val();
    // console.log(id);
    $("#saved_author_delete"+id).remove();

    $.ajax({
        type: 'POST',
        url: '/delete_added_author/'+id,
        data: {
          "_token": "{{ csrf_token() }}",
          "author_id":$("#author_id"+id).val(),
        },

        success: function(response) {
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
        
    });
  }

  function save_author() {

    var author = $("#author_name").val();
    var author_email = $("#author_email").val();
    var company_id = $("#company_id").val();

    $("#author_name").val('');
    $("#author_email").val('');

      $.ajax({
        type: 'POST',
        url: '/storeAuthorDetails',
        data: {
          "_token": "{{ csrf_token() }}",
          "name":author,
          "email":author_email,
          "company_id":company_id,
        },

        success: function(response) {
          Swal.fire({
            position: 'middle',
            icon: 'success',
            title: response[0],
            showConfirmButton: false,
            timer: 1500
          })
          $("#author_body").html('');
          count=1;
          response[1].forEach(element => {
            console.log(element);
            $("#author_body").append(
              '<tr id="saved_author_delete'+element.author_id+'">'+
                '<td><input type="hidden" name="author_id" id="author_id_'+count+'" class="form-control" value="'+element.author_id+'" >'+
                  '<input type="text" name="name" class="form-control" id="author_name_'+count+'" value="'+element.name+'"></td>'+
                '<td><input type="email" name="email" class="form-control" id="author_email_'+count+'" value="'+element.email+'"></td>'+
                '<td>'+
                  '<a href="#" class="btn btn-danger btn-sm" onclick="delete_added_author('+element.author_id+')"><i class="ni ni-fat-remove">remove</i></a>'+
                '</td>'+
              '</tr>'
            );
            count++;
          });
                  
        }, error: function(data) {
            console.log(data);
        }
    });
  }


  //////////////////////////AUTHOR FUNCTION END////////////////////////////////////////////////////////////////////

  function update_market_leader(count) {

    var id = $("#id").val();
    var leader_name = $("#leader_name").val();
    var leader_job = $("#leader_job").val();
    var leader_description = $("#leader_description").val();
    var company_id = $("#company_id").val();

    for (let index = 0; index < count; index++) {

      $.ajax({
      type: 'POST',
      url: '/UpdateMarketLeader',
      data: {
          "_token": "{{ csrf_token() }}",
          "id":$("#id_"+index).val(),
          "name":$("#leader_name_"+index).val(),
          "job":$("#leader_job_"+index).val(),
          "description":$("#leader_description_"+index).val(),
          "company_id":$("#company_id_"+index).val(),
        },
      success: function(response) {
        console.log(response);                    
      },
        error: function(data) {
        console.log(data);
      }
      });
      Swal.fire({
        position: 'middle',
        icon: 'success',
        title: 'market Leader updated',
        showConfirmButton: false,
        timer: 1500
      });
    }
  }

  function save_market_leader() {

    var leader_name = $("#leader_name").val();
    var leader_job = $("#leader_job").val();
    var leader_description = $("#leader_description").val();
    var company_id = $("#company_id").val();

    $("#leader_name").val('');
    $("#leader_job").val('');
    $("#leader_description").val('');


    $.ajax({
      type: 'POST',
      url: '/storeMarketingLeaders',
      data: {
        "_token": "{{ csrf_token() }}",
        "name":leader_name,
        "job":leader_job,
        "description":leader_description,
        "company_id":company_id,
      },

      success: function(response) {
        Swal.fire({
          position: 'middle',
          icon: 'success',
          title: response[0],
          // title:'Author Saved',
          showConfirmButton: false,
          timer: 1500
        })
        $("#leader_body").html('');
          count=1;
          response[1].forEach(element => {
            console.log(element);
            $("#leader_body").append(
              '<tr id="saved_market_leader_delete'+element.id+'">'+
                '<td><input type="hidden" name="id" id="id_'+count+'" class="form-control" value="'+element.id+'" >'+
                  '<input type="text" name="name" class="form-control" id="leader_name_'+count+'" value="'+element.name+'"></td>'+
                '<td><input type="text" name="job" class="form-control" id="leader_job_'+count+'" value="'+element.job+'"></td>'+
                '<td><input type="text" name="description" class="form-control" id="leader_description_'+count+'" value="'+element.description+'"></td>'+
                '<td>'+
                  '<a href="#" class="btn btn-danger btn-sm" onclick="delete_added_market_leader('+element.id+')"><i class="ni ni-fat-remove">remove</i></a>'+
                '</td>'+
              '</tr>'
            );
            count++;
          });
                
      }, error: function(data) {
          console.log(data);
      }
    });
  }

  function delete_added_market_leader(id) {
    var author_id = $("#id").val();
    // console.log(id);
    $("#saved_market_leader_delete"+id).remove();

    $.ajax({
        type: 'POST',
        url: '/delete_added_market_leader/'+id,
        data: {
          "_token": "{{ csrf_token() }}",
          "id":$("#id"+id).val(),
        },

        success: function(response) {
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
        
    });
  }

  /////////////////////////////// STRENGTH DETAIL FUNCTIONS START///////////////////////////////////////////////////

  function addStrength(){
    var sCount = $("#s_count").val();
    sCount++;
    var strength = '<tr id="row_strength_repeat_'+sCount+'" ><td><input type="text" name="strength'+sCount+'" id="strength'+sCount+'" class="form-control" placeholder="Company Strength"></td><td><button id="strength_delete_button'+sCount+'" onclick="deleteStrength('+sCount+')" class="btn btn-danger btn-sm"><i class="ni ni-fat-remove">remove</i></button></td></tr>';
    $("#strengths").append(strength);
    $("#s_count").val(sCount);
  }
  function deleteStrength(id){
    $("#strength"+id).remove();
    // $("#s_br"+id).remove();
    $("#strength_delete_button"+id).remove();
  }

  function update_strength(count) {
    console.log(count);
    var strength_id = $("#strength_id").val();
    var strength = $("#strength").val();
    var company_id = $("#company_id").val();

    for (let index = 0; index < count; index++) {
      $.ajax({
      type: 'POST',
      url: '/Updatestrength',
      data: {
        "_token": "{{ csrf_token() }}",
        "strength_id":$("#strength_id_"+index).val(),
        "strength": $("#strength_"+index).val(),
        "company_id":$("#company_id_"+index).val(),
      },
      success: function(response) {
        console.log(response);
                
      }, error: function(data) {
          console.log(data);
      }
    });
      Swal.fire({
          position: 'middle',
          icon: 'success',
          title: 'updated',
          showConfirmButton: false,
          timer: 1500
        });
      
    }
   
  }

  function save_strength() {
    // var strength = $("#strength").val();
    var company_id = $("#company_id").val();
    var data=$('#strength_form').serializeArray();
    console.log(data);
    
      $.ajax({
        type: 'POST',
        url: '/storeStrength',
        data: {
          "_token": "{{ csrf_token() }}",
          //  "strength":strength,
          "company_id":company_id,
          "strength":data,
        },
      

        success: function(response) {
          Swal.fire({
            position: 'middle',
            icon: 'success',
            title: response[0],
            showConfirmButton: false,
            timer: 1500
          });
          $("#strength_body").html('');
          count=1;
          response[1].forEach(element => {
            console.log(element);
            $("#strength_body").append(
              '<tr id="saved_strength_delete'+element.strength_id+'">'+
                '<td><input type="hidden" name="strength_id" id="strength_id_'+count+'" class="form-control" value="'+element.strength_id+'" >'+
                  '<input type="text" name="strength" id="strength_'+count+'" class="form-control" value="'+element.strength+'">'+
                '</td>'+
                '<td>'+
                  '<a href="#" class="btn btn-danger btn-sm" onclick="delete_added_strength('+element.strength_id+')"><i class="ni ni-fat-remove">remove</i></a>'+
                '</td>'+
              '</tr>'
            );
            count++;
          });
                            
        }, error: function(data) {
            console.log(data);
        }
    });
        $("#strengths").remove();

  }

  function delete_added_strength(id) {
    var strength_id = $("#strength_id").val();
    // console.log(id);
    $("#saved_strength_delete"+id).remove();

    $.ajax({
        type: 'POST',
        url: '/delete_added_strength/'+id,
        data: {
          "_token": "{{ csrf_token() }}",
          "strength_id":$("#strength_id_"+id).val(),
        },

        success: function(response) {
          // Swal.fire({
          //   position: 'middle',
          //   icon: 'success',
          //   title: response,
          //   showConfirmButton: false,
          //   timer: 1500
          // })
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
        
    });
  }
  /////////////////////////////// STRENGTH DETAIL FUNCTIONS END///////////////////////////////////////////////////

  /////////////////////////////// WEAK DETAIL FUNCTIONS START///////////////////////////////////////////////////

  function update_weak(count) {

    var weak_id = $("#weak_id").val();
    var weak = $("#weak").val();
    var company_id = $("#company_id").val();

    for (let index = 0; index < count; index++) {
      $.ajax({
      type: 'POST',
      url: '/UpdateWeak',
      data: {
        "_token": "{{ csrf_token() }}",
        "weak_id":$("#weak_id_"+index).val(),
        "weak":$("#weak_"+index).val(),
        "company_id":$("#company_id_"+index).val(),
      },

      success: function(response) {
        console.log(response);
                
      }, error: function(data) {
          console.log(data);
      }
    });
    Swal.fire({
        position: 'middle',
        icon: 'success',
        title: 'weaks updated',
        showConfirmButton: false,
        timer: 1500
      });      
    }
    
  }

  function add_weak(){
    var wCount = $("#w_count").val();
    wCount++;
    var weak = '<tr id="row_weak_repeat_'+wCount+'" ><td><input type="text" name="weak'+wCount+'" id="weak'+wCount+'" class="form-control" placeholder="Company Weaks"></td><td><button id="weak_delete_button'+wCount+'" onclick="deleteWeak('+wCount+')" class="btn btn-danger btn-sm"><i class="ni ni-fat-remove">remove</i></button></td></tr>';
                     
    $("#weaks").append(weak);
    $("#w_count").val(wCount);
  }

  function deleteWeak(id){
    $("#row_weak_repeat_"+id).remove();
    $("#weak"+id).remove();
    $("#weak_delete_button"+id).remove();
  }

  function save_weak() {

    var weak = $("#weak").val();
    var company_id = $("#company_id").val();
    var data=$('#weak_form').serializeArray();
    console.log(data);

    // $("#weak").val('');

    $.ajax({
        type: 'POST',
        url: '/storeWeak',
        data: {
            "_token": "{{ csrf_token() }}",
            // "weak":weak,
            "company_id":company_id,
            "weak":data,
        },

        success: function(response) {
          Swal.fire({
            position: 'middle',
            icon: 'success',
            title: response[0],
            // title:'Author Saved',
            showConfirmButton: false,
            timer: 1500
          })
          $("#weak_body").html('');
          count=1;
          response[1].forEach(element => {
            console.log(element);
            $("#weak_body").append(
              '<tr id="saved_weak_delete'+element.weak_id+'">'+
                '<td><input type="hidden" name="weak_id" id="weak_id_'+count+'" class="form-control" value="'+element.weak_id+'" >'+
                  '<input type="text" name="weak" id="weak_'+count+'" class="form-control" value="'+element.weak+'">'+
                '</td>'+
                '<td>'+
                  '<a href="#" class="btn btn-danger btn-sm" onclick="delete_added_weak('+element.weak_id+')"><i class="ni ni-fat-remove">remove</i></a>'+
                '</td>'+
              '</tr>'
            );
            count++;
          });
                  
        }, error: function(data) {
            console.log(data);
        }
    });
    $("#weaks").remove();
  }

  function delete_added_weak(id) {
    var weak_id = $("#weak_id").val();
    // console.log(id);
    $("#saved_weak_delete"+id).remove();

    $.ajax({
        type: 'POST',
        url: '/delete_added_weak/'+id,
        data: {
          "_token": "{{ csrf_token() }}",
          "weak_id":$("#weak_id_"+id).val(),
        },

        success: function(response) {
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
        
    });
  }

  /////////////////////////////// WEAK DETAIL FUNCTIONS END///////////////////////////////////////////////////

  /////////////////////////////// OPPOTUNITY DETAIL FUNCTIONS START///////////////////////////////////////////


  function add_oppotunity(){
    var oCount = $("#o_count").val();
    oCount++;
    var opp = '<tr id="row_repeat_'+oCount+'" ><td><input type="text" name="oppotunity'+oCount+'" id="oppotunity'+oCount+'" class="form-control" placeholder="Company Oppotunities"></td><td><button id="oppotunity_delete_button'+oCount+'" onclick="deleteOppotunity('+oCount+')" class="btn btn-danger btn-sm"><i class="ni ni-fat-remove">remove</i></button></td></tr>';
                     
    $("#opps").append(opp);
    $("#o_count").val(oCount);
  }

  function deleteOppotunity(id){
      $("#row_repeat_"+id).remove();
      $("#oppotunity"+id).remove();
      $("#oppotunity_delete_button"+id).remove();
  }

  function save_oppotunity() {

    var opp = $("#oppotunity").val();
    var company_id = $("#company_id").val();
    var data=$('#oppotunity_form').serializeArray();
    console.log(data);

    // $("#oppotunity").val('');

    $.ajax({
      type: 'POST',
      url: '/storeOppotunity',
      data: {
        "_token": "{{ csrf_token() }}",
        // "oppotunity":opp,
        "company_id":company_id,
        "oppotunity":data,
      },

    success: function(response) {
      Swal.fire({
        position: 'middle',
        icon: 'success',
        title: response[0],
        // title:'Author Saved',
        showConfirmButton: false,
        timer: 1500
      })
      $("#oppotunity_body").html('');
        count=1;
        response[1].forEach(element => {
          console.log(element);
          $("#oppotunity_body").append(
            '<tr id="saved_oppotunity_delete'+element.oppotunity_id+'">'+
              '<td><input type="hidden" name="oppotunity_id" id="oppotunity_id_'+count+'" class="form-control" value="'+element.oppotunity_id+'" >'+
                '<input type="text" name="oppotunity" id="oppotunity_'+count+'" class="form-control" value="'+element.oppotunity+'">'+
              '</td>'+
              '<td>'+
                '<a href="#" class="btn btn-danger btn-sm" onclick="delete_added_oppotunity('+element.oppotunity_id+')"><i class="ni ni-fat-remove">remove</i></a>'+
              '</td>'+
            '</tr>'
          );
          count++;
        });             
    },
    error: function(data) {
      console.log(data);
    }
    });
    $("#opps").remove();
  }

  function update_oppotunity(count) {

      var oppotunity_id = $("#oppotunity_id").val();
      var oppotunity = $("#oppotunity").val();
      var company_id = $("#company_id").val();

      for (let index = 0; index < count; index++) {
        $.ajax({
          type: 'POST',
          url: '/UpdateOppotunity',
          data: {
            "_token": "{{ csrf_token() }}",
            "oppotunity_id":$("#oppotunity_id_"+index).val(),
            "oppotunity": $("#oppotunity_"+index).val(),
            "company_id":$("#company_id_"+index).val(),
          },

      success: function(response) {
        console.log(response);
                
      }, error: function(data) {
          console.log(data);
      }
    });

    }
    Swal.fire({
      position: 'middle',
      icon: 'success',
      title: 'oppotunity updated',
      showConfirmButton: false,
      timer: 1500
    });
    
  }

  function delete_added_oppotunity(id) {
    var oppotunity_id = $("#oppotunity_id").val();
    // console.log(id);
    $("#saved_oppotunity_delete"+id).remove();

    $.ajax({
        type: 'POST',
        url: '/delete_added_oppoyunity/'+id,
        data: {
          "_token": "{{ csrf_token() }}",
          "oppotunity_id":$("#oppotunity_id"+id).val(),
        },

        success: function(response) {
          // Swal.fire({
          //   position: 'middle',
          //   icon: 'success',
          //   title: response,
          //   showConfirmButton: false,
          //   timer: 1500
          // })
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
        
    });
  }

/////////////////////////////// OPPOTUNITY DETAIL FUNCTIONS END///////////////////////////////////////////

/////////////////////////////// THREAT DETAIL FUNCTIONS START///////////////////////////////////////////

  
  function update_threat(count) {

    var threat_id = $("#threat_id").val();
    var treat = $("#treat").val();
    var company_id = $("#company_id").val();

    for (let index = 0; index < count; index++) {
    $.ajax({
      type: 'POST',
      url: '/UpdateThreat',
      data: {
        "_token": "{{ csrf_token() }}",
        "threat_id":$("#threat_id_"+index).val(),
        "treat": $("#treat_"+index).val(),
        "company_id":$("#company_id_"+index).val(),
      },

      success: function(response) {
        console.log(response);
                
      }, error: function(data) {
          console.log(data);
      }
      });

      }
      Swal.fire({
        position: 'middle',
        icon: 'success',
        title: 'updated',
        showConfirmButton: false,
        timer: 1500
      });

  }

  function add_threat(){
    var tCount = $("#t_count").val();
    tCount++;
    var tret = '<tr id="row_threat_repeat_'+tCount+'" ><td><input type="text" name="treat'+tCount+'" id="treat'+tCount+'" class="form-control" placeholder="Company Threats"></td><td><button id="threat_delete_button'+tCount+'" onclick="deleteThreat('+tCount+')" class="btn btn-danger btn-sm"><i class="ni ni-fat-remove">remove</i></button></td></tr>';
    $("#threats").append(tret);
    $("#t_count").val(tCount);
  }

  function deleteThreat(id){
    $("#treat"+id).remove();
    // $("#s_br"+id).remove();
    $("#threat_delete_button"+id).remove();
  }

  function save_threat() {

    var threat = $("#treat").val();
    var company_id = $("#company_id").val();
    var data=$('#threat_form').serializeArray();
    console.log(data);

    // $("#treat").val('');

    $.ajax({
        type: 'POST',
        url: '/storeThreat',
        data: {
            "_token": "{{ csrf_token() }}",
            // "treat":threat,
            "company_id":company_id,
            "treat":data,
        },

    success: function(response) {
      Swal.fire({
        position: 'middle',
        icon: 'success',
        title: response[0],
        showConfirmButton: false,
        timer: 1500
      })
      $("#threat_body").html('');
          count=1;
          response[1].forEach(element => {
            console.log(element);
            $("#threat_body").append(
              '<tr id="saved_threat_delete'+element.threat_id+'">'+
                '<td><input type="hidden" name="threat_id" id="threat_id_'+count+'" class="form-control" value="'+element.threat_id+'" >'+
                  '<input type="text" name="treat" id="treat_'+count+'" class="form-control" value="'+element.treat+'">'+
                '</td>'+
                '<td>'+
                  '<a href="#" class="btn btn-danger btn-sm" onclick="delete_added_threat('+element.threat_id+')"><i class="ni ni-fat-remove">remove</i></a>'+
                '</td>'+
              '</tr>'
            );
            count++;
          });
              
    }, error: function(data) {
        console.log(data);
    }
    });
    $("#threats").remove();
  }

  function delete_added_threat(id) {
    var threat_id = $("#threat_id").val();
    // console.log(id);
    $("#saved_threat_delete"+id).remove();

    $.ajax({
        type: 'POST',
        url: '/delete_added_threat/'+id,
        data: {
          "_token": "{{ csrf_token() }}",
          "threat_id":$("#threat_id"+id).val(),
        },

        success: function(response) {
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
        
    });
  }

/////////////////////////////// THREAT DETAIL FUNCTIONS END///////////////////////////////////////////

///////////////////////INITIATIVE FUNCTION START///////////////////////////////////////////////////////

  function update_business_initiatives(count) {

    var intitiative_id = $("#intitiative_id").val();
    var descripion = $("#descripion").val();
    var initiative_goal = $("#initiative_goal").val();
    var metrics_measure = $("#metrics_measure").val();
    var company_id = $("#company_id").val();

    for (let index = 0; index < count; index++) {
    $.ajax({
      type: 'POST',
      url: '/UpdateInitiativeDetails',
      data: {
        "_token": "{{ csrf_token() }}",
        //name and variable
        "intitiative_id":$("#intitiative_id_"+index).val(),
        "descripion":$("#descripion_"+index).val(),
        "initiative_goal":$("#initiative_goal_"+index).val(),
        "metrics_measure":$("#metrics_measure_"+index).val(),
        "company_id":$("#company_id_"+index).val(),
      },

      success: function(response) {
      console.log(response);
                
      },
       error: function(data) {
        console.log(data);
      }
      });
    }
    Swal.fire({
      position: 'middle',
      icon: 'success',
      title: 'Initiative updated',
      showConfirmButton: false,
      timer: 1500
    });
  }

  function save_business_initiatives() {

    var descripion = $("#descripion").val();
    var initiative_goal = $("#initiative_goal").val();
    var metrics_measure = $("#metrics_measure").val();
    var company_id = $("#company_id").val();

    $("#descripion").val('');
    $("#initiative_goal").val('');
    $("#metrics_measure").val('');


    $.ajax({
      type: 'POST',
      url: '/storeInitiativeDetails',
      data: {
          "_token": "{{ csrf_token() }}",
          //name and variable
          "descripion":descripion,
          "initiative_goal":initiative_goal,
          "metrics_measure":metrics_measure,
          "company_id":company_id,

      },

      success: function(response) {
        Swal.fire({
          position: 'middle',
          icon: 'success',
          title: response[0],
          showConfirmButton: false,
          timer: 1500
        })
        $("#initiative_body").html('');
          count=1;
          response[1].forEach(element => {
            console.log(element);
            $("#initiative_body").append(

            '<tr id="saved_business_initiative_delete1'+element.intitiative_id+'">'+
              '<th>Description</th>'+
              '<td><input type="hidden" name="intitiative_id" id="intitiative_id_'+count+'" class="form-control" value="'+element.intitiative_id+'" >'+
              '<input type="text" name="descripion" id="descripion_'+count+'" class="form-control" value="'+element.descripion+'"></td>'+
              '<td rowspan="3"><a href="#" class="btn btn-danger btn-sm" onclick="delete_added_initiative('+element.intitiative_id+')"><i class="ni ni-fat-remove">remove</i></a></td>'+
            '</tr>'+
            '<tr id="saved_business_initiative_delete2'+element.intitiative_id+'">'+
              '<th>Goal of initiative</th>'+
              '<td><input type="text" name="initiative_goal" id="initiative_goal_'+count+'" class="form-control" value="'+element.initiative_goal+'"></td>'+
            '</tr>'+
            '<tr id="saved_business_initiative_delete3'+element.intitiative_id+'">'+
              '<th>Metrics to measure success</th>'+
              '<td>'+
                '<input type="text" name="metrics_measure" id="metrics_measure_'+count+'" class="form-control" value="'+element.metrics_measure+'">'+
              '</td>'+
            '</tr>'
            );
            count++;
          });
                
      }, error: function(data) {
          console.log(data);
      }
    });
  }

  function delete_added_initiative(id) {
    var intitiative_id = $("#intitiative_id").val();
    // console.log(id);
    $("#saved_business_initiative_delete1"+id).remove();
    $("#saved_business_initiative_delete2"+id).remove();
    $("#saved_business_initiative_delete3"+id).remove();


    $.ajax({
        type: 'POST',
        url: '/delete_added_initiative/'+id,
        data: {
          "_token": "{{ csrf_token() }}",
          "intitiative_id":$("#intitiative_id"+id).val(),
        },

        success: function(response) {
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
        
    });
  }

//////////////////////INITIATIVE FUNCTION END/////////////////////////////////////////////////////////

///////////////////////INDUSTRY DETAIL FUNCTION START////////////////////////////////////////////////

  function update_industries(count) {

    var industry_id = $("#industry_id").val();
    var industry = $("#industry").val();
    var description = $("#description").val();
    var company_id = $("#company_id").val();

    for (let index = 0; index < count; index++) {
      $.ajax({
        type: 'POST',
        url: '/UpdateIndustryDetails',
        data: {
          "_token": "{{ csrf_token() }}",
          //name and variable
          "industry_id":$("#industry_id_"+index).val(),
          "industry":$("#industry_"+index).val(),
          "description":$("#description_"+index).val(),
          "company_id":$("#company_id_"+index).val(),
        },

        success: function(response) {
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
    });
      
    }
    Swal.fire({
      position: 'middle',
      icon: 'success',
      title: 'updated',
      // title:'Author Saved',
      showConfirmButton: false,
      timer: 1500
    });

  }

  function delete_added_industry(id) {
    var industry_id = $("#industry_id").val();
    // console.log(id);
    $("#saved_business_industry_delete"+id).remove();


    $.ajax({
        type: 'POST',
        url: '/delete_added_industry/'+id,
        data: {
          "_token": "{{ csrf_token() }}",
          "industry_id":$("#industry_id"+id).val(),
        },

        success: function(response) {
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
        
    });
  }

  function save_industries() {

    var industry = $("#industry").val();
    var description = $("#description").val();
    var company_id = $("#company_id").val();

    $("#industry").val('');
    $("#description").val('');


    $.ajax({
        type: 'POST',
        url: '/storeIndustryDetails',
        data: {
          "_token": "{{ csrf_token() }}",
          //name and variable
          "industry":industry,
          "description":description,
          "company_id":company_id,
        },

        success: function(response) {
          Swal.fire({
            position: 'middle',
            icon: 'success',
            title: response[0],
            showConfirmButton: false,
            timer: 1500
          })

          $("#industry_body").html('');
          count=1;
          response[1].forEach(element => {
            console.log(element);
            $("#industry_body").append(

            '<tr id="saved_business_industry_delete'+element.industry_id+'">'+
              '<td>'+
                '<input type="hidden" name="industry_id" id="industry_id_'+count+'" class="form-control" value="'+element.industry_id+'" >'+
                '<input type="text" name="industry" id="industry_'+count+'" class="form-control" value="'+element.industry+'">'+
              '</td>'+
              '<td>'+
                '<input type="text" name="description" id="description_'+count+'" class="form-control" value="'+element.description+'">'+
              '</td>'+
              '<td>'+
                '<a href="#" class="btn btn-danger btn-sm" onclick="delete_added_industry('+element.industry_id+')"><i class="ni ni-fat-remove">remove</i></a>'+
              '</td>'+
           ' </tr>'
            );
            count++;
          });
                  
        }, error: function(data) {
            console.log(data);
        }
    });
  }

///////////////////////INDUSTRY DETAIL FUNCTION END////////////////////////////////////////////////

///////////////////////BUYERPEARSONA DETAIL FUNCTION START/////////////////////////////////////////

  function update_buyer_pearsonas(count) {

    var persona_id = $("#persona_id").val();
    var persona = $("#persona").val();
    var descript = $("#descript").val();
    var company_id = $("#company_id").val();

    // console.log(description);

    for (let index = 0; index < count; index++) {
      $.ajax({
        type: 'POST',
        url: '/UpdatePersonaDetails',
        data: {
            "_token": "{{ csrf_token() }}",
            //name and variable
            "persona_id":$("#persona_id_"+index).val(),
            "persona":$("#persona_"+index).val(),
            "descript":$("#descript_"+index).val(),
            "company_id":$("#company_id_"+index).val(),
        },

        success: function(response) {
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
    });
      
    }
    Swal.fire({
        position: 'middle',
        icon: 'success',
        title: 'pearsona details updated',
        // title:'Author Saved',
        showConfirmButton: false,
        timer: 1500
      });

  }

  function delete_added_pearsona(id) {
    var persona_id = $("#persona_id").val();
    // console.log(id);
    $("#saved_business_pearsona_delete"+id).remove();


    $.ajax({
        type: 'POST',
        url: '/delete_added_pearsona/'+id,
        data: {
          "_token": "{{ csrf_token() }}",
          "persona_id":$("#persona_id"+id).val(),
        },

        success: function(response) {
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
        
    });
  }

  function save_buyer_pearsonas() {

    var persona = $("#persona").val();
    var descript = $("#descript").val();
    var company_id = $("#company_id").val();

    $("#persona").val('');
    $("#descript").val('');

    $.ajax({
        type: 'POST',
        url: '/storePersonaDetails',
        data: {
          "_token": "{{ csrf_token() }}",
          //name and variable
          "persona":persona,
          "descript":descript,
          "company_id":company_id,
        },

        success: function(response) {
          Swal.fire({
            position: 'middle',
            icon: 'success',
            title: response[0],
            showConfirmButton: false,
            timer: 1500
          })
          $("#pearsona_body").html('');
          count=1;
          response[1].forEach(element => {
            console.log(element);
            $("#pearsona_body").append(

            '<tr id="saved_business_pearsona_delete'+element.persona_id+'">'+
              '<td>'+
                '<input type="hidden" name="persona_id" id="persona_id_'+count+'" class="form-control" value="'+element.persona_id+'" >'+
               ' <input type="text" name="persona" id="persona_'+count+'" class="form-control" value="'+element.persona+'">'+
             ' </td>'+
              '<td>'+
                '<input type="text" name="descript" id="descript_'+count+'" class="form-control" value="'+element.descript+'">'+
              '</td>'+
             ' <td>'+
                '<a href="#" class="btn btn-danger btn-sm" onclick="delete_added_pearsona('+element.persona_id+')"><i class="ni ni-fat-remove">remove</i></a>'+
              '</td>'+
           ' </tr>'

          //   '<tr id="saved_business_industry_delete'+element.industry_id+'">'+
          //     '<td>'+
          //       '<input type="hidden" name="industry_id" id="industry_id_'+count+'" class="form-control" value="'+element.industry_id+'" >'+
          //       '<input type="text" name="industry" id="industry_'+count+'" class="form-control" value="'+element.industry+'">'+
          //     '</td>'+
          //     '<td>'+
          //       '<input type="text" name="description" id="description_'+count+'" class="form-control" value="'+element.description+'">'+
          //     '</td>'+
          //     '<td>'+
          //       '<a href="#" class="btn btn-danger btn-sm" onclick="delete_added_industry('+element.industry_id+')"><i class="ni ni-fat-remove">remove</i></a>'+
          //     '</td>'+
          //  ' </tr>'
            );
            count++;
          });
                  
        }, error: function(data) {
            console.log(data);
        }
    });
  }

//////////////////////BUYER PEARSONA DETAILS FUNCTION END/////////////////////////////////////////

//////////////////////COMPETITIVE DETAILS FUNCTION START/////////////////////////////////////////

  function update_competitive_analysis(count) {

    var competitive_id = $("#competitive_id").val();
    var company = $("#company").val();
    var complete_product = $("#complete_product").val();
    var other_ways = $("#other_ways").val();
    var company_id = $("#company_id").val();


    for (let index = 0; index < count; index++) {
      $.ajax({
        type: 'POST',
        url: '/UpdateCompetitiveDetails',
        data: {
            "_token": "{{ csrf_token() }}",
            //name and variable
            "competitive_id":$("#competitive_id_"+index).val(),
            "company":$("#company_"+index).val(),
            "complete_product":$("#complete_product_"+index).val(),
            "other_ways":$("#other_ways_"+index).val(),
            "company_id":$("#company_id_"+index).val(),
        },

        success: function(response) {
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
      });
      
    }
    Swal.fire({
      position: 'middle',
      icon: 'success',
      title: 'Competitive Details Updated',
      showConfirmButton: false,
      timer: 1500
    });
    
  }

  function delete_added_competitive(id) {
    var competitive_id = $("#competitive_id").val();
    // console.log(id);
    $("#saved_business_competitive_delete1"+id).remove();
    $("#saved_business_competitive_delete2"+id).remove();
    $("#saved_business_competitive_delete3"+id).remove();


    $.ajax({
        type: 'POST',
        url: '/delete_added_competitive/'+id,
        data: {
          "_token": "{{ csrf_token() }}",
          "competitive_id":$("#competitive_id"+id).val(),
        },

        success: function(response) {
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
        
    });
  }

  function save_competitive_analysis() {

    var company = $("#company").val();
    var complete_product = $("#complete_product").val();
    var other_ways = $("#other_ways").val();
    var company_id = $("#company_id").val();

    $("#company").val('');
    $("#complete_product").val('');
    $("#other_ways").val('');

    $.ajax({
      type: 'POST',
      url: '/storeCompetitiveDetails',
      data: {
        "_token": "{{ csrf_token() }}",
        //name and variable
        "company":company,
        "complete_product":complete_product,
        "other_ways":other_ways,
        "company_id":company_id,
      },

      success: function(response) {
        Swal.fire({
          position: 'middle',
          icon: 'success',
          title: response[0],
          showConfirmButton: false,
          timer: 1500
        })
        $("#competitive_body").html('');
          count=1;
          response[1].forEach(element => {
            console.log(element);
            $("#competitive_body").append(

            '<tr id="saved_business_competitive_delete1'+element.competitive_id+'">'+
              '<th>Company</th>'+
              '<td>'+
                '<input type="hidden" name="competitive_id" id="competitive_id_'+count+'" class="form-control" value="'+element.competitive_id+'" >'+
                '<input type="text" name="company" id="company_'+count+'" class="form-control" value="'+element.company+'"> '+
              '</td>'+
              '<td rowspan="3"><a href="#" class="btn btn-danger btn-sm" onclick="delete_added_competitive('+element.competitive_id+')"><i class="ni ni-fat-remove">remove</i></a></td>'+
            '</tr>'+
            '<tr id="saved_business_competitive_delete2'+element.competitive_id+'">'+
              '<th>Products we compete with</th>'+
              '<td>'+
                '<input type="text" name="complete_product" id="complete_product_'+count+'" class="form-control" value="'+element.complete_product+'">'+
              '</td>'+
            '</tr>'+
            '<tr id="saved_business_competitive_delete3'+element.competitive_id+'">'+
              '<th>Other ways we compete</th>'+
              '<td>'+
                '<input type="text" name="other_ways" id="other_ways_'+count+'" class="form-control" value="'+element.other_ways+'">'+
              '</td>'+
            '</tr>'

            );
            count++;
          });
                
      }, error: function(data) {
          console.log(data);
      }
    });
  }
//////////////////////COMPETITIVE DETAILS FUNCTION END/////////////////////////////////////////

//////////////////////WEBSITE DETAILS FUNCTION START/////////////////////////////////////////

  function update_website_publication(count) {

    var website_id = $("#website_id").val();
    var website_purpose = $("#website_purpose").val();
    var website_metrics = $("#website_metrics").val();
    var company_id = $("#company_id").val();

    for (let index = 0; index < count; index++) {
      $.ajax({
        type: 'POST',
        url: '/UpdateWebsiteDetails',
        data: {
          "_token": "{{ csrf_token() }}",
          //name and variable
          "website_id":$("#website_id_"+index).val(),
          "website_purpose":$("#website_purpose_"+index).val(),
          "website_metrics":$("#website_metrics_"+index).val(),
          "company_id":$("#company_id_"+index).val(),
        },

        success: function(response) {
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
      });
    
      }
      Swal.fire({
        position: 'middle',
        icon: 'success',
        title: 'Website Details Update',
        showConfirmButton: false,
        timer: 1500
      });
      
  }

  function delete_added_website(id) {
    var website_id = $("#website_id").val();
    // console.log(id);
    $("#saved_business_website_delete"+id).remove();


    $.ajax({
        type: 'POST',
        url: '/delete_added_website/'+id,
        data: {
          "_token": "{{ csrf_token() }}",
          "website_id":$("#website_id"+id).val(),
        },

        success: function(response) {
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
        
    });
  }

  function save_website_publication() {

    var website_purpose = $("#website_purpose").val();
    var website_metrics = $("#website_metrics").val();
    var company_id = $("#company_id").val();

    $("#website_purpose").val('');
    $("#website_metrics").val('');

    $.ajax({
        type: 'POST',
        url: '/storeWebsiteDetails',
        data: {
          "_token": "{{ csrf_token() }}",
          //name and variable
          "website_purpose":website_purpose,
          "website_metrics":website_metrics,
          "company_id":company_id,

        },

        success: function(response) {
          Swal.fire({
            position: 'middle',
            icon: 'success',
            title: response[0],
            showConfirmButton: false,
            timer: 1500
          })
          $("#website_body").html('');
          count=1;
          response[1].forEach(element => {
            console.log(element);
            $("#website_body").append(

            '<tr id="saved_business_website_delete'+element.website_id+'">'+
              '<td>'+
                '<input type="hidden" name="website_id" id="website_id_'+count+'" class="form-control" value="'+element.website_id+'" >'+
                '<input type="text" name="website_purpose" id="website_purpose_'+count+'" class="form-control" value="'+element.website_purpose+'">'+
             ' </td>'+
              '<td>'+
                '<input type="text" name="website_metrics" id="website_metrics_'+count+'" class="form-control" value="'+element.website_metrics+'">'+
              '</td>'+
             ' <td>'+
                '<a href="#" class="btn btn-danger btn-sm" onclick="delete_added_website('+element.website_id+')"><i class="ni ni-fat-remove">remove</i></a>'+
             ' </td>'+
           ' </tr>'
            );
            count++;
          });
                  
        }, error: function(data) {
            console.log(data);
        }
    });
  }

//////////////////////WEBSITE DETAILS FUNCTION END/////////////////////////////////////////

//////////////////////NETWORK DETAILS FUNCTION START/////////////////////////////////////////

  function update_social_network(count) {

    var network_id = $("#network_id").val();
    var network_purpose = $("#network_purpose").val();
    var network_metrics = $("#network_metrics").val();
    var company_id = $("#company_id").val();

 
    for (let index = 0; index < count; index++) {
      $.ajax({
        type: 'POST',
        url: '/UpdateNetworkDetails',
        data: {
            "_token": "{{ csrf_token() }}",
            //name and variable
            "network_id":$("#network_id_"+index).val(),
            "network_purpose":$("#network_purpose_"+index).val(),
            "network_metrics":$("#network_metrics_"+index).val(),
            "company_id":$("#company_id_"+index).val(),

        },

        success: function(response) {
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
    });
      
    }
    Swal.fire({
      position: 'middle',
      icon: 'success',
      title: 'Network Details Updated',
      // title:'Author Saved',
      showConfirmButton: false,
      timer: 1500
    });
    
  }

  function delete_added_network(id) {
    var network_id = $("#network_id").val();
    // console.log(id);
    $("#saved_business_network_delete"+id).remove();


    $.ajax({
        type: 'POST',
        url: '/delete_added_network/'+id,
        data: {
          "_token": "{{ csrf_token() }}",
          "network_id":$("#network_id"+id).val(),
        },

        success: function(response) {
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
        
    });
  }

  function save_social_network() {

    var network_purpose = $("#network_purpose").val();
    var network_metrics = $("#network_metrics").val();
    var company_id = $("#company_id").val();

    $("#network_purpose").val('');
    $("#network_metrics").val('');

    $.ajax({
      type: 'POST',
      url: '/storeNetworkDetails',
      data: {
          "_token": "{{ csrf_token() }}",
          //name and variable
          "network_purpose":network_purpose,
          "network_metrics":network_metrics,
          "company_id":company_id,

      },

      success: function(response) {
        Swal.fire({
          position: 'middle',
          icon: 'success',
          title: response[0],
          showConfirmButton: false,
          timer: 1500
        })
        $("#network_body").html('');
          count=1;
          response[1].forEach(element => {
            console.log(element);
            $("#network_body").append(

            '<tr id="saved_business_network_delete'+element.network_id+'">'+
             ' <td>'+
                '<input type="hidden" name="network_id" id="network_id_'+count+'" class="form-control" value="'+element.network_id+'" >'+
                '<input type="text" name="network_purpose" id="network_purpose_'+count+'" class="form-control" value="'+element.network_purpose+'"></td>'+
              '<td>'+
                '<input type="text" name="network_metrics" id="network_metrics_'+count+'" class="form-control" value="'+element.network_metrics+'">'+
              '</td>'+
              '<td>'+
                '<a href="#" class="btn btn-danger btn-sm" onclick="delete_added_network('+element.network_id+')"><i class="ni ni-fat-remove">remove</i></a>'+
              '</td>'+
           ' </tr>'
            );
            count++;
          });
                
      }, error: function(data) {
          console.log(data);
      }
    });
  }
//////////////////////NETWORK DETAILS FUNCTION END/////////////////////////////////////////


  function save_budget() {

    var counter = $("#counter").val();
    var expense_names=[];
    var estimated_prices=[];
    for (let index = 1; index <= counter-1; index++) {
      var expense_name=$("#expense_name_"+index).val();
      var estimated_price=$("#estimated_price_"+index).val();
      expense_names.push(expense_name);
      estimated_prices.push(estimated_price);
    }
    var budget_id = $("#budget_id").val();
    var company_id = $("#company_id").val();

    $("#counter").val(1)
    $("#budgets").html('');


    $.ajax({
        type: 'POST',
        url: '/updateBudget',
        data: {
            "_token": "{{ csrf_token() }}",
            //name and variable
            "expense_names":expense_names,
            "estimated_prices":estimated_prices,
            "budget_id":budget_id,
            "company_id":company_id,

        },

        success: function(response) {
          Swal.fire({
            position: 'middle',
            icon: 'success',
            title: 'budget details saved',
            // title:'Author Saved',
            showConfirmButton: false,
            timer: 1500
          })
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
    });
  }

</script>
<script id="template" type="text/template">
    <div>
      <button class="previous" type="button">&lt;</button>
      <span><%= index %></span>
      <button class="next" type="button">&gt;</button>
      <a class="show-all" href="#">Show all pages</a>
      <progress value="<%= progress %>"></progress>
    </div>
  </script>
  <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
        // This function will display the specified tab of the form ...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        // ... and fix the Previous/Next buttons:
        if (n == 0) {
          document.getElementById("prevBtn").style.display = "none";
        } else {
          document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
          document.getElementById("nextBtn").style.display = "none";
        } else {
          document.getElementById("nextBtn").style.display = "inline";
          document.getElementById("nextBtn").innerHTML = "Next";
        }
        // ... and run a function that displays the correct step indicator:
        fixStepIndicator(n)
        }

        function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form... :
        if (currentTab >= x.length) {
        //...the form gets submitted:
        // document.getElementById("regForm").submit();
        // return false;
        return true;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
        }

        function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
          // add an "invalid" class to the field:
          y[i].className += " invalid";
          // and set the current valid status to false:
          valid = false;
        }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        // return valid; // return the valid status
        return true;
        }

        function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class to the current step:
        x[n].className += " active";
        }

</script>
  {{-- </body>

  </html> --}}
  @endsection
