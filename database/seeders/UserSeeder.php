<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        $rol_admin = Role::where("name","admin")->first();
        $rol_user = Role::where("name","User")->first();
        User::create([
                "name"=>"User",
                "lastname"=>"admin",
                "rol_id"=>$rol_admin->id,
                "avatar"=>asset('img/user_avatar.png'),
                "email"=>"admin@admin.com",
                "password"=>Hash::make("password"),
        ]);
        foreach(range(1,5) as $user){
            User::create([
                "name"=>"User",
                "lastname"=>"lastname ".$user,
                "rol_id"=>$rol_user->id,
                "email"=>"user".$user."@user.com",
                "avatar"=>asset('img/user_avatar.png'),
                "password"=>Hash::make("password"),
            ]);
        }
    }
}
