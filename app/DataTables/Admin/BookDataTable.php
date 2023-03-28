<?php

namespace App\DataTables\Admin;

use App\Models\BookType\Book;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;

class BookDataTable extends DataTable
{

    protected $view = 'admin_dashboard.books.';
   
    public function dataTable($query,Request $request)
    {
        return datatables()
        ->eloquent($query)
        ->editColumn("image", function ($query) {
            if ($query->image) {
                $image = $query->image->image_link;
                $status = '<img src="'.$image.'">';
            } else {
                $status =__('messages.doesnt have image');
            }
            return $status;
        })
        ->addColumn('action', $this->view .'.action')
        ->rawColumns([
            'image',
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
     * @param \App\Models\Book $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Book $model): QueryBuilder
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
            ["data" => "image" ,"title" => __('messages.image'),'searchable'=>false,'orderable'=>false],
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
        return 'Book_' . date('YmdHis');
    }
}
