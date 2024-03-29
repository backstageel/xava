<?php

namespace App\DataTables;

use App\Models\Employee;
use App\Traits\WithActionColumn;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class EmployeesDataTable extends DataTable
{
    use WithActionColumn;

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                return $this->getActionColumn($row);
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Employee $model): QueryBuilder
    {
        return $model->newQuery()->with(['person', 'department', 'contractType', 'employeePosition', 'contractStatus']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('employees-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0, 'ASC')
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('employee_code')->title('Código'),
            Column::make('person.first_name')->title('Nome'),
            Column::make('person.cellphone')->title('Celular'),
            Column::make('department.name')->title('Departamento'),
            Column::make('employee_position.name')->title('Cargo'),
            Column::make('contract_type.name')->title('Tipo de Contrato'),
            Column::make('start_date')->title('Data de Admissão'),
            Column::make('contract_status.name')->title('Estado do Contrato'),
            Column::computed('action')->title('Acções')
                ->exportable(false)
                ->printable(false)
                ->width(90)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Employees_' . date('YmdHis');
    }
}
