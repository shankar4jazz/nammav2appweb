<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ $pageTitle ?? __('messages.quick_form_title') }}</h5>

                            <a href="{{ route('booking.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                            @if($auth_user->can('booking list'))
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 offset-md-3">
                <div class="card w-100 p-3">
                    <div class="card-body">
                        {{ Form::label('brand',__('messages.enter_customer_mobile_no').' <span class="text-danger">*</span>',['id'=>'mobile_label', 'class'=>'form-control-label', 'style'=>'font-size:25px; font-weight:bold'], false ) }}

                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">

                                {{ Form::text('mobile_no', null, ['class'=>"form-control" , 'rows'=>3  ,  'style'=>'font-size:25px;font-weight:bold', 'id'=>'mobile_no' ]) }}
                                <div id="wrong-egn" class="text-danger" style='font-size:20px;'>Please provide 10 digit number.</div>
                            </div>


                        </div>


                    </div>
                    <div class="card-footer">
                        {{ Form::button( __('messages.process'), ['class'=>'btn btn-md btn-primary offset-md-5', 'id'=>"process"]) }}
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
                document.getElementById("wrong-egn").style.display = "none";
                $(document).on('click', '#process', function(e) {
                    var value = document.getElementById("mobile_no").value;
                    console.log(value);
                    if (value.length === 10) {
                        $('#wrong-egn').slideUp();
                        e.preventDefault();
                        checkExistCustomer(value);
                    } else {
                        $('#wrong-egn').slideDown();
                    }

                })

            });

            function checkExistCustomer(mobile_no) {

                var get_subcategory_list = "{{ route('ajax-list', [ 'type' => 'existing_customer', 'user_type'=> 'jobs', 'mobile_no' =>'']) }}" + mobile_no;
				
                get_subcategory_list = get_subcategory_list.replace(/amp;/g, '');
				console.log(get_subcategory_list);

                $.ajax({
                    url: get_subcategory_list,
                    success: function(result) {
                        var data = result.results;
                       
                        if (data.status_code == 404) {
                            var url =  "{{ route('user.quickcreate', ['type'=>'jobs', 'mobile_no' =>'']) }}" + mobile_no;
                            url = url.replace('amp;', '');
                            window.location.href = url;
                        }
                        if (data.status_code == 200) {

                          window.location.href = "{{ route('jobs.jobadd', ['mobile_no' =>'']) }}" + mobile_no;
                        }
                    }
                });
            }

        })(jQuery);
    </script>

    @endsection
</x-master-layout>