<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ $pageTitle ?? __('messages.list') }}</h5>
                            <a href="{{ route('booking.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                            @if($auth_user->can('booking list'))
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        {{ Form::model($bookingdata,['method' => 'POST','route'=>'order.webassigned', 'data-toggle'=>"validator"] ) }}

                        {{ Form::hidden('id',$bookingdata->id) }}
                        <div class="row">

                            <div class="col-md-6 form-group ">
                                {{ Form::label('handyman_id', __('messages.select_name',[ 'select' => __('messages.handyman') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                <br />
                                @php
                                if($bookingdata->booking_address_id != null)
                                {
                                $route = route('ajax-list', ['type' => 'handyman', 'provider_id' => $bookingdata->provider_id, 'booking_id' => $bookingdata->id ]);
                                } else {
                                $route = route('ajax-list', ['type' => 'handyman', 'provider_id' => $bookingdata->provider_id, 'booking_id' => $bookingdata->id  ]);
                                }
                                $assigned_handyman = $bookingdata->handymanAdded->mapWithKeys(function ($item) {
                                return [$item->handyman_id => optional($item->handyman)->display_name];
                                });
                                @endphp
                                {{ Form::select('handyman_id[]', $assigned_handyman, $bookingdata->handymanAdded->pluck('handyman_id'), [
                                'class' => 'select2js handyman',
                                'id' => 'handyman_id',
                                'required',
                                'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.handyman') ]),
                                'data-ajax--url' => $route,
                                ]) }}
                            </div>

                        </div>

                    </div>
                    <div class="card-footer ">
                        <div class="col-md-6 offset-md-5">
                        {{ Form::submit( __('messages.save'), ['class'=>'btn btn-md btn-primary']) }}
                        {{ Form::close() }}
                        </div>
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


                $('#handyman_id').select2({
                    width: '100%',
                    placeholder: "{{ __('messages.select_name',['select' => __('messages.handyman')]) }}",
                });

            });


        })(jQuery);
    </script>

    @endsection
</x-master-layout>