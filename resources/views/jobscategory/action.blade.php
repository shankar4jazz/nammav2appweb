
<?php
    $auth_user= authSession();
?>
{{ Form::open(['route' => ['jobs-categories.destroy', $category->id], 'method' => 'delete','data--submit'=>'category'.$category->id]) }}
<div class="d-flex justify-content-end align-items-center">
    @if(!$category->trashed())
        @if($auth_user->can('jobs categories edit'))
        <a class="mr-2" href="{{ route('jobs-categories.create',['id' => $category->id]) }}" title="{{ __('messages.update_form_title',['form' => __('messages.jobs_category') ]) }}"><i class="fas fa-pen text-primary"></i></a>
        @endif

        @if($auth_user->can('jobs categories delete'))
        <a class="mr-2" href="javascript:void(0)" data--submit="category{{$category->id}}" 
            data--confirmation='true' data-title="{{ __('messages.delete_form_title',['form'=>  __('messages.jobs_category') ]) }}"
            title="{{ __('messages.delete_form_title',['form'=>  __('messages.jobs_category') ]) }}"
            data-message='{{ __("messages.delete_msg") }}'>
            <i class="far fa-trash-alt text-danger"></i>
        </a>
        @endif
    @endif
    @if(auth()->user()->hasAnyRole(['admin']) && $category->trashed())
        <a href="{{ route('jobs_categories.action',['id' => $category->id, 'type' => 'restore']) }}"
            title="{{ __('messages.restore_form_title',['form' => __('messages.jobs_category') ]) }}"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="{{ __('messages.restore_form_title',['form'=>  __('messages.jobs_category') ]) }}"
            data-message='{{ __("messages.restore_msg") }}'
            data-datatable="reload"
            class="mr-2">
            <i class="fas fa-redo text-secondary"></i>
        </a>
        <a href="{{ route('jobs_categories.action',['id' => $category->id, 'type' => 'forcedelete']) }}"
            title="{{ __('messages.forcedelete_form_title',['form' => __('messages.jobs_category') ]) }}"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="{{ __('messages.forcedelete_form_title',['form'=>  __('messages.jobs_category') ]) }}"
            data-message='{{ __("messages.forcedelete_msg") }}'
            data-datatable="reload"
            class="mr-2">
            <i class="far fa-trash-alt text-danger"></i>
        </a>
    @endif
</div>
{{ Form::close() }}