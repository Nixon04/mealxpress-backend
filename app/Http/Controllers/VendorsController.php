<?php

namespace App\Http\Controllers;
use App\Mail\VerificationEmail;
use App\Models\AllMarkets;
use App\Models\OrderTotal;
use App\Models\PayoutMethods;   
use App\Models\storesubcategory;
use App\Models\UserAccounts;
use App\Models\UserModel;
use App\Models\UserOrderList;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\VendorsCredentials;
use App\Models\Stores;
use App\Models\VendorsWallet;
use App\Models\BankLists;
use Carbon\Carbon;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

use Intervention\Image\Laravel\Facades\Image;



class VendorsController extends Controller
{


    public function GetCurrentStatus(){
        $querystores = Stores::where('marketstoreid', Session::get('userid'))->first();
        if($querystores){
            return response()->json(['status' => $querystores->marketstatus]);
        }
    }

    public function UpdateStoreStatus(Request $request){
        $request->validate(
            [
                'status' => 'required|String'
            ]);
          try{
            $querystores = Stores::where('marketstoreid', Session::get('userid'))->first();
            if($querystores){
                $querystores->update(['marketstatus' => $request->input('status')]);
                if($request->input('active')){
                    return response()->json(['message' =>'Store Opened']);
                }
                return response()->json(['message' =>'Store Closed']);
            }
            return response()->json(['message' =>'StoreId Wasnt Found']);
        }catch(\Exception $e){
            return response()->json(['message' =>'Oops, please try again later', $e->getMessage()]);
        }
    }
    public function VendorChangePassword(Request $request){
        $request->validate(['password' => 'required']);
        try{
        $useridentityemail = Session::get( 'vendorid'); //finally we call vendorid to verify unique id
        $hashed = Hash::make(value: $request->input(key: 'password'));
        $queryvendors  = VendorsCredentials::where('email_address', $useridentityemail);
        if($queryvendors){
            $queryvendors->update(['password' => $hashed]);
            return response()->json(['message' => 'Password Updated Successfully', 'status' => 'success']);
        }
        return response()->json(['message' => 'Vendor ID not identity, please restart again']);
       }
       catch(\Exception $e){
        return response()->json(['message' => 'Oops seems something went wrong']);
       }
    }

    public function VendorEmailToken(Request $request){
        $request->validate([
            'token' => 'required|numeric',
        ]);
        // Session::get('vendorid'); we will add this 2fa security in the future
        $querycode = VendorsCredentials::where('code', $request->input('token'))->first();
        if($querycode){
            return response()->json(['message' => 'Confirmation successfully', 'status' => 'success']);
        }
        return response()->json(['message' => 'Token invalid', 'status' => 'error']);
    }

