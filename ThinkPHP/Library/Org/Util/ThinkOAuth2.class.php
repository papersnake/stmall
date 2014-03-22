<?php
namespace Org\Util;
//use Think\Log;

class ThinkOAuth2 extends OAuth2 {


	protected $_config = array(
		'OAUTH2_CODES'   => 'oauth_code',
		'OAUTH2_CLIENTS' => 'oauth_client',
		'OAUTH2_TOKEN'   => 'oauth_token',
		'display_error'  => TRUE
	);

	public function __construct() {
		parent::__construct($this->_config);
		$prefix                          = C('DB_PREFIX');
		$this->_config['OAUTH2_CODES']   = $prefix.$this->_config['OAUTH2_CODES'];
		$this->_config['OAUTH2_CLIENTS'] = $prefix.$this->_config['OAUTH2_CLIENTS'];
		$this->_config['OAUTH2_TOKEN']   = $prefix.$this->_config['OAUTH2_TOKEN'];
	}

	function __destruct() {
		//$this->db = NULL;
	}

	private function handleException($e) {
		echo "Database error:" . $e->getMessage();
		exit;
	}

	public function addClient($client_id,$client_secret,$redirect_uri) {
		$data['client_id']     = $client_id;
		$data['client_secret'] = $client_secret;
		$data['redirect_uri']  = $redirect_uri;
		$data['create_time']   = time();
		M()->table($this->_config['OAUTH2_CLIENTS'])->add($data);
	}

	protected function checkClientCredentials($client_id,$client_secret=NULL) {
		$result = M()
				->table($this->_config['OAUTH2_CLIENTS'])
				->where(array('client_id'=>$client_id))
				->field('client_secret')->select();
		return $result[0]["client_secret"] == $client_secret;
	}

	protected function getRedirectUri($client_id) {
		$result = M()
				->table($this->_config['OAUTH2_CLIENTS'])
				->where(array('client_id'=>$client_id))
				->field('redirect_uri')->select();

		if($result === FALSE)
		{
			return FALSE;
		}
		//Log::record(M()->_sql(),'SQL');
		return isset($result[$client_id]["redirect_uri"]) && $result[$client_id]["redirect_uri"] ? $result[$client_id]["redirect_uri"] : NULL;

	}

	protected function getAccessToken($access_token) {
		$result = M()
				->table($this->_config['OAUTH2_TOKEN'])
				->where(array('access_token'=>$access_token))
				->field('client_id,expires,scope')->select();
		//Log::record(M()->_sql(),'SQL');
		//dump($result);
		return $result !== FALSE ? $result[0] : NULL;
	}

	protected function setAccessToken($access_token,$client_id,$expires,$scope=NULL) {
		$data['access_token'] = $access_token;
		$data['client_id']    = $client_id;
		$data['expires']      = $expires;
		$data['scope']        = $scope;

        M()->table($this->_config['OAUTH2_TOKEN'])->add($data);
        //Log::record(M()->_sql(),'SQL');

	}

	protected function getSupportedGrantTypes() {
		return array(
				OAUTH2_GRANT_TYPE_AUTH_CODE
			);
	}

	protected function getAuthCode($code) {
		$result = $result = M()
				->table($this->_config['OAUTH2_CODES'])
				->where(array('code'=>$code))
				->field('code, client_id,redirect_uri, expires, scope')->select();
		//Log::record(M()->_sql(),'SQL');
		return $result !== FALSE ? $result[0] : NULL;
	}

	protected function setAuthCode($code, $client_id, $redirect_uri, $expires, $scope =NULL) {

		$data['code']     = $code;
		$data['client_id'] = $client_id;
		$data['redirect_uri']  = $redirect_uri;
		$data['expires'] = $expires;
		$data['scope'] = $scope;
		$result=M()->table($this->_config['OAUTH2_CODES'])->add($data);

		//Log::record(M()->_sql(),'SQL');
	}

	protected function checkUserCredentials($client_id, $username,$password){
		return TRUE;
	}
}