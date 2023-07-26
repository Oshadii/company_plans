@extends('layouts.user_type.auth')
@section('content')

{{-- message --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{-- message  end--}}

<div class="container">
    <div class="row">
       <div class="col-lg-12">
        <h1 class="page-title">Company Details</h1><br>
        
        <form action="{{route('companyStore')}}" method="post" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="tab">
        
                <div class="input-group ">
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Company Name" >
                    {{-- @error('name')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p> 
                    @enderror --}}
                    <input type="text" id="telephone" name="telephone" class="form-control @error('name') is-invalid @enderror" placeholder="Telephone">
                    {{-- @error('telephone')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p> 
                    @enderror --}}
                </div><br>

                <div class="input-group">
                    <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Company Address">
                    {{-- @error('address')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p> 
                    @enderror --}}
                    <input type="email" name="email" class="form-control @error('address') is-invalid @enderror" placeholder="Company Email">
                    {{-- @error('email')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror --}}
                </div><br>

                <div class="input-group">
                    <input type="text" name="current_year" id="current_year" class="form-control @error('address') is-invalid @enderror" placeholder="Current Year">
                    <input type="text" name="location_hq" class="form-control @error('address') is-invalid @enderror" placeholder="Location of HQ">
                </div><br>
                <div class="input-group">
                    <input type="text" name="location_satellite" class="form-control @error('address') is-invalid @enderror" placeholder="Satellite Location">
                    <input type="text" name="mission" class="form-control @error('address') is-invalid @enderror" placeholder="Mission">
                </div><br>
                <div class="input-group">
                    <input type="text" name="goal" class="form-control @error('address') is-invalid @enderror" placeholder="Company Goal">
                </div><br>
                <div class="input-group">
                    <input type="text" name="objective" class="form-control @error('address') is-invalid @enderror" placeholder="Company Objective">
                </div><br>
                <div class="input-group">
                    <input type="text" name="vision" class="form-control @error('address') is-invalid @enderror" placeholder="Company Vision">
                </div><br>
                <div class="input-group w-60">
                    <input type="file" name="logo"  class="form-control @error('address') is-invalid @enderror" id="logo"><br>
                </div><br>
                <div class="btn-group">
                    <input type="submit" value="save company details" class="btn btn-primary">
                </div>

            </div>
        </form>
       </div>
    </div>
</div>

@endsection

@push('css')
<style>
    .page-title{
        font-size: 4vh;
    color: #e80e0e;
    padding-top: 4vh;
    padding-left: 60vh;

    }
</style>
@endpush
