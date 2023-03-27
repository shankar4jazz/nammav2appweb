<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ $pageTitle ?? __('messages.list') }}</h5>
                            <a href="{{ route('orders.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                            @if($auth_user->can('booking list'))
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{ Form::model($bookingdata,['method' => 'POST','route'=>'orders.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'booking'] ) }}
                        {{ Form::hidden('id') }}
                        <div class="row">
                            @if (auth()->user()->hasRole(['admin']))
                            <div class="form-group col-md-4">
                                {{ Form::label('name', __('messages.select_name',[ 'select' => __('messages.customer') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                <br />
                                {{ Form::select('customer_id', [optional($bookingdata->customer)->id => optional($bookingdata->customer)->contact_number], optional($bookingdata->user)->id, [
                                                'class' => 'select2js form-group customer',
                                                'required',
                                                'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.customer') ]),
                                                'data-ajax--url' => route('ajax-list', ['type' => 'user']),
                                            ])
                                        }}
                            </div>
                            @else
                            <input type="hidden" name="customer_id" value="{{$bookingdata->customer_id}}">
                            @endif

                            <div class="form-group col-md-4">
                                {{ Form::label('name', __('messages.select_name',[ 'select' => __('messages.service') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                <br />
                                {{ Form::select('service_id', [optional($bookingdata->service)->id => optional($bookingdata->service)->name], optional($bookingdata->service)->id, [
                                            'class' => 'select2js form-group service',
                                            'required',
                                            'id' => 'service_id',
                                            'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.service') ]),
                                            'data-ajax--url' => route('ajax-list', ['type' => 'service']),
                                        ])
                                    }}
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('name', __('messages.select_name',[ 'select' => __('messages.coupon') ]),['class'=>'form-control-label']) }}
                                <br />
                                {{ Form::select('coupon_id', [optional($bookingdata->coupon)->id => optional($bookingdata->coupon)->name], optional($bookingdata->coupon)->id, [
                                            'class' => 'select2js form-group coupon',
                                            'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.coupon') ]),
                                            'data-ajax--url' => route('ajax-list', ['type' => 'coupon']),
                                        ])
                                    }}
                            </div>
                            <input type="hidden" name="type" value="">
                            <input type="hidden" name="quantity" value="1">
                            <div class="form-group col-md-4">
                                {{ Form::label('date',__('messages.date').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('date',old('date'),['placeholder' => __('messages.date'),'class' =>'form-control min-datetimepicker','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>


                            <div class="form-group col-md-4">
                                {{ Form::label('brand',__('messages.brand').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('brand', null, ['class'=>"form-control" , 'rows'=>3  , 'placeholder'=> __('messages.brand') ]) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                <input type="hidden" id="service_amt" value="">
                                {{ Form::label('mrp',__('messages.mrp').' <span class="text-danger"></span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::number('mrp', null, ['readonly', 'min' => 0, 'step' => 'any' , 'id' =>'mrp','class'=>"form-control" , 'rows'=>3  , 'placeholder'=> __('messages.mrp') ]) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="col-md-12">
                                            {{ Form::label('address',__('messages.address').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                            {{ Form::textarea('address', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.address') ]) }}
                                            <small class="help-block with-errors text-danger"></small>
                                        </div>

                                        <div class="col-md-12">
                                            {{ Form::label('description',__('messages.description'), ['class' => 'form-control-label']) }}
                                            {{ Form::textarea('description', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.description') ]) }}
                                        </div>

                                    </div>

                                    <!-- <div class="col-md-4">
                                        <div class="form-group col-md-12">
                                            {{ Form::label('quantity',__('messages.quantity').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                            {{ Form::number('quantity', null, ['min' => 0, 'step' => 'any' , 'id' =>'quantity','class'=>"form-control" , 'rows'=>3  , 'placeholder'=> __('messages.quantity') ]) }}
                                            <small class="help-block with-errors text-danger"></small>
                                        </div> 
                                    </div>  -->
                                    <div class="col-md-6">

                                        <div class="form-group col-md-12">
                                            {{ Form::label('quantity',__('messages.quantity').' <span class="text-danger"></span>',['class'=>'form-control-label'], false ) }}
                                            {{ Form::number('quantity', null, ['min' => 0, 'step' => 'any' , 'id' =>'quantity', 'class'=>"form-control" , 'rows'=>3  , 'placeholder'=> __('messages.quantity') ]) }}
                                            <small class="help-block with-errors text-danger"></small>
                                        </div>

                                        <div class="form-group col-md-12">
                                            {{ Form::label('other_charge',__('messages.other_charge').' <span class="text-danger"></span>',['class'=>'form-control-label'], false ) }}
                                            {{ Form::number('other_charge', null, ['min' => 0, 'step' => 'any' , 'id' =>'other_charge', 'class'=>"form-control" , 'rows'=>3  , 'placeholder'=> __('messages.other_charge') ]) }}
                                            <small class="help-block with-errors text-danger"></small>
                                        </div>

                                        <div class="form-group col-md-12">
                                            {{ Form::label('discount',__('messages.discount').' <span class="text-danger"></span>',['class'=>'form-control-label'], false ) }}
                                            {{ Form::number('discount_amount', null, ['min' => 0, 'step' => 'any' , 'id' =>'discount', 'class'=>"form-control" , 'rows'=>3  , 'placeholder'=> __('messages.discount') ]) }}
                                            <small class="help-block with-errors text-danger"></small>
                                        </div>


                                        <div class="form-group col-md-12">
                                            {{ Form::label('sub_amount',__('messages.sub_amount').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                            {{ Form::number('amount', null, ['readonly', 'class'=>"form-control" , 'rows'=>3  , 'min' => 0, 'step' => 'any' , 'id' =>'sub_amount', 'placeholder'=> __('messages.sub_amount') ]) }}
                                            <small class="help-block with-errors text-danger"></small>
                                        </div>

                                        <div class="form-group col-md-12">
                                            {{ Form::label('advance',__('messages.advance').' <span class="text-danger"></span>',['class'=>'form-control-label'], false ) }}
                                            {{ Form::number('advance', null, ['min' => 0, 'step' => 'any' , 'id' =>'advance', 'class'=>"form-control" , 'rows'=>3  , 'placeholder'=> __('messages.advance') ]) }}
                                            <small class="help-block with-errors text-danger"></small>
                                        </div>

                                        <div class="form-group col-md-12">
                                            {{ Form::label('amount',__('messages.amount').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                            {{ Form::number('total_amount', null, ['readonly','class'=>"form-control" , 'rows'=>3  , 'min' => 0, 'step' => 'any' , 'id' =>'amount', 'placeholder'=> __('messages.amount') ]) }}
                                            <small class="help-block with-errors text-danger"></small>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{ Form::submit( __('messages.save'), ['class'=>'btn btn-md btn-primary float-right']) }}
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


                // var category_id = "{{ isset($bookingdata->service_id) ? $bookingdata->service_id : '' }}";





                //getSubCategory(category_id)



                $(document).on('change', '#service_id', function() {
                    var category_id = $(this).val();
                    $('#subcategory_id').empty();
                    getSubCategory(category_id);
                })

                // $(document).on('change', '#quantity', function() {
                //     var value = $(this).val();
                //     qtycalculate(value);
                // })

                $(document).on('change', '#quantity', function() {
                    var value = $(this).val();
                    qnty_calculate(value);
                })

                $(document).on('change', '#other_charge', function() {
                    var value = $(this).val();
                    other_calculate(value);
                })

                $(document).on('change', '#discount', function() {
                    var value = $(this).val();
                    discount_calculate(value);
                })

                $(document).on('change', '#advance', function() {
                    var value = $(this).val();
                    advance_calculate(value);
                })

            });



            function advance_calculate(advance) {

                var mrp = $('#mrp').val();
                var quantity = $('#quantity').val();
                var other_amt = $('#other_charge').val();
                var discount = $('#discount').val();


                var price = parseInt(quantity) * parseInt(mrp);

                var subtotal = price + parseInt(other_amt) - discount;
                $('#sub_amount').val(subtotal.toFixed(2));
                var total = subtotal - advance;
                //console.log(total);
                $('#amount').val(total.toFixed(2));

            }

            function other_calculate(other_amt) {

                var mrp = $('#mrp').val();
                var quantity = $('#quantity').val();
                var discount = $('#discount').val();
                var advance = $('#advance').val();


                var price = parseInt(quantity) * parseInt(mrp);

                var subtotal = price + parseInt(other_amt) - discount;
                $('#sub_amount').val(subtotal.toFixed(2));
                var total = subtotal - advance;
                $('#amount').val(total.toFixed(2));

            }

            function discount_calculate(discount) {


                var mrp = $('#mrp').val();
                var quantity = $('#quantity').val();
                var discount = $('#discount').val();
                var advance = $('#advance').val();
                var other_amt = $('#other_charge').val();


                var price = parseInt(quantity) * parseInt(mrp);

                var subtotal = price + parseInt(other_amt) - discount;
                $('#sub_amount').val(subtotal.toFixed(2));
                var total = subtotal - advance;
                $('#amount').val(total.toFixed(2));

            }



            function qnty_calculate(value) {

                var mrp = $('#mrp').val();
                var quantity = value;
                var discount = $('#discount').val();
                var advance = $('#advance').val();
                var other_amt = $('#other_charge').val();


                var price = parseInt(quantity) * parseInt(mrp);

                var subtotal = price + parseInt(other_amt) - discount;
                $('#sub_amount').val(subtotal.toFixed(2));
                var total = subtotal - advance;
                $('#amount').val(total.toFixed(2));
            }




            function getSubCategory(category_id) {

                var get_subcategory_list = "{{ route('ajax-list', [ 'type' => 'servicedetails','service_id' =>'']) }}" + category_id;
                get_subcategory_list = get_subcategory_list.replace('amp;', '');

                $.ajax({
                    url: get_subcategory_list,
                    success: function(result) {
                        var data = result.results;
                        data.forEach(function(value) {
                            $('#mrp').val(value.price);
                            //$('#service_amt').val(value.price);                           
                            $('#discount').val(0);
                            $('#other_charge').val(0);
                            $('#quantity').val(1);
                            $('#advance').val(0);

                            //var discount = value.discount / 100;
                            var total = value.price * 1;

                            $('#sub_amount').val(total.toFixed(2));
                            $('#amount').val(total.toFixed(2));
                        });
                        // if (subcategory_id != "") {
                        //     $('#subcategory_id').val(subcategory_id).trigger('change');
                        // }
                    }
                });
            }


        })(jQuery);
    </script>

    @endsection
</x-master-layout>