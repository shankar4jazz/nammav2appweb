<!-- <?php
$auth_user = authSession();
?>
{{ Form::open(['route' => ['jobs-payment.destroy', $payment->id], 'method' => 'delete','data--submit'=>'plan'.$payment->id]) }}
<div class="d-flex justify-content-end align-items-center">
    @if(auth()->user()->hasAnyRole(['admin']))
    <a class="mr-2" href="{{ route('jobs-payment.create',['id' => $payment->id]) }}" title="{{ __('messages.update_form_title',['form' => __('messages.plan') ]) }}"><i class="fas fa-pen text-primary"></i></a>
    <a class="mr-2" href="javascript:void(0)" data--submit="plan{{$payment->id}}" data--confirmation='true' data-title="{{ __('messages.delete_form_title',['form'=>  __('messages.plan') ]) }}" title="{{ __('messages.delete_form_title',['form'=>  __('messages.plan') ]) }}" data-message='{{ __("messages.delete_msg") }}'>
        <i class="far fa-trash-alt text-danger"></i>
    </a>
    @endif
</div>
{{ Form::close() }} -->



<?php
    $auth_user= authSession();
?>
{{ Form::open(['route' => ['jobs-payment.destroy', $payment->id], 'method' => 'delete','data--submit'=>'category'.$payment->id]) }}
<div class="d-flex justify-content-end align-items-center">
    @if(!$payment->trashed())
        @if($auth_user->can('jobs edit'))
        <a class="mr-2" href="{{ route('jobs-payment.create',['id' => $payment->id]) }}" title="{{ __('messages.update_form_title',['form' => __('messages.jobs') ]) }}"><i class="fas fa-pen text-primary"></i></a>
        @endif

        @if($auth_user->can('jobs delete'))
        <a class="mr-2" href="javascript:void(0)" data--submit="category{{$payment->id}}" 
            data--confirmation='true' data-title="{{ __('messages.delete_form_title',['form'=>  __('jobs payment') ]) }}"
            title="{{ __('messages.delete_form_title',['form'=>  __('jobs payment') ]) }}"
            data-message='{{ __("messages.delete_msg") }}'>
            <i class="far fa-trash-alt text-danger"></i>
        </a>
        @endif
    @endif
    @if(auth()->user()->hasAnyRole(['admin']) && $payment->trashed())
        <a href="{{ route('jobs-payment.action',['id' => $payment->id, 'type' => 'restore']) }}"
            title="{{ __('messages.restore_form_title',['form' => __('jobs payment') ]) }}"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="{{ __('messages.restore_form_title',['form'=>  __('jobs payment') ]) }}"
            data-message='{{ __("messages.restore_msg") }}'
            data-datatable="reload"
            class="mr-2">
            <i class="fas fa-redo text-secondary"></i>
        </a>
        <a href="{{ route('jobs-payment.action',['id' => $payment->id, 'type' => 'forcedelete']) }}"
            title="{{ __('messages.forcedelete_form_title',['form' => __('jobs payment') ]) }}"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="{{ __('messages.forcedelete_form_title',['form'=>  __('jobs payment') ]) }}"
            data-message='{{ __("messages.forcedelete_msg") }}'
            data-datatable="reload"
            class="mr-2">
            <i class="far fa-trash-alt text-danger"></i>
        </a>
    @endif
</div>
{{ Form::close() }}