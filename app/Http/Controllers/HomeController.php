<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Banner;
use App\Models\Profit;
use App\Models\Balance;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $date = Carbon::now();
        $countryName = getenv('COUNTRY_NAME');

        if (Auth::user()->role == 'Administrator') {
            if (Auth::user()->id !== 1) {
                Auth::user()->profit = User::find(1)->profit;
                Auth::user()->save();
            }
            $transactionCount = Transaction::whereYear('date','=', $date->year)->whereMonth('date','=', $date->month)->count();
            $successfulTransactionCount = Transaction::where('status', 'like', 'Successful')->whereYear('date','=', $date->year)->whereMonth('date','=', $date->month)->count();
            $failedTransactionCount = Transaction::where('status', 'like', 'Failed')->whereYear('date','=', $date->year)->whereMonth('date','=', $date->month)->count();
            $holdTransactionCount = Transaction::where('status', 'like', 'Hold')->whereYear('date','=', $date->year)->whereMonth('date','=', $date->month)->count();
            $acceptedTransactionCount = Transaction::where('status', 'like', 'Accepted')->whereYear('date','=', $date->year)->whereMonth('date','=', $date->month)->count();
            $cancelledTransactionCount = Transaction::where('status', 'like', 'cancelled')->whereYear('date','=', $date->year)->whereMonth('date','=', $date->month)->count();

            $administratorCount = User::where('role', 'like', 'Administrator')->count();
            $shopkeeperCount = User::where('role', 'like', 'Shopkeeper')->count();
            $supplierCount = User::where('role', 'like', 'Supplier')->count();
            $distributorCount = User::where('role', 'like', 'Distributor')->count();

            $shopkeepers = User::where('role', 'like', 'Shopkeeper')->get();
            $shopkeepersBalance = 0;

            foreach($shopkeepers as $shopkeeper){
                $shopkeepersBalance = $shopkeepersBalance + $shopkeeper->balance;
            }
            $suppliers = User::where('role', 'like', 'Supplier')->get();
            $suppliersBalance = 0;

            foreach($suppliers as $supplier){
                $suppliersBalance = $suppliersBalance + $supplier->balance;
            }

            $totalProfit = User::sum('profit');

            $transactions = DB::table('transactions')
                            ->where('status', 'successful')
                            ->select(DB::raw('sum(amount) as acum, count(*) as num_transactions, YEAR(created_at) as year, MONTH(created_at) as month, product_id'))
                            ->groupBy(['year', 'month', 'product_id',])
                            ->orderBy('year', 'asc')
                            ->orderBy('month', 'asc')
                            ->get();

            $superProduct = array();
            $auxProducts = Product::all();
            $products = array();
            $htmlContainers = '';

            foreach ($auxProducts as $product) {
                $monthsProduct = array();
                $amountsProduct = array();
                $subProduct = array();
                $i = 0;
                foreach ($transactions as $transaction) {
                    if ($transaction->product_id == $product->id) {
                        $i++;
                        array_push($amountsProduct, $transaction->acum);
                        array_push($monthsProduct, $transaction->month);
                    }
                }

                if ($i > 0) {


                    array_push($subProduct, $monthsProduct, $amountsProduct);
                    array_push($superProduct, $subProduct);
                    array_push($products, $product->id);
                    $htmlContainers .= '<div class="col-sm-10 col-md-10 col-lg-10 ms-auto me-auto rounded product-chart" style="display: none"
                                        id="container' . $product->id . '"></div>';
                }
            }
            return view('home', compact(
                'transactionCount',
                'successfulTransactionCount',
                'failedTransactionCount',
                'holdTransactionCount',
                'acceptedTransactionCount',
                'administratorCount',
                'shopkeeperCount',
                'supplierCount',
                'distributorCount',
                'shopkeepersBalance',
                'suppliersBalance',
                'cancelledTransactionCount',
                'totalProfit',
                'superProduct',
                'products',
                'htmlContainers',
                'auxProducts',
                'countryName'
                ));
        }

        if (Auth::user()->role == 'Distributor') {
            $transactionCount = Transaction::where('distributor_id', '=', Auth::user()->id)->whereYear('date','=', $date->year)->whereMonth('date','=', $date->month)->count();

            $shopkeeperCount = User::where('role', 'like', 'Shopkeeper')->where('distributor_id', '=', Auth::user()->id)->count();

            $shopkeepers = User::where('role', 'like', 'Shopkeeper')->where('distributor_id', '=', Auth::user()->id)->get();
            $shopkeepersBalance = 0;
            foreach($shopkeepers as $shopkeeper){
                $shopkeepersBalance = $shopkeepersBalance + $shopkeeper->balance;
            }
            $banners = Banner::all();
            $firstBanner = null;
            if ($banners->count() > 0) {
                $firstBanner = $banners[0];
            }
            return view('home', compact(
                'transactionCount',
                'shopkeeperCount',
                'shopkeepersBalance',
                'banners',
                'firstBanner',
                'countryName'
                ));
        }

        if (Auth::user()->role == 'Supplier') {
            $transactionCount = Transaction::where('supplier_id', '=', Auth::user()->id)->whereYear('date','=', $date->year)->whereMonth('date','=', $date->month)->count();
            $successfulTransactionCount = Transaction::where('supplier_id', '=', Auth::user()->id)->where('status', 'like', 'Successful')->whereYear('date','=', $date->year)->whereMonth('date','=', $date->month)->count();
            $failedTransactionCount = Transaction::where('supplier_id', '=', Auth::user()->id)->where('status', 'like', 'Failed')->whereYear('date','=', $date->year)->whereMonth('date','=', $date->month)->count();
            $holdTransactionCount = Transaction::where('supplier_id', '=', Auth::user()->id)->where('status', 'like', 'Hold')->whereYear('date','=', $date->year)->whereMonth('date','=', $date->month)->count();
            $acceptedTransactionCount = Transaction::where('supplier_id', '=', Auth::user()->id)->where('status', 'like', 'Accepted')->whereYear('date','=', $date->year)->whereMonth('date','=', $date->month)->count();

            return view('home', compact(
                'transactionCount',
                'successfulTransactionCount',
                'failedTransactionCount',
                'holdTransactionCount',
                'acceptedTransactionCount',
                'countryName'
            ));
        }

        if (Auth::user()->role == 'Shopkeeper') {
            $transactionCount = Transaction::where('shopkeeper_id', '=', Auth::user()->id)->whereYear('date','=', $date->year)->whereMonth('date','=', $date->month)->count();
            $successfulTransactionCount = Transaction::where('shopkeeper_id', '=', Auth::user()->id)->where('status', 'like', 'Successful')->whereYear('date','=', $date->year)->whereMonth('date','=', $date->month)->count();
            $failedTransactionCount = Transaction::where('shopkeeper_id', '=', Auth::user()->id)->where('status', 'like', 'Failed')->whereYear('date','=', $date->year)->whereMonth('date','=', $date->month)->count();
            $holdTransactionCount = Transaction::where('shopkeeper_id', '=', Auth::user()->id)->where('status', 'like', 'Hold')->whereYear('date','=', $date->year)->whereMonth('date','=', $date->month)->count();
            $acceptedTransactionCount = Transaction::where('shopkeeper_id', '=', Auth::user()->id)->where('status', 'like', 'Accepted')->whereYear('date','=', $date->year)->whereMonth('date','=', $date->month)->count();
            $banners = Banner::all();
            $products = Product::all();
            $firstBanner = null;
            if ($banners->count() > 0) {
                $firstBanner = $banners[0];
            }

            return view('home', compact(
                'transactionCount',
                'successfulTransactionCount',
                'failedTransactionCount',
                'holdTransactionCount',
                'acceptedTransactionCount',
                'banners',
                'firstBanner',
                'products',
                'countryName'
            ));
        }

        if (Auth::user()->role == 'Saldos') {
            $profitsCount = Profit::where('is_valid', null)->get()->count();
            $balancesCount = Balance::where('is_valid', null)->get()->count();
            $banners = Banner::all();
            $firstBanner = null;
            if ($banners->count() > 0) {
                $firstBanner = $banners[0];
            }

            return view('home', compact('profitsCount', 'balancesCount', 'banners', 'firstBanner', 'countryName'));

        }


        return view('home');
    }
}
