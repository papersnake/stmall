<?php
namespace Api\Controller;
use Think\Controller;
use Org\Util\ThinkOAuth2;

class OauthController extends Controller {

	private $oauth = NULL;

	function _initialize() {
		//header("Content-type:application/json");
		//header('Cache-Contorl: no-store');

		$this->oauth = new ThinkOAuth2();
	}

	public function index() {
		header("Content-type:application/json; charset=utf-8");
		$this->ajaxReturn(null,'oauth_server_start',1,'JSON');
		//$this->oauth->LibTest();
	}

	public function test_json() {
		header("Content-type:application/json; charset=utf-8");
		$arr=array('a'=>1,'b'=>'pingbo');
		echo(json_encode($arr));
		exit;
	}

	public function access_token() {
		$this->oauth->grantAccessToken();
		exit;
	}

	public function login($username = null, $password = null) {
		if(IS_POST){
			//if(!check_verify($verify)) {
			//	$this->error('验证码错误!');
			//}

			$User = D('User');
			$uid  = $User->login($username, $password);
			if( 0<$uid ){
				$this->success('登录成功!', U('authorize'));
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
				$this->redirect('authorize');
			} else {
				$this->display();
			}
		}
	}

	public function logout() {
		if(is_login()){
			D('User')->logout();
			session('[Destroy]');
			$this->success('退出成功!',U('login'));
		} else {
			$this->redirect('login');
		}
	}

	public function authorize() {
		if(IS_POST){
			header("Content-type:application/json");
			header('Cache-Contorl: no-store');
			$authsession=session('auth_params');
			if(!isset($authsession)){
				$this->error('Missing auth parameters');
			}
			//dump($authsession);
			$params=unserialize($authsession);
			//dump($params);
			$post=I('post.approve');
			if(isset($post)) {
				$this->oauth->finishClientAuthorization(TRUE,$params);
				return;
			}
			//$this->display();

		}else{
			if(session('auth_params') === NULL){
				$auth_params = $this->oauth->getAuthorizeParams();
				//echo $auth_params;
				//dump($auth_params);
				//$this->assign('params',$auth_params);
				$obj=serialize($auth_params);
				//dump($obj);
				session('auth_params',$obj);
			}
			if(!is_login())
			{
				$this->redirect('login');
			}
			$this->display();
		}
	}

	public function addclient($client_id=null, $client_secret=null, $redirect_uri=null) {

		if(IS_POST)
		{
			header("Content-type:text/html,application/xhtml+xml,*/*");

			$this->oauth->addClient($client_id, $client_secret, $redirect_uri);
			//$this->success($client_id . '|' . $client_secret . '|' . $redirect_uri);
		}
		$this->display();
		
	}
}