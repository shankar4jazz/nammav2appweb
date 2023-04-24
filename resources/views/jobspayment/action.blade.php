<?php
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
{{ Form::close() }}