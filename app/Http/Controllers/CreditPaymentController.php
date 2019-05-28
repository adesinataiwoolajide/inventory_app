<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Order,OrderDetails, Distributors, Products, ProductVariants, Categories, User, 
    ActivityLog, Suppliers, WareHouseManagement, InventoryStock, Payments, CreditManagement, 
    CreditPayment};
use App\Repositories\CreditPaymentRepository;
use DB;
use Illuminate\Support\Facades\Auth;

class CreditPaymentController extends Controller
{
    protected $model;
    public function __construct(CreditPayment $pay)
    {
       // set the model
       $this->model = new CreditPaymentRepository($pay);
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
            $credit =CreditPayment::orderBy('pay_id', 'desc')->get();
            return view('administrator.credits.payment')->with([
                "credit" => $credit,
            ]);
        }else{
            $inv = WareHouseManagement::where('user_id', auth()->user()->user_id)->first();
            $ware_house_id = $inv->ware_house_id;
            
            $cre =  CreditPayment::where([
                'ware_house_id'=> $inv->ware_house_id]
            )->orderBy('pay_id', 'desc')->get();
            return view('administrator.credits.payment')->with([
                "cre" => $cre,
                "inv" => $inv,
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
    public function clearCredit($payment_number)
    {
        $credit =CreditManagement::where('payment_number', $payment_number)->first();
        $distributor_id = $credit->distributor_id;
        $ware_house_id = $credit->ware_house_id;
        $credit_amount = $credit->credit_amount;
        $credit_id = $credit->credit_id;
        $payment_number = $credit->payment_number;
        //dd($payment_number);
        CreditManagement::where([
            'payment_number'=> $payment_number
        ])->update([
            'paid_status'=> 
            
        1]);

        $data = ([
            'pay' => new CreditPayment,
            'credit_id' => $credit_id,
            'amount_paid' => $credit_amount,
            'payment_number' => $payment_number,
            'distributor_id' => $distributor_id,
            'ware_house_id' => $ware_house_id,
        ]);

        $dist = Distributors::where([
            "distributor_id" => $distributor_id, 
        ])->first();
        $distributor_name = $dist->name;

        $log = new ActivityLog([
            "operations" => "Added Credit Payment of $credit_amount on 
            $payment_number for $distributor_name",
            "user_id" => Auth::user()->user_id,
        ]);
        if($log->save() AND ($this->model->create($data))){
            return redirect()->route("credit.payment")->with("success", 
            "You Have Added Credit Payment of $credit_amount on 
            $payment_number for $distributor_name Successfully");
        }

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
