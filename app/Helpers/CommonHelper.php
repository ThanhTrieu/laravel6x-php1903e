<?php

namespace App\Helpers;

/**
 * 
 */
class CommonHelper
{
	public static function testHelper($categories = [])
	{
		// xu ly build tree for category
		$data = [];
		$arrCheck = [];
		// xu ly tree cap 0 (cha to nhat)
		foreach ($categories as $key => $val) {
			if($val['parent_id'] == 0){
				$arrCheck[] = $val['id'];
				$val['subChilds'] = [];
				$data[$val['id']] = $val;
			}
		}
		// xu ly tree cap 1 (con nho hon)
		foreach ($categories as $k => $item) {
			// lay ra nhung thang ko bi trung voi nhung thang cha cua no
			if($item['parent_id'] > 0){
				if(isset($data[$item['parent_id']])){
					// kiem tra lai 1 lan nua la co ton tai nhung thang con nam ben trong cua tree cap 0
					$item['subChilds'] = [];
					$arrCheck[] = $item['id']; // tien su dung cho cap tiep theo
					$data[$item['parent_id']]['subChilds'][$item['id']] = $item;
				}
			}
		}
		return $data;
	}
}