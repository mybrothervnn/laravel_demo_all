<?php

use Illuminate\Database\Seeder;

class SlideTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <10 ; $i++) { 
        	DB::table('Slide')->insert([
	        	'Ten' => 'Slide_'.$i,
	        	'Hinh' => 'Hinh_'.$i.'.jpg',
	        	'NoiDung' => 'NoiDung_'.$i,
	        	'Link' => 'http://localhost/hinh_'.$i.'.jpg',
	        	'created_at' => new DateTime()
        	]);
        }
        
    }
}
