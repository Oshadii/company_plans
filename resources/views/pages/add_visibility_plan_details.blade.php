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

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="para">Touchpoint: "{{$touchpoint->touchpoint}}"</p>
                {{-- <h1 class="page-title1">Add Visibility Plan Details</h1> --}}
                <form action="{{route('Store_Visibility_Plan')}}" method="post" autocomplete="off">
                    @csrf
                    <input type="hidden" name="touchpoint_id" value="{{$touchpoint->id}}">
                    <div class="input-group w-60">
                        <div class="col-lg-12">
                            <h6 class="page-title4">1. Current Status: </h6>
                            <textarea name="current_status" id="" cols="155" rows="4" placeholder="Describe your position compared to competitors"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <h6 class="page-title4">2. Desired Status: </h6>
                            <textarea name="desired_status" id="" cols="155" rows="4" placeholder="Describe how things ideally  should be"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <h6 class="page-title4">3. Desired Status: </h6>
                            <textarea name="way_to_bridge_gap" id="" cols="155" rows="4" placeholder="Describe how are you going to bridge this gap"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <h6 class="page-title4">4. Budget Allocated: </h6>
                            <textarea name="budget_allocated" id="" cols="155" rows="4" placeholder="in $"></textarea>
                        </div><br>

                        <div class="col-lg-12"><br><br></div>
                        <div class="col-lg-12">
                            <table class="table table-light table-hover" id="sampleTable">
                                <thead>
                                  <tr>
                                    <th class="th">5. Metrics to Measure</th>
                                    <th class="th">6. Target Results</th>
                                    <th>
                                        {{-- <div class="btn-group"> --}}
                                            <input type="button" onclick="insert_Row()" value="Add Row" class="btn bg-gradient-info" style="float: right;">
                                            {{-- <button type="submit" class="btn btn-info btn-md">save</button> --}}
                                        {{-- </div> --}}
                                    </th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
          
                                  </tr>
                                </tbody>                      
                              </table>
                            </div>                            
                            <input name="counter" type="hidden" id="counter" value="1">
                        </div>

                        <div class="col-lg-12">
                            <h6 class="page-title4">7. Other Resources: </h6>
                            <textarea name="other_resources" id="" cols="155" rows="4" placeholder="Describe Other resources"></textarea>
                        </div>
                        <div class="col-lg-2"><br>
                            <input type="submit" value="Save Details" class="btn bg-gradient-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function insert_Row(){
            // var counter=1;
            var counter=document.getElementById('counter').value;
            var xTable = document.getElementById('sampleTable');
            var tr = document.createElement('tr');
            tr.innerHTML ='<td><textarea name="metrics_to_measure'+counter+'" id="" cols="65" rows="1"></textarea></td>'+'<td><textarea name="target_result'+counter+'" id="" cols="65" rows="1"></textarea></td>';      
            xTable.children[0].appendChild(tr); // appends to the tbody element
            counter++;
            document.getElementById('counter').value=counter;
        }
    </script>

@endsection