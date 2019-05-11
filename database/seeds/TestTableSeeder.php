<?php

use Illuminate\Database\Seeder;

class TestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Test')->insert([
        	'Name'=>'Thanh';
        	'created_at' => new DateTime();
        ]);
    }
}
