<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\API;
use Symfony\Component\HttpFoundation\StreamedResponse;
use L5Swagger\Http\Controllers\SwaggerController;
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

/**
 * @OA\Get(
 *   path="/api/users",
 *   tags={"Users"},
 *   summary="Get all users",
 *   @OA\Response(response="200", description="Successful operation"),
 *   @OA\Response(response="401", description="Unauthenticated"),
 * )
 */
require __DIR__ . '/admin-api.php';

Route::post('upload-resume', [API\User\UserController::class, 'uploadResume']);
Route::get('message-lists', [API\MessageListsController::class, 'messageList']);

Route::get('jobs-plan-list', [API\JobsPlanController::class, 'planLists']);
Route::get('get-plan-list', [API\JobsPlanController::class, 'jobsPlanList']);
Route::post('jobs-save-payment', [API\JobsPaymentController::class, 'savePayment']);
Route::post('check-jobs-payment', [API\JobsPaymentController::class, 'checkPayment']);
Route::post('save-call-activities', [API\JobCallActivitiesController::class, 'saveCallActivities']);
Route::post('get-call-activities', [API\JobCallActivitiesController::class, 'getCallActivitiesByJobId']);


//jobs-expiry
Route::get('today-expiry', [API\JobsController::class, 'notifyUsersOfExpiringTodayJobs']);
Route::get('tmrw-expiry', [API\JobsController::class, 'notifyUsersOfExpiringTmrwJobs']);
Route::get('jobs-expiry', [API\JobsController::class, 'jobsExpire']);
Route::get('jobs-expiry-date', [API\JobsController::class, 'jobsExpireData']);

//jobs-reports
Route::post('save-reports', [API\JobsReportsController::class, 'saveReports']);
Route::post('get-reports', [API\JobsReportsController::class, 'getReports']);
//news
Route::post('news-save', [API\NewsController::class, 'saveNews']);
Route::get('news-category-list', [API\NewsCategoryController::class, 'getCategoryList']);
Route::get('news-list', [API\NewsController::class, 'getNewsList']);
Route::get('get-news-list', [API\NewsController::class, 'getAllNewsList']);
Route::post('categorynews-list', [API\NewsController::class, 'getNewsListByCategory']);
Route::get('test-news-list', [API\NewsController::class, 'getNewsListTest']);
Route::post('city-news-list', [API\JobsController::class, 'getNewsListByCity']);
Route::post('user-news-list', [API\NewsController::class, 'getNewsListByUser']);
//end news
Route::get('jobcategory-list', [API\JobCategoryController::class, 'getCategoryList']);
Route::get('jobs-list', [API\JobsController::class, 'getJobsList']);
Route::get('featured-joblists', [API\JobsController::class, 'getFeatureJobs']);
Route::get('jobs-view/{slug}', [API\JobsController::class, 'getJobsListBySlug']);
Route::get('get-jobs/{id}/{user_id}', [API\JobsController::class, 'getJobById']);
Route::get('jobs/{slug}', [API\JobsController::class, 'getJobsListBySlugUrl']);
Route::post('citywise-jobs-list', [API\JobsController::class, 'getJobsListByCity']);
Route::post('category-city-jobs-list', [API\JobsController::class, 'getJobsListByCityAndCategory']);
Route::post('categories-cities-jobs-list', [API\JobsController::class, 'getJobsListByCityAndCategorySlug']);
Route::post('get-filter-district', [API\JobsController::class, 'getJobsListByCities']);
Route::post('your-jobs-list', [API\JobsController::class, 'jobseerkerJobsForYou']);
Route::post('city-all-jobs-list', [API\JobsController::class, 'getJobsListAllCities']);

Route::post('user-jobs-list', [API\JobsController::class, 'getJobsListByUser']);
Route::post('company-list', [API\CompanyController::class, 'getCompanyByUser']);
Route::post('add-company', [API\CompanyController::class, 'addCompany']);

Route::get('category-list', [API\CategoryController::class, 'getCategoryList']);
Route::get('subcategory-list', [API\SubCategoryController::class, 'getSubCategoryList']);
Route::get('service-list', [API\ServiceController::class, 'getServiceList']);
Route::get('featured-service-list', [API\ServiceController::class, 'getServiceList']);
Route::get('type-list', [API\CommanController::class, 'getTypeList']);
Route::get('get-payment-config', [API\CommanController::class, 'getPaymentConfig']);

Route::post('country-list', [API\CommanController::class, 'getCountryList']);
Route::post('state-list', [API\CommanController::class, 'getStateList']);
Route::get('district-list', [API\CommanController::class, 'getDistrictList']);
Route::get('get-district', [API\CommanController::class, 'getDistrictListByStateId']);
Route::get('city-list', [API\CommanController::class, 'getCityList']);

