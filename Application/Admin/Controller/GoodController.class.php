<?php

namespace Admin\Controller;

class GoodController extends AdminController {

	public function index($cate_id=null, $query=null){

		$Good       = M('Good');
		$map		= array();
		if( $cate_id !== null ){
			$map['category_id'] = array('like', $cate_id.'%');
		}

		if( isset($query) )
		{
			unset($map['category_id']);
			$map['_string'] = "CONCAT(good_name,good_id,barcode,good_spec) like '%".$query."%'";
		}
		$list       = $this->lists($Good,$map,'id DESC');
		//$menu       = D('GoodCategory')->getCategoryTree();
		//$this->menu = $menu;
		$this->assign('_list',$list);
		$this->display();
	}

	public function json(){
		$menu = D('GoodCategory')->getCategoryTree();
		//echo json_encode($menu);
		$this->ajaxReturn($menu,'JSON');

	}
}