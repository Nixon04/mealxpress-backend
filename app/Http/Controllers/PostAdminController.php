<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Stores;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\AdminLoginDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\VendorsCredentials;
use App\Models\VendorsWallet;
use App\Models\DriverAccountWallets;
use App\Models\DriversPersonalInfo;
use App\Models\UserModel;
use App\Models\DrinkList;
use App\Models\ActivePlaces;
use App\Models\Ads;
use App\Models\AllMarkets;
use App\Models\storesubcategory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

use Carbon\Carbon;
class PostAdminController extends Controller
{
    //

    // Route::post('/prisent/dashboard/addcategory', 'AddCategory');



    public function AddRegions(Request $request){
        $request->validate([
          'states' => 'required|string',
          'locationInput' => 'required|string'
        ]);

        try{
        $date = Carbon::now()->setTimezone('Africa/Lagos')->format('Y,M d : h:i:a A');
        $queryinsert = new ActivePlaces([
            'states' => $request->input('states'),
            'regions' => $request->input('locationInput'),
            'status' => 'active',
            'date_issued' => $date,
        ]);
        $queryinsert->save();
        return response()->json(['message' => 'Successfully Added', 'status' => 'success']);
        }catch(\Exception $e){
            return response()->json(['message' => 'Oops Seems Something went wrong', 'status' => 'error']);
        }
    }
    

    public function NewProductUpload(Request $request){
        $request->validate([
            'productName' => 'required',
            'productPrice' => 'required',
            'productWeight' => 'required|numeric',
            'productID' => 'required',
            'kgcall' => 'required',
            'productImage' => 'required|mimes:jpeg,png,webp,jpg,gif,svg|max:2048', // Validate the image if provided
        ]);
        try{

            if (Ads::count() > 4) {
                return response()->json([
                    'message' => 'You can\'t add more than 5 catalog.',
                    'status' => 'error'
                ]);
            }
            $queryID = VendorsCredentials::where('vendorsMarketId', $request->input('productID'))->first();
            if(!$queryID){
             return response()->json(['message' => 'Vendor ID couldn\'t be identified..', 'status' => 'error']);
            }
            $image = $request->file('productImage');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('mealxpress_images', $imageName, 'local');
            // $image->move(public_path('mealxpress_images'), $imageName);
            $catenate  = $request->input('productWeight') . $request->input('kg');
     
        $update = new Ads([
            'marketproductid' => $request->input('productID'),
            'marketproductoption' => '',
            'marketproductweight' => $catenate,
            'marketimage' => $imageName,
            'marketstoredimages' => '',
            'marketproductprice' => $request->input('productPrice'),
            'marketproductname' => $request->input('productName'),
            'marketproductrequired' => 'active',
            'marketproducttotal_portion' => '0',
            'marketproductorder_date' => '',
            'marketproductlink' => ' '
        ]);
        $update->save();
        return response()->json(['status' =>'success', 'message' => 'Product Added successfully']);
        }catch(\Exception $e){
            return response()->json(['data' => $e->getMessage()]);
            }
      }


      public function DeleteLocation(Request $request){
        $request->validate(['deleteid' => 'required|numeric']);
        $query = ActivePlaces::where('id', $request->input('deleteid'))->first();
        if($query){
           $statuscheck = $query->delete();
           if($statuscheck){
            return response()->json(['statuscall' => 'success', 'message'=> 'Deleted successfully']);
           }else{
            return response()->json(['status' => 'failed', 'message'=> 'Oops Data not found']);
           }
        }
      }

      public function DeleteAd(Request $request){
        $request->validate(['deleteid' => 'required|numeric']);
        $query = Ads::where('id', $request->input('deleteid'))->first();
        if($query){
           $statuscheck = $query->delete();
           if($statuscheck){
            return response()->json(['statuscall' => 'success', 'message'=> 'Deleted successfully']);
           }else{
            return response()->json(['status' => 'failed', 'message'=> 'Oops Data not found']);
           }
        }
       }  

    public function DeleteCategory(Request $request){
        $request->validate(['deleteid' => 'required|numeric']);
        $query = Category::where('id', $request->input('deleteid'))->first();
        if($query){
           $statuscheck = $query->delete();
           if($statuscheck){
            return response()->json(['statuscall' => 'success', 'message'=> 'Deleted successfully']);
           }else{
            return response()->json(['status' => 'failed', 'message'=> 'Oops Data not found']);
           }
        }
       }   

