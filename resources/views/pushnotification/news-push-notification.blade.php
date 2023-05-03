{{ Form::model($settings,['method' => 'POST','route'=>'sendNewsPushNotification', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'push_notification'] ) }}
{{ Form::hidden('id') }}
{{ Form::hidden('page', $page, ['class' => 'form-control'] ) }}
<input type="hidden" id="district_name" name="district_name" value="AllTamilNadu">
<div class="row">
    <div class="form-group col-md-12">
        {{ Form::label('title',trans('messages.title').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
        {{ Form::text('title',old('title'),['placeholder' => trans('messages.title'),'class' =>'form-control','required']) }}
        <small class="help-block with-errors text-danger"></small>
    </div>
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
        {{ Form::label('news_id', __('messages.select_name',[ 'select' => __('Job') ]),['class'=>'form-control-label'],false) }}
        <br />
        {{ Form::select('news_id', [], old('news_id'), [
                                        'class' => 'select2js form-group news-service',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __(' a news') ]),
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
    // $(document).ready(function() {
    //     var value = $('.service').find(':selected').attr('data-type');
    //     $(document).on('change', '.notification_type', function() {
    //         var type = $(this).val();
    //         if (type == 'service') {
    //             textareaValue(value)
    //             $('#select_service').removeClass('d-none');
    //         } else {
    //             $('#select_service').addClass('d-none');
    //             $('#description').val('')
    //         }
    //     });
    //     $(document).on('change', '.service', function() {
    //         var value = $(this).find(':selected').attr('data-type');
    //         textareaValue(value)

    //     });
    // });

    getJobs(100);

    $(document).on('change', '#district_id', function() {
        var district = $(this).val();
        var district_name = $(this).find('option:selected').text();

        console.log(district_name);


        $('#district_name').val(district_name)
        
        $('#news_id').empty();
        getJobs(district);
    })


    $(document).on('change', '.news-service', function() {
        var selectElement = document.querySelector('select[name="news_id"]');

  
        var selectedOption = selectElement.options[selectElement.selectedIndex];
      
        if (selectedOption) {
            var selectedText = selectedOption.text;
        } else {
            console.log("No job selected to push notification");
        }

        textareaValue(selectedText);
    });

    function getJobs(district, state = "") {
       

        var state_route = "{{ route('ajax-list', [ 'type' => 'push_news','district_id' =>'']) }}" + district;
        state_route = state_route.replace('amp;', '');


        $.ajax({
            url: state_route,
            success: function(result) {
                $('#news_id').select2({
                    width: '100%',
                    placeholder: "{{ trans('messages.select_name',['select' => trans('messages.state')]) }}",
                    data: result.results
                });
                if (state != null) {
                    $("#news_id").val(state).trigger('change');
                }
            }
        });
    }

    function textareaValue(value) {
        $('#description').val(value)
    }
</script>