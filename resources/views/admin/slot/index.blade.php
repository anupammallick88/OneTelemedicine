@extends('layouts.main')
@section('title', __('main.Doctors_Slot'))
@push('head')
    <!-- include summernote css/js -->
    <link href="{{ asset('plugins/summernote/summernote.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Doctors_slot') }}</h5>
                            <span>{{ __('main.Doctors_Slot_List') }}</span>
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
                                <a href="#">{{ __('main.Doctors_Slot') }}</a>
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
                        <h3>{{ __('main.Doctors_Slot') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @can('slot-create')
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('slot.store') }}">
                                                @csrf
                                                <div class="custome-form">
                                                    <p class="col-form-label"><b>{{ __('main.Doctors_Slot') }}</b></p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="start_time">{{ __('main.Start_Time') }} </label>
                                                                <input name="start_time" type="time">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="end_time">{{ __('main.End_Time') }} </label>
                                                                <input name="end_time" type="time">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('main.Add') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <p>{{ __('main.Doctors_Slot_List') }}</p>
                                        <div class="all-slots">
                                            @if ($docslots->count() > 0)
                                                @foreach ($docslots as $docslot)
                                                    <div class="single-slots">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <p>{{ Carbon\Carbon::parse($docslot->start_time)->format('h:i A') }}
                                                                    -
                                                                    {{ Carbon\Carbon::parse($docslot->end_time)->format('h:i A') }}
                                                                </p>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                @can('slot-edit')
                                                                    <a href="{{ route('slot.edit', $docslot->id) }}"
                                                                        class="btn btn-primary">{{ __('main.Edit') }}</a>
                                                                @endcan
                                                                @can('slot-delete')
                                                                    <a href="{{ route('slot.delete', $docslot->id) }}"
                                                                        class="btn btn-danger delete">{{ __('main.Delete') }}</a>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
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
<!-- push external js -->
@push('script')
    <script src="{{ asset('plugins/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('js/summernote.js') }}"></script>
@endpush
