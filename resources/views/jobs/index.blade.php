<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-start align-items-center p-3 ">

                                    <h5 class="font-weight-bold">{{ $pageTitle ?? trans('messages.jobs') }}</h5>


                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-end align-items-center p-3">
                                    @if($auth_user->can('jobs add'))
                                    <a href="{{ route('jobs.quick') }}" class="float-right mr-1 btn btn-sm btn-danger"><i class="fa fa-plus-circle"></i> {{ trans('messages.add_form_title',['form' => trans('messages.quick_jobs')  ]) }}</a>
                                    <a href="{{ route('jobs.create') }}" class="float-right mr-1 btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> {{ trans('messages.add_form_title',['form' => trans('messages.jobs')  ]) }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ $dataTable->table(['class' => 'table  w-100'],false) }}
                </div>
            </div>
        </div>
    </div>
    </div>
    @section('bottom_script')
    {{ $dataTable->scripts() }}
    @endsection
</x-master-layout>