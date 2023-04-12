<?php

namespace App\DataTables\Admin;

use App\Models\Reservation\Reservation;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;

class ReservationDataTable extends DataTable
{

    protected $view = 'admin_dashboard.reservations.';
   
    public function dataTable($query,Request $request)
    {
        return datatables()
        ->eloquent($query)
        ->addColumn('action', $this->view .'.action')
        ->rawColumns([
            'action',
        ]);
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Reservation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Reservation $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->parameters([
            'dom' => 'Blfrtip',
            'order' => [0, 'desc'],
            'lengthMenu' => [
                [10,25,50,-1],[10,25,50,'all record']
            ],
       'buttons'      => ['export'],
   ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            ["data" => "id" ,"title" => __('messages.id')],

            ["data" => "user_name" ,"title" => __('messages.user_name')],
            ["data" => "user_phone" ,"title" => __('messages.user_phone')],
            // ["data" => "contact_type_title" ,"title" => __('messages.contact_type'),'orderable'=>false,'searchable'=>false],
            ["data" => "date" ,"title" => __('messages.date')],
            // ["data" => "price" ,"title" => __('messages.price')],
            // ["data" => "time" ,"title" => __('messages.time')],
            ["data" => "from_time_format" ,"title" => __('messages.from'),'orderable'=>false,'searchable'=>false],
            ["data" => "to_time_format" ,"title" => __('messages.to'),'orderable'=>false,'searchable'=>false],
            ["data" => "created_at_format" ,"title" => __('messages.reservation_date'),'orderable'=>false,'searchable'=>false],
            ['data'=>'action','title'=>__("messages.actions"),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Reservation_' . date('YmdHis');
    }
}
