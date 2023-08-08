<?php

namespace App\DataTables;

use Illuminate\Support\Str;
use App\Models\Admin\Comment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CommentDatatable extends DataTable
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
            ->editColumn('created_at', function ($request) {
                return $request->created_at->diffForHumans(); // human readable format
            })
            ->addColumn('message', function ($query) {
                return Str::limit($query->massage, 120, '...');
            })
            ->editColumn('name', function ($query) {
                return $query->user->name;
            })
            ->addColumn('view', '<a class="btn btn-info text-white" type="button" data-toggle="modal" data-target="#exampleModalCenter{{$id}}">' . __('View Full Message') . '</a>')
            ->editColumn('email', function ($query) {
                return $query->user->email;
            })

            ->editColumn('status', function ($query) {
                if ($query->status == 0) {
                    return '<span class="text-danger">' . __('Unapproved') . '</span>';
                } else {
                    return '<span class="text-success">' . __('Approved') . '</span>';
                }
            })

            ->addColumn(
                'action',
                function ($data) {
                    $btn = '';
                    if (auth()->user()->can('comment-approve')) {
                        $btn = $btn . '<a href="' . route("comment.approved", $data->id) . '"><i class="ik ik-check"></i></a>';
                    }
                    if (auth()->user()->can('comment-approve')) {
                        $btn = $btn . '<a href="' . route("comment.unapproved", $data->id) . '"><i class="ik ik-x"></i></a>';
                    }
                    if (auth()->user()->can('comment-delete')) {
                        $btn = $btn . '<a class="delete" href="' . route("comment.delete", $data->id) . '"><i class="ik ik-trash-2"></i></a> ';
                    }
                    return $btn;
                }
            )->rawColumns(['action', 'view', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Comment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Comment $model)
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
            Column::make('name')->orderable(false)->searchable(false),
            Column::make('email')->orderable(false)->searchable(false),
            Column::make('message'),
            Column::make('view'),
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
        return 'Comment_' . date('YmdHis');
    }
}
