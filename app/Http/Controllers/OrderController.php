<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\{Order,OrderDetails, Distributors, Products, ProductVariants, Categories, User, 
    ActivityLog, Suppliers, WareHouseManagement, InventoryStock, Payments, CreditManagement};
use App\Repositories\OrderRepository;
use DB;
use Str;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    protected $model;
    public function __construct(Order $order)
    {
       // set the model
       $this->model = new OrderRepository($order);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        $inv = WareHouseManagement::find(auth()->user()->user_id);
        // $invoice =  OrderDetails::where([
        //     'ware_house_id'=> $inv->ware_house_id]
        // )->get();
        $invoice =  OrderDetails::orderBy('details_id', 'desc')->get();
        return view('administrator.orders.index')->with([
            
            "invoice" => $invoice,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category= Categories::all();
        $variant = ProductVariants::all();
        $product =  Products::all();
        $warehouse =  WareHouseManagement::all();
        $supplier =  Suppliers::all();
        $inventory =  InventoryStock::orderBy('quantity', 'desc')->get();
        $distributor =  Distributors::all();
        if(auth()->user()->hasRole('Administrator') OR(
            auth()->user()->hasRole('Admin'))){
            $order= $this->model->all();
            return view('administrator.orders.create')
            ->with([
            "category" => $category,
            "variant" => $variant,
            "product" => $product,
            "warehouse"=> $warehouse,
            "supplier" => $supplier,
            "inventory" =>$inventory,
            "order" => $order,
            "distributor" => $distributor,
            
            ]);
        }else{
            $inve = WareHouseManagement::where([
                'user_id'=> auth()->user()->user_id,
            ])->exists();
            if($inve){
                $inv = WareHouseManagement::where('user_id', auth()->user()->user_id)->first();
                $ware_house_id = $inv->ware_house_id;
                $invent =  InventoryStock::where([
                    'ware_house_id'=> $inv->ware_house_id]
                )->orderBy('quantity', 'desc')->get();
                return view('administrator.orders.create')
                ->with([
                    "category" => $category,
                    "variant" => $variant,
                    "product" => $product,
                    "warehouse"=> $warehouse,
                    "supplier" => $supplier,
                    "inventory" =>$inventory,
                    
                    "distributor" => $distributor,
                    "invent" => $invent,
                    "inv" => $inv,
                ]);
            }else{
                return redirect()->back()->with([
                    'error' => " You Do Not Belong To Any Ware House",
                ]);
            }
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
        if(auth()->user()->hasPermissionTo('order-create')){
            if($request->input("show")){
            
                $y = $request->input("show");
                function generateRandomHash($length)
                {
                    return strtoupper(substr(md5(uniqid(rand())), 0, (-32 + $length)));
                }	
                $transaction_number = strtoupper(generateRandomHash(12));
                $invoice_number = strtoupper(generateRandomHash(6));
                for($i = 1; $i <= $y; $i++){

                    $add_order = $request->input("add_order$i");
                    if(($add_order == 1) AND (!empty($request->input("quantity$i")))) {
                        $product_name = $request->input("product_name$i");
                        $price = Products::where([
                            "product_name" => $request->input("product_name$i"), 
                        ])->max('amount');
                    
                        $data = ([
                            "order" => new Order,
                            "stock_id" => $request->input("stock_id$i"),
                            "quantity" => $request->input("quantity$i"),
                            "unit_amount" => $price,
                            "distributor_id" => $request->input("distributor_id"),
                            "transaction_number" => $transaction_number,
                            "total_amount" => $request->input("quantity$i") * 
                            $price,  
                           

                        ]);

                        $dist = Distributors::where([
                            "distributor_id" => $request->input("distributor_id"), 
                        ])->first();
                        $distributor_name = $dist->name;
                        $che = InventoryStock::where([
                            "stock_id" => $request->input("stock_id$i"),
                        ])->first();
                        
                        $prev_quantity = $che->quantity;
                        $new_quantity = $prev_quantity - $request->input("quantity$i");
                        
                        DB::table('inventory_stocks')->where([
                            "stock_id" => $request->input("stock_id$i"),
                        ])->update([ 
                            'quantity' => $new_quantity
                        ]); 

                        $log = new ActivityLog([
                            "operations" => "Added Order". " "  .$transaction_number. " ".
                            " For Distributor". " ". $distributor_name,
                            "user_id" => Auth::user()->user_id,
                        ]);  
                        if($log->save() AND ($this->model->create($data))){
                        
                        }else{
                            return redirect()->back()->with([
                                'error' => "Network Failure, Please Try Again Later",
                            ]);
                        }
                       
                    }elseif((empty($add_order)) AND (!empty($request->input("quantity$i")))){
                        return redirect()->back()->with([
                            'error' => "Please Select The Add The Order Option",
                        ]);
                    }else{
                        // return redirect()->back()->with([
                        //     'error' => "Please Fill The Quantity To Add The Order",
                        // ]);
                    }
                    
                }

                $inve = WareHouseManagement::where([
                    'user_id'=> auth()->user()->user_id,
                ])->exists();
                if($inve){

                    $dell = WareHouseManagement::where('user_id', Auth::user()->user_id)->first();
                    OrderDetails::create([
                        'transaction_number' => $transaction_number,
                        'distributor_id' => $request->input("distributor_id"),
                        'invoice_number' => $invoice_number,
                        "ware_house_id" => $dell->ware_house_id,
                        "order_status" => 0, 
                    ]);
                    return redirect()->route("order.invoice")-> with([
                        "success" => "You Have Added Order Successfully, The Order Transaction Number is
                        $transaction_number",
                    ]);
                }else{
                    return redirect()->back()->with([
                        'error' => " You Do Not Belong To Any Ware House",
                    ]);
                }
            }else{
                return redirect()->back()->with([
                    'error' => "Please FIll The Below Form  To Create An Order",
                ]);
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Create An Order",
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($transaction_number)
    {
        //if(auth()->user()->hasPermissionTo('order-edit')){
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
            

            $payment = Order::where([
                "transaction_number"=> $transaction_number
            ])->first();
        
            return view('administrator.orders.details')->with([
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
            
        // } else{
        //     return redirect()->back()->with([
        //         'error' => "You Dont have Access To View A Payment Details",
        //     ]);
        // }
    }
    public function invoice()
    {
        if(auth()->user()->hasPermissionTo('order-invoice')){
            
            if(auth()->user()->hasRole('Administrator') OR(
                auth()->user()->hasRole('Admin'))){
                $invoice =  OrderDetails::orderBy('details_id', 'desc')->get();
                return view('administrator.orders.invoice')->with([
                    "invoice" => $invoice,
                ]);
            }else{
                $inve = WareHouseManagement::where([
                    'user_id'=> auth()->user()->user_id,
                ])->exists();
                if($inve){
                    $inv = WareHouseManagement::where('user_id', auth()->user()->user_id)->first();
                    $invo = OrderDetails::where('ware_house_id', $inv->ware_house_id)->orderBy('details_id', 'desc')->get();
                    return view('administrator.orders.invoice')->with([
                        "invo" => $invo,
                        "inv" => $inv,
                    ]);
                }else{
                    return redirect()->back()->with([
                        'error' => " You Do Not Belong To Any Ware House",
                    ]);
                }
            }
           
        } else{
            return  redirect()->route("order.create")->with([
                'error' => "You Dont have Access To Generate An Invoice",
            ]);
        }
    }

    public function printinvoice($transaction_number)
    {
        if(auth()->user()->hasPermissionTo('print-invoice')){

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
            $dist = DB::table('orders')->distinct()->first(['distributor_id']);
            $distributor_id = $orderDetails->distributor_id;
            $buyers = Distributors::where([
                "distributor_id" => $distributor_id, 
            ])->get();
            return view('administrator.orders.order_invoice')
                ->with([
                "dist"=> $dist,
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
            ]);
        } else{
            return  redirect()->route("order.create")->with([
                'error' => "You Dont have Access To Generate An Invoice",
            ]);
        }
    }

    public function generateprintinvoice($transaction_number)
    {
        if(auth()->user()->hasPermissionTo('print-invoice')){

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
            $dist = DB::table('orders')->distinct()->first(['distributor_id']);
            $distributor_id = $orderDetails->distributor_id;
            $buyers = Distributors::where([
                "distributor_id" => $distributor_id, 
            ])->get();
            return view('administrator.orders.print_invoice')
                ->with([
                "dist"=> $dist,
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
            ]);
        } else{
            return  redirect()->route("order.create")->with([
                'error' => "You Dont have Access To Generate An Invoice",
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($transaction_number)
    {
        //$transaction_number = $this->model->show($transaction_number);
        $transaction_number;
        $invent = Order::where([
            "transaction_number"=> $transaction_number
        ])->get();

        $details = OrderDetails::where([
            "transaction_number"=> $transaction_number
        ])->first();
        
        $category= Categories::all();
        $variant = ProductVariants::all();
        $product =  Products::all();
        $warehouse =  WareHouseManagement::all();
        $supplier =  Suppliers::all();
        $inventory =  InventoryStock::orderBy('quantity', 'desc')->get();
        $distributor =  Distributors::all();
        if(auth()->user()->hasRole('Administrator') OR(
            auth()->user()->hasRole('Admin'))){
            $order= $this->model->all();
            return view('administrator.orders.edit')
            ->with([
            "category" => $category,
            "variant" => $variant,
            "product" => $product,
            "warehouse"=> $warehouse,
            "supplier" => $supplier,
            "inventory" =>$inventory,
            "order" => $order,
            "distributor" => $distributor,
            "invent" => $invent,
            "details" => $details,
            //"orderDetails" => $orderDetails
            
            ]);
        }else{
            $inve = WareHouseManagement::where([
                'user_id'=> auth()->user()->user_id,
            ])->exists();
            if($inve){
                $inv = WareHouseManagement::where('user_id', auth()->user()->user_id)->first();
                $ware_house_id = $inv->ware_house_id;
                
                return view('administrator.orders.edit')
                ->with([
                    "category" => $category,
                    "variant" => $variant,
                    "product" => $product,
                    "warehouse"=> $warehouse,
                    "supplier" => $supplier,
                    "inventory" =>$inventory,
                    "invent" => $invent,
                    "distributor" => $distributor,
                    "invent" => $invent,
                    "inv" => $inv,

                "details" => $details,
                    //"orderDetails" => $orderDetails
                ]);
            }else{
                return redirect()->back()->with([
                    'error' => " You Do Not Belong To Any Ware House",
                ]);
            }
        }
            
            
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $transaction_number)
    {
        if(auth()->user()->hasPermissionTo('order-update')){
            if($request->input("show")){
            
                $y = $request->input("show");
                
                for($i = 1; $i <= $y; $i++){

                    $add_order = $request->input("add_order$i");
                    $order_id = $request->input("order_id$i");
                    $prev_quan = $request->input("prev_quantity$i");
                    if($add_order == 1) {
                        $product_name = $request->input("product_name$i");
                        $price = Products::where([
                            "product_name" => $request->input("product_name$i"), 
                        ])->max('amount');
                    
                        $data = ([
                            "order" => $this->model->show($order_id),
                            "stock_id" => $request->input("stock_id$i"),
                            "quantity" => $request->input("quantity$i"),
                            "unit_amount" => $price,
                            "distributor_id" => $request->input("distributor_id"),
                            "transaction_number" => $transaction_number,
                            "total_amount" => $request->input("quantity$i") * $price,  
                           
                        ]);

                        $dist = Distributors::where([
                            "distributor_id" => $request->input("distributor_id"), 
                        ])->first();
                        $distributor_name = $dist->name;
                        $che = InventoryStock::where([
                            "stock_id" => $request->input("stock_id$i"),
                        ])->first();
                        
                        $prev_quantity = $che->quantity;
                        $nop = $prev_quantity - $prev_quan;
                        $new_quantity = $nop - $request->input("quantity$i");
                        
                        DB::table('inventory_stocks')->where([
                            "stock_id" => $request->input("stock_id$i"),
                        ])->update([ 
                            'quantity' => $new_quantity
                        ]); 

                        $log = new ActivityLog([
                            "operations" => "Added Order". " "  .$transaction_number. " ".
                            " For Distributor". " ". $distributor_name,
                            "user_id" => Auth::user()->user_id,
                        ]);  
                        if($log->save() AND ($this->model->update($data, $order_id))){
                        
                        }else{
                            return redirect()->back()->with([
                                'error' => "Network Failure, Please Try Again Later",
                            ]);
                        }
                       
                    }
                    // else{
                    //     return redirect()->back()->with([
                    //         'error' => "Please Click on Update Order",
                    //     ]);
                    // }
                    
                }

                $inve = WareHouseManagement::where([
                    'user_id'=> auth()->user()->user_id,
                ])->exists();
                if($inve){
                    $dell = WareHouseManagement::where('user_id', Auth::user()->user_id)->first();
                
                    DB::table('order_details')->where([
                        "transaction_number" => $transaction_number,
                    ])->update([ 
                        'distributor_id' => $request->input("distributor_id"),
                        'invoice_number' => $request->input("invoice_number"),
                        "ware_house_id" => $dell->ware_house_id,
                        "order_status" => 0, 
                    ]); 
                    return redirect()->route("order.invoice")-> with([
                        "success" => "You Have Updated The Order Successfully",
                    ]);
                }else{
                    return redirect()->back()->with([
                        'error' => " You Do Not Belong To Any Ware House",
                    ]);
                }
            }else{
                return redirect()->back()->with([
                    'error' => "Please FIll The Below Form  To Update The Order",
                ]);
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Update An Order",
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
