<?php 

namespace App\Helpers;

/**
 * 
 */
class Categories
{
	public static function buildTreeCategory($category = [])
	{
		$data = [];
		$arrCheck = [];

		// lay ra tat ca cate cha lon nhat - parent id = 0
		// xu ly cap menu dau tien - level 0
		foreach ($category as $key => $val) {
			if($val['parent_id'] == 0){
				$arrCheck[] = $val['id']; // check khong trung 
				$val['subCate'] = []; // tao ra mang con sub cate
				$data[$val['id']] = $val;
			}
		}

		// xu ly cho menu cap con ben trong
		foreach ($category as $k => $item) {
			// lay ra nhung item ko ton tai trong mang arrCheck
			if(!in_array($item['id'], $arrCheck)){
				if($item['parent_id'] > 0){
					$arrCheck[] = $item['id']; // check trung cho lan tiep theo neu co
					$item['subCate'] = [];
					$data[$item['parent_id']]['subCate'][$item['id']] = $item;
				}
			}
		}

		return $data;
	} 
}