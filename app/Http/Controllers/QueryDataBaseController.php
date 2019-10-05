<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;

class QueryDataBaseController extends Controller
{
    public function test()
    {
        $dt = DB::connection('mysqlv2')->table('admins')->get();
        dd($dt);
    }

    public function index()
    {
    	// thuc hien cac cau lenh truy van o day
    	// lay ta ca du lieu trong bang admins
    	
    	// SELECT * FROM admins
    	$admins = DB::table('admins')->get();
        $admin = json_decode(json_encode($admins),true);

        foreach ($admin as $key => $val) {
            echo $val['id'];
            echo "<br/>";
        }
    	dd('aa');
    	
    	// SELECT a.id, a.username, a.password FROM admins AS a;
    	// $admins = DB::table('admins AS a')
    	//             ->select('a.id','a.username', 'a.password')
    	//             ->get();
    	// dd($admins);
    	
    	// SELECT * FROM admins AS a WHERE a.id = 1 AND a.gender = 1 AND a.role = 1 OR a.email = 'rc5bt@gmail.com';
    	// $admins = DB::table('admins AS a')
    	             // ->where('a.id',1)
    	             // ->where('a.gender',1)
    	             // ->where(['a.id' => 1, 'a.gender' => 1, 'a.role' => 1])
    	             // ->orWhere('a.fullname', 'test abc')
    	             // ->first();
    	// get() : fetchAll();
    	// first : fetch();
    	// dd($admins);
    	
    	// SELECT a.id, a.username FROM admins AS a WHERE a.id IN (1,2,3)
    	// SELECT a.id, a.username FROM admins AS a WHERE a.id NOT IN (1,2,3)
    	// $admins = DB::table('admins AS a')
    	// 			  ->select('a.id','a.username')
    	// 			  ->whereNotIn('a.id',[1,2,3])
    	// 			  ->get();
    	// dd($admins);		
    	
    	// SELECT max(a.id), min(a.id), avg(a.id)  FROM admins AS a
    	$admins = DB::table('admins AS a')
    			//->max('a.id');
    			//->min('a.id');
    			->avg('a.id');

    	// SELECT count(*) FROM admins
    	$count = DB::table('admins')->count();

    	// SELECT * FROM admins AS a LIMIT 3,5;
    	$data = DB::table('admins AS a')
    				->skip(3)
    				->take(5)
    				->get();
   
    	$data2 = DB::table('admins AS a')
    				->offset(3)
    				->limit(5)
    				->get();
    	// SELECT * FROM admins AS a WHERE a.username LIKE '%sxvbc%' OR a.email LIKE '%rc5bt@gmail.com%';
    	$dataLike = DB::table('admins AS a')
    				->where('a.username', 'LIKE', '%sxvbc%')
    				->orWhere('a.email', 'LIKE', '%rc5bt@gmail.com%')
    				->get();
    	//dd($dataLike);

    	// SELECT a.title, b.name_cate FROM posts AS a 
    	// INNER JOIN categories AS a ON a.categories_id = b.id
    	// WHERE a.id = 3;
    	$join = DB::table('posts AS a')
    				->select('a.title', 'b.name_cate')
    				//->join('categories AS b', 'a.categories_id', '=', 'b.id')
    				//->leftJoin('categories AS b', 'a.categories_id', '=', 'b.id')
    				->rightJoin('categories AS b', 'a.categories_id', '=', 'b.id')
    				->where('a.id', 3)
    				->first();
    	//dd($join);
    	
    	// insert + update + delete
    	// INSERT INTO tags(name_tag, description, status, created_at, updated_at) VALUES('Test-123', 'demo', 1, NOW(), null);
    	/*
    	$insert = DB::table('tags')->insert([
    		[
    			'name_tag' => 'Test-123-9797',
	    		'description' => 'demo',
	    		'status' => 1,
	    		'created_at' => date('Y-m-d H:i:s'),
	    		'updated_at' => null
	    	],
	    	[
    			'name_tag' => 'Test-123-221',
	    		'description' => 'demo-1212',
	    		'status' => 1,
	    		'created_at' => date('Y-m-d H:i:s'),
	    		'updated_at' => null
	    	],
    	]);
    	if($insert) {
    		echo "OK";
    	} else {
    		echo "FAIL";
    	}
    	*/
    	
    	// UPDATE categories AS a SET a.name_cate = 'test-cate-13', a.status = 0 WHERE a.id = 1; 
    	/*
    	$update = DB::table('categories AS a')
    				->where('a.id', 1)
    				->update([
    					'a.name_cate' => 'test-cate-13',
    					'a.status' => 0
    				]);
    	if($update) {
    		echo "OK";
    	} else {
    		echo "FAIL";
    	}
    	*/
    	// DELETE FROM admins WHERE id = 10;
    	/*
    	$del = DB::table('admins')
    				->where('id',10)
    				->delete();
    	if($del) {
    		echo "OK";
    	} else {
    		echo "FAIL";
    	}
    	*/
    }

    public function orm(Admin $admin)
    {
        $data = $admin->getAllDataAdmin();
        foreach ($data as $key => $val) {
            echo $val['id'];
            echo "<br/>";
        }

        $info = $admin->getDataAdminById(1);
        dd($info);


    }
}
