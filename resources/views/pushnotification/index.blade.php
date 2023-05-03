<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <h5 class="font-weight-bold">{{ $pageTitle ?? __('messages.list') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body setting-pills">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <ul class="nav flex-column nav-pills nav-fill tabslink" id="tabs-text" role="tablist">
                                    @if(in_array( $page,['profile_form','password_form']))
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" data-href="{{ route('layout_page') }}?page=profile_form" data-target=".paste_here" class="nav-link {{$page=='profile_form'?'active':''}}" data-toggle="tabajax" rel="tooltip"> {{ __('messages.profile')}} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" data-href="{{ route('layout_page') }}?page=password_form" data-target=".paste_here" class="nav-link {{$page=='password_form'?'active':''}}" data-toggle="tabajax" rel="tooltip"> {{ __('messages.change_password') }} </a>
                                    </li>
                                    @else
                                    @hasanyrole('admin|demo_admin')
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" data-href="{{ route('pushnotification_layout_page') }}?page=privatejobs-push-notification" data-target=".paste_here" class="nav-link {{$page=='privatejobs-push-notification'?'active':''}}" data-toggle="tabajax" rel="tooltip"> {{ __('private jobs push notification') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" data-href="{{ route('pushnotification_layout_page') }}?page=news-push-notification" data-target=".paste_here" class="nav-link {{$page=='news-push-notification'?'active':''}}" data-toggle="tabajax" rel="tooltip"> {{ __('News push notification') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" data-href="{{ route('pushnotification_layout_page') }}?page=govtjobs-push-notification" data-target=".paste_here" class="nav-link {{$page=='govtjobs-push-notification'?'active':''}}" data-toggle="tabajax" rel="tooltip"> {{ __('Govt Jobs push notification') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" data-href="{{ route('pushnotification_layout_page') }}?page=pages-push-notification" data-target=".paste_here" class="nav-link {{$page=='pages-push-notification'?'active':''}}" data-toggle="tabajax" rel="tooltip"> {{ __('Pages push notification') }}</a>
                                    </li>
                                    @endhasanyrole
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="tab-content" id="pills-tabContent-1">
                                    <div class="tab-pane active p-1">
                                        <div class="paste_here"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('bottom_script')
    <script>
        // (function($) {
        //     "use strict";
        $(document).ready(function(event) {
            var $this = $('.nav-item').find('a.active');
            loadurl = "{{route('pushnotification_layout_page')}}?page={{$page}}";

            targ = $this.attr('data-target');

            id = this.id || '';

            $.post(loadurl, {
                '_token': $('meta[name=csrf-token]').attr('content')
            }, function(data) {
                $(targ).html(data);
            });

            $this.tab('show');
            return false;
        });
        // });
    </script>
    @endsection
</x-master-layout>