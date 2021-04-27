<?php

namespace App\DataTables;

use App\Models\TaskRequest;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TaskRequestDataTable extends DataTable
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
            ->editColumn('title', function ($item) {
                return Str::limit($item->title, 35);
            })
            ->addColumn('reporter', function ($item) {
                if (!empty($item->reporter_id)) {
                    return Str::limit($item->reporter->name, 25);
                }
                return '';
            })
            ->addColumn('assignee', function ($item) {
                if (!empty($item->assignee_id)) {
                    return Str::limit($item->assignee->name, 25);
                }
                return '';
            })
            ->editColumn('created_at', function ($item) {
                return Carbon::parse($item->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function($item) {
                return view('partials.request', compact('item'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TaskRequest $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TaskRequest $model)
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
                    ->setTableId('taskrequest-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0)
                    ->buttons(
                        Button::make('create')->className('btn-sm')->text('New Request'),
                        Button::make('export')->buttons(['csv', 'excel'])->className('btn-sm'),
                        Button::make('print')->className('btn-sm'),
                        Button::make('reset')->className('btn-sm'),
                        Button::make('reload')->className('btn-sm')
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
            Column::make('id'),
            Column::make('title'),
            Column::computed('reporter')->title('Requested by'),
            Column::computed('assignee')->title('Assigned to'),
            Column::make('priority')->width(50),
            Column::make('status')->width(60),
            Column::make('created_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(130)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'TaskRequest_' . date('YmdHis');
    }
}
