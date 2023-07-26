@extends('layouts.user_type.auth')
@section('content')

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
          <p>create Marketing Plan for :{{$company->name}}</p>
   
          {{-- AUTHOR DETAILS --}}
            <div class="tab">
              <h6 class="page-title2">1. Author Details:</h6>
                @csrf
                <div class="input-group">
                  <input type="text" name="name" class="form-control" id="author_name" placeholder="Auhor Name">
                  <input type="email" name="email" class="form-control" id="author_email" placeholder="Author Email">
                </div><br>
              <button type="button" onclick="save_author()" class="btn btn-info">Save Author</button>
            </div>

            {{-- MARKET LEADER DETAILS --}}
            <div class="tab">
              <h6 class="page-title2">2. Marketing Leader Details:</h6>
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

            {{-- SWOT ANALYSIS-l --}}
            <div class="tab">
              <h6 class="page-title2">3. SWOT Analysis - l:</h6>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <form action="#" id="strength_form" onsubmit="return false;">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col"><h5>Add Strength</h6></th>
                            <th scope="col"><button onclick="addStrength(1)" class="btn btn-success">+</button>
                              <input type="hidden" id="s_count" value="1"></th>
                          </tr>
                        </thead>
                        <tbody id="strengths">
                          <tr>
                            <td><input type="text" name="strength1" id="strength1" class="form-control" placeholder="Company Srengths"></td>
                            <td><button id="strength_delete_button1" onclick="deleteStrength(1)" class="btn btn-danger btn-sm">remove</button></td>
                          </tr>
                        </tbody>
                      </table>
                    </form>
                  </div>
                  <button type="button" onclick="save_strength()" class="btn btn-info btn-sm">Save Strengths</button>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <form action="#" id="weak_form" onsubmit="return false;">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col"><h5>Add Weaknesses</h6></th>
                            <th scope="col"><button onclick="add_weak(1)" class="btn btn-success">+</button>
                              <input type="hidden" id="w_count" value="1"></th>
                          </tr>
                        </thead>
                        <tbody id="weaks">
                          <tr>
                            <td><input type="text" name="weak1" id="weak1" class="form-control" placeholder="Company Weaknesses"></td>
                            <td><button id="weak_delete_button1" onclick="deleteWeak(1)" class="btn btn-danger btn-sm">remove</button></td>
                          </tr>
                        </tbody>
                      </table>
                    </form>
                  </div>
                  <button type="button" onclick="save_weak()" class="btn btn-info btn-sm">Save weaks</button>
                </div>
              </div>              
            </div>

            {{-- SOWT ANALYSIS-ll --}}
            <div class="tab">
              <h6 class="page-title2">3. SWOT Analysis - ll:</h6>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <form action="#" id="oppotunity_form" onsubmit="return false;">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col"><h5>Add Oppotunities</h6></th>
                            <th scope="col"><button onclick="add_oppotunity(1)" class="btn btn-success">+</button>
                              <input type="hidden" id="o_count" value="1"></th>
                          </tr>
                        </thead>
                        <tbody id="opps">
                          <tr>
                            <td><input type="text" name="oppotunity1" id="oppotunity1" class="form-control" placeholder="Company Oppotunities"></td>
                            <td><button id="oppotunity_delete_button1" onclick="deleteOppotunity(1)" class="btn btn-danger btn-sm">remove</button></td>
                          </tr>
                        </tbody>
                      </table>
                    </form>
                  </div>
                  <button type="button" onclick="save_oppotunity()" class="btn btn-info btn-sm">Add Oppotunities</button>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <form action="#" id="threat_form" onsubmit="return false;">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col"><h5>Add Threats</h6></th>
                            <th scope="col"><button onclick="add_threat(1)" class="btn btn-success">+</button>
                              <input type="hidden" id="t_count" value="1"></th>
                          </tr>
                        </thead>
                        <tbody id="threats">
                          <tr>
                            <td><input type="text" name="treat1" id="treat1" class="form-control" placeholder="Company Threats"></td>
                            <td><button id="threat_delete_button1" onclick="deleteThreat(1)" class="btn btn-danger btn-sm">remove</button></td>
                          </tr>
                        </tbody>
                      </table>
                    </form>
                  </div>
                  <button type="button" onclick="save_threat()" class="btn btn-info btn-sm">Add Threats</button>
                </div>
              </div>
            </div>

            {{-- BUSINESS INITIATIVE DETAILS --}}
            <div class="tab">
              <h6 class="page-title2">4. Business Initiatives:</h6>
                @csrf
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


            {{-- INDUSTRY --}}
            <div class="tab">
              <h6 class="page-title2">5. Industries:</h6>
              @csrf
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

            {{-- PEARSONAS --}}
            <div class="tab">
              <h6 class="page-title2">6. Buyer Personas:</h6>
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

            <div class="tab">
              <h6 class="page-title2">7. Competitive Analysis:</h6>
                @csrf
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
            
            <div class="tab">
              <h6 class="page-title2">8. Website/Publication :</h6>
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

            <div class="tab">
              <h6 class="page-title2">9. Social Network :</h6>
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

            <div class="tab">
              <h6 class="page-title2">10. Budget:</h6>
                  <form action="#" id="budget_form" onsubmit="return false;">
                  <div class="input-group w-60">
                      <input type="hidden" name="company_id" class="form-control" value="{{$company->id}}">
                  </div><br>

                  <div class="btn-group">
                    <input type="button" onclick="insert_Row()" value="Insert row"  class="btn btn-warning" style="float: right;">
                  </div><br><br>
                  <div class="input-group w-60">

                    <table class="table table-bordered" id="sampleTable">
                      <thead>
                        <tr>
                          <th>Marketing Expense Name</th>
                          <th>Estimated Price</th>
                        </tr>
                      </thead>
                      <tbody id="budgets">
                      </tbody>                      
                    </table>
                  </div>
                  <div class="input-group w-60">
                    <button type="button" onclick="save_budget()" class="btn btn-info btn-md">save budget</button>
                  </div><br>
                  <input name="counter" type="hidden" id="counter" value="1">
              </form>
            </div>

            <div class="tab">
              <h6 class="page-title2">11. Market Strategy:</h6>
              <form action="{{route('storeStratergyAndTechnology')}}" method="post" autocomplete="off">
                  @csrf
                  <div class="input-group w-60">
                    <input type="hidden" name="company_id" id="company_id" class="form-control" value="{{$company->id}}">
                  </div><br>
                  <div class="input-group w-80">
                    <h6>Product:</h6>
                </div>
                <div class="input-group">
                    <textarea class="form-control" name="product" rows="5" placeholder="Describe the products with which you will enter the target market described in the section above. How will this product solve the challenges described in your buyer persona description(s)? What makes this product different from (or at least competitive against) your competition?"></textarea>    
                </div><br>
                <div class="input-group w-60">
                    <h6>Price:</h6>
                </div>
                <div class="input-group">
                    <textarea class="form-control" name="price" rows="5" placeholder="How much are you selling this product for? Is it competitive? Realistic for your customers’ budget? Will you run any seasonal promotions/discounts associated with this product?"></textarea>    
                </div><br>
                <div class="input-group w-60">
                  <h6>Promotion:</h6>
                </div>
                <div class="input-group">
                    <textarea class="form-control" name="promotion" rows="5" placeholder="How will you promote this product? Think more deeply than your blog or social media channels. What about this content will drive value into your product?"></textarea>    
                </div><br>
                <div class="input-group w-60">
                  <h6>People:</h6>
                </div>
                <div class="input-group">
                    <textarea class="form-control" name="people" rows="5" placeholder="Who in the marketing department plays a role in your market strategy? Describe what each of them, or each team, will do to bring your market strategy success"></textarea>    
                </div><br>
                <div class="input-group w-60">
                  <h6>Process:</h6>
                </div>
                <div class="input-group">
                    <textarea class="form-control" name="process" rows="5" placeholder="How will the product be delivered to your customer? Is it an ongoing service? How will you support their success with your product?"></textarea>    
                </div><br>
                <div class="input-group w-60">
                  <h6>Physical Evidence:</h6>
                </div>
                <div class="input-group">
                    <textarea class="form-control" name="physical_evidence" rows="5" placeholder="Where is your product displayed? If you sell an intangible product, how would customers produce visible evidence of your business?"></textarea>    
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
                  <div class="input-group">
                      <textarea class="form-control" name="crm" rows="5" placeholder="Name the marketing CRM you will use and briefly explain how it will be used"></textarea>    
                  </div><br>
                  <div class="input-group w-60">
                    <h6>Email Marketing Software:</h6>
                  </div>
                  <div class="input-group">
                      <textarea class="form-control" name="email_sw" rows="5" placeholder="Name the email marketing software you will use and briefly explain how it will be used"></textarea>    
                  </div><br>
                  <div class="input-group w-60">
                    <h6>Marketing Automation Software:</h6>
                  </div>
                  <div class="input-group">
                      <textarea class="form-control" name="automation" rows="5" placeholder="Name the marketing automation software you will use and briefly explain how it will be used"></textarea>    
                  </div><br>
                  <div class="input-group w-60">
                    <h6>Blogging Software:</h6>
                  </div>
                  <div class="input-group">
                      <textarea class="form-control" name="blogging" rows="5" placeholder="Name the blogging software you will use and briefly explain how it will be used"></textarea>    
                  </div><br>
                  <div class="input-group w-60">
                    <h6>Advertising Management Software:</h6>
                  </div>
                  <div class="input-group">
                      <textarea class="form-control" name="admanage_sw" rows="5" placeholder="Name the advertising software you will use and briefly explain how it will be used"></textarea>    
                  </div><br>
                  <div class="input-group w-60">
                    <h6>Social Media Management Software:</h6>
                  </div>
                  <div class="input-group">
                      <textarea class="form-control" name="social_media_manage" rows="5" placeholder="Name the social media management software you will use and briefly explain how it will be used"></textarea>    
                  </div><br>
                  <div class="input-group w-60">
                    <h6>Video Hosting Software:</h6>
                  </div>
                  <div class="input-group">
                      <textarea class="form-control" name="vedio_host_sw" rows="5" placeholder="Name the video marketing software you will use and briefly explain how it will be used"></textarea>    
                  </div><br>
                  <div class="input-group w-60">
                      <button type="submit" class="btn btn-info btn-sm">Save Marketing Plan</button>
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
          showConfirmButton: false,
          timer: 1500
        })
        console.log(response);
                
      }, error: function(data) {
          console.log(data);
      }
    });
  }

