<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\{Order,OrderDetails, Distributors, Products, ProductVariants, Categories, User, 
    ActivityLog, Suppliers, WareHouseManagement, InventoryStock, Payments};
use App\Repositories\OrderRepository;
use DB;
use Str;
use Illuminate\Support\Facades\Auth;
class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('Administrator') OR(
            auth()->user()->hasRole('Admin'))){
            $payment =  Payments::orderBy('payment_id', 'desc')->get();
            return view('administrator.sales.index')->with([
                "payment" => $payment,
                
            ]);
        }else{
            $inve = WareHouseManagement::where([
                'user_id'=> auth()->user()->user_id,
            ])->exists();
            if($inve){
                $inv = WareHouseManagement::where('user_id', auth()->user()->user_id)->first();
                $ware_house_id = $inv->ware_house_id;
                $pay =  Payments::where([
                    'ware_house_id'=> $inv->ware_house_id]
                )->orderBy('payment_id', 'desc')->get();
                return view('administrator.sales.index')->with([
                // "payment" => $payment,
                    "pay" => $pay,
                    "inv" => $inv,
                    //"invoice" => $invoice,
                ]);
            }else{
                return redirect()->back()->with([
                    'error' => " You Do Not Belong To Any Ware House",
                ]);
            }
        }
       
        
    }

    public function monthly_report()
    {
        $month = date('Y-m');
        if(auth()->user()->hasRole('Administrator') OR(
            auth()->user()->hasRole('Admin'))){
            
            $payment =  Payments::orderBy('payment_id', 'desc')->get();
            return view('administrator.sales.monthly_sales')->with([
                "payment" => $payment,
                
            ]);
        }else{
            $inve = WareHouseManagement::where([
                'user_id'=> auth()->user()->user_id,
            ])->exists();
            if($inve){
                $inv = WareHouseManagement::where('user_id', auth()->user()->user_id)->first();
                $ware_house_id = $inv->ware_house_id;
                $pay =  Payments::where([
                    'ware_house_id'=> $inv->ware_house_id]
                )->orderBy('payment_id', 'desc')->get();
                return view('administrator.sales.monthly_sales')->with([
                // "payment" => $payment,
                    "pay" => $pay,
                    "inv" => $inv,
                    //"invoice" => $invoice,
                ]);
            }else{
                return redirect()->back()->with([
                    'error' => " You Do Not Belong To Any Ware House",
                ]);
            }
        }
       
        
    }

    public function report()
    {
        $payment =Order::orderBy('order_id', 'desc')->get();
        return view('administrator.sales.report')->with([
            "payment" => $payment,
            //"invoice" => $invoice,
        ]);
    }

    public function invoice()
    {
        if(auth()->user()->hasPermissionTo('order-invoice')){

            $inv = WareHouseManagement::where('user_id', auth()->user()->user_id)->first();
            $ware_house_id = $inv->ware_house_id;
            $invo =  OrderDetails::where([
                'ware_house_id'=> $ware_house_id]
            )->get();
            $invoice =  OrderDetails::orderBy('details_id', 'desc')->get();
            return view('administrator.sales.invoice')->with([
                "invoice" => $invoice,
                "invo"=> $invo,
                "inv" => $inv,
            ]);
            
            return view('administrator.orders.invoice')
                ->with([
                
                "invoice" => $invoice,

            ]);
        } else{
            return  redirect()->route("order.create")->with([
                'error' => "You Dont have Access To Sales",
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
