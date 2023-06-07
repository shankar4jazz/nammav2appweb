<x-master-layout>
    {{ Form::open(['route' => ['provider.destroy', $providerdata->id], 'method' => 'delete', 'data--submit' => 'provider' . $providerdata->id]) }}
    <main class="main-area">
        <div class="main-content">
            <div class="container-fluid">
                @include('partials._jobs')
                <div class="card">
                    <div class="card-body p-30">
                        <div class="provider-details-overview mb-30">
                            
                            <div class="provider-details-overview__statistics">
                                <div class="statistics-card statistics-card__style2 statistics-card__pending-withdraw">
                                    <h2>{{$providerdata['total_views'] ?? 0}}</h2>
                                    <h3>{{__('Total Views')}}</h3>
                                </div>

                                <div class="statistics-card statistics-card__style2 statistics-card__already-withdraw">
                                    <h2>{{$providerdata['total_applicants'] ?? 0}}</h2>
                                    <h3>{{__('Total Application')}}</h3>
                                </div>                         
                            </div>                          
                        </div>


                        <!-- <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="information-details-box media flex-column flex-sm-row gap-20">
                                    <img class="avatar-img radius-5" src="./img/1.png" alt="" />
                                    <div class="media-body">
                                        <h2 class="information-details-box__title">
                                            {{ $providerdata->display_name }}
                                        </h2>
                                        <ul class="contact-list">
                                            <li>
                                                <i class="ri-smartphone-line"></i>
                                                <a href="{{ $providerdata->contact_number }}" class="contact-info-text p-0">{{ !empty($providerdata->contact_number) ? $providerdata->contact_number: '-' }}</a>
                                            </li>
                                            <li>
                                                <i class="ri-mail-line"></i>
                                                <a href="{{ $providerdata->email }}" class="contact-info-text p-0">{{ $providerdata->email }}</a>
                                            </li>
                                            <li>
                                                <i class="ri-map-2-line"></i>
                                                <span class="contact-info-text">{{ !empty($providerdata->address) ?$providerdata->address : '-' }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> -->
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