//////////////////////////STRENGTH FUNCTIONS START/////////////////////////////////////////////////
  function addStrength(){
    var sCount = $("#s_count").val();
    sCount++;
    var strength = '<tr id="row_strength_repeat_'+sCount+'" ><td><input type="text" name="strength'+sCount+'" id="strength'+sCount+'" class="form-control" placeholder="Company Strength"></td><td><button id="strength_delete_button'+sCount+'" onclick="deleteStrength('+sCount+')" class="btn btn-danger btn-sm">remove</button></td></tr>';
    $("#strengths").append(strength);
    $("#s_count").val(sCount);
  }

  function deleteStrength(id){
    $("#strength"+id).remove();
    // $("#s_br"+id).remove();
    $("#strength_delete_button"+id).remove();
  }

  function save_strength() {
    var strength = $("#strength").val();
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
          })
        }, error: function(data) {
            console.log(data);
        }
    });
    $("#strengths").remove();
  }
//////////////////////////STRENGTH FUNCTIONS END/////////////////////////////////////////////////

//////////////////////////WEAK FUNCTIONS START/////////////////////////////////////////////////

  function add_weak(){
    var wCount = $("#w_count").val();
    wCount++;
    var weak = '<tr id="row_weak_repeat_'+wCount+'" ><td><input type="text" name="weak'+wCount+'" id="weak'+wCount+'" class="form-control" placeholder="Company Weaks"></td><td><button id="weak_delete_button'+wCount+'" onclick="deleteWeak('+wCount+')" class="btn btn-danger btn-sm">remove</button></td></tr>';
                     
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
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
    });
    $("#weaks").remove();
  }
