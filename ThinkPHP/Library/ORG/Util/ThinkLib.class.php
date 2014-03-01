<?php
namespace Org\Util;

class ThinkLib extends OAuth2 {

	private $db;
	private $table;

	public function __construct() {
		parent::__construct();
		$this->db    = \Think\Db::getInstance(C('OAUTH2_DB_DSN'));
		$this->table = array(
			'auth_codes' =>C('OAUTH2_CODES_TABLE'),
			'auth_codes' =>C('OAUTH2_CLIENTS_'),
			'auth_codes' =>C('OAUTH2_TOKEN_TABLE')
			);
	}

	function __destruct() {
		$this->db = NULL;
	}

	public function LibTest(){
		echo "hello Lib";
	}

	private function handleException($e) {
		echo "Database error:" . $e->getMessage();
		exit;
	}

	protected function checkClientCredentials($client_id,$client_secret=NULL) {
		$sql = "SELECT client_secret FROM {$this->talbe['client']} " . "WHERE client_id = \"{$client_id}\"";
		$result = $this->db->query($sql);
		if($client_secret === NULL) {
			return $result !== FALSE;
		}

		return $result[0]["client_secret"] == $client_secret;
	}

	protected function getAccessToken($access_token) {
		$sql = "SELECT client_id,expires,scope FROM {$this->table['tokens']} " . "WHERE access_token = \"{$access_token}\"";
		$result = $this->db->query($sql);

		return $result !== FALSE ? $result : NULL;
	}

	protected function setAccessToken($access_token,$client_id,$expires,$scope=NULL) {
		$sql = "INSERT INTO {$this -> table['tokens']} ".  
            "(access_token, client_id, expires, scope) ".  
            "VALUES (\"{$access_token}\", \"{$client_id}\", \"{$expires}\", \"{$scope}\")";  
        $this->db->execute($sql);
        
	}

	protected function getRedirectUri($client_id) {
		$sql = "SELECT redirect_uri FROM {$this->table['clients']}" . "WHERE client_id = \"{$client_id}\"";
		$result = $this->db->query($sql);
		
		if($result === FALSE)
		{
			return FALSE;
		}

		return isset($result[0]["redirect_uri"]) && $result[0]["redirect_uri"] ? $result[0]["redirect_uri"] : NULL;

	}

	protected function getSupportGrantTypes() {
		return array(
				OAUTH2_GRANT_TYPE_AUTH_CODE
			);
	}

	protected function getAuthCode($code) {
		$sql = "SELECT code, client_id,redirect_uri, expires, scope " . "FROM {$this->table['auth_codes']} WHERE code = \"{$code}\"";
		$result = $this->db->query($sql);

		return $result !== FALSE ? $result[0] : NULL;
	}

	protected function setAuthCode($code, $client_id, $redirect_uri, $expires, $scope =NULL) {
		$time = time();
		$sql = "INSERT INTO {$this->table['auth_codes']} ". 
				"(code,client_id,redirect_uri,expires,scope) ".
				"VALUES (\"{$code}\", \"{$client_id}\", \"{$redirect_uri}\", \"{$expires}\", \"{$scope}\")";

		$result = $this->db->execute($sql);
	}

	protected function checkUserCredentials($client_id, $username,$password){
		return TRUE;
	}
}