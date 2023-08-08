@extends('front.layouts.main')
@section('page_title', __('Services'))
@include('front.include.breadcrumb')
@section('content')
    @include('front.include.service')
    @include('front.include.gallery')
    @include('front.include.doctor')
@endsection
