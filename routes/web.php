<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VendorsController;
use App\Http\Controllers\GeneralView;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostAdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

Route::get('/vendorspath/auth/login', [AuthController::class, 'LoginPage'])->name('LoginPage');
Route::get('/vendorspath/auth/forgotpassword',[AuthController::class,'ForgotPassword']);
Route::get('/vendorspath/auth/confirmtoken', [AuthController::class,'VendorsConfirmToken'])->name('VendorsConfirmToken');
Route::get('/vendorspath/auth/changepassword', [AuthController::class,'VendorsChangePassword'])->name('VendorsChangePassword');

Route::get('/route/home',[AuthController::class,'EmailRoute']);

// for storeprofiles 
Route::get('/mealxpress_storesprofile/{filename}', function($filename){
// if(!Session::has('userid')){
//   abort(403, 'UnAuthorized Access' );
// }
 $path = storage_path('app/private/mealxpress_storesprofile/' .$filename);
   if(!file_exists($path)){
    abort(404, 'Image not found');
  }
 return response()->file($path);
})->name('mealxpress_storesprofile');



Route::get('/mealxpress_images/{filename}', function($filename){
  $path = storage_path('app/private/mealxpress_images/' .$filename);
  if(!file_exists($path)){
    abort(404, 'Image Not Found');
  }
  return response()->file(file: $path);
})->name('mealxpress_images');
  

Route::get( '/mealxpress_drinks/{filename}', action: function($filename){
  $path = storage_path('app/private/mealxpress_drinks/' .$filename);
  if(!file_exists($path)){
    abort(404, 'Image Not Found');
  }
  return response()->file($path);
})->name('mealxpress_drinks');


Route::get( '/mealxpress_riders_image/{filename}', function($filename){
  $path = storage_path('app/private/mealxpress_riders_image/' .$filename);
  if(!file_exists($path)){
    abort(404, 'Image Not Found');
  }
  return response()->file($path);
})->name('mealxpress_riders_image');
  
  


Route::controller(GeneralView::class)->group(function(){
Route::get('/', 'HomeIndex');
Route::get('/newhome', 'NewHome');
Route::get('/about', 'About');
Route::get('/privacy', 'Privacy');
Route::get('/occupations/drivers', 'Drivers');
Route::get('/occupations/vendors', 'Vendors');
Route::get('/support/contact', 'Contact');
Route::get('/support/faqs', 'Faqs');
Route::get('/getright', 'GetRight');
Route::get('/navdesign', 'NavDesign');
});





Route::get('/vendorspath/dashboard/home', [AuthController::class, 'VendorsDashboard'])->name('VendorsDashboard');
Route::get('/vendorspath/dashboard/products', [AuthController::class, 'VendorsProducts'])->name('VendorsProducts');
Route::get('/vendorspath/dashboard/transactions', [AuthController::class, 'VendorsTransactions'])->name('VendorsTransactions');
Route::get('/vendorspath/dashboard/invoices', [AuthController::class, 'VendorsInvoices'])->name('VendorsInvoices');
Route::get('/vendorspath/dashboard/settings', [AuthController::class, 'VendorsSettings'])->name('VendorsSettings');
Route::get('/vendorspath/dashboard/delivery', [AuthController::class,'VendorsDelivery'])->name('VendorsDelivery');
Route::get('/vendorspath/dashboard/orders', [AuthController::class,'VendorsOrders'])->name('VendorsOrders');
Route::get('/vendorspath/dashboard/payouts', [AuthController::class,'VendorsPayout'])->name('vendorspath.dashboard.payouts');
Route::get('/vendorspath/dashboard/listproducts', [AuthController::class,'ListProducts'])->name('ListProducts');
Route::get('/vendorspath/dashboard/addcategories', [AuthController::class,'AddCategory'])->name('AddCategory');
Route::get('/vendorspath/dashboard/fetchrecord', [AuthController::class,'FetchRecord'])->name('FetchRecord');
Route::get('/vendorspath/dashboard/logout', [AuthController::class, 'VendorsLogout'])->name('VendorsLogout');
Route::get('/vendorspath/dashboard/menu', [AuthController::class, 'VendorsMenu'])->name('VendorsMenu');


Route::get('/vendorspath/dashboard/indexhome', [AuthController::class, 'HomeIndexCall']);


// vendors link

