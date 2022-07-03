<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //USER CREATE
         $uuid = Str::uuid()->toString();
         $data_user = array(
             'name'=>'CEFRIAN YVES B. TRINCHERA',
             'email'=>'admin@gmail.com',
             'user_uuid'=>$uuid,
             'is_admin'=>'1',
             'password'=>md5('admin')
         );
 
         User::create($data_user);
    }
}
