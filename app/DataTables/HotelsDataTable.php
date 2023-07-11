<?php

namespace App\DataTables;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use function Termwind\render;

class HotelsDataTable extends DataTable
{
   
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', '')
            ->editColumn('action', function($data) {
                $editUrl = route('hotel_edit', $data->id);
                $deleteUrl = route('hotel_delete', $data->id);
                return '<div style="white-space: nowrap;">
                            <a href="'.$editUrl.'" class="btn btn-primary edit-button" style="margin-right: 5px;">
                                <i class="fas fa-edit" style="margin-right: 5px;"></i> Edit
                            </a>
                            <a href="'.$deleteUrl.'" class="btn btn-danger delete-button" onclick="return confirm(\'Are you sure you want to delete this user?\')">
                                <i class="fas fa-trash-alt" style="margin-right: 5px;"></i> Delete
                            </a>
                        </div>';
            })
            ->editColumn('logo', function ($data) {
                return "<img src='" . asset('storage/images/'.$data->logo) . "' class='rounded' width='50px' height='50px'/>";
            })
            
            
            ->rawColumns(['logo', 'action'])
            
           
            ->addIndexColumn()
            ->setRowId('id');
           
    }

    
    public function query(Hotel $model): QueryBuilder
    {
        return $model->newQuery();
    }

   
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('hotels-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
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

    
    public function getColumns(): array
    {
        return [
           
            Column::make('no')->data('DT_RowIndex'),
            Column::make('hotel_name')->title('Name'),
            Column::make('hotel_email')->title('Email'),
            Column::make('address')->title('Address'),
            Column::make('postal_code')->title('Code'),
            Column::make('country_id')->title('Country'),
            Column::make('state_id')->title('State'),
            Column::make('city_id')->title('City'),
            Column::make('description')->title('Detail'),
            Column::make('logo')->title('Logo'),
            
            Column::make('total_rooms')->title('Rooms'),
            Column::make('status'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
           
        ];
    }
    protected function filename(): string
    {
        return 'Hotels_' . date('YmdHis');
    }   
}
