<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\{Order,OrderDetails, Distributors, Products, ProductVariants, Categories, User, 
    ActivityLog, Suppliers, WareHouseManagement, InventoryStock, Payments, CreditManagement};
use App\Repositories\PaymentRepository;
use DB;
use Str;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $model;
    public function __construct(Payments $payment)
    {
       // set the model
       $this->model = new PaymentRepository($payment);
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
            $payment =Payments::orderBy('payment_id', 'desc')->get();
            return view('administrator.payments.index')->with([
                "payment" => $payment,
            ]);
        }else{
            $inv = WareHouseManagement::where('user_id', auth()->user()->user_id)->first();
            $ware_house_id = $inv->ware_house_id;
            $pay =  Payments::where([
                'ware_house_id'=> $inv->ware_house_id]
            )->orderBy('payment_id', 'desc')->get();
            return view('administrator.payments.index')->with([
                "pay" => $pay,
                "inv" => $inv,
            ]);
        }
        
    }

    public function bin()
    {
        $outlet= Payments::onlyTrashed()->get();
        return view('administrator.payments.recyclebin')->with([
            'outlet' => $outlet,
        ]);
    }

    // public function restore($payment_id)
    // {
    //     Payments::withTrashed()
    //     ->where('payment_id', $payment_id)
    //     ->restore();
    //     $categ= $this->model->show($payment_id);
    //     $outlet_name = $categ->outlet_name;
    //     $log = new ActivityLog([
    //         "operations" => "Restored  ". " ".$outlet_name. " " . " To The Outlet List",
    //         "user_id" => Auth::user()->user_id,
    //     ]);
    //     $log->save();
    //     return redirect()->back()->with([
    //         'success' => " You Have Restored". " ".$outlet_name. " " ." Outlet Successfully",
    //         // "outlet" => $outlet,
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->hasRole('Administrator') OR(
            auth()->user()->hasRole('Admin'))){
            $payment =Payments::orderBy('payment_id', 'desc')->get();
            $invoi =  OrderDetails::where(
                ['order_status'=> 0, 
            ])->orderBy('details_id', 'desc')->get();
            $invoice =  OrderDetails::where(
                ['order_status'=> 0,
            ])->orderBy('details_id', 'desc')->get();
            

            return view('administrator.payments.create')->with([
                "invoice" => $invoice,
                "payment" => $payment,
                "invoi" => $invoi,
                
            ]);
        }else{
            $inv = WareHouseManagement::where('user_id', auth()->user()->user_id)->first();
            $ware_house_id = $inv->ware_house_id;
            $invoi =  OrderDetails::where(
                ['order_status'=> 0,
                'ware_house_id' => $ware_house_id, 
            ])->orderBy('details_id', 'desc')->get();
            $invoice =  OrderDetails::where(
                ['order_status'=> 0,
            ])->orderBy('details_id', 'desc')->get();
        }
    }

    public function makepayment($transaction_number)
    {
        
        $viewOrder = Order::where([
            "transaction_number"=> $transaction_number
        ])->get();
        $orderDetails = OrderDetails::where([
            "transaction_number"=> $transaction_number
        ])->first();
        $category= Categories::all();
        $variant = ProductVariants::all();
        $product =  Products::all();
        $warehouse =  WareHouseManagement::all();
        $supplier =  Suppliers::all();
        $inventory =  InventoryStock::all();
        $distributor =  Distributors::all();
        $price = Order::where([
            "transaction_number" => $transaction_number, 
        ])->sum('total_amount');

        $distributor_id = $orderDetails->distributor_id;
        $buyers = Distributors::where([
            "distributor_id" => $distributor_id, 
        ])->get();
        $credit = CreditManagement::where([
            "distributor_id" => $distributor_id, 
        ])->get();

        
        return view('administrator.payments.make-payment')->with([
            "price"=> $price,
            "buyers" => $buyers,
            "viewOrder" => $viewOrder,
            "category" => $category,
            "variant" => $variant,
            "product" => $product,
            "warehouse"=> $warehouse,
            "supplier" => $supplier,
            "inventory" =>$inventory,
            "distributor" => $distributor,
            "orderDetails" => $orderDetails,
            
            "credit" => $credit,
        ]);
    }

    public function viewpaymentdetails($transaction_number)
    {
        if(auth()->user()->hasPermissionTo('payment-create')){
        
            $viewOrder = Order::where([
                "transaction_number"=> $transaction_number
            ])->get();
            $orderDetails = OrderDetails::where([
                "transaction_number"=> $transaction_number
            ])->first();
            $category= Categories::all();
            $variant = ProductVariants::all();
            $product =  Products::all();
            $warehouse =  WareHouseManagement::all();
            $supplier =  Suppliers::all();
            $inventory =  InventoryStock::all();
            $distributor =  Distributors::all();
            $price = Order::where([
                "transaction_number" => $transaction_number, 
            ])->sum('total_amount');

            $distributor_id = $orderDetails->distributor_id;
            $buyers = Distributors::where([
                "distributor_id" => $distributor_id, 
            ])->get();
            $credit = CreditManagement::where([
                "distributor_id" => $distributor_id, 
            ])->get();

            
            return view('administrator.payments.make-payment')->with([
                //"dist"=> $dist,
                "price"=> $price,
                "buyers" => $buyers,
                "viewOrder" => $viewOrder,
                "category" => $category,
                "variant" => $variant,
                "product" => $product,
                "warehouse"=> $warehouse,
                "supplier" => $supplier,
                "inventory" =>$inventory,
                "distributor" => $distributor,
                "orderDetails" => $orderDetails,
                
                "credit" => $credit,
            ]);
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To View A Payment Details",
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->hasPermissionTo('payment-create')){
            $validator =  $this->validate($request, [
                'paid_amount' =>'required|min:1|max:255',
            ]);
            $details_id = $request->input('details_id');
            $total_amount = $request->input('total_amount');
            $distributor_id = $request->input('distributor_id');
            $transaction_number = $request->input('transaction_number');
            $orderDetails = OrderDetails::where([
                "transaction_number"=> $transaction_number
            ])->first();
            $ware_house_id = $orderDetails->ware_house_id;
            function generateRandomHash($length)
            {
                return strtoupper(substr(md5(uniqid(rand())), 0, (-32 + $length)));
            }	
            $payment_number = strtoupper(generateRandomHash(5));
            $debt = $total_amount - $request->input("paid_amount");
            $buyers = Distributors::where([
                "distributor_id" => $distributor_id, 
            ])->first();
            $credit_limit = $buyers->credit_limit;
            if($debt > $credit_limit){
                return redirect()->back()->with([
                    'error' => "This Credit $debt is greater than the 
                   Customer's Credit Limit of $credit_limit",
                ]);
            }else{
                $data = ([
                    "payment" => new Payments,
                    "details_id" => $details_id,
                    "total_amount" => $total_amount,
                    "distributor_id" => $distributor_id,
                    "paid_amount" => $request->input("paid_amount"),
                    "credit" => $debt,
                    'payment_number' => $transaction_number,
                    'distributor_id' => $distributor_id,
                    'ware_house_id' => $ware_house_id,
                    "paid_status" => 1,
                ]);
    
                if($debt < 1){
                    $owing = 1;
                }else{
                    $owing =0;
                }
    
                $credit = new CreditManagement([
                    "credit" => $total_amount - $request->input("paid_amount"),
                    'payment_number' => $transaction_number,
                    'distributor_id' => $distributor_id,
                    "credit_amount" => $total_amount - $request->input("paid_amount"),
                    'ware_house_id' =>$ware_house_id,
                    "paid_status" => $owing,
                ]);

                DB::table('order_details')->where([
                    "transaction_number"=> $transaction_number
                ])->update([ 
                    'order_status' => 1
                ]);
    
                $log = new ActivityLog([
                    "operations" => "Added Payment For $transaction_number",
                    "user_id" => Auth::user()->user_id,
                ]);
                if($log->save() AND ($this->model->create($data)) 
                    AND ($credit->save())){
                   return redirect()->route("payment.index")->with("success", "You Have Added The 
                   Customer's Payment Successfully Successfully");
                }
            }


        
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Create A Payment",
            ]);
        }
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
    public function edit($transaction_number)
    {
        if(auth()->user()->hasPermissionTo('payment-edit')){
            $viewOrder = Order::where([
                "transaction_number"=> $transaction_number
            ])->get();
            $orderDetails = OrderDetails::where([
                "transaction_number"=> $transaction_number
            ])->first();
            $category= Categories::all();
            $variant = ProductVariants::all();
            $product =  Products::all();
            $warehouse =  WareHouseManagement::all();
            $supplier =  Suppliers::all();
            $inventory =  InventoryStock::all();
            $distributor =  Distributors::all();
            $price = Order::where([
                "transaction_number" => $transaction_number, 
            ])->sum('total_amount');

            $distributor_id = $orderDetails->distributor_id;
            $buyers = Distributors::where([
                "distributor_id" => $distributor_id, 
            ])->get();
            $credit = CreditManagement::where([
                "distributor_id" => $distributor_id, 
            ])->get();
            $payment = Payments::where([
                "payment_number"=> $transaction_number
            ])->first();

            
            return view('administrator.payments.edit')->with([
                "payment"=> $payment,
                "price"=> $price,
                "buyers" => $buyers,
                "viewOrder" => $viewOrder,
                "category" => $category,
                "variant" => $variant,
                "product" => $product,
                "warehouse"=> $warehouse,
                "supplier" => $supplier,
                "inventory" =>$inventory,
                "distributor" => $distributor,
                "orderDetails" => $orderDetails,
                
                "credit" => $credit,
            ]);
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Edit A Payment",
            ]);
        }
    }

    public function details($transaction_number)
    {
        if(auth()->user()->hasPermissionTo('payment-edit')){
            $viewOrder = Order::where([
                "transaction_number"=> $transaction_number
            ])->get();
            $orderDetails = OrderDetails::where([
                "transaction_number"=> $transaction_number
            ])->first();
            $category= Categories::all();
            $variant = ProductVariants::all();
            $product =  Products::all();
            $warehouse =  WareHouseManagement::all();
            $supplier =  Suppliers::all();
            $inventory =  InventoryStock::all();
            $distributor =  Distributors::all();
            $price = Order::where([
                "transaction_number" => $transaction_number, 
            ])->sum('total_amount');

            $distributor_id = $orderDetails->distributor_id;
            $buyers = Distributors::where([
                "distributor_id" => $distributor_id, 
            ])->get();
            $credit = CreditManagement::where([
                "distributor_id" => $distributor_id, 
            ])->get();
            $pay = Payments::where([
                "payment_number"=> $transaction_number
            ])->get();
            if(count($pay) ==0){
                return redirect()->back()->with([
                    'error' => "The Distributor Have Not Paid For The Order",
                ]); 
            }else{

                $payment = Payments::where([
                    "payment_number"=> $transaction_number
                ])->first();
        
                return view('administrator.payments.details')->with([
                    "payment"=> $payment,
                    "price"=> $price,
                    "buyers" => $buyers,
                    "viewOrder" => $viewOrder,
                    "category" => $category,
                    "variant" => $variant,
                    "product" => $product,
                    "warehouse"=> $warehouse,
                    "supplier" => $supplier,
                    "inventory" =>$inventory,
                    "distributor" => $distributor,
                    "orderDetails" => $orderDetails,
                    
                    "credit" => $credit,
                ]);
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To View A Payment Details",
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $payment_number)
    {
        if(auth()->user()->hasPermissionTo('payment-update')){
            $validator =  $this->validate($request, [
                'paid_amount' =>'required|min:1|max:255',
            ]);
            $details_id = $request->input('details_id');
            $total_amount = $request->input('total_amount');
            $distributor_id = $request->input('distributor_id');
           // $transaction_number = $request->input('transaction_number');

            $vari = Payments::where([
                "payment_number" => $payment_number, 
            ])->first();
            $payment_number = $vari->payment_number;

            $debt = $total_amount - $request->input("paid_amount");

            $buyers = Distributors::where([
                "distributor_id" => $distributor_id, 
            ])->first();
            echo $credit_limit = $buyers->credit_limit;
            if($debt > $credit_limit){
                return redirect()->back()->with([
                    'error' => "This Credit $debt is greater than the 
                   Customer's Credit Limit of $credit_limit",
                ]);
            }else{
                $data =  Payments::where([
                    "payment_number" => $payment_number
                ])->update([
                    "details_id" => $details_id,
                    "total_amount" => $total_amount,
                    "distributor_id" => $distributor_id,
                    "paid_amount" => $request->input("paid_amount"),
                    "credit" => $debt,
                    // 'payment_number' => $payment_number,
                    'distributor_id' => $distributor_id,
                    "paid_status" => 1,
                ]);
    
                if($debt < 1){
                    $owing = 1;
                }else{
                    $owing =0;
                }

                $che = CreditManagement::where([
                    "payment_number" => $payment_number,
                ])->first();
    
                $credit =  CreditManagement::where([
                    "payment_number" => $payment_number,
                ])->update([ 
                    "credit_amount" => $total_amount - $request->input("paid_amount"),
                    'distributor_id' => $distributor_id,
                    "credit_amount" => $total_amount - $request->input("paid_amount"),
                    "paid_status" => $owing,
                ]);
    
                $log = new ActivityLog([
                    "operations" => "Updated Payment For $payment_number",
                    "user_id" => Auth::user()->user_id,
                ]);
                if($log->save()){
                   return redirect()->route("payment.index")->with("success", "You Have Updated 
                   Payment for $payment_number Successfully");
                }
            }


        
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Update A Payment",
            ]);
        }
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
