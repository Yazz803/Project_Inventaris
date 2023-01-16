<?php

namespace App\DataTables;

use App\Models\Lending;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LendingsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($lending) {
                $btnReturned = '
                    <form action="'.route('dashboard.operator.lending.returned', $lending->id).'" method="POST">
                        '.csrf_field().'
                        '.method_field('PUT').'
                        <button type="submit" class="btn btn-warning">Returned</button>
                    </form>
                ';
                $btnDelete = '
                    <form action="'.route('dashboard.operator.lending.delete', $lending->id).'" method="POST">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                ';
                $check = $lending->returned != null ? $btnDelete : ($btnReturned . $btnDelete);
                $div = 
                '<div class="d-flex justify-content-between align-items-center gap-2">'
                    .$check.
                '</div>';   

                return $div;
            })
            ->setRowId('id')
            ->editColumn('total', function($lending){
                return $lending->total > 0 ? $lending->total : $lending->total_return;
            })
            ->editColumn('item_id', function($lending){
                return $lending->item->name;
            })
            ->editColumn('date', function($lending){
                return $lending->created_at->translatedFormat('F d, Y');
            })
            ->editColumn('returned', function($lending){
                $notReturned = '<button class="btn btn-outline-warning">Not Returned</button>';
                $dateReturn = $lending->updated_at->translatedFormat('M d, Y');
                $returned = "<button class='btn btn-outline-success'>$dateReturn</button>";
                return $lending->returned != NULL ? $returned : $notReturned;
            })->escapeColumns(['returned' => true]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Lending $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Lending $model): QueryBuilder
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
                    ->setTableId('lendings-table')
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
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')
            ->width(20)
            ->title('#')
            ->exportable(false),
            Column::make('item_id')
                  ->title('Item'),
            Column::make('total'),
            Column::make('name'),
            Column::make('keterangan'),
            Column::make('date'),
            Column::make('returned'),
            Column::make('edited_by')
                  ->title('Edited By')
                  ->addClass('font-weight-bold'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Lendings_' . date('YmdHis');
    }
}
