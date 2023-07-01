<div id="loading">
    @include('partials._body_loader')
</div>


<div id="remoteModelData" class="modal fade" role="dialog"></div>

    {{ $slot }}


@include('partials._body_footer')

@include('partials._scripts')
@include('partials._dynamic_script')
