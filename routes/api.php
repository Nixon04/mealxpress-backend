<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealServerController;
use App\Http\Controllers\MealServiceFetchController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/state', [AuthController::class, 'Filament'])->name('Filament');

Route::controller(MealServerController::class)->group(function(){
    Route::get('/mealserver ','Mealserver');
    // post request
    Route::post('/signupcheck', 'SignupCheckup');
    Route::post('/signup', 'SigupConfig');
    Route::post('/login', 'LoginControl');

});

Route::controller(DriverController::class)->group(function(){
    Route::post('/driverlogin', 'DriverLogin');
    Route::post('/driversignup', 'DriverSignup');
    Route::post('/driverinfo', 'DriverInfo');
    Route::post('/driverfetchbank', 'DriverFetchBank');
    Route::post('/driverstransaction', 'DriversTransaction');
    Route::post('/driversreference', 'DriverReferenceCall');
    Route::post('/depositandwithdraw', 'WithDrawAndDepositStatus');
    Route::post('/fetchalluserrequest', 'FetchAllUsersRequest');
    Route::post('/fetchcurrentreference', 'FetchCurrentReference');
    Route::post('/pickupaddress', 'PickUpDirection');
    Route::post('/fetchstoreidlocation', 'FetchMarketStoreId');
    Route::post('/driverlogin', 'DriverLogin');
    Route::post('/driverlogin', 'DriverLogin');
    Route::post('/driverlogin', 'DriverLogin');
    Route::post('/driverlogin', 'DriverLogin');
    Route::post('/trackerrecord', 'TrackerRecordLocation');
    Route::post('viewalltrackers','ViewAllTrackers');
    Route::post('/confirmdelivery', 'ConfirmDelivery');
});

Route::controller(MealServiceFetchController::class)->group(function(){
    Route::post('/standalonestore', 'Standalonestores');
    Route::post('/fetchstoreid','FetchStoreId');
    Route::post('/fetchstoreitems','FetchStoreItems');
    Route::post('/filtermeals', 'FilterMeals');
    Route::post('/subcategory', 'FetchSubcategory');
    Route::post('/userwallet',  'UserWallet');
    Route::post('/addtocart', 'AddToCartPurchase');
    Route::post('/addtocartonline','AddToCartOnline');
    Route::post('/initializePayment','initializePayment');
    Route::post('/tracker', 'PostTracker');
    Route::post('productstatus', 'ProductStatus');
    Route::post('webhook','WebHookPaystack');
    Route::post('uservirtualaccount', 'ViewUserAccount');
    Route::post('profiledetails', 'ViewUserAccountDetails');
    Route::post('deleteaccount', 'DeleteAccount');
    Route::post('viewmytracks', 'ViewMyTracks');
    Route::post('updateapptoken','AppTokenID');
    Route::post('/promocodes','PromoExtension');
    Route::post('/fetchemail','UserDetails');
    Route::post('/verifyemail', 'ForgotPassword');
    Route::post('/confirmtoken', 'UsersConfirmToken');
    Route::post('/setnewpassword', 'UserSetNewPassword');
    Route::post('/referralidcount', 'ReferralIdCount');
    Route::post('/earnrewards', 'EarnRewards');
    Route::post('/alltransactions', 'AllTransactions');
    Route::post('/fetchregion', 'CurrentRegionGroup');
//    get routes

   Route::get('/fetchallmarketlist', 'FetchMarketsList');
   Route::get('/fetchads','FetchAds');
   Route::get('/appversion', 'AppVersion');
   Route::get('/fetchcategory', 'FetchCategory');
   Route::get('/selectdrinks', 'SelectDrinks');
   Route::get('versioncontrol', 'VersionStatus');
   Route::get('/servicecharge', 'ServiceCharge');
   Route::get('/callbackurl', 'CallBack');
   Route::get('/localmarkets', 'LocalMarkets');
   Route::get('/supermarkets', 'SuperMarkets');
   Route::get('/payment-success', 'PaymentSuccess');
});
