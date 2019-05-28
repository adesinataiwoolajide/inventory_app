<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Products, ProductVariants, Categories, User, ActivityLog, Suppliers, WareHouseManagement, InventoryStock};
use App\Repositories\ProductRepository;
use DB;
use Str;
use Illuminate\Support\Facades\Auth;

class InventoryStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category= Categories::all();
        $variant = ProductVariants::all();
        $product =  Products::all();
        $warehouse =  WareHouseManagement::all();
        $supplier =  Suppliers::all();
        if(auth()->user()->hasRole('Administrator') OR(
            auth()->user()->hasRole('Admin'))){
            
            $inventory =  InventoryStock::orderBy('stock_id', 'desc')->get();;
            return view('administrator.inventory.index')
                ->with([
                "category" => $category,
                "variant" => $variant,
                "product" => $product,
                "warehouse"=> $warehouse,
                "supplier" => $supplier,
                "inventory" =>$inventory,
            ]);
        }else{
            $inv = WareHouseManagement::where('user_id', auth()->user()->user_id)->first();
            $ware_house_id = $inv->ware_house_id;
            
            $invent =  InventoryStock::where([
                'ware_house_id'=> $inv->ware_house_id]
            )->orderBy('stock_id', 'desc')->get();
            
            return view('administrator.inventory.index')
                ->with([
                "category" => $category,
                "variant" => $variant,
                "product" => $product,
                "warehouse"=> $warehouse,
                "supplier" => $supplier,
               // "inventory" =>$inventory,
                "invent" => $invent,
                "inv" => $inv,
            ]);
        }

        
    }

    public function outofstock()
    {
        $category= Categories::all();
        $variant = ProductVariants::all();
        $product =  Products::all();
        $warehouse =  WareHouseManagement::all();
        $supplier =  Suppliers::all();
        //$inventory =  InventoryStock::all();

        $inventory =  DB::table('inventory_stocks')->where([
            ['quantity', '<', 1],
        ])->orderBy('stock_id', 'desc')->get();

        $inv = WareHouseManagement::where('user_id', auth()->user()->user_id)->first();
        $ware_house_id = $inv->ware_house_id;
        
        $invent =  DB::table('inventory_stocks')->where([
            ['ware_house_id', $inv->ware_house_id],
            ['quantity', '<', 5],
        ])->orderBy('stock_id', 'desc')->get();
        return view('administrator.inventory.out_of_stock')
            ->with([
            "category" => $category,
            "variant" => $variant,
            "product" => $product,
            "warehouse"=> $warehouse,
            "supplier" => $supplier,
            "inventory" =>$inventory,
            "invent" => $invent,
            "inv" => $inv,
        ]);
    }

    // public function instock()
    // {
    //     $category= Categories::all();
    //     $variant = ProductVariants::all();
    //     $product =  Products::all();
    //     $warehouse =  WareHouseManagement::all();
    //     $supplier =  Suppliers::all();
    //     $inventory =  InventoryStock::all();

    //     $inv = WareHouseManagement::where('user_id', auth()->user()->user_id)->first();
    //     $ware_house_id = $inv->ware_house_id;
        
    //     $invent =  InventoryStock::where([
    //         'ware_house_id'=> $inv->ware_house_id,
    //         'quantity' > 0]
    //     )->orderBy('stock_id', 'desc')->get();
    //     return view('administrator.inventory.in_stock')
    //         ->with([
    //         "category" => $category,
    //         "variant" => $variant,
    //         "product" => $product,
    //         "warehouse"=> $warehouse,
    //         "supplier" => $supplier,
    //         "inventory" =>$inventory,
    //         "invent" => $invent,
    //         "inv" => $inv,
    //     ]);
    // }

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
