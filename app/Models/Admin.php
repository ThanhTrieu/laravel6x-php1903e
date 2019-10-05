<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admin extends Model
{
    // quy uoc lam viec voi table admins
    protected $table = 'admins'; 

    public function getAllDataAdmin()
    {
    	$newData = [];
    	$data = Admin::all();
    	if($data){
    		$newData = $data->toArray();
    	}
    	return $newData;
    }
    public function getDataAdminById($id = 0)
    {
    	$info = [];
    	$data = Admin::find($id);
    	if($data){
    		$info = $data->toArray();
    	}
    	return $info;
    }

    public function getDataAdminByConditon()
    {
    	$data = Admin::select('*')
    				->where('id',2)
    				->first();
    	if($data){
    		$data = $data->toArray();
    	}
    	return $data;
    }

    public function testQueryBuilder()
    {
    	$data = DB::table('posts')->get();
    	return $data;
    }
}
