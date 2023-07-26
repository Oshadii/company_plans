<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spreadsheet_of_brands</title>
    @include('libraries.style')
    @include('libraries.script')
    <style>
        .page-title1{
            font-size: 6vh;
        color: #0b0b17;
        padding-top: 3vh;
        padding-left: 40%;
        }
        .page-title4{
            font-size: 4vh;
        color: #04051f;
        padding-top: 3vh;
        padding-left: 5%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-title1">Visibility Plan For </h1>

                    <div class="input-group w-60">
                        <div class="col-lg-2">
                            <h4 class="page-title4">Planing Period: </h4>
                        </div>
                        <div class="col-lg-4">
                            <h6>Start Date: </h6>
                            <div class="input-group w-60">
                                <input type="text" name="started_date" class="form-control" value="{{$parent->started_date}}">
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-4">
                            <h6>End Date: </h6>
                            <div class="input-group w-60">
                                <input type="text" name="end_date" class="form-control" value="{{$parent->end_date}}">
                            </div>
                        </div>                       
                    </div><br>

                    <div class="container">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">VISIBILITY TOUCHPOINTS</th>
                                <th scope="col">Current Status (Describe your position compared to competitors)</th>
                                <th scope="col">Desired Status (Describe how things ideally  should be)</th>
                                <th scope="col">Describe how are you going to bridge this gap</th>
                                <th scope="col">Budget Allocated</th>
                                <th scope="col">Metrics to Measure</th>
                                <th scope="col">Target Results</th>
                                <th scope="col">Other Resources</th>
                              </tr>
                            </thead>
                            <tbody>

                                @foreach ($visibility_detail as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>     
                                    <td>{{$item->touchpoint}}</td>
                                    <td>{{$item->current_status}}</td>
                                    <td>{{$item->desired_status}}</td>
                                    <td>{{$item->way_to_bridge_gap}}</td>
                                    <td>{{$item->budget_allocated}}</td>
                                    {{-- <td>{{$item->metrics_to_measure}}</td> --}}
                                    <td>
                                         @foreach(explode(',', $item->metrics_to_measure) as $info)
                                            <option>{{$info}}</option><br>
                                         @endforeach
                                    </td>
                                    <td>
                                        @foreach(explode(',', $item->target_result) as $info)
                                           <option>{{$info}}</option><br>
                                        @endforeach
                                   </td>
                                    {{-- <td>{{$item->target_result}}</td> --}}
                                    <td>{{$item->other_resources}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                          </table>
                    </div>


              
            </div>
        </div>
    </div>
</body>
</html>