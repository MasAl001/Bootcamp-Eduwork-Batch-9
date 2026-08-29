<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createUser('Admin', 'admin@example.com', 'password', 'admin');
        $this->createUser('User', 'user@example.com', 'password', 'user');
    }

    private function createUser(
        string $name, 
        string $email, 
        string $password, 
        string $role
    ){
        $checkUser = User::where('email', $email)->first();
        if($checkUser){
            return;
        }
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => $role,
        ]);
    }
}
