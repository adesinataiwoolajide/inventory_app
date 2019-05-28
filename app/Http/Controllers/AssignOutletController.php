<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{AssignOutlet, Distributors, Outlets, User, ActivityLog};
use App\Repositories\AssignOutletRepository;
// use App\Repositories\OutletRepository;
// use App\Repositories\DistributorRepository;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AssignOutletController extends Controller
{
    protected $model;
    public function __construct(AssignOutlet $assign_outlet)
    {
       // set the model
       $this->model = new AssignOutletRepository($assign_outlet);
    //    $this->model = new OutletRepository($outlet);
    //    $this->model = new DistributorRepository($distributor);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet= Outlets::all();
        $assign_outlet = $this->model->all();
        $distributor= Distributors::all();
        
        return view('administrator.outlets.assign_outlet')->with([
            'outlet' => $outlet,
            'assign_outlet' => $assign_outlet,
            'distributor' => $distributor,
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->hasPermissionTo('assign-create')){
            $this->validate($request, [
                'outlet_id' =>'required|min:1|max:255',
                'distributor_id' =>'required|min:1|max:255',
            ]);
            $data = ([
                "assign" => new AssignOutlet,
                "outlet_id" => $request->input("outlet_id"),
                "distributor_id" => $request->input("distributor_id"),
            ]);

            $out = Outlets::where([
                "outlet_id" => $request->input('outlet_id'), 
            ])->first();
            $dist = Distributors::where([
                "distributor_id" => $request->input('distributor_id'), 
            ])->first();
            $outlet_name = $out->outlet_name;
            $distributor_name = $dist->name;

            $check = AssignOutlet::where([
                "outlet_id" => $request->input('outlet_id'), 
                "distributor_id" => $request->input('distributor_id'),
            ])->get();
            
            if(count($check)>0){
                return redirect()->back()->with([
                    'error' => "You Have Assigned ". $distributor_name. " ". "To "." ". $outlet_name. " Before",
                ]);
            }else{
                

                $log = new ActivityLog([
                    "operations" => "Assigned ". $distributor_name. " To ". $outlet_name,
                    "user_id" => Auth::user()->user_id,
                ]);

                if($log->save() AND ($this->model->create($data))){
                    return redirect()->route("assign.outlet.create")->with("success", "You Have Assigned  ". " ". $distributor_name. " To ". " ".$outlet_name. 
                    "Successfully");
                }
            }
  
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Assign An Outlets",
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
    public function destroy($assign_id)
    {
        if(auth()->user()->hasPermissionTo('assign-delete')){
            $assign_outlet =  $this->model->show($assign_id); 
            $details= $assign_outlet->assign_name; 
            $distributor_id = $assign_outlet->distributor_id;
            $distrib = Distributors::where([
                "distributor_id" => $distributor_id, 
            ])->first(); 
            $log = new ActivityLog([
                "operations" => "Deleted Outlet ". " ". $details. " Assigned to ". " ". $distrib->name,
                "user_id" => Auth::user()->user_id,
            ]);
            if (($assign->delete($assign_id))AND ($assign_outlet->trashed()) AND ($log->save())) {
                return redirect()->back()->with([
                    'success' => "You Have Deleted Outlet ". " ". $details. " Assigned to ". " ". $distrib->name. " ". "Successfully",
                ]);
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Delete Assigned An Outlets",
            ]);
        }
    
    }
}
