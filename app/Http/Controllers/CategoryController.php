<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Categories, User, ActivityLog};
use App\Repositories\CategoryRepository;
use DB;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    protected $model;
    public function __construct(Categories $category)
    {
       // set the model
       $this->model = new CategoryRepository($category);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category= Categories::orderBy('category_name', 'asc')->get();
        return view('administrator.categories.create')->with([
            'category' => $category,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bin()
    {
        $category= Categories::onlyTrashed()->get();
        return view('administrator.categories.recyclebin')->with([
            'category' => $category,
        ]);
    }

    public function restore($category_id)
    {
        if(auth()->user()->hasPermissionTo('category-restore')){
            Categories::withTrashed()
            ->where('category_id', $category_id)
            ->restore();
            $categ= $this->model->show($category_id);
            $category_name = $categ->category_name;
            $log = new ActivityLog([
                "operations" => "Restored  ". " ".$category_name. " " . " To The Category List",
                "user_id" => Auth::user()->user_id,
            ]);
            $log->save();
            return redirect()->back()->with([
                'success' => " You Have Restored". " ".$category_name. " " ." Details Successfully",
                // "category" => $category,
            ]);
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Restore A Product Category",
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
        if(auth()->user()->hasPermissionTo('category-create')){
            $this->validate($request, [
                'category_name' =>'required|min:1|max:255|unique:categories',
            ]);
            // $category = new Categories;
            // $category->category_name = $request->input("category_name");
            //$saveCategory = $category->save();
            $data = ([
                "category" => new Categories,
                "category_name" => $request->input("category_name"),
            ]);

            $log = new ActivityLog([
                "operations" => "Added ".$request->input("category_name"). " To The Category List",
                "user_id" => Auth::user()->user_id,
            ]);

            if($log->save() AND ($this->model->create($data))){
                return redirect()->route("category.create")->with("success", "You Have Added " 
                .$request->input("category_name"). " To The Category List Successfully");
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Create Product Category",
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
    public function edit($category_id)
    {
        $categ= $this->model->show($category_id);
        $category= $this->model->all();
        return view('administrator.categories.edit')->with([
            'category' => $category,
            'categ' => $categ,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category_id)
    {
        if(auth()->user()->hasPermissionTo('category-update')){
            $this->validate($request, [
                'category_name' =>'required|min:1|max:255',
            ]);
            $data = ([
                "category" => $this->model->show($category_id),
                "category_name" => $request->input("category_name"),
            ]);

            $log = new ActivityLog([
                "operations" => "Changed The Category name From ". " ".
                $request->input('prev_name') ." ". " To" .$request->input("category_name"),
                "user_id" => Auth::user()->user_id,
            ]);

            if($log->save() AND ($this->model->update($data, $category_id))){
                return redirect()->route("category.create")->with("success", "You Have Changed The Category name From ". " ".
                $request->input('prev_name') ." ". " To " .$request->input("category_name"). " ". "Successfully");
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Update A Product Category",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_id)
    {
        if(auth()->user()->hasPermissionTo('category-delete')){
            $category =  $this->model->show($category_id); 
            $details= $category->category_name;  
            $log = new ActivityLog([
                "operations" => "Deleted ". $details. " From The Category List",
                "user_id" => Auth::user()->user_id,
            ]);
            if (($category->delete($category_id))AND ($category->trashed())) {
                return redirect()->back()->with([
                    'success' => "You Have Deleted". $details. " ". "From The Category Details Successfully",
                ]);
            }
        } else{
            return redirect()->back()->with([
                'error' => "You Dont have Access To Delete A Product Category",
            ]);
        }
    }
}
