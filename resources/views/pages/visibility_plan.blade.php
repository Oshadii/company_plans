@extends('layouts.user_type.auth')
@section('content')

    {{-- @include('libraries.style') --}}
    @include('libraries.script')
    <style>
        .page-title1{
            font-size: 6vh;
        color: #161b9d;
        padding-top: 3vh;
        padding-left: 40%;
        }
        .page-title4{
            font-size: 4vh;
        color: #04051f;
        padding-top: 3vh;
        padding-left: 5%;
        }
        .para{
            color: red;
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
           

                <form action="{{route('Store_Parent_Visibility_Plan')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="company_id" value="{{$parent->company_id}}" class="form-control" placeholder="Company Id (from the company list)" required>
                    </div>

                    <div class="form-group">
                        <input type="text" name="company_name" value="{{$parent->company_name}}" class="form-control" placeholder="Company Name (from the company list)" required>
                    </div><br>


                    <div class="row">
                        <h6>Start Date: </h6>
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="hidden" name="id" class="form-control" value="{{$parent->id}}">
                            <input type="date" name="started_date" class="form-control" value="{{$parent->started_date}}" required>                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            @if ($parent->started_date==null)
                                <input type="submit" value="Set start date" class="btn bg-gradient-primary">
                            @endif
                          </div>
                        </div>
                    </div>

                </form>

                <form action="{{route('Store_Touchpoint')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="parent_visibility_plan_id" class="form-control" value="{{$parent->id}}">
                                <input type="text" name="touchpoint" id="touchpoint" class="form-control @error('touchpoint') is-invalid @enderror" placeholder="Visibility Touchpoints">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="submit" value="Add Touchpoints" class="btn bg-gradient-secondary">
                            </div>
                        </div>
                      </div>
                </form>

                <table class="table table-secondary table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Visibility Touchpoints</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($touchpoints as $touchpoint)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{$touchpoint->touchpoint}}</td>
                            <td>
                                @if ($touchpoint->details_filled)
                                    <a href="{{url('Update_visibility_Plan_Details/' .$touchpoint->id)}}" class="btn bg-gradient-secondary">Update Details</a>
                                @else
                                    <a href="{{url('Add_visibility_Plan_Details/' .$touchpoint->id)}}" class="btn bg-gradient-primary">Add Details</a>
                                @endif
                            </td>
                          </tr> 
                        @endforeach
                    </tbody>
                </table>

            {{-- <a href="{{url('View_Vsibility_Plan')}}" class="btn btn-primary btn-sm">View Plan</a> --}}
                <form action="{{route('submit')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="input-group w-60">
                        <input type="hidden" name="id" class="form-control" value="{{$parent->id}}">
                        <a href="{{url('View_Vsibility_Plan/'.$parent->id)}}" class="btn bg-gradient-secondary">View Plan</a>
                        @if ($parent->end_date!=null)
                            <input type="submit" value="Submit" class="btn bg-gradient-secondary">
                            <p class="para">Each touchpoint must contain details.(Check "Update button" present for all touchpoint )</p>
                        @endif                
                    </div>
                </form>

                <form action="{{route('set_end_date')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <h6>End Date: </h6>
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="hidden" name="id" class="form-control" value="{{$parent->id}}">
                            <input type="date" name="end_date" class="form-control" value="{{$parent->end_date}}" required>                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            @if ($parent->end_date==null)
                                <input type="submit" value="Set end date" class="btn bg-gradient-primary">
                            @endif
                            </div>
                        </div>
                      </div>
                </form>

            </div>
        </div>
    </div>

@endsection