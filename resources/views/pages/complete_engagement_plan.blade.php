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
                <h1 class="page-title1">Engagement Plan For </h1>

                    <div class="input-group w-60">
                        <div class="col-lg-2">
                            <h4 class="page-title4">Planing Period: </h4>
                        </div>
                        <div class="col-lg-4">
                            <h6>Start Date: </h6>
                            <div class="input-group w-60">
                                <input type="text" name="started_date" class="form-control" value="{{$enparent->started_date}}">
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-4">
                            <h6>End Date: </h6>
                            <div class="input-group w-60">
                                <input type="text" name="end_date" class="form-control" value="{{$enparent->end_date}}">
                            </div>
                        </div>                       
                    </div><br>

                    <div class="container">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Engagement Platform / Touchpoint</th>
                                <th scope="col">Presence (Y/N)</th>
                                <th scope="col">Followership (Count)</th>
                                <th scope="col">Recency (Good - Average - Poor)</th>
                                <th scope="col">Responsiveness (Good - Average - Poor)</th>
                                <th scope="col">Competitor Activity (Describe from the perspective of Presence, Followership, Recency and Responsiveness)</th>
                                <th scope="col">Engagement Objective</th>
                                <th scope="col">Describe what need to be done, to achieve this objective</th>
                                <th scope="col">Key Result to Measure (Followers, Views, Interactions, Engagement Rate etc)</th>
                                <th scope="col">Target Results</th>
                                <th scope="col">Budget Allocated</th>
                              </tr>
                            </thead>
                            <tbody>

                                @foreach ($details as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{$item->engagement_touchpoint}}</td>     
                                    <td>{{$item->presence}}</td>
                                    <td>{{$item->followership}}</td>
                                    <td>{{$item->recency}}</td>
                                    <td>{{$item->responsiveness}}</td>
                                    <td>{{$item->competitor_analysis}}</td>
                                    {{-- <td>{{$item->engagement_objective}}</td> --}}
                                    <td>
                                        @foreach(explode(',', $item->engagement_objective) as $info)
                                            <option>{{$info}}</option><br>
                                        @endforeach
                                    </td>
                                    <td>{{$item->need_to_be_done}}</td>
                                    {{-- <td>{{$item->key_result}}</td> --}}
                                    {{-- <td>{{$item->target_result}}</td> --}}
                                    <td>
                                        @foreach(explode(',', $item->key_result) as $info)
                                            <option>{{$info}}</option><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach(explode(',', $item->target_result) as $info)
                                            <option>{{$info}}</option><br>
                                        @endforeach
                                    </td>
                                    <td>{{$item->budget_allocated}}</td>
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