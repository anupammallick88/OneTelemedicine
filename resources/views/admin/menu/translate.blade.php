@extends('layouts.main')
@section('title', __('main.Menu_Item_Translate'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Menu') }}</h5>
                            <span>{{ __('main.Menu_Item_Translate') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{ __('main.Menu') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('main.Translate') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('main.Menu_Item_Translate') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('menu.translate.update') }}" method="POST">
                            @csrf
                            <div class="row cus-menu-w mb-3">
                                @foreach ($menuItems as $menu_item)
                                    @foreach (allLanguages() as $lang)
                                        <div class="col-md-3 mb-3">
                                            <label
                                                for="">{{ $menu_item->translate($lang->prefix)->label ?? $menu_item->url }}
                                                ({{ $lang->name }})
                                            </label>
                                            <div class="form">
                                                <input type="hidden" name="locale[]" class="form-control"
                                                    value="{{ $lang->prefix }}">
                                                <input type="hidden" name="menu_item_id[]" class="form-control"
                                                    value="{{ $menu_item->id }}">
                                                <input type="text" name="label[]" class="form-control"
                                                    placeholder="{{ __('main.Label') }}"
                                                    value="{{ $menu_item->translate($lang->prefix)->label ?? $menu_item->url }}">
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('main.Update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
