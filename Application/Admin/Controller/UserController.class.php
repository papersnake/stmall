<?php

namespace Admin\Controller;

class UserController extends AdminController {

	public function index() {
		$this->title = '用户管理';

		$User = D('User');

		$list = $User->select();

		dump($list);

		$this->assign('_list',$list);

		$this->display();
	} 
}