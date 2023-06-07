<div class="page-title-wrap mb-3 p-3">
    <h2 class="page-title">{{__('Jobs Details')}}</h2>
</div>
<div class="mb-3 ms-2">
    <ul class="nav nav--tabs nav--tabs__style2 provider-detail-tab">
        <li class="nav-item {{request()->routeIs('jobs.show') ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('jobs.show',$providerdata->id) }}"> {{__('messages.overview')}}</a>
        </li>
        <li class="nav-item {{request()->routeIs('payment.details') ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('payment.details',$providerdata->id) }}"> {{__('Payment Details')}}</a>
        </li>
        <li class="nav-item {{request()->routeIs('applicant.details') ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('applicant.details',$providerdata->id) }}"> {{__('Application Lists')}}</a>
        </li>
    </ul>
</div>