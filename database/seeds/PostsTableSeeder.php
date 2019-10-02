<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 20 ; $i++) { 
        	DB::table('posts')->insert([
        		'title' => Str::random(8),
        		'slug' => Str::slug('test bai viet ' . $i, '-'),
        		'sapo' => Str::random(20),
        		'categories_id' => ($i > 10) ? floor($i/2) : $i,
        		'publish_date' => null,
        		'avatar' => Str::random(3) . '.jpg',
        		'admins_id' => ($i > 10) ? floor($i/2) : $i,
        		'count_view' => 0,
        		'lang_id' => 1,
        		'status' => 1,
        		'created_at' => date('Y-m-d H:i:s'),
        		'updated_at' => null
        	]);
        }
    }
}