    public function AddCategory(Request $request){
        $request->validate([
            'categoryname' =>  'required',
            'categoryitem' => 'required',
            'optionselect' => 'required',
            'protein' => 'required',
            'wraps' => 'required',
        ]);
        try{
        $querydata = Category::where('categoryname', $request->input('categoryname'))->first();
        if($querydata){
            return response()->json(['message' => 'Category is already added', 'status' => 'error']);
        }
        $queryinsert = new Category([
            'categoryname' => $request->input('categoryname'),
            'categoryitem' => $request->input('categoryitem'),
            'status' => 'active',
            'availability' => 'active',
            'flag' => '1',
        ]);
        $queryinsert->save();
        // queries for subcategory insert

        $querysubinsert = new Subcategory([
            "categoryname" =>  $request->input('categoryname'),
            "categorysubname" => $request->input('categoryitem'),
            "subcategorydropdown" => '',
            'optionselect' =>  $request->input('optionselect'),
            'protein' =>  $request->input('protein') ?? '',
            'wraps' => $request->input('wraps') ?? '',
            "availability" => '0',
            "flag" => '0'
        ]);

        $querysubinsert->save();

        return response()->json(['message' => 'Category Added successfully', 'status' => 'success']);
        }catch(\Exception $e){
            return response()->json([ 'message' => $e->getMessage()]);
      }
    }

    public function PostDeleteDrinks(Request $request){
        $request->validate(['deleteid' => 'required|numeric']);
        $query = DrinkList::where('id', $request->input('deleteid'))->first();
        if($query){
           $statuscheck = $query->delete();
           if($statuscheck){
            return response()->json(['statuscall' => 'success', 'message'=> 'Deleted successfully']);
           }else{
            return response()->json(['status' => 'failed', 'message'=> 'Oops Data not found']);
           }
        }   
    }


    public function PostDrinks(Request $request){
        $request->validate([
            'drinkname' => 'required',
            'drinkprice' => 'required|numeric',
            'drinkimage' => 'required|mimes:jpg,jpeg,png,max:2083',
        ]);
        try{
            $querydrink = DrinkList::where('drinkname', $request->input('drinkname'))->first();
            if($querydrink){
                return response()->json(['message' => 'Drink Already recorded', 'status' => 'error']);
            }
            $image = $request->file('drinkimage');
            $getimagename = time() . '.' . uniqid() . '.'.  $image->getClientOriginalExtension();
            $path = $image->storeAs('mealxpress_drinks', $getimagename, 'local');
        
            $queryinsert = new DrinkList(
            [
                'drinkname' => $request->input('drinkname'),
                'drinkprice' => $request->input('drinkprice'),
                'drinkquantity' =>  '1',
                'drinkimage' => $getimagename ?? '',
                'option_status' => 'true',
                'designated_schedule_future_time' => '',
            ]
            );
            $status =  $queryinsert->save();
            if($status){
            return response()->json(['message' => 'Uploaded successfully','status' => 'success']);
           }else{
            return response()->json(['message' => 'Not successful','status' => 'error']);

           }
        
        }catch(\Exception $e){
            return response()->json([$e->getMessage()]);
        }
    }

    public function AdminSendNotification(Request $request)
    {
            $request->validate([
                'title' => 'required',
                'message' => 'required',
            ]);
            // $token = $querydata->fcm_token;
            // Initialize the Firebase Messaging service
            $messaging = app('firebase.messaging');
            // Create the notification message
            $message = CloudMessage::withTarget('topic', "all_users")
                ->withNotification(notification: Notification::create($request->title, $request->message));
            // Send the message
            try {
                $response = $messaging->send($message);
                return response()->json(['message' => "success", 'status' => 'success', 'response' => $response]);
            } catch (\Exception $e) {
                return response()->json([ 'message' => 'Error',  'status' => "false", 'error' => $e->getMessage()], 500);
        }
    }

   public function AdminPostDrivers(Request $request){
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'contact' => 'required|numeric',
            'kin' => 'required|string',
            'kincontact' => 'required|numeric',
            'imageprofile' => 'required|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

    //  query checker
      $querychecker = DriversPersonalInfo::where('contact', $request->input('contact'))->first();
            if($querychecker){
                if($querychecker->email == $request->input('email')){
                    return response()->json(['status'=> 'error','message'=> 'Email Already Registered']);
                }
                else if($querychecker->kincontact == $request->input('kincontact')){
                    return response()->json(['message' => 'KinContact is Registered Already','status' => 'error']);
            }
        }

        $hash  =  Hash::make($request->input('password'));

        $randid = rand(999999, 111111);
        $uniqueID = 'MLXPD-'.$randid;
        $date_of_reg = Carbon::now()->setTimezone('Africa/Lagos')->format('d M, Y h:i A');

        $getName = $request->file('imageprofile');
        $getImageName = time() . '.'. uniqid() .'.'.  $getName->getClientOriginalExtension(); 

        $path = $getName->storeAs('mealxpress_images', $getImageName, 'local');
        // $getName->move(public_path('mealxpress_images'), $getImageName);
    
        // or new drivers console 
        $insertdata = new DriversPersonalInfo([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
            'password' => $hash,
            'nextofkin' => $request->input('kin'),
            'fcm_token' => '',
            'kincontact' => $request->input('kincontact'),
            'trackerid' => $uniqueID,
            'image' => $getImageName,
        ]);
        $insertdata->save();
        // wallet creation
        $insertwallet = new DriverAccountWallets([
            'username' => $uniqueID,
            'walletbalance' => '0.0',
            'flag' => '0',
        ]);
        $insertwallet->save();
        return response()->json(['message' => 'Drivers Account Created Successfully', 'status' => 'success']);
    }


