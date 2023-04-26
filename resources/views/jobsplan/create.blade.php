<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ $pageTitle ?? trans('messages.list') }}</h5>
                            <a href="{{ route('plans.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{ Form::model($plan,['method' => 'POST','route'=>'jobs-plans.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'plan'] ) }}
                        {{ Form::hidden('id') }}
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('name', __('messages.select_name',[ 'select' => __('messages.category') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                <br />
                                
                                {{ Form::select('plancategory_id', [optional($plan->jobsplans)->id => optional($plan->jobsplans)->ta_name], optional($plan->jobsplans)->id, [
                                            'class' => 'select2js form-group category',
                                            'required',
                                            'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.category') ]),
                                            'data-ajax--url' => route('ajax-list', ['type' => 'jobs_plan_category'],true, 'https'),
                                        ]) }}

                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('title',trans('messages.title').' <span class="text-danger"></span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('title',old('title'),['placeholder' => trans('messages.title'),'class' =>'form-control']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('type',trans('messages.type').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::select('type',['days' => __('Days') ,'monthly' => __('messages.monthly') , 'yearly' => __('messages.yearly') ],old('type'),[ 'id' => 'type' ,'class' =>'form-control select2js','required']) }}
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('duration',trans('messages.duration').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::select('duration',['1' => '1' , '2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9','10' => '10','11' => '11','12' => '12' ],old('duration'),[ 'id' => 'duration' ,'class' =>'form-control select2js','required']) }}
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('trial_period',__('Period (Plan validity days)').' <span class="text-danger">*</span>', ['class' => 'form-control-label'],false) }}
                                {{ Form::number('trial_period',old('trial_period'),['placeholder' => __('Enter the days plan validity'),'class' =>'form-control', 'required']) }}
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('Price',__('Actual Price').' <span class="text-danger">*</span>', ['class' => 'form-control-label'],false) }}
                                {{ Form::number('price',old('price'),['placeholder' => __('Price'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0]) }}
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('amount',__('Offer in Percentage(example:10, without % symbol)').' <span class="text-danger">*</span>', ['class' => 'form-control-label'],false) }}
                                {{ Form::number('percentage',old('percentage'),['placeholder' => __('Enter percentage'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0]) }}
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('amount',__('messages.amount').' <span class="text-danger">*</span>', ['class' => 'form-control-label'],false) }}
                                {{ Form::number('amount',old('amount'),['placeholder' => __('messages.amount'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0]) }}
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('tax',__('Tax in Percentage(example:10, without % symbol)').' <span class="text-danger">*</span>', ['class' => 'form-control-label'],false) }}
                                {{ Form::number('tax',old('tax'),['placeholder' => __('Enter tax percentage'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0]) }}
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('total_amount',__('Total Amount').' <span class="text-danger">*</span>', ['class' => 'form-control-label'],false) }}
                                {{ Form::number('total_amount',old('total_amount'),['placeholder' => __('Total Amount'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0]) }}
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('status',trans('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::select('status',['1' => __('messages.active') , '0' => __('messages.inactive') ],old('status'),[ 'id' => 'role' ,'class' =>'form-control select2js','required']) }}
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('plan_type',trans('messages.plan_limitation').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                <select class='form-control select2js' id='plan_limitation' name="plan_type">
                                    @foreach($plan_type as $value)
                                    <option value="{{$value->value}}" data-type="{{$value->value}}" {{ $plan->plan_type == $value['value']  ? 'selected' : '' }}>{{$value->label}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 ">
                                {{ Form::label('description',__('messages.description'), ['class' => 'form-control-label']) }}
                                {{ Form::textarea('description', $decoded_description, ['class'=>"form-control textarea" , 'rows'=>3  , 'id'=>"editor", 'placeholder'=> __('messages.description') ]) }}
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
            $(document).ready(function() {
       
                CKEDITOR.replace('editor');
                //     $(".checklist:checkbox").each(function() {
                //         if ($(this).is(":checked")) {
                //             showCheckLimitData($(this).attr("id"));
                //         }
                //     });
                //     var value = $("#plan_limitation option:selected").attr('data-type');
                //     showLimitCheckbox(value)

                //     $(document).on('change' , '#plan_limitation' , function (){
                //         var data = $("#plan_limitation option:selected").attr('data-type');
                //         showLimitCheckbox(data)
                //     })

                // function showLimitCheckbox(type){
                //     if(type === 'limited'){
                //         $('.show-checklist').removeClass('d-none')
                //     }else{
                //         $('.show-checklist').addClass('d-none')
                //     }
                //     if(type === 'free'){
                //         $('.show_trial_period').removeClass('d-none')
                //     }else{
                //         $('.show_trial_period').addClass('d-none')
                //     }
                // }
            });
        })(jQuery);
    </script>
    @endsection
</x-master-layout>