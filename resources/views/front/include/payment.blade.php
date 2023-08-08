<div class="btn-group btn-group-toggle select-offline-payment-img" data-toggle="buttons">
    @foreach ($paymentPlatforms as $paymentPlatform)
        @if ($paymentPlatform->name == 'Paypal')
            @if (env('PAYPAL_STATUS') == 1)
                <label class="btn btn-outline-secondary rounded m-2 p-1">
                    <input required value="{{ $paymentPlatform->name }}" id="{{ $paymentPlatform->name }}"
                        type="radio" name="payment_method">
                    <img class="img-thumbnail" src="{{ asset($paymentPlatform->image) }}" alt="{{ __('image') }}">
                </label>
            @endif
        @endif
        @if (env('STRIPE_STATUS') == 1)
            @if ($paymentPlatform->name == 'Stripe')
                <label class="btn btn-outline-secondary rounded m-2 p-1">
                    <input required value="{{ $paymentPlatform->name }}" id="{{ $paymentPlatform->name }}"
                        type="radio" name="payment_method">
                    <img class="img-thumbnail" src="{{ asset($paymentPlatform->image) }}" alt="{{ __('image') }}">
                </label>
            @endif
        @endif
    @endforeach

    @if (env('SSLCZ_STATUS') == 1)
        <label class="btn btn-outline-secondary rounded m-2 p-1">
            <input required value="sslcommerz" id="sslcommerz" type="radio" name="payment_method">
            <img class="img-thumbnail" src="{{ asset('img/payment-platforms/sslcommerz.png') }}" alt="{{ __('image') }}">
        </label>
    @endif

    @if (env('BANK_STATUS') == 1)
        <label class="btn btn-outline-secondary rounded m-2 p-1">
            <input required value="Bank" id="bank" type="radio" name="payment_method" data-toggle="collapse"
                data-target="#bankInfo" aria-expanded="false" aria-controls="bankInfo">
            <img class="img-thumbnail" src="{{ asset('img/payment-platforms/bank.png') }}"
                alt="{{ __('image') }}">
        </label>
    @endif
    @if ($payment_type != 'online')
        <label class="btn btn-outline-secondary rounded m-2 p-1">
            <input required value="cod" id="cod" type="radio" name="payment_method">
            <img class="img-thumbnail" src="{{ asset('img/payment-platforms/cod.jpg') }}"
                alt="{{ __('image') }}">
        </label>
    @endif
</div>
{{-- bank info start --}}
<div class="row">
    <div class="collapse" id="bankInfo">
        <div class="row">
            <div class="col-md-12">
                <ul class="list-group list-group-horizontal-sm">
                    <li class="list-group-item"><b>Bank Name: </b>{{ env('BANK_NAME') }}</li>
                    <li class="list-group-item"><b>Bank Account Name: </b>{{ env('BANK_ACCOUNT_NAME') }}</li>
                    <li class="list-group-item"><b>Bank Account Number: </b>{{ env('BANK_ACCOUNT_NUMBER') }}</li>
                </ul>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="bank_deposite_by">{{ __('Deposited By') }}</label>
                <input type="text" name="bank_deposite_by" id="bank_deposite_by" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="bank_deposite_slip">{{ __('Deposited Slip') }}</label>
                <input type="file" name="bank_deposite_slip" id="bank_deposite_slip" class="form-control">
            </div>
        </div>
    </div>
</div>
{{-- bank info end --}}
