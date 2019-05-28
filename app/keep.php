//auth()->user()->assignRole(['Accountant']);
        // Role::create([
        //     'name'=>'Admin',
        //     'guard_name' => 'web'
        // ]);
        
        
        // Permission::create([
        //     'name'=>'credit-payment-delete',
        //     'guard_name' => 'web'
        // ]);
        $roleAccount = Role::where([
            'name' => 'Accountant',
        ])->first();
        $roleAccount->givePermissionTo([
            'salary-create',  'salary-update', 'salary-edit',
            'account-create',  'account-update', 'account-edit',
            'order-create',  'order-edit', 'order-update', 'order-invoice',
            'payment-create', 'payment-edit', 'payment-update', 'credit-payment', 
            'credit-payment-edit', 'credit-payment-update', 'credit-payment-delete'
        ]);
        $roleAdmin = Role::where([
            'name' => 'Administrator',
            'name' => 'Admin',
        ])->first();
        $roleAdmin->givePermissionTo([
            'category-restore',  'product-restore', 'variant-restore',
            'distributor-restore', 'supplier-restore', 'outlet-restore', 'warehouse-restore',
            'employee-restore', 'user-restore', 'salary-restore', 'account-restore', 
            'payment-restore', 'assign-restore',

            'assign-create', 'assign-edit', 'assign-update', 'assign-delete',
            'product-edit','product-create', 'product-delete', 'product-update',
            'category-edit', 'category-delete', 'category-update', 'category-create',
            'variant-create', 'variant-delete', 'variant-update', 'variant-edit',
            'distributor-create', 'distributor-edit', 'distributor-update', 'distributor-delete',
            'supplier-create', 'supplier-edit', 'supplier-update', 'supplier-delete',
            'outlet-create', 'outlet-edit', 'outlet-update', 'outlet-delete',
            'warehouse-create', 'warehouse-edit', 'warehouse-delete', 'warehouse-update',
            'employee-create', 'employee-delete', 'employee-update', 'employee-edit',
            'user-create', 'user-delete', 'user-update', 'user-edit',
            'salary-create', 'salary-delete', 'salary-update', 'salary-edit',
            'account-create', 'account-delete', 'account-update', 'account-edit',
            'order-create', 'order-update', 'order-edit', 'order-delete', 'order-invoice', 
            'payment-create', 'payment-edit', 'payment-update', 'payment-delete', 
            //'account-update', 'account-edit', 
            'print-invoice', 'credit-payment', 'credit-payment-edit', 'credit-payment-update',
            'credit-payment-delete'

        ]);

        $remove = Role::where([
            'name' => 'Admin',
        ])->first();

        $remove->revokePermissionTo([
            'warehouse-create', 'warehouse-edit', 'warehouse-delete', 'warehouse-update',

        ]);
        
        

        $editorRecep = Role::where([
            'name' => 'Editor',
            'name' => 'Receptionist',
        ])->first();
        $editorRecep->givePermissionTo([
            'product-edit','product-create', 'product-update',
            'category-edit', 'category-delete', 'category-create',
            'variant-create', 'variant-delete', 'variant-edit',
            'distributor-create', 'distributor-edit', 'distributor-update', 
            'supplier-create', 'supplier-edit', 'supplier-update', 
        ]);
        