<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login')->with('error', 'Please Login with Your Details');
});

Route::post("/", "AdministratorController@userlogin")->name("admin.login");
Route::get("/logout", "AdministratorController@logout")->name("admin.logout");


Auth::routes(['verify' => true]);
//Route::get('/home', 'HomeController@index')->name('home');
Route::group(["prefix" => "administrator", "middleware" => "verified"], function(){

    // Route::get('password/reset', 'Auth\ForgotPasswordController@showResetForm')->name('password.reset');
    // Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    // Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.token');
    // Route::post('password/reset', 'Auth\ResetPasswordController@reset');


    Route::get("/dashboard", "AdministratorController@index")->name("administrator.dashboard");
    //Route::get("/password/reset", "AdministratorController@index")->name("administrator.dashboard");
    Route::group(["prefix" => "categories"], function(){
        Route::get("/create", "CategoryController@index")->name("category.create");
        Route::post("/save", "CategoryController@store")->name("category.save");
        Route::get("/edit/{category_id}", "CategoryController@edit")->name("category.edit");   
        Route::get("/delete/{category_id}", "CategoryController@destroy")->name("category.delete");
        Route::post("/update/{category_id}", "CategoryController@update")->name("category.update"); 
        Route::get("/recyclebin", "CategoryController@bin")->name("category.restore"); 
        Route::get("/restore/{category_id}", "CategoryController@restore")->name("category.undelete");  
    });

    Route::group(["prefix" => "distributor"], function(){
        Route::get("/create", "DistributorController@index")->name("distributor.create");
        Route::post("/save", "DistributorController@store")->name("distributor.save");
        Route::get("/edit/{distributor_id}", "DistributorController@edit")->name("distributor.edit");   
        Route::get("/delete/{distributor_id}", "DistributorController@destroy")->name("distributor.delete");
        Route::post("/update/{distributor_id}", "DistributorController@update")->name("distributor.update");
        Route::get("/payment/{distributor_id}", "DistributorController@payment")->name("distributor.payment"); 
        Route::get("/outlet/{distributor_id}", "DistributorController@assignedoutlet")->name("distributor.outlet");     
        Route::get("/order/{distributor_id}", "DistributorController@order")->name("distributor.order");
        Route::get("/assign_outlet", "AssignOutletController@index")->name("assign.outlet.create");  
        Route::post("/save_assign_outlet", "AssignOutletController@store")->name("assign.outlet.save"); 
        Route::get("/delete/{assign_id}", "AssignOutletController@destroy")->name("assign.outlet.delete");
        
        Route::get("/recyclebin", "DistributorController@bin")->name("distributor.restore"); 
        Route::get("/restore/{distributor_id}", "DistributorController@restore")->name("distributor.undelete");  
    });

    Route::group(["prefix" => "outlets"], function(){
        Route::get("/create", "OutletController@index")->name("outlet.create");
        Route::post("/save", "OutletController@store")->name("outlet.save");
        Route::get("/edit/{outlet_id}", "OutletController@edit")->name("outlet.edit");   
        Route::get("/delete/{outlet_id}", "OutletController@destroy")->name("outlet.delete");
        Route::post("/update/{outlet_id}", "OutletController@update")->name("outlet.update"); 
        
        Route::get("/recyclebin", "OutletController@bin")->name("outlet.restore"); 
        Route::get("/restore/{outlet_id}", "OutletController@restore")->name("outlet.undelete");  
    });

    Route::group(["prefix" => "supplier"], function(){
        Route::get("/create", "SupplierController@index")->name("supplier.create");
        Route::post("/save", "SupplierController@store")->name("supplier.save");
        Route::get("/edit/{supplier_id}", "SupplierController@edit")->name("supplier.edit");   
        Route::get("/delete/{supplier_id}", "SupplierController@destroy")->name("supplier.delete");
        Route::post("/update/{supplier_id}", "SupplierController@update")->name("supplier.update");  
        Route::get("/product/{supplier_id}", "SupplierController@product")->name("supplier.product");   
        Route::get("/recyclebin", "SupplierController@bin")->name("supplier.restore"); 
        Route::get("/restore/{supplier_id}", "SupplierController@restore")->name("supplier.undelete");  
    });

    Route::group(["prefix" => "production_material"], function(){
        Route::get("/create", "ProductVariantController@index")->name("variant.create");
        Route::post("/save", "ProductVariantController@store")->name("variant.save");
        Route::get("/edit/{variant_id}", "ProductVariantController@edit")->name("variant.edit");   
        Route::get("/delete/{variant_id}", "ProductVariantController@destroy")->name("variant.delete");
        Route::post("/update/{variant_id}", "ProductVariantController@update")->name("variant.update"); 
        
        Route::get("/recyclebin", "ProductVariantController@bin")->name("variant.restore"); 
        Route::get("/restore/{variant_id}", "ProductVariantController@restore")->name("variant.undelete");  
    });

    Route::group(["prefix" => "warehouse"], function(){
        Route::get("/create", "WareHouseManagementController@index")->name("warehouse.create");
        Route::post("/save", "WareHouseManagementController@store")->name("warehouse.save");
        Route::get("/edit/{ware_house_id}", "WareHouseManagementController@edit")->name("warehouse.edit");   
        Route::get("/delete/{ware_house_id}", "WareHouseManagementController@destroy")->name("warehouse.delete");
        Route::post("/update/{ware_house_id}", "WareHouseManagementController@update")->name("warehouse.update");
        
        Route::get("/recyclebin", "WareHouseManagementController@bin")->name("warehouse.restore"); 
        Route::get("/restore/{ware_house_id}", "WareHouseManagementController@restore")->name("warehouse.undelete");  
    });

    Route::group(["prefix" => "products"], function(){
        Route::get("/create", "ProductController@index")->name("product.create");
        Route::post("/save", "ProductController@store")->name("product.save");
        Route::get("/edit/{product_id}", "ProductController@edit")->name("product.edit");   
        Route::get("/delete/{product_id}", "ProductController@destroy")->name("product.delete");
        Route::post("/update/{product_id}", "ProductController@update")->name("product.update");  
        
        Route::get("/recyclebin", "ProductController@bin")->name("product.restore"); 
        Route::get("/restore/{product_id}", "ProductController@restore")->name("product.undelete");  
    });

    Route::group(["prefix" => "inventory"], function(){
        Route::get("/index", "InventoryStockController@index")->name("inventory.index"); 
        Route::get("/in_stock", "InventoryStockController@instock")->name("inventory.instock"); 
        Route::get("/out_of_stock", "InventoryStockController@outofstock")->name("inventory.outstock"); 
        Route::get("/recyclebin", "InventoryStockController@bin")->name("inventory.restore"); 
        Route::get("/restore/{strock_id}", "InventoryStockController@restore")->name("inventory.undelete");  
    });

    Route::group(["prefix" => "activities"], function(){
        Route::get("/all_log", "ActivityLogController@index")->name("log.index"); 
        Route::get("/index", "ActivityLogController@mylog")->name("log.user"); 

        // Route::get("/recyclebin", "ActivityLogController@bin")->name("inventory.restore"); 
        // Route::get("/restore/{strock_id}", "ActivityLogController@restore")->name("inventory.undelete");  
    });

    Route::group(["prefix" => "orders"], function(){
        Route::get("/index", "OrderController@index")->name("order.index");
        Route::get("/create", "OrderController@create")->name("order.create");
        Route::get("/order_invoice", "OrderController@invoice")->name("order.invoice");
        Route::get("/invoice_details/{transaction_number}", "OrderController@printinvoice")->
         name("print.invoice");
         Route::get("/print_invoice/{transaction_number}", "OrderController@generateprintinvoice")->
         name("print.the.invoice"); 
         Route::get("/details/{transaction_number}", "OrderController@details")->name("order.details");   
        Route::post("/save", "OrderController@store")->name("order.save");
        Route::get("/edit/{transaction_number}", "OrderController@edit")->name("order.edit");   
        Route::get("/delete/{order_id}", "OrderController@destroy")->name("order.delete");
        Route::post("/update/{transaction_number}", "OrderController@update")->name("order.update");   
    });

    Route::group(["prefix" => "sales"], function(){
        Route::get("/index", "SalesController@index")->name("sales.index");
        Route::get("/invoice", "SalesController@invoice")->name("sales.invoice");
        Route::get("/sales_report", "SalesController@report")->name("sales.report");
        Route::get("/invoice_details/{transaction_number}", "OrderController@printinvoice")->
         name("print.sales.invoice");
          
    });

    Route::group(["prefix" => "users"], function(){
        Route::get("/create", "UserController@index")->name("user.create");
        Route::post("/save", "UserController@store")->name("user.save");
        Route::get("/profile", "UserController@profile")->name("user.profile");
        Route::get("/edit/{user_id}", "UserController@edit")->name("user.edit");   
        Route::get("/delete/{user_id}", "UserController@destroy")->name("user.delete");
        Route::post("/update/{user_id}", "UserController@update")->name("user.update"); 
        Route::post("/update_profile/{user_id}", "UserController@updateprofile")->name("profile.update"); 

        Route::get("/change_password", "UserController@resetpassword")->name("change.pasword");
        Route::post("/update_password/{user_id}", "UserController@updatepassword")->name("update.password");
        
        Route::get("/recyclebin", "UserController@bin")->name("user.restore"); 
        Route::get("/restore/{user_id}", "UserController@restore")->name("user.undelete");  
    });

    Route::group(["prefix" => "payments"], function(){
        Route::get("/index", "PaymentController@index")->name("payment.index");
        Route::get("/create", "PaymentController@create")->name("payment.create");
        Route::get("/make-payment/{transaction_number}", "PaymentController@makepayment")->
            name("payment.add");
        Route::post("/save", "PaymentController@store")->name("payment.save");
        Route::get("/make-payment/{invoice_number}", "PaymentController@viewpaymentdetails")->
        name("payment.details");
        Route::get("/edit/{payment_number}", "PaymentController@edit")->name("payment.edit");  
        Route::get("/details/{payment_number}", "PaymentController@details")->name("payment.details");   
        Route::get("/delete/{invoice_number}", "PaymentController@destroy")->name("payment.delete");
        Route::post("/update/{payment_number}", "PaymentController@update")->name("payment.update");   
    });

    Route::group(["prefix" => "credits"], function(){
        Route::get("/index", "CreditManagementsController@index")->name("credit.index");
        Route::get("/create", "CreditManagementsController@create")->name("credit.create");
        Route::get("/paid", "CreditManagementsController@paid")->name("credit.paid");
        Route::get("/unpaid", "CreditManagementsController@unpaid")->name("credit.unpaid");
        Route::get("/clear_credit/{payment_number}", "CreditPaymentController@clearCredit")->name("credit.clear");
        Route::post("/save", "CreditManagementsController@store")->name("credit.save");
        Route::get("/payments", "CreditPaymentController@index")->name("credit.payment");

        Route::get("/edit/{employee_id}", "CreditManagementsController@edit")->name("credit.edit");   
        Route::get("/delete/{employee_id}", "CreditManagementsController@destroy")->name("credit.delete");
        Route::post("/update/{employee_id}", "CreditManagementsController@update")->name("credit.update"); 
        
    });

   

    Route::group(["prefix" => "employee"], function(){
        Route::get("/create", "EmployeeController@index")->name("employee.create");
        Route::post("/save", "EmployeeController@store")->name("employee.save");
        Route::get("/edit/{employee_id}", "EmployeeController@edit")->name("employee.edit");   
        Route::get("/delete/{employee_id}", "EmployeeController@destroy")->name("employee.delete");
        Route::post("/update/{employee_id}", "EmployeeController@update")->name("employee.update"); 
        
        Route::get("/recyclebin", "EmployeeController@bin")->name("employee.restore"); 
        Route::get("/restore/{employee_id}", "EmployeeController@restore")->name("employee.undelete");  
    });

    Route::group(["prefix" => "salaries"], function(){
        Route::get("/index", "SalaryController@index")->name("salary.index");
        Route::get("/create", "SalaryController@create")->name("salary.create");
        Route::post("/save", "SalaryController@store")->name("salary.save");
        Route::get("/edit/{salary_id}", "SalaryController@edit")->name("salary.edit");   
        Route::get("/delete/{salary_id}", "SalaryController@destroy")->name("salary.delete");
        Route::post("/update/{salary_id}", "SalaryController@update")->name("salary.update"); 
        
        Route::get("/recyclebin", "SalaryController@bin")->name("salary.restore"); 
        Route::get("/restore/{salary_id}", "SalaryController@restore")->name("salary.undelete");  
    });
});

