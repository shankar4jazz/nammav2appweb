<?php

namespace App\DataTables;

use App\Traits\DataTableTrait;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;

class JobseekerDataTable extends DataTable
{
    use DataTableTrait;
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
            ->addColumn('display_name', function ($row) {
                return $row->first_name . ' ' . $row->last_name;
            })
            ->addColumn('gender', function($row) {
                $details = json_decode($row->details, true);
                $gender = $details['gender'] ?? 'N/A';
                $gender = ($gender === "0") ? "Male" : (($gender === "1") ? "Female" : $gender);
                return $gender;
            })
            ->editColumn('status', function ($user) {
                if ($user->status == '0') {
                    $status = '<span class="badge-inactive">' . __('messages.inactive') . '</span>';
                } else {
                    $status = '<span class="badge badge-active">' . __('messages.active') . '</span>';
                }
                return $status;
            })
            ->editColumn('is_available', function ($user) {
                if ($user->is_available == '0') {
                    $status = '<span class="badge badge-inactive"><i class="fas fa-power-off text-secondary"></i></span>';
                } else {
                    $status = '<span class="badge badge-active"><i class="fas fa-power-off text-secondary"></i></span>';
                }
                return $status;
            })
            ->editColumn('address', function ($user) {
                return ($user->address != null && isset($user->address)) ? $user->address : '-';
            })
            ->addColumn('action', function ($user) {
                return view('jobseeker.action', compact('user'))->render();
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'status', 'is_available']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            $model = $model->withTrashed();
        }
        $query = $model->list()->newQuery()->where('user_type', 'jobseeker');

        // Check for state filter
        // if (request()->has('state')) {
        //     $state = request()->input('state_id');
        //     $query = $query->where('state', $state);
        // }

        // Check for district filter
        if (request()->has('qual_id')) {
            $q_id = request()->input('qual_id');
            $query = $query->where('qualification_id', $q_id);
        }
        if (request()->has('district_id')) {
            $district = request()->input('district_id');
            $query = $query->whereRaw("JSON_CONTAINS(districts, '{\"id\":$district}')");
        }
        return $query;
    }

    public function getTotalJobseekers()
    {
        // Get base query from the query() method
        $query = DB::table('users')->where('user_type', 'jobseeker');
        // Check for district filter
        if (request()->has('district_id')) {
            $district = request()->input('district_id');
            $query = $query->whereRaw("JSON_CONTAINS(districts, '{\"id\":$district}')");
        }

        // Clone the query to use for counting males
        $queryForMales = clone $query;
        $maleCount = $queryForMales->whereRaw("JSON_CONTAINS(details, '{\"gender\":\"0\"}')")->count();;

        // Clone the query to use for counting females
        $queryForFemales = clone $query;
        $femaleCount = $queryForFemales->whereRaw("JSON_CONTAINS(details, '{\"gender\":\"1\"}')")->count();


        // Clone the query to count 'NULL'
        $queryForNull = clone $query;
        $nullCount = $queryForNull->whereRaw("JSON_CONTAINS(details, '{\"gender\":null}') OR JSON_EXTRACT(details, '$.gender') IS NULL")->count();

        // Clone the query to count 'Null'
        $queryForTextNull = clone $query;
        $textNullCount = $queryForTextNull->whereRaw("JSON_CONTAINS(details, '{\"gender\":\"Null\"}')")->count();

        // Clone the query to count 'Male'
        $queryForOther = clone $query;
        $otherCount = $queryForOther->whereRaw("JSON_CONTAINS(details, '{\"gender\":\"2\"}')")->count();

        // Clone the query to count 'other'
        $queryForMales1 = clone $query;
        $maleCount1 = $queryForMales1->whereRaw("JSON_CONTAINS(details, '{\"gender\":\"Male\"}')")->count();

        // Clone the query to count 'Female'
        $queryForFemales1 = clone $query;
        $femaleCount1 = $queryForFemales1->whereRaw("JSON_CONTAINS(details, '{\"gender\":\"FeMale\"}')")->count();

        // return [
        //     'NULL' => $nullCount,
        //     'Null' => $textNullCount,
        //     'Male' => $maleCount,
        //     'Female' => $femaleCount,
        // ];

        // Create an array with the counts

        $counts = [
            'Male' => $maleCount + $maleCount1,
            'Female' => $femaleCount + $femaleCount1,
            'Total' => $maleCount + $femaleCount, // Optional, if you want the total count
            'Null' => $nullCount + $textNullCount,
            'Other' => $otherCount
        ];
        return $counts;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')
                ->searchable(false)
                ->title(__('messages.srno'))
                ->orderable(false)
                ->width(60),
            Column::make('display_name')
                ->title(__('messages.name')),
            Column::make('gender')
                ->title(__('gender')),
            Column::make('contact_number'),
            Column::make('status'),
            Column::make('is_available'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('add'),
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Jobseekers_' . date('YmdHis');
    }
}
