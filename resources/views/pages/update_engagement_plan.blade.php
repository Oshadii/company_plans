@extends('layouts.user_type.auth')
@section('content')

    @include('libraries.style')
    @include('libraries.script')
    <style>
        .page-title1{
            font-size: 6vh;
        color: #cc2c61;
        padding-top: 3vh;
        padding-left: 30%;
        }
        .page-title4{
            font-size: 3vh;
        color: #1b1616;
        font-weight: bold;
        padding-top: 2.7vh;
        padding-left: 0%;
        }
        .para{
            font-size: 2vh;
            color: rgb(196, 86, 134)
        }
        th{
            font-size: 3vh;
            /* font-weight: 500; */
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

                {{-- <a class="navbar-brand" href="{{route('Engagedment_plan')}}">Back To Engagement Plan</a> --}}
                <p class="para">Touchpoint :"{{$en_touchpoint->engagement_touchpoint}}"</p>               
                {{-- <h1 class="page-title1">Update Engagement Plan Details</h1><br><br> --}}

                <form action="{{route('Update_engagement_details')}}" method="post" autocomplete="off">
                    @csrf
                    <input type="hidden" name="engagement_touchpoint_id" value="{{$en_touchpoint->id}}">
                    <input type="hidden" name="id" value="{{$details->id}}">

                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <h5>1. Presence :-</h5>
                            <select name="presence" id="" class="form-control">
                                <option value="{{$details->presence}}">current database value '{{$details->presence}}'</option>
                                <option value="N/A">N/A</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select><div class="col-lg-1"></div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <h5>2. Followership :-</h5>
                            <input type="text" name="followership" class="form-control" value="{{$details->followership}}">                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <h5>3. Recency :-</h5>
                            <select name="recency" id="" class="form-control">
                                <option value="{{$details->recency}}">current database value '{{$details->recency}}'</option>
                                <option value="N/A">N/A</option>
                                <option value="Good">Good</option>
                                <option value="Average">Average</option>
                                <option value="Poor">Poor</option>
                            </select><div class="col-lg-1"></div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <h5>4. Responsiveness :-</h5>
                            <select name="responsiveness" id="" class="form-control">
                                <option value="{{$details->responsiveness}}">current database value '{{$details->responsiveness}}'</option>
                                <option value="N/A">N/A</option>
                                <option value="Good">Good</option>
                                <option value="Average">Average</option>
                                <option value="Poor">Poor</option>
                            </select>
                          </div>
                        </div>
                      </div>

                    
                    <div class="form-group">
                        <h5>5. Competitor Activity :-</h5><br>
                        <textarea name="competitor_analysis" id="" cols="155" rows="4">{{$details->competitor_analysis}}</textarea>
                    </div><br><br>

                    <div class="input-group w-60">
                        <h5>6. Engagement Objective :-</h5>
                        <table class="table table-light table-hover" id="sampleTable">
                            <thead>
                              <tr>
                                <th>
                                    <input type="button" onclick="insert_Row1()" value="Add Engagement Objective" class="btn bg-gradient-success" style="float: right;">
                                </th>
                              </tr>
                            </thead>
                            <tbody id="objective_body">
                                <td>
                                    @foreach(explode(',', $details->engagement_objective) as $info)
                                        {{-- <textarea name="" id="" cols="80" rows="1">{{ $info }}</textarea> --}}
                                        <option>{{$info}}</option>
                                    @endforeach
                                </td>
                            </tbody>                      
                          </table>
                                                   
                        <input name="counter" type="hidden" id="counter" value="1">
                    </div><br><br>

                    <div class="form-group">
                        <h5>7. Describe what need to be done, to achieve this objective :-</h5><br>
                        <textarea name="need_to_be_done" id="" cols="155" rows="4">{{$details->need_to_be_done}}</textarea>
                    </div>
                    <div class="input-group w-60">
                        <br><br>
                    </div>

                    <div class="input-group w-60">
                        <table class="table table-light table-hover" id="sampleTableTwo">
                            <thead>
                              <tr>
                                <th class="th">8. Key Result to Measure </th>
                                <th class="th">9. Target Results</th>
                                <th>
                                    <input type="button" onclick="insert_Row()" value="Add Row" class="btn bg-gradient-success" style="float: right;">
                                </th>
                              </tr>
                            </thead>
                            <tbody id="target_body">
                                <tr>
                                    <td>
                                        @foreach(explode(',', $details->key_result) as $info)
                                        {{-- <textarea name="" id="" cols="80" rows="1">{{ $info }}</textarea> --}}
                                        <option>{{$info}}</option>
                                    @endforeach
                                    </td>
                                    <td>
                                        @foreach(explode(',', $details->target_result) as $info)
                                        {{-- <textarea name="" id="" cols="80" rows="1">{{ $info }}</textarea> --}}
                                        <option>{{$info}}</option>
                                    @endforeach
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>                      
                          </table>
                                                    
                        <input name="count" type="hidden" id="count" value="1">
                    </div><br><br>

                    <div class="input-group w-60">
                        <br><br>
                    </div>
                    
                    <div class="form-group">
                        <h5>10. Budget Allocated :-</h5><br>
                        <textarea name="budget_allocated" id="" cols="155" rows="4" >{{$details->budget_allocated}}</textarea>
                    </div><br><br>

                    <div class="input-group w-60">
                        <br><br>
                    </div>

                    <div class="input-group w-60">
                        <input type="submit" value="Update Details" class="btn bg-gradient-primary">
                    </div><br><br>

                </form>
            </div>
        </div>
    </div>

    <script>
        function insert_Row1(){
            var counter=document.getElementById('counter').value;
            tr ='<tr><td><textarea name="engagement_objective'+counter+'"  cols="155" rows="2"></textarea></td></tr>';
            $("#objective_body").append(tr); 
            counter++;
            document.getElementById('counter').value=counter;
        }
        function insert_Row(){
              var count=document.getElementById('count').value;
              console.log("count=======",count);
            tr ='<tr><td><textarea name="key_result'+count+'"  cols="65" rows="1"></textarea></td>'+'<td><textarea name="target_result'+count+'" id="" cols="65" rows="1"></textarea></td></tr>';
            $("#target_body").append(tr); 
            count++;
            document.getElementById('count').value=count;
            // var input_val=$("#test_input").val();
            // $("#test_input").val("value");
        }
    </script>

@endsection