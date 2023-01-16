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
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($user) {
                if($user->role == last(request()->segments())){
                    if($user->role == 'admin'){
                        $btnEdit = '<a href="'.route('dashboard.accounts.edit', $user->id).'" class="btn btn-primary">Edit</a>';
                        $btnDelete = '<a href="'.route('dashboard.accounts.delete', $user->id).'" class="btn btn-danger">Delete</a>';
                        $div = 
                        '<div class="d-flex justify-content-around align-items-center gap-2">'
                            .$btnEdit.
                            $btnDelete.
                        '</div>';

                        return $div;
                    }elseif($user->role == 'operator'){
                        $btnReset = '
                            <form action="'.route('dashboard.accounts.resetpassword', $user->id).'" method="POST">
                                '.csrf_field().'
                                '.method_field('PUT').'
                                <button type="submit" class="btn btn-warning">Reset Password</button>
                            </form>
                        ';
                        $btnDelete = '
                            <form action="'.route('dashboard.accounts.delete', $user->id).'" method="POST">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        ';
                        $div = 
                        '<div class="d-flex justify-content-between align-items-center gap-2">'
                            .$btnReset.
                            $btnDelete.
                        '</div>';

                        return $div;
                    }
                }
            })
            // ->setRowId('id')
            ->editColumn('id', function($user) {
                if($user->role == last(request()->segments())){
                    return $user->id;
                }
            })
            ->editColumn('name', function($user) {
                if($user->role == last(request()->segments())){
                    return $user->name;
                }
            })
            ->editColumn('email', function($user) {
                if($user->role == last(request()->segments())){
                    return $user->email;
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
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
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->title('#')
                ->width(20)
                ->exportable(false),
            Column::make('name'),
            Column::make('email'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
                  ->addClass('text-center'),
            Column::make('default_pw')
                ->visible(false)
                ->title('Password'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
