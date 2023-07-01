<?php

namespace App\DataTables;

use App\Traits\DataTableTrait;

use App\Models\Jobs;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Carbon;

class JobsManageDataTable extends DataTable
{
    use DataTableTrait;
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    protected function generateChangeButtonHtml($jobId, $status)
    {

        // $html = '<a class="btn-sm btn-primary change_status"  title="Assign Handyman" href="#" data-target="#changeStatusModal" data-job-id="' . $jobId . '"><i class="fa fa-user-plus" aria-hidden="true"></i></a>';
        $html = '<button type="button" class="btn btn-primary btn-sm change_status" data-toggle="modal" data-target="#changeStatusModal" data-job-id="' . $jobId . '" data-status="' . $status . '">';
        $html .= '<i class="fa fa-edit" aria-hidden="true"></i>';
        $html .= '</button>';
        $html .= '<input type="hidden" name="job_id" class="job-id-input" value="' . $jobId . '">';

        return $html;
    }
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)
                    ->tz('Asia/Kolkata')->format('d-m-Y h:i:s A');
            })
            ->editColumn('user_id', function ($service) {
                return ($service->user != null && isset($service->user)) ? $service->user->display_name . "(" . $service->user->contact_number . ")" : '';
            })
            ->filterColumn('user_id', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('contact_number', 'like', '%' . $keyword . '%');
                });
            })
            // ->editColumn('status', function ($category) {
            //     $disabled = $category->trashed() ? 'disabled' : '';
            //     return '<div class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline">
            //         <div class="custom-switch-inner">
            //             <input type="checkbox" class="custom-control-input  change_status" data-type="jobs_status" ' . ($category->status == 1? "checked" : "") . '  ' . $disabled . ' value="' . $category->id . '" id="' . $category->id . '" data-id="' . $category->id . '">
            //             <label class="custom-control-label" for="' . $category->id . '" data-on-label="" data-off-label=""></label>
            //         </div>
            //     </div>';
            // })
            ->editColumn('payment_id', function ($booking) {
                $payment_status = optional($booking->jobsPayment)->payment_status;
                if ($payment_status == 'failed') {
                    $status = '<span class="badge badge-pay-pending">' . __('messages.failed') . '</span>';
                } else if ($payment_status == 'paid') {
                    $status = '<span class="badge badge-paid">' . __('messages.paid') . '</span>';
                } else {
                    $status = '<span class="badge bg-danger text-light">' . __('messages.pending') . '</span>';
                }
                return  $status;
            })

            ->editColumn('status', function ($booking) {
                $payment_status = optional($booking)->status;
                if ($payment_status == '2') {
                    $status = '<span class="badge badge-pay-pending">' . __('Rejected') . '</span>';
                } else if ($payment_status == '1') {
                    $status = '<span class="badge badge-paid">' . __('Active') . '</span>';
                } else if ($payment_status == '0') {
                    $status = '<span class="badge bg-warning text-dark">' . __('messages.pending') . '</span>';
                } else if ($payment_status == '3') {
                    $status = '<span class="badge bg-danger text-light">' . __('Suspended') . '</span>';
                } else if ($payment_status == '4') {
                    $status = '<span class="badge bg-danger text-light">' . __('InActive') . '</span>';
                } else {
                    $status = '';
                }
                $changeButton = $this->generateChangeButtonHtml($booking->id, $payment_status);
                return '<div class="text-center">' . $status . ' ' . $changeButton . '</div>';
            })
            // ->editColumn('is_featured', function ($category) {
            //     $disabled = $category->trashed() ? 'disabled' : '';

            //     return '<div class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline">
            //         <div class="custom-switch-inner">
            //             <input type="checkbox" class="custom-control-input  change_status" data-type="jobs_featured" data-name="is_featured" ' . ($category->is_featured == 1 ? "checked" : "") . '  ' .  $disabled . ' value="' . $category->id . '" id="f' . $category->id . '" data-id="' . $category->id . '">
            //             <label class="custom-control-label" for="f' . $category->id . '" data-on-label="' . __("messages.yes") . '" data-off-label="' . __("messages.no") . '"></label>
            //         </div>
            //     </div>';
            // })
            ->addColumn('action', function ($category) {
                return view('jobsmanage.action', compact('category'))->render();
            })

            ->addIndexColumn()
            ->rawColumns(['action', 'status', 'is_featured', 'payment_id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Jobs $model)
    {

        if (auth()->user()?->hasAnyRole(['admin'])) {

            $model = $model->withTrashed()->orderByDesc('id');
        } else {

            return $model->list()->newQuery()->where("user_id", auth()->user()?->id)->orderByDesc('id');
        }

        return $model->list()->newQuery();
    }
    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
    return   [

            Column::make('DT_RowIndex')
                ->searchable(false)
                ->title(__('messages.no'))
                ->orderable(false),
            Column::make('id')->visible(true),
            Column::make('title'),
            Column::make('job_role'),
            Column::make('user_id')
                ->title(__('messages.user')),
            // Column::make('is_featured')
            //     ->title(__('messages.featured')),
            // Column::make('status'),
            Column::make('created_at'),
            Column::make('payment_id')
                ->title(__('messages.payment_status')),
            Column::make('status')
                ->title('Jobs Status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ] ;
    }



    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'NewsCategory_' . date('YmdHis');
    }
}
