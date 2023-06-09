<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProviderTypeController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProviderLeadsController;
use App\Http\Controllers\HandymanController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProviderAddressMappingController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\ProviderDocumentController;
use App\Http\Controllers\RatingReviewController;
use App\Http\Controllers\PaymentGatewayController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\ProviderPayoutController;
use App\Http\Controllers\HandymanPayoutController;
use App\Http\Controllers\HandymanTypeController;
use App\Http\Controllers\ServiceFaqController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\JobPlanController;
use App\Http\Controllers\JobsPlansCategoryController;
use App\Http\Controllers\JobsPaymentController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\PostJobRequestController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\JobsCategoryController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\BookingOnlineController;
use App\Http\Controllers\BookingShopController;
use App\Http\Controllers\PushNotificationController;

use App\Http\Controllers\MatrimonialUsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', [HomeController::class, 'authLogin'])->name('auth.login');
    Route::get('register', [HomeController::class, 'authRegister'])->name('auth.register');
    Route::get('recover-password', [HomeController::class, 'authRecoverPassword'])->name('auth.recover-password');
    Route::get('confirm-email', [HomeController::class, 'authConfirmEmail'])->name('auth.confirm-email');
    Route::get('lock-screen', [HomeController::class, 'authlockScreen'])->name('auth.lock-screen');
});

