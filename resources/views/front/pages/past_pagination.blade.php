<div class="primary-table">
    <div class="table-responsive">
        <table class="table" id="pastsearch">
            <thead>
                <tr>
                    <th scope="col">{{ __('Doctor Name') }}</th>
                    <th scope="col">{{ __('Date') }}</th>
                    <th scope="col">{{ __('Time') }}</th>
                    <th scope="col">{{ __('Type') }}</th>
                    <th scope="col">{{ __('Status') }}</th>
                    <th scope="col">{{ __('Prescription') }}</th>
                    <th scope="col">{{ __('Meeting_Link') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody class="accordion" id="accordionExample1">
                @forelse($pastappall as $papp)
                    <tr>
                        <td>
                            <div class="user-info">
                                <img class="user-image"
                                    src="{{ isset($papp->doctor->user->image) ? asset(path_user_image() . $papp->doctor->user->image) : '' }}"
                                    alt="{{ __('doctor-image') }}" />
                                <h3 class="user-name">
                                    {{ isset($papp->doctor->user->name) ? $papp->doctor->user->name : '' }}</h3>
                            </div>
                        </td>
                        <td>{{ $papp->appdate }}</td>
                        <td>{{ $papp->slot ? Carbon\Carbon::parse($papp->slot->start_time)->format('H:i A') : 'N/A' }}
                        </td>
                        <td>{{ $papp->type == OFFLINE ? __('Offline') : __('Online') }}</td>
                        <td>
                            @if (Carbon\Carbon::parse($papp->appdate) < Carbon\Carbon::today() && $papp->status == 0)
                                <span class="text-danger">
                                    {{ __('Cancelled') }}
                                    <!-- No action taken by doctor -->
                                </span>
                            @elseif(Carbon\Carbon::parse($papp->appdate) < Carbon\Carbon::today() && $papp->status == 1)
                                <span class="text-danger">
                                    {{ __('Cancelled') }}
                                    <!-- Cancelled -->
                                </span>
                            @elseif($papp->status == 3)
                                <span class="text-danger">
                                    {{ __('Cancelled') }}
                                    <!-- Cancelled by Doctor -->
                                </span>
                            @elseif($papp->status == 1)
                                <span class="text-warning">
                                    {{ __('Approved') }}
                                    <!-- Doctor Approved -->
                                </span>
                            @elseif ($papp->status == 2)
                                <span class="completed">
                                    {{ __('Completed') }}
                                    <!-- Completed -->
                                </span>
                            @else
                                <span class="text-info">
                                    {{ __('Pending') }}
                                    <!-- Pending for approval -->
                                </span>
                            @endif
                        </td>
                        @if (Carbon\Carbon::parse($papp->appdate) < Carbon\Carbon::today() && $papp->status == 0)
                            <td><a class="common-tbl-btn disabled-btn" href="javascript:void(0)" data-toggle="popover"
                                    title="{{ __('No Prescription') }}"
                                    data-content="{{ __('Prescription Not Available!') }}"
                                    role="button">{{ __('No Prescription') }}</a></td>
                        @elseif (Carbon\Carbon::parse($papp->appdate) < Carbon\Carbon::today() && $papp->status == 1)
                            <td><a class="common-tbl-btn disabled-btn" href="javascript:void(0)" data-toggle="popover"
                                    title="{{ __('No Prescription') }}"
                                    data-content="{{ __('Prescription Not Available!') }}"
                                    role="button">{{ __('No Prescription') }}</a></td>
                        @elseif ($papp->status == 2)
                            <td><a class="common-tbl-btn view-button" href="#" role="button" data-toggle="modal"
                                    data-target="#ViewPrescription{{ $papp->id }}">{{ __('View Prescription') }}</a>
                            </td>
                        @else
                            <td><a class="common-tbl-btn disabled-btn" href="javascript:void(0)" data-toggle="popover"
                                    title="{{ __('No Prescription') }}"
                                    data-content="{{ __('Prescription Not Available!') }}"
                                    role="button">{{ __('No Prescription') }}</a></td>
                        @endif
                        <td>
                            <div class="create-link-btn">
                                @if (Carbon\Carbon::parse($papp->appdate) == Carbon\Carbon::today() && $papp->status == 1 && $papp->type != OFFLINE)
                                    @if (hasMeeting($papp->id) == 1)
                                        <a class="common-tbl-btn view-button" role="button" data-toggle="modal"
                                            data-target="#viewMeetingModal{{ $papp->id }}">{{ __('View') }}</a>
                                    @else
                                        <a class="common-tbl-btn create-button" role="button" data-toggle="modal"
                                            data-target="#createMeetingModal{{ $papp->id }}">{{ __('Create') }}</a>
                                    @endif
                                @else
                                    <a class="common-tbl-btn disabled-btn" href="javascript:void(0)"
                                        role="button">{{ __('No Link') }}</a>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="action-btn-wrap">
                                {{-- <a class="common-tbl-btn delete-button" title="{{__('Delete')}}" href="{{route('delete.appointment', $papp->id)}}"><i class="fas fa-trash-alt"></i></a> --}}
                                <div id="heading{{ $papp->id }}">
                                    <button class="common-tbl-btn show-icon collapsed" type="button"
                                        title="Show Details" data-toggle="collapse"
                                        data-target="#collapse1{{ $papp->id }}">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="show-details-content">
                        <td colspan="6">
                            <div id="collapse1{{ $papp->id }}" class="collapse"
                                data-parent="#accordionExample1">
                                <div class="card-body d-flex">
                                    <div>
                                        <div class="show-details-content-item">
                                            {{ __('Doctor:') }}
                                            <span>{{ isset($papp->doctor->user->name) ? $papp->doctor->user->name : '' }}</span>
                                        </div>
                                        <div class="show-details-content-item">
                                            {{ __('Appointment Date:') }}<span>{{ $papp->appdate }}</span>
                                        </div>
                                        <div class="show-details-content-item">
                                            {{ __('Appointment Time:') }}<span>{{ $papp->slot ? Carbon\Carbon::parse($papp->slot->start_time)->format('H:i A') : 'N/A' }}-{{ $papp->slot ? Carbon\Carbon::parse($papp->slot->end_time)->format('H:i A') : 'N/A' }}</span>
                                        </div>
                                        <div class="show-details-content-item">
                                            {{ __('Appointment Type:') }}<span>{{ $papp->type == OFFLINE ? __('Offline') : __('Online') }}</span>
                                        </div>
                                        <div class="show-details-content-item">
                                            {{ __('Payment Method:') }}<span>{{ $papp->paymentmethod == 'cod' ? 'Spot Payment' : ucfirst($papp->paymentmethod) }}</span>
                                        </div>
                                        <div class="show-details-content-item">
                                            {{ __('Payment Status:') }}<span
                                                class="{{ $papp->is_paid == '1' ? 'text-success' : 'text-danger' }}">{{ $papp->is_paid == '1' ? 'Paid' : 'Unpaid' }}</span>
                                        </div>
                                        <div class="show-details-content-item">
                                            {{ __('Fees:') }}<span>{{ $papp->fees }}₹</span>
                                        </div>
                                        @if ($papp->type != OFFLINE)
                                            @if (hasMeeting($papp->id) == 1)
                                                <div class="show-details-content-item">
                                                    {{ __('Join URL:') }}<span><a
                                                            href="{{ $papp->meeting->join_url }}"
                                                            target="_blank">{{ $papp->meeting->join_url }}</a></span>
                                                </div>
                                                <div class="show-details-content-item">
                                                    {{ __('Meeting ID:') }}<span>{{ $papp->meeting->meeting_id }}</span>
                                                </div>

                                                <div class="show-details-content-item">
                                                    {{ __('Meeting Password:') }}<span>{{ $papp->meeting->password }}</span>
                                                </div>
                                            @else
                                                <div class="show-details-content-item">
                                                    {{ __('Meeting not available!') }}
                                                </div>
                                            @endif
                                        @endif
                                        <div class="show-details-content-item">
                                            {{ __('Comment:') }}<span>{{ $papp->comment }}</span>
                                        </div>
                                        <div class="show-details-content-item">
                                            {{ __('Test Reports:') }}
                                            <table>
                                            @if ($papp->testreports->test_file != null)
                                                @foreach (json_decode($papp->testreports->test_file, true) as $key1 => $report)
                                                    <tr>
                                                        <td>{{ $report }}</td>
                                                        <td><a class="btn btn-primary" href="{{asset('public/testreports/' . $report)}}" download="{{$report}}">Download</a></td>
                                                        <td><a class="btn btn-secondary" href="{{asset('public/testreports/' . $report)}}" target="_blank">Open File</a></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                            <span>{{ __('No Reports Found.') }}</span>
                                            @endif
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="8">
                            <div class='no-appoint-bg'>
                                <img class="img-fluid" src="{{ asset('uploaded_file/no-data-patient.svg') }}"
                                    alt="{{ __('image') }}">
                                <h2 class='no-appoint-title'>No Appointment Today</h2>
                                <a href="{{ redirectDashboard('create-appointment') }}" class='primary-btn'>Create
                                    New Appointment</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-past mt-30">
        {{ view_html($pastappall->links('vendor.pagination.simple-bootstrap-4')) }}
    </div>
</div>
