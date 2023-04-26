<?php

namespace App\DataTables;

use App\Traits\DataTableTrait;

use App\Models\JobsPlans;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class JobPlanDataTable extends DataTable
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
            ->editColumn('plancategory_id' , function ($subcategory){
                return ($subcategory->plancategory_id != null && isset($subcategory->jobsplans)) ? $subcategory->jobsplans->ta_name : '-';
            })
            ->filterColumn('plancategory_id',function($query,$keyword){
                $query->whereHas('category',function ($q) use($keyword){
                    $q->where('name','like','%'.$keyword.'%');
                });
            })
            ->editColumn('status', function ($plan) {
                return '<div class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline">
                    <div class="custom-switch-inner">
                        <input type="checkbox" class="custom-control-input bg-primary change_status"  data-type="plan_status" ' . ($plan->status ? "checked" : "") . ' value="' . $plan->id . '" id="' . $plan->id . '" data-id="' . $plan->id . '" >
                        <label class="custom-control-label" for="' . $plan->id . '" data-on-label="" data-off-label=""></label>
                    </div>
                </div>';
            })
            ->editColumn('price', function ($plan) {
                return getPriceFormat($plan->price);
            })
            ->editColumn('total_amount', function ($plan) {
               
                return getPriceFormat($plan->total_amount);
            })
            ->editColumn('percentage', function ($plan) {
                return $plan->percentage ."%";
            })
            ->editColumn('amount', function ($plan) {
                return getPriceFormat($plan->amount);
            })
            ->editColumn('tax', function ($plan) {
                return $plan->tax ."%";
            })
            ->addColumn('action', function ($plan) {
                return view('jobsplan.action', compact('plan'))->render();
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Plans $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(JobsPlans $model)
    {
        return $model->newQuery();
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
                ->title(__('messages.no'))
                ->orderable(false),
            Column::make('plancategory_id')
                ->title(__('messages.category')),    
                Column::make('title'),      
            Column::make('type'),
            Column::make('price'),
            Column::make('percentage')
            ->title(__('Offer %')),
            Column::make('amount'),
         
            Column::make('total_amount')
            ->title(__('Total Amount(with GST) %')),
            Column::make('status'),
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
    protected function filename()
    {
        return 'Plan_' . date('YmdHis');
    }
}
