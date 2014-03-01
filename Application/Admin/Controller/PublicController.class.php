<?php
namespace Admin\Controller; 

class PublicController extends \Think\Controller {

	public function login($username = null, $password = null, $verify = null) {
		if(IS_POST){
			if(!check_verify($verify)) {
				$this->error('验证码错误!');
			}

			$User = D('User');
			$uid  = $User->login($username, $password);
			if( 0<$uid ){
				$this->success('登录成功!', U('Index/index'));
			} else {
				//$this->error($user->getError());
				switch($uid) {
					case -1:$error = '密码错误！';break;
					case -2:$error = '用户不存在或被禁用!';break;
					default:$error = '未知错误！';break;
				}
				$this->error($error);
				//$this->display();
			}
		}
		else
		{
			if(is_login()) {
				$this->redirect('Index/index');
			} else {
				$this->display();
			}
		}
	}

	/**
	 * [logout description]
	 * @return [type] [description]
	 */
	public function logout() {
		if(is_login()){
			D('User')->logout();
			session('[Destroy]');
			$this->success('退出成功!',U('login'));
		} else {
			$this->redirect('login');
		}
	}

	public function verify() {
		ob_clean();
		$verify = new \Think\Verify();
		$verify->entry(1);
	}
}