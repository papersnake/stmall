<?php
/**
 * public function
 */

const STMALL_VERSION    ='0.1.131006';
const STMALL_ADDON_PATH ='./Addons/';


/**
 * [is_login description]
 * @return boolean
 */
function is_login(){
	$user = session('user_auth');
	if(empty($user)) {
		return 0;
	} else {
		return session('user_auth_sign') == data_auth_sign($user) ? $user['id'] : 0;
	}
}

/**
 * 数据签名认证
 * @param  array $data 	被认证数据
 * @return string 		签名
 */
function data_auth_sign($data) {
	if(!is_array($data)) {
		$data = (array)$data;
	}

	ksort($data);
	$code = http_build_query($data);
	$sign = sha1($code);
	return $sign;
}

function password_md5($str, $key='stmallpasswordmd5') {
	return '' === $str ? '' : md5(sha1($str).$key);
}