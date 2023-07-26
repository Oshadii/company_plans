@extends('layouts.user_type.auth')
@section('content')

    {{-- @include('libraries.style') --}}
    @include('libraries.script')
    <style>
        .page-title1{
            font-size: 6vh;
        color: #df1537;
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


                {{-- SET START DATE --}}
                <form action="{{route('engagement_start')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="company_id" value="{{$enparent->company_id}}" class="form-control" placeholder="Company Id (from the company list)" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="company_name" value="{{$enparent->company_name}}" class="form-control" placeholder="Company Name (from the company list)" required>
                    </div>
                
                    <div class="row">
                        <h6>Start Date: </h6>
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="hidden" name="id" class="form-control" value="{{$enparent->id}}">
                            <input type="date" name="started_date" class="form-control" value="{{$enparent->started_date}}" required>                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            @if ($enparent->started_date==null)
                                <input type="submit" value="Set start date" class="btn bg-gradient-success">
                            @endif                           
                            </div>
                        </div>
                      </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            
                        </div>
                        <div class="form-group">                                    
                                                     
                        </div>                        
                    </div>                                    
                </form>
                   

                {{-- ADD TOUCHPOINTS aND LIST TOUCHPOINTS--}}
                <form action="{{route('Store_Engagedment_Touchpoint')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="hidden" name="parent_engagement_id" class="form-control" value="{{$enparent->id}}">
                            <input type="text" name="engagement_touchpoint" id="engagement_touchpoint" class="form-control @error('engagement_touchpoint') is-invalid @enderror" placeholder="Engagement Platform / Touchpoint">
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="submit" value="Add Touchpoints"  class="btn bg-gradient-secondary">
                            </div>
                        </div>
                      </div>
                </form>

                <table class="table table-secondary table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Engagedement Touchpoints</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($en_touchpoints as $en_touchpoint)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{$en_touchpoint->engagement_touchpoint}}</td>
                            <td>
                                @if ($en_touchpoint->details_filled)
                                    <a href="{{url('Update_Engagement_Plan_Details/' .$en_touchpoint->id)}}" class="btn bg-gradient-secondary">Update Details</a>
                                @else
                                    <a href="{{url('Add_Engagedment_Plan_Details/' .$en_touchpoint->id)}}" class="btn bg-gradient-success">Add Details</a>
                                @endif
                            </td>
                          </tr> 
                        @endforeach
                    </tbody>
                </table>


                <form action="{{route('engagement_submit')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="input-group w-60">
                        <input type="hidden" name="id" class="form-control" value="{{$enparent->id}}">
                        <a href="{{url('View_Engagement_Plan/'.$enparent->id)}}"  class="btn bg-gradient-secondary">View Plan</a>
                        @if ($enparent->end_date!=null)
                            <input type="submit" value="Submit" class="btn bg-gradient-secondary">
                            <p class="para">Each touchpoint must contain details.(Check "Update button" present for all touchpoint )</p>
                        @endif
                        
                    </div><br>
                </form>

                {{-- SET END DATE --}}

                <form action="{{route('engagement_end')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <h6>End Date: </h6>
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="hidden" name="id" class="form-control" value="{{$enparent->id}}">
                            <input type="date" name="end_date" class="form-control" value="{{$enparent->end_date}}" required>                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            @if ($enparent->end_date==null)
                                <input type="submit" value="Set end date" class="btn bg-gradient-success">
                             @endif 
                          </div>
                        </div>
                      </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                       
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection