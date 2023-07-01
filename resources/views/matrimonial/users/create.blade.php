<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ $pageTitle ?? trans('messages.list') }}</h5>
                            @if($auth_user->can('category list'))
                            <a href="{{ route('jobs.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        {{ Form::model($jobsdata,['method' => 'POST','route'=>'matrimonial.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'jobsdata'] ) }}
                        {{ Form::hidden('id') }}
                        <div class="row">
                            @if (auth()->user()->hasRole(['admin']))
                            <div class="form-group col-md-4">
                                {{ Form::label('user_id', __('messages.select_name',[ 'select' => __('messages.user') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                <br />
                                {{ Form::select('user_id', [optional($jobsdata->user)->id => optional($jobsdata->user)->contact_number], optional($jobsdata->user)->id, [
                                                'class' => 'select2js form-group user',
                                                'required',
                                                'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.user') ]),
                                                'data-ajax--url' => route('ajax-list', ['type' => 'user']),
                                            ])
                                        }}
                            </div>
                            @else
                            <input type="hidden" name="user_id" value="{{$jobsdata->user_id}}">
                            @endif

                            <div class="form-group col-md-4">
                                {{ Form::label('for_who',trans('messages.for_who').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::select('for_who',[''=> __('messages.for_who'),'0' => __('messages.my_self') , '1' => __('messages.my_son'), '2' => __('messages.my_daughter') ,'3' => __('messages.my_brother'), '4' => __('messages.my_sister'), '5' => __('messages.my_relative'), '6' => __('messages.my_friend') ],old('for_who'),[ 'id' => 'for_who' ,'class' =>'form-control select2js','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('name',trans('messages.name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('name',old('name'),['placeholder' => trans('messages.name'),'class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('gender',trans('messages.gender').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::select('gender',['' =>trans('Select Gender'),'0' => __('messages.gender_0') , '1' => __('messages.gender_1'), '2' => __('messages.gender_2')  ],old('gender'),[ 'id' => 'gender' ,'class' =>'form-control select2js','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('mother_tongue_id', __('messages.select_name',[ 'select' => __('messages.mother_tongue') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                <br />
                                {{ Form::select('mother_tongue_id', [optional($jobsdata->religion)->id => optional($jobsdata->category)->name], optional($jobsdata->category)->id, [
                                            'class' => 'select2js form-group religion',
                                            'required',
                                            'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.mother_tongue') ]),
                                            'data-ajax--url' => route('ajax-list', ['type' => 'mother_tongue']),
                                        ]) }}

                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('dob',__('messages.dob').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('dob',old('dob'),['placeholder' => __('messages.dob'),'class' =>'form-control datepicker','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('height',trans('messages.height').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::select('height',[''=> "Select Height","4'11''" => "4'11''", "5'0''" => "5'0''", "5'1''" => "5'1''", "5'2''"=> "5'2''","5'3''" => "5'3''" ,"5'4''" => "5'4''", "5'5''" => "5'5''" , "5'6''" => "5'6''", "5'7''" => "5'7''", "5'8''" => "5'8''","5'10''" => "5'10''", "5'11''"=> "5'11''","6'0''"=> "6'0''" , "6'1''"=> "6'1''", "6'2''"=> "6'2''", "6'3''"=> "6'3''" ],old('height'),[ 'id' => 'height' ,'class' =>'form-control select2js','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="service_attachment">{{ __('messages.image') }} <span class="text-danger">*</span> </label>
                                <div class="custom-file">
                                    <input type="file" name="service_attachment[]" class="custom-file-input" data-file-error="{{ __('messages.files_not_allowed') }}" multiple>
                                    <label class="custom-file-label upload-label">{{ __('messages.choose_file',['file' =>  __('messages.attachments') ]) }}</label>
                                </div>
                            </div>

                            <div style="border: 1px dashed #bbb;" class="p-2 col-md=12 w-100">

                                <div class="d-flex justify-content-center align-items-center p-1 flex-wrap gap-2">
                                    <h5 class="font-weight-bold">{{trans('Habbits Details') }}</h5>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        {{ Form::label('eating_habbits',trans('messages.eating_habbits').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        {{ Form::select('eating_habbits',[''=> __('Choose a eating habbits'),'Vegetarian' => __('Vegetarian') , 'Eggetarian' => __('Eggetarian'), 'Non-Vegetarian' => __('Non-Vegetarian')],old('eating_habbits'),[ 'id' => 'eating_habbits' ,'class' =>'form-control select2js','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>


                                    <div class="form-group col-md-4 mt-5">
                                        {{ Form::label('smoke_habbits',trans('messages.smoke_habbits').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="smoke_habbits" id="inlineRadio1" value="0" required>
                                            <label class="form-check-label" for="inlineRadio1">No</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="smoke_habbits" id="inlineRadio2" value="1" required>
                                            <label class="form-check-label" for="inlineRadio2">Yes</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 mt-5">
                                        {{ Form::label('drink_habbits',trans('messages.drink_habbits').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="drink_habbits" id="inlineRadio1" value="0" required>
                                            <label class="form-check-label" for="inlineRadio1">No</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="drink_habbits" id="inlineRadio2" value="1" required>
                                            <label class="form-check-label" for="inlineRadio2">Yes</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div style="border: 1px dashed #bbb;" class="p-2 col-md=12 w-100">

                                <div class="d-flex justify-content-center align-items-center p-1 flex-wrap gap-2">
                                    <h5 class="font-weight-bold">{{trans('Religion And Caste Details') }}</h5>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        {{ Form::label('religion_id', __('messages.select_name',[ 'select' => __('messages.religion') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        <br />
                                        {{ Form::select('religion_id', [optional($jobsdata->religion)->id => optional($jobsdata->category)->name], optional($jobsdata->category)->id, [
                                            'class' => 'select2js form-group religion',
                                            'required',
                                            'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.religion') ]),
                                            'data-ajax--url' => route('ajax-list', ['type' => 'jobs-category']),
                                        ]) }}

                                    </div>
                                    <div class="form-group col-md-4">
                                        
                                        {{ Form::label('caste_id', __('messages.select_name',[ 'select' => __('messages.caste') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        <br />
                                        {{ Form::select('caste_id', [optional($jobsdata->caste)->id => optional($jobsdata->caste)->name], optional($jobsdata->caste)->id, [
                                            'class' => 'select2js form-group caste',
                                            'required',
                                            'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.caste') ]),
                                            'data-ajax--url' => route('ajax-list', ['type' => 'jobs-category']),
                                        ]) }}

                                    </div>
                                    <div class="form-group col-md-4">
                                        {{ Form::label('subcaste_id', __('messages.select_name',[ 'select' => __('messages.subcaste') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        <br />
                                        {{ Form::select('subcaste_id', [optional($jobsdata->religion)->id => optional($jobsdata->category)->name], optional($jobsdata->category)->id, [
                                            'class' => 'select2js form-group subcaste',
                                            'required',
                                            'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.subcaste') ]),
                                            'data-ajax--url' => route('ajax-list', ['type' => 'jobs-category']),
                                        ]) }}

                                    </div>

                                </div>
                                <div class="d-flex justify-content-center align-items-center p-1 flex-wrap gap-2">
                                    <div class="form-group col-md-4">
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <!-- <input type="checkbox" name="is_featured" value="1" class="custom-control-input" id="is_featured"> -->
                                            {{ Form::checkbox('is_anycaste', $jobsdata->is_featured, null, ['class' => 'custom-control-input' , 'id' => 'is_anycaste' ]) }}
                                            <label class="custom-control-label" for="is_anycaste">{{ __('messages.is_anycaste')  }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="border: 1px dashed #bbb;" class="mt-1  p-2 col-md=12 w-100">

                                <div class="d-flex justify-content-center align-items-center p-1 flex-wrap">
                                    <h5 class="font-weight-bold">{{trans('Living Place Dettails') }}</h5>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4 d-none">
                                        {{ Form::label('country_id', __('messages.select_name',[ 'select' => __('messages.country') ]),['class'=>'form-control-label'],false) }}
                                        <br />
                                        {{ Form::select('country_id', [optional($jobsdata->country)->id => optional($jobsdata->country)->name], optional($jobsdata->country)->id, [
                                        'class' => 'select2js form-group country',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.country') ]),
                                        'data-ajax--url' => route('ajax-list', ['type' => 'country']),
                                    ]) }}
                                    </div>

                                    <div class="form-group col-md-4">
                                        {{ Form::label('state_id', __('messages.select_name',[ 'select' => __('messages.state') ]), ['class'=>'form-control-label'],false) }}
                                        <br />
                                        {{ Form::select('state_id', [                                        
                                        'class' => 'select2js form-group state_id',                                    
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.state') ]),
                                    ]) }}
                                        <input type="hidden" name="state_id" value="{{$jobsdata->state_id}}" />
                                    </div>

                                    <div class="form-group col-md-4">
                                        {{ Form::label('district_id', __('messages.select_name',[ 'select' => __('messages.district') ]),['class'=>'form-control-label'],false) }}
                                        <br />
                                        {{ Form::select('district_id', [], old('district_id'), [
                                        'class' => 'select2js form-group district_id',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.district') ]),
                                    ]) }}
                                    </div>

                                    <div class="form-group col-md-4">
                                        {{ Form::label('city_id', __('messages.select_name',[ 'select' => __('messages.city') ]),['class'=>'form-control-label'],false) }}
                                        <br />
                                        {{ Form::select('city_id', [], old('city_id'), [
                                        'class' => 'select2js form-group city_id',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.city') ]),
                                    ]) }}
                                    </div>
                                    <div class="form-group col-md-4">
                                        {{ Form::label('pincode',trans('messages.pincode').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::text('pincode',old('pincode'),['placeholder' => trans('messages.pincode'),'class' =>'form-control','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                    <div class="form-group col-md-8">
                                        {{ Form::label('address',trans('messages.address'), ['class' => 'form-control-label']) }}
                                        {{ Form::textarea('address', null, ['class'=>"form-control textarea" , 'rows'=>1  , 'placeholder'=> __('messages.address') ]) }}
                                    </div>
                                </div>
                            </div>
                            <div style="border: 1px dashed #bbb;" class="mt-1  p-2 col-md=12 w-100">

                                <div class="d-flex justify-content-center align-items-center p-1 flex-wrap">
                                    <h5 class="font-weight-bold">{{trans('Education and working details') }}</h5>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        {{ Form::label('education',trans('messages.education').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        {{ Form::select('education',[''=> __('Select educational qualification'),
                                            "Master's Degree" => __("Master's Degree") ,
                                            "Bachelor's Degree" => __("Bachelor's Degree"),
                                            "Polytechnic" => __('Polytechnic') ,
                                            'ITI' => __('ITI'), 
                                            'Diploma' => __('Diploma'),
                                            'Trade School/Vocational' => __('Trade School/Vocational'),
                                            '12th Standard' => __('12th Standard'),
                                            '10th Standard' => __('10th Standard'),
                                            'Below 8th Standard' => __('Below 8th Standard')   ],old('education'),[ 'id' => 'education' ,'class' =>'form-control select2js','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                    <div class="form-group col-md-4">
                                        {{ Form::label('your_work',trans('messages.your_work').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        {{ Form::select('your_work',[
                                            ''=> __('Select Work Details'),
                                            'Government Job' => __('Government Job') ,
                                            'Private Job' => __('Private Job'), 
                                            'Self Employed' => __('Self Employed') ,
                                            'Own Business' => __('Own Business'),
                                            'Work in shop' => __('Work in shop'), 
                                            'Construction Worker' => __('Construction Worker'),
                                            'Agriculture' => __('Agriculture'),
                                            'Works in Factory' => __('Works in factory'),
                                            'Not Working' => __('Not Working'), ],old('your_work'),[ 'id' => 'your_work' ,'class' =>'form-control select2js','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                    <div class="form-group col-md-4">
                                        {{ Form::label('salary',trans('messages.salary').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::number('salary',old('salary'),['placeholder' => trans('messages.salary'),'class' =>'form-control','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>


                                </div>
                            </div>

                            <div style="border: 1px dashed #bbb;" class="mt-1  p-2 col-md=12 w-100">

                                <div class="d-flex justify-content-center align-items-center p-1 flex-wrap">
                                    <h5 class="font-weight-bold">{{trans('Horoscope details') }}</h5>
                                </div>

                                <div class="row">
                                    <!-- <div class="form-group col-md-4">
                                        {{ Form::label('star_id',trans('messages.star_id').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        {{ Form::select('star_id',[''=> __('messages.star_id'),'0' => __('messages.my_self') , '1' => __('messages.my_son'), '2' => __('messages.my_daughter') ,'3' => __('messages.my_brother'), '4' => __('messages.my_sister'), '5' => __('messages.my_relative'), '6' => __('messages.my_friend') ],old('star_id'),[ 'id' => 'star' ,'class' =>'form-control select2js','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div> -->
                                    <div class="form-group col-md-4">
                                        {{ Form::label('star_id', __('messages.select_name',[ 'select' => __('messages.star_id') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        <br />
                                        {{ Form::select('star_id', [optional($jobsdata->religion)->id => optional($jobsdata->category)->name], optional($jobsdata->category)->id, [
                                            'class' => 'select2js form-group religion',
                                            'required',
                                            'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.star_id') ]),
                                            'data-ajax--url' => route('ajax-list', ['type' => 'stars']),
                                        ]) }}

                                    </div>
                                    <div class="form-group col-md-4">
                                        {{ Form::label('gothram',trans('messages.gothram').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::text('gothram',old('gothram'),['placeholder' => trans('messages.gothram'),'class' =>'form-control','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                    <div class="form-group col-md-4 mt-5">
                                        {{ Form::label('eating_habbits',trans('messages.is_dhosam').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_dhosam" id="is_dhosam1" value="0" required>
                                            <label class="form-check-label" for="is_dhosam1">No</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_dhosam" id="is_dhosam2" value="1" required>
                                            <label class="form-check-label" for="is_dhosam2">Yes</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12" style="display:none" id="about_dhosam">
                                        {{ Form::label('about_dhosam',trans('messages.about_dhosam'), ['class' => 'form-control-label']) }}
                                        {{ Form::textarea('about_dhosam', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.about_dhosam') ]) }}
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="form-control-label" for="jobs_image">{{ __('messages.horoscope_urls') }} </label>
                                        <div class="custom-file">
                                            <input type="file" name="jobs_image" class="custom-file-input" accept="image/*">
                                            <label class="custom-file-label upload-label">{{ __('messages.choose_file',['file' =>  __('messages.image') ]) }}</label>
                                        </div>
                                    </div>
                                    @if(getMediaFileExit($jobsdata, 'jobs_image'))
                                    <div class="col-md-2 mb-2">
                                        @php
                                        $extention = imageExtention(getSingleMedia($jobsdata,'jobs_image'));
                                        @endphp
                                        <img id="jobs_image_preview" src="{{getSingleMedia($jobsdata,'jobs_image')}}" alt="#" class="attachment-image mt-1">
                                        <a class="text-danger remove-file" href="{{ route('remove.file', ['id' => $jobsdata->id, 'type' => 'jobs_image']) }}" data--submit="confirm_form" data--confirmation='true' data--ajax="true" title='{{ __("messages.remove_file_title" , ["name" =>  __("messages.image") ]) }}' data-title='{{ __("messages.remove_file_title" , ["name" =>  __("messages.image") ]) }}' data-message='{{ __("messages.remove_file_msg") }}'>
                                            <i class="ri-close-circle-line"></i>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div style="border: 1px dashed #bbb;" class="mt-1  mb-2 p-2 col-md=12 w-100">

                                <div class="d-flex justify-content-center align-items-center p-1 flex-wrap">
                                    <h5 class="font-weight-bold">{{trans('Family Details') }}</h5>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        {{ Form::label('brothers',trans('messages.brothers').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        {{ Form::select('brothers',[''=> "-----Select-----",'0' => __('No Brothers') , '1' => __('1'), '2' => __('2') ,'3' => __('3'), '4' => __('4'), '5' => __('More Than 5')],old('brothers'),[ 'id' => 'brothers' ,'class' =>'form-control select2js','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                    <div class="form-group col-md-4">
                                        {{ Form::label('sisters',trans('messages.sisters').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        {{ Form::select('sisters',[''=> "-----Select-----",'0' => __('No sisters') , '1' => __('1'), '2' => __('2') ,'3' => __('3'), '4' => __('4'), '5' => __('More Than 5')],old('sisters'),[ 'id' => 'sisters' ,'class' =>'form-control select2js','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                {{ Form::label('about',trans('messages.about'), ['class' => 'form-control-label']) }}
                                {{ Form::textarea('about', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.about') ]) }}
                            </div>

                            @if(getMediaFileExit($jobsdata, 'jobs_image'))
                            <div class="col-md-2 mb-2">
                                @php
                                $extention = imageExtention(getSingleMedia($jobsdata,'jobs_image'));
                                @endphp
                                <img id="jobs_image_preview" src="{{getSingleMedia($jobsdata,'jobs_image')}}" alt="#" class="attachment-image mt-1">
                                <a class="text-danger remove-file" href="{{ route('remove.file', ['id' => $jobsdata->id, 'type' => 'jobs_image']) }}" data--submit="confirm_form" data--confirmation='true' data--ajax="true" title='{{ __("messages.remove_file_title" , ["name" =>  __("messages.image") ]) }}' data-title='{{ __("messages.remove_file_title" , ["name" =>  __("messages.image") ]) }}' data-message='{{ __("messages.remove_file_msg") }}'>
                                    <i class="ri-close-circle-line"></i>
                                </a>
                            </div>
                            @endif

                            @if (auth()->user()->hasRole(['admin']))

                            <div class="form-group col-md-4">
                                {{ Form::label('status',trans('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::select('status',['1' => __('messages.active') , '0' => __('Pending'), '2' => __('messages.rejected') ,'3' => __('Suspended'), '4' => __('InActive')],old('status'),[ 'id' => 'role' ,'class' =>'form-control select2js','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-12" style="display:none" id="reason">
                                {{ Form::label('reject_reason',trans('messages.reason'), ['class' => 'form-control-label']) }}
                                {{ Form::textarea('reject_reason', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.reason') ]) }}
                            </div>

                            @else
                            <input type="hidden" name="status" value="0">
                            @endif
                        </div>
                        @if (auth()->user()->hasRole(['admin']))
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <!-- <input type="checkbox" name="is_featured" value="1" class="custom-control-input" id="is_featured"> -->
                                    {{ Form::checkbox('is_featured', $jobsdata->is_featured, null, ['class' => 'custom-control-input' , 'id' => 'is_featured' ]) }}
                                    <label class="custom-control-label" for="is_featured">{{ __('messages.set_as_featured')  }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        @endif
                        {{ Form::submit( trans('messages.save'), ['class'=>'btn btn-md btn-primary float-right']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('bottom_script')
    <script type="text/javascript">
        (function($) {
            "use strict";
            $(document).ready(function() {




                var country_id = "{{ isset($jobsdata->country_id) ? $jobsdata->country_id : 0 }}";
                var user_id = "{{ isset($jobsdata->user_id) ? $jobsdata->user_id : 0 }}";
                var state_id = "{{ isset($jobsdata->state_id) ? $jobsdata->state_id : 0 }}";
                var district_id = "{{ isset($jobsdata->district_id) ? $jobsdata->district_id : 0 }}";
                var city_id = "{{ isset($jobsdata->city_id) ? $jobsdata->city_id : 0 }}";

                var provider_id = "{{ isset($jobsdata->provider_id) ? $jobsdata->provider_id : '' }}";
                var service_address_id = "{{ isset($jobsdata->service_address_id) ? $jobsdata->service_address_id : 0 }}";
                userName(user_id);

                $('#state_id').attr('disabled', true);
                stateName(country_id, state_id);
                //districtName(state_id, district_id);
                providerAddress(provider_id, service_address_id);
                $(document).on('change', '#role', function() {
                    var status = $(this).val();
                    if (status == '3' || status == '2') {

                        document.getElementById("reason").style.display = "block";
                    } else {
                        document.getElementById("reason").style.display = "none";

                    }

                })
                $(document).on('change', 'input[name="is_dhosam"]', function() {
                    var status = $(this).val();

                    if (status == '1') {

                        document.getElementById("about_dhosam").style.display = "block";
                    } else {
                        document.getElementById("about_dhosam").style.display = "none";

                    }

                })
                $(document).on('change', '#country_id', function() {
                    var country = $(this).val();
                    $('#state_id').empty();
                    $('#district_id').empty();
                    $('#city_id').empty();
                    stateName(country);
                })
                $(document).on('change', '#state_id', function() {
                    var state = $(this).val();
                    $('#district_id').empty();
                    $('#city_id').empty();
                    districtName(state, district_id);
                })
                $(document).on('change', '#district_id', function() {
                    var district = $(this).val();
                    $('#city_id').empty();
                    cityName(district, city_id);
                })
                $(document).on('change', '#provider_id', function() {
                    var provider_id = $(this).val();
                    $('#service_address_id').empty();
                    providerAddress(provider_id, service_address_id);
                })

            })

            function stateName(country, state = "") {
                var state_route = "{{ route('ajax-list', [ 'type' => 'state','country_id' =>'']) }}" + country;
                state_route = state_route.replace('amp;', '');

                $.ajax({
                    url: state_route,
                    success: function(result) {
                        $('#state_id').select2({
                            width: '100%',
                            placeholder: "{{ trans('messages.select_name',['select' => trans('messages.state')]) }}",
                            data: result.results

                        });
                        if (state != null) {
                            $("#state_id").val(state).trigger('change');
                        }
                    }
                });
            }

            function districtName(state_id, district = "") {
                // console.log(district);
                var state_route = "{{ route('ajax-list', [ 'type' => 'district','state_id' =>'']) }}" + state_id;
                state_route = state_route.replace('amp;', '');

                $.ajax({
                    url: state_route,
                    success: function(result) {
                        $('#district_id').select2({
                            width: '100%',
                            placeholder: "{{ trans('messages.select_name',['select' => trans('messages.district')]) }}",
                            data: result.results
                        });
                        if (district != null) {
                            $("#district_id").val(district).trigger('change');
                        }
                    }
                });
            }

            function cityName(district, city = "") {
                var city_route = "{{ route('ajax-list', [ 'type' => 'city' ,'district_id' =>'']) }}" + district;
                city_route = city_route.replace('amp;', '');

                $.ajax({
                    url: city_route,
                    success: function(result) {
                        $('#city_id').select2({
                            width: '100%',
                            placeholder: "{{ trans('messages.select_name',['select' => trans('messages.city')]) }}",
                            data: result.results
                        });
                        if (city != null || city != 0) {
                            $("#city_id").val(city).trigger('change');
                        }
                    }
                });
            }

            function userName(user, city = "") {
                var city_route = "{{ route('ajax-list', [ 'type' => 'get-user' ,'user_id' =>'']) }}" + user;
                city_route = city_route.replace('amp;', '');

                $.ajax({
                    url: city_route,
                    success: function(result) {
                        $('#user_id').select2({
                            width: '100%',
                            placeholder: "{{ trans('messages.select_name',['select' => trans('messages.city')]) }}",
                            data: result.results
                        });
                        // if (city != null || city != 0) {
                        //     $("#user_id").val(city).trigger('change');
                        // }
                    }
                });
            }

            function providerAddress(provider_id, service_address_id = "") {
                var provider_address_route = "{{ route('ajax-list', [ 'type' => 'provider_address','provider_id' =>'']) }}" + provider_id;
                provider_address_route = provider_address_route.replace('amp;', '');

                $.ajax({
                    url: provider_address_route,
                    success: function(result) {
                        $('#service_address_id').select2({
                            width: '100%',
                            placeholder: "{{ trans('messages.select_name',['select' => trans('messages.provider_address')]) }}",
                            data: result.results
                        });
                        if (service_address_id != "") {
                            $('#service_address_id').val(service_address_id).trigger('change');
                        }
                    }
                });
            }


        })(jQuery);
    </script>
    @endsection
</x-master-layout>