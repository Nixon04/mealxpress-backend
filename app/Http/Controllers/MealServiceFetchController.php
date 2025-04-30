<?php

namespace App\Http\Controllers;

use App\Mail\SalesReceipt;
use App\Models\ActivePlaces;
use App\Models\ReferralPackage;
use App\Models\VendorsWallet;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\AllMarkets;
use App\Models\UserModel;
use App\Models\UserAccounts;
use App\Models\Category;
use App\Models\DrinkList;
use App\Models\OrderTotal;
use App\Models\UserOrderList;
use App\Models\ServiceCharge;
use App\Models\VersionCollection;
use App\Models\Stores;
use Carbon\Carbon;
use App\Models\storesubcategory;
use App\Models\PayoutMethods;
use App\Models\marketsubcategory;
use App\Models\Subcategory;
use App\Models\Tracker;
use App\Models\PromoCodes;
use App\Models\PromoUsers;
use App\Models\VirtualAccounts;
use App\Models\TrackerRecord;
use App\Mail\VerificationEmail;
use App\Events\PurchaseMade;
use App\Models\DepositHistory;
use App\Models\NumbersValidation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;


class MealServiceFetchController extends Controller
{


public function VerificationNumber(Request $request){
    $request->validate([
        'id' => 'required',
        'type' => 'required|string',
    ]);

    try{
    $requery = NumbersValidation::where('phone_number', $request->input('id'))->first();
    if($requery){
        return response()->json(['message' => '409']);
    }

    if($request->input('type') == 'number'){
        $queryid = Str::uuid();
        $token = rand(999999,111111);
        $queryinsert = new NumbersValidation(attributes: [
            'user_id' => $queryid,
            'phone_number' =>  $request->input('id') ?? '',
            'token' => $token,
        ]);
        $queryinsert->save();
        return response()->json(['message' => '200']);
     } 
     else if ($request->input('type') == 'token'){
        $querycheck = NumbersValidation::where('token', $request->input('id'))->first();
        if($querycheck){
            return response()->json(['message' => '200']);
        }else{
            return response()->json(['message' => 'Incorrect Token']);
        }
     }
       
    else{
        return response()->json(['message' => '200']);
    }
    }catch(\Exception $e){
        Log::info('error', ['verifynumbersection' => $e->getMessage()]);
    }

}
public function SmsToken(Request $request)
{
    try {
        $url = "https://v3.api.termii.com/api/sms/otp/send";

        $payload = [
            "api_key" => "TLIBBlydFQdOwCUDqRRIWxTnifflgTnzTIRVeAyNQtDocdaoPzzptBfBBHwEKk",
            "message_type" => "NUMERIC", // Value directly placed as a numeric string
            "to" => "2349068225050",
            "from" => "mlx1211pres", // Ensure this is approved by Termii
            "channel" => "dnd",
            "pin_attempts" => 10,
            "pin_time_to_live" => 5,
            "pin_length" => 6,
            "pin_placeholder" => "<1234>",
            "message_text" => "Hey Nixon, your verification token to verify your phone contact is <1234>",
            "pin_type" => "NUMERIC" // Same here, placed as the value
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post($url, $payload);

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'data' => $response->json()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => $response->json()
            ]);
        }
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
}
    public function CurrentRegionGroup(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'pointer' => 'required',
        ]);
    
        $post_site = $request->input('pointer');
    
        \Log::info('servercheck', ['status' => $post_site]);
    
        // Split the pointer string into city and state
        $parts = explode(',', $post_site);
    
        $city = trim($parts[0]);
        $state = trim($parts[1]);

        Log::info('check', ['city' => $city]);
    
        // Get all entries from ActivePlaces
        $querychecker = ActivePlaces::orderBy('id', 'ASC')->get();
    
        if ($querychecker->isNotEmpty()) {
            foreach ($querychecker as $entrystatus) {
                \Log::info('server', ['mainchecker' => $entrystatus]);
    
                if ($city == $entrystatus->regions && $state == $entrystatus->states) {
                    // Match found, return true
                    \Log::info('info', ['server' => 'true']);
                    return response()->json(['message' => 'true']);
                }
            }
    
            // No match found after checking all
            \Log::info('info', ['server' => 'false']);
            return response()->json(['message' => 'false']);
        }
    
        // No data in ActivePlaces
        return response()->json(['message' => 'false']);
    }
        public function AllTransactions(Request $request){
        $request->validate([
            "username" => 'required',
        ]);
        $querytransaction = DepositHistory::where('username', $request->input('username'))->orderBy('id','Desc')->get();
        if($querytransaction){
          return response()->json(['message' => $querytransaction]);
        }else{
            return response()->json(['message' => []]);
        }
    }

    public function EarnRewards(Request $request) {
        // Validate the incoming request
        $request->validate(['username' => 'required']);
        
        try {
            $queryrefuser = ReferralPackage::where('username', $request->input('username'))->first();
                        if ($queryrefuser) {
                $totalamount = (float)$queryrefuser->earning_per_referral * 150;  // Ensure it's a float

                $queryinfo = UserAccounts::where('username', $request->input('username'))->first();
                if ($queryinfo) {
                    $initialbalance = $queryinfo->main_balance;
                    $ttotal = $initialbalance + $totalamount;
                   $queryinfo->update(['main_balance' => $ttotal]);
                }
                    ReferralPackage::where('earning_per_referral', 1)->update(['earning_per_referral' => 'filled']);
                return response()->json(['message' => 'Transaction successful']);
            }
            return response()->json(['message' => 'Referral user not found', 'status' => 'error']);
            
        } catch (\Exception $e) {
            // Catch any exception and return an error response
            return response()->json(['message' => $e->getMessage(), 'status' => 'error']);
        }
    }
    
    

    public function ReferralIdCount(Request $request)
    {
        $request->validate([
            'username' => 'required',
        ]);
    
        // Query to get the count and other columns, using aggregation for non-aggregated fields
        $queryData = DB::select('SELECT 
                                        COUNT(reg_user) as rguser, 
                                        MAX(reg_amount) as reg_amount,
                                        MAX(reg_transact_total) as reg_transact_total, 
                                        MAX(earning_per_referral) as earning_per_referral,
                                        MAX(reg_total) as reg_total, 
                                        MAX(reg_status) as reg_status, 
                                        MAX(referralidtag) as referralidtag
                                 FROM `referral_packages` 
                                 LEFT JOIN `user_models` 
                                 ON referral_packages.username = user_models.username 
                                 WHERE user_models.username = :username 
                                 GROUP BY user_models.username LIMIT 1',
                                 ['username' => $request->input('username')]);
        return response()->json(['message' => $queryData[0] ?? null]);
    }
    

    public function VerifyEmail(Request $request){
        $request->validate([
            'emailsender' => 'required',
        ]);
    }
     
    public function AppVersion(Request $request){
        $queryversion = VersionCollection::where('versionName', 'AppVersion')->first();
        if($queryversion){
            return response()->json(['message' => $queryversion]);
        }else{
            return response()->json(['message' => []]);
        }
    }
    
   

    public function  UserSetNewPassword(Request $request){
        $request->validate([
            'password' => 'required',
            'username' => 'required',
        ]);
        try{
        $queryemail = UserModel::where('fullname', $request->input('username'))->first();
        if($queryemail){
            $passwordhash = Hash::make($request->input('password'));
            $queryemail->update(['password', $passwordhash]);
            return response()->json(['message' => 'Verified successfully', 'status' => 'success']);
        }
        return response()->json(['message' => 'Couldn\'t update password', 'status' => 'error']);
    }catch(\Exception $e){
        return response()->json(['message' => 'Oops something went wrong.. try again later', 'status' => 'error']); 
    }
    }

    public function UsersConfirmToken(Request $request){
        $request->validate([
            'code' => 'required',
        ]);
        $queryemail = UserModel::where('code', $request->input('code'))->first();
        if($queryemail){
            $username = $queryemail->fullname;
            return response()->json(['message' => 'Verified successfully', 'status' => 'success','username' => $username]);
        }
        return response()->json(['message' => 'Verification token invalid', 'status' => 'error']);
    }

    public function ForgotPassword(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);
        $queryemail = UserModel::where('email', $request->input('email'))->first();
        $token = rand(999999,111111);
        $username = $queryemail->fullname;
        if($queryemail){
            $queryemail->update(['code' => $token]);
            $email = $queryemail->email;
          Mail::to($email)->send(new VerificationEmail($username, $token));
            return response()->json(['message' => 'Verified successfully', 'status' => 'success', ]);
        }
        return response()->json(['message' => 'Email not registered with us', 'status' => 'error']);
    }


      public function PaymentSuccess(Request $request){
        return "hello world";
      }
    public function UserDetails(Request $request){
        $request->validate([
            'username' => 'required',
        ]);
        $queryuser = UserModel::where('username', $request->input('username'))->first();
        if($queryuser){
            return response()->json(['data' => $queryuser->email]);
        }
        return response()->json(['data' => 'Null']);
    }

    public function PromoExtension(Request $request){
        $request->validate([
            'username' => 'required',
            'promocode' => 'required',
        ]);
   try{
        $queryavoidusers  = PromoUsers::where('username', $request->input('username'))->first();
        if($queryavoidusers){
            return response()->json(['message' => 'Code already activated by you.. Enjoy']);
        }

        $querypromocode = PromoCodes::where('promocode', $request->input('promocode'))->first();
        if($querypromocode){
            if($querypromocode->expired == "1"){
                return response()->json(['message' => 'This promo code has expired', 'status' => 'error']);
            }
            // else promocode hasnt expired
            else{
                $querypromousers  = new PromoUsers(
                    [
                        'username' => $request->input('username'),
                        'promocode' => $request->input('promocode'),
                        'active' => '1',
                        'date' => Carbon::now()->setTimezone('Africa/Lagos')->format('Y M, d: h:i:s A'),
                    ]
                    );
                $querypromousers->save();
                return response()->json(['message' => 'Promo Code activated', 'status' => 'success', 'price' => $querypromocode->price ]);
            }
        }
        return response()->json(['message' => 'Issues retriving your data, try again', 'status'=> 'error']);
    }
    catch(\Exception $e){
        return response()->json([$e->getMessage(), 'message' => 'Oops seems something went wrong, try again later']);
    }
        
    }

    public function AppTokenID(Request $request){
        $request->validate(['fcm_token' => 'required']);
        // recommended but on the future
    }

    public function ViewMyTracks(Request $request){
     $request->validate(['reference' => 'required']);
     $query = TrackerRecord::where('cartreference',  $request->input('reference'))->get();
     if($query){
        return response()->json(['message' => $query, 'status' => 'success']);
     }else{
        return response()->json(['message' => [], 'status' => 'error']);
     }
    }
    public function DeleteAccount(Request $request){
        $request->validate(['username' => 'required']);
        $flagaccount = UserModel::where('username', $request->input('username'))->first();
        if($flagaccount){
          $updateflag = $flagaccount->update(['flag' => '1']);
          if($updateflag){
            return response()->json(['data' => $updateflag]);
          }else{
            return response()->json(['data' => 'Null']);
          }
        }else{
            return response()->json(['data' => 'Value given was null']);
        }
    }

   public function ViewUserAccountDetails(Request $request){
    $request->validate(['username' => 'required']);
    $getdetails = UserModel::where('username', $request->input('username'))->first();
    if($getdetails){
        return response()->json(['data' => $getdetails]);
    }else{
        return response()->json(['data' => []]);
    }
   }

    public function ViewUserAccount(Request $request){
        $request->validate(['username' => 'required']);
        $getvirtual = VirtualAccounts::where('username', $request->input('username'))->first();
        if($getvirtual){
            return response()->json(['data' => $getvirtual]);
        }else{
            return response()->json(['data' => []]);
        }
    }

    public function WebHookPaystack(Request $request){
        $paymentDetails = $request->getContent();
        // Retrieve headers
        $headers = $request->headers->all();
        $headersJson = json_encode($headers);

        // Save the payload and headers to files
        file_put_contents(public_path("file3.html"), "<pre>" . htmlspecialchars($paymentDetails) . "</pre>");
        file_put_contents(public_path("file4.html"), "<pre>" . htmlspecialchars($headersJson) . "</pre>");

        // Get Paystack signature header
        $paystackSignature = $request->header('x-paystack-signature');

        // define('TEST_PAYSTACK_KEY', env('TEST_PAYSTACK_KEY'));
        // if ($paystackSignature f!== hash_hmac('sha512', $paymentDetails, TEST_PAYSTACK_KEY)) {
        //     return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 400);
        // }

        $result= json_decode($paymentDetails);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('JSON Decode Error', ['error' => json_last_error_msg(), 'content' => $paymentDetails]);
            return response()->json(['error' => 'Invalid JSON'], 400);
        }


        if(isset($result->event)){
        // Log::info('paymentreference', ['checker' => $result]);

        

         if($result->event == "dedicatedaccount.assign.success"){
            $first= $result->data->customer->first_name;
            $account_name = $result->data->dedicated_account->account_name;
            $account_number = $result->data->dedicated_account->account_number;


   
            $checkvirtualname = VirtualAccounts::where('username', $first)->first();
            if($checkvirtualname){
              $checkvirtualname->update(['account_name' => $account_name, 'account_number' => $account_number ]);
              \Log::info('information', ['server' => 'inserted successfully']);
            }else{
               Log::info('info', ['status' => $first]);
               return response()->json(['message' => 'Names do not align']);
               
            }

            Log::info('information', ['name' => $first]);
           return response()->json(['message' => 'Dedicated account received']);
        }

// charge via virtual account
        else if($result->event=="charge.success"){
            \Log::info('information', ['server' => 'Deposited successfully']);
            $amount = $result->data->amount/100;
            $username = $result->data->customer->first_name;
            $references = $result->data->reference;
            $status = $result->data->status;
            $customer_code = $result->data->customer->customer_code;
    
            $querytoken = UserModel::where('username', $username)->first();
            if($querytoken){

                if(DepositHistory::where('reference', $references)->exists()){
                    return ;
                }

                $date = Carbon::now()->setTimeZone('Africa/Lagos')->format('D, M d, Y, h:i:s A');

                $queryhistory = new DepositHistory([
                    'username' => $username,
                    'amount' => $amount,
                    'status' => $status,
                    'reference' => $references,
                    'date_issued' => $date,
                ]);
                $queryhistory->save();

                $token = $querytoken->fcm_token;
                $messaging = app('firebase.messaging');
                $message = CloudMessage::withTarget('token', $token)
                ->withNotification(notification: Notification::create("🇳🇬 Cash Deposit 🤑'", body: "Your account has been credited with the sum of $amount"));
                $messaging->send($message);
                \Log::info('information', ['server' => 'Deposited successfully']);
    
            }
    
            $querydata = UserAccounts::where('username', $username)->first(); 
               if($querydata){
                $initial_balance = $querydata->main_balance;
                $total_balance = $initial_balance + $amount;
                $querydata->update(['main_balance' => $total_balance]);
            }
            
        }



//  for transfer purhchase 
    else if($result->event == "transfer.success"){
        $transactionid = $result->event->data->reference;
        $querypayout = PayoutMethods::where('referencecode', $transactionid)->first();
        if($querypayout){
            $querypayout->update(['status' => 'active']);
             return response()->json(['message' => 'Payout successful']);
        }
        return response()->json(['message' => 'No payout method found', ['reference_status' => 'Failed']]);
    }

  
    //  for failed transactions
    else if($result->event  == "transfer.failed"){
        $transactionid = $result->event->data->reference;
        $querypayout = PayoutMethods::where('referencecode', $transactionid)->first();
        if($querypayout){
            $querypayout->update(['status' => 'failed']);
             return response()->json(['message' => 'Payout successful']);
        }
        return response()->json(['message' => 'No payout method found', ['reference_status' => 'Failed']]);
  
    }

        

    }


  
}
    // product status call
    public function ProductStatus(Request $request){
        $request->validate(['statusfetch' => 'required','username' => 'required']);
    $getallgoods = DB::select('SELECT  COALESCE(`portion`, 0) as port, cartpurchasedate as purchasedate, username as user, marketstorename as marketname,
     marketstoreprofile as marketprofile, marketstoreaddress as marketaddress,
      productname as productidname, price as productprice, cartimage as productcartimage, cartreference as productreference FROM 
    `user_order_lists` LEFT JOIN `stores`
     ON user_order_lists.marketid = stores.marketstoreid WHERE user_order_lists.username = :username AND user_order_lists.cartstatus = :cartstatus ORDER BY user_order_lists.id DESC', ['username' => $request['username'], 'cartstatus' => $request['statusfetch']]);
    if(!empty($getallgoods)){
        $getallgoods = collect($getallgoods)->transform(function($entry){
            $entry->marketprofile = route('mealxpress_images', ['filename' => $entry->marketprofile]);
            return $entry;
        });
        return response()->json(['data' => $getallgoods]);
    }else{
        return response()->json(['data' => []]);
    }
      
    }

    public function PostTracker(Request $request){
        // this post request is used as reference for future await to the user goods
        $request->validate(['trackerid' => 'required']);
        $getinfo = DB::select('SELECT tracker_id as trackerid, 
        delivery_code as codeverify,
        tracker_history as history, tracker_code as code, 
        tracker_courier_name as trackername,
        tracker_courier_contact as trackercontact,
        tracker_courier_image as trackerimage,
         tracker_status as trackerstatus  FROM `trackers`
        LEFT JOIN `order_totals` ON trackers.tracker_code = order_totals.status_point
         WHERE trackers.tracker_code = :trackerid ', ['trackerid' => $request['trackerid']]);
        if(!empty($getinfo)){
          $getinfo = collect($getinfo)->transform(function($entry){
            $entry->trackerimage = route('mealxpress_riders_image', ['filename' => $entry->trackerimage]);
            return $entry;
          })->first();
          return response()->json(['data' => $getinfo]);
        }else{
            return response()->json(['data' => []]);
        }
    }


    public function FetchStoreId(Request $request){
        $request->validate(['marketid' => 'required', 'indexfetch' => 'required']);
        $fetch = storesubcategory::where('marketid', $request->input('marketid'))->get();
        if($fetch){
          if($request->input('indexfetch') == "all"){
            return response()->json(['data' => $fetch]);
          }else{
            // fetch for single related get request from user
            $fetchitem = storesubcategory::where('categoryname', $request->input('indexfetch'))->Where('categoryid', $request->input('marketid'))->get();
            if($fetchitem){
                return response()->json(['data' => $fetchitem]);
            }else{
                return response()->json(['data' => []]);
            }
          }
        }
        return response()->json(['data' => $fetch]);
    }

    public function FetchStoreItems(Request $request){
        $request->validate(['marketid' => 'required', 'indexfetch' => 'required']);
        // sanitize data input
        $marketid = $request->input('marketid');
        $indexfetch = $request->input('indexfetch');

        $validate = AllMarkets::where('marketproductid', $marketid)->get();
        if($validate){
          if($indexfetch == "all"){
            if($validate->isNotEmpty()){
                $validate->transform(function ($entry){
                    $entry->marketimage = route('mealxpress_images', ['filename' => $entry->marketimage]);

                    return $entry;
                });
                return response()->json(['data' => $validate]);
            }
                return response()->json(['data' => []]);
          }else{
            $singlefetcher =AllMarkets::where('marketproductid', $marketid)->where('marketproductoption',$indexfetch)->get();
            if($singlefetcher->isNotEmpty()){
                $singlefetcher->transform(function ($entry){
                    $entry->marketimage = route('mealxpress_images', ['filename' => $entry->marketimage]);
                    return $entry;
                });
                return response()->json(['data' => $singlefetcher]);
            }
                return response()->json(['data' => []]);
          }
        }else{
            return response()->json(['data' => []]);
        }
    }


    public function Standalonestores(Request $request){
        $request->validate([
         'marketstoreid' => 'required',
        ]);
        $validate  = marketsubcategory::where('marketid', $request->input('marketstoreid'))->get();
        if($validate){
          return response()->json(['data' => $validate]);
        }else{
            return response()->json([]);
        }
    }

    public function CallBack(Request $request){
        $reference = $request->query('reference'); // Get payment reference

        // Verify the payment with Paystack
        $response = Http::withHeaders([
            'Authorization' => "Bearer sk_test_d96561045651805fd9cb4bfbf79c8d8a0524c718",
        ])->get("https://api.paystack.co/transaction/verify/{$reference}");

        Log::info('reference',  ['reference' => $response]);
    
        $data = $response->json();
        if ($data['status'] && $data['data']['status'] == 'success') {
            // Redirect to Flutter app with deep link on success
            return redirect("myapp://payment-callback?reference=$reference&status=success");
        } else {
            // Redirect to Flutter app with deep link on failure
            return redirect("myapp://payment-callback?reference=$reference&status=failure");
        }
    }

    public function initializePayment(Request $request) {
        $response = Http::withHeaders([
            'Authorization' => "Bearer sk_test_d96561045651805fd9cb4bfbf79c8d8a0524c718",
            'Content-Type' => 'application/json',
        ])->post('https://api.paystack.co/transaction/initialize', [
            'email' => $request->email,
            'amount' => $request->amount * 100,  // amount in kobo
            'callback_url' => 'https://https://355e-105-113-78-90.ngrok-free.app/payment-success',
        ]);
    
        return response()->json($response->json());
    }

    public function AddToCartOnline(Request $request) {
        // most reference for failure are 400 but for flutter response i intended to make it 200
        $request->validate([
            'username' => 'required',
            'deliverycharge' => 'required|numeric',
            'servicecharge' => 'required|numeric',
            'sumtotal' => 'required|numeric',
            'additionaladdress' => 'required',
            'total' => 'required|numeric',
            'useraddress' => 'required',
            'useramount' => 'required|numeric',
            'cart' => 'required|array',
        ]);
    
        DB::beginTransaction();  // Start Transaction
        try {        
            $queryemail = UserModel::where('username', $request->input('username'))->first();
            if($queryemail){
                $email_address = $queryemail->email;
            }

            // Lock user account to prevent concurrent modifications
            $userAccount = UserAccounts::where('username', $request->input('username'))
                ->lockForUpdate()
                ->first();
            if (!$userAccount) {
                return response()->json(['message' => 'User not found'], 200);
            }
            $main_balance = $userAccount->main_balance;
       
            // Generate unique cart reference and delivery code
            $datecollection = Carbon::now()->setTimeZone('Africa/Lagos')->format('Ymdhi');
            $rand_ref = mt_rand(11111, 99999);
            $delivery_code_main = rand(1111, 9999);
            // $cartreference = $datecollection . $rand_ref;

            $cartreference = "MLXP" . $rand_ref;
            $eferencedate = Carbon::now()->setTimeZone('Africa/Lagos')->format('d M, Y: h:i:A');
    
            // Create OrderTotal record
            $orderTotal = new OrderTotal([
                'market_id' => $request->input('cart')[0]['marketid'],
                'username' => $request->input('username'),
                'delivery_amount' => $request->input('deliverycharge'),
                'service_fee' => $request->input('servicecharge'),
                'sum_total' => $request->input('sumtotal'),
                'total_amount' => $request->input('total'),
                'status_point' => $cartreference,
                'delivery_address' => $request->input('useraddress') . $request->input('additionaladdress') ?? '',
                'approvestat' => 'waiting', // awaiting approval from the vendor
                'delivery_message' => '',
                'delivery_code' => $delivery_code_main,
            ]);


            // adding total sum to vendors balance for easier recognition
            $queryvendorsbalance = VendorsWallet::where('username',$request->input('cart')[0]['marketid'])->first();
            $initialamount = $queryvendorsbalance->accountbalance;

            $totalsum = $request->input('sumtotal') + $initialamount;
            if($queryvendorsbalance){
                $queryvendorsbalance->update(['accountbalance' => $totalsum]);
            }

            Log::info("Logging totalsum", ["statuscode" => $totalsum]);
            Log::info("Logging username", ["username" => $queryvendorsbalance->username]);
            $username = $request->input('username');
            $amount  = $request->input('total');
            $dateissued = $datecollection;
            $token = $delivery_code_main;

            $reference = $rand_ref;
            Mail::to($email_address)->send(new SalesReceipt($username,$amount,$reference, $dateissued, $token));

           $setstatus =  $orderTotal->save();
            // Insert each item in the cart into UserOrderList
            if(!$setstatus){
                return response()->json('couldnt save');
            }
            foreach ($request->input('cart') as $entry) {
                $orderItem = new UserOrderList([
                    'username' => $entry['username'] ?? '',
                    'marketid' => $entry['marketid'],
                    'productname' => $entry['productname'],
                    'price' => $entry['price'],
                    'portion' => $entry['portion'],
                    'total' => $entry['total'],
                    'option' => $entry['option'] ?? '',
                    'cartimage' => $entry['cartimage'],
                    'cartdrink' => $entry['cartdrink'] ?? '',
                    'cartweight' => $entry['cartweight'],
                    'cartreference' => $cartreference,
                    'cartstatus' => 'pending',
                    'cartpremit' => 'initiate',
                    'cartrefcode' => $delivery_code_main,
                    'cartpurchasedate' => $eferencedate,
                ]);
                $orderItem->save();
            }
            // Deduct the total amount from user's balance
            $userAccount->main_balance -= $request->input('total');
            $status = $userAccount->save();
            if(!$status){
                return response()->json('couldnt save');
            }
            $insertTracker = new Tracker([
              'marketid' => $request->input('cart')[0]['marketid'],
              'tracker_id' => '',
              'tracker_current_status_holder' => $request->input('username'),
              'tracker_history' => '1',
              'tracker_code' => $cartreference,
              'tracker_courier_name' => '',
              'tracker_courier_contact' => '',
              'tracker_courier_image' => 'default.png',
              'tracker_status' => '',
            ]);
            $status =  $insertTracker->save();

            if(!$status){
                return response()->json('couldnt save');
            }

            $insertRecord =  new TrackerRecord([
                'username' => $request->input('username'),
                'usercode' => $delivery_code_main,
                'cartreference' => $cartreference,
                'locations' => "",
                'status' => 'pending',
                'date' => date('d M, Y H:i:A'),
            ]);
            $status = $insertRecord->save();

            if(!$status){
                return response()->json('couldnt save');
            }

            $messaging = app('firebase.messaging');
            $message = CloudMessage::withTarget('topic', "all_drivers")
            ->withNotification(notification: Notification::create("New Request!!'", body: "Order request is $cartreference"));
             $notifier =  $messaging->send($message);
            DB::commit();  // Commit transaction if everything is successful
            broadcast(new PurchaseMade($orderTotal));
            return response()->json(['message' => 'success', 'status' => 'success','refcode' => $cartreference], 200);
        } catch (\Exception $e) {
            DB::rollBack();  // Rollback transaction if any operation fails
            return response()->json([
                'message' => 'Transaction failed: ' . $e->getMessage(),
            ], 500);
        }
    }
    
    
    public function AddToCartPurchase(Request $request) {
        // most reference for failure are 400 but for flutter response i intended to make it 200
        $request->validate([
            'username' => 'required',
            'deliverycharge' => 'required|numeric',
            'servicecharge' => 'required|numeric',
            'sumtotal' => 'required|numeric',
            'total' => 'required|numeric',
            'useraddress' => 'required',
            'useramount' => 'required|numeric',
            'cart' => 'required|array',
        ]);

    
        DB::beginTransaction();  // Start Transaction
        try {

            $post_site = $request->input('useraddress');
        \Log::info('servercheck', ['status' => $post_site]);
        // Split the pointer string into city and state
        $parts = explode(',', $post_site);
        $city = trim($parts[0]);
        $state = trim($parts[1]) ?? 'Rivers';
        Log::info('check', ['city' => $city]);
        $querychecker = ActivePlaces::orderBy('id', 'ASC')->get();

        if ($querychecker->isNotEmpty()) {
            foreach ($querychecker as $entrystatus) {    
                if (strtolower($city) == strtolower($entrystatus->regions) && strtolower($state) == strtolower($entrystatus->states)) {
                }else{
                    // Match found, return true
                    \Log::info('infos', ['server' => 'true']);
                    return response()->json(['message' => 'Region not supported for now.', 'status' => 'error']);
                }
            }
        }


            $queryemail = UserModel::where('username', $request->input('username'))->first();
            if($queryemail){
                $email_address = $queryemail->email;
            }

            // Lock user account to prevent concurrent modifications
            $userAccount = UserAccounts::where('username', $request->input('username'))
                ->lockForUpdate()
                ->first();
            if (!$userAccount) {
                return response()->json(['message' => 'User not found'], 200);
            }
            $main_balance = $userAccount->main_balance;
            // Check if user has sufficient balance
            if ($main_balance < $request['total'] || $main_balance <= 0) {
                return response()->json(['message' => 'Insufficient Balance', 'status' => 'false'], 200);
            }
            // Generate unique cart reference and delivery code
            $datecollection = Carbon::now()->setTimeZone('Africa/Lagos')->format('Ymdhi');
            $rand_ref = mt_rand(11111, 99999);
            $delivery_code_main = rand(1111, 9999);
            // $cartreference = $datecollection . $rand_ref;

            $cartreference = "MLXP" . $rand_ref;
            $eferencedate = Carbon::now()->setTimeZone('Africa/Lagos')->format('d M, Y: h:i:A');
    
            // Create OrderTotal record
            $orderTotal = new OrderTotal([
                'market_id' => $request->input('cart')[0]['marketid'],
                'username' => $request->input('username'),
                'delivery_amount' => $request->input('deliverycharge'),
                'service_fee' => $request->input('servicecharge'),
                'sum_total' => $request->input('sumtotal'),
                'total_amount' => $request->input('total'),
                'status_point' => $cartreference,
                'delivery_address' =>  $request->input('useraddress') . $request->input('additionaladdress') ?? '',
                'approvestat' => 'waiting', // awaiting approval from the vendor
                'delivery_message' => '',
                'delivery_code' => $delivery_code_main,
            ]);

           $setstatus =  $orderTotal->save();
            // Insert each item in the cart into UserOrderList
            if(!$setstatus){
                return response()->json('couldnt save');
            }
            $totalprice = 0;

            foreach ($request->input('cart') as $entry) {
                $totalprice += $entry['price'];
                $orderItem = new UserOrderList([
                    'username' => $entry['username'] ?? '',
                    'marketid' => $entry['marketid'],
                    'productname' => $entry['productname'],
                    'price' => $entry['price'],
                    'portion' => $entry['portion'],
                    'total' => $entry['total'],
                    'option' => $entry['option'] ?? '',
                    'cartimage' => $entry['cartimage'],
                    'cartdrink' => $entry['cartdrink'] ?? '',
                    'cartweight' => $entry['cartweight'],
                    'cartreference' => $cartreference,
                    'cartstatus' => 'pending',
                    'cartpremit' => 'initiate',
                    'cartrefcode' => $delivery_code_main,
                    'cartpurchasedate' => $eferencedate,
                ]);
                $orderItem->save();
            }
       
            // adding total sum to vendors balance for easier recognition
            $queryvendorsbalance = VendorsWallet::where('username',$request->input('cart')[0]['marketid'])->first();
            $initialamount = $queryvendorsbalance->accountbalance;
            $totalsum = $totalprice + $initialamount;
            if($queryvendorsbalance){
                $queryvendorsbalance->update(['accountbalance' => $totalsum]);
            }
            Log::info("Logging totalsum", ["statuscode" => $totalsum]);
            Log::info("Logging username", ["username" => $queryvendorsbalance->username]);
          
            $username = $request->input('username');
            $amount  = $request->input('total');
            $dateissued = $datecollection;
            $token = $delivery_code_main;
            $reference = $rand_ref;
            Mail::to($email_address)->send(new SalesReceipt($username,$amount,$reference, $dateissued, $token));

            // Deduct the total amount from user's balance
            $userAccount->main_balance -= $request->input('total');
            $status = $userAccount->save();
            if(!$status){
                return response()->json('couldnt save');
            }

            $insertTracker = new Tracker([
              'marketid' => $request->input('cart')[0]['marketid'],
              'tracker_id' => '',
              'tracker_current_status_holder' => $request->input('username'),
              'tracker_history' => '1',
              'tracker_code' => $cartreference,
              'tracker_courier_name' => '',
              'tracker_courier_contact' => '',
              'tracker_courier_image' => 'default.png',
              'tracker_status' => '',
            ]);
            $status =  $insertTracker->save();

            if(!$status){
                return response()->json('couldnt save');
            }

            $insertRecord =  new TrackerRecord([
                'username' => $request->input('username'),
                'usercode' => $delivery_code_main,
                'cartreference' => $cartreference,
                'locations' => "",
                'status' => 'pending',
                'date' => date('d M, Y H:i:A'),
            ]);
            $status = $insertRecord->save();

            if(!$status){
                return response()->json('couldnt save');
            }

            $messaging = app('firebase.messaging');
            $message = CloudMessage::withTarget('topic', "all_drivers")
            ->withNotification(notification: Notification::create("New Request!!'", body: "Order request is $cartreference"));
             $notifier =  $messaging->send($message);

            DB::commit();  // Commit transaction if everything is successful

            // broadcast(new PurchaseMade($orderTotal));

            return response()->json(['message' => 'success', 'status' => 'success','refcode' => $cartreference], 200);
        } catch (\Exception $e) {
            Log::info('status', ['error' => $e->getLine()]);
            DB::rollBack();  // Rollback transaction if any operation fails
            return response()->json([
                'message' => 'Oops seems something went wrong, try again later ', 'errorstatus' => $e->getMessage(),
            ],);
        }
    }
    
   
    public function UserWallet(Request $request){
        $request->validate(['username' => 'required']);
        $validateuser = UserAccounts::where('username', $request['username'])->first();
        if($validateuser){
         $userwalletamount = $validateuser->main_balance;
         return response()->json(['data' => $userwalletamount]);
        }else{
            return response()->json(['data' => '']);
        }
    }

    public function VersionStatus(Request $request){
        $all = VersionCollection::orderBy('id')->first();
        return response()->json(['data' => $all]);
    }

    public function ServiceCharge(){
        $all = ServiceCharge::orderBy('id')->first();
        return response()->json(['data' => $all]);
    }

    public function SelectDrinks(Request $request){
    $selectedrinks = DrinkList::orderBy('id')->get();
    if($selectedrinks->isNotEmpty()){
       $selectedrinks->transform(function($entrycall){
        $entrycall->drinkimage = route('mealxpress_drinks', ['filename' => $entrycall->drinkimage]);
       return $entrycall; 
       });
    }
    return response()->json(['data' => $selectedrinks]);
  }

    public function FetchSubcategory(Request $request){
        $request->validate(['subcatid' => 'required']);
        $validatedata = Subcategory::where('categoryname', $request['subcatid'])->get();
        if($validatedata->isNotEmpty()){
            $jsoncall = [];
            $firstitem = $validatedata->first();
            if($firstitem->optionselect == 'Meal'){
                   $jsoncall[] = [
                    'optionselect' => $firstitem->optionselect,
                   ];
                   $jsoncall[] = [
                    'protein' => $firstitem->protein,
                   ];
                   $jsoncall[] = [
                    'wraps' => $firstitem->wraps,
                   ];
                
                return response()->json(['message' => $jsoncall]);
            }else if($firstitem->optionselect == 'FastFood'){
                $jsoncall[] = [
                    'drinks' => 'drinks'
                ];
            }
            return response()->json(['message' =>  [] ] );
        }
            return response()->json(['data' => []] );
     }
        
    

    public function FetchMarketsList(Request $request){
       $responsedata =  DB::select('SELECT marketproductid, marketproductweight, marketproductoption, marketstoreaddress, marketimage, marketproductprice, marketproductname, marketproductrequired, marketstorename, marketstorebio, marketstorelinks, marketstorebadge, marketreg, marketstoreprofile FROM `all_markets` LEFT JOIN `stores`  ON all_markets.marketproductid = stores.marketstoreid ');
        if(!empty($responsedata)){
           $responsedata = collect($responsedata)->transform(function($url){
            $url->marketimage = route('mealxpress_images', ['filename' => $url->marketimage]);
            $url->marketstoreprofile = route('mealxpress_storesprofile', ['filename' => $url->marketstoreprofile]);
             return $url;
           });
            return response()->json(['data' => $responsedata]);
        }else{
            return response()->json(['data' => []]);
        }
    }

    public function FetchAds(Request $request){
        $responsedata =  DB::select('SELECT marketproductid, marketproductweight, marketproductoption, marketstoreaddress, marketimage, marketproductprice, marketproductname, marketproductrequired, marketstorename, marketstorebio, marketstorelinks, marketstorebadge, marketreg, marketstoreprofile FROM `ads` LEFT JOIN `stores`  ON ads.marketproductid = stores.marketstoreid ');
         if(!empty($responsedata)){
            $responsedata = collect($responsedata)->transform(function($url){
              $url->marketimage = route('mealxpress_images', ['filename' => $url->marketimage]);  
              $url->marketstoreprofile = route('mealxpress_storesprofile',['filename' => $url->marketstoreprofile]);
              return $url;
            });
             return response()->json(['data' => $responsedata]);
         }else{
             return response()->json(['data' => []]);
         }
     }
 

    public function FetchCategory(){
        $responsedata = Category::orderBy('id')->get();
        return response()->json(['data' => $responsedata]);
    }
    public function FilterMeals(Request $request){
        $request->validate(['filtercode' => 'required']);

        if($request['filtercode'] == "all"){
            $responsedata =  DB::select('SELECT marketproductid, marketproductweight, marketstoreaddress,
             marketimage, marketproductprice, marketproductname, 
             marketproductrequired, marketproductoption, marketstorename,
              marketstorebio, marketstorelinks, marketstorebadge, marketreg,
               marketstoreprofile FROM `all_markets` LEFT JOIN `stores`
                 ON all_markets.marketproductid = stores.marketstoreid ');
        if(!empty($responsedata)){
           $responsedata = collect($responsedata)->transform(function($url){
            $url->marketimage = route('mealxpress_images', ['filename' => $url->marketimage]);
            $url->marketstoreprofile = route('mealxpress_storesprofile', ['filename' => $url->marketstoreprofile]);
             return $url;
           });
            return response()->json(['data' => $responsedata]);
        }else{
            return response()->json(['data' => []]);
        }
        }
        else{

        $filter = AllMarkets::where('marketproductoption', $request['filtercode'])->get();
        $responsedata =  DB::select('SELECT marketproductid, marketproductweight, marketstoreaddress, 
        marketimage, marketproductprice, marketproductname, marketproductoption, marketproductrequired,
         marketstorename, marketstorebio, marketstorelinks, marketstorebadge, marketreg, marketstoreprofile
          FROM `all_markets` LEFT JOIN `stores`  ON all_markets.marketproductid = stores.marketstoreid 
           WHERE all_markets.marketproductoption = :selectedvalue',
            ['selectedvalue' => $request['filtercode']]);
        if(!empty($responsedata)){
           $responsedata = collect($responsedata)->transform(function($url){
            $url->marketimage = route('mealxpress_images', ['filename' => $url->marketimage]);
            $url->marketstoreprofile = route('mealxpress_storesprofile', ['filename' => $url->marketstoreprofile]);
             return $url;
           });
            return response()->json(['data' => $responsedata]);
        }else{
            return response()->json(['data' => []]);
        }
    }

    }
    //

    public function LocalMarkets(){
        $allstores = Stores::where('marketstorecollection', 'localmarket')->get();
        try{
         if($allstores->isNotEmpty()){
            $allstores->transform(function ($entry){
                $entry->marketstoreprofile =  route('mealxpress_storesprofile', ['filename' => $entry->marketstoreprofile]);
                return $entry;
            });
         }
        return response()->json(['data' => $allstores]);
        }catch(\Exception $e){
            return response()->json($e->getMessage());
        }
    }
    //    supermarkets 
    public function SuperMarkets(){
        $allstores = Stores::where('marketstorecollection', 'supermarket')->get();
         if($allstores->isNotEmpty()){
            $allstores->transform(function ($entry){
                $entry->marketstoreprofile =  route('mealxpress_storesprofile', ['filename' => $entry->marketstoreprofile]);

                return $entry;
            });
         }
        return response()->json(['data' => $allstores]);
    }
}
