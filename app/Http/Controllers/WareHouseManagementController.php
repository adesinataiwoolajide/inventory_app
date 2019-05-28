<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{WareHouseManagement, User, ActivityLog};
use App\Repositories\WareHouseRepository;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WareHouseManagementController extends Controller
{
    protected $model;
    public function __construct(WareHouseManagement $distributor)
    {
       // set the model
       $this->model = new WareHouseRepository($distributor);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouse= WareHouseManagement::orderBy('name', 'asc')->get();
        $user = User::all();
        //$id = $warehouse->user_id;
        // $ware = WareHouseManagement::find(1)->user;
        // echo $ware->name;
        return view('administrator.warehouse.create')->with([
            'warehouse' => $warehouse,
            "user" => $user, 
        ]);
    }

    public function bin()
    {
        $warehouse= WareHouseManagement::onlyTrashed()->get();
        return view('administrator.warehouse.recyclebin')->with([
            'warehouse' => $warehouse,
        ]);
    }

    public function restore($ware_house_id)
    {
        WareHouseManagement::withTrashed()
        ->where('ware_house_id', $ware_house_id)
        ->restore();
        $categ= $this->model->show($ware_house_id);
        $name = $categ->name;
        
        $log = new ActivityLog([
            "operations" => "Restored  ". " ".$name. " " . " To The Ware House List List",
            "user_id" => Auth::user()->user_id,
        ]);
        $log->save();
        return redirect()->back()->with([
            'success' => " You Have Restored". " ".$name. " " ." Ware House Successfully",
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->hasPermissionTo('warehouse-create')){
            $this->validate($request, [
                'name' =>'required|min:1|max:255|unique:ware_house_managements',
                'address' =>'required|min:1|max:255',
                'city' =>'required|min:1|max:255',
                'state' =>'required|min:1|max:255',
                'country' =>'required|min:1|max:255',
                'start_date' => 'required|min:1|max:255',
                'user_id' =>'required|min:1|max:255',
            ]);
            $data = ([
                "warehouse" => new WareHouseManagement,
                "name" => $request->input("name"),
                "address" => $request->input("address"), 
                "city" => $request->input("city"),
                "state" => $request->input("state"),
                "country" => $request->input("country"),
                "start_date" => $request->input("start_date"),
                "user_id" => $request->input("user_id"),

            ]);

            //$warehouses->user->name;

            $check = WareHouseManagement::where([
                // "name" => $request->input('name'), 
                "user_id" => $request->input('user_id'),
            ])->get();
            $checkName = WareHouseManagement::where([
                "name" => $request->input('name'), 
            ])->get();

            if(count($check)>0){
                return redirect()->back()->with([
                    'error' => "You Have Added This User to A Ware House Before before",
                ]);
            }elseif(count($checkName)>0){
                return redirect()->back()->with([
                    'error' => "You Have Added" . $request->input('name'). " ". "to This Ware House Before before",
                ]);
            
            }else{

                $log = new ActivityLog([
                    "operations" => "Added ".$request->input("name"). " To The Ware House List",
                    "user_id" => Auth::user()->user_id,
                ]);

                if($log->save() AND ($this->model->create($data))){
                    return redirect()->route("warehouse.create")->with("success", "You Have Added " 
                    .$request->input("name"). " To The Ware House List Successfully");
                }
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Create A Ware House",
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
    public function edit($ware_house_id)
    {
        if(auth()->user()->hasPermissionTo('warehouse-create')){
            $warehouse= $this->model->all();
            $user = User::all();
            $ware =  $this->model->show($ware_house_id);
            return view('administrator.warehouse.edit')->with([
                'warehouse' => $warehouse,
                "user" => $user, 
                "ware" => $ware,
            ]);
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Update A Ware House",
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
    public function update(Request $request, $ware_house_id)
    {
        if(auth()->user()->hasPermissionTo('warehouse-update')){
            $this->validate($request, [
                'name' =>'required|min:1|max:255',
                'address' =>'required|min:1|max:255',
                'city' =>'required|min:1|max:255',
                'state' =>'required|min:1|max:255',
                'country' =>'required|min:1|max:255',
                'start_date' => 'required|min:1|max:255',
                'user_id' =>'required|min:1|max:255',
            ]);
            $data = ([
                "warehouse" => $this->model->show($ware_house_id),
                "name" => $request->input("name"),
                "address" => $request->input("address"), 
                "city" => $request->input("city"),
                "state" => $request->input("state"),
                "country" => $request->input("country"),
                "start_date" => $request->input("start_date"),
                "user_id" => $request->input("user_id"),
            ]);
            // $check = WareHouseManagement::where([
            //     "name" => $request->input('name'), 
            //     "user_id" => $request->input('user_id'),
            // ])->get();
            // $checkName = WareHouseManagement::where([
            //     "name" => $request->input('name'), 
            // ])->get();

            // if(count($check)>0){
            //     return redirect()->back()->with([
            //         'error' => "You Have Added This User to This Ware House Before before",
            //     ]);
            // }elseif(count($checkName)>0){
            //     return redirect()->back()->with([
            //         'error' => "You Have Added" . $request->input('name'). " ". "to This Ware House Before before",
            //     ]);
            
            // }else{

            $log = new ActivityLog([
                "operations" => "Updated ". " ".$request->input("name")." "." Ware House Details",
                "user_id" => Auth::user()->user_id,
            ]);

            if($log->save() AND ($this->model->update($data, $ware_house_id))){
                return redirect()->route("warehouse.create")->with("success", "You Have Updated " 
                .$request->input("name"). " ". " Details Successfully");
            }
            //}
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Update A Ware House",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ware_house_id)
    {
        if(auth()->user()->hasPermissionTo('warehouse-delete')){
            $warehouse =  $this->model->show($ware_house_id); 
            $details = WareHouseManagement::where([
                "ware_house_id" => $ware_house_id, 
            ])->first();
 
            $log = new ActivityLog([
                "operations" => "Deleted ". " ". $details->name. " ". " From The Warehouse List",
                "user_id" => Auth::user()->user_id,
            ]);
            if (($warehouse->delete($ware_house_id)) AND ($warehouse->trashed())) {
                return redirect()->back()->with([
                    'success' => "You Have Deleted ". " ". $details->name. " ". "From The Warehouse Successfully",
                ]);
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Delete A Warehouse",
            ]);
        }
    }
}
