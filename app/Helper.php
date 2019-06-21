<?php 
    function UsersDetails($user_id){
        return \DB::table('users')->where([
            "user_id" => $user_id
        ])->get();
    }

    function employeeDetail($email){
        return \DB::table('users')->where([
            "email" => $email
        ])->get();
    }

    function ProductCategory($category_id){
        return \DB::table('categories')->where([
            "category_id" => $category_id
        ])->get();
    }

    function ProductDistributor($distributor_id){
        return \DB::table('distributors')->where([
            "distributor_id" => $distributor_id
        ])->get();
    }

    function EmployeeDetails($employee_id){
        return \DB::table('employees')->where([
            "employee_id" => $employee_id
        ])->get();
    }

    function ProductStock($stock_id){
        return \DB::table('inventory_stocks')->where([
            "stock_id" => $stock_id
        ])->get();
    }

    function ProductOrders($order_id){
        return \DB::table('orders')->where([
            "order_id" => $order_id
        ])->get();
    }

    function ProductTransOrders($transaction_number){
        return \DB::table('orders')->where([
            "transaction_number" => $transaction_number
        ])->get();
    }

    

    function OutletDetails($outlet_id){
        return \DB::table('outlets')->where([
            "outlet_id" => $outlet_id
        ])->get();
    }

    function ProductsDetails($product_slug){
        return \DB::table('products')->where([
            "product_slug" => $product_slug
        ])->get();
    }

    function ProductVariants($variant_id){
        return \DB::table('product_variants')->where([
            "variant_id" => $variant_id
        ])->get();
    }

    function ProductSales($sales_id){
        return \DB::table('sales')->where([
            "sales_id" => $sales_id
        ])->get();
    }

    function ProductSupplier($supplier_id){
        return \DB::table('suppliers')->where([
            "supplier_id" => $supplier_id
        ])->get();
    }

    function UserRoles($role_id){
        return \DB::table('user_roles')->where([
            "role_id" => $role_id
        ])->get();
    }

    function WareHouseDetails($ware_house_id){
        return \DB::table('ware_house_managements')->where([
            "ware_house_id" => $ware_house_id
        ])->get();
    }

    function monthly()
    {
        return \DB::table('payments')->where([
            "month" => $month
        ])->get();
    }

?>