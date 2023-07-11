<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->editColumn('action', function($data) {
            $activeUrl = route('activeButtons', $data->id);
            $inactiveUrl = route('inactiveButtons', $data->id);
            return '<div style="white-space: nowrap;">
                        <a href="'.$activeUrl.'" class="btn btn-success edit-button"  style="margin-right: 5px; >
                            <i class="fas fa-edit" style="margin-right: 5px;">Active</i> 
                        </a>
                        <a href="'.$inactiveUrl.'" class="btn btn-danger edit-button"  style="margin-right: 5px; >
                            <i class="fas fa-edit" style="margin-right: 5px;">Inactive</i> 
                        </a>
                       
                    </div>';
        })
            ->editColumn('profile_img', function ($data) {
                return "<img src='" . asset('storage/user_img/'.$data->profile_img) . "' class='rounded' width='50px' height='50px'/>";
            })
            ->rawColumns(['profile_img', 'action'])
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->data('DT_RowIndex'),
            Column::make('name'),
            Column::make('email'),
            Column::make('phone_no'),
            Column::make('profile_img'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