    public function AdminPostVendors(Request $request){
        $request->validate([
            'vendorContact' => 'required',
            'vendorEmail' => 'required',
            'vendorSenderMail' => 'required',
            'vendorBusiness' => 'required',
            'vendorCity' => 'required',
            'vendorState' => 'required',
            'vendorStoreName' => 'required',
            'vendorBio' => 'required',
            'vendorAddress' => 'required',
            'vendorhours' => 'required',
            'productImage' => 'required',
            'vendorcollection' => 'required',
            'vendorsPassword' => 'required',
        ]);

        // insert vendors credentials
        $query = VendorsCredentials::where('email_address', $request['vendorEmail'])->first();
         if($query){
            if($query->contact == $request['vendorContact']){
                return response()->json(['message' => 'Contact Already Registered','status' => 'error']);
            }
            if($query->legalbusiness == $request['vendorBusiness']){
                return response()->json(['message' => 'Legal Business Already Registered ','status' => 'error']);
            }
        }
        $imageproduct = $request->file('productImage');
        $imagestamp = time() .'.'. uniqid() .'.'. $imageproduct->getClientOriginalExtension();
        $path = $imageproduct->storeAs('mealxpress_storesprofile', $imagestamp, 'local');
         if(!$path){
            return response()->json(['null']);
         }
       try{
        $randid = rand(999999, 111111);
        $uniqueID = 'MLXPV-'.$randid;
        $date_of_reg = Carbon::now()->setTimezone('Africa/Lagos')->format('d M, Y h:i A');
        $passwordhash = Hash::make($request->input('vendorsPassword'));

        $insertquery = new VendorsCredentials([
            'vendorsMarketId' => $uniqueID,
            'password' => $passwordhash,
            'contact' =>  $request->input('vendorContact'),
            'email_address' =>  $request->input('vendorEmail'),
            'sendermail' =>  $request->input('vendorSenderMail'),
            'legalbusiness' =>  $request->input('vendorBusiness'),
            'city' =>  $request->input('vendorCity'),
            'state' =>  $request->input('vendorState'),
            'fcm_token' => " ",
            'code' => '',
            'last_updated' => '',
            'info_check' => '',
            'date_of_reg' => $date_of_reg,
        ]);
        $insertquery->save();

        // insert new created wallet
        $insertwallet = new VendorsWallet([
            'username' => $uniqueID,
            'accountbalance' => '0',
            'flag' => '0'
        ]);
        $insertwallet->save();

      
        $insertsecondquery = new Stores([
            'marketstoreid' => $uniqueID,
            'marketstorename' => $request->input('vendorStoreName'),
            'marketstorebio' => $request->input('vendorBio'),
            'marketstorelinks' => '',
            'marketstorebadge' => '0',
            'marketreg' => $date_of_reg,
            'marketstatus' => 'active',
            'marketsupportcourse' => '',
            'marketstoreprofile' => $imagestamp,
            'marketstorecollection' => $request->input('vendorcollection'),
            'marketstoreaddress' => $request->input('vendorAddress'),
            'activehours' => $request->input('vendorhours'),
            'session' => '0',
        ]);
        $insertsecondquery->save();

        $catid = 'MLXPS_'. rand(999999,111111);
         $querysubcat = new storesubcategory([
           'marketid' => $uniqueID,
           'categoryid' => $catid,
           'categoryname' => 'all',
           'categorylistdropdown' => 'drink',
           'flag' => '1',
           'status' =>'active',
         ]);
         $querysubcat->save();

        return response()->json(['message' => 'Vendors Account Created Successfully', 'status' => 'success']);

    }catch(\Exception $e){
        return response()->json([$e->getMessage()]);
    }
 } 


    public function AdminPostLogin(Request $request){
        $request->validate([
                'contact' => 'required|numeric',
                'password' => 'required',
            ]);
        try{
        $validatecheck = AdminLoginDetails::where('contact', $request->input('contact'))->first();
        if($validatecheck && Hash::check($request['password'], $validatecheck->password)){
            $username = $validatecheck->firstname;
            return response()->json(['message' => $username, 'status' =>'success']);
        }else{
            return response()->json(['message' => 'Incorrect Details', 'status' => 'error']);
        }
    }catch(\Exception $e){
        return response()->json(['message' => $e->getMessage()]);
    }
  }
}
