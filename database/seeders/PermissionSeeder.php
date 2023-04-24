<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
            // +++++++++++++++++++++++++++++++Start Admin Role&&Permission+++++++++++++++++++++++++++++++++++++

            $permissions = [

                'permission_access',
                'permission_grant',
                'permission_revoke',

                'role_access',
                'role_create',
                'role_grant',
                'role_revoke',

                'order_access',
                'order_show',
                'order_delete',
                'order_search',
                'order_create',
                'order_update',


                'library_access',
                'library_show',
                'library_create',
                'library_update',
                'library_delete',
                'library_search',

                'books_access',
                'book_create',
                'book_update',
                'book_delete',
                'book_search',
                'book_show',
                'books_mostWanted',


                'categories_access',
                'category_create',
                'category_show',
                'category_update',
                'category_delete',

            ];
            foreach ($permissions as $permission)   {
                Permission::create([
                    'name' => $permission
                ]);
            }
            // create Admin Role
        $Admin = Role::create(['name' => 'Admin']);


        foreach ($permissions as $permission)   {
            $Admin->givePermissionTo($permission);
        }

         // asign Admin Role to first user
         $admin = User::where('id' , 1)->first();
         $admin->assignRole('Admin');



         // +++++++++++++++++++++++++++++++End Admin Role&&Permission+++++++++++++++++++++++++++++++++++++

        // +++++++++++++++++++++++++++++++Start LibraryOwner Role&&Permission+++++++++++++++++++++++++++++++++++++

        $libraryowner = Role::create(['name' => 'LibraryOwner']);


                // create libraryowner permissions

        $permissions = [

                'books_access',
                'book_create',
                'book_update',
                'book_delete',
                'book_show',
                'books_mostWanted',


                'order_access',
                'order_show',
                'order_delete',
                'order_search',
                'order_update',

                'library_access',
                'library_show',
                'library_create',
                'library_update',
                'library_delete',

                'categories_access',
                'category_create',
                'category_show',
                'category_update',
                'category_delete',
            ];


            foreach ($permissions as $permission)   {
                $libraryowner->givePermissionTo($permission);
            }

            // +++++++++++++++++++++++++++++++End LibraryOwner Role&&Permission+++++++++++++++++++++++++++++++++++++




            // +++++++++++++++++++++++++++++++Start Customer Role&&Permission+++++++++++++++++++++++++++++++++++++

            $customer = Role::create(['name' => 'Customer']);

            $permissions = [
                'order_create',
                'library_search',
                'book_search',
                'book_show',
                'categories_access',
                'category_show',
                'books_mostWanted',



            ];
            foreach ($permissions as $permission)   {
                $customer->givePermissionTo($permission);
            }




            // +++++++++++++++++++++++++++++++End Customer Role&&Permission+++++++++++++++++++++++++++++++++++++



    }
}
