@extends('layouts.main')
@section('title', __('main.Patients'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Patients') }}</h5>
                            <span>{{ __('main.Patients_List') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('main.Patients') }}</a>
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
                        <h3>{{ __('main.Patients_List') }}</h3>
                        @can('patient-create')
                            <a class="btn btn-primary ml-auto" href="{{ route('patient.create') }}">{{ __('main.New') }}</a>
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
        <div class="modal fade" id="exampleModalCenter{{ $user->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <img class="card-img-top cus-card-img"
                                src="{{ isset($user->image) ? asset(path_user_image() . $user->image) : Avatar::create($user->name)->toBase64() }}" />
                            <div class="card-body">
                                <h5 class="card-title">{{ __('main.Patient_Details') }}</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">{{ __('main.Name') }}: {{ $user->name }}</li>
                                        <li class="list-group-item">{{ __('main.Email') }}: {{ $user->email }}</li>
                                        <li class="list-group-item">{{ __('main.Gender') }}:
                                            {{ $user->gender }}</li>
                                        <li class="list-group-item">{{ __('main.BirthDay') }}: {{ $user->dob }}</li>
                                        <li class="list-group-item">{{ __('main.Mobile') }}:
                                            {{ $user->mobile }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">{{ __('main.Degree') }}: {{ $user->qualification }}</li>
                                        <li class="list-group-item">{{ __('main.Address_') }}: {{ $user->address }}</li>
                                        <li class="list-group-item">{{ __('main.City') }}: {{ $user->city }}</li>
                                        <li class="list-group-item">{{ __('main.Created_At_') }}:
                                            {{ $user->created_at->diffForHumans() }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('main.Close') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@push('script')
    {{ $dataTable->scripts() }}
@endpush
