<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Mail\VerificationEmail;
use App\Models\Stores;
use App\Models\UserModel;
use Inertia\Inertia;
use App\Models\UserOrderList;
use App\Models\AllMarkets;
use App\Models\Category;
use App\Models\VendorsWallet;
use App\Models\PayoutMethods;
use App\Models\storesubcategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller


{
    
    public function EmailRoute(){
        return view('route.home');
    }

    public function VendorsMenu(){
        return Inertia::render('vendorspath/dashboard/menu');
    }

    public function VendorsChangePassword(){
        return Inertia::render('vendorspath/auth/changepassword');
    }
    public function VendorsConfirmToken(){
        return Inertia::render('vendorspath/auth/confirmtoken');
    }

    // public function Filament(){
    //     try {
    //         $username = "nixon";
    //         Mail::to('nixonsampson@gmail.com')->send(new VerificationEmail($username));
    //         // Return success response
    //         return response()->json(['status' => 'true'], 200);  // 200 OK
    //     } catch (\Exception $e) {
    //         // Return error response
    //         return response()->json([
    //             'status' => 'false',
    //             'error' => $e->getMessage()
    //         ], 500);  // 500 Internal Server Error
    //     }
    // }

    public  function VendorsLogout(){
        session::pull('userid');
        Inertia::render('vendorspath/auth/login');
    }
    
    public function FetchRecord() {
        // Get the current year dynamically
        $currentYear = now()->year;
    
        $monthlyData = DB::table('user_order_lists')
            ->selectRaw('MONTHNAME(created_at) as month, SUM(total) as total')
            ->whereYear('created_at', $currentYear) 
            // Filter by the current year
            ->where('marketid', Session::get('userid'))
            ->groupByRaw('MONTHNAME(created_at), MONTH(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->get();
    
        // Ensure all months are present with zero values if no data exists
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        
        $formattedData = array_map(function ($month) use ($monthlyData) {
            $data = $monthlyData->firstWhere('month', $month);
            return [
                'month' => $month,
                'total' => $data->total ?? 0
            ];
        }, $months);
    
        return response()->json(['returns' => $formattedData]);
    }
    


    public function AddCategory(){
        
        if(!Session::has('userid')){
            return Inertia::render('vendorspath/auth/login');
          }
          $getsubcategory = storesubcategory::Where('marketid',Session::get('userid'))->whereNotIn('categoryname',['all'])->orderBy("id","DESC")->get();
          $excluded = $getsubcategory->pluck('categoryname');
          $excluded->push('all');
          $imagequery = Stores::where('marketstoreid', Session::get('userid'))->first();
          $imagefetch = route('mealxpress_storesprofile', ['filename' => $imagequery->marketstoreprofile ]);
          $getcategory = Category::whereNotIn('categoryname', $excluded)->orderBy("id","DESC")->get();
          
        return Inertia::render('vendorspath/dashboard/addcategories', ['image' => $imagefetch,'data' => $getcategory, 'vendorcat' => $getsubcategory]);
    }

    public function HomeIndex(){
        return Inertia::render('home');
    }
    public function LoginPage(){
        return Inertia::render('vendorspath/auth/login');
    }
    public function ForgotPassword(){
        return Inertia::render('vendorspath/auth/forgotpassword');
    }
    public function VendorsDashboard(){
        if(!Session::has('userid')){
          return Inertia::render('vendorspath/auth/login');
        }
        $username = Session::get('userid');
        $fetch = UserOrderList::where('marketid',$username)->get();
        $imagequery = Stores::where('marketstoreid', $username)->first();
        $imagefetch = route('mealxpress_storesprofile', ['filename' => $imagequery->marketstoreprofile ]);

        $getamount = VendorsWallet::where('username',$username)->first();
        $useramount = $getamount->accountbalance;
        $datacall = $fetch->where('marketid', $username)->take(4)->values();
        $totalsum = $fetch->sum('price');
        $salescount = $fetch->count();
        $vendoramount = $getamount->accountbalance;
        return Inertia::render('vendorspath/dashboard/home', ['image' => $imagefetch, 'data' => $datacall, 'accountbalance' => $vendoramount, 'totalsum' => $totalsum, 'salescount' => $salescount, 'useramount' => $useramount]);
    }


    public function VendorsProducts(){
        if(!Session::has('userid')){
            return Inertia::render('vendorspath/auth/login');
          }
        return Inertia::render('vendorspath/dashboard/products');
    }
    public function VendorsTransactions(){
        if(!Session::has('userid')){
            return Inertia::render('vendorspath/auth/login');
          }
        return Inertia::render('vendorspath/dashboard/transactions');
    }

    
    public function VendorsInvoices(){
        if(!Session::has('userid')){
            return Inertia::render('vendorspath/auth/login');
          }
        return Inertia::render('vendorspath/dashboard/invoices');
    }
    public function VendorsSettings(){
        if(!Session::has('userid')){
            return Inertia::render('vendorspath/auth/login');
          }
          
          $storeslist = DB::select('SELECT  marketstorename, marketstorebio, marketstorelinks, marketstorelinks, marketstorebadge, marketstatus, marketstoreprofile,
          marketstorecollection, marketstoreaddress, activehours, contact, email_address, sendermail, legalbusiness,
          city, state FROM stores
             LEFT JOIN vendors_credentials ON stores.marketstoreid = vendors_credentials.vendorsMarketid');
                $storeslist = collect($storeslist)->transform(function ($item) {
                    $item->marketstoreprofile = route('mealxpress_storesprofile', ['filename' => $item->marketstoreprofile ]);
                    // $item->marketstoreprofile = "http://192.168.0.101:9000/mealxpress_storesprofile/" . $item->marketstoreprofile;
                    return $item;
                })->first();

        $imagequery = Stores::where('marketstoreid', Session::get('userid'))->first();
        $imagefetch = route('mealxpress_storesprofile', ['filename' => $imagequery->marketstoreprofile ]);
        return Inertia::render('vendorspath/dashboard/settings', ['imageref' => $imagefetch, 'data' => $storeslist]);
    }


    public function VendorsDelivery(){
        if(!Session::has('userid')){
            return Inertia::render('vendorspath/auth/login');
          }
        return Inertia::render('vendorspath/dashboard/delivery');
    }

    public function VendorsOrders()
    {  
        // Check if user is logged in
        if (!Session::has('userid')) {
            return Inertia::render('vendorspath/auth/login');
        }
    
        // Fetch and filter data to ensure unique cart references, sorted by ID
        $fetch = UserOrderList::where('marketid', Session::get('userid'))
            ->orderBy('id', 'DESC')
            ->get();
    
        // Filter out duplicate cart references
        $filteredResults = $fetch->unique('cartreference')->values();
    
        // Group by cart status and count occurrences
        $filcount = $filteredResults->countBy(function ($entry) {
            return $entry->cartstatus;
        });
    
        // Counters for statuses (with default values)
        $orders = $filcount->get('pending', 0);
        $delivered = $filcount->get('delivered', 0);
        $returns = $filcount->get('returns', 0);
        $cancelled = $filcount->get('cancelled', 0);
    
        // Data grouped by cart status
        $data = [
            'pending' => $filteredResults->where('cartstatus', 'pending')->values(),
            'delivered' => $filteredResults->where('cartstatus', 'delivered')->values(),
            'returns' => $filteredResults->where('cartstatus', 'returns')->values(),
            'cancelled' => $filteredResults->where('cartstatus', 'cancelled')->values(),
        ];

        $imagequery = Stores::where('marketstoreid', Session::get('userid'))->first();
        $imagefetch = route('mealxpress_storesprofile', ['filename' => $imagequery->marketstoreprofile ]);
    
        // Return data to the view
        return Inertia::render('vendorspath/dashboard/orders', [
            'image' => $imagefetch,
            'data' => $filteredResults,
            'orders' => $orders,
            'delivered' => $delivered,
            'returns' => $returns,
            'datareturns' => $data,
            'cancelled' => $cancelled,
        ]);
    }
        
    
    public function VendorsPayout(){
        if(!Session::has('userid')){
            return Inertia::render('vendorspath/auth/login');
          }

        $imagequery = Stores::where('marketstoreid', Session::get('userid'))->first();
        $imagefetch = route('mealxpress_storesprofile', ['filename' => $imagequery->marketstoreprofile ]);
    
        $payoutmethodstype = PayoutMethods::Where('username', Session::get('userid'))->orderBy('id', 'DESC')->get();
       return Inertia::render('vendorspath/dashboard/payouts',['image' => $imagefetch,  "data" => $payoutmethodstype]);
    }

    public function ListProducts(){
        if(!Session::has('userid')){
            return Inertia::render('vendorspath/auth/login');
          }
        $user_session = Session::get('userid');
        $getallmarkets = AllMarkets::where('marketproductid', Session::get('userid'))->orderBy('id', 'DESC')->get();




        if($getallmarkets->isNotEmpty()){
            $getallmarkets->transform(function($entry){
            // $entry->marketimage = "http://192.168.0.101:9000//mealxpress_images/".$entry->marketimage;
            $entry->marketimage = route('mealxpress_images', ['filename' =>  $entry->marketimage]);
            return $entry;
            });
        }


        $excluded = $getallmarkets->pluck('categoryname');
        $excluded->push('all');
        $imagequery = Stores::where('marketstoreid', Session::get('userid'))->first();
        $imagefetch = route('mealxpress_storesprofile', ['filename' => $imagequery->marketstoreprofile ]);

        $getcategory = storesubcategory::where('marketid', Session::get('userid'))->whereNotIn('categoryname',['all'])->orderBy("id","DESC")->get();

        return Inertia::render('vendorspath/dashboard/listproducts',
        ['userid' => $user_session,
        'image' => $imagefetch,
        'data' => $getallmarkets,
        'cat'=> $getcategory,
    ]);
    }
  

    
}
