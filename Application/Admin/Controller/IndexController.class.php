<?php

namespace Admin\Controller;


class IndexController extends AdminController {


/**
 * [index description]
 * @return [type] [description]
 */
	public function index() {
		if(UID){
			$this->display();
		} else {
			$this->redirect('Public/login');
		}
	}
}