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
			$auth_params = $this->oauth->getAuthorizeParams();
			//echo $auth_params;
			//dump($auth_params);
			//$this->assign('params',$auth_params);
			$obj=serialize($auth_params);
			dump($obj);
			session('auth_params',$obj);
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