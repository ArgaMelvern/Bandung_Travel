<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = array(
            array(
                "email" => "admin1@bandungtravel.inc",
                "password" => Hash::make("admin1"),
                "name" => "Admin1",
                "role" => "admin",
            ),
            array(
                "email" => "admin2@bandungtravel.inc",
                "password" => Hash::make("admin2"),
                "name" => "Admin2",
                "role" => "admin",
            ),
        );

        foreach($arr as $data){
            $model = new User();
            $model->email = $data['email'];
            $model->password = $data['password'];
            $model->name = $data['name'];
            $model->role = $data['role'];
            $model->save();
        }
    }
}
