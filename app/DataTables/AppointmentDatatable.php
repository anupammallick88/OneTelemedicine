<?php

namespace App\DataTables;

use Laravolt\Avatar\Facade as Avatar;
use App\Models\Models\Appointment;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AppointmentDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('Doctor Name', function ($query) {
                return $query->doctor->user->name;
            })
            ->addColumn('Patient Name', function ($query) {
                return $query->patient->name;
            })
            ->addColumn('Service', function ($query) {
                return $query->doctorsService;
            })
            ->addColumn('Appointment Date', function ($query) {
                return $query->appdate;
            })
            ->addColumn('Time Slot', function ($query) {
                if ($query->slot != null) {
                    return $query->slot->start_time  . '-' . $query->slot->end_time;
                }
                return 'N/A';
            })
            ->editColumn('created_at', function ($request) {
                return $request->created_at->diffForHumans(); // human readable format
            })
            ->editColumn('status', function ($query) {
                if (Carbon::parse($query->appdate) < Carbon::today() && $query->status == 0) {
                    return  __('No action taken by doctor');
                }

                if (Carbon::parse($query->appdate) > Carbon::today() && $query->status == 0) {
                    return  __('No action taken by doctor');
                }

                if (Carbon::parse($query->appdate) == Carbon::today() && $query->status == 0) {
                    return  __('Approval required');
                }

                if (Carbon::parse($query->appdate) < Carbon::today() && $query->status == 1) {
                    return  __('Cancelled');
                }
                if (Carbon::parse($query->appdate) > Carbon::today() && $query->status == 1) {
                    return  __('Upcoming');
                }

                if (Carbon::parse($query->appdate) == Carbon::today() && $query->status == 1) {
                    return __('Ongoing');
                }

                if ($query->status == 2) {
                    return __('Completed');
                }

                if ($query->status == 3) {
                    return __('Cancelled by Doctor');
                }
            })
            ->addColumn(
                'action',
                function ($query) {
                    $btn = '';

                    if ($query->status == 2) {
                        if ($query->is_paid == 0) {
                            $btn = $btn . '<a title="Pay to doctor" href="' . route("appointment.payment-to-doctor", $query->id) . '"><i class="fa fa-money-bill"></i></a>';
                        } else {
                            $btn = $btn . '<a title="Already paid" href="javascript:void(0)"><i class="fa fa-money-bill"></i></a>';
                        }
                    } else {
                        if (auth()->user()->can('appointment-delete')) {
                            $btn = $btn . '<a class="delete" title="Delete" href="' . route("appointment.delete", $query->id) . '"><i class="ik ik-trash-2"></i></a>';
                        }
                    }

                    if ($query->paymentmethod == 'Bank' && $query->is_paid == 0) {
                        $btn = $btn . '<a class="" title="Request" onclick="appDetails(' . $query->id . ')"><i class="ik ik-credit-card"></i></a>';
                    }

                    return $btn;
                }
            )
            ->rawColumns(['image', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AppointmentDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Appointment $model)
    {
        return $model->newQuery()
            ->with('doctor', 'patient', 'slot')
            ->when(request('paymentType') == 'bank', function ($q) {
                $q->where('paymentmethod', 'Bank')->where('is_paid', 0);
            })
            ->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')->addTableClass('table-striped')->autoWidth()
            ->addIndex()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->serverSide(true)
            ->dom('lBfrtip')
            ->orderBy(0) //1 for ascending and 0 for descending
            ->language([
                'processing' => '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500 dt-table-processing"></i>'
            ])
            ->buttons(
                Button::make('colvis')->text('Show/Hide')->addClass('btn-info')->text('<i class="fas fa-eye"></i> ' . __('Show/hide')),
                Button::make('copy')->addClass('btn-success hide-mobile')->text('<i class="far fa-copy"></i>' . __('Copy')),
                Button::make('export')->addClass('btn-warning'),
                Button::make('reset')->addClass('btn-info hide-mobile'),
                Button::make('reload')->addClass('btn-default hide-mobile')->text('<i class="fas fa-fw fa-sync"></i> ' . __('Reload')),
                Button::make('print')->addClass('btn-primary'),
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('No')->orderable(false)->searchable(false),
            Column::make('Patient Name'),
            Column::make('Doctor Name'),
            Column::make('Service'),
            Column::make('Appointment Date'),
            Column::make('Time Slot'),
            Column::make('created_at'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('table-actions'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Appointment_' . date('YmdHis');
    }
}
