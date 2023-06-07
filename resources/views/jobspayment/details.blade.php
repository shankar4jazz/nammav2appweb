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
                                                        <th scope="col">{{__('Title')}}</th>
                                                        <th scope="col">{{__('Payment Type')}}</th>
                                                        <th scope="col">{{__('payment_status')}}</th>
                                                        <th scope="col">{{__('Totol Amount')}}</th>
                                                        
                                                        <th scope="col">{{__('Date Time')}}</th>
                                                        <th scope="col">{{__('TXN ID')}}</th>
                                                        <th scope="col">{{__('Order Id')}}</th>
                                                        
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
                    data: 'job_title',
                    name: 'job_title'
                },
                {
                    data: 'payment_type',
                    name: 'payment_type'
                },
                {
                    data: 'payment_status',
                    name: 'payment_status'
                },
                {
                    data: 'total_amount',
                    name: 'total_amount'
                },
                {
                    data: 'date_time',
                    name: 'date_time'
                },
                {
                    data: 'txn_id',
                    name: 'txn_id'
                },
                {
                    data: 'order_id',
                    name: 'order_id'
                }            
                
               
            ]
        });
    </script>
    @endsection
</x-master-layout>