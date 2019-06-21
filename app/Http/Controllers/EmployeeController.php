<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Employee, Salaries, User, ActivityLog, WareHouseManagement};
use App\Repositories\EmployeeRepository;
use DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class EmployeeController extends Controller
{
    protected $model;

    public function __construct(Employee $employee)
    {
       // set the model
       $this->model = new EmployeeRepository($employee);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('Administrator') 
        OR auth()->user()->hasRole('Admin')){
            $employee = Employee::orderBy("employee_id", "desc")->get();
            $warehouse = WareHouseManagement::orderBy("name", "asc")->get();
            return view('administrator.employee.create')->with([
                "employee" => $employee,
                "warehouse" => $warehouse,
            ]);
        }else{
            $inve = WareHouseManagement::where([
                'user_id'=> auth()->user()->user_id,
            ])->exists();
            if($inve){
                $inv = WareHouseManagement::where([
                    'user_id'=> auth()->user()->user_id,
                ])->first();
                $ware_house_id = $inv->ware_house_id;
                $emp =  Employee::where([
                    'ware_house_id'=> $inv->ware_house_id]
                )->orderBy('full_name', 'asc')->get();
                return view('administrator.employee.create')->with([
                    "emp" => $emp,
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
        $employee= Employee::onlyTrashed()->get();
        return view('administrator.employee.recyclebin')->with([
            'employee' => $employee,
        ]);
    }

    public function restore($employee_id)
    {
        Employee::withTrashed()
        ->where('employee_id', $employee_id)
        ->restore();
        $categ= $this->model->show($employee_id);
        $employee_name = $categ->full_name;
        $email = $categ->email;
        User::withTrashed()
        ->where('email', $email)
        ->restore();
        $log = new ActivityLog([
            "operations" => "Restored  ". " ".$email. " " . " To The employee List",
            "user_id" => Auth::user()->user_id,
        ]);
        $log->save();
        return redirect()->back()->with([
            'success' => " You Have Restored". " ".$employee_name. " " ." Details Successfully",
            
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
        if(auth()->user()->hasPermissionTo('employee-create')){
            $validator =  $this->validate($request, [
                'full_name' =>'required|min:1|max:255',
                'phone_number' =>'required|min:1|max:11|unique:employees',
                'email' =>'required|min:1|max:255|unique:employees',
                'contract_type' =>'required|min:1|max:255|',
                'address' =>'required|min:1|max:255', 
                'ware_house_id' => 'required|min:1|max:255', 
            ]);

            if(Employee::where("phone_number", $request->input("phone_number"))->exists()){
                return redirect()->back()->with("error", $request->input('phone_number'). " ". "Is in Use By 
                Another Employee");

            }elseif(User::where("email", $request->input("email"))->exists()){
                return redirect()->back()->with("error", $request->input('email'). " ". 
                "Is in Use By Another User");

            }else{
                $data = ([
                    "employee" => new Employee,
                    "full_name" => $request->input("full_name"),
                    "phone_number" => $request->input("phone_number"),
                    "email" => $request->input("email"),
                    "contract_type" => $request->input("contract_type"),
                    "address" => $request->input("address"),
                    "ware_house_id" => $request->input("ware_house_id"),
                ]);
                
                $use = new User([
                    "email" => $request->input("email"),
                    "name" => $request->input("full_name"),
                    "password" => Hash::make($request->input("email")),
                    "role" => $request->input('role'),
                    "status" => 1,
                    //"registration_number" => rand(0002, 2000),
                ]);

                $log = new ActivityLog([
                    "operations" => "Added ".$request->input("email"). " To The Employee List",
                    "user_id" => Auth::user()->user_id,
                ]);

                if($use->save() AND ($this->model->create($data)) AND $log->save()){
                    $addRole = $use->assignRole($request->input('role'));
                    return redirect()->route("employee.create")->with("success", "You Have Added " 
                    .$request->input("name"). " To The Employee List Successfully");
                }
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Create An Employee",
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
    public function edit($employee_id)
    {
        if(auth()->user()->hasPermissionTo('employee-edit')){
            if(auth()->user()->hasRole('Administrator') 
            OR auth()->user()->hasRole('Admin')){
                $employee = Employee::orderBy("employee_id", "desc")->get();
                $warehouse = WareHouseManagement::orderBy("name", "asc")->get();
                $employ = $this->model->show($employee_id); 
                $details = Employee::where([
                    "employee_id" => $employee_id, 
                ])->first();
                $email = $details->email;
                $user = User::where([
                    "email" => $email, 
                ])->first();
                $user_id = $user->user_id;
                $usd = $user = User::find($user_id);
                $roles = Role::pluck('name','name')->all();
                $userRole = $usd->roles->pluck('name','name')->all();
                return view('administrator.employee.edit')->with([
                    "employee" => $employee,
                    "employ" =>$employ,
                    "user" => $user,
                    "roles"=>$roles,
                    "userRole" => $userRole,
                    "usd" => $usd,
                    "warehouse" => $warehouse,
                ]);
            }else{
                $inve = WareHouseManagement::where([
                    'user_id'=> auth()->user()->user_id,
                ])->exists();
                if($inve){
                    $inv = WareHouseManagement::where([
                        'user_id'=> auth()->user()->user_id,
                    ])->first();
                    $ware_house_id = $inv->ware_house_id;
                    $employ = $this->model->show($employee_id); 
                    $details = Employee::where([
                        "employee_id" => $employee_id, 
                    ])->first();
                    $emp =  Employee::where([
                        'ware_house_id'=> $inv->ware_house_id]
                    )->orderBy('full_name', 'asc')->get();
                    $email = $details->email;
                    $user = User::where([
                        "email" => $email, 
                    ])->first();
                    $user_id = $user->user_id;
                    $usd = $user = User::find($user_id);
                    $roles = Role::pluck('name','name')->all();
                    $userRole = $usd->roles->pluck('name','name')->all();
                    return view('administrator.employee.edit')->with([
                        "emp" => $emp,
                        "inv" => $inv,
                        
                        "employ" =>$employ,
                        "user" => $user,
                        "roles"=>$roles,
                        "userRole" => $userRole,
                        "usd" => $usd,
                    ]);
                }else{
                    return redirect()->back()->with([
                        'error' => " You Do Not Belong To Any Ware House",
                    ]);
                }
            }
            
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Edit An Employee",
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
    public function update(Request $request, $employee_id)
    {
        if(auth()->user()->hasPermissionTo('employee-update')){
            $validator =  $this->validate($request, [
                'full_name' =>'required|min:1|max:255',
                'phone_number' =>'required|min:1|max:11',
                'email' =>'required|min:1|max:255',
                'contract_type' =>'required|min:1|max:255',
                'address' =>'required|min:1|max:255',  
                'ware_house_id' =>'required|min:1|max:255',  
            ]);

            $data = ([
                "employee" => $this->model->show($employee_id),
                "full_name" => $request->input("full_name"),
                "phone_number" => $request->input("phone_number"),
                "email" => $request->input("email"),
                "contract_type" => $request->input("contract_type"),
                "address" => $request->input("address"),
                "ware_house_id" => $request->input("ware_house_id"),
            ]);
            
            $sup = Employee::where([
                "employee_id" => $employee_id, 
            ])->first();
            $details = $sup->email;
            $upda =  User::where([
                "email" => $details, 
            ])->first();
            $user_id = $upda->user_id;
            DB::table('users')->where([
                'user_id' =>$user_id,
            ])->update([
                "email" => $request->input("email"),
                "name" => $request->input("full_name"),
                "password" => Hash::make($request->input("email")),
                "role" => $request->input('role'),
                "status" => 1,
            ]);
            DB::table('model_has_roles')->where('model_id',$user_id)->delete();

            $log = new ActivityLog([
                "operations" => "Changed The Employee E-Mail From ". " ".
                $request->input('prev_email') ." ". " To" .$request->input("email"),
                "user_id" => Auth::user()->user_id,
            ]);

            if(($this->model->update($data, $employee_id)) AND $log->save()){
                $addRole = $upda->assignRole($request->input('role'));
                return redirect()->route("employee.create")->with("success", "You Have Updated The Employee Details
                 Successfully");
            }

        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Edit An Employee",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($employee_id)
    {
        if(auth()->user()->hasPermissionTo('employee-delete')){
            $employee =  $this->model->show($employee_id); 
            $details = Employee::where([
                "employee_id" => $employee_id, 
            ])->first();
            
            $email = $details->email;
            $user = User::where([
                "email" => $email, 
            ])->first();
            $user_id = $user->user_id;
            $roles = $user->getRoleNames();
            $details= $employee->full_name;  
            $log = new ActivityLog([
                "operations" => "Deleted ". " ". $details. " ". " From The Employee List",
                "user_id" => Auth::user()->user_id,
            ]);
            if (($employee->delete($employee_id)) AND ($employee->trashed())AND($user->delete()) 
                AND ($user->trashed()) AND ($log->save())) {
                
                return redirect()->back()->with([
                    'success' => "You Have Deleted ". " ". $details. " ". 
                    "From The Employee Details Successfully",
                ]);
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Delete A employee",
            ]);
        }
    }
}
