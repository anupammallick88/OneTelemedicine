@extends('layouts.main')
@section('title', __('main.Comments'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Comment') }}</h5>
                            <span>{{ __('main.Comments_List') }}</span>
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
                                <a href="{{ route('comment.index') }}">{{ __('main.Comment') }}</a>
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
                        <h3>{{ __('main.Comments_List') }}</h3>
                    </div>
                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (isset($comment))
        @foreach ($comment as $dt)
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter{{ $dt->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">{{ __('main.Message_of') }}
                                {{ $dt->user->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">{{ __('main.Name:') }} {{ $dt->user->name }}</li>
                                    <li class="list-group-item">{{ __('main.Email:') }} {{ $dt->user->email }}</li>
                                    <li class="list-group-item"><b>{{ __('main.Message:') }}</b> <br>{{ $dt->massage }}</li>
                                    <li class="list-group-item">{{ __('News Link:') }} <a
                                            href="{{ route('front.single.news', $dt->post->translateOrDefault(session()->get('locale'))->slug) }}"
                                            class="text-success" target="_blank">{{ __('main.Click_Here') }}</a></li>
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
