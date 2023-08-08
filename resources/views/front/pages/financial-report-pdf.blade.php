<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Prescription') }}</title>
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
</head>
<body>
<h1>{{__('Financial Report')}}</h1><br>
<h5>{{auth()->user()->name}}</h5>
    <p>{{previousMonthName(previousMonthId(\Carbon\Carbon::now()->format('m'), 0))}} {{previousYear(\Carbon\Carbon::now()->format('m'), 0)}}</p>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('Patient')}}</th>
            <th scope="col">{{__('Date')}}</th>
            <th scope="col">{{__('Type')}}</th>
            <th scope="col">{{__('Payment')}}</th>
            <th scope="col">{{__('Amount')}}</th>
            <th scope="col">{{__('Stage')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($first_month as $fm)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$fm->patient->name}}</td>
            <td>{{$fm->appdate}}</td>
            <td>{{$fm->type == OFFLINE ? __('Offline') : __('Online')}}</td>
            <td>{{$fm->paymentmethod == 'cod' ? 'Spot Payment' : ucfirst($fm->paymentmethod)}}</td>
            <td>{{$fm->fees}}</td>
            <td>{{$fm->is_paid == 1 ? 'Paid' : 'Not Paid'}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <p>{{previousMonthName(previousMonthId(\Carbon\Carbon::now()->format('m'), 1))}} {{previousYear(\Carbon\Carbon::now()->format('m'), 1)}}</p>
    <table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('Patient')}}</th>
        <th scope="col">{{__('Date')}}</th>
        <th scope="col">{{__('Type')}}</th>
        <th scope="col">{{__('Payment')}}</th>
        <th scope="col">{{__('Amount')}}</th>
        <th scope="col">{{__('Stage')}}</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($second_month as $sm)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$sm->patient->name}}</td>
            <td>{{$sm->appdate}}</td>
            <td>{{$sm->type == OFFLINE ? __('Offline') : __('Online')}}</td>
            <td>{{$sm->paymentmethod == 'cod' ? 'Spot Payment' : ucfirst($sm->paymentmethod)}}</td>
            <td>{{$sm->fees}}</td>
            <td>{{$sm->is_paid == 1 ? 'Paid' : 'Not Paid'}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">{{__('No Result Found!')}}</td>
        </tr>
    @endforelse
    </tbody>
</table>

<p>{{previousMonthName(previousMonthId(\Carbon\Carbon::now()->format('m'), 2))}} {{previousYear(\Carbon\Carbon::now()->format('m'), 2)}}</p>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('Patient')}}</th>
        <th scope="col">{{__('Date')}}</th>
        <th scope="col">{{__('Type')}}</th>
        <th scope="col">{{__('Payment')}}</th>
        <th scope="col">{{__('Amount')}}</th>
        <th scope="col">{{__('Stage')}}</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($third_month as $tm)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$tm->patient->name}}</td>
            <td>{{$tm->appdate}}</td>
            <td>{{$tm->type == OFFLINE ? __('Offline') : __('Online')}}</td>
            <td>{{$tm->paymentmethod == 'cod' ? 'Spot Payment' : ucfirst($tm->paymentmethod)}}</td>
            <td>{{$tm->fees}}</td>
            <td>{{$tm->is_paid == 1 ? 'Paid' : 'Not Paid'}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">{{__('No Result Found!')}}</td>
        </tr>
    @endforelse
    </tbody>
</table>

<p>{{previousMonthName(previousMonthId(\Carbon\Carbon::now()->format('m'), 3))}} {{previousYear(\Carbon\Carbon::now()->format('m'), 3)}}</p>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('Patient')}}</th>
        <th scope="col">{{__('Date')}}</th>
        <th scope="col">{{__('Type')}}</th>
        <th scope="col">{{__('Payment')}}</th>
        <th scope="col">{{__('Amount')}}</th>
        <th scope="col">{{__('Stage')}}</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($fourth_month as $frm)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$frm->patient->name}}</td>
            <td>{{$frm->appdate}}</td>
            <td>{{$frm->type == OFFLINE ? __('Offline') : __('Online')}}</td>
            <td>{{$frm->paymentmethod == 'cod' ? 'Spot Payment' : ucfirst($frm->paymentmethod)}}</td>
            <td>{{$frm->fees}}</td>
            <td>{{$frm->is_paid == 1 ? 'Paid' : 'Not Paid'}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">{{__('No Result Found!')}}</td>
        </tr>
    @endforelse
    </tbody>
</table>

<p>{{previousMonthName(previousMonthId(\Carbon\Carbon::now()->format('m'), 4))}} {{previousYear(\Carbon\Carbon::now()->format('m'), 4)}}</p>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('Patient')}}</th>
        <th scope="col">{{__('Date')}}</th>
        <th scope="col">{{__('Type')}}</th>
        <th scope="col">{{__('Payment')}}</th>
        <th scope="col">{{__('Amount')}}</th>
        <th scope="col">{{__('Stage')}}</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($fifth_month as $ffm)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$ffm->patient->name}}</td>
            <td>{{$ffm->appdate}}</td>
            <td>{{$ffm->type == OFFLINE ? __('Offline') : __('Online')}}</td>
            <td>{{$ffm->paymentmethod == 'cod' ? 'Spot Payment' : ucfirst($ffm->paymentmethod)}}</td>
            <td>{{$ffm->fees}}</td>
            <td>{{$ffm->is_paid == 1 ? 'Paid' : 'Not Paid'}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">{{__('No Result Found!')}}</td>
        </tr>
    @endforelse
    </tbody>
</table>

<p>{{previousMonthName(previousMonthId(\Carbon\Carbon::now()->format('m'), 5))}} {{previousYear(\Carbon\Carbon::now()->format('m'), 5)}}</p>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('Patient')}}</th>
        <th scope="col">{{__('Date')}}</th>
        <th scope="col">{{__('Type')}}</th>
        <th scope="col">{{__('Payment')}}</th>
        <th scope="col">{{__('Amount')}}</th>
        <th scope="col">{{__('Stage')}}</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($sixth_month as $sxm)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$sxm->patient->name}}</td>
            <td>{{$sxm->appdate}}</td>
            <td>{{$sxm->type == OFFLINE ? __('Offline') : __('Online')}}</td>
            <td>{{$sxm->paymentmethod == 'cod' ? 'Spot Payment' : ucfirst($sxm->paymentmethod)}}</td>
            <td>{{$sxm->fees}}</td>
            <td>{{$sxm->is_paid == 1 ? 'Paid' : 'Not Paid'}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">{{__('No Result Found!')}}</td>
        </tr>
    @endforelse
    </tbody>
</table>

<p>{{previousMonthName(previousMonthId(\Carbon\Carbon::now()->format('m'), 6))}} {{previousYear(\Carbon\Carbon::now()->format('m'), 6)}}</p>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('Patient')}}</th>
        <th scope="col">{{__('Date')}}</th>
        <th scope="col">{{__('Type')}}</th>
        <th scope="col">{{__('Payment')}}</th>
        <th scope="col">{{__('Amount')}}</th>
        <th scope="col">{{__('Stage')}}</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($seventh_month as $svm)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$svm->patient->name}}</td>
            <td>{{$svm->appdate}}</td>
            <td>{{$svm->type == OFFLINE ? __('Offline') : __('Online')}}</td>
            <td>{{$svm->paymentmethod == 'cod' ? 'Spot Payment' : ucfirst($svm->paymentmethod)}}</td>
            <td>{{$svm->fees}}</td>
            <td>{{$svm->is_paid == 1 ? 'Paid' : 'Not Paid'}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">{{__('No Result Found!')}}</td>
        </tr>
    @endforelse
    </tbody>
</table>

<p>{{previousMonthName(previousMonthId(\Carbon\Carbon::now()->format('m'), 7))}} {{previousYear(\Carbon\Carbon::now()->format('m'), 7)}}</p>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('Patient')}}</th>
        <th scope="col">{{__('Date')}}</th>
        <th scope="col">{{__('Type')}}</th>
        <th scope="col">{{__('Payment')}}</th>
        <th scope="col">{{__('Amount')}}</th>
        <th scope="col">{{__('Stage')}}</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($eighth_month as $etm)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$etm->patient->name}}</td>
            <td>{{$etm->appdate}}</td>
            <td>{{$etm->type == OFFLINE ? __('Offline') : __('Online')}}</td>
            <td>{{$etm->paymentmethod == 'cod' ? 'Spot Payment' : ucfirst($etm->paymentmethod)}}</td>
            <td>{{$etm->fees}}</td>
            <td>{{$etm->is_paid == 1 ? 'Paid' : 'Not Paid'}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">{{__('No Result Found!')}}</td>
        </tr>
    @endforelse
    </tbody>
</table>

<p>{{previousMonthName(previousMonthId(\Carbon\Carbon::now()->format('m'), 8))}} {{previousYear(\Carbon\Carbon::now()->format('m'), 8)}}</p>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('Patient')}}</th>
        <th scope="col">{{__('Date')}}</th>
        <th scope="col">{{__('Type')}}</th>
        <th scope="col">{{__('Payment')}}</th>
        <th scope="col">{{__('Amount')}}</th>
        <th scope="col">{{__('Stage')}}</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($ninth_month as $nnm)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$nnm->patient->name}}</td>
            <td>{{$nnm->appdate}}</td>
            <td>{{$nnm->type == OFFLINE ? __('Offline') : __('Online')}}</td>
            <td>{{$nnm->paymentmethod == 'cod' ? 'Spot Payment' : ucfirst($nnm->paymentmethod)}}</td>
            <td>{{$nnm->fees}}</td>
            <td>{{$nnm->is_paid == 1 ? 'Paid' : 'Not Paid'}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">{{__('No Result Found!')}}</td>
        </tr>
    @endforelse
    </tbody>
</table>

<p>{{previousMonthName(previousMonthId(\Carbon\Carbon::now()->format('m'), 9))}} {{previousYear(\Carbon\Carbon::now()->format('m'), 9)}}</p>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('Patient')}}</th>
        <th scope="col">{{__('Date')}}</th>
        <th scope="col">{{__('Type')}}</th>
        <th scope="col">{{__('Payment')}}</th>
        <th scope="col">{{__('Amount')}}</th>
        <th scope="col">{{__('Stage')}}</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($tenth_month as $tnm)
        <tr>
            <th scope="row">{{$tnm->iteration}}</th>
            <td>{{$tnm->patient->name}}</td>
            <td>{{$tnm->appdate}}</td>
            <td>{{$tnm->type == OFFLINE ? __('Offline') : __('Online')}}</td>
            <td>{{$tnm->paymentmethod == 'cod' ? 'Spot Payment' : ucfirst($tnm->paymentmethod)}}</td>
            <td>{{$tnm->fees}}</td>
            <td>{{$tnm->is_paid == 1 ? 'Paid' : 'Not Paid'}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">{{__('No Result Found!')}}</td>
        </tr>
    @endforelse
    </tbody>
</table>

<p>{{previousMonthName(previousMonthId(\Carbon\Carbon::now()->format('m'), 10))}} {{previousYear(\Carbon\Carbon::now()->format('m'), 10)}}</p>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('Patient')}}</th>
        <th scope="col">{{__('Date')}}</th>
        <th scope="col">{{__('Type')}}</th>
        <th scope="col">{{__('Payment')}}</th>
        <th scope="col">{{__('Amount')}}</th>
        <th scope="col">{{__('Stage')}}</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($eleventh_month as $elvm)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$elvm->patient->name}}</td>
            <td>{{$elvm->appdate}}</td>
            <td>{{$elvm->type == OFFLINE ? __('Offline') : __('Online')}}</td>
            <td>{{$elvm->paymentmethod == 'cod' ? 'Spot Payment' : ucfirst($elvm->paymentmethod)}}</td>
            <td>{{$elvm->fees}}</td>
            <td>{{$elvm->is_paid == 1 ? 'Paid' : 'Not Paid'}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">{{__('No Result Found!')}}</td>
        </tr>
    @endforelse
    </tbody>
</table>

<p>{{previousMonthName(previousMonthId(\Carbon\Carbon::now()->format('m'), 11))}} {{previousYear(\Carbon\Carbon::now()->format('m'), 11)}}</p>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('Patient')}}</th>
        <th scope="col">{{__('Date')}}</th>
        <th scope="col">{{__('Type')}}</th>
        <th scope="col">{{__('Payment')}}</th>
        <th scope="col">{{__('Amount')}}</th>
        <th scope="col">{{__('Stage')}}</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($tweleveth_month as $twlm)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$twlm->patient->name}}</td>
            <td>{{$twlm->appdate}}</td>
            <td>{{$twlm->type == OFFLINE ? __('Offline') : __('Online')}}</td>
            <td>{{$twlm->paymentmethod == 'cod' ? 'Spot Payment' : ucfirst($twlm->paymentmethod)}}</td>
            <td>{{$twlm->fees}}</td>
            <td>{{$twlm->is_paid == 1 ? 'Paid' : 'Not Paid'}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">{{__('No Result Found!')}}</td>
        </tr>
    @endforelse
    </tbody>
</table>

</body>
