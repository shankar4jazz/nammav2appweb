<x-data-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-start align-items-center p-3">
                                    <h5 class="font-weight-bold">{{ $pageTitle ?? trans('messages.jobs') }}</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-end align-items-center p-3">
                                  
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

    <script type="text/javascript">
        $(document).ready(function() {



            $(document).on('change', '#status', function() {

                var status = $(this).val();
                if (status == '3' || status == '4' || status == '2') {
                    document.getElementById("reason").style.display = "block";
                } else {
                    document.getElementById("reason").style.display = "none";
                }

            })

            console.log('Binding click event to .change_status buttons');
            $(document).on('click', '.change_status', function() {

                const jobId = $(this).data('job-id');
                const status = $(this).data('status');
                console.log('Job IDss:', status);
                $('#jobIdInput').val(jobId);
                $('#status').val(status);

            });

            $('#changeStatusSubmit').click(function() {
                const status = $('#status').val();
                var jobId = $('#jobIdInput').val();
                var reason = $('#reject_reason').val();
                $.ajax({
                    url: '/jobs/' + jobId + '/change-status',
                    type: 'PUT',
                    dataType: 'json',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'status': status,
                        'job_id': jobId,
                        'reason': reason
                    },
                    success: function(data) {
                        console.log(data);
                        $('#changeStatusModal').modal('hide');
                        // var table = $('#jobs-table').DataTable({
                        //     processing: true,
                        //     serverSide: true,
                        //     ajax: '{!! route("jobs.index") !!}',
                        //     name: 'jobs-table',
                        // });
                        window.LaravelDataTables['dataTableBuilder'].draw(false);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
    @endsection
</x-data-layout>
<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeStatusModalLabel">Change Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="changeStatusForm">
                    <input type="hidden" name="id" id="jobIdInput" class="job-id-input" value="">
                    <div class="form-group">
                        <label for="status">New Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="0">Pending</option>
                            <option value="1">Active</option>
                            <option value="2">Rejected</option>
                            <option value="3">Suspended</option>
                            <option value="4">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12" style="display:none" id="reason">
                        {{ Form::label('reject_reason',trans('messages.reason'), ['class' => 'form-control-label']) }}
                        {{ Form::textarea('reject_reason', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.reason') ]) }}
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="changeStatusSubmit">Save changes</button>
            </div>
        </div>
    </div>
</div>