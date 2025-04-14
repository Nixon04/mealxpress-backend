<?php

namespace App\Http\Controllers;

use App\Models\ReferralPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ResponseHelper;
use App\Models\UserModel;
use App\Models\VersionCollection;
use Illuminate\Support\Facades\Log;
use App\Models\UserAccounts;
use App\Models\VirtualAccounts;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;



class MealServerController extends Controller
{

   public function LoginControl(Request $request){
        $request->validate([
            'contact' => 'required|numeric',
            'password' => 'required',
            'fcm_token' => '',
        ]);
        try{
        $validatecheck = UserModel::where('contact', $request['contact'])->first();
        if($validatecheck->flag == "1"){
            return response()->json([ 'message' => 'Account was deactivated',  'status' => 'notactive']);
        }
        if($validatecheck && hash::check($request['password'], $validatecheck->password)){
            $username = $validatecheck->username;
            // update fcmtoken
            $validatecheck->update(['fcm_token' => $request->input('fcm_token') ?? '']);
            return response()->json(['message' => $username, 'status' =>'success']);
        }else{
            return response()->json(['message' => 'Password and username not valid', 'status' => 'error']);
        }
    }catch(\Exception $e){
        return response()->json(['message' => $e->getMessage()]);
    }
    }
    //
    public function SignupCheckup(Request $request){
        $request->validate(['username' => 'required|String']);
        $usercheck = UserModel::where('username', $request['username'])->first();
        if($usercheck){
            return ResponseHelper::jsonResponse('false', 200, 'User already registered');
        }
        return ResponseHelper::jsonResponse('true', 200,'unsuccessful');
    }

    public function SigupConfig(Request $request){

        // return response()->json(['message' => 'sa,']);
       $request->validate([
             'fullname' => 'required',
             'username' => 'required',
             'email' => 'required',
             'referralflag' => 'required',
             'contact' => 'required',
             'password' => 'required',
             'referraltag',
        ]);

        
        $hashpassword = Hash::make($request['password']);
        $validateuser = UserModel::where('contact', $request['contact'])->first();
        $referralgeneratecode = rand(999999,111111);
        if($validateuser){
            if($validateuser->email == $request['email']){
                return ResponseHelper::jsonResponse('false', 200,'Email already exist');
            }
            if($validateuser->contact == $request['contact']){
                return ResponseHelper::jsonResponse('false', 200,'Contact already exist');
            }
            if($validateuser->username == $request['email']){
                return ResponseHelper::jsonResponse('false', 200,'Username already exist');
                // this is incase there is an outdoor false request
            } 
        }
        try{
            DB::beginTransaction();

            $queryusersdata = UserModel::where('referralidtag', $request->input('referraltag'))->first();
            if($queryusersdata){
                $invitee = $queryusersdata->username;
                $insertrefpackage = new ReferralPackage(
                    [
                        "username" => $invitee,
                        "reg_user" => $request->input('username'),
                        "reg_amount" => "0",
                        "reg_transact_total" => "0",
                        "earning_per_referral" => "0",
                        "reg_total" => "0",
                        "reg_status" => "pending",
                    ],
                );
                $insertrefpackage->save();
            }

        $insertdata = new UserModel([
            'fullname' => $request->input('fullname'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'fcm_token' => '',
            'flag' => '0',
            'contact' => $request->input('contact'),
            'password' => $hashpassword,
            'referral_code' =>  $request->input('referralflag'),
            'referralidtag' => $referralgeneratecode,
            'image' => '0',
            'code' => '0',
            'referral' => '1'
        ]);
        $insertdata->save();
        $url = "https://api.paystack.co/dedicated_account/assign";
        $headers = [
           'Authorization' => "Bearer " . env('PAYSTACK_SECRET_KEY'),
           'accept' => 'application/json',
       ];
       $response = Http::withHeaders($headers)->post($url, [
           "email" => $request['email'],
           "first_name" => $request['username'],
           "middle_name" => " ",
           "last_name" => "Doe",
           "phone" => $request['contact'],
           "preferred_bank" => "test-bank",
           "country" => "NG"
       ]);
       if($response->successful()){
        $getjson = json_decode($response->getBody());
         $checkvirtualaccountuser = VirtualAccounts::where('username', $request['username'])->first();
         if($checkvirtualaccountuser){
          return response()->json(['Name for this particular user is already registered']);
         }
        $date = Carbon::now()->setTimeZone('Africa/Lagos')->format('m d, Y : h:i:s');
        $insertvalue = new VirtualAccounts([
          "username" => $request['username'],
          "account_name" => "0",
          "account_number" => "0",
          "current_bank" => "WEMA",
          "date" => $date,
      ]);
        $insertvalue->save();
       $jsondecode = json_decode($response->body());  
    //    return response()->json(['message' => $getjson]);
        }
       
        if($insertdata){
//  insert data for new users account
        $insertnewaccounts = new UserAccounts([
            'username' => $request->input('username'),
            'main_balance' => '0',
            'bonus' => '0',
        ]);
        }
        DB::commit();
        
        $insertnewaccounts->save();
        if($insertnewaccounts){
            return ResponseHelper::jsonResponse('true', 200, 'Register successfully');
        }
    }catch(\Exception $e){
        DB::rollback();
        return ResponseHelper::jsonResponse('false', 500,$e->getMessage());
    }    
    }

    public function Mealserver(Request $request){
        return 'Hello';
    }
}
