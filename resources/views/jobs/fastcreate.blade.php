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
                    <div class="card-header text-center">
                        <div class="row">&nbsp;&nbsp;
                            <h5 class="font-weight-bold" style="font-size:20px"> Job post user : &nbsp;</h5>
                            <h5 class="font-weight-bold" style="font-size:20px;color:green" id="customer_name"> </h5>
                            <!-- <div class="form-group col-md-6 font-weight-bold">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_shop" id="inlineRadio1" value="1" required>
                                    <label class="form-check-label" for="inlineRadio1">Online Booking (by customer)</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_shop" id="inlineRadio2" value="2" checked required>
                                    <label class="form-check-label" for="inlineRadio2">Shop Booking (by Shop)</label>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="card-body">
                        {{ Form::model($jobsdata,['method' => 'POST','route'=>'jobs.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'jobsdata'] ) }}
                        {{ Form::hidden('id') }}
                        <div class="row">
                            <input type="hidden" id="customer_id" name="user_id" value="{{$jobsdata->customer_id}}">
                            <input type="hidden" id="city_name" name="city_name" value="{{$jobsdata->city_name}}">
                            <div class="form-group col-md-6">
                                {{ Form::label('contact_number_data',__('messages.customer').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('contact_number_data',  null, ['class'=>"form-control" , 'id'=>'contact_number_name', 'readonly', 'rows'=>3  , 'placeholder'=> __('messages.customer') ]) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-6">
                                {{ Form::label('contact_number',__('Contact Number').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('contact_number',  null, ['class'=>"form-control" , 'id'=>'contact_number'  , 'placeholder'=> __("Contact Number") ]) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class=" col-md-12" style="margin-bottom: 25px;border: 1px solid #ccc; padding: 25px; background-color:honeydew;">
                                <h3 class="text-center" style="margin-top: 0; margin-bottom: 25px;">Company Details</h3>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        {{ Form::label('company_name',trans('messages.company_name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::text('company_name',old('company_name'),['placeholder' => trans('messages.company_name'),'class' =>'form-control','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('tamil_company_name',trans('தமிழில் கம்பெனி பெயர்').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::text('tamil_company_name',old('tamil_company_name'),['placeholder' => trans('கம்பெனி பெயர்'),'class' =>'form-control','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>


                                    <div class="form-group col-md-4 d-none">
                                        {{ Form::label('country_id', __('messages.select_name',[ 'select' => __('messages.country') ]),['class'=>'form-control-label'],false) }}
                                        <br />
                                        {{ Form::select('country_id', [optional($jobsdata->country)->id => optional($jobsdata->country)->name], optional($jobsdata->country)->id, [
                                        'class' => 'select2js form-group country',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.country') ]),
                                        'data-ajax--url' => route('ajax-list', ['type' => 'country']),
                                    ]) }}
                                    </div>

                                    <div class="form-group col-md-6">
                                        {{ Form::label('state_id', __('messages.select_name',[ 'select' => __('messages.state') ]), ['class'=>'form-control-label'],false) }}
                                        <br />
                                        {{ Form::select('state_id', [
                                        
                                        'class' => 'select2js form-group state_id',
                                    
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.state') ]),
                                    ]) }}
                                    
                                    </div>

                                    <div class="form-group col-md-6">
                                        {{ Form::label('district_id', __('messages.select_name',[ 'select' => __('messages.district') ]),['class'=>'form-control-label'],false) }}
                                        <br />
                                        {{ Form::select('district_id', [], old('district_id'), [
                                        'class' => 'select2js form-group district_id',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.district') ]),
                                    ]) }}
                                    </div>

                                    <div class="form-group col-md-6">
                                        {{ Form::label('city_id', __('messages.select_name',[ 'select' => __('messages.city') ]),['class'=>'form-control-label'],false) }}
                                        <br />
                                        {{ Form::select('city_id', [], old('city_id'), [
                                        'class' => 'select2js form-group city_id',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.city') ]),
                                    ]) }}
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('pincode',trans('messages.pincode').' <span class="text-danger"></span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::text('pincode',old('pincode'),['placeholder' => trans('messages.pincode'),'class' =>'form-control']) }}

                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('address',trans('messages.address'), ['class' => 'form-control-label']) }}
                                        {{ Form::textarea('address', null, ['class'=>"form-control textarea" , 'rows'=>2  , 'placeholder'=> __('messages.address') ]) }}
                                    </div>
                                </div>
                            </div>

                            <div class=" col-md-12" style="margin-bottom: 25px;border: 1px solid #ccc; padding: 25px; background-color:#ccc;">
                                <h3 class="text-center" style="margin-top: 0; margin-bottom: 10px;color:blue">Job Details</h3>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        {{ Form::label('job_role',trans('messages.job_role').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::text('job_role',old('job_role'),['placeholder' => trans('messages.job_role'),'class' =>'form-control','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('tamil_job_role',trans('தமிழில் வேலைப்பெயர்(Job Role)').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::text('tamil_job_role',old('tamil_job_role'),['placeholder' => trans('வேலைப்பெயர்'),'class' =>'form-control','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>

                                    <div class="form-group col-md-6">
                                        {{ Form::label('jobcategory_id', __('messages.select_name',[ 'select' => __('messages.jobs_category') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        <br />
                                        {{ Form::select('jobcategory_id', [optional($jobsdata->category)->id => optional($jobsdata->category)->name], optional($jobsdata->category)->id, [
                                            'class' => 'select2js form-group category',
                                            'required',
                                            'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.jobs_category') ]),
                                            'data-ajax--url' => route('ajax-list', ['type' => 'jobs-category']),
                                        ]) }}

                                    </div>


                                    <div class="form-group col-md-6">
                                        {{ Form::label('vacancy',trans('messages.vacancy').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::number('vacancy',old('vacancy'),['placeholder' => trans('messages.vacancy'),'class' =>'form-control','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-12" style="margin-bottom: 25px;border: 1px solid #ccc; padding: 25px; background-color:honeydew;">
                                <h3 class="text-center" style="margin-top: 0; margin-bottom: 10px;color:crimson">Employement Details</h3>
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        {{ Form::label('experience',trans('messages.experience').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        {{ Form::select('experience',['0' => __('messages.exp_0') , '1' => __('messages.exp_1'), '2' => __('messages.exp_2') ,'3' => __('messages.exp_3'), '4' => __('messages.exp_4'), '5' => __('messages.exp_5') ],old('status'),[ 'id' => 'exp' ,'class' =>'form-control select2js','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>

                                    <div class="form-group col-md-6">
                                        {{ Form::label('education',trans('messages.education').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        {{ Form::select('education',['1' => __('messages.edu_1') , '0' => __('messages.edu_0'), '2' => __('messages.edu_2') ,'3' => __('messages.edu_3') ],old('education'),[ 'id' => 'edu' ,'class' =>'form-control select2js','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>




                                    <div class="form-group col-md-6">
                                        {{ Form::label('gender',trans('messages.gender').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        {{ Form::select('gender',['0' => __('messages.gender_0') , '1' => __('messages.gender_1'), '2' => __('messages.gender_2')  ],old('gender'),[ 'id' => 'gender' ,'class' =>'form-control select2js','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('marital_status',trans('messages.marital').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        {{ Form::select('marital_status',['2' => __('Both') ,'1' => __('messages.marital_1') , '0' => __('messages.marital_0') ],old('marital_status'),[ 'id' => 'marital' ,'class' =>'form-control select2js','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6" style="margin-bottom: 25px;border: 1px solid #ccc; padding: 10px; background-color:lightyellow;">
                                <h3 class="text-center" style="margin-top: 0; margin-bottom: 10px;color:darkslategrey">Salary Details</h3>
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        {{ Form::label('min_salary',trans('messages.min_salary').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::number('min_salary',old('min_salary'),['placeholder' => trans('messages.min_salary'),'class' =>'form-control','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('max_salary',trans('messages.min_salary').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::number('max_salary',old('max_salary'),['placeholder' => trans('messages.max_salary'),'class' =>'form-control','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6" style="margin-bottom: 25px;border: 1px solid #ccc; padding: 10px; background-color:lightyellow;">
                                <h3 class="text-center" style="margin-top: 0; margin-bottom: 10px;color:darkslategrey">Date Details</h3>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        {{ Form::label('start_date',__('messages.start_date').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::text('start_date',old('start_date'),['placeholder' => __('messages.start_date'),'class' =>'form-control min-datetimepicker','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('end_date',__('messages.end_date').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::text('end_date',old('end_date'),['placeholder' => __('messages.end_date'),'class' =>'form-control end-datetimepicker','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-bottom: 15px;border: 1px solid #ccc; padding: 25px;">
                                <h3 class="text-center" style="margin-top: 0; margin-bottom: 10px;color:darkslategrey">Job Description</h3>
                                <div class="row offset-md-2">
                                    <div class="form-group  col-md-10">
                                        {{ Form::label('description',trans('messages.description'), ['class' => 'form-control-label']) }}
                                        {{ Form::textarea('description', $decoded_description, ['class'=>"form-control textarea" , 'rows'=>3  , 'id'=>"editor", 'placeholder'=> __('messages.description') ]) }}
                                    </div>
                                </div>
                            </div>


                            <div class=" col-md-12" style="margin-bottom: 15px;border: 1px solid #ccc; padding: 25px; background-color:honeydew;">
                                <h3 class="text-center" style="margin-top: 0; margin-bottom: 10px;color:midnightblue">Application received from following city</h3>
                                <div class="row">


                                    <div class="form-group col-md-6">
                                        {{ Form::label('name', __('messages.select_name',[ 'select' => __('districts for jobs') ]),['class'=>'form-control-label'],false) }}
                                        <br />
                                        {{ Form::select('districts[]', [], old('districts'), [
                                        'class' => 'select2js form-group tax_id',
                                        'id' =>'tax_id',
                                        'multiple' => 'multiple',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('districts for jobs') ]),
                                    ]) }}

                                    </div>

                                </div>
                            </div>

                            <div class=" col-md-12" style="margin-bottom: 15px;border: 1px solid #ccc; padding: 25px; background-color:#ccc;">
                                <h3 class="text-center" style="margin-top: 0; margin-bottom: 10px;color:midnightblue">Banner image </h3>
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label class="form-control-label" for="jobs_image">{{ __('messages.image') }} </label>
                                        <div class="custom-file">
                                            <input type="file" name="jobs_image" class="custom-file-input" accept="image/*">
                                            <label class="custom-file-label upload-label">{{ __('messages.choose_file',['file' =>  __('messages.image') ]) }}</label>
                                        </div>
                                        <span class="selected_file"></span>
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
                            @if (auth()->user()->hasRole(['admin']))
                            <div class=" col-md-12" style="margin-bottom: 15px;border: 1px solid #ccc; padding: 25px; background-color:lightcyan;">
                                <h3 class="text-center" style="margin-top: 0; margin-bottom: 10px;color:crimson">Job Title </h3>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        {{ Form::label('title',trans('messages.title').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::text('title',old('title'),['placeholder' => trans('messages.title'),'class' =>'form-control','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>


                                    <div class="form-group col-md-12">
                                        {{ Form::label('status',trans('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        {{ Form::select('status',['1' => __('messages.active') , '0' => __('Pending'), '2' => __('messages.rejected') ,'3' => __('Suspended'), '4' => __('InActive')],old('status'),[ 'id' => 'role' ,'class' =>'form-control select2js','required']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                    <div class="form-group col-md-6" style="display:none" id="reason">
                                        {{ Form::label('reject_reason',trans('messages.reason'), ['class' => 'form-control-label']) }}
                                        {{ Form::textarea('reject_reason', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.reason') ]) }}
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('Apply Mode',trans('Apply Mode').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                        {{ Form::select('is_mode',['1' => __('All Mode') , '2' => __('Call Mode'), '3' => __('TamilanJobs App'), '4' => __('WhatsApp')], old('is_mode'), [ 'id' => 'is_mode' ,'class' =>'form-control select2js']) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                </div>
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
                            </div>
                            @else
                            <input type="hidden" name="status" value="0">
                            @endif
                        </div>
                        {{ Form::submit( trans('messages.save'), ['class'=>'btn btn-md btn-primary float-right']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
    $data = $jobsdata->getJobDistricts->pluck('district_id')->implode(',');
    @endphp
    @section('bottom_script')
    <script type="text/javascript">
        (function($) {
            "use strict";
            $(document).ready(function() {
                CKEDITOR.replace('editor');
                var districts = "{{ isset($data) ? $data : [] }}";
                var category_id = "{{ isset($jobsdata->contact_number_data) ? $jobsdata->contact_number_data : '' }}";

                getCustomer(category_id);

                let selectedCityName = $("#city_id").find('option:selected').text();
                $('#city_name').val(selectedCityName);

                var country_id = "{{ isset($jobsdata->country_id) ? $jobsdata->country_id : 101 }}";
                var user_id = "{{ isset($jobsdata->user_id) ? $jobsdata->user_id : 0 }}";
                var state_id = "{{ isset($jobsdata->state_id) ? $jobsdata->state_id : 35 }}";
                var district_id = "{{ isset($jobsdata->district_id) ? $jobsdata->district_id : 0 }}";
                var city_id = "{{ isset($jobsdata->city_id) ? $jobsdata->city_id : 0 }}";

                var provider_id = "{{ isset($jobsdata->provider_id) ? $jobsdata->provider_id : '' }}";
                var service_address_id = "{{ isset($jobsdata->service_address_id) ? $jobsdata->service_address_id : 0 }}";
                // userName(user_id);
                getTax(provider_id, districts);
                //$('#state_id').attr('disabled', true);
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

                $(document).on('change', '#city_id', function() {


                    let selectedCityName = $(this).find('option:selected').text();
                    $('#city_name').val(selectedCityName);


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

            function getTax(provider_id, provider_tax_id = "") {

                var provider_tax_route = "{{ route('ajax-list', [ 'type' => 'district','provider_id' =>'']) }}" + provider_id;
                provider_tax_route = provider_tax_route.replace('amp;', '');

                $.ajax({
                    url: provider_tax_route,
                    success: function(result) {
                        $('#tax_id').select2({
                            width: '100%',
                            placeholder: "{{ trans('messages.select_name',['select' => trans('messages.tax')]) }}",
                            data: result.results
                        });
                        if (provider_tax_id != "") {
                            // alert("value");
                            $('#tax_id').val(provider_tax_id.split(',')).trigger('change');
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

            function getCustomer(mobile_no) {


                var get_subcategory_list = "{{ route('ajax-list', [ 'type' => 'setuser','user_type'=> 'jobs', 'mobile_no' =>'']) }}" + mobile_no;
                get_subcategory_list = get_subcategory_list.replace(/&amp;/g, "&");

                $.ajax({
                    url: get_subcategory_list,
                    success: function(result) {
                        var datas = result.results;

                        console.log(datas.length);
                        if (datas.length == 0) {
                            window.location.href = "{{ route('jobs.quick') }}";

                        } else {
                            if (mobile_no != "") {

                                // console.log(datas.text);
                                $('#customer_id').val(datas[0].id);
                                // $('#contact_number').val(datas[0].text);
                                $('#customer_name').html(' ' + datas[0].display_name);
                            }
                        }
                        // if (subcategory_id != "") {
                        //     $('#subcategory_id').val(subcategory_id).trigger('change');
                        // }
                    }
                });
            }

            // function textToSlug(text) {
            //     return text.toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]+/g, '');
            // }

            // var button = document.getElementById("convert_slug");

            // button.addEventListener("click", function() {
            //     const timestamp = Date.now();
            //     var textbox = document.getElementById("title");
            //     var slug = textToSlug(textbox.value);
            //     var textbox = document.getElementById("slug");
            //     textbox.value = slug + "-" + timestamp;
            // });
        })(jQuery);
    </script>
    @endsection
</x-master-layout>