Route::get('lang/{locale}', [HomeController::class, 'lang'])->name('switch-language');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::group(['namespace' => ''], function () {
        Route::resource('permission', PermissionController::class);
        Route::get('permission/add/{type}', [PermissionController::class, 'addPermission'])->name('permission.add');
        Route::post('permission/save', [PermissionController::class, 'savePermission'])->name('permission.save');
    });
    Route::resource('role', RoleController::class);

    Route::get('changeStatus', [HomeController::class, 'changeStatus'])->name('changeStatus');
    Route::resource('category', CategoryController::class);
    Route::post('category-action', [CategoryController::class, 'action'])->name('category.action');
    Route::resource('service', ServiceController::class);
    Route::post('service-action', [ServiceController::class, 'action'])->name('service.action');
    Route::resource('provider', ProviderController::class);
    Route::resource('providerleads', ProviderLeadsController::class);
    Route::resource('provideraddress', ProviderAddressMappingController::class);
    Route::get('provider/list/{status?}', [ProviderController::class, 'index'])->name('provider.pending');
    Route::post('provider-action', [ProviderController::class, 'action'])->name('provider.action');
    Route::resource('providertype', ProviderTypeController::class);
    Route::post('providertype-action', [ProviderTypeController::class, 'action'])->name('providertype.action');
    Route::resource('handyman', HandymanController::class);
    Route::get('handyman/list/{status?}', [HandymanController::class, 'index'])->name('handyman.pending');
    Route::post('handyman-action', [HandymanController::class, 'action'])->name('handyman.action');
    Route::resource('coupon', CouponController::class);
    Route::post('coupons-action', [CouponController::class, 'action'])->name('coupon.action');
    Route::resource('booking', BookingController::class);
    Route::resource('shop-booking', BookingShopController::class);
    Route::resource('online-booking', BookingOnlineController::class);

    Route::post('booking-status-update', [BookingController::class, 'updateStatus'])->name('bookingStatus.update');
    Route::post('booking-save', [App\Http\Controllers\BookingController::class, 'store'])->name('booking.save');
    Route::post('booking-action', [BookingController::class, 'action'])->name('booking.action');
    Route::resource('slider', SliderController::class);
    Route::post('slider-action', [SliderController::class, 'action'])->name('slider.action');
    Route::resource('payment', PaymentController::class);
    Route::resource('jobs-payment', JobsPaymentController::class);
    Route::post('jobs-payment-action', [JobsPaymentController::class, 'action'])->name('jobs-payment.action');
    Route::post('save-payment', [App\Http\Controllers\API\PaymentController::class, 'savePayment'])->name('payment.save');
    Route::resource('user', CustomerController::class);

    Route::get('user/create/quick', [CustomerController::class, 'quickCreate'])->name('user.quickcreate');
    Route::post('user/create/store', [CustomerController::class, 'quickStore'])->name('user.quick');

    Route::post('user-action', [CustomerController::class, 'action'])->name('user.action');

    Route::get('booking/booking-assign-form/{id}', [BookingController::class, 'bookingAssignForm'])->name('booking.assign_form');
    Route::post('booking-assigned', [BookingController::class, 'bookingAssigned'])->name('booking.assigned');
    Route::get('web-booking-assigned', [BookingController::class, 'webBookingAssigned'])->name('booking.webassigned');
    Route::get('details/{id}', [BookingController::class, 'bookingDetails'])->name('booking.details');
    Route::get('booking/speed/booking', [BookingController::class, 'quickBooking'])->name('quickbooking');
    Route::get('booking/speed/add-booking', [BookingController::class, 'quickAddBooking'])->name('booking.addquick');

    Route::get('comission/{id}', [SettingController::class, 'comission'])->name('setting.comission');

    // Push Notification
    Route::get('push-notification/{page?}', [PushNotificationController::class, 'setting'])->name('push-notification.index');
    // Route::post('/layout-page', [SettingController::class, 'layoutPage'])->name('pushnotification_layout_page');
    Route::post('/pushnotification-layout-page', [PushNotificationController::class, 'layoutPage'])->name('pushnotification_layout_page');
    //Route::post('/pushnotification-layout-page', [PushNotificationController::class, 'layoutPage'])->name('pushnotification_layout_page');
    Route::post('send-pvtjobspush-notification', [PushNotificationController::class, 'sendPvtJobsPushNotification'])->name('sendPvtJobsPushNotification');
    Route::post('send-govtobspush-notification', [PushNotificationController::class, 'sendGovtJobsPushNotification'])->name('sendGovtJobsPushNotification');
    Route::post('send-newspush-notification', [PushNotificationController::class, 'sendNewsPushNotification'])->name('sendNewsPushNotification');
    Route::post('send-pagepush-notification', [PushNotificationController::class, 'sendPagePushNotification'])->name('sendPagePushNotification');

    // Setting
    Route::get('setting/{page?}', [SettingController::class, 'settings'])->name('setting.index');
    Route::post('/layout-page', [SettingController::class, 'layoutPage'])->name('layout_page');
    // Route::post('/layout-page', [SettingController::class, 'layoutPage'])->name('layout_page');
    Route::post('settings/save', [SettingController::class, 'settingsUpdates'])->name('settingsUpdates');
    Route::post('dashboard-setting', [SettingController::class, 'dashboardtogglesetting'])->name('togglesetting');
    Route::post('provider-dashboard-setting', [SettingController::class, 'providerdashboardtogglesetting'])->name('providertogglesetting');
    Route::post('handyman-dashboard-setting', [SettingController::class, 'handymandashboardtogglesetting'])->name('handymantogglesetting');
    Route::post('config-save', [SettingController::class, 'configUpdate'])->name('configUpdate');

    Route::post('env-setting', [SettingController::class, 'envChanges'])->name('envSetting');
    Route::post('update-profile', [SettingController::class, 'updateProfile'])->name('updateProfile');
    Route::post('change-password', [SettingController::class, 'changePassword'])->name('changePassword');

    Route::get('notification-list', [NotificationController::class, 'notificationList'])->name('notification.list');
    Route::get('notification-counts', [NotificationController::class, 'notificationCounts'])->name('notification.counts');
    Route::get('notification', [NotificationController::class, 'index'])->name('notification.index');

    Route::post('remove-file', [App\Http\Controllers\HomeController::class, 'removeFile'])->name('remove.file');
    Route::post('get-lang-file', [App\Http\Controllers\LanguageController::class, 'getFile'])->name('getLangFile');
    Route::post('save-lang-file', [App\Http\Controllers\LanguageController::class, 'saveFileContent'])->name('saveLangContent');

    Route::get('pages/term-condition', [SettingController::class, 'termAndCondition'])->name('term-condition');
    Route::post('term-condition-save', [SettingController::class, 'saveTermAndCondition'])->name('term-condition-save');

    Route::get('pages/privacy-policy', [SettingController::class, 'privacyPolicy'])->name('privacy-policy');
    Route::post('privacy-policy-save', [SettingController::class, 'savePrivacyPolicy'])->name('privacy-policy-save');

    Route::get('pages/help-support', [SettingController::class, 'helpAndSupport'])->name('help-support');
    Route::post('help-support-save', [SettingController::class, 'saveHelpAndSupport'])->name('help-support-save');

    Route::get('pages/refund-cancellation-policy', [SettingController::class, 'refundCancellationPolicy'])->name('refund-cancellation-policy');
    Route::post('refund-cancellation-policy-save', [SettingController::class, 'saveRefundCancellationPolicy'])->name('refund-cancellation-policy-save');

    Route::resource('document', DocumentsController::class);
    Route::post('document-action', [DocumentsController::class, 'action'])->name('document.action');

    Route::resource('providerdocument', ProviderDocumentController::class);
    Route::post('providerdocument-action', [ProviderDocumentController::class, 'action'])->name('providerdocument.action');

    Route::resource('ratingreview', RatingReviewController::class);
    Route::post('ratingreview-action', [RatingReviewController::class, 'action'])->name('ratingreview.action');

    Route::post('/payment-layout-page', [PaymentGatewayController::class, 'paymentPage'])->name('payment_layout_page');
    Route::post('payment-settings/save', [PaymentGatewayController::class, 'paymentsettingsUpdates'])->name('paymentsettingsUpdates');
    Route::post('get_payment_config', [PaymentGatewayController::class, 'getPaymentConfig'])->name('getPaymentConfig');

    Route::resource('tax', TaxController::class);
    Route::get('earning', [EarningController::class, 'index'])->name('earning');
    Route::get('earning-data', [EarningController::class, 'setEarningData'])->name('earningData');

    Route::get('handyman-earning', [EarningController::class, 'handymanEarning'])->name('handymanEarning');
    Route::get('handyman-earning-data', [EarningController::class, 'handymanEarningData'])->name('handymanEarningData');

    Route::resource('providerpayout', ProviderPayoutController::class);
    Route::get('review/{id}', [ProviderController::class, 'review'])->name('provider.review');
    Route::get('providerpayout/create/{id}', [ProviderPayoutController::class, 'create'])->name('providerpayout.create');
    Route::post('sidebar-reorder-save', [SettingController::class, 'sequenceSave'])->name('reorderSave');

    Route::resource('handymanpayout', HandymanPayoutController::class);
    Route::get('handymanpayout/create/{id}', [HandymanPayoutController::class, 'create'])->name('handymanpayout.create');

    Route::resource('handymantype', HandymanTypeController::class);
    Route::post('handymantype-action', [HandymanTypeController::class, 'action'])->name('handymantype.action');

    Route::resource('servicefaq', ServiceFaqController::class);
    Route::post('send-push-notification', [SettingController::class, 'sendPushNotification'])->name('sendPushNotification');
    Route::post('save-earning-setting', [SettingController::class, 'saveEarningTypeSetting'])->name('saveEarningTypeSetting');

    Route::resource('wallet', WalletController::class);
    Route::resource('subcategory', SubCategoryController::class);
    Route::post('subcategory-action', [SubCategoryController::class, 'action'])->name('subcategory.action');

    Route::resource('plans', PlanController::class);
    Route::resource('jobs-plans', JobPlanController::class);
    Route::resource('jobs-plans-category', JobsPlansCategoryController::class);
    Route::resource('bank', BankController::class);
    Route::post('bank-action', [BankController::class, 'action'])->name('bank.action');

    Route::get('frontend/app-download', [FrontendController::class, 'appDownloadPage'])->name('app-download');
    Route::post('app-download-save', [FrontendController::class, 'saveAppDownloadPage'])->name('app-download-save');
    Route::get('/provider-detail-page', [ProviderController::class, 'providerDetail'])->name('provider_detail_pages');

    Route::post('/provider-detail-page', [ProviderController::class, 'providerDetail'])->name('provider_detail_pages');
    Route::post('/booking-layout-page/{id}', [BookingController::class, 'bookingstatus'])->name('booking_layout_page');
    Route::get('/invoice_pdf/{id}', [BookingController::class, 'createPDF'])->name('invoice_pdf');
    Route::resource('post-job-request', PostJobRequestController::class);

    Route::resource('products', ProductController::class);

    Route::resource('orders', OrderController::class);
    Route::get('orders/order-assign-form/{id}', [OrderController::class, 'orderAssignForm'])->name('order.assign_form');
    Route::post('order-assigned', [OrderController::class, 'orderAssigned'])->name('order.assigned');
    Route::post('web-order-assigned', [OrderController::class, 'webOrderAssigned'])->name('order.webassigned');
    Route::post('order-action', [OrderController::class, 'action'])->name('order.action');


    Route::resource('news-categories', NewsCategoryController::class);
    Route::resource('news', NewsController::class);
    Route::post('news-categories-action', [NewsCategoryController::class, 'action'])->name('news_categories.action');
    Route::post('news-action', [NewsController::class, 'action'])->name('news.action');


    Route::resource('jobs-categories', JobsCategoryController::class);
    Route::post('jobs-categories-action', [JobsCategoryController::class, 'action'])->name('jobs_categories.action');

    Route::resource('jobs', JobsController::class);
    Route::put('/jobs/{id}/change-status', [JobsController::class, 'changeStatus'])->name('jobs.change_status');

    Route::post('jobs-action', [JobsController::class, 'action'])->name('jobs.action');
    Route::get('jobs/quick/process', [JobsController::class, 'quickJob'])->name('jobs.quick');
    Route::get('jobs/quick/add', [JobsController::class, 'quickJobAdd'])->name('jobs.jobadd');
    Route::get('jobs/quick/store', [JobsController::class, 'quickStoreJob'])->name('jobs.storequick');
  
    Route::get('applicant-details/{id}', [JobsController::class, 'applicantDetails'])->name('applicant.details');

    Route::resource('matrimonial', MatrimonialUsersController::class);
});
Route::get('/ajax-list', [HomeController::class, 'getAjaxList'])->name('ajax-list');
Route::get('clear_cache', function () {

    Artisan::call('cache:clear');
    //dd("Cache is cleared");
    Artisan::call('route:clear');
    //dd("Cache is cleared");
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    dd("config is cleared");
});
