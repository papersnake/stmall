<?php
namespace Api\Controller;
use Think\Controller\RestController;
use Org\Util\ThinkOAuth2;

Class GoodController extends RestController {
	protected $allowMethod = array('get');
	protected $allowType   = array('json','html');

	protected $oauth = NULL;

	function _initialize() {
		$this->oauth=new ThinkOAuth2();
	}

	public function read_json() {
		$id          = I('get.id','');
		$this->goodsinfo = M('Good')->field(true)->find($id);
		$this->response($this->goodsinfo,'JSON');
	}

	public function read_get_html() {
		$id          = I('get.id','');
		$this->goodsinfo = M('Good')->field(true)->find($id);
		$this->response($this->goodsinfo,'JSON');
	}

	public function barcode_get_html() {
		$barcode              = I('get.show','');
		$condition['barcode'] = $barcode; 
		$this->goodsinfo      = M('Good')->where($condition)->select();
		$this->response($this->goodsinfo[0],'JSON');
	}

	public function search_get_html() {
		if($this->oauth->verifyAccessToken()){
			$key             = I('get.key','');
			$map['_string']  = "CONCAT(good_name,good_id,barcode,good_spec) like '%".$key."%'";
			$this->goodsinfo = M('Good')->where($map)->select();
			$this->response($this->goodsinfo,'JSON');
		} else {
			$this->response('{error:110}','JSON');

		}
		//header('application/json; charset=utf-8');
		//echo json_encode($this->goodsinfo);
		//$barcode              = I('get.keys','');
		//$condition['barcode'] = $barcode; 
		//$this->goodsinfo      = M('Good')->where($condition)->select();
		//$this->response($this->goodsinfo,'JSON');
	}
}