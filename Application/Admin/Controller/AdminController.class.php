<?php

namespace Admin\Controller;
use Think\Controller;

class AdminController extends Controller {


/**
 * [_initialize description]
 * @return [type] [description]
 */
	protected function _initialize() {
		define('UID',is_login());

		if( !UID ) {
			$this->redirect('Public/login');
		}
	}
}