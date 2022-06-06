<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PlaceType;

class PlaceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = array(
            array("id" => 1, "name" => "Situs Cagar Budaya"), 
            array("id" => 2, "name" => "Hotel"), 
            array("id" => 3, "name" => "Museum"), 
            array("id" => 4, "name" => "Mall"), 
            array("id" => 5, "name" => "Outlet"), 
            array("id" => 6, "name" => "Wisata Buatan"), 
            array("id" => 7, "name" => "Wisata Pendidikan dan Sejarah"), 
            array("id" => 8, "name" => "Wisata Religi"), 
            array("id" => 9, "name" => "Wisata Budaya")
        );

        foreach($arr as $data){
            $model = new PlaceType();
            $model->name = $data['name'];
            $model->save();
        }

    }
}
