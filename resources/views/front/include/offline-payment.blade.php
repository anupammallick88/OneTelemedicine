<div class="btn-group btn-group-toggle select-offline-payment-img" data-toggle="buttons">
    @foreach ($paymentPlatforms as $paymentPlatform)
        <label class="btn btn-outline-secondary rounded m-2 p-1" data-target="#{{ $paymentPlatform->name }}Collapse"
            data-toggle="collapse">
            <input required value="option{{ $paymentPlatform->id }}" id="radio{{ $paymentPlatform->id }}" type="radio"
                name="payment_platform">
            <img class="img-thumbnail" src="{{ asset($paymentPlatform->image) }}" alt="{{ __('image') }}">
        </label>
    @endforeach
    <label class="btn btn-outline-secondary rounded m-2 p-1" data-target="#codCollapse" data-toggle="collapse">
        <input required value="option3" id="radio3" type="radio" name="payment_platform">
        <img class="img-thumbnail" src="{{ asset('img/payment-platforms/cod.jpg') }}" alt="{{ __('image') }}">
    </label>
</div>
@foreach ($paymentPlatforms as $paymentPlatform)
    <div id="{{ $paymentPlatform->name }}Collapse" class="collapse" data-parent="#toggler">
        @includeIf('components.' . strtolower($paymentPlatform->name) . '-collapse')
    </div>
@endforeach
<div id="codCollapse" class="collapse" data-parent="#toggler">
    <p>{{ __('main.Patient_pay_to_the_desk_') }}</p>
</div>
<input type="hidden" name="appointment_type" value="{{ OFFLINE }}">
<script src="{{ asset('front/js/offline-appointment.js') }}"></script>
