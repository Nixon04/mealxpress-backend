<?php

namespace App\Http\Controllers;

use App\Models\OrderTotal;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\UserOrderList;
use App\Models\UserModel;
use App\Models\DrinkList;
use App\Models\Ads;
use App\Models\Category;
use App\Models\ActivePlaces;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    //


    public function ActiveRegions(){
        $querycategory = ActivePlaces::orderBy('id','DESC')->get();
        return Inertia::render('prisent/dashboard/regions', ['data' => $querycategory]);
    }

    public function Ads(){
        $queryads = Ads::orderBy('id','DESC')->get();
        $querycategory = Category::orderBy('id','DESC')->get();
        return Inertia::render('prisent/dashboard/ads',['ads' => $querycategory, 'data' => $queryads]);
    }
     public function AddDrinks(){
        $drinkslist = DrinkList::orderBy('id','DESC')->get();
        if($drinkslist->isNotEmpty()){
            $drinkslist->transform(function($url){
                // $url->drinkimage = "http://127.0.0.1:9000/mealxpress_drinks/" .$url->drinkimage;
                $url->drinkimage = route('mealxpress_drinks', ['filename' => $url->drinkimage ?? '']);
                return $url;
            });

        }
        return Inertia::render('prisent/dashboard/drinks',['data' => $drinkslist]);
     }
    public function AdminLogin(Request $request){
        return Inertia::render('prisent/auth/login');
    }
    public function AdminDashboard(Request $request){
        // $ordersum = OrderTotal::sum(DB::raw('delivery_amount + service_fee'));
        // $totalsum = OrderTotal::sum(DB::raw('total_amount'));
        // $totalcount = OrderTotal::count();

//i think this is better for lessened queries
        $totals = OrderTotal::selectRaw(
            '
            SUM(delivery_amount + service_fee) as ordersum,
            SUM(total_amount) as totalsum,
            COUNT(*) as totalcount
            '
        )->first();
        $ordersum = $totals->ordersum;
        $totalsum  = $totals->totalsum;
        $totalcount = $totals->totalcount;
        return Inertia::render('prisent/dashboard/home', 
        [
            'data' => $ordersum,
            'ordersum' => $ordersum,
            'totalsum' => $totalsum,
            'totalcount' => $totalcount,
        ]);
    }
    public function AdminSales(Request $request){
        $fetch = UserOrderList::orderBy('id','DESC')->get();
        return Inertia::render('prisent/dashboard/currentsales', ['data' => $fetch]);
    }

    public function AdminCategory(){
        $querycategory = Category::orderBy('id','DESC')->get();
        return Inertia::render('prisent/dashboard/category', ['data' => $querycategory]);
    }
    public function AdminPayouts(Request $request){
        return Inertia::render('prisent/dashboard/payouts');
    }
    public function AdminUsers(Request $request){
        $query = DB::select('SELECT fullname, email, contact, main_balance FROM user_models  LEFT JOIN user_accounts ON user_models.username = user_accounts.username');
        return Inertia::render('prisent/dashboard/regusers', ['data' => $query]);
    }
    public function AdminVendors(Request $request){
        $query = DB::select('SELECT vendorsMarketId, contact, email_address, sendermail, legalbusiness, city, state, date_of_reg FROM vendors_credentials  LEFT JOIN vendors_wallets ON vendors_credentials.vendorsMarketId = vendors_wallets.username');
        return Inertia::render('prisent/dashboard/vendors', ['data' => $query]);
    }
    public function AdminDrivers(Request $request){
        $query = DB::select('SELECT firstname, lastname, email, contact, nextofkin, kincontact, trackerid FROM drivers_personal_infos  LEFT JOIN driver_account_wallets ON drivers_personal_infos.firstname = driver_account_wallets.username');
        return Inertia::render('prisent/dashboard/drivers', ['data' => $query]);
    }
    public function AdminLogout(Request $request){
        return Inertia::render('prisent/dashboard/logout');
    }
    public function AdminAppNotification(Request $request){
      return Inertia::render('prisent/dashboard/sendappnotification');
    }
    
}
