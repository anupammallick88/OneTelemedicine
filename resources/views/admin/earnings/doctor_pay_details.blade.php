<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ $doctorName }} {{ __('main.Earning_History') }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">

    @if ($month1->count())
        <h5>{{ $month1->first()->created_at->format('F') }} {{ $month1->first()->created_at->format('Y') }}</h5>
        {{-- $data['month1']->first()->created_at->format('d-m-Y') --}}
        <table class="table">
            <tr>
                <th>{{ __('main.Amount') }}</th>
                <th>{{ __('main.Date') }}</th>
                <th>{{ __('main.Payment_Method') }}</th>
            </tr>
            @foreach ($month1 as $pay)
                <tr>
                    <td>{{ $pay->fees }}</td>
                    <td>{{ $pay->created_at->format('d-m-Y') }}</td>
                    <td>{{ $pay->paymentmethod }}</td>
                </tr>
            @endforeach
        </table>
    @endif
    @if ($month2->count())
        <h5>{{ $month2->first()->created_at->format('F') }} {{ $month2->first()->created_at->format('Y') }}</h5>
        <table class="table">
            <tr>
                <th>{{ __('main.Amount') }}</th>
                <th>{{ __('main.Date') }}</th>
                <th>{{ __('main.Payment_Method') }}</th>
            </tr>
            @foreach ($month2 as $pay)
                <tr>
                    <td>{{ $pay->fees }}</td>
                    <td>{{ $pay->created_at->format('d-m-Y') }}</td>
                    <td>{{ $pay->paymentmethod }}</td>
                </tr>
            @endforeach
        </table>
    @endif
    @if ($month3->count())
        <h5>{{ $month3->first()->created_at->format('F') }} {{ $month3->first()->created_at->format('Y') }}</h5>
        <table class="table">
            <tr>
                <th>{{ __('main.Amount') }}</th>
                <th>{{ __('main.Date') }}</th>
                <th>{{ __('main.Payment_Method') }}</th>
            </tr>
            @foreach ($month3 as $pay)
                <tr>
                    <td>{{ $pay->fees }}</td>
                    <td>{{ $pay->created_at->format('d-m-Y') }}</td>
                    <td>{{ $pay->paymentmethod }}</td>
                </tr>
            @endforeach
        </table>
    @endif
    @if ($month4->count())
        <h5>{{ $month4->first()->created_at->format('F') }} {{ $month4->first()->created_at->format('Y') }}</h5>
        <table class="table">
            <tr>
                <th>{{ __('main.Amount') }}</th>
                <th>{{ __('main.Date') }}</th>
                <th>{{ __('main.Payment_Method') }}</th>
            </tr>
            @foreach ($month4 as $pay)
                <tr>
                    <td>{{ $pay->fees }}</td>
                    <td>{{ $pay->created_at->format('d-m-Y') }}</td>
                    <td>{{ $pay->paymentmethod }}</td>
                </tr>
            @endforeach
        </table>
    @endif
    @if ($month5->count())
        <h5>{{ $month5->first()->created_at->format('F') }} {{ $month5->first()->created_at->format('Y') }}</h5>
        <table class="table">
            <tr>
                <th>{{ __('main.Amount') }}</th>
                <th>{{ __('main.Date') }}</th>
                <th>{{ __('main.Payment_Method') }}</th>
            </tr>
            @foreach ($month5 as $pay)
                <tr>
                    <td>{{ $pay->fees }}</td>
                    <td>{{ $pay->created_at->format('d-m-Y') }}</td>
                    <td>{{ $pay->paymentmethod }}</td>
                </tr>
            @endforeach
        </table>
    @endif
    @if ($month6->count())
        <h5>{{ $month6->first()->created_at->format('F') }} {{ $month6->first()->created_at->format('Y') }}</h5>
        <table class="table">
            <tr>
                <th>{{ __('main.Amount') }}</th>
                <th>{{ __('main.Date') }}</th>
                <th>{{ __('main.Payment_Method') }}</th>
            </tr>
            @foreach ($month6 as $pay)
                <tr>
                    <td>{{ $pay->fees }}</td>
                    <td>{{ $pay->created_at->format('d-m-Y') }}</td>
                    <td>{{ $pay->paymentmethod }}</td>
                </tr>
            @endforeach
        </table>
    @endif
    @if ($month7->count())
        <h5>{{ $month7->first()->created_at->format('F') }} {{ $month7->first()->created_at->format('Y') }}</h5>
        <table class="table">
            <tr>
                <th>{{ __('main.Amount') }}</th>
                <th>{{ __('main.Date') }}</th>
                <th>{{ __('main.Payment_Method') }}</th>
            </tr>
            @foreach ($month7 as $pay)
                <tr>
                    <td>{{ $pay->fees }}</td>
                    <td>{{ $pay->created_at->format('d-m-Y') }}</td>
                    <td>{{ $pay->paymentmethod }}</td>
                </tr>
            @endforeach
        </table>
    @endif
    @if ($month8->count())
        <h5>{{ $month8->first()->created_at->format('F') }} {{ $month8->first()->created_at->format('Y') }}</h5>
        <table class="table">
            <tr>
                <th>{{ __('main.Amount') }}</th>
                <th>{{ __('main.Date') }}</th>
                <th>{{ __('main.Payment_Method') }}</th>
            </tr>
            @foreach ($month8 as $pay)
                <tr>
                    <td>{{ $pay->fees }}</td>
                    <td>{{ $pay->created_at->format('d-m-Y') }}</td>
                    <td>{{ $pay->paymentmethod }}</td>
                </tr>
            @endforeach
        </table>
    @endif
    @if ($month9->count())
        <h5>{{ $month9->first()->created_at->format('F') }} {{ $month9->first()->created_at->format('Y') }}</h5>
        <table class="table">
            <tr>
                <th>{{ __('main.Amount') }}</th>
                <th>{{ __('main.Date') }}</th>
                <th>{{ __('main.Payment_Method') }}</th>
            </tr>
            @foreach ($month9 as $pay)
                <tr>
                    <td>{{ $pay->fees }}</td>
                    <td>{{ $pay->created_at->format('d-m-Y') }}</td>
                    <td>{{ $pay->paymentmethod }}</td>
                </tr>
            @endforeach
        </table>
    @endif
    @if ($month10->count())
        <h5>{{ $month10->first()->created_at->format('F') }} {{ $month10->first()->created_at->format('Y') }}</h5>
        <table class="table">
            <tr>
                <th>{{ __('main.Amount') }}</th>
                <th>{{ __('main.Date') }}</th>
                <th>{{ __('main.Payment_Method') }}</th>
            </tr>
            @foreach ($month10 as $pay)
                <tr>
                    <td>{{ $pay->fees }}</td>
                    <td>{{ $pay->created_at->format('d-m-Y') }}</td>
                    <td>{{ $pay->paymentmethod }}</td>
                </tr>
            @endforeach
        </table>
    @endif
    @if ($month11->count())
        <h5>{{ $month11->first()->created_at->format('F') }} {{ $month11->first()->created_at->format('Y') }}</h5>
        <table class="table">
            <tr>
                <th>{{ __('main.Amount') }}</th>
                <th>{{ __('main.Date') }}</th>
                <th>{{ __('main.Payment_Method') }}</th>
            </tr>
            @foreach ($month11 as $pay)
                <tr>
                    <td>{{ $pay->fees }}</td>
                    <td>{{ $pay->created_at->format('d-m-Y') }}</td>
                    <td>{{ $pay->paymentmethod }}</td>
                </tr>
            @endforeach
        </table>
    @endif
    @if ($month12->count())
        <h5>{{ $month12->first()->created_at->format('F') }} {{ $month12->first()->created_at->format('Y') }}</h5>
        <table class="table">
            <tr>
                <th>{{ __('main.Amount') }}</th>
                <th>{{ __('main.Date') }}</th>
                <th>{{ __('main.Payment_Method') }}</th>
            </tr>
            @foreach ($month12 as $pay)
                <tr>
                    <td>{{ $pay->fees }}</td>
                    <td>{{ $pay->created_at->format('d-m-Y') }}</td>
                    <td>{{ $pay->paymentmethod }}</td>
                </tr>
            @endforeach
        </table>
    @endif
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('main.Close') }}</button>
</div>
