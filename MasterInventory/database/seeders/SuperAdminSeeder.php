<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Creating Super Admin user
        $superAdmin= User::create([
            'name'=>'Charles Maina',
            'email'=>'Charles@gmail.com',
            'password'=> Hash::make('Charles278')
        ]);

        $superAdmin->assignRole('Super Admin');

        //Creating Admin User
        $admin=User::create([
            'name'=> 'James Gichuki',
            'email'=> 'Gichuki03@gmail.com',
            'password'=> Hash::make('Gichuki1234')
            
        ]);
        $admin->assignRole('Admin');

        //Creating the Product manager
        $productManager= User::create([
            'name'=>'Peter Wamai',
            'email'=>'Wamaip@gmail.com',
            'password'=>Hash::make('Wamai789')
        ]);
        $productManager->assignRole('Product Manager');
        
    }
}
