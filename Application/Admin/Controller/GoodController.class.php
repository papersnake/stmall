<?php

namespace Admin\Controller;

class GoodController extends AdminController {

	public function index($cate_id=null){

		$Good       = M('Good');
		$map		= array();
		if( $cate_id !== null ){
			$map['category_id'] = array('like', $cate_id.'%');
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