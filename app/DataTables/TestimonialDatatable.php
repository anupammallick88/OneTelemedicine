<?php

namespace App\DataTables;

use App\Models\Front\Testimonial;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TestimonialDatatable extends DataTable
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
            ->addColumn('image', function ($query) {
                if (isset($query->image)) {
                    return '<img src="' . asset(path_testimonial_image() . $query->image) . '" class="wdh-90" alt="' . __('No Image') . '"/>';
                } else {
                    return '<img src="' . Avatar::create($query->name)->toBase64() . '" class="wdh-90" alt="' . __('No Image') . '"/>';
                }
            })
            ->editColumn('created_at', function ($request) {
                return $request->created_at->diffForHumans(); // human readable format
            })
            ->editColumn('status', function ($query) {
                if ($query->status == 1) {
                    return '<span class="bg-blue text-white px-2">' . __('Active') . '</span>';
                } elseif ($query->status == 2) {
                    return '<span class="bg-yellow text-white px-2">' . __('Draft') . '</span>';
                }
            })

            ->addColumn(
                'action',
                function ($data) {
                    $btn = '';
                    if (auth()->user()->can('testimonial-edit')) {
                        $btn = $btn . '<a href="' . route("testimonial.edit", $data->id) . '"><i class="ik ik-edit"></i></a>';
                    }
                    if (auth()->user()->can('testimonial-delete')) {
                        $btn = $btn . '<a class="delete" href="' . route("testimonial.delete", $data->id) . '"><i class="ik ik-trash-2"></i></a> ';
                    }
                    return $btn;
                }
            )->rawColumns(['image', 'action', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Testimonial $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Testimonial $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->addIndex()
            ->setTableId('users-table')->addTableClass('table-striped')->autoWidth()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->serverSide(true)
            ->dom('lBfr<"table-responsive"t>ip')
            ->orderBy(1)
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
            Column::make('image')->orderable(false),
            Column::make('name'),
            Column::make('title'),
            Column::make('star'),
            Column::make('status'),
            Column::make('created_at'),
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
        return 'Testimonial_' . date('YmdHis');
    }
}
