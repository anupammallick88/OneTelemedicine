<div class="btn-group btn-group-toggle" data-toggle="buttons">
    @foreach ($paymentPlatforms as $paymentPlatform)
        <label class="btn btn-outline-secondary rounded m-2 p-1" data-target="#{{ $paymentPlatform->name }}Collapse"
            data-toggle="collapse">
            <input required value="option{{ $paymentPlatform->id }}" id="radio{{ $paymentPlatform->id }}" type="radio"
                name="payment_platform">
            <img class="img-thumbnail" src="{{ asset($paymentPlatform->image) }}" alt="{{ __('image') }}">
        </label>
    @endforeach
</div>
@foreach ($paymentPlatforms as $paymentPlatform)
    <div id="{{ $paymentPlatform->name }}Collapse" class="collapse" data-parent="#toggler">
        @includeIf('components.' . strtolower($paymentPlatform->name) . '-collapse')
    </div>
@endforeach
<input type="hidden" name="appointment_type" value="{{ ONLINE }}">
<script src="{{ asset('front/js/online-appointment.js') }}"></script>
