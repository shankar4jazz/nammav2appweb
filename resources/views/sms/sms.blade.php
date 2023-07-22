<x-guest-layout>
<section class="login-content">
    <div class="container h-100">
       <div class="row align-items-center justify-content-center h-100">
          <div class="col-md-5">
             <div class="card p-3">
                <div class="card-body">
                   <!-- <div class="auth-logo">
                      <img src="{{ getSingleMedia(settingSession('get'),'site_logo',null) }}" class="img-fluid rounded-normal" alt="logo">
                   </div> -->
                   <!-- <h3 class="mb-3 font-weight-bold text-center">{{__('auth.get_start')}}</h3> -->
                   <!-- Session Status -->
                   <x-auth-session-status class="mb-4" :status="session('status')" />

                   <!-- Validation Errors -->
                   <x-auth-validation-errors class="mb-4" :errors="$errors" />
                   <form method="POST" action="{{ route('sent') }}" data-toggle="validator">
                   @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="mobile" class="text-secondary">{{__('Enter mobile Number')}} <span class="text-danger">*</span></label>
                                    <input class="form-control" id="mobile"  name="mobile_no" value="" required placeholder="{{ __('auth.enter_name',[ 'name' => __('mobile number') ]) }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="text class="text-secondary">{{__('Enter Text')}} <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="text"  name="text" value="" required placeholder="{{ __('auth.enter_name',[ 'name' => __('the text') ]) }}"></textarea>
                                </div>
                            </div>
                           
                      </div>
                      <button type="submit" class="btn btn-primary btn-block mt-2">{{ __('Send') }}</button>
                     
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
</x-guest-layout>
