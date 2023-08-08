<div class="primary-table">
    <div class="table-responsive">
        <table class="table" id="todaypagination">
            <thead>
                <tr>
                    <th scope="col">{{ __('Doctor Name') }}</th>
                    <th scope="col">{{ __('Date') }}</th>
                    <th scope="col">{{ __('Time') }}</th>
                    <th scope="col">{{ __('Type') }}</th>
                    <th scope="col">{{ __('Status') }}</th>
                    <th scope="col">{{ __('Prescription') }}</th>
                    <th scope="col">{{ __('Test Reports') }}</th>
                    <th scope="col">{{ __('Meeting Link') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody class="accordion" id="accordionExample2">
                @forelse($todaysapp as $app)
                    <tr>
                        <td>
                            <div class="user-info">
                                <img class="user-image"
                                    src="{{ isset($app->doctor->user->image) ? asset(path_user_image() . $app->doctor->user->image) : Avatar::create($app->doctor->user->name)->toBase64() }}"
                                    alt="{{ __('doctor-image') }}" />
                                <h3 class="user-name">{{ $app->doctor->user->name }}</h3>
                            </div>
                        </td>
                        <td>{{ $app->appdate }}</td>
                        <td>{{ Carbon\Carbon::parse($app->slot->start_time)->format('H:i A') }}</td>
                        <td>{{ $app->type == OFFLINE ? __('Offline') : __('Online') }}</td>
                        <td>
                            @if (Carbon\Carbon::parse($app->appdate) < Carbon\Carbon::today() && $app->status == 0)
                                <span class="text-danger">
                                    {{ __('Cancelled') }}
                                    <!-- No action taken by doctor -->
                                </span>
                            @elseif(Carbon\Carbon::parse($app->appdate) < Carbon\Carbon::today() && $app->status == 1)
                                <span class="text-danger">
                                    {{ __('Cancelled') }}
                                    <!-- Cancelled -->
                                </span>
                            @elseif($app->status == 3)
                                <span class="text-danger">
                                    {{ __('Cancelled') }}
                                    <!-- Cancelled by Doctor -->
                                </span>
                            @elseif($app->status == 1)
                                <span class="text-warning">
                                    {{ __('Approved') }}
                                    <!-- Doctor Approved -->
                                </span>
                            @elseif ($app->status == 2)
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

                        @if (Carbon\Carbon::parse($app->appdate) < Carbon\Carbon::today() && $app->status == 0)
                            <td>
                                <a class="common-tbl-btn disabled-btn" href="javascript:void(0)" data-toggle="popover"
                                    title="{{ __('No Prescription') }}"
                                    data-content="{{ __('Prescription Not Available!') }}"
                                    role="button">{{ __('No Prescription') }}</a>
                            </td>
                        @elseif (Carbon\Carbon::parse($app->appdate) < Carbon\Carbon::today() && $app->status == 1)
                            <td>
                                <a class="common-tbl-btn disabled-btn" href="javascript:void(0)" data-toggle="popover"
                                    title="{{ __('No Prescription') }}"
                                    data-content="{{ __('Prescription Not Available!') }}"
                                    role="button">{{ __('No Prescription') }}</a>
                            </td>
                        @elseif ($app->status == 2)
                            <td>
                                <a class="common-tbl-btn view-button" href="#" role="button" data-toggle="modal"
                                    data-target="#ViewPrescription{{ $app->id }}">{{ __('View Prescription') }}</a>
                            </td>
                        @else
                            <td>
                                <a class="common-tbl-btn disabled-btn" href="javascript:void(0)" data-toggle="popover"
                                    title="{{ __('No Prescription') }}"
                                    data-content="{{ __('Prescription Not Available!') }}"
                                    role="button">{{ __('No Prescription') }}</a>
                            </td>
                        @endif
                        <td>
                            <!-- <a class="common-tbl-btn view-button" href="javascript:void(0)" role="button" data-toggle="modal"
                                    data-target="#viewReportsModal{{ $app->id }}">{{ __('View Reports') }}</a> -->
                                    <button type="button" class="common-tbl-btn view-button" data-toggle="modal" data-target="#myModal">{{ __('View Reports') }}</button>
                        </td>
                        <td>
                            <div class="create-link-btn">
                                @if (Carbon\Carbon::parse($app->appdate) == Carbon\Carbon::today() && $app->status == 1 && $app->type != OFFLINE)
                                    @if (hasMeeting($app->id) == 1)
                                        <a class="common-tbl-btn view-button" role="button" data-toggle="modal"
                                            data-target="#viewMeetingModal{{ $app->id }}">{{ __('View') }}</a>
                                    @else
                                        <a class="common-tbl-btn create-button" role="button" data-toggle="modal"
                                            data-target="#createMeetingModal{{ $app->id }}">{{ __('Create') }}</a>
                                    @endif
                                @else
                                    <a class="common-tbl-btn disabled-btn" href="javascript:void(0)"
                                        role="button">{{ __('No Link') }}</a>
                                @endif
                            </div>
                        </td>

                        <td>
                            <div class="action-btn-wrap">
                                {{-- @if ($app->status == 2) --}}
                                {{-- @else --}}
                                {{-- <a class="common-tbl-btn delete-button" title="{{__('Delete')}}" href="{{route('delete.appointment', $app->id)}}"><i class="fas fa-trash-alt"></i></a> --}}
                                {{-- @endif --}}
                                <div id="heading{{ $app->id }}">
                                    <button class="common-tbl-btn show-icon collapsed" type="button"
                                        title="Show Details" data-toggle="collapse"
                                        data-target="#collapse2{{ $app->id }}">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="show-details-content">
                        <td colspan="6">
                            <div id="collapse2{{ $app->id }}" class="collapse"
                                data-parent="#accordionExample2">
                                <div class="card-body d-flex">
                                    <div>
                                        <div class="show-details-content-item">
                                            {{ __('Doctor:') }}
                                            <span>{{ isset($app->doctor->user->name) ? $app->doctor->user->name : '' }}</span>
                                        </div>
                                        <div class="show-details-content-item">
                                            {{ __('Appointment Date:') }}<span>{{ $app->appdate }}</span>
                                        </div>
                                        <div class="show-details-content-item">
                                            {{ __('Appointment Time:') }}<span>{{ Carbon\Carbon::parse($app->slot->start_time)->format('H:i A') }}-{{ Carbon\Carbon::parse($app->slot->end_time)->format('H:i A') }}</span>
                                        </div>
                                        <div class="show-details-content-item">
                                            {{ __('Appointment Type:') }}<span>{{ $app->type == OFFLINE ? __('Offline') : __('Online') }}</span>
                                        </div>
                                        <div class="show-details-content-item">
                                            {{ __('Payment Method:') }}<span>{{ $app->paymentmethod == 'cod' ? 'Spot Payment' : ucfirst($app->paymentmethod) }}</span>
                                        </div>
                                        <div class="show-details-content-item">
                                            {{ __('Payment Status:') }}<span
                                                class="{{ $app->is_paid == '1' ? 'text-success' : 'text-danger' }}">{{ $app->is_paid == '1' ? 'Paid' : 'Unpaid' }}</span>
                                        </div>
                                        <div class="show-details-content-item">
                                            {{ __('Fees:') }}<span>{{ $app->fees }}₹</span>
                                        </div>
                                        @if ($app->type != OFFLINE)
                                            @if (hasMeeting($app->id) == 1)
                                                <div class="show-details-content-item">
                                                    {{ __('Join URL:') }}<span><a
                                                            href="{{ $app->meeting->join_url }}"
                                                            target="_blank">{{ __('Goto Link') }}</a></span>
                                                </div>
                                                <div class="show-details-content-item">
                                                    {{ __('Meeting ID:') }}<span>{{ $app->meeting->meeting_id }}</span>
                                                </div>

                                                <div class="show-details-content-item">
                                                    {{ __('Meeting Password:') }}<span>{{ $app->meeting->password }}</span>
                                                </div>
                                            @else
                                                <div class="show-details-content-item">
                                                    {{ __('Meeting not available!') }}
                                                </div>
                                            @endif
                                        @endif
                                        <div class="show-details-content-item">
                                            {{ __('Comment:') }}<span>{{ $app->comment }}</span>
                                        </div>
                                        <div class="show-details-content-item">
                                            {{ __('Test Reports:') }}                                            
                                            <table>
                                            @if ($app->testreports->test_file != null)
                                                @foreach (json_decode($app->testreports->test_file, true) as $key1 => $report)
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

    

    <div class="pagination-today mt-30">
        {{ view_html($todaysapp->links('vendor.pagination.todaypagi')) }}
    </div>
</div>
