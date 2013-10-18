<?php

namespace Admin\Controller;

class CategoryController extends AdminController {

	public function index(){
		$this->display();
	}

	public function json(){
		$menu = D('GoodCategory')->getCategoryTree();
		//echo json_encode($menu);
		$this->ajaxReturn($menu,'JSON');

	}
}