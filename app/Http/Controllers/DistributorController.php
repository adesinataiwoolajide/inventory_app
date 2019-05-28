<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\{Distributors, User, ActivityLog, Payments, OrderDetails, AssignOutlet, Outlets};
use App\Repositories\DistributorRepository;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DistributorController extends Controller
{
    protected $model;
    public function __construct(Distributors $distributor)
    {
       // set the model
       $this->model = new DistributorRepository($distributor);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distributor= $this->model->all();
        return view('administrator.distributors.create')->with([
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

    public function bin()
    {
        $distributor= Distributors::onlyTrashed()->get();
        return view('administrator.distributors.recyclebin')->with([
            'distributor' => $distributor,
        ]);
    }

    public function payment($distributor_id)
    {
        $payment= Payments::where([
            "distributor_id" => $distributor_id
        ])->get();

        $distributor= Distributors::where([
            "distributor_id" => $distributor_id
        ])->first();

        if(count($payment) == 0){
            return redirect()->back()->with([
                'error' => " No Payment is Found For The Selected Distributor ", 
            ]);
        }else{
            return view('administrator.distributors.payment')->with([
                'payment' => $payment,
                'distributor' => $distributor,
            ]);
        }
        
    }

    public function assignedoutlet($distributor_id)
    {
        $assign= Outlets::where([
            "distributor_id" => $distributor_id
        ])->get();
        $outlet= Outlets::orderBy('outlet_name', 'asc')->get();

        $distributor= Distributors::where([
            "distributor_id" => $distributor_id
        ])->first();


        if(count($assign) == 0){
            return redirect()->back()->with([
                'error' => " No Outlet is Found For $distributor->name ", 
            ]);
        }else{
            return view('administrator.distributors.outlets')->with([
                'assign' => $assign,
                'distributor' => $distributor,
                "outlet" => $outlet,
            ]);
        }
        
    }

    public function order($distributor_id)
    {
        $dist_order= OrderDetails::where([
            "distributor_id" => $distributor_id
        ])->get();

        if(count($dist_order) == 0){
            return redirect()->back()->with([
                'error' => " No Order is Found For The Selected Distributor ", 
            ]);
        }else{
            return view('administrator.distributors.order')->with([
                'dist_order' => $dist_order,
            ]);
        }
        
    }

    public function restore($distributor_id)
    {
        Distributors::withTrashed()
        ->where('distributor_id', $distributor_id)
        ->restore();
        $categ= $this->model->show($distributor_id);
        $distributor_name = $categ->name;
        $email = $categ->email;
        // User::withTrashed()
        // ->where('email', $email)
        // ->restore();
        $log = new ActivityLog([
            "operations" => "Restored  ". " ".$email. " " . " To The Distributor's List",
            "user_id" => Auth::user()->user_id,
        ]);
        $log->save();
        return redirect()->back()->with([
            'success' => " You Have Restored". " ".$distributor_name. " " ." Details Successfully",
            
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
        if(auth()->user()->hasPermissionTo('distributor-create')){
           $validator =  $this->validate($request, [
                'name' =>'required|min:1|max:255',
                'email' =>'required|min:1|max:255|unique:distributors',
                'phone_one' =>'required|min:1|max:11|unique:distributors',
                
                'address' =>'required|min:1|max:255',
                'credit_limit' =>'required|min:1|max:255',
                'credit_reduction_per_month' =>'required|min:1|max:255',
                
            ]);
            
            if(empty($request->input("phone_two"))){
                $phone_two = "Null";
            }else{
                $phone_two = $request->input("phone_two");
            }
            if($request->input('credit_reduction_per_month') > ($request->input('credit_limit'))){
                return redirect()->back()->with("error", "Credit Reduction Can Not Be Greater That Credit Limit");
            
            }elseif(Distributors::where("phone_one", $request->input("phone_one"))->exists()){
                return redirect()->back()->with("error", $request->input('phone_one'). " ". "Is in Use By 
                Another Distributor");
            }elseif(Distributors::where("email", $request->input("email"))->exists()){
                return redirect()->back()->with("error", $request->input('email'). " ". 
                "Is in Use By Another Distributor");

            }else{
                $data = ([
                    "distributor" => new Distributors,
                    "name" => $request->input("name"),
                    "phone_one" => $request->input("phone_one"),
                    "phone_two" => $phone_two,
                    "email" => $request->input("email"),
                    "address" => $request->input("address"),
                    "credit_limit" => $request->input("credit_limit"),
                    "credit_reduction_per_month" => $request->input("credit_reduction_per_month"),
                ]);
                $role= 'Distributor';

                $log = new ActivityLog([
                    "operations" => "Added ".$request->input("email"). " To The Distributor List",
                    "user_id" => Auth::user()->user_id,
                ]);

                if(($this->model->create($data)) AND $log->save()){
                
                    return redirect()->route("distributor.create")->with("success", "You Have Added " 
                    .$request->input("name"). " To The Distributor List Successfully");
                }
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Create A Distributor",
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
    public function edit($distributor_id)
    {
        if(auth()->user()->hasPermissionTo('distributor-edit')){
            $distributor= $this->model->all();
            $dist = $this->model->show($distributor_id);
            return view('administrator.distributors.edit')->with([
                'distributor' => $distributor,
                'dist' =>$dist,
            ]);
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Edit A Distributor",
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
    public function update(Request $request, $distributor_id)
    {
        if(auth()->user()->hasPermissionTo('distributor-update')){
            $validator =  $this->validate($request, [
                'name' =>'required|min:1|max:255',
                'email' =>'required|min:1|max:255',
                'phone_one' =>'required|min:1|max:11',
               
                'address' =>'required|min:1|max:255',
                'credit_limit' =>'required|min:1|max:255',
                'credit_reduction_per_month' =>'required|min:1|max:255',
                 
            ]);
            if($request->input('credit_reduction_per_month') > ($request->input('credit_limit'))){
                return redirect()->back()->with("error", "Credit Reduction Can Not Be Greater That Credit Limit");
            }
            if(empty($request->input("phone_two"))){
                $phone_two = "Null";
            }else{
                $phone_two = $request->input("phone_two");
            }
            $data = ([
                "distributor" => $this->model->show($distributor_id),
                "name" => $request->input("name"),
                "phone_one" => $request->input("phone_one"),
                "phone_two" => $phone_two,
                "email" => $request->input("email"),
                "address" => $request->input("address"),
                "credit_limit" => $request->input("credit_limit"),
                "credit_reduction_per_month" => $request->input("credit_reduction_per_month"),
            ]);
           
            $log = new ActivityLog([
                "operations" => "Changed The Distributor E-Mail From ". " ".
                $request->input('prev_email') ." ". " To" .$request->input("email"),
                "user_id" => Auth::user()->user_id,
            ]);
            if($log->save() AND ($this->model->update($data, $distributor_id))){
               
                return redirect()->route("distributor.create")->with("success", 
                "You Have Updated The Distributor Details Successfully");
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Update A Distributor",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($distributor_id)
    {
        if(auth()->user()->hasPermissionTo('distributor-delete')){
            $distributor =  $this->model->show($distributor_id); 
            $details = Distributors::where([
                "distributor_id" => $distributor_id, 
            ])->first();
            
            $details= $distributor->name;  
            $log = new ActivityLog([
                "operations" => "Deleted ". " ". $details. " ". " From The Distributors List",
                "user_id" => Auth::user()->user_id,
            ]);
            if (($distributor->delete($distributor_id)) AND ($distributor->trashed())) {
            
                return redirect()->back()->with([
                    'success' => "You Have Deleted ". " ". $details. " ". "From The Distributor Details Successfully",
                ]);
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Delete A Distributor",
            ]);
        }
    }
}
