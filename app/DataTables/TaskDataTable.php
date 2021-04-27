<?php

namespace App\DataTables;

use App\Models\Task;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;

class TaskDataTable extends DataTable
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
            ->setRowClass(function ($item) {
                return $item->type;
            })
            ->setRowAttr([
                'style' => function($item){
                    if($item->type == 'weekend'){
                        return 'background-color: #00695c';
                    }elseif($item->type == 'offday'){
                        return 'background-color: #1565c0';
                    }else{
                        return '';
                    }
                }
            ])
            ->editColumn('title', function ($item) {
                if ($item->type == 'task' && empty($item->title)) {
                    return 'No Task';
                }
                return $item->title;
            })
            ->editColumn('priority', function ($item) {
                if ($item->type == 'task') {
                    return Str::title($item->priority);
                }
                return null;
            })
            ->addColumn('reporter', function ($item) {
                if (!empty($item->reporter_id)) {
                    return $item->reporter->name;
                }
                return '';
            })
            ->addColumn('assignee', function ($item) {
                if (!empty($item->assignee_id)) {
                    return $item->assignee->name;
                }
                return '';
            })
            ->addColumn('action', function($item) {
                return view('partials.task', compact('item'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Task $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Task $model)
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
                    ->setTableId('task-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0)
                    ->buttons(
                        Button::make('create')->className('btn-sm')->text('New Task'),
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
            Column::make('reported_at')->title('Date'),
            Column::make('title')->title('Task'),
            Column::make('hours')->width(50),
            Column::computed('reporter'),
            Column::computed('assignee'),
            Column::make('priority')->width(50),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(100)
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
        return 'Task_' . date('YmdHis');
    }
}
