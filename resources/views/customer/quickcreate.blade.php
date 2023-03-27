<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ $pageTitle ?? __('messages.list') }}</h5>
                           
                            @if($customerdata->type == 'booking' )

                            <a href="{{ route('quickbooking') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i>{{ __('messages.back') }}</a>

                            @endif
                            @if($customerdata->type == 'jobs' )

                            <a href="{{ route('jobs.quick') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i>{{ __('messages.back') }}</a>

                            @endif
                            @if($auth_user->can('user list'))
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{ Form::model($customerdata,['method' => 'POST','route'=>'user.quick', 'data-toggle'=>"validator" ,'id'=>'user'] ) }}
                        {{ Form::hidden('id') }}
						 @if($customerdata->type == 'booking' )
                        {{ Form::hidden('user_type','user') }}
						 @endif
						 @if($customerdata->type == 'jobs' )
						{{ Form::hidden('user_type', 'jobs') }}
						@endif
                        <input type="hidden" name="type" value="{{$customerdata->type}}">
                        <div class="col offset-md-3">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    {{ Form::label('first_name',__('messages.first_name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                    {{ Form::text('first_name',old('first_name'),['placeholder' => __('messages.first_name'),'class' =>'form-control','required']) }}
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::hidden('username',old('username'),['placeholder' => __('messages.username'),'class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::hidden('email',old('email'),['placeholder' => __('messages.email'),'class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    {{ Form::label('contact_number',__('messages.contact_number').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                    {{ Form::text('contact_number',old('contact_number'),['readonly', 'placeholder' => __('messages.contact_number'),'class' =>'form-control','required']) }}
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                                <div class="form-group col-md-2 mt-4">

                                    @if($customerdata->type == 'booking' )

                                    <a href="{{ route('quickbooking') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i>Change Number</a>

                                    @endif
                                    @if($customerdata->type == 'jobs' )

                                    <a href="{{ route('jobs.quick') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i>Change Number</a>

                                    @endif
                                </div>
                            </div>


                            <div class="form-group col-md-4" id=" hideStatus">
                                {{ Form::label('status',__('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::select('status',['1' => __('messages.active') , '0' => __('messages.inactive') ],old('status'),[ 'class' =>'form-control select2js','required']) }}
                            </div>

                            {{ Form::submit( __('messages.save'), ['class'=>'btn btn-md btn-primary offset-md-3']) }}

                        </div>


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

                document.getElementById(" hideStatus").style.display = "none";

            });



        })(jQuery);
    </script>

    @endsection
</x-master-layout>