    public function VendorEmailVerification(Request $request){
      $request->validate([
        'email' => 'required|email',
      ]);
      try{
      $queryvendors = VendorsCredentials::where('email_address', $request->input('email'))->first();
      if($queryvendors){
       $email =  $request->input('email');
       $username = explode('@', $email)[0];
       $token = rand(999999, 111111);
        Session::put('vendorid', $email);
        Mail::to($email)->send( new VerificationEmail($username, $token));
        $queryvendors->update(['code' => $token]);
         return response()->json(['message' => 'Message Delivered successfully', 'status' => 'success']);
       }
       return response()->json(['message' =>  'This isn\'t registered with us', 'status' => 'error']);
        }catch(\Exception $e){
            return response()->json(['message' => 'Oops seems something went wrong, try again']);
      }
    }
    public function UpdateUserImage(Request $request){
        $request->validate(
            ['image' => 'required|mimes:jpg,png,jpeg|max:2048']
        );
    
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagename = time() . '.' . uniqid() . '.' . $image->getClientOriginalExtension();
                // Save the image in the 'mealxpress_storesprofile' folder under the 'public' disk (storage/app/public)
                // $path = Storage::disk('public')->putFileAs('mealxpress_storesprofile', $image, $imagename);
                $path = $request->file('image')->storeAs('mealxpress_storesprofile', $imagename, 'local');
                if (!$path) {
                    return response()->json(['message' => 'Image not saved', 'path' => $path]);
                }
                // Retrieve the user ID from session
                $userid = Session::get('userid');
                
                // Query the store associated with the user
                $querystore = Stores::where('marketstoreid', $userid)->first();
                
                if ($querystore) {
                    // Update the store's profile image with the new image name
                    $querystore->update(['marketstoreprofile' => $imagename]);
                    
                    return response()->json(['message' => 'Image updated successfully']);
                } else {
                    return response()->json(['message' => 'Store info not found']);
                }
            } else {
                return response()->json(['message' => 'Image request failed']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    
     public function AddCategory(Request $request) {
       $request->validate(['value' => 'required']);
       $jsonarray = json_decode($request->input('value'), true);
        $catid = 'MLXPS_'. rand(999999,111111);
        try{
       foreach($jsonarray as $entry){
            $insertdata = new storesubcategory([
                'marketid' => Session::get('userid') ?? '',
                'categoryid' => $catid,
                'categoryname' => $entry['name'],
                'categorylistdropdown' => 'drink',
                'flag' => '1',
                'status' => 'active',
            ]);
            $insertdata->save();
        }
       return response()->json(['message' => 'Category Updated successfully', 'status' => 'success']);
    }catch(\Exception $e){
        return response()->json($e->getMessage());
    }
 }

    public function PostUpdateGoods(Request $request){
      $request->validate(['cartstatusreport' => 'required', 'cartrefparam' => 'required']);
      $orderquery = OrderTotal::where('delivery_code',  $request->input('cartrefparam'))->first();
        
      $delivery_id = $request->input('cartrefparam');

      if($orderquery->approvestat == "accepted"){
        return response()->json(['message' => 'You cant order a request twice, Thanks']);
      }
      if($orderquery){
        $queryuserpackage = UserOrderList::where('cartrefcode',$request->input('cartrefparam') )->get();
        foreach ($queryuserpackage as $entry){
            $entry->update(['cartpremit' => '_non_initiated', 'cartstatus' => 'pending']);
        }
       $status =  $orderquery->update(['approvestat'=> $request->input('cartstatusreport')]);
       
            if($status && $queryuserpackage){
                $messaging = app('firebase.messaging');
                $message = CloudMessage::withTarget('topic', "all_drivers")
                ->withNotification(notification: Notification::create("New Request", body: "Vendor Currently Accepted A New Request $delivery_id, Good Luck"));
                $messaging->send($message);  
                
                // $updateusers = OrderTotal::where('delivery_code', $delivery_id)->first();
                // if($updateusers){
                //     $updateusers->update(['approvestat'])
                // }

                

                return response()->json(['message' => 'Request Approved']);
            }else{
                return response()->json(['message' => 'Request not approved']);
        }
      }else{
        return response()->json(['message'=> 'Could not find any parameter for cartrefparam']);
      }
    }

    public function UpdateProfile(Request $request){
       $request->validate([
        "marketstorename" => 'required',
        "marketstorebio" => 'required',
        "marketstorelinks",
        "marketstorebadge",
        "marketstatus" => "required",
        "marketstoreprofile",
        "marketstorecollection",
        "marketstoreaddress" => 'required',
        "activehours" => 'required',
        "contact" => 'required|numeric',
        "email_address" => 'required',
        "sendermail" => 'required',
        "legalbusiness" => 'required',
        "city" => 'required',
        "state" => 'required',
       ]);

      $queryvendors = VendorsCredentials::where('vendorsMarketId', Session::get('userid'))->first();
      if($queryvendors){
        $queryvendors->update([
            'contact' => $request->input('contact'),
            'email_address' => $request->input('email_address'),
            'sendermail' => $request->input('sendermail'),
            'legalbusiness' => $request->input('legalbusiness'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
        ]);
      }
      $querystores = Stores::where('marketstoreid', Session::get('userid'))->first();
      if($querystores){
        $querystores->update([
            'marketstorename' => $request->input('marketstorename'),
            'marketstorebio' => $request->input('marketstorebio'),
            'marketstoreaddress' => $request->input('marketstoreaddress'),
            'activehours' => $request->input('activehours'),
        ]);
      }
      return response()->json(['message' => 'Profile Updated successfully']);
    } 
    

    public function RejectOrder(Request $request){
       $request->validate(['itemupdate' => 'required', 'cartref' =>'required']);
       $orderlist = UserOrderList::where('cartrefcode', $request->input('cartref'))->first();
       $orderquery = OrderTotal::where('delivery_code',  $request->input('cartref'))->first();

    try{
        DB::beginTransaction();
    //   refund charge to users
    if($orderquery){    
        $delivery_id = $request->input('cartref');
        $post_payment = $orderquery->total_amount;
        $delivery_sum = $orderquery->delivery_amount + $orderquery->service_fee;
        $vendors_pay = $orderquery->sum_total;
        $username = $orderquery->username;
        $vendors_id = $orderquery->market_id;
        $ordercheck = $orderquery->approvestat;
        if($ordercheck == 'approvestat'){
            return;
        }
        // check for users and refund
        $userquery = UserAccounts::where('username', $username)->first();
        if($userquery){
            $main_balance = $userquery->main_balance;
            $add_total = $main_balance + $post_payment;
            $userquery->update(['main_balance' => $add_total]);
         }

        //  check for vendors and reduce
        $vendorsquery = VendorsWallet::where('username', $vendors_id)->first();
        if($vendorsquery){
            $vendorsinitial = $vendorsquery->accountbalance;
            $final_total = $vendorsinitial - $vendors_pay;
            if($final_total > $vendorsinitial){
              $vendorsquery->update(['accountbalance' => $final_total]);
            }
        }

        // update the approvestatus 
        $orderquery->update(['approvestat' => 'pending']);
        // minus via the table row for admin profit
        $queryuserpackage = UserOrderList::where('cartrefcode',$request->input('cartref') )->get();
        foreach ($queryuserpackage as $entry){
            $entry->update(['cartpremit' => '_non_initiated']);
        }

           $status =  $orderquery->update(['approvestat'=> 'returns', 'delivery_amount' => '0', 'service_fee' => '0']);
            if($status && $queryuserpackage){
                $messaging = app('firebase.messaging');
                $message = CloudMessage::withTarget('topic', "all_drivers")
                ->withNotification(notification: Notification::create("Goods Not Available", body: "Vendor Currently can't accept this product stated via the id code $delivery_id"));
                $messaging->send($message);          
                // return response()->json(['message' => 'Request Approved']);
            }

            $userinfo  = UserModel::where('username', $username)->first();
            if($userinfo){
                $token  = $userinfo->fcm_token;
                $messaging = app('firebase.messaging');
                $message = CloudMessage::withTarget('token', $token)
                ->withNotification(notification: Notification::create("Order Rejected", body: "Unfortunately 😔 The Vendor can't meet up with this item, so your money 💵 has been refunded, but you can still order items on our store 💪 .  reference code - $delivery_id"));
                $messaging->send($message);     
            }
        }

      DB::commit();

       if($orderlist){
       
        $stats =  $orderlist->update(['cartstatus' =>  'returns']);
        if($stats){
            return response()->json(['status' => 'success', 'message' => 'Order rejected succesfully']);
        }else{
            return response()->json(['status' => 'error', 'message' => 'Couldn\'t verify']);
        }
       }else{
        return response()->json(['status' => 'error', 'message'=> 'Couldn\'t verify']);
       }
    }catch(\Exception $e){
        DB::rollBack();
        Log::info('server', ['error' => $e]);
        return response()->json(['status' => 'error', 'message'=> $e->getMessage()]);
    }
    }

    public function LocalTransferAuth(Request $request){
        $request->validate([
            'amount' => 'required|numeric',
            'reasons',
            'recipient_id' => 'required',
        ]);



        $reference = Carbon::now()->setTimezone('Africa/Lagos')->format('Ymdhis');
        $currentdate = Carbon::now()->setTimezone(new \DateTimeZone('Africa/Lagos'))->format('Y-m-d H:i:s');

        $check_amount = VendorsWallet::where('username', Session::get('userid'))->first();

        if($check_amount->accountbalance < $request['amount']  || 0 == $request['amount'] ){
         return response()->json(['message' => 'Insufficient Balance', 'status' => 'error']);
        } 
        else{
           $new_amount = $check_amount->accountbalance - $request['amount'];
           $check_amount->update(['accountbalance' => $new_amount]);
        }
        $url = "https://api.paystack.co/transfer";
        $headers = [
            'Authorization' => "Bearer ".env('TEST_PAYSTACK_KEY'),
            'accept' => 'application/json',
        ];

        // charges occurres for 50 Naira instant charge
         $initial_m = $request->input('amount');
         $mealxpress_charge =  50;
         $current_amount = 0;
        // charges greater than 10,000
        if($initial_m >=  10000){
         $current_amount = $initial_m - $mealxpress_charge;
        }

       $current_amount = $initial_m;
    
        $requeststatus = Http::withHeaders($headers)->post($url, [
            "source" => "balance", 
            "reason" => $request->input('reason') ?? '', 
            "amount" => $current_amount, 
            "reference" => $reference,
            "recipient" => $request->input('recipient_id'),
        ]);
        $querydata = Stores::where('marketstoreid', Session::get('userid'))->first();
        if($querydata){
            $marketname = $querydata->marketstorename;
        }
    
     try{
       if($requeststatus->successful()){
       
         $transaction_data = new PayoutMethods([
            'username' => Session::get('userid'),
            'payout' => $currentdate,
            'recipient' => $marketname,
            'amount' => $request->input('amount'),
            'settleamount' => $current_amount,
            'referencecode' => $reference,
            'status' => 'inactive',
         ]);
         $transaction_data->save();
         if($transaction_data){
            return response()->json(['message' => 'Transaction went successfully', 'status' => 'success']);
         }else{
            return response()->json(['message' => 'Not successful', 'status' => 'failed']);
         }
     }else{
        $requeststatus->json();
                return response()->json(['message' => $requeststatus]);
            }
        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()]);
    }
}


    public function CreateTransferRecipient(Request $request){
        // verify users output
        $request->validate(
            [
              "account_number" => "required",
              "account_code" => 'required',
            ],
          );
          try {
          $accountnumber = $request['account_number'];
          $accountcode = $request['account_code'];
          $url = "https://api.paystack.co/bank/resolve?account_number=$accountnumber&bank_code=$accountcode";
          $headers = [
            'Authorization' => "Bearer ". env('TEST_PAYSTACK_KEY'),
            'accept' => 'application/json',
        ];
        $requestcall = Http::withHeaders($headers)->get($url);
        if($requestcall && $requestcall->successful()){
            $jsonbody = $requestcall->getbody();
            $status = $requestcall->getStatusCode();
            $data = json_decode($jsonbody);
            $account_name = $data->data->account_name;
            $account_num = $data->data->account_number;
            // create recipient
            $type = "nuban";
            $name = $account_name;
            $account = $account_num;
            $bankcode = $accountcode;
            $currency = "NGN";
            // create a recipient 
            $url = "https://api.paystack.co/transferrecipient";
            $headers = [
                'Authorization' => "Bearer ". env('TEST_PAYSTACK_KEY'),
                'accept' => 'application/json',
            ];
            $response = Http::withHeaders($headers)->post($url, [
                'type' => $type,
                'name' => $name,
                'account_number' => $account,
                'bank_code' => $bankcode,
                'currency' => $currency,
            ]);
        
            if($response->successful()){
            $responsejson = $response->getbody();
            $messagejson = json_decode($responsejson);
            $recipient = $messagejson->data->recipient_code;
            $bank = $messagejson->data->details->bank_name;
             $message =  [
                'message' => [
                'recipient' => $recipient,
                'account_name' => $name,
                ]
             ];
            return  response()->json($message);
            }

        }else{
            $body = $requestcall->json();
            $message =  [
                'message' => [
                    'recipient' => $body,
                'account_name' => 'Couldn\'t verify account',
                ]
             ];
            return response()->json($message);
        }
    }catch(\Exception $e){

        return response()->json(['message' =>  $e->getMessage()]);
    }
}
          

   public function PopulateBanks(Request $request){
    $request->validate([]);
    $fetchallbanks = BankLists::orderBy('id', 'ASC')->get();
    return response()->json(['data' => $fetchallbanks]);
   }

   public function ProductDelete(Request $request){
    $request->validate(['deleteid' => 'required|numeric']);
    $query = AllMarkets::where('id', $request->input('deleteid'))->first();
    if($query){
       $statuscheck = $query->delete();
       if($statuscheck){
        return response()->json(['statuscall' => 'success', 'message'=> 'Deleted successfully']);
       }else{
        return response()->json(['status' => 'failed', 'message'=> 'Oops Data not found']);
       }
    }
   }   

   public function CatDelete(Request $request){
    $request->validate(['deleteid' => 'required|numeric']);
    $query = storesubcategory::where('id', $request->input('deleteid'))->first();
    if($query){
       $statuscheck = $query->delete();
       if($statuscheck){
        return response()->json(['statuscall' => 'success', 'message'=> 'Deleted successfully']);
       }else{
        return response()->json(['status' => 'failed', 'message'=> 'Oops Data not found']);
       }
    }
   }

  public function NewProductUpload(Request $request){
    $request->validate([
        'productName' => 'required',
        'productPrice' => 'required',
        'productWeight' => 'required|numeric',
        'productCategory' => 'required',
        'ProductDescription' => 'required',
        'kgcall' => 'required',
        'productImage' => 'required|mimes:jpeg,png,webp,jpg,gif,svg|max:2048', // Validate the image if provided
    ]);

    try{
    $session_holder = Session::get('userid') ?? '' ;
        $image = $request->file('productImage');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        // $img = Image::read($image);

        // $img->resize(1200, 800, function($constraint){
        //     $constraint->aspectRatio();
        //     $constraint->upsize();
        // });

        // if($imageName === "jpg" || $imageName === "jpeg"){
        //     $img->encodeByExtension($imageName, 85);
        // }else if($imageName === "png"){
        //     $img->encodeByExtension($imageName, 9);
        // }else{
        //     $img->encodeByExtension($imageName, 85);
        // }

        $image->storeAs('mealxpress_images', $imageName, 'local');
        $catenate  = $request->input('productWeight') . $request->input('kgcall');
 
    $update = new AllMarkets([
        'marketproductid' => $session_holder,
        'marketproductoption' => $request->input('productCategory'),
        'marketproductweight' => $catenate,
        'marketimage' => $imageName,
        'marketstoredimages' => '',
        'marketproductprice' => $request->input('productPrice'),
        'marketproductname' => $request->input('productName'),
        'marketproductrequired' => 'active',
        'marketproducttotal_portion' => '0',
        'marketproductorder_date' => '',
        'marketproductlink' => $request->input('ProductDescription'),
    ]);
    $update->save();
    return response()->json(['status' =>'success', 'message' => 'Product Added successfully']);
    }catch(\Exception $e){
        return response()->json(['data' => $e->getMessage()]);
        }
  }
    //
public function UpdateCurrentProductList(Request $request)
{
    $request->validate([
        'ProductName' => 'required',
        'ProductPrice' => 'required',
        'ProductWeight' => 'required|numeric',
        'ProductID' => 'required',
        'ProductImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate the image if provided
    ]);
    if ($request->hasFile('ProductImage')) {
        $image = $request->file('ProductImage');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('mealxpress_images', $imageName,'local');
        // $image->move(public_path('mealxpress_images'), $imageName);
    }

    $allmarkets = AllMarkets::where('marketproductid', $request['ProductID'])->first();

    if ($allmarkets) {
        $updateData = [
            'marketproductname' => $request->ProductName,
            'marketproductprice' => $request->ProductPrice,
            'marketproductweight' => $request->ProductWeight,
        ];

        if (isset($imageName)) {
            $updateData['marketimage'] = $imageName;
        }

        $statuschecker = $allmarkets->update($updateData);

        if ($statuschecker) {
            return response()->json(['data' => 'Product updated successfully']);
        } else {
            return response()->json(['data' => 'Failed to update product'], 500);
        }
    } else {
        return response()->json(['data' => 'No product found'], 404);
    }
}

    function fetchCurrentProductList(Request $request){
      $request->validate(['uniqueid' => 'required']);
      $vendoreOrderList = AllMarkets::where('marketproductid', $request['uniqueid'])->first();
      if($vendoreOrderList){
       return response()->json(['status'=> 'success','data'=> $vendoreOrderList]);
      }else{
        return response()->json(['status'=> 'error','data'=> []]);
      }
    }

     public function VendorOrderListItems(Request $request){
      $request->validate(['itemid' => 'required']);

        $select = DB::select('SELECT marketid, productname, price,
        COALESCE(`portion`, 0), option, cartimage, cartweight, fullname, cartweight, total as ntotal,
        cartrefcode,
        email FROM  `user_order_lists` LEFT JOIN  `user_models` ON 
        user_order_lists.username = user_models.username WHERE
            user_order_lists.cartrefcode = :cartref',['cartref' => $request['itemid']]);
        if($select){
            return response()->json(['data' => $select]);
        }
     }

    public function VendorsLoginPost(Request $request){
        $request->validate([
                'contact' => 'required|numeric',
                'password' => 'required',
            ]);
        try{
       Log::info('Server', ['server' => $request['contact']]);
        $validatecheck = VendorsCredentials::where('contact', $request['contact'])->first();
        if($validatecheck && Hash::check($request['password'], $validatecheck->password)){
            $username = $validatecheck->vendorsMarketId;
            Session(['userid' => $validatecheck->vendorsMarketId]);
            return response()->json(['message' => $username, 'status' =>'success']);

        }else{
            return response()->json(['message' => 'Incorrect Details', 'status' => 'error']);
        }
    }catch(\Exception $e){
        return response()->json(['message' => $e->getMessage()]);
    }
} 


public function ForgotPassword(Request $request): void{
    $request->validate(['email' => '']);
}
        
}
