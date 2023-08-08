<x-master-layout>
    {{ Form::open(['route' => ['provider.destroy', $providerdata->id], 'method' => 'delete','data--submit'=>'provider'.$providerdata->id]) }}
    <main class="main-area">
        <div class="main-content">
            <div class="container-fluid">
                @include('partials._jobs')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-block card-stretch">
                                    <div class="card-body">
                                        <h5 class="card-title">{{__('messages.booking')}}</h5>
                                        <div class="table-responsive">
                                            <table class="table data-table mb-0 provider-booking-data">
                                                <thead class="table-color-heading">
                                                    <tr class="text-secondary">
                                                        <th scope="col">{{__('messages.booking_id')}}</th>
                                                        <th scope="col">{{__('name')}}</th>
                                                        <th scope="col">{{__('type')}}</th>
                                                        <th scope="col">{{__('message')}}</th>
                                                        <th scope="col">{{__('date time')}}</th>                                                     
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    {{ Form::close() }}
    @section('bottom_script')
    <script type="text/javascript">
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "",
                type: 'GET'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'jobseeker_name',
                    name: 'jobseeker_name'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'message',
                    name: 'message'
                },
                {
                    data: 'datetime',
                    name: 'datetime'
                },
                
                
            ]
        });
    </script>
    @endsection
</x-master-layout>