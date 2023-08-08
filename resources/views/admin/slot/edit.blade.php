@extends('layouts.main')
@section('title', __('main.Doctors_Slot_Edit'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Doctors_Slot_Edit') }}</h5>
                            <span>{{ __('main.Doctors_Slot_Edit') }}</span>
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
                                <a href="#">{{ __('main.Doctor_Slot') }}</a>
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
                        <h3>{{ __('main.Doctors_Slot_Edit') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('slot.update', $docslot->id) }}">
                                            @csrf
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    {{ __('main.Start_Time') }} <input name="start_time"
                                                        class="form-control" type="time"
                                                        value="{{ $docslot->start_time }}">
                                                    {{ __('main.End_Time') }} <input name="end_time" class="form-control"
                                                        type="time" value="{{ $docslot->end_time }}">
                                                </div>
                                                <div class="form-group mt-3">
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('main.Update') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
