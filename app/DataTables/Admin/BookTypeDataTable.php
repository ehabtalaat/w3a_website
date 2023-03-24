<?php

namespace App\DataTables\Admin;

use App\Models\BookType\BookType;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;

class BookTypeDataTable extends DataTable
{

    protected $view = 'admin_dashboard.book_types.';
   
    public function dataTable($query,Request $request)
    {
        return datatables()
        ->eloquent($query)
        ->addColumn('action', $this->view .'.action')
        ->rawColumns([
            'action',
        ])->filter(function ($query) use ($request) {

            if ($request->has('search') && isset($request->input('search')['value'])

            && !empty($request->input('search')['value'])) {

                $searchValue = $request->input('search')['value'];

                $query->whereTranslationLike("title", "%" . $searchValue . "%");
            }
        })->orderColumn('title', function ($query, $order) {
            $query->orderByTranslation('title', $order);
        });
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\book_type $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BookType $model): QueryBuilder
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
            ["data" => "id" ,"title" => 'id'],
            ["data" => "title" ,"title" => __('messages.title')],
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
        return 'book_type_' . date('YmdHis');
    }
}
