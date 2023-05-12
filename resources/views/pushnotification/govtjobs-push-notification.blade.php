{{ Form::model($settings,['method' => 'POST','route'=>'sendGovtJobsPushNotification', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'push_notification'] ) }}
{{ Form::hidden('id') }}
{{ Form::hidden('page', $page, ['class' => 'form-control'] ) }}
<input type="hidden" id="district_name" name="district_name" value="AllTamilNadu">
<div class="row">
    <div class="form-group col-md-12">
        {{ Form::label('title',trans('messages.title').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
        {{ Form::text('title',old('title'),['placeholder' => trans('messages.title'),'class' =>'form-control','required']) }}
        <small class="help-block with-errors text-danger"></small>
    </div>
    <input type="hidden" name="govt_jobid" value="" id="govt_jobid" />

    <div class="form-group col-md-12" id="select_district">
        {{ Form::label('name', __('messages.select_name',[ 'select' => __('District') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label','data-placeholder' => __('Select District',[ 'select' => __('districts') ])],false) }}
        <br />
        <select class="form-control district" name="district_id" id="district_id">
            @foreach($districts as $key => $value)
            <option id="{{$key}}" data-type="{{$value}}" value="{{$key}}">{{$value}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-12">
        {{ Form::label('job_id', __('messages.select_name',[ 'select' => __('Job') ]),['class'=>'form-control-label'],false) }}
        <br />
        {{ Form::select('job_id', [], old('job_id'), [
                                        'class' => 'select2js form-group service',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('job') ]),
                                        'data-type' => 'my-custom-type'
                                        
                                    ]) }}
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('description',trans('messages.description').' <span class="text-danger">*</span>', ['class' => 'form-control-label'],false) }}
        {{ Form::textarea('description', null, ['class'=>"form-control textarea" ,'id'=>'description','rows'=>3  , 'required','placeholder'=> __('messages.description') ]) }}
    </div>
</div>
{{ Form::submit( trans('messages.save'), ['class'=>'btn btn-md btn-primary float-right']) }}
{{ Form::close() }}
<script>
    $(document).ready(function() {

    });
    getJobs(100);

    $(document).on('change', '#district_id', function() {

        var district = $(this).val();
        var district_name = $(this).find('option:selected').text();
        $('#district_name').val(district_name)
        $('#job_id').empty();
        getJobs(district);
    })

    $(document).on('change', '.service', function() {
        var selectElement = document.querySelector('select[name="job_id"]');
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        $('#pvt_jobid').val(selectElement.value);
        if (selectedOption) {
            var selectedText = selectedOption.text;
        } else {
            console.log("No job selected to push notification");
        }

        textareaValue(selectedText);
    });

    function textareaValue(value) {
        $('#description').val(value)
    }

    function getJobs(district, state = "") {

        var state_route = "{{ route('ajax-list', [ 'type' => 'push_govt_jobs','district_id' =>'']) }}" + district;
        state_route = state_route.replace('amp;', '');


        $.ajax({
            url: state_route,
            success: function(result) {
                $('#job_id').select2({
                    width: '100%',
                    placeholder: "{{ trans('messages.select_name',['select' => trans('messages.state')]) }}",
                    data: result.results
                });
                if (state != null) {
                    $("#job_id").val(state).trigger('change');
                }
            }
        });
    }

    // function cityName(district, city = "") {
    //             var city_route = "{{ route('ajax-list', [ 'type' => 'city' ,'district_id' =>'']) }}" + district;
    //             city_route = city_route.replace('amp;', '');

    //             $.ajax({
    //                 url: city_route,
    //                 success: function(result) {
    //                     $('#city_id').select2({
    //                         width: '100%',
    //                         placeholder: "{{ trans('messages.select_name',['select' => trans('messages.city')]) }}",
    //                         data: result.results
    //                     });
    //                     if (city != null || city != 0) {
    //                         $("#city_id").val(city).trigger('change');
    //                     }
    //                 }
    //             });
    //         }
</script>