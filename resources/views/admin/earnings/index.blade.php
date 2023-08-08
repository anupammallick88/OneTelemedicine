@extends('layouts.main')
@section('title', __('main.Earnings'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Earnings') }}</h5>
                            <span>{{ __('main.Earnings_List') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('category.index') }}">{{ __('main.Earnings') }}</a>
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
                        <h3>{{ __('main.Earnings_List') }}</h3>                        
                    </div>
                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($doctors as $doctor)
        <div class="modal fade" id="earningModalCenter{{ $doctor->id }}" tabindex="-1" role="dialog"
            aria-labelledby="earningModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            {{ $doctor->user->name }} {{ __('main.Pay_Out') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('earnings.add-payment', $doctor->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                        <div class="modal-body">
                            <p>{{ __('main.Total_Pay') }} {{ admintopay($doctor->id) }} ({{ __('main.In_USD') }})</p>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('main.Payment') }}</label>
                                <input type="number" min="1" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Amount" name="amount" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('main.Note') }}</label>
                                <textarea name="note" class="form-control" placeholder="{{ __('main.Note') }}" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('main.Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('main.Add_Payment') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="viewModalCenter{{ $doctor->id }}" tabindex="-1" role="dialog"
            aria-labelledby="earningModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"> {{ $doctor->user->name }}
                            {{ __('main.Payment_Out_History') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('main.Amount') }}</th>
                                    <th scope="col">{{ __('main.Date') }}</th>
                                    <th scope="col">{{ __('main.Note') }}</th>
                                    <th scope="col">{{ __('main.Track') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (viewDoctorPayment($doctor->id) as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->amount }}</td>
                                        <td>{{ \Carbon\Carbon::parse($doctor->created_at)->toDateString() }}</td>
                                        <td>{{ $item->note }}</td>
                                        <td>{{ \Carbon\Carbon::parse($doctor->created_at)->format('F') . ' ' . \Carbon\Carbon::parse($doctor->created_at)->format('Y') . __('main., Payment Done') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">{{ __('main.No_data_found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Modal -->
    <div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="appendDoctorPayDetails">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{ $dataTable->scripts() }};

    <script src="{{ asset('js/earning.js') }}"></script>
@endpush