Route::get('education-categories', [API\CommanController::class, 'getEducationCategory']);
Route::post('getcity-lists', [API\CommanController::class, 'getCityListByDistrictId']);
Route::get('search-list', [API\CommanController::class, 'getSearchList']);
Route::get('slider-list', [API\SliderController::class, 'getSliderList']);
Route::get('top-rated-service', [API\ServiceController::class, 'getTopRatedService']);
Route::post('provider-leads', [API\ProviderLeadsController::class, 'saveLeads']);
Route::post('qualifications', [API\QualificationController::class, 'getQualificationsList']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::Post('message-sent', [API\SmsController::class, 'sendSms']);
Route::post('register', [API\User\UserController::class, 'register']);
Route::post('login', [API\User\UserController::class, 'login']);
Route::post('truecaller-login', [API\User\UserController::class, 'trueCallerLogin']);
Route::post('mobile-verification', [API\User\UserController::class, 'mobileLogin']);
Route::post('otp-validation', [API\User\UserController::class, 'verifyOtp']);
Route::post('forgot-password', [API\User\UserController::class, 'forgotPassword']);
Route::post('social-login', [API\User\UserController::class, 'socialLogin']);
Route::post('contact-us', [API\User\UserController::class, 'contactUs']);
Route::post('save-devices', [API\UserDevicesController::class, 'saveUserActivies']);

Route::get('dashboard-detail', [API\DashboardController::class, 'dashboardDetail']);
Route::get('service-rating-list', [API\ServiceController::class, 'getServiceRating']);
Route::get('user-detail', [API\User\UserController::class, 'userDetail']);
Route::get('jobseeker-detail/{id}', [API\User\UserController::class, 'jobseekerDetails']);
Route::post('service-detail', [API\ServiceController::class, 'getServiceDetail']);
Route::get('user-list', [API\User\UserController::class, 'userList']);
Route::get('booking-status', [API\BookingController::class, 'bookingStatus']);
Route::post('handyman-reviews', [API\User\UserController::class, 'handymanReviewsList']);
Route::post('service-reviews', [API\ServiceController::class, 'serviceReviewsList']);
Route::get('post-job-status', [API\PostJobRequestController::class, 'postRequestStatus']);
Route::get('get-version', [API\CommanController::class, 'getVersion']);
Route::get('job-invoice/{id}', [App\Http\Controllers\JobsController::class, 'createPDF']);

Route::get('/sse-version', function () {
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');

    $versionData = json_decode(file_get_contents(storage_path('app/version.json')), true);
    $updatedVersion = $versionData['version']; // Replace with your updated version

    $response = new StreamedResponse(function () use ($updatedVersion) {
        // Send the SSE event with the updated version        
        echo  json_encode(['version' => $updatedVersion]);
        flush();
    });

    return $response;
});

Route::post('apply-jobs', [API\JobCallActivitiesController::class, 'getCallActivitiesByJobseekerId']);

Route::post('education-jobseekers', [API\JobseekerController::class, 'getJobseekerDetailsByEducation']);
Route::post('jobcategory-jobseekers', [API\JobseekerController::class, 'getJobseekerDetailsByJobcategory']);

Route::get('access-plans', [API\AccessPlanController::class, 'jobsPlanLists']);
Route::group(['middleware' => ['auth:sanctum']], function () {
        
    Route::post('apply-status', [API\JobCallActivitiesController::class, 'setStatus']);
    Route::get('job-invoice/{id}', [App\Http\Controllers\JobsController::class, 'createPDF']);
    Route::post('save-jobs', [App\Http\Controllers\JobsController::class, 'store']);
    Route::post('add-jobs', [App\Http\Controllers\JobsController::class, 'saveJobPost']);

    Route::post('create-jobs', [App\Http\Controllers\TamilanJobsController::class, 'store']);
    Route::post('service-save', [App\Http\Controllers\ServiceController::class, 'store']);
    Route::post('service-save', [App\Http\Controllers\ServiceController::class, 'store']);
    Route::post('service-delete/{id}', [App\Http\Controllers\ServiceController::class, 'destroy']);
    Route::post('booking-save', [App\Http\Controllers\BookingController::class, 'store']);
    Route::post('booking-update', [API\BookingController::class, 'bookingUpdate']);
    Route::get('provider-dashboard', [API\DashboardController::class, 'providerDashboard']);
    Route::get('admin-dashboard', [API\DashboardController::class, 'adminDashboard']);
    Route::get('booking-list', [API\BookingController::class, 'getBookingList']);
    Route::post('booking-detail', [API\BookingController::class, 'getBookingDetail']);
    Route::post('save-booking-rating', [API\BookingController::class, 'saveBookingRating']);
    Route::post('delete-booking-rating', [API\BookingController::class, 'deleteBookingRating']);
    Route::post('save-favourite', [API\ServiceController::class, 'saveFavouriteService']);
    Route::post('delete-favourite', [API\ServiceController::class, 'deleteFavouriteService']);
    Route::get('user-favourite-service', [API\ServiceController::class, 'getUserFavouriteService']);
    Route::post('booking-action', [API\BookingController::class, 'action']);
    Route::post('booking-assigned', [App\Http\Controllers\BookingController::class, 'bookingAssigned']);
    Route::post('user-update-status', [API\User\UserController::class, 'userStatusUpdate']);
    Route::post('change-password', [API\User\UserController::class, 'changePassword']);
    Route::post('update-profile', [API\User\UserController::class, 'updateProfile']);
    Route::post('notification-list', [API\NotificationController::class, 'notificationList']);
    Route::post('remove-file', [App\Http\Controllers\HomeController::class, 'removeFile']);
    Route::get('logout', [API\User\UserController::class, 'logout']);

    Route::post('save-payment', [API\PaymentController::class, 'savePayment']);
    Route::get('payment-list', [API\PaymentController::class, 'paymentList']);
    Route::post('save-provideraddress', [App\Http\Controllers\ProviderAddressMappingController::class, 'store']);
    Route::get('provideraddress-list', [API\ProviderAddressMappingController::class, 'getProviderAddressList']);
    Route::post('provideraddress-delete/{id}', [App\Http\Controllers\ProviderAddressMappingController::class, 'destroy']);
    Route::post('save-handyman-rating', [API\BookingController::class, 'saveHandymanRating']);
    Route::post('delete-handyman-rating', [API\BookingController::class, 'deleteHandymanRating']);

    Route::get('document-list', [API\DocumentsController::class, 'getDocumentList']);
    Route::get('provider-document-list', [API\ProviderDocumentController::class, 'getProviderDocumentList']);
    Route::post('provider-document-save', [App\Http\Controllers\ProviderDocumentController::class, 'store']);
    Route::post('provider-document-delete/{id}', [App\Http\Controllers\ProviderDocumentController::class, 'destroy']);
    Route::post('provider-document-action', [App\Http\Controllers\ProviderDocumentController::class, 'action']);

    Route::get('tax-list', [API\CommanController::class, 'getProviderTax']);
    Route::get('handyman-dashboard', [API\DashboardController::class, 'handymanDashboard']);

    Route::post('customer-booking-rating', [API\BookingController::class, 'bookingRatingByCustomer']);
    Route::post('handyman-delete/{id}', [App\Http\Controllers\HandymanController::class, 'destroy']);
    Route::post('handyman-action', [App\Http\Controllers\HandymanController::class, 'action']);

    Route::get('provider-payout-list', [API\PayoutController::class, 'providerPayoutList']);
    Route::get('handyman-payout-list', [API\PayoutController::class, 'handymanPayoutList']);

    Route::get('plan-list', [API\PlanController::class, 'planList']);
 

    Route::post('save-subscription', [API\SubscriptionController::class, 'providerSubscribe']);
    Route::post('cancel-subscription', [API\SubscriptionController::class, 'cancelSubscription']);
    Route::get('subscription-history', [API\SubscriptionController::class, 'getHistory']);
    Route::get('wallet-history', [API\WalletController::class, 'getHistory']);

    Route::post('save-service-proof', [API\BookingController::class, 'uploadServiceProof']);
    Route::post('handyman-update-available-status', [API\User\UserController::class, 'handymanAvailable']);
    Route::post('available-status', [API\User\UserController::class, 'jobUserAvailable']);
    Route::post('delete-user-account', [API\User\UserController::class, 'deleteUserAccount']);
    Route::post('delete-account', [API\User\UserController::class, 'deleteAccount']);
    Route::post('delete-jobs-account', [API\User\UserController::class, 'deleteJobsAccount']);

    Route::post('save-post-job', [App\Http\Controllers\PostJobRequestController::class, 'store']);
    Route::post('post-job-delete/{id}', [App\Http\Controllers\PostJobRequestController::class, 'destroy']);

    Route::get('get-post-job', [API\PostJobRequestController::class, 'getPostRequestList']);
    Route::post('get-post-job-detail', [API\PostJobRequestController::class, 'getPostRequestDetail']);

    Route::post('save-bid', [App\Http\Controllers\PostJobBidController::class, 'store']);
    Route::get('get-bid-list', [API\PostJobBidController::class, 'getPostBidList']);


    Route::post('save-provider-slot', [App\Http\Controllers\ProviderSlotController::class, 'store']);
    Route::get('get-provider-slot', [API\ProviderSlotController::class, 'getProviderSlot']);

    Route::post('get-userdetails', [API\UserDetailsController::class, 'getUserDetailsByUser']);

    Route::post('add-userdetails', [API\UserDetailsController::class, 'addUserDetails']);
});
