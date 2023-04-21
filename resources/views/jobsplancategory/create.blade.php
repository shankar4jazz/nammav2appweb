<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ $pageTitle ?? trans('list') }}</h5>
                            @if($auth_user->can('category list'))
                            <a href="{{ route('jobs-plans-category.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{ Form::model($categorydata,['method' => 'POST','route'=>'jobs-plans-category.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'category'] ) }}
                        {{ Form::hidden('id') }}
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('en_name',trans('messages.name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('en_name',old('en_name'),['placeholder' => trans('messages.name'),'class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            
                            <div class="form-group col-md-6">
                                {{ Form::label('ta_name',trans('tamil name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('ta_name',old('ta_name'),['placeholder' => trans('tamil name'),'class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>                          

                         
                            <div class="form-group col-md-12">
                                {{ Form::label('description',trans('Tamil Description'), ['class' => 'form-control-label']) }}
                                {{ Form::textarea('description', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('Tamil Description') ]) }}
                            </div>
                            <div class="form-group col-md-12">
                                {{ Form::label('description',trans('English Description'), ['class' => 'form-control-label']) }}
                                {{ Form::textarea('description', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('English Description') ]) }}
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="jobs_plans_category_image">{{ __('messages.image') }} </label>
                                <div class="custom-file">
                                    <input type="file" name="jobs_plans_category_image" class="custom-file-input" onchange="preview()" accept="image/*">
                                    <label class="custom-file-label upload-label">{{ __('messages.choose_file',['file' =>  __('messages.image') ]) }}</label>
                                </div>
                            </div>
                            @if(getMediaFileExit($categorydata, 'jobs_plans_category_image'))
                            <div class="col-md-2 mb-2">
                                @php
                                $extention = imageExtention(getSingleMedia($categorydata, 'jobs_plans_category_image'));
                                @endphp
                                <img id="jobs_plans_category_image_preview" src="{{getSingleMedia($categorydata,'jobs_plans_category_image')}}" alt="#" class="attachment-image mt-1" style="background-color:{{ $extention == 'svg' ? $categorydata->color : '' }}">
                                <a class="text-danger remove-file" href="{{ route('remove.file', ['id' => $categorydata->id, 'type' => 'jobs_plans_category_image']) }}" data--submit="confirm_form" data--confirmation='true' data--ajax="true" title='{{ __("messages.remove_file_title" , ["name" =>  __("messages.image") ]) }}' data-title='{{ __("messages.remove_file_title" , ["name" =>  __("messages.image") ]) }}' data-message='{{ __("messages.remove_file_msg") }}'>
                                    <i class="ri-close-circle-line"></i>
                                </a>
                            </div>
                            @endif
                            <img id="jobs_category_image_preview" src="" width="150px" />

                            <div class="form-group col-md-6">
                                {{ Form::label('status',trans('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::select('status',['1' => __('messages.active') , '0' => __('messages.inactive') ],old('status'),[ 'id' => 'role' ,'class' =>'form-control select2js','required']) }}
                            </div>
                        </div>
                  
                        {{ Form::submit( trans('messages.save'), ['class'=>'btn btn-md btn-primary float-right']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function preview() {
            category_image_preview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</x-master-layout>