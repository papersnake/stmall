<?php
namespace Api\Controller;
use Think\Controller\RestController;

Class GoodController extends RestController {
	protected $allowMethod = array('get');
	protected $allowType   = array('json','html');

	public function read_json() {
		$id          = I('get.id','');
		$this->goodsinfo = M('Good')->field(true)->find($id);
		$this->response($this->goodsinfo,'JSON');
	}

	public function read_get_html(){
		$id          = I('get.id','');
		$this->goodsinfo = M('Good')->field(true)->find($id);
		$this->response($this->goodsinfo,'JSON');
	}

	public function barcode_get_html(){
		$barcode              = I('get.show','');
		$condition['barcode'] = $barcode; 
		$this->goodsinfo      = M('Good')->where($condition)->select();
		$this->response($this->goodsinfo,'JSON');
	}
}