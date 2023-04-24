<?php

namespace App\DataTables;
use App\Traits\DataTableTrait;

use App\Models\JobsPayment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class JobsPaymentDataTable extends DataTable
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
            ->editColumn('job_id', function($payment) {
                return ($payment->job_id != null &&isset($payment->booking->title)) ? $payment->booking->title :'-';
            })
            ->filterColumn('job_id',function($query,$keyword){
                $query->whereHas('booking.service',function ($q) use($keyword){
                    $q->where('name','like','%'.$keyword.'%');
                });
            })            
            ->editColumn('employer_id', function($payment) {
                return ($payment->employer_id != null && isset($payment->customer)) ? $payment->customer->display_name.'-'.$payment->customer->first_name : '';
            })
            ->filterColumn('employer_id',function($query,$keyword){
                $query->whereHas('customer',function ($q) use($keyword){
                    $q->where('display_name','like','%'.$keyword.'%');
                });
            })
            ->editColumn('total_amount', function($payment) {
                return getPriceFormat($payment->total_amount);
            })
            ->addColumn('action', function ($payment) {
                return view('jobspayment.action', compact('payment'))->render();
            })
            ->addIndexColumn()
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Payment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(JobsPayment $model)
    {
        return $model->newQuery()->myPayment();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */

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
            Column::make('job_id')
                ->title(__('messages.service')),
            Column::make('employer_id')
                ->title(__('messages.user')),
            Column::make('payment_type'),
            Column::make('payment_status'),
            Column::make('datetime'),
            Column::make('total_amount'),     
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
        return 'JobsPayment_' . date('YmdHis');
    }
}
