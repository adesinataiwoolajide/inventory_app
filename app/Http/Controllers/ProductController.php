<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Products, ProductVariants, Categories, User, ActivityLog, Suppliers, WareHouseManagement, InventoryStock};
use App\Repositories\ProductRepository;
use DB;
use Str;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    protected $model;
    public function __construct(Products $product)
    {
       // set the model
       $this->model = new ProductRepository($product);
    }

    // function __construct()
    // {
    //     $this->middleware('permission:product-list');
    //     $this->middleware('permission:product-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category= Categories::all();
        $variant = ProductVariants::all();
        $product =  Products::orderBy('product_id', 'desc')->get();
        $warehouse =  WareHouseManagement::all();
        $supplier =  Suppliers::all();
        if(auth()->user()->hasRole('Administrator') 
            OR auth()->user()->hasRole('Admin')){
            
            return view('administrator.products.create')
            ->with([
                "category" => $category,
                "variant" => $variant,
                "product" => $product,
                "warehouse"=> $warehouse,
                "supplier" => $supplier,
                
            ]);
        }else{
            
            $inv = WareHouseManagement::where([
                'user_id'=> auth()->user()->user_id,
            ])->first();
            $ware_house_id = $inv->ware_house_id;
            $prod =  Products::where([
                'ware_house_id'=> $inv->ware_house_id]
            )->orderBy('product_id', 'desc')->get();
            return view('administrator.products.create')
            ->with([
                "category" => $category,
                "variant" => $variant,
                "warehouse"=> $warehouse,
                "supplier" => $supplier,
                "inv" => $inv,
                "prod" => $prod,
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
        return view('administrator.products.create');
    }

    public function bin()
    {
        $product= Products::onlyTrashed()->get();
        return view('administrator.products.recyclebin')->with([
            'product' => $product,
        ]);
    }

    public function restore($product_id)
    {
        if(auth()->user()->hasPermissionTo('product-restore')){
            Products::withTrashed()
            ->where('product_id', $product_id)
            ->restore();
            $product= $this->model->show($product_id);
            $product_name = $product->product_name;
            $slug = $product->product_slug; 
            $category_id = $product->category_id;
            $variant_id = $product->variant_id;
            $ware_house_id = $product->ware_house_id;
            $supplier_id = $product->supplier_id;
            $qty = $product->quantity;

            $che = InventoryStock::where([
                "product_name" => $product_name,
                "supplier_id" => $supplier_id,
                "ware_house_id" => $ware_house_id,
                "variant_id" => $variant_id,
                "category_id" => $category_id,
            ])->first();
            $stock_id = $che->stock_id;
            $prev_quantity = $che->quantity;
            $new_quantity = $prev_quantity + $qty;
            DB::table('inventory_stocks')->where([
                "stock_id" => $stock_id,
            ])->update([ 
                'quantity' => $new_quantity
            ]);

            $log = new ActivityLog([
                "operations" => "Restored  ". " ".$product_name. " " . " To The Product List",
                "user_id" => Auth::user()->user_id,
            ]);
            $log->save();
            return redirect()->back()->with([
                'success' => " You Have Restored". " ".$product_name. " " ." Product Successfully",
                // "category" => $category,
            ]);
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Restore A Product",
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
        if(auth()->user()->hasPermissionTo('product-create')){
            $this->validate($request, [
                'product_name' =>'required|min:1|max:255',
                'amount' =>'required|min:1|max:255',
                'variant_id' =>'required|min:1|max:255',
                'quantity' =>'required|min:1|max:50',
                'supplier_id' =>'required|min:1|max:255',
                'ware_house_id' =>'required|min:1|max:255',
            ]);

            $vari = ProductVariants::where([
                "variant_id" => $request->input('variant_id'), 
            ])->first();
            $category_id = $vari->category_id;
            $variant_size = $vari->variant_size;
            $variant_name = $vari->variant_name;

            $check = InventoryStock::where([
                "product_name" => strtoupper($request->input("product_name")),
                "variant_id" => $request->input("variant_id"),
                "supplier_id" => $request->input("supplier_id"),
                "ware_house_id" => $request->input("ware_house_id"), 
                "category_id" => $category_id,
            ])->get();
            
            if(count($check)==0){
                //add new the quantity 
                $inventory = InventoryStock::create([
                    "product_name" => strtoupper($request->input("product_name")),
                    "variant_id" => $request->input("variant_id"),
                    "quantity" => $request->input("quantity"),
                    "supplier_id" => $request->input("supplier_id"),
                    "ware_house_id" => $request->input("ware_house_id"), 
                    // "variant_size" => $variant_size,
                    "category_id" => $category_id,
                ]);
                // dd($inventory);
            }else{
                $che = InventoryStock::where([
                    "product_name" => strtoupper($request->input("product_name")),
                    "supplier_id" => $request->input("supplier_id"),
                    "ware_house_id" => $request->input("ware_house_id"),
                    "variant_id" => $request->input("variant_id"),
                    "category_id" => $category_id,
                ])->first();
                $prev_quantity = $che->quantity;
                $new_quantity = $prev_quantity + $request->input('quantity');
                DB::table('inventory_stocks')->where([
                    "product_name" => strtoupper($request->input("product_name")),
                    "supplier_id" => $request->input("supplier_id"),
                    "ware_house_id" => $request->input("ware_house_id"),
                    "variant_id" => $request->input("variant_id"),
                    "category_id" => $category_id,
                ])->update([ 
                    'quantity' => $new_quantity
                ]);
                
            }

            $data = ([
                "product" => new Products,
                "product_name" => strtoupper($request->input("product_name")),
                "product_slug" => Str::slug($request->input('product_name'))."-". rand(0001, 2000),
                "amount" => $request->input("amount"),
                "variant_id" => $request->input("variant_id"),
                "quantity" => $request->input("quantity"),
                "supplier_id" => $request->input("supplier_id"),
                "ware_house_id" => $request->input("ware_house_id"), 
                "category_id" => $category_id,
            ]);
            $log = new ActivityLog([
                "operations" => "Added ".$request->input("name"). " To The Supplier List",
                "user_id" => Auth::user()->user_id,
            ]);

            if($log->save() AND ($this->model->create($data))){
                return redirect()->route("product.create")->with("success", "You Have Added " 
                .$request->input("product_name"). " To The Product List Successfully");
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Create A Product",
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
        // return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {
        if(auth()->user()->hasPermissionTo('product-edit')){
            $category= Categories::all();
            $variant = ProductVariants::all();
            $warehouse =  WareHouseManagement::all();
            $supplier =  Suppliers::all();
            $product = $this->model->show($product_id);
            if(auth()->user()->hasRole('Administrator') 
                OR auth()->user()->hasRole('Admin'))
            {
                
                $proc =  Products::orderBy('product_id', 'desc')->get(); 
                return view('administrator.products.edit')
                    ->with([
                    "category" => $category,
                    "variant" => $variant,
                    "product" => $product,
                    "warehouse"=> $warehouse,
                    "supplier" => $supplier,
                    "proc" => $proc,
                    
                ]);
            }else{
                $inv = WareHouseManagement::where('user_id', auth()->user()->user_id)->first();
                $ware_house_id = $inv->ware_house_id;
                $prod =  Products::where([
                    'ware_house_id'=> $inv->ware_house_id]
                )->orderBy('product_id', 'desc')->get(); 
                return view('administrator.products.edit')
                    ->with([
                    "category" => $category,
                    "variant" => $variant,
                    "product" => $product,
                    "warehouse"=> $warehouse,
                    "supplier" => $supplier,
                    "prod" => $prod,
                    
                    "inv" => $inv,
                ]);
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Edit A Product",
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
    public function update(Request $request, $product_id)
    {
        if(auth()->user()->hasPermissionTo('product-update')){
            $this->validate($request, [
                'product_name' =>'required|min:1|max:255',
                'amount' =>'required|min:1|max:255',
                'variant_id' =>'required|min:1|max:255',
                'quantity' =>'required|min:1|max:50',
                'supplier_id' =>'required|min:1|max:255',
                'ware_house_id' =>'required|min:1|max:255',
            ]);

            $vari = ProductVariants::where([
                "variant_id" => $request->input('variant_id'), 
            ])->first();
            $category_id = $vari->category_id;
            $variant_size = $vari->variant_size;
            $variant_name = $vari->variant_name;

            $data = ([
                "product" =>$this->model->show($product_id),
                "product_name" => strtoupper($request->input("product_name")),
                "product_slug" => Str::slug($request->input('product_name'))."-". rand(0001, 2000),
                "amount" => $request->input("amount"),
                "variant_id" => $request->input("variant_id"),
                "quantity" => $request->input("quantity"),
                "supplier_id" => $request->input("supplier_id"),
                "ware_house_id" => $request->input("ware_house_id"), 
                "category_id" => $category_id,
            ]);

            $check = InventoryStock::where([
                "product_name" => strtoupper($request->input("product_name")),
                "variant_id" => $request->input("variant_id"),
                "supplier_id" => $request->input("supplier_id"),
                "ware_house_id" => $request->input("ware_house_id"), 
                "category_id" => $category_id,
            ])->get();
            
            if(count($check)==0){
                //add new the quantity 
                $inventory = InventoryStock::create([
                    "product_name" => strtoupper($request->input("product_name")),
                    "variant_id" => $request->input("variant_id"),
                    "quantity" => $request->input("quantity"),
                    "supplier_id" => $request->input("supplier_id"),
                    "ware_house_id" => $request->input("ware_house_id"), 
                    // "variant_size" => $variant_size,
                    "category_id" => $category_id,
                ]);
                // dd($inventory);
            }else{
                $che = InventoryStock::where([
                    "product_name" => strtoupper($request->input("product_name")),
                    "supplier_id" => $request->input("supplier_id"),
                    "ware_house_id" => $request->input("ware_house_id"),
                    "variant_id" => $request->input("variant_id"),
                    "category_id" => $category_id,
                ])->first();
                
                $stock_id = $che->stock_id;
                $prev_quantity = $che->quantity;
                $sub = $prev_quantity - $request->input('previous');
                $new_quantity = $sub + $request->input('quantity');
                DB::table('inventory_stocks')->where([
                    "product_name" => strtoupper($request->input("product_name")),
                    "supplier_id" => $request->input("supplier_id"),
                    "ware_house_id" => $request->input("ware_house_id"),
                    "variant_id" => $request->input("variant_id"),
                    "category_id" => $category_id,
                ])->update([ 
                    'quantity' => $new_quantity
                ]);
                
            }

            
            $log = new ActivityLog([
                "operations" => "Added ".$request->input("name"). " To The Supplier List",
                "user_id" => Auth::user()->user_id,
            ]);

            if($log->save() AND ($this->model->update($data, $product_id))){
                return redirect()->route("product.create")->with("success", "You Have Updated " 
                .$request->input("product_name"). " To The Product  Successfully");
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Update A Product",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        if(auth()->user()->hasPermissionTo('product-delete')){
            $product =  $this->model->show($product_id); 
            $product_name= $product->product_name;
            $slug = $product->product_slug; 
            $category_id = $product->category_id;
            $variant_id = $product->variant_id;
            $ware_house_id = $product->ware_house_id;
            $supplier_id = $product->supplier_id;
            $qty = $product->quantity;

            $che = InventoryStock::where([
                "product_name" => $product_name,
                "supplier_id" => $supplier_id,
                "ware_house_id" => $ware_house_id,
                "variant_id" => $variant_id,
                "category_id" => $category_id,
            ])->first();
            $stock_id = $che->stock_id;
            $prev_quantity = $che->quantity;
            $sub = $prev_quantity - $qty;
            DB::table('inventory_stocks')->where([
                "stock_id" => $stock_id,
            ])->update([ 
                'quantity' => $sub
            ]);

            $log = new ActivityLog([
                "operations" => "Deleted ". $slug. " From The Product List",
                "user_id" => Auth::user()->user_id,
            ]);
            if (($product->delete($product_id))AND ($product->trashed())) {
                return redirect()->back()->with([
                    'success' => "You Have Deleted". $product_name. " ". "From The Product List Successfully",
                ]);
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Delete A Product",
            ]);
        }
    }
    
}
