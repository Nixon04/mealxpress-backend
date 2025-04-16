<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\DriversPersonalInfo;
use App\Models\DriversTransactions;
use App\Models\UserOrderList;
use App\Models\UserModel;
use App\Models\Stores;
use Carbon\Carbon;
use App\Models\TrackerRecord;
use App\Models\Tracker;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use App\Models\OrderTotal;



class DriverController extends Controller
{


        public function ConfirmDelivery(Request $request)
        {
            $request->validate(['code' => 'required','reference' => 'required']); // Validate that 'code' is provided
            $date  =  Carbon::now()->setTimeZone('Africa/Lagos')->format('d M, Y: h:i:A');
    
            try {               
                $order = UserOrderList::where('cartrefcode', $request['code'])
                    ->where('cartstatus', 'pending')
                    ->update(['cartstatus' => 'Delivered', 'cartpurchasedate' => $date]);



                    $getreferencecode = UserOrderList::where('cartreference', $request['reference'])->first();
                    if($getreferencecode){
                        $usercode = $getreferencecode->cartrefcode;
                    }
    
                if (!$order) {
                    return response()->json([
                        'message' => 'No matching pending order found for the provided code.',
                        'status' => 'error'
                    ]);
                }
                //   updating final tracker for users notification
                $updatetracker = Tracker::where('tracker_code', $request['reference'])->first();
                if($updatetracker){
                    $title = "Product is Delivered";
                    $body = "Thanks for partnering with us, your reference journey code will be passed to your official email.. from Mealxpress Team";
                    $getalldetails = UserOrderList::where('cartreference', $request['reference'])->first();
                    if($getalldetails){
                        $username  = $getalldetails->username;
                        $date = Carbon::now()->setTimezone('Africa/Lagos')->format('d M, Y : h i a');
                
                        // collect fcm token for notification
                        $querytoken = UserModel::where('username', $username)->first();
                        if($querytoken){
                            $token = $querytoken->fcm_token;
                        }
                    }

                    $neworderLocation = new TrackerRecord([ 
                        'username' => $username,
                        'usercode' => $usercode,
                        'cartreference' => $request->input('reference'),
                        'locations' => $body,
                        'date' => $date,
                        'status' => 'active', 
                    ]);
                    
                  $status =  $neworderLocation->save();

                    $messaging = app('firebase.messaging');
                    $message = CloudMessage::withTarget('token', $token)
                    ->withNotification(notification: Notification::create($title, $body));
                     $notifier =  $messaging->send($message);
                    $updatetracker->update(['tracker_history' => '4']);
                }
                return response()->json([
                    'message' => 'Order updated to Delivered successfully.',
                    'status' => 'success',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
            }
        }

    
   public function TrackerRecordLocation(Request $request){
    $request->validate(['reference' => 'required', 'currentprogress' => 'required']);
    $getalldetails = UserOrderList::where('cartreference', $request['reference'])->first();
    if($getalldetails){
        $usercode  = $getalldetails->cartrefcode;
        $username  = $getalldetails->username;
        $date = Carbon::now()->setTimezone('Africa/Lagos')->format('d M, Y : h i a');
        // collect fcm token for notification
        $querytoken = UserModel::where('username', $username)->first();
        if($querytoken){
            $token = $querytoken->fcm_token;
        }
        // lets give all details in accordance to the currentprogress index
        $currentprogress = $request->input('currentprogress');
        if($currentprogress ==  "1"){
            $title = "Product Has been Initiated";
            $body = "Your package has been notified";
        }else if($currentprogress == "2"){
            $title = "Product In Package";
            $body = "Your product is been package right now... ";
        }else if($currentprogress == "3"){  
            $title = "Product In Delivery";
            $body = "Your product is on transit, our courier is bringing it to your doorstep";
        }else if($currentprogress == "4"){
                $title = "Product is Delivered";
                $body = "Thanks for partnering with us, your reference journey code will be passed to your official email.. Mealxpress Team";
        }

        // insert map into record
        $updatetracker = Tracker::where('tracker_code', $request['reference'])->first();
        if($updatetracker->tracker_history == $request['currentprogress']){
            return response()->json(['message' => 'This track is already Recorded', 'status' => 'success']);
        }
        // giving track of recent to formal records as to avoid repeated or drawback updates
        else if($updatetracker->tracker_history > $request['currentprogress']){
            return response()->json(['message' => 'Tracker is notified already, please choose serially', 'status' => 'success']);
        }
        if($updatetracker){
            $updatetracker->update(['tracker_history' => $request['currentprogress']]);
        }
        // insert data into TrackerRecord
        $neworderLocation = new TrackerRecord([ 
            'username' => $username,
            'usercode' => $usercode,
            'cartreference' => $request->input('reference'),
            'locations' => $body,
            'date' => $date,
            'status' => 'active', 
        ]);
        
      $status =  $neworderLocation->save();
        // $token = "ftyzk8eSSq2Aw1gXwV1bg6:APA91bFQKLv0yh2LSRqvcNhhdt-yncKjEHTDkFDzkbMBIkyBsLeycvqsvICoN6ZDAUIDJQNvOFyIaJAe3jxfMypurbNX4hs_-r8FcjUOm_8T0uhGmChXX70"
      $messaging = app('firebase.messaging');
      $message = CloudMessage::withTarget('token', $token)
      ->withNotification(notification: Notification::create($title, $body));
       $notifier =  $messaging->send($message);
      if($status && $notifier){
        return response()->json(['message' => 'Updated successfully', 'status' =>'success']);
      } 
       return response()->json(['message' => "Not successful", 'status' =>'error']);
    }else{
        return response()->json(['message' => 'User Account Was\'nt found', 'status' => 'error']);
    }

   }
    public function ViewAllTrackers(Request $request){
        try{
        $request->validate(['reference' => 'required']);
        $getcurrentlocations = Tracker::where("tracker_code",$request->input("reference"))->first();
        return response()->json(['data' => $getcurrentlocations->tracker_history]);
        }catch(\Exception $e){
            return response()->json(['data' => $e->getMessage()]);

        }
    }


    public function PickUpDirection(Request $request){
        $request->validate(['reference' => 'required']);
        $selectedvalues = OrderTotal::where('status_point', $request->input('reference'))->first();
        if($selectedvalues){
            return response()->json(['data' => $selectedvalues->delivery_address, 'username' => $selectedvalues->username]);
        }else{
            return response()->json(['data' => ""]);
        }
    }
    // fetch particular marketstore id

    public function FetchMarketStoreId(Request $request) {
        // Validate the incoming request to ensure 'reference' is provided
        $request->validate(['reference' => 'required', ]);
          // fetch drivers record
            $selectedvalues = Stores::where('marketstoreid', $request->input('reference'))->first();
        if ($selectedvalues) {
             
            $selectedvalues->marketstoreimage = "https://mealxpress.ng/mealxpress_storesprofile/" . $selectedvalues->marketstoreprofile;
            // Return the data as a JSON response
            return response()->json(['data' => $selectedvalues]);
        } else {
            // Return an empty object if no store is found
            return response()->json(['data' => new \stdClass()]);
        }
    }
    

    public function FetchCurrentReference(Request $request){
        $request->validate(['reference' => 'required', 'driversid' => 'required']);
        $querydriver = DriversPersonalInfo::where('firstname', $request->input('driversid'))->first();
        if($querydriver){
            $querytrack = Tracker::where('tracker_code', $request->input('reference'));
            if($querytrack){
                $querytrack->update(['tracker_courier_name' => $querydriver->firstname . ' '. $querydriver->lastname, 
                'tracker_courier_contact' => $querydriver->contact, 'tracker_courier_image' =>  $querydriver->image,
                 'tracker_status' => 'active', 'tracker_id' => $querydriver->trackerid
            ]);
           }
        }

        $selectedvalues = DB::select('SELECT  fullname, email, contact, marketid, productname,
         price, COALESCE(`portion`,0) as port, total, option, cartimage, cartweight, cartreference,
          cartdrink, cartstatus, cartrefcode, cartpurchasedate FROM user_order_lists
           LEFT JOIN user_models ON user_order_lists.username = user_models.username
            WHERE user_order_lists.cartreference = :reference',
             ['reference' =>  $request['reference']]);
             try{
             if($selectedvalues && $querydriver){
                return response()->json(['data' => $selectedvalues]);  
             }else{
                return response()->json(['data' => []]);
             }
            }catch(\Exception $e){
                return response()->json([$e->getMessage()]);
            }
       }

    public function FetchAllUsersRequest(Request $request){
      $request->validate(['status' => 'required', 'username' => 'required']);  


        // if($request->input('status') == 'Delivered'){
        //     $selectedvalues = DB::select('SELECT  fullname, email, contact, marketid, productname,
        //     cartpremit as cartpermit,
        //      price, COALESCE(`portion`,0) as port, total, option, cartimage, cartweight, cartreference,
        //       cartdrink, cartstatus, cartrefcode, cartpurchasedate FROM user_order_lists
        //        LEFT JOIN user_models ON user_order_lists.username = user_models.username
        //         WHERE user_order_lists.cartstatus = :statuscall ORDER BY user_order_lists.id DESC AND user_order_lists.username = :userstate',
        //          ['statuscall' =>  $request['status'],
        //          'userstate' => 'MLXPD-304258'
        //         ]);
                
        // }

  

        $selectedvalues = DB::select('SELECT  fullname, email, contact, marketid, productname,
        cartpremit as cartpermit,
         price, COALESCE(`portion`,0) as port, total, option, cartimage, cartweight, cartreference,
          cartdrink, cartstatus, cartrefcode, cartpurchasedate FROM user_order_lists
           LEFT JOIN user_models ON user_order_lists.username = user_models.username
            WHERE user_order_lists.cartstatus = :statuscall ORDER BY user_order_lists.id DESC',
             ['statuscall' =>  $request['status']]);
            
    
       
    // array holder
    $uniqueReferences = [];
    $filteredResults = [];

    foreach ($selectedvalues as $value) {
        if (!in_array($value->cartreference, $uniqueReferences)) {
            $uniqueReferences[] = $value->cartreference;
            $filteredResults[] = $value;
        }
    }
    try {
        if ($filteredResults) {
            return response()->json(['data' => $filteredResults]);
        } else {
            return response()->json(['data' => []]);
        }
    } catch (\Exception $e) {
        return response()->json([$e->getMessage()]);
    }
    }

    public function WithDrawAndDepositStatus(Request $request) {
        $request->validate(['username' => 'required']);
        
        try {
            $getalltransactions = DriversTransactions::where('username', $request->input('username'))->get();
            if ($getalltransactions->isEmpty()) {
                return response()->json(['data' => ['deposit_count' => 0, 'withdraw_count' => 0]]);
            }
            $depositCount = 0;
            $withdrawCount = 0;
    
            foreach ($getalltransactions as $entry) {
                if ($entry->transfer_method === "Deposit") {
                    $depositCount++;
                } elseif ($entry->transfer_method === "Withdraw") {
                    $withdrawCount++;
                }
            }
    
            return response()->json(['data' => ['deposit_count' => $depositCount, 'withdraw_count' => $withdrawCount]]);
            
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    

  public function DriverReferenceCall(Request $request){
    $request->validate(['reference' => 'required']);
    $getalltransactions  = DriversTransactions::where('reference',$request->input('reference'))->first();
   try{
    if($getalltransactions){
        return response()->json(['data' => $getalltransactions]);
    }else{
        return response()->json(['data' => []]);
    }
    }catch(\Exception $e){
        return response()->json([$e->getMessage()]);
    }
  }


  public function DriversTransaction(Request $request){
    $request->validate(['username' => 'required']);
    $getalltransactions  = DriversTransactions::where('username',$request->input('username'))->get();
   try{
    if($getalltransactions){
        return response()->json(['data' => $getalltransactions]);
    }else{
        return response()->json(['data' => []]);
    }
    }catch(\Exception $e){
        return response()->json([$e->getMessage()]);
    }
  }


  public function DriverInfo(Request $request){
    $request->validate(['username' => 'required']);
    $validate  = DB::select('SELECT firstname,lastname, image as Images, email,contact,trackerid,walletbalance,flag FROM drivers_personal_infos
    LEFT JOIN driver_account_wallets ON 
    drivers_personal_infos.firstname = driver_account_wallets.username
    WHERE drivers_personal_infos.firstname = :username LIMIT 1',
    ['username' => $request['username']]);

    if(!empty($validate)){
        $validate = collect($validate)->transform(function($entry){
        $entry->image = "https://mealxpress.ng/mealxpress_riders_image/".$entry->Images;
         return $entry;
        })->first();
    }
    try{
    if($validate){
        return response()->json(['data' => $validate]);
    }else{
        return response()->json(['data' => []]);
    }
    }catch(\Exception $e){
        return response()->json([$e->getMessage()]);
    }

  }
    //
  public function DriverLogin(Request $request){
    $request->validate([
            'contact' => 'required|numeric',
            'password' => 'required',
            'fcm_token',
        ]);
    try{
   Log::info('Server', ['server' => $request['contact']]);
    $validatecheck = DriversPersonalInfo::where('contact', $request['contact'])->first();
    if($validatecheck && hash::check($request['password'], $validatecheck->password)){
        $username = $validatecheck->firstname;
        $validatecheck->update(['fcm_token' => $request->input('fcm_token') ?? 'Nothing to show']);
        return response()->json(['message' => $username, 'status' =>'success', 'token' => $request['fcm_token']]);
    }else{
        return response()->json(['message' => 'Incorrect Details', 'status' => 'error']);
    }
}catch(\Exception $e){
    \Log::info('error_Status', ['infostatus' =>  $e->getMessage()]);
    return response()->json(['message' => $e->getMessage()]);
}
  }
    
}
