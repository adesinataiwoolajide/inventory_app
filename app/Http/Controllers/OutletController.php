<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\{Outlets, User, ActivityLog, Distributors};
use App\Repositories\OutletRepository;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OutletController extends Controller
{
    protected $model;
    public function __construct(Outlets $outlet)
    {
       // set the model
       $this->model = new OutletRepository($outlet);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet= Outlets::orderBy('outlet_name', 'asc')->get();
        $distributor = Distributors::orderBy('name', 'asc')->get();
        return view('administrator.outlets.create')->with([
            'outlet' => $outlet,
            'distributor' =>$distributor,
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
        $outlet= Outlets::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('administrator.outlets.recyclebin')->with([
            'outlet' => $outlet,
        ]);
    }

    public function restore($outlet_id)
    {
        Outlets::withTrashed()
        ->where('outlet_id', $outlet_id)
        ->restore();
        $categ= $this->model->show($outlet_id);
        $outlet_name = $categ->outlet_name;
        $log = new ActivityLog([
            "operations" => "Restored  ". " ".$outlet_name. " " . " To The Outlet List",
            "user_id" => Auth::user()->user_id,
        ]);
        $log->save();
        return redirect()->back()->with([
            'success' => " You Have Restored". " ".$outlet_name. " " ." Outlet Successfully",
            // "outlet" => $outlet,
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
        if(auth()->user()->hasPermissionTo('outlet-create')){
            $this->validate($request, [
                'outlet_name' =>'required|min:1|max:255|unique:outlets',
                'distributor_id' => 'required|min:1|',
            ]);

            $distributor= Distributors::where([
                "distributor_id" => $request->input("distributor_id")
            ])->first();
            $name = $distributor->name;
            $data = ([
                "outlet" => new Outlets,
                "outlet_name" => $request->input("outlet_name"),
                "distributor_id" => $request->input("distributor_id"),
            ]);

            $log = new ActivityLog([
                "operations" => "Added". " ". $request->input('outlet_name'). " ". "Outlet For Distributor $name",
                "user_id" => Auth::user()->user_id,
            ]);

            if($log->save() AND ($this->model->create($data))){
                return redirect()->route("outlet.create")->with("success", "You Have Added". " ". 
                $request->input('outlet_name'). " ". "Outlet For Distributor $name Successfully");
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Create Outlets",
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
    public function edit($outlet_id)
    {
        if(auth()->user()->hasPermissionTo('outlet-update')){
            $outlet= $this->model->all();
            $out = $this->model->show($outlet_id);
            $distributor = Distributors::orderBy('name', 'asc')->get();
            return view('administrator.outlets.edit')->with([
                'outlet' => $outlet,
                'out' => $out,
                'distributor' => $distributor,
            ]);
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Edit An Outlets",
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
    public function update(Request $request, $outlet_id)
    {
        if(auth()->user()->hasPermissionTo('outlet-update')){
            $this->validate($request, [
                'outlet_name' =>'required|min:1|max:255',
                'distributor_id' => 'required|min:1|',
            ]);
    
            $distributor= Distributors::where([
                "distributor_id" => $request->input("distributor_id")
            ])->first();
            $name = $distributor->name;
            $data = ([
                "outlet" => $this->model->show($outlet_id),
                "outlet_name" => $request->input("outlet_name"),
                "distributor_id"=> $request->input("distributor_id"),
            ]);

            $log = new ActivityLog([
                "operations" => "Updated The Outlet Details ",
                "user_id" => Auth::user()->user_id,
            ]);

            if($log->save() AND ($this->model->update($data, $outlet_id))){
                return redirect()->route("outlet.create")->with("success", "You Have Updated The Outlet Details Successfully");
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Create An Outlets",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($outlet_id)
    {
        if(auth()->user()->hasPermissionTo('outlet-delete')){
            $outlet =  $this->model->show($outlet_id); 
            $details = Outlets::where([
                "outlet_id" => $outlet_id, 
            ])->first();
 
            $log = new ActivityLog([
                "operations" => "Deleted ". " ". $details->outlet_name. " ". " From The Outlet List",
                "user_id" => Auth::user()->id,
            ]);
            if (($outlet->delete($outlet_id)) AND ($outlet->trashed())) {
                return redirect()->back()->with([
                    'success' => "You Have Deleted ". " ". $details->outlet_name. " ". "From The Outlet List Successfully",
                ]);
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Delete An Outlet",
            ]);
        }
    }
}
