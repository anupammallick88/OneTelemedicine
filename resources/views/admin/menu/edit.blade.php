@extends('layouts.main')
@section('title', __('main.Menu_Edit'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Menu') }}</h5>
                            <span>{{ __('main.Menu_Edit') }}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('main.Edit') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @csrf
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="image-group">
                                <div class="form-group">
                                    <label for="">{{ __('main.Label') }} <span class="text-danger">*</span> </label>
                                    <br>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="label" class="form-control"
                                            placeholder="{{ __('main.Menu_label') }}" value="{{ $menu->label }}">
                                        <div class="input-group-append d-none">
                                            <select class="form-control cus-w90" name="status">
                                                <option value="1">{{ __('main.Active') }}</option>
                                                <option value="2">{{ __('main.Draft') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    @error('label')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('main.Save') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('main.Add_Menu_Item') }}</h3>
                    </div>
                    <div class="card-body">
                        <p>{{ __('main.Click the add button to add another item') }}</p>
                        <p>
                            @if (Session::has('menu_items_error'))
                                <span class="text-danger">{{ __('main.Something_Wrong_____fild_are_required_') }}</span>
                            @endif
                        </p>
                        <form class="" action="{{ route('menu_item.store') }}" method="POST">
                            @csrf

                            @foreach ($menu_items as $key => $menu_item)
                                <div class="d-flex flex-wrap mb-2">
                                    <div class="row cus-menu-w">
                                        <div class="col-md-6">
                                            <div class="form">
                                                <input type="hidden" name="menuItemId[]" value="{{ $menu_item->id }}">
                                                <input type="text" name="label[]" class="form-control"
                                                    placeholder="{{ __('main.Label') }}"
                                                    value="{{ $menu_item->label ?? $menu_item->url }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form">
                                                <select name="url[]" id="url" class="form-control">
                                                    <option {{ $menu_item->url == '/' ? 'selected' : '' }} value="/">
                                                        {{ 'Home' }}</option>
                                                    <option {{ $menu_item->url == 'about-us' ? 'selected' : '' }}
                                                        value="about-us">{{ 'About Us' }}</option>
                                                    <option {{ $menu_item->url == 'faq' ? 'selected' : '' }}
                                                        value="faq">{{ 'faq' }}</option>
                                                    <option {{ $menu_item->url == 'gallery' ? 'selected' : '' }}
                                                        value="gallery">{{ 'Gallery' }}</option>
                                                    <option {{ $menu_item->url == 'news' ? 'selected' : '' }}
                                                        value="news">{{ 'News' }}</option>
                                                    <option {{ $menu_item->url == 'doctors' ? 'selected' : '' }}
                                                        value="doctors">{{ 'Doctors' }}</option>
                                                    <option {{ $menu_item->url == 'service' ? 'selected' : '' }}
                                                        value="service">{{ 'Service' }}</option>
                                                    <option {{ $menu_item->url == 'contact' ? 'selected' : '' }}
                                                        value="contact">{{ 'Contact' }}</option>
                                                    @foreach ($pages as $page)
                                                        <option value="page/{{ $page->url }}"
                                                            {{ $menu_item->url == 'page/' . $page->url ? 'selected' : '' }}>
                                                            {{ $page->label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($key != 0)
                                        <a href="{{ route('menu_item.delete', $menu_item->id) }}"
                                            class="btn btn-danger btn-icon ml-2 delete"><i class="ik ik-trash-2"></i></a>
                                    @endif
                                </div>
                            @endforeach
                            {{-- new item add --}}
                            <div class="itemNew"></div>

                            <button type="button" class="btn btn-success btn-icon ml-2 mb-2 itemAdd">
                                <i class="ik ik-plus"></i>
                            </button>

                            <div class="another">
                                <div>
                                    <div class="">
                                        <div class="card-header">
                                            <h3>{{ __('main.Items_Save_To') }} <span class="text-danger">*</span></h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="border-checkbox-section">
                                                <div class="border-checkbox-group border-checkbox-group-success">
                                                    <input {{ $menu_position->position == 1 ? 'checked' : '' }}
                                                        class="border-checkbox" checked type="radio" value="1"
                                                        name="position" id="checkbox1">
                                                    <label class="border-checkbox-label"
                                                        for="checkbox1">{{ __('main.Header_Menu') }}</label>
                                                </div>
                                            </div>
                                            <div class="border-checkbox-section">
                                                <div class="border-checkbox-group border-checkbox-group-success">
                                                    <input {{ $menu_position->position == 2 ? 'checked' : '' }}
                                                        class="border-checkbox" type="radio" value="2"
                                                        name="position" id="checkbox2">
                                                    <label class="border-checkbox-label"
                                                        for="checkbox2">{{ __('main.Quick_Links') }}</label>
                                                </div>
                                            </div>
                                            <div class="border-checkbox-section">
                                                <div class="border-checkbox-group border-checkbox-group-success">
                                                    <input {{ $menu_position->position == 3 ? 'checked' : '' }}
                                                        class="border-checkbox" type="radio" name="position"
                                                        value="3" id="checkbox3">
                                                    <label class="border-checkbox-label"
                                                        for="checkbox3">{{ __('main.Support___Help') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="menuId" value="{{ $menu->id }}">
                            <input type="hidden" name="status" value="{{ $menu->status }}">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('main.Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- new item copy --}}
    <div class="itemCopy d-none">
        <div class="d-flex flex-wrap mb-2">
            <div class="row cus-menu-w">
                <div class="col-md-6">
                    <div class="form">
                        <input type="text" name="label[]" class="form-control" placeholder="{{ __('main.Label') }}"
                            value="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form">
                        <select name="url[]" id="url" class="form-control">
                            <option value="/">{{ 'Home' }}</option>
                            <option value="about-us">{{ 'About Us' }}</option>
                            <option value="faq">{{ 'faq' }}</option>
                            <option value="gallery">{{ 'Gallery' }}</option>
                            <option value="news">{{ 'News' }}</option>
                            <option value="doctors">{{ 'Doctors' }}</option>
                            <option value="service">{{ 'Service' }}</option>
                            <option value="contact">{{ 'Contact' }}</option>
                            @foreach ($pages as $page)
                                <option value="page/{{ $page->url }}">{{ $page->label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-danger btn-icon ml-2 itemRemove"><i class="ik ik-trash-2"></i></button>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('custom/menu.js') }}"></script>
@endpush
