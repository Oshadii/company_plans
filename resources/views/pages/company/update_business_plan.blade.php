
@extends('layouts.user_type.auth')
@section('content')

    {{-- @include('libraries.style') --}}
    @include('libraries.script')
    <style>
        /* Style the form */
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
        padding-left: 70vh;
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

        <p>Buisiness Plan of Company :{{$company->name}}</p>

        <div class="container">

            <div class="tab">
                <div class="input-group w-60">
                    <h4 class="page-title2">1. Executive Summary</h4>
                </div><br>
                @foreach ($summaries as $key=>$summary)
                <div class="input-group w-60">
                    <h6>Company History:</h6>
                </div>
                <div class="form-group">
                    <input type="hidden" name="summary_id" id="{{'summary_id_'.$key}}" class="form-control" value="{{$summary->summary_id}}" >
                    <input type="text" name="history" id="{{'history_'.$key}}" class="form-control" value="{{$summary->history}}">
                </div>
                <div class="input-group w-60">
                    <h6>Overview:</h6>
                </div>
                <div class="form-group">
                    <input type="text" name="over_view" id="{{'over_view_'.$key}}" class="form-control" value="{{$summary->over_view}}">
                </div>
                <div class="input-group w-60">
                    <h6>Financial Projections:</h6>
                </div>
                <div class="form-group">
                    <input type="text" name="financial_project" id="{{'financial_project_'.$key}}" class="form-control" value="{{$summary->financial_project}}">
                </div>
                <div class="input-group w-60">
                    <h6>Investors:</h6>
                </div>
                <div class="form-group">
                    <input type="text" name="investors" id="{{'investors_'.$key}}" class="form-control" value="{{$summary->investors}}">
                </div><br><br><br>
                @endforeach
                
                <div class="btn-group">
                    <input type="button" onclick="update_summary({{count($summaries)}})" value="update executive summary" class="btn btn-primary">
                </div> 
            </div>
    
            <div class="tab">
                <div class="input-group w-60">
                    <h4 class="page-title2">2. Prepared By</h4>
                </div>
                <table class="table table-secondary table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="prepared_by_body">
                        @foreach ($prepared_by as $key=>$pre_by)  
                        <tr id="saved_business_prepared_by_delete{{$pre_by->prepared_by_id}}">
                            <td>
                                <input type="hidden" name="prepared_by_id" id="{{'prepared_by_id_'.$key}}" class="form-control" value="{{$pre_by->prepared_by_id}}" >
                                <input type="text" name="name" id="{{'name_'.$key}}" class="form-control" value="{{$pre_by->name}}">
                            </td>
                            <td>
                                <input type="email" name="email" id="{{'email_'.$key}}" class="form-control" value="{{$pre_by->email}}">
                            </td>
                            <td>
                                <input type="text" name="role" id="{{'role_'.$key}}" class="form-control" value="{{$pre_by->role}}">
                            </td>
                            <td>
                                <a href="#" class="btn btn-danger btn-sm" onclick="delete_added_prepared_by('{{$pre_by->prepared_by_id}}')"><i class="ni ni-fat-remove">remove</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                                      
                <div class="btn-group">
                    <input type="button" onclick="update_prepared_by({{count($prepared_by)}})" value="update Prepared by details" class="btn btn-primary">
                </div>
                <div class="input-group w-80">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                </div><br>
                <div class="input-group w-40">
                    <input type="text" name="role" id="role" class="form-control" placeholder="Role">
                </div><br>
                <div class="btn-group">
                    <input type="button" onclick="save_prepared_by()" value="Save Prepared by details" class="btn btn-primary">
                </div>        
            </div>
                   
            <div class="tab">
                <div class="input-group w-60">
                    <h4 class="page-title2">3 .Competitors</h4>
                </div><br>
                
                    <table class="table table-secondary table-striped">
                        <thead>
                            
                        </thead>
                        <tbody id="competitor_body">
                            @foreach ($competitors as $key=>$competitor)
                            <tr id="saved_business_competitor_delete1{{$competitor->competitor_id}}">
                                <th>Competitor Name</th>
                                <td>
                                    <input type="hidden" name="competitor_id" id="{{'competitor_id_'.$key}}" class="form-control" value="{{$competitor->competitor_id}}" >
                                    <input type="text" name="competitor_name" id="{{'competitor_name_'.$key}}" class="form-control" value="{{$competitor->competitor_name}}">
                                </td>
                                <td rowspan="4">
                                    <a href="#" class="btn btn-danger btn-sm" onclick="delete_added_competitor('{{$competitor->competitor_id}}')"><i class="ni ni-fat-remove">remove</i></a>
                                </td>
                            </tr>
                            <tr id="saved_business_competitor_delete2{{$competitor->competitor_id}}">
                                <th>Competitor Strength</th>
                                <td>
                                    <input type="text" name="competitor_strength" id="{{'competitor_strength_'.$key}}" class="form-control" value="{{$competitor->competitor_strength}}">
                                </td>
                            </tr>
                            <tr id="saved_business_competitor_delete3{{$competitor->competitor_id}}">
                                <th>Competitor Weaknesses</th>
                                <td>
                                    <input type="text" name="competitor_weak" id="{{'competitor_weak_'.$key}}" class="form-control" value="{{$competitor->competitor_weak}}">
                                </td>
                            </tr>
                            <tr id="saved_business_competitor_delete4{{$competitor->competitor_id}}">
                                <th>Counterpoint/s</th>
                                <td>
                                    <input type="text" name="counterpoint" id="{{'counterpoint_'.$key}}" class="form-control" value="{{$competitor->counterpoint}}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>                  
                <div class="btn-group">
                    <input type="button" onclick="update_competitor({{count($competitors)}})" value="update competitor details" class="btn btn-primary">
                </div>
                <div class="input-group w-60">
                    <h6>Competitor Name:</h6>
                </div>
                <div class="input-group w-80">
                    <input type="text" name="competitor_name" id="competitor_name" class="form-control" placeholder="competitor name">
                </div><br>
                <div class="input-group w-60">
                    <h6>Competitor Strength:</h6>
                </div>
                <div class="input-group w-80">
                    <input type="text" name="competitor_strength" id="competitor_strength" class="form-control" placeholder="What are your company’s assets that this competitor does not have?">
                </div><br>
                <div class="input-group w-60">
                    <h6>Competitor Weaknesses:</h6>
                </div>
                <div class="input-group w-80">
                    <input type="text" name="competitor_weak" id="competitor_weak" class="form-control" placeholder="In what areas or attributes do your competitors outperform you?">
                </div><br>
                <div class="input-group w-60">
                    <h6>Counterpoint/s:</h6>
                </div>
                <div class="input-group w-80">
                    <input type="text" name="counterpoint" id="counterpoint" class="form-control" placeholder="If a comparative weakness is mentioned in sales negotiations, which counterpoints can be used to address those weaknesses">
                </div><br>
                <div class="btn-group">
                    <input type="button" onclick="save_competitor()" value="save competitor details" class="btn btn-primary">
                </div>            
            </div>
                
            <form action="{{route('Update_Business_Plan')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="container">
                @foreach ($all_details as $detail)
                    
                    <div class="tab">
                        <div class="input-group w-60">
                            <input type="hidden" name="company_id" id="company_id" class="form-control" value="{{$company->id}}">
                        </div><br>
                        <div class="input-group w-60">
                            <h4 class="page-title2">4. Company & Business Description</h4>
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Company Purpose:</h6>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="b_id" class="form-control" value="{{$detail->b_id}}">
                            <textarea class="form-control" name="purpose" rows="3">{{$detail->purpose}}</textarea>    
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Core Values:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="core_val" rows="3">{{$detail->core_val}}</textarea>    
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Team & Org Structure:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="team_structure" rows="3">{{$detail->team_structure}}</textarea>    
                        </div><br>                  
                    </div>
                    
                    <div class="tab">
                        <div class="input-group w-60">
                            <h4 class="page-title2">5. Products and Services Line</h4>
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Product Offering(s):</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="product_offer" rows="3">{{$detail->product_offer}}</textarea>    
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Service Offerings:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="service_offer" rows="3">{{$detail->service_offer}}</textarea>    
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Pricing Model:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="pricing_model" rows="3">{{$detail->pricing_model}}</textarea>    
                        </div><br>                  
                    </div>
    
                    <div class="tab">
                        <div class="input-group w-60">
                            <h4 class="page-title2">6. Market Analysis</h4>
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Target Market:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="target_market" rows="3">{{$detail->target_market}}</textarea>    
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Buyer Personas:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="buyer_pearsona" rows="3" >{{$detail->buyer_pearsona}}</textarea>    
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Location Analysis:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="location_analysis" rows="3">{{$detail->location_analysis}}</textarea>    
                        </div><br>                  
                    </div>
    
                    <div class="tab">
                        <div class="input-group w-60">
                            <h4 class="page-title2">7. Marketing Plan</h4>
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Positioning Strategy:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="position" rows="3">{{$detail->position}}</textarea>    
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Acquisition Channels :</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="acquisition" rows="3">{{$detail->acquisition}}</textarea>    
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Tools and Technology:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="marketing_tools" rows="3">{{$detail->marketing_tools}}</textarea>    
                        </div><br>                  
                    </div>
    
                    <div class="tab">
                        <div class="input-group w-60">
                            <h4 class="page-title2">8. Sales Plan</h4>
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Sales Methodology:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="sales_meth" rows="3">{{$detail->sales_meth}}</textarea>    
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Sales Organization Structure:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="sales_structure" rows="3">{{$detail->sales_structure}}</textarea>    
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Sales Channels:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="sales_channel" rows="3">{{$detail->sales_channel}}</textarea>    
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Tools and Technology:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="sales_tech" rows="3">{{$detail->sales_tech}}</textarea>    
                        </div><br>                    
                    </div>
    
                    <div class="tab">
                        <div class="input-group w-60">
                            <h4 class="page-title2">9. Legal Notes</h4>
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Legal Structure:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="leagal_structure" rows="5">{{$detail->leagal_structure}}</textarea>    
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Legal Considerations:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="legal_consideration" rows="5">{{$detail->legal_consideration}}</textarea>    
                        </div><br>                  
                    </div>
    
                    <div class="tab">
                        <div class="input-group w-60">
                            <h4 class="page-title2">10. Financial Considerations</h4>
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Startup Costs:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="startup_cost" rows="3">{{$detail->startup_cost}}</textarea>    
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Sales Forecasts:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="sales_forcast" rows="3">{{$detail->sales_forcast}}</textarea>    
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Break-Even Analysis:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="analysis" rows="3">{{$detail->analysis}}</textarea>    
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Projected P&L:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="projected_pl" rows="3">{{$detail->projected_pl}}</textarea>    
                        </div><br>
                        <div class="input-group w-60">
                            <h6>Funding Requirements:</h6>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="funding_require" rows="3">{{$detail->funding_require}}</textarea>    
                        </div><br>
                        @endforeach
                        <div class="btn-group">
                            <input type="submit" value="update details" class="btn btn-primary">
                        </div>
                                        
                    </div>
                
                    <div style="overflow:auto;">
                        <div style="float:right;">
                        <button class="btn btn-info" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                        <button class="btn btn-info" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
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
                        {{-- <span class="step"></span> --}}

                    </div>

                </div>
            </form>

        </div>


    <script>

    function update_prepared_by(count) {

        var prepared_by_id = $("#prepared_by_id").val();
        var name = $("#name").val();
        var email = $("#email").val();
        var role = $("#role").val();
        var company_id = $("#company_id").val();


    for (let index = 0; index < count; index++) {
        $.ajax({
        type: 'POST',
        url: '/UpdatePreparedBy',
        data: {
            "_token": "{{ csrf_token() }}",
            "prepared_by_id":$("#prepared_by_id_"+index).val(),
            "name":$("#name_"+index).val(),
            "email":$("#email_"+index).val(),
            "role":$("#role_"+index).val(),
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
            title: 'prepared By Details Updated',
            showConfirmButton: false,
            timer: 1500
        });
        
    }

    function delete_added_prepared_by(id) {
    var prepared_by_id = $("#prepared_by_id").val();
    // console.log(id);
    $("#saved_business_prepared_by_delete"+id).remove();


    $.ajax({
        type: 'POST',
        url: '/delete_added_prepared_by/'+id,
        data: {
          "_token": "{{ csrf_token() }}",
          "prepared_by_id":$("#prepared_by_id"+id).val(),
        },

        success: function(response) {
          console.log(response);
                  
        }, error: function(data) {
            console.log(data);
        }
        
    });
  }

  function save_prepared_by() {

    var name = $("#name").val();
    var email = $("#email").val();
    var role = $("#role").val();
    var company_id = $("#company_id").val();

    $("#name").val('');
    $("#email").val('');
    $("#role").val('');


    $.ajax({
        type: 'POST',
        url: '/storePreparedBy',
        data: {
            "_token": "{{ csrf_token() }}",
            "name":name,
            "email":email,
            "role":role,
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
        $("#prepared_by_body").html('');
          count=1;
          response[1].forEach(element => {
            console.log(element);
            $("#prepared_by_body").append(

            '<tr id="saved_business_prepared_by_delete'+element.prepared_by_id+'">'+
                '<td>'+
                    '<input type="hidden" name="prepared_by_id" id="prepared_by_id_'+count+'" class="form-control" value="'+element.prepared_by_id+'" >'+
                    '<input type="text" name="name" id="name_'+count+'" class="form-control" value="'+element.name+'">'+
                '</td>'+
                '<td>'+
                    '<input type="email" name="email" id="email_'+count+'" class="form-control" value="'+element.email+'">'+
               ' </td>'+
                '<td>'+
                    '<input type="text" name="role" id="role_'+count+'" class="form-control" value="'+element.role+'">'+
                '</td>'+
                '<td>'+
                    '<a href="#" class="btn btn-danger btn-sm" onclick="delete_added_prepared_by('+element.prepared_by_id+')"><i class="ni ni-fat-remove">remove</i></a>'+
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

    

    function update_summary(count) {

        var summary_id = $("#summary_id").val();
        var history = $("#history").val();
        var over_view = $("#over_view").val();
        var financial_project = $("#financial_project").val();
        var investors = $("#investors").val();
        var company_id = $("#company_id").val();

        for (let index = 0; index < count; index++) {
            $.ajax({
            type: 'POST',
            url: '/UpdateSummary',
            data: {
                "_token": "{{ csrf_token() }}",
                "summary_id":$("#summary_id_"+index).val(),
                "history":$("#history_"+index).val(),
                "over_view":$("#over_view_"+index).val(),
                "financial_project":$("#financial_project_"+index).val(),
                "investors":$("#investors_"+index).val(),
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
            title: 'Summary Details Updated',
            showConfirmButton: false,
            timer: 1500
            });       
    }

    function update_competitor(count) {

        var competitor_id =  $("#competitor_id").val();
        var competitor_name = $("#competitor_name").val();
        var competitor_strength = $("#competitor_strength").val();
        var competitor_weak = $("#competitor_weak").val();
        var counterpoint = $("#counterpoint").val();
        var company_id = $("#company_id").val();


        for (let index = 0; index < count; index++) {
            $.ajax({
            type: 'POST',
            url: '/UpdateCompetitor',
            data: {
                "_token": "{{ csrf_token() }}",
                "competitor_id":$("#competitor_id_"+index).val(),
                "competitor_name":$("#competitor_name_"+index).val(),
                "competitor_strength":$("#competitor_strength_"+index).val(),
                "competitor_weak":$("#competitor_weak_"+index).val(),
                "counterpoint":$("#counterpoint_"+index).val(),
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
            title: 'Competitor Updated',
            showConfirmButton: false,
            timer: 1500
        });
        
    }

    function save_competitor() {

        var competitor_name = $("#competitor_name").val();
        var competitor_strength = $("#competitor_strength").val();
        var competitor_weak = $("#competitor_weak").val();
        var counterpoint = $("#counterpoint").val();
        var company_id = $("#company_id").val();

        $("#competitor_name").val('');
        $("#competitor_strength").val('');
        $("#competitor_weak").val('');
        $("#counterpoint").val('');



        $.ajax({
            type: 'POST',
            url: '/storeCompetitor',
            data: {
                "_token": "{{ csrf_token() }}",
                "competitor_name":competitor_name,
                "competitor_strength":competitor_strength,
                "competitor_weak":competitor_weak,
                "counterpoint":counterpoint,
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
            $("#competitor_body").html('');
          count=1;
          response[1].forEach(element => {
            console.log(element);
            $("#competitor_body").append(

           ' <tr id="saved_business_competitor_delete1'+element.competitor_id+'">'+
                '<th>Competitor Name</th>'+
               ' <td>'+
                    '<input type="hidden" name="competitor_id" id="competitor_id_'+count+'" class="form-control" value="'+element.competitor_id+'" >'+
                    '<input type="text" name="competitor_name" id="competitor_name_'+count+'" class="form-control" value="'+element.competitor_name+'">'+
               ' </td>'+
               ' <td rowspan="4">'+
                    '<a href="#" class="btn btn-danger btn-sm" onclick="delete_added_competitor('+element.competitor_id+')"><i class="ni ni-fat-remove">remove</i></a>'+
               ' </td>'+
            '</tr>'+
           ' <tr id="saved_business_competitor_delete2'+element.competitor_id+'">'+
               ' <th>Competitor Strength</th>'+
               ' <td>'+
                  '  <input type="text" name="competitor_strength" id="competitor_strength_'+count+'" class="form-control" value="'+element.competitor_strength+'">'+
                '</td>'+
            '</tr>'+
           ' <tr id="saved_business_competitor_delete3'+element.competitor_id+'">'+
                '<th>Competitor Weaknesses</th>'+
                '<td>'+
                    '<input type="text" name="competitor_weak" id="competitor_weak_'+count+'" class="form-control" value="'+element.competitor_weak+'">'+
               ' </td>'+
           ' </tr>'+
            '<tr id="saved_business_competitor_delete4'+element.competitor_id+'">'+
                '<th>Counterpoint/s</th>'+
                '<td>'+
                    '<input type="text" name="counterpoint" id="counterpoint_'+count+'" class="form-control" value="'+element.counterpoint+'">'+
                '</td>'+
          '  </tr>'
            );
            count++;
          });
                    
            }, error: function(data) {
                console.log(data);
            }
        });
        }

    function delete_added_competitor(id) {

    var competitor_id = $("#competitor_id").val();
    // console.log(id);
    $("#saved_business_competitor_delete1"+id).remove();
    $("#saved_business_competitor_delete2"+id).remove();
    $("#saved_business_competitor_delete3"+id).remove();
    $("#saved_business_competitor_delete4"+id).remove();



    $.ajax({
        type: 'POST',
        url: '/delete_added_competitor/'+id,
        data: {
          "_token": "{{ csrf_token() }}",
          "competitor_id":$("#competitor_id"+id).val(),
        },

        success: function(response) {
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
                document.getElementById("regForm").submit();
                return false;
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