//////////////////////////WEAK FUNCTIONS END/////////////////////////////////////////////////

//////////////////////////OPPOTUNITY FUNCTIONS START/////////////////////////////////////////////////

  function add_oppotunity(){
    var oCount = $("#o_count").val();
    oCount++;
    var opp = '<tr id="row_repeat_'+oCount+'" ><td><input type="text" name="oppotunity'+oCount+'" id="oppotunity'+oCount+'" class="form-control" placeholder="Company Oppotunities"></td><td><button id="oppotunity_delete_button'+oCount+'" onclick="deleteOppotunity('+oCount+')" class="btn btn-danger btn-sm">remove</button></td></tr>';
                     
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
        showConfirmButton: false,
        timer: 1500
      })
      console.log(response);
              
    }, error: function(data) {
        console.log(data);
    }
   });
   $("#opps").remove();
  }
//////////////////////////OPPOTUNITY FUNCTIONS END/////////////////////////////////////////////////

//////////////////////////THREAT FUNCTIONS START/////////////////////////////////////////////////

  function add_threat(){
    var tCount = $("#t_count").val();
    tCount++;
    var tret = '<tr id="row_threat_repeat_'+tCount+'" ><td><input type="text" name="treat'+tCount+'" id="treat'+tCount+'" class="form-control" placeholder="Company Threats"></td><td><button id="threat_delete_button'+tCount+'" onclick="deleteThreat('+tCount+')" class="btn btn-danger btn-sm">remove</button></td></tr>';
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
      console.log(response);
              
    }, error: function(data) {
        console.log(data);
    }
    });
    $("#threats").remove();
  }
