<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ $pageTitle ?? trans('messages.list') }}</h5>
                            @if($auth_user->can('category list'))
                            <a href="{{ route('subcategory.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{ Form::model($subcategory,['method' => 'POST','route'=>'news.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'subcategory'] ) }}
                        {{ Form::hidden('id') }}
                        <div class="row">
                            @if (auth()->user()->hasRole(['admin']))
                            <div class="form-group col-md-8">
                                {{ Form::label('user_id', __('messages.select_name',[ 'select' => __('messages.user') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                <br />

                                @php
                                $selectOptions = optional($subcategory->user)->id
                                ? [optional($subcategory->user)->id => optional($subcategory->user)->contact_number]
                                : [auth()->user()->id => auth()->user()->first_name];
                                @endphp
                                {{ Form::select('user_id', 
                                                $selectOptions, 
                                                optional($subcategory->user)->id ?? auth()->user()->id, 
                                                [
                                                    'class' => 'select2js form-group user',
                                                    'required',
                                                    'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.user') ]),
                                                    'data-ajax--url' => route('ajax-list', ['type' => 'news_user']),
                                                ])
                                }}


                            </div>
                            <div class="form-group col-md-4 mt-4">
                                {{optional($subcategory->user)->first_name ?? auth()->user()->first_name}}
                            </div>
                            @else
                            <input type="hidden" name="user_id" value="{{$jobsdata->user_id}}">
                            @endif
                            <div class="form-group col-md-4">
                                {{ Form::label('title',trans('Enter news title').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('title',old('title'),['placeholder' => trans('news title'),'id' =>'title', 'class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-1 mt-5">
                                <input type='button' id="convert_slug" value="Convert Slug">
                            </div>
                            <div class="form-group col-md-5">
                                {{ Form::label('link',trans('messages.slug'),['class'=>'form-control-label'], false ) }}
                                {{ Form::text('link',old('link'),['placeholder' => trans('messages.slug'), 'id' =>'link', 'class' =>'form-control']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <!-- <div class="form-group col-md-5">
                                {{ Form::label('tamil_title',trans('tamil title'),['class'=>'form-control-label'], false ) }}
                                {{ Form::text('tamil_title',old('tamil_title'),['placeholder' => trans('tamil title'),  'class' =>'form-control']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div> -->
                            <!-- <div class="form-group col-md-4">
                                {{ Form::label('tamil_name',trans('messages.tamil_name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('tamil_name',old('tamil_name'),['placeholder' => trans('messages.tamil_name'),'class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div> -->

                            <div class="form-group col-md-6">
                                {{ Form::label('news_category_id', __('messages.select_name',[ 'select' => __('messages.category') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                <br />
                                {{ Form::select('news_category_id', [optional($subcategory->category)->id => optional($subcategory->category)->name], optional($subcategory->category)->id, [
                                            'class' => 'select2js form-group category',
                                            'required',
                                            'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.category') ]),
                                            'data-ajax--url' => route('ajax-list', ['type' => 'news-category']),
                                        ]) }}

                            </div>

                            <div class="form-group col-md-8">
                                <label class="form-control-label" for="news_image">{{ __('messages.image') }} </label>
                                <div class="custom-file">
                                    <input type="file" name="news_image" class="custom-file-input" accept="image/*">
                                    <label class="custom-file-label upload-label">{{ __('messages.choose_file',['file' =>  __('messages.image') ]) }}</label>
                                </div>
                                <span class="selected_file"></span>
                            </div>
                            @if(getMediaFileExit($subcategory, 'news_image'))
                            <div class="col-md-2 mb-2">
                                @php
                                $extention = imageExtention(getSingleMedia($subcategory,'news_image'));
                                @endphp
                                <img id="news_image_preview" src="{{getSingleMedia($subcategory,'news_image')}}" alt="#" class="attachment-image mt-1">
                                <a class="text-danger remove-file" href="{{ route('remove.file', ['id' => $subcategory->id, 'type' => 'news_image']) }}" data--submit="confirm_form" data--confirmation='true' data--ajax="true" title='{{ __("messages.remove_file_title" , ["name" =>  __("messages.image") ]) }}' data-title='{{ __("messages.remove_file_title" , ["name" =>  __("messages.image") ]) }}' data-message='{{ __("messages.remove_file_msg") }}'>
                                    <i class="ri-close-circle-line"></i>
                                </a>
                            </div>
                            @endif

                            <!-- <div class="form-group col-md-8">
                                {{ Form::label('url',trans('messages.url').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('youtube_url',old('youtube_url'),['placeholder' => trans('messages.url'),'class' =>'form-control']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div> -->


                            <div class="form-group col-md-8">
                                <label class="form-control-label" for="news_video">{{ __('messages.video') }} </label>
                                <div class="custom-file">
                                    <input type="file" name="news_video" class="custom-file-input" accept="video/mp4,video/x-m4v,video/*">
                                    <label class="custom-file-label upload-label">{{ __('messages.choose_file',['file' =>  __('messages.video') ]) }}</label>
                                </div>
                                <span class="selected_file_video"></span>
                            </div>

                            @if(getMediaFileExit($subcategory, 'news_video'))
                            <div class="col-md-2 mb-2">
                                @php
                                $extention = imageExtention(getSingleMedia($subcategory,'news_video'));
                                @endphp
                                <video id="news_video_preview" width="320" height="240" controls class="galary mt-3">
                                    <source src="{{getSingleMedia($subcategory,'news_video')}}" type="video/mp4">

                                    Your browser does not support the video tag.
                                </video>
                                <!-- <img id="news_video_preview" src="{{getSingleMedia($subcategory,'news_video')}}" alt="#" class="attachment-image mt-1"> -->
                                <a class="mr-1 text-danger remove-file" href="{{ route('remove.file', ['id' => $subcategory->id, 'type' => 'news_video']) }}" data--submit="confirm_form" data--confirmation='true' data--ajax="true" title='{{ __("messages.remove_file_title" , ["name" =>  __("messages.image") ]) }}' data-title='{{ __("messages.remove_file_title" , ["name" =>  __("messages.image") ]) }}' data-message='{{ __("messages.remove_file_msg") }}'>
                                    <i class="ri-close-circle-line"></i>
                                </a>
                            </div>
                            @endif



                            <!-- <div class="row col-md-12">

                                <div class="form-group col-md-4">
                                    {{ Form::label('country_id', __('messages.select_name',[ 'select' => __('messages.country') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                    <br />
                                    {{ Form::select('country_id', [optional($subcategory->country)->id => optional($subcategory->country)->name], optional($subcategory->country)->id, [
                                        'class' => 'select2js form-group country',
                                        'required',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.country') ]),
                                        'data-ajax--url' => route('ajax-list', ['type' => 'country']),
                                    ]) }}
                                </div>

                                <div class="form-group col-md-4">
                                    {{ Form::label('state_id', __('messages.select_name',[ 'select' => __('messages.state') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                    <br />
                                    {{ Form::select('state_id', [], [
                                        'class' => 'select2js form-group state_id',
                                        'required',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.state') ]),
                                    ]) }}
                                </div>

                                <div class="form-group col-md-4">
                                    {{ Form::label('city_id', __('messages.select_name',[ 'select' => __('messages.city') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                    <br />
                                    {{ Form::select('city_id', [], old('city_id'), [
                                        'class' => 'select2js form-group city_id',
                                        'required',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.city') ]),
                                    ]) }}
                                </div>
                            </div> -->
                            <div class="row col-md-12">
                                <div class="form-group col-md-4 d-none">
                                    {{ Form::label('country_id', __('messages.select_name',[ 'select' => __('messages.country') ]),['class'=>'form-control-label'],false) }}
                                    <br />
                                    {{ Form::select('country_id', [optional($subcategory->country)->id => optional($subcategory->country)->name], optional($subcategory->country)->id, [
                                        'class' => 'select2js form-group country',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.country') ]),
                                        'data-ajax--url' => route('ajax-list', ['type' => 'country']),
                                    ]) }}
                                </div>

                                <div class="form-group col-md-4">
                                    {{ Form::label('state_id', __('messages.select_name',[ 'select' => __('messages.state') ]), ['class'=>'form-control-label'],false) }}
                                    <br />
                                    {{ Form::select('state_id',  [
                                        
                                        'class' => 'select2js form-group state_id',
                                    
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.state') ]),
                                    ]) }}
                                    <input type="hidden" name="state_id" value="{{$subcategory->state_id}}" />
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
                            </div>



                            <div class="form-group col-md-12">
                                {{ Form::label('
                                    ',trans('messages.description'), ['class' => 'form-control-label']) }}
                                {{ Form::textarea('description', $decoded_description, ['class'=>"form-control textarea" , 'rows'=>3  , 'id'=>"editor", 'placeholder'=> __('messages.description') ]) }}
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('status',trans('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::select('status',['1' => __('messages.active') , '0' => __('messages.pending'), '2' => __('messages.inactive') ,'3' => __('messages.rejected') ],old('status'),[ 'id' => 'role' ,'class' =>'form-control select2js','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-12" style="display:none" id="reason">
                                {{ Form::label('reject_reason',trans('messages.reason'), ['class' => 'form-control-label']) }}
                                {{ Form::textarea('reject_reason', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.reason') ]) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <!-- <input type="checkbox" name="is_featured" value="1" class="custom-control-input" id="is_featured"> -->
                                    {{ Form::checkbox('is_featured', $subcategory->is_featured, null, ['class' => 'custom-control-input' , 'id' => 'is_featured' ]) }}
                                    <label class="custom-control-label" for="is_featured">{{ __('messages.set_as_featured')  }}
                                    </label>
                                </div>
                            </div>
                        </div>
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

                CKEDITOR.replace('editor');


                var country_id = "{{ isset($subcategory->country_id) ? $subcategory->country_id : 0 }}";
                var state_id = "{{ isset($subcategory->state_id) ? $subcategory->state_id : 0 }}";
                var district_id = "{{ isset($subcategory->district_id) ? $subcategory->district_id : 0 }}";
                var city_id = "{{ isset($subcategory->city_id) ? $subcategory->city_id : 0 }}";

                var provider_id = "{{ isset($subcategory->provider_id) ? $subcategory->provider_id : '' }}";
                var service_address_id = "{{ isset($subcategory->service_address_id) ? $subcategory->service_address_id : 0 }}";
                $('#state_id').attr('disabled', true);
                stateName(country_id, state_id);
                districtName(state_id, district_id);
                providerAddress(provider_id, service_address_id);
                $(document).on('change', '#role', function() {
                    var status = $(this).val();
                    if (status == '3') {

                        document.getElementById("reason").style.display = "block";
                    } else {
                        document.getElementById("reason").style.display = "none";

                    }

                })
                // $(document).on('change', '#country_id', function() {
                //     var country = $(this).val();
                //     $('#state_id').empty();
                //     $('#city_id').empty();
                //     stateName(country);
                // })
                // $(document).on('change', '#state_id', function() {
                //     var state = $(this).val();
                //     $('#city_id').empty();
                //     cityName(state, city_id);
                // })
                $(document).on('change', '#provider_id', function() {
                    var provider_id = $(this).val();
                    $('#service_address_id').empty();
                    providerAddress(provider_id, service_address_id);
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
                //console.log(district);
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

            function textToSlug(text) {

                return text.toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]+/g, '');

            }
            var button = document.getElementById("convert_slug");
            button.addEventListener("click", function() {
                const timestamp = Date.now();
                var textbox = document.getElementById("title");
                var slug = textToSlug(textbox.value);
                var textbox = document.getElementById("link");
                textbox.value = slug + "-" + timestamp;


            });
        })(jQuery);
    </script>
    @endsection
</x-master-layout>