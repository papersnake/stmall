<?php

namespace Admin\Controller;

class GoodController extends AdminController {

	public function index(){
		$Good = M("Good")->field(true)->order('id DESC');
		$list = $this->lists($Good);
		$this->assign('_list',$list);
		$this->display();
	}
}