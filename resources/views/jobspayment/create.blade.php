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
                        {{ Form::model($plan,['method' => 'POST','route'=>'jobs-payment.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'plan'] ) }}
                        {{ Form::hidden('id') }}
                        <input type="hidden" id="employer_id" name="employer_id" value="{{$plan->employer_id}}">
                        <input type="hidden" id="all_total_amount" name="all_total_amount" value="{{$plan->total_amount}}">
                        <input type="hidden" id="trial_period" name="trial_period" value="{{$plans->trial_period ?? ''}}">
                        <div class="row">
                            <div class="form-group col-md-12">
                                {{ Form::label('job_id', __('messages.select_name',[ 'select' => __('Job') ]),['class'=>'form-control-label'],false) }}
                                <br />
                                {{ Form::select('job_id', [], old('job_id'), [
                                        'class' => 'select2js form-group service',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('job') ]),
                                        'data-type' => 'my-custom-type'                                        
                                    ]) }}
                            </div>

                            @foreach($plan_category as $key => $data)
                            <div class="form-group col-md-6">
                                <div class="card-body table-responsive">
                                    <table class="table text-center table-bordered bg_white">
                                        <tr>
                                            <th colspan="2">{{ $data->en_name }} -({{ $data->ta_name }})</th>
                                        </tr>
                                        @foreach($data->getPlans as $p)
                                        <tr>

                                        

                                            <td style="background-color:lightgreen;"><input class="checkbox no-wh permission_check" id="permission-{{$p->id}}" type="radio" name="plan_id" value='{{$p->id}}' onclick='updateFields("{{$p->id}}", "{{$p->total_amount}}", "{{$p->trial_period}}");' {{ $p->id ==  $plan->plan_id? 'checked' : '' }}> </td>
                                            <td style="background-color:lightgreen;" class="text-capitalize">{{ $p->duration }} {{ $p->type }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-capitalize">
                                                {{ Form::label('Price',__('Actual Price'), ['class' => 'form-control-label'],false) }}
                                            </td>
                                            <td class="text-capitalize">
                                                {{ Form::number('price', $p->price, old('$p->price'),['placeholder' => __('Price'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0]) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-capitalize">
                                                {{ $p->percentage }}
                                                {{ Form::label('Price',__('Offer in Percentage %'), ['class' => 'form-control-label'],false) }}
                                            </td>
                                            <td class="text-capitalize">
                                                {{ Form::number('percentage', $p->percentage, old('@p->percentage'),['placeholder' => __('Offer'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0]) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-capitalize">
                                                {{ Form::label('Price',__('Sub Total'), ['class' => 'form-control-label'],false) }}
                                            </td>
                                            <td class="text-capitalize">
                                                {{ Form::number('amount', $p->amount, old('$p->amount'),['placeholder' => __('Sub Total'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0]) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-capitalize">
                                                {{ Form::label('Price',__('Tax in Percentage'), ['class' => 'form-control-label'],false) }}
                                            </td>
                                            <td class="text-capitalize">
                                                {{ Form::number('tax', $p->tax ,old('$p->tax'),['placeholder' => __('tax'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0]) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-capitalize">
                                                {{ Form::label('Price',__('Total Amount'), ['class' => 'form-control-label'],false) }}
                                            </td>
                                            <td class="text-capitalize">
                                                {{ Form::number('total_amount',$p->total_amount,old('$p->total_amount'),['placeholder' => __('tax'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0]) }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>

                                </div>
                            </div>
                            @endforeach



                            <div class="form-group col-md-6">
                                {{ Form::label('payment_type',trans('Payment type').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::select('payment_type',['online' => __('Online') ,'bank' => __('Bank Transfer') , 'cash' => __('Cash') ],old('type'),[ 'id' => 'payment_type' ,'class' =>'form-control select2js','required']) }}
                            </div>


                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 ">
                                {{ Form::label('description',__('messages.description'), ['class' => 'form-control-label']) }}
                                {{ Form::textarea('description', $decoded_description, ['class'=>"form-control textarea" , 'rows'=>3  , 'id'=>"description", 'placeholder'=> __('messages.description') ]) }}
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            {{ Form::label('status',trans('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                            {{ Form::select('payment_status',['paid' => __('Paid') , 'pending' => __('Pending'), 'failed' => __('Failed') ],old('payment_status'),[ 'id' => 'payment_status' ,'class' =>'form-control select2js','required']) }}
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

                var job_id = "{{ isset($plan->job_id) ? $plan->job_id : ''}}";

                getJobs(job_id);
                getEmployer(job_id);
                getPlans();

                CKEDITOR.replace('editor');

            });
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

                $(document).on('change', '#job_id', function() {
                    var job_id = $(this).val();

                    getEmployer(job_id);
                })

                window.updateFields = function(plan_id, total_amount, period) {
                    document.getElementById('all_total_amount').value = total_amount;
                    document.getElementById('trial_period').value = period;

                    // Any other fields you want to update based on the selected radio button
                };

                // function updateFields(plan_id, total_amount) {
                //     document.getElementById('all_total_amount').value = total_amount;
                //     // Any other fields you want to update based on the selected radio button
                // }

                function getJobs(job_id="") {

                    var state_route = "{{ route('ajax-list', [ 'type' => 'get-jobs', 'job_id' =>'']) }}" + job_id;
                    state_route = state_route.replace('amp;', '');


                    $.ajax({
                        url: state_route,
                        success: function(result) {
                            console.log(result.results);
                            $('#job_id').select2({
                                width: '100%',
                                placeholder: "{{ trans('messages.select_name',['select' => trans('messages.state')]) }}",
                                data: result.results
                            });

                            if (job_id != null) {
                                $("#job_id").val(state).trigger('change');
                            }
                        }
                    });
                }

                function getEmployer(job_id, state = "") {

                    var state_route = "{{ route('ajax-list', [ 'type' => 'get-employer', 'job_id' =>'']) }}" + job_id;
                    state_route = state_route.replace('amp;', '');


                    $.ajax({
                        url: state_route,
                        success: function(result) {

                            $("#employer_id").val(result.results[0].user_id);
                            console.log(result.results);
                            // $('#job_id').select2({
                            //     width: '100%',
                            //     placeholder: "{{ trans('messages.select_name',['select' => trans('messages.state')]) }}",
                            //     data: result.results
                            // });

                        }
                    });
                }

                function getPlans(job_id = "") {

                    var state_route = "{{ route('ajax-list', [ 'type' => 'get-plans']) }}";
                    state_route = state_route.replace('amp;', '');


                    $.ajax({
                        url: state_route,
                        success: function(result) {
                            $('#job_id').select2({
                                width: '100%',
                                placeholder: "{{ trans('messages.select_name',['select' => trans('messages.state')]) }}",
                                data: result.results
                            });
                            if (job_id != null) {
                                $("#job_id").val(state).trigger('change');
                            }
                        }
                    });
                }
          
        })(jQuery);
    </script>
    @endsection
</x-master-layout>