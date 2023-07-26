@extends('layouts.user_type.auth')
@section('content')

{{-- message --}}
@if(session()->has('message'))
<p class="alert alert-secondary"> {{ session()->get('message') }}</p>
@endif
{{-- message  end--}}

<div class="container">
    <div class="row">
       <div class="col-lg-12">
        
        <a href="{{route('addCompanyDetails')}}" class="btn bg-gradient-dark"><i class="ni ni-fat-add">Add Company</i></a><br><br>
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        {{-- <th scope="col">No.</th> --}}
                        <th scope="col">Company Id</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">logo</th>           
                        <th scope="col">Action</th>           
                    </tr>
                </thead>
                <tbody>
                    @foreach ($com as $item )
            
                        <tr>
                            {{-- <th>{{ $loop->iteration }}</th> --}}
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td><img src="{{ asset($item->logo) }}" width="50" height="50" class="img img-responsive" /></td>
                            <td>
                                @if ($item->market_plan_filled)
                                    <a href="{{url('Edit_Marketing_Plan/' .$item->id)}}" class="btn btn-primary btn-sm">Update Marketing Plan</a>
                                @else
                                    <a href="{{url('addMarketingPlan/' .$item->id)}}" class="btn btn-dark btn-sm">Create Marketing Plan</a>
                                @endif
                                
                                @if ($item->business_plan_filled)
                                    <a href="{{url('Edit_Business_Plan/' .$item->id)}}" class="btn btn-primary btn-sm">Update Business Plan</a>
                                @else
                                    <a href="{{url('addBusinessPlan/' .$item->id)}}" class="btn btn-dark btn-sm">create Business Plan</a>
                                @endif
                                <a href="{{url('Delete_Company/' .$item->id)}}" class="btn btn-danger btn-sm">Delete Company</a>
                            </td>
                        </tr>
                    
                    @endforeach
                </tbody>
            </table>
       </div>
    </div>
</div>

@endsection

