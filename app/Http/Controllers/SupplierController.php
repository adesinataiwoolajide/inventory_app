<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Suppliers, User, ActivityLog, Products, WareHouseManagement};
use App\Repositories\SupplierRepository;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SupplierController extends Controller
{
    protected $model;
    public function __construct(Suppliers $supplier)
    {
       // set the model
       $this->model = new SupplierRepository($supplier);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier= $this->model->all();
        return view('administrator.supplier.create')->with([
            'supplier' => $supplier,
        ]);
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

    public function bin()
    {
        $supplier= Suppliers::onlyTrashed()->get();
        return view('administrator.supplier.recyclebin')->with([
            'supplier' => $supplier,
        ]);
    }

    public function restore($supplier_id)
    {
        Suppliers::withTrashed()
        ->where('supplier_id', $supplier_id)
        ->restore();
        $categ= $this->model->show($supplier_id);
        $supplier_name = $categ->name;
        $email = $categ->email;
        
        $log = new ActivityLog([
            "operations" => "Restored  ". " ".$email. " " . " To The Supplier's List",
            "user_id" => Auth::user()->user_id,
        ]);
        $log->save();
        return redirect()->back()->with([
            'success' => " You Have Restored". " ".$supplier_name. " " ." Details Successfully",
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->hasPermissionTo('supplier-create')){
            $this->validate($request, [
                'name' =>'required|min:1|max:255',
                'email' =>'required|min:1|max:255|unique:suppliers',
                'phone_one' =>'required|min:1|max:11|unique:suppliers',
                'city' =>'required|min:1|max:255',
                'state' =>'required|min:1|max:255',
                'country' =>'required|min:1|max:255',
                'address' =>'required|min:1|max:255',

            ]);
            if(Suppliers::where("phone_one", $request->input("phone_one"))->exists()){
                return redirect()->back()->with("error", $request->input('phone_one'). " ". "Is in Use By 
                Another Supplier");

            }elseif(Suppliers::where("email", $request->input("email"))->exists()){
                return redirect()->back()->with("error", $request->input('email'). " ". 
                "Is in Use By Another Supplier");

            }else{
                if(empty($request->input("phone_two"))){
                    $phone_two = "";
                }else{
                    $phone_two = $request->input("phone_two");
                }
                $data = ([
                    "supplier" => new Suppliers,
                    "name" => $request->input("name"),
                    "email" => $request->input("email"),
                    "phone_one" => $request->input("phone_one"),
                    "phone_two" => $phone_two,
                    "city" => $request->input("city"),
                    "state" => $request->input("state"),
                    "country" => $request->input("country"),
                    "address" => $request->input("address"), 
                ]);

                $log = new ActivityLog([
                    "operations" => "Added ".$request->input("name"). " To The Supplier List",
                    "user_id" => Auth::user()->user_id,
                ]);

                if($log->save() AND ($this->model->create($data))){
                    
                    return redirect()->route("supplier.create")->with("success", "You Have Added " 
                    .$request->input("name"). " To The Supplier List Successfully");
                }
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Create A Supplier",
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
    public function edit($supplier_id)
    {
        if(auth()->user()->hasPermissionTo('supplier-edit')){
            $supplier= $this->model->all();
            $sup = $this->model->show($supplier_id);
            return view('administrator.supplier.edit')->with([
                'supplier' => $supplier,
                'sup' => $sup,
            ]);

        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Edit A Supplier",
            ]);
        }
    }

    public function product($supplier_id)
    {

        if(auth()->user()->hasPermissionTo('supplier-edit')){
            $sup = $this->model->show($supplier_id);
            $product = Products::where('supplier_id', $supplier_id)->get();
            if(count($product) ==0){
                return redirect()->back()->with([
                    'error' => "No Product Was Supplied By". " " .$sup->name,
                ]);
            }else{

                if(auth()->user()->hasRole('Administrator') 
                OR auth()->user()->hasRole('Admin')){

                    $prods =  Products::orderBy('product_id', 'desc')->get();
                    return view('administrator.supplier.products')->with([
                        'product' => $product,
                        'sup' => $sup,
                        'inv' => $inv,
                        'prods' => $prods,
                    ]);

                }else{
                    $inv = WareHouseManagement::where('user_id', auth()->user()->user_id)->first();
                    $ware_house_id = $inv->ware_house_id;
                    $prod =  Products::where([
                        'ware_house_id'=> $inv->ware_house_id,
                        'supplier_id' => $supplier_id ]
                    )->orderBy('product_id', 'desc')->get();
                    return view('administrator.supplier.products')->with([
                        'product' => $product,
                        'sup' => $sup,
                        'inv' => $inv,
                        'prod' => $prod,
                    ]);
                }

            }
            

        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To View The Supplier's Product",
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
    public function update(Request $request, $supplier_id)
    {
        if(auth()->user()->hasPermissionTo('supplier-update')){
            $this->validate($request, [
                'name' =>'required|min:1|max:255',
                'email' =>'required|min:1|max:255',
                'phone_one' =>'required|min:1|max:11',
                'city' =>'required|min:1|max:255',
                'state' =>'required|min:1|max:255',
                'country' =>'required|min:1|max:255',
                'address' =>'required|min:1|max:255',
            ]);
            if(empty($request->input("phone_two"))){
                $phone_two = "Null";
            }else{
                $phone_two = $request->input("phone_two");
            }
            $data = ([
                "supplier" => $this->model->show($supplier_id),
                "name" => $request->input("name"),
                "email" => $request->input("email"),
                "phone_one" => $request->input("phone_one"),
                "phone_two" => $phone_two,
                "city" => $request->input("city"),
                "state" => $request->input("state"),
                "country" => $request->input("country"),
                "address" => $request->input("address"), 
            ]);

            $sup = Suppliers::where([
                "supplier_id" => $supplier_id, 
            ])->first();


            $log = new ActivityLog([
                "operations" => "Changed The Supplier E-Mail From ". " ".
                $request->input('prev_email') ." ". " To" .$request->input("email"),
                "user_id" => Auth::user()->user_id,
            ]);

            if($log->save() AND ($this->model->update($data, $supplier_id))){
                
                return redirect()->route("supplier.create")->with("success", 
                "You Have Updated The Supplier Details Successfully");
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Update A Supplier",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($supplier_id)
    {
        if(auth()->user()->hasPermissionTo('supplier-delete'))
        {
            $supplier =  $this->model->show($supplier_id); 
            $sup = Suppliers::where([
                "supplier_id" => $supplier_id, 
            ])->first();

            $details= $sup->name; 
            
            $log = new ActivityLog([
                "operations" => "Deleted ". $details. " From The Supplier List",
                "user_id" => Auth::user()->user_id,
            ]);
            if (($supplier->delete($supplier_id)) AND ($supplier->trashed())) 
            {
                return redirect()->back()->with([
                    'success' => "You Have Deleted ". " ". $details. " ". "From The Supplier Details Successfully",
                ]);
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Delete A Supplier",
            ]);
        }
    
    }
}