Route::controller(VendorsController::class)->group(function(){
    // state for post method
    Route::post('/vendorspath/vendorslogin', 'VendorsLoginPost');
    Route::post('/vendorspath/orderlistitems', 'VendorOrderListItems');
    Route::post('/vendorspath/updateproducts','fetchCurrentProductList');
    Route::post('/vendorspath/updateproductlist','UpdateCurrentProductList');
    Route::post('/vendorspath/postproducts','NewProductUpload');
    Route::post('/vendorspath/deleteproduct', 'ProductDelete');
    Route::post('/vendorspath/catdeleteproduct', 'CatDelete');
    Route::post('/vendorspath/createrecipient','CreateTransferRecipient');
    Route::get('/vendorspath/populatebanks','PopulateBanks');
    Route::post('/vendorspath/localtransfer','LocalTransferAuth');
    Route::post('/vendorspath/rejectorder','RejectOrder');
    Route::post('/vendorspath/updateprofile','UpdateProfile');
    Route::post('/vendorspath/updatetrackgoods', 'PostUpdateGoods');
    Route::post('/vendorspath/addcategory', 'AddCategory');
    Route::post('/vendorspath/updateprofileimage', 'UpdateUserImage');
    

    // verification sender
    Route::post('/vendorspath/verifyemail', 'VendorEmailVerification');
    Route::post('/vendorspath/verifyemailtoken', 'VendorEmailToken');
    Route::post('/vendorspath/vendorschangepassword', 'VendorChangePassword');


    Route::post('/vendorspath/dashboard/updatestoreactivity', 'UpdateStoreStatus');
    Route::get('/vendorspath/dashboard/getcurrentsatus', action: 'GetCurrentStatus');

   
});

Route::controller(AdminController::class)->group(function(){
  Route::get('/prisent/auth/login', 'AdminLogin');
  Route::get('/prisent/dashboard/home', 'AdminDashboard');
  Route::get('/prisent/dashboard/currentsales', 'AdminSales');
  Route::get('/prisent/dashboard/payouts', 'AdminPayouts');
  Route::get('/prisent/dashboard/regusers', 'AdminUsers');
  Route::get('/prisent/dashboard/vendors', 'AdminVendors');
  Route::get('/prisent/dashboard/category', 'AdminCategory');
  Route::get('/prisent/dashboard/drivers', 'AdminDrivers');
  Route::get('/prisent/dashboard/sendappnotification', 'AdminAppNotification');
  Route::get('/prisent/dashboard/drinks', 'AddDrinks');
  Route::get('/prisent/dashboard/regions', 'ActiveRegions');
  Route::get('/prisent/dashboard/ads', 'Ads');
});



Route::get('/firebase-test', function () {
  $token = 'fgROfw1tQxSlzCFKnWGZ6a:APA91bG84ef4NbtVK8VH0hvYLcOj87B6yvDrnoG8sOT6QXpbocv21pYUOIP1fr3nxbbCSPQ90eoXc5CJja0kRUSNFraeXySOEQU4zhd93jbBeSRMOhL2ohU'; // Replace with a valid FCM token for a test device
  $messaging = app('firebase.messaging');
  
  // $message = CloudMessage::withTarget('token',$token)

  $messaging = app('firebase.messaging');
  $message = CloudMessage::withTarget('token',$token)
  ->withNotification(notification: Notification::create("Testing Mood'", body: "I have a dream of cause, Don't bother about it"));
   $notifier =  $messaging->send($message);


  // $message = CloudMessage::withTarget("topic","all_users")
  // ->withNotification(notification: Notification::create('Hey Buddy', 'Omo i say ma gist you something, we are coming back stronger get ready'));

  try {
      $response = $messaging->send($message);
      return response()->json(['success' => true, 'response' => $response]);
  } catch (\Exception $e) {
      return response()->json(['success' => false, 'error' => $e->getMessage()]);
  }
});


Route::controller(PostAdminController::class)->group(function(){
  
  Route::post('/prisent/auth/login','AdminPostLogin');
  Route::post('/prisent/dashboard/addvendors','AdminPostVendors');
  Route::post('/prisent/dashboard/postdrivers','AdminPostDrivers');
  Route::post('/prisent/dashboard/sendnotification', 'AdminSendNotification');
  Route::post('/prisent/dashboard/add_drinks','PostDrinks');
  Route::post('/prisent/dashboard/drinksdelete', 'PostDeleteDrinks');
  Route::post('/prisent/dashboard/addcategory', 'AddCategory');
  Route::post('/prisent/dashboard/deletecat', 'DeleteCategory');
  Route::post('/prisent/dashboard/deletead', 'DeleteAd');
  Route::post('/prisent/dashboard/adsproduct','NewProductUpload');
  Route::post('/prisent/dashboard/regions', 'AddRegions');
  Route::post('/prisent/dashboard/deletelocation', action: 'DeleteLocation');
  Route::post('/prisent/updatedrivers', 'UpdateDrivers');
  

});