<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\API;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
normal api_token
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
require __DIR__.'/admin-api.php';
Route::get('jobs-plan-list', [API\JobsPlanController::class, 'jobsPlanList']);
Route::post('jobs-save-payment',[API\JobsPaymentController::class, 'savePayment']);
Route::post('save-call-activities',[API\JobCallActivitiesController::class, 'saveCallActivities']);
Route::post('get-call-activities',[API\JobCallActivitiesController::class, 'getCallActivitiesByJobId']);
//jobs-reports
Route::post('save-reports',[API\JobsReportsController::class, 'saveReports']);
Route::post('get-reports',[API\JobsReportsController::class, 'getReports']);
//news

Route::get('news-category-list',[API\NewsCategoryController::class,'getCategoryList']);
Route::get('news-list',[ API\NewsController::class, 'getNewsList' ]);
Route::post('categorynews-list',[ API\NewsController::class, 'getNewsListByCategory' ]);
Route::get('test-news-list',[ API\NewsController::class, 'getNewsListTest']);
Route::post('city-news-list',[ API\JobsController::class, 'getNewsListByCity']);
Route::post('user-news-list',[ API\JobsController::class, 'getNewsListByUser']);
//end news
Route::get('jobcategory-list',[API\JobCategoryController::class,'getCategoryList']);
Route::post('save-jobs',[ App\Http\Controllers\JobsController::class, 'store' ]);
Route::post('add-jobs',[ App\Http\Controllers\JobsController::class, 'saveJobPost' ]);
Route::post('create-jobs',[ App\Http\Controllers\TamilanJobsController::class, 'store' ]);
Route::get('jobs-list',[ API\JobsController::class, 'getJobsList' ]);
Route::get('jobs-view/{slug}',[ API\JobsController::class, 'getJobsListBySlug' ]);
Route::get('jobs/{slug}',[ API\JobsController::class, 'getJobsListBySlugUrl' ]);
Route::post('citywise-jobs-list',[ API\JobsController::class, 'getJobsListByCity']);
Route::post('category-city-jobs-list',[ API\JobsController::class, 'getJobsListByCityAndCategory']);
Route::post('user-jobs-list',[ API\JobsController::class, 'getJobsListByUser']);
Route::post('company-list',[ API\CompanyController::class, 'getCompanyByUser']);

Route::post('add-company',[ API\CompanyController::class, 'addCompany']);

Route::get('category-list',[API\CategoryController::class,'getCategoryList']);
Route::get('subcategory-list',[API\SubCategoryController::class,'getSubCategoryList']);
Route::get('service-list',[API\ServiceController::class,'getServiceList']);
Route::get('type-list',[API\CommanController::class,'getTypeList']);


Route::post('country-list',[ API\CommanController::class, 'getCountryList']);
Route::post('state-list',[ API\CommanController::class, 'getStateList']);
Route::get('district-list',[ API\CommanController::class, 'getDistrictList']);
Route::post('city-list',[ API\CommanController::class, 'getCityList' ]);
Route::post('getcity-lists',[ API\CommanController::class, 'getCityListByDistrictId' ]);
Route::get('search-list', [ API\CommanController::class, 'getSearchList']);
Route::get('slider-list',[ API\SliderController::class, 'getSliderList']);
Route::get('top-rated-service',[ API\ServiceController::class, 'getTopRatedService']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[API\User\UserController::class, 'register']);
Route::post('login',[API\User\UserController::class,'login']);
Route::post('mobile-verification',[API\User\UserController::class,'mobileLogin']);
Route::post('otp-validation',[API\User\UserController::class,'verifyOtp']);
Route::post('forgot-password',[ API\User\UserController::class,'forgotPassword']);
Route::post('social-login',[ API\User\UserController::class, 'socialLogin' ]);
Route::post('contact-us', [ API\User\UserController::class, 'contactUs' ] );


