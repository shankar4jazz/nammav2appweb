<?php

namespace App\DataTables;

use App\Traits\DataTableTrait;

use App\Models\JobsCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class JobsCategoryDataTable extends DataTable
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
            ->editColumn('status', function ($category) {
                $disabled = $category->trashed() ? 'disabled' : '';
                return '<div class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline">
                    <div class="custom-switch-inner">
                        <input type="checkbox" class="custom-control-input  change_status" data-type="jobscategory_status" ' . ($category->status ? "checked" : "") . '  ' . $disabled . ' value="' . $category->id . '" id="' . $category->id . '" data-id="' . $category->id . '">
                        <label class="custom-control-label" for="' . $category->id . '" data-on-label="" data-off-label=""></label>
                    </div>
                </div>';
            })
            ->editColumn('is_featured', function ($category) {
                $disabled = $category->trashed() ? 'disabled' : '';

                return '<div class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline">
                    <div class="custom-switch-inner">
                        <input type="checkbox" class="custom-control-input  change_status" data-type="jobscategory_featured" data-name="is_featured" ' . ($category->is_featured ? "checked" : "") . '  ' .  $disabled . ' value="' . $category->id . '" id="f' . $category->id . '" data-id="' . $category->id . '">
                        <label class="custom-control-label" for="f' . $category->id . '" data-on-label="' . __("messages.yes") . '" data-off-label="' . __("messages.no") . '"></label>
                    </div>
                </div>';
            })
            ->addColumn('action', function ($category) {
                return view('jobscategory.action', compact('category'))->render();
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'status', 'is_featured']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(JobsCategory $model)
    {
        if (auth()->user()->hasAnyRole(['admin'])) {
            $model = $model->withTrashed();
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
        return [
            Column::make('DT_RowIndex')
                ->searchable(false)
                ->title(__('messages.no'))
                ->orderable(false),
            Column::make('id')->visible(false),
            Column::make('name'),
            Column::make('tamil_name'),
            Column::make('color'),
            Column::make('is_featured')
                ->title(__('messages.featured')),
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
        return 'NewsCategory_' . date('YmdHis');
    }
}
