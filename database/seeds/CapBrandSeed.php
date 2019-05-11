<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CapBrandSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('capbrand')->insert([
            "Ristretto" =>10,
            "Espresso"=>100,
            "Lungo"=>30 ,
            'user_id' => 1
        ]);
    }
}
