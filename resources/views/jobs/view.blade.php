<x-master-layout>
    {{ Form::open(['route' => ['provider.destroy', $providerdata->id], 'method' => 'delete', 'data--submit' => 'provider' . $providerdata->id]) }}
    <main class="main-area">
        <div class="main-content">
            <div class="container-fluid">
                @include('partials._jobs')
                <div class="card">
                    <div class="card-body p-30">
                        <div class="provider-details-overview mb-30">
                            <div class="provider-details-overview__collect-cash">
                                <div class="statistics-card statistics-card__collect-cash h-100">
                                    <h3>{{ __('Collect payment from the employer for this job post') }}</h3>

                                    @php
                                    $payment_status = $earningData['payment_status'];
                                    if ($payment_status == 'pending') {
                                    $status = '<a href="' . route('jobs-payment.create', ['id' => $providerdata->payment_id]) . '" class="btn btn--primary text-capitalize btn--lg mw-75">' . __('Add Payment') . '</a>';
                                    } else if ($payment_status == 'paid') {
                                  
                                    $status = '<a href="' . route('jobs-payment.create', ['id' => $providerdata->payment_id]) . '" class="btn btn--primary text-capitalize btn--lg mw-75">' . __('Edit Payment') . '</a>';
                                    } else if ($payment_status == 'failed') {
                                    $status = '<a href="' . route('jobs-payment.create', ['id' => $providerdata->payment_id]) . '" class="btn btn--primary text-capitalize btn--lg mw-75">' . __('Add Payment') . '</a>';
                                    } else {
                                    $status = '<a href="' . route('jobs-payment.create') . '" class="btn btn--primary text-capitalize btn--lg mw-75">' . __('Add Payment') . '</a>';
                                    }
                                    echo $status;
                                    @endphp
                                </div>
                            </div>


                            <div class="provider-details-overview__statistics">
                                <div class="statistics-card statistics-card__style2 statistics-card__pending-withdraw">
                                    <h2>{{$providerdata['total_views'] ?? 0}}</h2>
                                    <h3>{{__('Total Views')}}</h3>
                                </div>

                                <div class="statistics-card statistics-card__style2 statistics-card__already-withdraw">
                                    <h2>{{$providerdata['total_applicants'] ?? 0}}</h2>
                                    <h3>{{__('Total Application')}}</h3>
                                </div>

                                <div class="statistics-card statistics-card__style2 statistics-card__already-withdraw">                                
                                    <a href="{{route('job_invoice_pdf',$providerdata->id)}}" class="btn btn--primary text-capitalize btn--lg mw-75">{{ __('Invoice')}}</a>'
                                </div>
                            </div>
                        </div>


                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="information-details-box media flex-column flex-sm-row gap-20">
                                    <img class="avatar-img radius-5" src="./img/1.png" alt="" />
                                    <div class="media-body">
                                        <h2 class="information-details-box__title">
                                            {{ $providerdata->display_name }}
                                        </h2>
                                        <ul class="contact-list">

                                            <li>
                                                <i class="fas fa-user"></i>
                                                <span class="contact-info-text">{{ $earningData['name']  }}</span>
                                            </li>
                                            <li>
                                                <i class="fas fa-user"></i>
                                                <span class="contact-info-text">{{ $earningData['mobile_no']  }}</span>
                                            </li>
                                            <li>
                                                <i class="ri-smartphone-line"></i>
                                                <span>Job Conatct: {{!empty($providerdata->contact_number) ? $providerdata->contact_number: '-' }}</span>
                                            </li>
                                            <li>
                                                <i class="fas fa-bars"></i>
                                                <span>{{ $earningData['job_title'] }}</span>
                                            </li>
                                            <li>
                                                <i class="ri-map-2-line"></i>
                                                <span class="contact-info-text">{{ $earningData['payment_type'] }}</span>
                                            </li>
                                            <li>
                                                <i class="fas fa-rupee-sign"></i>
                                                <span class="contact-info-text">{{ $earningData['total_amount']  }}</span>
                                            </li>

                                            <li>
                                                <i class="fas fa-check"></i>
                                                @php
                                                $payment_status = $earningData['payment_status'];
                                                if ($payment_status == 'pending') {
                                                $status = '<span class="badge badge-danger">' . __('messages.pending') . '</span>';
                                                } else if ($payment_status == 'paid') {
                                                $status = '<span class="badge badge-success">' . __('messages.paid') . '</span>';
                                                } else if ($payment_status == 'failed') {
                                                $status = '<span class="badge badge-danger">' . __('failed') . '</span>';
                                                } else {
                                                $status = '<span class="badge badge-danger">' . __('Payment not Init') . '</span>';
                                                }
                                                echo $status;
                                                @endphp
                                            </li>
                                            <li>
                                                <i class="fas fa-calendar"></i>
                                                <span class="contact-info-text">{{ $earningData['date_time']  }}</span>
                                            </li>
                                            <li>
                                                <i class="fas fa-exchange-alt"></i>
                                                <span class="contact-info-text">{{ $earningData['txn_id']  }}</span>
                                            </li>
                                            <li>
                                                <i class="fas fa-sort"></i>
                                                <span class="contact-info-text">{{ $earningData['order_id']  }}</span>
                                            </li>
                                            <li>
                                            <i class="fa-solid fa-address-book"></i>
                                                <span class="contact-info-text">{{ $earningData['other_transaction_detail']  }}</span>
                                            </li>
                                        </ul>
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
    {{ $dataTable->scripts() }}


    <script type="text/javascript">
        var pendingCount = "0";
        var cancelledCount = 0;
        var Completedcount = 0;
        var Acceptedcount = 0;

        var options = {
            series: [parseInt(pendingCount), cancelledCount, Completedcount, Acceptedcount],
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: ['Pending', 'cancell', 'completed', 'accepted'],
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
    </script>
    @endsection
</x-master-layout>