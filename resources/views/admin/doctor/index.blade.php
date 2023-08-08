@extends('layouts.main')
@section('title', __('main.Doctors'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Doctor') }}</h5>
                            <span>{{ __('main.Doctor_List') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('main.Doctor') }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header">
                        <h3>{{ __('main.Doctor_List') }}</h3>
                        @can('doctor-create')
                            <a class="btn btn-primary ml-auto" href="{{ route('doctor.create') }}">{{ __('main.Add') }}</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($user as $user)
        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="exampleModalCenter{{ $user->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="container-fluid">                                
                                    <div class="card-body">
                                        <h5 class="card-title">{{ __('main.Doctor_Details') }}</h5>
                                        <img class="card-img-top cus-card-img" src="{{ isset($user->image) ? asset(path_user_image() . $user->image) : Avatar::create($user->name)->toBase64() }}" />
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">                                        
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">{{ __('main.Name_') }}: {{ $user->name }}</li>
                                                <li class="list-group-item">{{ __('main.Email_') }}: {{ $user->email }}</li>
                                                <li class="list-group-item">{{ __('main.Gender_') }}: {{ $user->gender }}</li>
                                                <li class="list-group-item">{{ __('main.Brith Day_') }}: {{ $user->dob }}</li>
                                                <li class="list-group-item">{{ __('main.Qualification_') }}: {{ $user->qualification }}</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-group list-group-flush">                                            
                                                <li class="list-group-item">{{ __('main.Ph Number_') }}: {{ $user->mobile }}</li>
                                                <li class="list-group-item">{{ __('main.Address_') }}: {{ $user->address }}</li>
                                                <li class="list-group-item">{{ __('main.City_') }}: {{ $user->city }}</li>
                                                <li class="list-group-item">{{ __('main.Created_At_') }}:
                                                    {{ $user->created_at->diffForHumans() }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h6>{{ __('main.Document One_') }}</h6>
                                            <!-- <img class="card-img-top cus-card-img" src="{{ isset($user->file_one) ? asset(path_user_image() . $user->file_one) : Avatar::create($user->file_one)->toBase64() }}" /> -->
                                            <span><a class="btn btn-primary" href="{{asset('public/doctor/doc/' . $user->file_one)}}" download="{{$user->file_one}}">Download</a></br></span></br>
                                            <span><a class="btn btn-secondary" href="{{asset('public/doctor/doc/' . $user->file_one)}}" target="_blank">Open File</a></span>
                                        </div>
                                        <div class="col-md-4">
                                            <h6>{{ __('main.Document Two_') }}</h6>
                                            <!-- <img class="card-img-top cus-card-img" src="{{ isset($user->file_two) ? asset(path_user_image() . $user->file_two) : Avatar::create($user->file_two)->toBase64() }}" /> -->
                                            <span><a class="btn btn-primary" href="{{asset('public/doctor/doc/' . $user->file_two)}}" download="{{$user->file_two}}">Download</a></br></span></br>
                                            <span><a class="btn btn-secondary" href="{{asset('public/doctor/doc/' . $user->file_two)}}" target="_blank">Open File</a></span>
                                        </div>
                                        <div class="col-md-4">
                                            <h6>{{ __('main.Document Three_') }}</h6>
                                            <!-- <img class="card-img-top cus-card-img" src="{{ isset($user->file_three) ? asset(path_user_image() . $user->file_three) : Avatar::create($user->file_three)->toBase64() }}" /> -->
                                            <span><a class="btn btn-primary" href="{{asset('public/doctor/doc/' . $user->file_three)}}" download="{{$user->file_three}}">Download</a></br></span></br>
                                            <span><a class="btn btn-secondary" href="{{asset('public/doctor/doc/' . $user->file_three)}}" target="_blank">Open File</a></span>                                            
                                        </div>
                                    </div>
                            </div> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('main.Close') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@push('script')
    {{ $dataTable->scripts() }}
@endpush
