<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\{Order,OrderDetails, Distributors, Products, ProductVariants, Categories, User, 
    ActivityLog, Suppliers, WareHouseManagement, InventoryStock, Payments, CreditManagement};
use App\Repositories\CreditRepository;
use DB;

class CreditManagementsController extends Controller
{
    protected $model;
    public function __construct(CreditManagement $credit)
    {
       // set the model
       $this->model = new CreditRepository($credit);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        if(auth()->user()->hasRole('Administrator') OR(
            auth()->user()->hasRole('Admin'))){
            $credit =CreditManagement::orderBy('credit_id', 'desc')->get();
            return view('administrator.credits.index')->with([
                "credit" => $credit,
               
            ]);
        }else{
            $inve = WareHouseManagement::where([
                'user_id'=> auth()->user()->user_id,
            ])->exists();
            if($inve){
                $inv = WareHouseManagement::where('user_id', auth()->user()->user_id)->first();
                $ware_house_id = $inv->ware_house_id;
                $cre =  CreditManagement::where([
                    'ware_house_id' => $ware_house_id, 
                ])->orderBy('credit_id', 'desc')->get();
                return view('administrator.credits.index')->with([
                    
                    "cre" => $cre,
                    "inv" => $inv,
                ]);
            }else{
                return redirect()->back()->with([
                    'error' => " You Do Not Belong To Any Ware House",
                ]);
            }
        }
        
    }

    public function paid()
    {
        if(auth()->user()->hasRole('Administrator') OR(
            auth()->user()->hasRole('Admin'))){
            $credit =CreditManagement::where('paid_status', 1)->orderBy('credit_id', 'desc')->get();
            return view('administrator.credits.paid')->with([
                "credit" => $credit,
            ]);
        }else{
            $inve = WareHouseManagement::where([
                'user_id'=> auth()->user()->user_id,
            ])->exists();
            if($inve){
                $inv = WareHouseManagement::where([
                    'user_id'=> auth()->user()->user_id,
                ])->first();
                $ware_house_id = $inv->ware_house_id;
                $cre =  CreditManagement::where([
                    'ware_house_id' => $ware_house_id, 
                    'paid_status' => 1,
                ])->orderBy('credit_id', 'desc')->get();
                $credit =CreditManagement::where('paid_status', 1)->orderBy('credit_id', 'desc')->get();
                return view('administrator.credits.paid')->with([
                
                    "cre" => $cre,
                    "inv" => $inv,
                ]);
            }else{
                return redirect()->back()->with([
                    'error' => " You Do Not Belong To Any Ware House",
                ]);
            }
        }
        
    }

    public function unpaid()
    {
        if(auth()->user()->hasRole('Administrator') OR(
            auth()->user()->hasRole('Admin'))){
            $credit =CreditManagement::where('paid_status', 0)->orderBy('credit_id', 'desc')->get();
            return view('administrator.credits.unpaid')->with([
                "credit" => $credit,
            ]);
        }else{
            $inve = WareHouseManagement::where([
                'user_id'=> auth()->user()->user_id,
            ])->exists();
            if($inve){
                $inv = WareHouseManagement::where([
                    'user_id'=> auth()->user()->user_id,
                ])->first();
                $ware_house_id = $inv->ware_house_id;
                $cre =  CreditManagement::where([
                    'ware_house_id' => $ware_house_id, 
                    'paid_status' => 1,
                ])->orderBy('credit_id', 'desc')->get();
                $credit =CreditManagement::where('paid_status', 0)->orderBy('credit_id', 'desc')->get();
                return view('administrator.credits.unpaid')->with([
                
                    "cre" => $cre,
                    "inv" => $inv,
                ]);
            }else{
                return redirect()->back()->with([
                    'error' => " You Do Not Belong To Any Ware House",
                ]);
            }
        }
    }

    public function clearCredit($payment_number)
    {
        
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
