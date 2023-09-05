 <x-master-layout>
     @push('styles')
   
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
     @endpush
     <div class="container-fluid">
         <div class="row">
             <div class="col-lg-12">
                 <div class="card card-block card-stretch">
                     <div class="card-body p-0">
                         <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                             <h5 class="font-weight-bold">{{ $pageTitle ?? trans('messages.list') }}</h5>
                             @if($auth_user->can('user add'))
                             <a href="{{ route('user.create') }}" class="float-right mr-1 btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> {{ __('messages.add_form_title',['form' => __('messages.user')  ]) }}</a>
                             @endif
                         </div>
                         {{ Form::open(['url' => '/jobseeker', 'method' => 'get']) }}

                         <div class="d-flex justify-content-start align-items-start p-1 flex-wrap gap-1">
                             <div class="form-group col-md-3">
                                 {{ Form::select('state_id', [], null, [
                                    'class' => 'form-control select2js state_id',
                                    'data-placeholder' => __('messages.select_name', ['select' => __('messages.state')]),
                                    'id' => 'state_id'
                                ]) }}
                             </div>
                             <div class="form-group col-md-3">
                                 {{ Form::select('district_id', [], old('district_id'), [
                                    'class' => 'select2js form-group district_id',
                                    'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.district') ]),
                                    'id' => 'district_id'
                                ]) }}
                             </div>
                             <div class="form-group col-md-3">
                                 {{ Form::select('q_cat_id', [], old('q_cat_id'), [
                                    'class' => 'select2js form-group q_cat_id',
                                    'data-placeholder' => __('messages.select_name',[ 'select' => __('Education Category') ]),
                                    'id' => 'q_cat_id'
                                ]) }}
                             </div>
                             <div class="form-group col-md-3">
                                 {{ Form::select('qual_id', [], old('qual_id'), [
                                    'class' => 'select2js form-group qual_id',
                                    'data-placeholder' => __('messages.select_name',[ 'select' => __('Qualification') ]),
                                    'id' => 'qual_id'
                                ]) }}
                             </div>
                             <div class="form-group col-md-3">
                                 {{ Form::select('gender',['0' => __('messages.gender_0') , '1' => __('messages.gender_1'), '2' => __('messages.gender_2')  ],old('gender'),[ 'id' => 'gender' ,'class' =>'form-control select2js','required']) }}
                                 <small class="help-block with-errors text-danger"></small>
                             </div>
                             <div class="form-group col-md-3">
                                 {{ Form::submit( trans('Filter'), ['class'=>'btn btn-md btn-primary float-right']) }}
                             </div>
                         </div>

                         {{ Form::close() }}
                         {{ $dataTable->table(['class' => 'table  w-100'],false) }}
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <main class="main-area">
         <div class="main-content">
             <div class="container-fluid">

                 <div class="card">
                     <div class="card-body p-30">
                         <div class="provider-details-overview mb-30">
                             <div class="statistics-card statistics-card__style2 statistics-card__pending-withdraw">
                                 <h2>{{ $totalCounts['Total']  }}</h2>
                                 <h3>{{__('Total Job-Seekers')}}</h3>
                             </div>
                         </div>
                         <div class="col-md-12">
                             <div class="card">
                                 <div class="card-body">
                                     <div class="d-flex justify-content-between align-items-center flex-wrap">
                                         <h4 class="">{{__('Gender Ratio')}}</h4>
                                     </div>
                                     <div id="chart" class="custom-chart"></div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </main>
     @section('bottom_script')
     {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

 
     <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
   

     <script type="text/javascript">
         var maleCount = parseInt("{{ isset($totalCounts['Male']) ? $totalCounts['Male'] : 0 }}");
         var femaleCount = parseInt("{{ isset($totalCounts['Female']) ? $totalCounts['Female'] : 0 }}");
         var NotCompleted = parseInt("{{ isset($totalCounts['NULL']) ? $totalCounts['NULL'] : 0 }}");
         var other = parseInt("{{ isset($totalCounts['Other']) ? $totalCounts['Other'] : 0 }}");

         var options = {
             series: [maleCount, femaleCount, NotCompleted, other],
             chart: {
                 width: 380,
                 type: 'pie',
             },
             labels: ['Male-(' + maleCount + ')', 'Female-(' + femaleCount + ')', 'Not Completed-(' + NotCompleted + ')', 'Other-(' + other + ')'],
             responsive: [{
                 breakpoint: 480,
                 options: {
                     chart: {
                         width: 200
                     },
                     legend: {
                         position: 'bottom'
                     }
                 }
             }]
         };

         var chart = new ApexCharts(document.querySelector("#chart"), options);
         chart.render();
         var country_id = "{{ isset($jobsdata->country_id) ? $jobsdata->country_id : 101 }}";
         var district_id = "{{ request('district_id', 0) }}";
         var state_id = "{{ isset($jobsdata->state_id) ? $jobsdata->state_id : 35 }}";
         var education = "{{ request('q_cat_id', '') }}";
         var qual_id = "{{ request('qual_id', '') }}";
         stateName(country_id, state_id);
         educationCategoryName(education);
         qualificationName(education, qual_id);

         $(document).on('change', '#state_id', function() {
             var state = $(this).val();
             $('#district_id').empty();
             $('#city_id').empty();
             districtName(state, district_id);
         })

         $(document).on('change', '#q_cat_id', function() {
             var cat_id = $(this).val();
             $('#qual_id').empty();
             qualificationName(cat_id);
         })

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

         function educationCategoryName(education = "") {
             var state_route = "{{ route('ajax-list', [ 'type' => 'edu_category']) }}";
             state_route = state_route.replace('amp;', '');

             $.ajax({
                 url: state_route,
                 success: function(result) {
                     $('#q_cat_id').select2({
                         width: '100%',
                         placeholder: "{{ trans('messages.select_name',['select' => trans('messages.state')]) }}",
                         data: result.results

                     });
                     if (education != null) {
                         $("#q_cat_id").val(education).trigger('change');
                     }
                 }
             });
         }

         function qualificationName(category, qual = '') {
             var state_route = "{{ route('ajax-list', [ 'type' => 'qualification', 'category_id' =>'']) }}" + category;
             state_route = state_route.replace('amp;', '');

             $.ajax({
                 url: state_route,
                 success: function(result) {
                     $('#qual_id').select2({
                         width: '100%',
                         placeholder: "{{ trans('messages.select_name',['select' => trans('messages.state')]) }}",
                         data: result.results

                     });
                     if (qual != null && qual != '') {

                         $("#qual_id").val(qual).trigger('change');
                     }
                 }
             });
         }
     </script>
     @endsection
 </x-master-layout>