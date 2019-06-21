<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\{Employee, Salaries, User, ActivityLog, WareHouseManagement};
use App\Repositories\SalaryRepository;
use DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SalaryController extends Controller
{
    protected $model;

    public function __construct(Salaries $employee)
    {
       // set the model
       $this->model = new SalaryRepository($employee);
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
            $salary = Salaries::orderBy("salary_id", "desc")->get();
            $employee = Employee::orderBy("employee_id", "desc")->get();
            
            return view('administrator.salaries.index')->with([
                "salary" => $salary,
                "employee" => $employee,
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
                $sal = Salaries::where('ware_house_id', $ware_house_id)->orderBy("salary_id", "desc")->get();
                $emp =  Employee::where([
                    'ware_house_id'=> $inv->ware_house_id]
                )->orderBy('full_name', 'asc')->get();
                return view('administrator.salaries.index')->with([
                    "sal" => $sal,
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
        $salary = Salaries::orderBy("salary_id", "desc")->get();
        $employee = Employee::orderBy("full_name", 'asc')->get();
        return view('administrator.salaries.create')->with([
            "employee" => $employee,
            "salary" => $salary,
        ]);
    }

    public function bin()
    {
        $salary= Salaries::onlyTrashed()->get();
        return view('administrator.salaries.recyclebin')->with([
            'salary' => $salary,
        ]);
    }

    public function restore($salary_id)
    {
        Salaries::withTrashed()
        ->where('salary_id', $salary_id)
        ->restore();
        $salary= $this->model->show($salary_id);
        $staff = Employee::where('employee_id', $salary->employee_id)->first();
        $log = new ActivityLog([
            "operations" => "Restored Salary For $staff->full_name for ". " ". date('M-Y'),
            "user_id" => Auth::user()->user_id,
        ]);
        $log->save();
        return redirect()->back()->with([
            'success' => " You Have Restored Salary For $staff->full_name for ". " ". date('M-Y'). " " . "Successfully",
            
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
        if(auth()->user()->hasPermissionTo('salary-create')){
            $validator =  $this->validate($request, [
                'employee_id' =>'required|min:1|max:255',
                'over_time' =>'max:255',
                'hours' =>'max:255|',
                'rate' =>'max:255',  
            ]);
            $staff = Employee::where('employee_id', $request->input('employee_id'))->first();
            $check = Salaries::where([
                'employee_id' => $request->input("employee_id"),
                'month' => date("M-Y")
            ])->get();
            if(count($check) > 0){
                return redirect()->back()->with([
                    'error' => "You Have Computed $staff->full_name Salary for ". " ". date('M-Y'),
                ]);
            }else{

                $contract_type = $staff->contract_type;
                if($contract_type == "Permanant Staff"){
                    $basic_salary = 30000;
                    $daily_salary = 1000;
                }else{
                    $basic_salary = 20000;
                    $daily_salary = 500;
                }
                $daily = $request->input("hours");
                $weekly = $request->input("weekly") * $daily;
                $monthly = $request->input("monthly") * $weekly;

                if($request->input("over_time") == "Yes"){
                    $over_time = (10 * $daily_salary) / 100;
                }else{
                    $over_time = 0;
                }


                $calc = $over_time + $monthly + $request->input('rate');
                $total = $calc * $daily_salary; 

                
                $data = ([
                    "salary" => new Salaries,
                    "employee_id" => $request->input("employee_id"),
                    "over_time" => $over_time,
                    "hours" => $daily,
                    "rate" => $request->input("rate"),
                    "basic_salary" => $daily_salary,
                    "total" => $total,
                    "month" => date('M-Y'),
                    "weekly" => $request->input("weekly"),
                    "monthly" => $request->input("monthly"),
                    "ware_house_id" => $staff->ware_house_id,
                
                ]);
    
                $log = new ActivityLog([
                    "operations" => "Computed Salary For $staff->full_name for the month of ". " ". date('M-Y'),
                    "user_id" => Auth::user()->user_id,
                ]);

                if(($this->model->create($data)) AND $log->save()){
                    return redirect()->route("salary.index")->with("success", 
                    "You Have Computed Salary For $staff->full_name for the month of ". " ". date('M-Y'). " ". "Successfully");
                }
            }
            
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Create A Salary",
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($salary_id)
    {
        $salary = Salaries::orderBy("salary_id", "desc")->get();
        $employee = Employee::orderBy("full_name", 'asc')->get();
        $sal = $this->model->show($salary_id);
        return view('administrator.salaries.edit')->with([
            "employee" => $employee,
            "salary" => $salary,
            "sal" => $salary,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($salary_id)
    {
        $salar = $this->model->show($salary_id);
        if(auth()->user()->hasRole('Administrator') 
        OR auth()->user()->hasRole('Admin')){
            $salary = Salaries::orderBy("salary_id", "desc")->get();
            $employee = Employee::orderBy("employee_id", "desc")->get();
            return view('administrator.salaries.edit')->with([
                "salary" => $salary,
                "employee" => $employee,
                "salar" => $salar,
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
                $sal = Salaries::where('ware_house_id', $ware_house_id)->orderBy("salary_id", "desc")->get();
                
                
                $emp =  Employee::where([
                    'ware_house_id'=> $inv->ware_house_id]
                )->orderBy('full_name', 'asc')->get();
                return view('administrator.salaries.edit')->with([
                    "sal" => $sal,
                    "emp" => $emp,
                    "inv" => $inv,
                    "salar" => $salar,
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
    public function update(Request $request, $salary_id)
    {
        if(auth()->user()->hasPermissionTo('salary-update')){
            $validator =  $this->validate($request, [
                'employee_id' =>'required|min:1|max:255',
                'over_time' =>'max:255',
                'hours' =>'max:255|',
                'rate' =>'max:255',  
            ]);
            $staff = Employee::where('employee_id', $request->input('employee_id'))->first();
            $contract_type = $staff->contract_type;
            if($contract_type == "Permanant Staff"){
                $basic_salary = 30000;
                $daily_salary = 1000;
            }else{
                $basic_salary = 20000;
                $daily_salary = 500;
            }
            $daily = $request->input("hours");
            $weekly = $request->input("weekly") * $daily;
            $monthly = $request->input("monthly") * $weekly;

            if($request->input("over_time") == "Yes"){
                $over_time = (10 * $daily_salary) / 100;
            }else{
                $over_time = 0;
            }


            $calc = $over_time + $monthly + $request->input('rate');
            $total = $calc * $daily_salary; 

            
            $data = ([
                "salary" => $this->model->show($salary_id),
                "employee_id" => $request->input("employee_id"),
                "over_time" => $over_time,
                "hours" => $daily,
                "rate" => $request->input("rate"),
                "basic_salary" => $daily_salary,
                "total" => $total,
                "month" => date('M-Y'),
                "weekly" => $request->input("weekly"),
                "monthly" => $request->input("monthly"),
                "ware_house_id" => $staff->ware_house_id,
            
            ]);

            $log = new ActivityLog([
                "operations" => "Updated Salary For $staff->full_name for the month of ". " ". date('M-Y'),
                "user_id" => Auth::user()->user_id,
            ]);

            if(($this->model->update($data, $salary_id)) AND $log->save()){
                return redirect()->route("salary.index")->with("success", 
                "You Have Updated Salary For $staff->full_name for the month of ". " ". date('M-Y'). " ". "Successfully");
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Update A Salary",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($salary_id)
    {
        if(auth()->user()->hasPermissionTo('salary-delete')){
            $salary =  $this->model->show($salary_id);

            $staff = Employee::where('employee_id', $salary->employee_id)->first();
            $full_name = $staff->full_name;
            $month = $salary->month;
            
            $log = new ActivityLog([
                "operations" => "Deleted $full_name Salary For $month From The Salary List",
                "user_id" => Auth::user()->user_id,
            ]);
            if (($salary->trashed()) AND($salary->delete($salary_id)) AND($log->save())){
                
                return redirect()->back()->with([
                    'success' => "You Have Deleted $full_name Salary For $month From The Salary List Successfully",
                ]);
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Delete A Salary",
            ]);
        }
    }
}
