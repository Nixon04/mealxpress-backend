<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VendorsController;
use App\Http\Controllers\GeneralView;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostAdminController;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

Route::get('/vendorspath/auth/login', [AuthController::class, 'LoginPage'])->name('LoginPage');
Route::get('/vendorspath/auth/forgotpassword',[AuthController::class,'ForgotPassword']);


Route::get('/route/home',[AuthController::class,'EmailRoute']);


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
  Route::get('/prisent/dashboard/drivers', 'AdminDrivers');
  Route::get('/prisent/dashboard/sendappnotification', 'AdminAppNotification');
  Route::get('/prisent/dashboard/drinks', 'AddDrinks');
  Route::get('/prisent/dashboard/ads', 'Ads');
});



Route::get('/firebase-test', function () {
  $token = 'cny_Ps_1Qu6i9_sZqoK-Xt:APA91bFhe5L5kjDVofrr-YK4udXI9SlIMvScVXhF736M3h5Dk3Ja74CnODwilaEXd8y6D-ShF0XtoRG2KZhLuOa6jiJ_GecRDBpP-orouxQ1f5wUfYsIWN0'; // Replace with a valid FCM token for a test device
  $messaging = app('firebase.messaging');

  // $message = CloudMessage::withTarget('token',$token)

  $messaging = app('firebase.messaging');
  $message = CloudMessage::withTarget('topic', "all_drivers")
  ->withNotification(notification: Notification::create("New Request!!'", body: "Order request is 49343434"));
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

});