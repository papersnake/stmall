<?php

namespace Admin\Model;
use Think\Model;
use ORG\Util\Debug;

class UserModel extends Model {

	public function login($username, $password){
		$map             =	array();
		$map['username'] = $username;
		$user            = $this->where($map)->find();
		
		trace('pass_md5',$pass_md5);
		if(is_array($user) && $user['status'] == 1) {
			if(password_md5($password,C('DATA_AUTH_KEY')) === $user['password']) {
				$this->autologin($user);
				return $user['id']; //成功登录
			} else {
				return -1; //密码错误
			}
		} else { 
			return -2; //用户名不存在或帐号被禁用
		}
	}

	public function logout(){
		session('user_auth', null);
		session('user_auth_sign', null);
	}

/**
 * 登录成功记录
 * @param  [type] $user [description]
 * @return [type]       [description]
 */
	private function autologin($user) {

		$data = array(
				'id'              => $user['id'],
				'last_login_time' => NOW_TIME,
				'last_login_ip'   => get_client_ip(1),
			);
		$this->save($data);

		$auth = array(
				'id'              =>$user['id'],
				'username'        =>$user['username'],
				'last_login_time' => $user['last_login_time'],
			);

		session('user_auth', $auth);
		session('user_auth_sign',data_auth_sign($auth));
	}

}