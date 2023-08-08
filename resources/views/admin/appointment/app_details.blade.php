@if ($appointment->bank_deposite && $appointment->bank_deposite)
    <form action="{{ route('appointment.approve', $appointment->id) }}" method="get">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Deposite Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <tr>
                    <th>Deposite By</th>
                    <th>Deposite Slip</th>
                </tr>
                <tr>
                    <td>{{ $appointment->bank_deposite->bank_deposite_by }}</td>
                    <td><a href="{{ asset(path_bank() . $appointment->bank_deposite->bank_deposite_slip) }}"
                            download="">{{ __('Download') }}</a></td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Paid</button>
        </div>
    </form>
@else
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deposite Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <p class="text-danger">Deposite Data Not Found</p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
@endif
