@extends('layouts.user_type.auth')
@section('content')

    @include('libraries.style')
    @include('libraries.script')
    <style>
        .page-title1{
            font-size: 6vh;
        color: #8588e7;
        padding-top: 3vh;
        padding-left: 30%;
        }
        .page-title4{
            font-size: 3vh;
        color: #04051f;
        padding-top: 3vh;
        padding-left: 0%;
        }
        .para{
            font-size: 2vh;
            color: rgb(74, 136, 228)
        }
        th{
            font-size: 3vh;
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
              
                <div class="container-fluid">
                <p class="para">Touchpoint : "{{$touchpoint->touchpoint}}"</p>
                {{-- <a class="btn bg-gradient-danger" href="{{route('visibility_plan')}}">Back</a> --}}
                </div>
              

                <form action="{{route('Update_touchpoint_name')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                                <input type="hidden" name="id" class="form-control" value="{{$touchpoint->id}}">
                                <input type="text" name="touchpoint" class="form-control" value="{{$touchpoint->touchpoint}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="submit" value="Change Visibility Touchpoint Name" class="btn bg-gradient-primary">
                            </div>
                        </div>
                      </div>
                </form>

                {{-- <h1 class="page-title1">Update Visibility Plan Details</h1> --}}
                <form action="{{route('Update_visibility_details')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="input-group w-60">
                        <div class="col-lg-12">
                            <input type="hidden" name="id" class="form-control" value="{{$visibility_detail->id}}">
                            <h6 class="page-title4">1. Current Status: </h6>
                            <textarea name="current_status" id="" cols="155" rows="4">{{$visibility_detail->current_status}}</textarea>
                        </div>
                        <div class="col-lg-12">
                            <h6 class="page-title4">2. Desired Status: </h6>
                            <textarea name="desired_status" id="" cols="155" rows="4">{{$visibility_detail->desired_status}}</textarea>
                        </div>
                        <div class="col-lg-12">
                            <h6 class="page-title4">3. Desired Status: </h6>
                            <textarea name="way_to_bridge_gap" id="" cols="155" rows="4">{{$visibility_detail->way_to_bridge_gap}}</textarea>
                        </div>
                        <div class="col-lg-12">
                            <h6 class="page-title4">4. Budget Allocated: </h6>
                            <textarea name="budget_allocated" id="" cols="155" rows="4">{{$visibility_detail->budget_allocated}}</textarea>
                        </div><br>

                        <div class="col-lg-12"><br><br></div>
                        <div class="col-lg-12">
                            <table class="table table-light table-hover" id="sampleTable">
                                <thead>
                                  <tr>
                                    <th class="th">5. Metrics to Measure</th>
                                    <th class="th">6. Target Results</th>
                                    <th>
                                        <input type="button" onclick="insert_Row()" value="Click to insert row" class="btn bg-gradient-info" style="float: right;">

                                    </th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>
                                        @foreach(explode(',', $visibility_detail->metrics_to_measure) as $info)
                                            <option>{{$info}}</option>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach(explode(',', $visibility_detail->target_result) as $info)
                                        <option>{{$info}}</option>
                                         @endforeach
                                    </td>
                                    <td>
                                        
                                    </td>
                                  </tr>
                                </tbody>                      
                              </table>
                            </div>                            
                            <input name="counter" type="hidden" id="counter" value="1">

                        <div class="col-lg-12">
                            <h6 class="page-title4">7. Other Resources: </h6>
                            <textarea name="other_resources" id="" cols="155" rows="4">{{$visibility_detail->other_resources}}</textarea>
                        </div>
                        <div class="col-lg-2"><br>
                            <input type="submit" value="Update Details" class="btn bg-gradient-primary">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function insert_Row(){
            var counter=document.getElementById('counter').value;
            var xTable = document.getElementById('sampleTable');
            var tr = document.createElement('tr');            
            tr.innerHTML ='<td><textarea name="metrics_to_measure'+counter+'" id="" cols="60" rows="1"></textarea></td>'+'<td><textarea name="target_result'+counter+'" id="" cols="60" rows="1"></textarea></td>';      
            xTable.children[0].appendChild(tr); 
            counter++;
            document.getElementById('counter').value=counter;
        }
    </script>

@endsection