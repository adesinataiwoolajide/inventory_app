<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'product-list',
            'product-create',
            'product-edit',
            'product-delete'
            ,
            'category-create',
            'category-edit',
            'category-delete',
            'category-update',

            'variant-create',
            'varient-edit',
            'variant-delete',
            'variant-update',

            'distributor-create',
            'distributor-edit',
            'distributor-delete',
            'distributor-update',

            'supplier-create',
            'supplier-edit',
            'supplier-delete',
            'supplier-update',

            'outlet-create',
            'outlet-edit',
            'outlet-delete',
            'outlet-update',

            'order-create',
            'order-edit',
            'order-delete',
            'order-update',



         ];
 
 
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