//////////////////////////THREAT FUNCTIONS END/////////////////////////////////////////////////

/////////////////////////BUSINESS INITIATIVE FUNCTION START///////////////////////////////////

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
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
    });
  }
/////////////////////////BUSINESS INITIATIVE FUNCTION END///////////////////////////////////

/////////////////////////INDUSTRY FUNCTION START//////////////////////////////////////////

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
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
    });
  }

/////////////////////////INDUSTRY FUNCTION END//////////////////////////////////////////

/////////////////////////PEARSONAS FUNCTION START//////////////////////////////////////////


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
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
    });
  }

/////////////////////////PEARSONAS FUNCTION END//////////////////////////////////////////

/////////////////////////COMPRTITIVE ANALYSIS FUNCTION START//////////////////////////////

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
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
    });
  }
/////////////////////////COMPRTITIVE ANALYSIS FUNCTION END////////////////////////////////

/////////////////////////WEBSITE FUNCTION START//////////////////////////////////////////

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
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
    });
  }
/////////////////////////WEBSITE FUNCTION END//////////////////////////////////////////

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
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
    });
  }

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
    
    var company_id = $("#company_id").val();

    $("#counter").val(1)
    // $("#budgets").html('');


    $.ajax({
        type: 'POST',
        url: '/storeBudget',
        data: {
            "_token": "{{ csrf_token() }}",
            //name and variable
            "expense_names":expense_names,
            "estimated_prices":estimated_prices,
            "company_id":company_id,

        },

        success: function(response) {
          Swal.fire({
            position: 'middle',
            icon: 'success',
            title: response,
            // title:'Author Saved',
            showConfirmButton: false,
            timer: 1500
          })
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
    });
    $("#budget_form").remove();
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

  @endsection