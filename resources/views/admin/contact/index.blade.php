@extends('layouts.main')
@section('title', __('main.Contacts'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Contacts') }}</h5>
                            <span>{{ __('main.Contacts_List') }}</span>
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
                                <a href="{{ route('contact.index') }}">{{ __('main.Contacts') }}</a>
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
                        <h3>{{ __('main.Contacts_List') }}</h3>
                    </div>
                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <form action="{{ route('contact.image.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="image-group">
                                <div class="form-group">
                                    <label for="">{{ __('main.Image') }} <span class="text-danger">*</span> </label>
                                    <br>
                                    <img id="target" class="cus-mw-200"
                                        src="{{ !empty($site->contact_image) ? asset(path_contact_image() . $site->contact_image) : asset(path_noimage_image() . 'no-image-200.jpg') }}"
                                        alt="{{ __('main.test') }}">
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input
                                                value="{{ isset($site->contact_image) ? asset(path_contact_image() . $site->contact_image) : '' }}"
                                                name="image" type="file" class="custom-file-input" id="putImage">
                                            <label data-id="showname" class="custom-file-label"
                                                for="validatedInputGroupCustomFile">{{ __('main.Choose_file___') }}</label>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{ __($errors->first('image')) }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('main.Save') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if (isset($contact))
        @foreach ($contact as $dt)
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter{{ $dt->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">{{ __('main.Message_of') }}
                                {{ $dt->name }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">{{ __('main.Name:') }} {{ $dt->name }}</li>
                                    <li class="list-group-item">{{ __('main.Email:') }} {{ $dt->email }}</li>
                                    <li class="list-group-item"><b>{{ __('main.Message:') }}</b> <br>{{ $dt->massage }}
                                    </li>
                                    @if (isset($dt->image))
                                        <li class="list-group-item">{{ __('main.Attachment:') }} <a class="text-success"
                                                href="{{ asset(path_contact_image() . $dt->image) }}"
                                                download>{{ __('main.Download') }}</a> </li>
                                    @endif
                                </ul>
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
    @endif
@endsection
@push('script')
    {{ $dataTable->scripts() }}
@endpush
