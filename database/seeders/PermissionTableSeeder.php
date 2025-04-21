<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {   
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [

            'the bill',
            'list bill',
            'paid bils',
            'unpaid bills',
            'partially bills',
            'bill archive',
            'reports',
            'billing reports<',
            'customer reports',
            'users',
            'list of users',
            'user permissions',
            'settings',
            'products',
            'section',
    
    
            'add bill',
            'Delete bill',
            'Change of payment status',
            'edit bill',
            'archive bill',
            'Print bill',
            'Add attachment',
            'delete attachment',
    
            'add user',
            'edit user',
            'delet user',
    
           
            'show permission',
            'add permission',
            'edit permission',
            'delet permission',
    
            'add product',
            'edit product',
            'delete product',
    
            'add section',
            'edit section',
            'delete section',
            'Notifications',
    
    ];
    

    foreach ($permissions as $permission) {
        Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
    }
    
    
    }
}

