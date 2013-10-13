<?php

namespace Admin\Controller;

class GoodController extends AdminController {

	public function index(){
		$Good       = M("Good")->field(true)->order('id DESC');
		$list       = $this->lists($Good);
		$menu       = D('GoodCategory')->getCategoryTree();
		$this->menu = $menu;
		$this->assign('_list',$list);
		$this->display();
	}

	public function json(){
		$menu = D('GoodCategory')->getCategoryTree();
		//echo json_encode($menu);
		$this->ajaxReturn($menu,'JSON');

	}
}