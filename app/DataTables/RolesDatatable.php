<?php

namespace App\DataTables;

use Spatie\Permission\Models\Role;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RolesDatatable extends DataTable
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
            ->addColumn('action', function ($query) {
                $btn = '';
                if (auth()->user()->can('role-edit')) {
                    $btn = $btn . '<a href="' . route('admin.role.edit', $query->id) . '" class="btn-action"><i class="ik ik-edit"></i></a>';
                }
                if (auth()->user()->can('role-delete')) {
                    $btn = $btn . '<a href="' . route('admin.role.delete', $query->id) . '" class="btn-action delete"><i class="ik ik-trash-2"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['title', 'description', 'action', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Faq $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
    {
        return $model->newQuery()->orderBy('id', 'desc');
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
            Column::make('name'),
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
        return 'Faq_' . date('YmdHis');
    }
}
