<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EarningDataTable extends DataTable
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
            ->addColumn('Earning (Online)', function ($data) {
                return fetchOnlineEarningByDoctor($data->doctor->id) . ' (in INR)';
            })
            // ->addColumn('Earning (Offline)', function ($data) {
            //     return fetchOfflineEarningByDoctor($data->doctor->id) . ' (in USD)';
            // })
            ->addColumn('No of Appointment (Online)', function ($data) {
                return countOnlineEarningByDoctor($data->doctor->id);
            })
            // ->addColumn('No of Appointment (Offline)', function ($data) {
            //     return countOfflineEarningByDoctor($data->doctor->id);
            // })
            ->addColumn('Total Cancel Appointment', function ($data) {
                return countCancelAppointmentByDoctor($data->doctor->id);
            })
            ->addColumn('Payment', function ($data) {
                $btn = '';
                if (auth()->user()->can('earning-create')) {
                    $btn = $btn . '<a href="javascript:void(0)" title="Add Payment" data-toggle="modal" data-target="#earningModalCenter' . $data->doctor->id . '"><i class="ik ik-plus-circle"></i></a>';
                }
                $btn = $btn . '<a href="javascript:void(0)" title="View All Payment" data-toggle="modal" data-target="#viewModalCenter' . $data->doctor->id . '"><i class="fa fa-info-circle"></i></a>';
                $btn = $btn . '<a href="javascript:void(0)" title="Last 12 Month Pay" class="doctorPayDetails" data-route="' . route('earnings.details', @$data->doctor->id) . '" ><i class="fa fa-list"></i></a>';

                return $btn;
            })
            ->addColumn('Total Earning', function ($data) {
                return '<b>Total Earning (in INR): ' . fetchEarningByDoctor($data->doctor->id);
            })->rawColumns(['Earning (Online)', 'No of Appointment', 'Total Cancel Appointment', 'Total Earning', 'Payment']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\EarningDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->where('role', 'doctor');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    

    public function html()
    {
        return $this->builder()
            ->setTableId('earningdatatable-table')->addTableClass('table-striped')->autoWidth()
            ->addIndex()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->serverSide(true)
            ->dom('lBfr<"table-responsive"t>ip')
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
            Column::make('name'),
            Column::make('Earning (Online)'),
            // Column::make('Earning (Offline)'),
            Column::make('Total Earning'),
            Column::make('No of Appointment (Online)'),
            // Column::make('No of Appointment (Offline)'),
            Column::make('Total Cancel Appointment'),
            Column::computed('Payment')
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
        return 'Earning_' . date('YmdHis');
    }
}