Route::get('dashboard-detail',[ API\DashboardController::class, 'dashboardDetail' ]);
Route::get('service-rating-list',[API\ServiceController::class,'getServiceRating']);
Route::get('user-detail',[API\User\UserController::class, 'userDetail']);
Route::post('service-detail', [ API\ServiceController::class, 'getServiceDetail' ] );
Route::get('user-list',[API\User\UserController::class, 'userList']);
Route::get('booking-status', [ API\BookingController::class, 'bookingStatus' ] );
Route::post('handyman-reviews',[API\User\UserController::class, 'handymanReviewsList']);
Route::post('service-reviews', [ API\ServiceController::class, 'serviceReviewsList' ] );
Route::get('post-job-status', [ API\PostJobRequestController::class, 'postRequestStatus' ] );


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('service-save', [ App\Http\Controllers\ServiceController::class, 'store' ] );
    Route::post('service-save', [ App\Http\Controllers\ServiceController::class, 'store' ] );
    Route::post('service-delete/{id}', [ App\Http\Controllers\ServiceController::class, 'destroy' ] );
    Route::post('booking-save', [ App\Http\Controllers\BookingController::class, 'store' ] );
    Route::post('booking-update', [ API\BookingController::class, 'bookingUpdate' ] );
    Route::get('provider-dashboard',[ API\DashboardController::class, 'providerDashboard' ]);
    Route::get('admin-dashboard',[ API\DashboardController::class, 'adminDashboard' ]);
    Route::get('booking-list', [ API\BookingController::class, 'getBookingList' ] );
    Route::post('booking-detail', [ API\BookingController::class, 'getBookingDetail' ] );
    Route::post('save-booking-rating', [ API\BookingController::class, 'saveBookingRating' ] );
    Route::post('delete-booking-rating', [ API\BookingController::class, 'deleteBookingRating' ] );

    Route::post('save-favourite',[ API\ServiceController::class, 'saveFavouriteService' ]);
    Route::post('delete-favourite',[ API\ServiceController::class, 'deleteFavouriteService' ]);
    Route::get('user-favourite-service',[ API\ServiceController::class, 'getUserFavouriteService' ]);

    Route::post('booking-action',[ API\BookingController::class, 'action' ] );

    Route::post('booking-assigned',[ App\Http\Controllers\BookingController::class,'bookingAssigned'] );

    Route::post('user-update-status',[API\User\UserController::class, 'userStatusUpdate']);
    Route::post('change-password',[API\User\UserController::class, 'changePassword']);
    Route::post('update-profile',[API\User\UserController::class,'updateProfile']);
    Route::post('notification-list',[API\NotificationController::class,'notificationList']);
    Route::post('remove-file', [ App\Http\Controllers\HomeController::class, 'removeFile' ] );
    Route::get('logout',[ API\User\UserController::class, 'logout' ]);

    Route::post('save-payment',[API\PaymentController::class, 'savePayment']);
    Route::get('payment-list',[API\PaymentController::class, 'paymentList']);


    Route::post('save-provideraddress', [ App\Http\Controllers\ProviderAddressMappingController::class, 'store' ]);
    Route::get('provideraddress-list', [ API\ProviderAddressMappingController::class, 'getProviderAddressList' ]);
    Route::post('provideraddress-delete/{id}', [ App\Http\Controllers\ProviderAddressMappingController::class, 'destroy' ]);
    Route::post('save-handyman-rating', [ API\BookingController::class, 'saveHandymanRating' ] );
    Route::post('delete-handyman-rating', [ API\BookingController::class, 'deleteHandymanRating' ] );

    Route::get('document-list', [ API\DocumentsController::class, 'getDocumentList' ] );
    Route::get('provider-document-list', [ API\ProviderDocumentController::class, 'getProviderDocumentList' ] );
    Route::post('provider-document-save', [ App\Http\Controllers\ProviderDocumentController::class, 'store' ] );
    Route::post('provider-document-delete/{id}', [ App\Http\Controllers\ProviderDocumentController::class, 'destroy' ] );
    Route::post('provider-document-action',[ App\Http\Controllers\ProviderDocumentController::class, 'action' ]);

    Route::get('tax-list',[ API\CommanController::class, 'getProviderTax' ]);
    Route::get('handyman-dashboard',[ API\DashboardController::class, 'handymanDashboard' ]);

    Route::post('customer-booking-rating',[ API\BookingController::class, 'bookingRatingByCustomer' ]);
    Route::post('handyman-delete/{id}',[ App\Http\Controllers\HandymanController::class, 'destroy' ]);
    Route::post('handyman-action',[ App\Http\Controllers\HandymanController::class, 'action' ]);

    Route::get('provider-payout-list', [ API\PayoutController::class, 'providerPayoutList' ] );
    Route::get('handyman-payout-list', [ API\PayoutController::class, 'handymanPayoutList' ] );

    Route::get('plan-list', [ API\PlanController::class, 'planList' ] );
   
    Route::post('save-subscription', [ API\SubscriptionController::class, 'providerSubscribe' ] );
    Route::post('cancel-subscription', [ API\SubscriptionController::class, 'cancelSubscription' ] );
    Route::get('subscription-history', [ API\SubscriptionController::class, 'getHistory' ] );
    Route::get('wallet-history', [ API\WalletController::class, 'getHistory' ] );

    Route::post('save-service-proof', [ API\BookingController::class, 'uploadServiceProof' ] );
    Route::post('handyman-update-available-status',[API\User\UserController::class, 'handymanAvailable']);
    Route::post('delete-user-account',[API\User\UserController::class, 'deleteUserAccount']);
    Route::post('delete-account',[API\User\UserController::class, 'deleteAccount']);
	Route::post('delete-jobs-account', [API\User\UserController::class, 'deleteJobsAccount']);

    Route::post('save-post-job',[ App\Http\Controllers\PostJobRequestController::class, 'store' ]);
    Route::post('post-job-delete/{id}', [ App\Http\Controllers\PostJobRequestController::class, 'destroy' ]);

    Route::get('get-post-job',[ API\PostJobRequestController::class, 'getPostRequestList' ]);
    Route::post('get-post-job-detail',[ API\PostJobRequestController::class, 'getPostRequestDetail' ]);

    Route::post('save-bid',[  App\Http\Controllers\PostJobBidController::class, 'store' ]);
    Route::get('get-bid-list',[  API\PostJobBidController::class, 'getPostBidList' ]);


    Route::post('save-provider-slot', [ App\Http\Controllers\ProviderSlotController::class, 'store'] );
    Route::get('get-provider-slot', [API\ProviderSlotController::class, 'getProviderSlot' ] );

});
