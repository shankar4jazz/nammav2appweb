<?php

namespace App\DataTables;
use App\Traits\DataTableTrait;

use App\Models\News;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class NewsDataTable extends DataTable
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
            ->editColumn('status' , function ($subcategory){
                $disabled = $subcategory->trashed() ? 'disabled': '';
                return '<div class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline">
                    <div class="custom-switch-inner">
                        <input type="checkbox" class="custom-control-input  change_status" data-type="news_status" '.($subcategory->status == '1' ? "checked" : "").'  '.$disabled.' value="'.$subcategory->id.'" id="'.$subcategory->id.'" data-id="'.$subcategory->id.'">
                        <label class="custom-control-label" for="'.$subcategory->id.'" data-on-label="" data-off-label=""></label>
                    </div>
                </div>'
                
                ;
            })

            ->editColumn('status_s', function ($booking) {
                $payment_status = optional($booking)->status;
                if ($payment_status == '2') {
                    $status = '<span class="badge badge-pay-pending">' . __('messages.pending') . '</span>';
                } else if($payment_status == '1'){
                    $status = '<span class="badge badge-paid">' . __('Active') . '</span>';
                }else if($payment_status == '0'){
                    $status = '<span class="badge bg-warning text-dark">' . __('In Active') . '</span>';
                }
                else if($payment_status == '3'){
                    $status = '<span class="badge bg-danger text-light">' . __('Rejected') . '</span>';
                }
                return  $status;
            })
            
            
            ->editColumn('news_category_id' , function ($subcategory){
               // echo $subcategory;
              return ($subcategory->news_category_id != null && isset($subcategory->category)) ? $subcategory->category->name : '-';
            })
            ->filterColumn('news_category_id',function($query,$keyword){
                $query->whereHas('category',function ($q) use($keyword){
                    $q->where('name','like','%'.$keyword.'%');
                });
            })
            ->editColumn('is_featured' , function ($subcategory){
                $disabled = $subcategory->trashed() ? 'disabled': '';

                return '<div class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline">
                    <div class="custom-switch-inner">
                        <input type="checkbox" class="custom-control-input change_status" data-type="news_featured" data-name="is_featured" '.($subcategory->is_featured ? "checked" : "").'  '.  $disabled.' value="'.$subcategory->id.'" id="f'.$subcategory->id.'" data-id="'.$subcategory->id.'">
                        <label class="custom-control-label" for="f'.$subcategory->id.'" data-on-label="'.__("messages.yes").'" data-off-label="'.__("messages.no").'"></label>
                    </div>
                </div>';
            })

            ->addColumn('action', function($subcategory){
                return view('news.action',compact('subcategory'))->render();
            })
            ->addIndexColumn()
            ->rawColumns(['action','status', 'status_s','is_featured']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(News $model)
    {
        if(auth()->user()->hasAnyRole(['admin'])){
            $model = $model->withTrashed()->orderByDesc('id');
        }
        return $model->list()->orderByDesc('id')->newQuery();
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
            Column::make('title'),
        
            Column::make('news_category_id')
                    ->title(__('messages.category')),
            Column::make('is_featured')
                ->title(__('messages.featured')),
            Column::make('status'),
            Column::make('status_s')
            ->title('News Status'),
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
        return 'News_' . date('YmdHis');
    }
}
