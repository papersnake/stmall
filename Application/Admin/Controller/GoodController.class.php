<?php

namespace Admin\Controller;

class GoodController extends AdminController {

	public function index($cate_id=null, $query=null){
		$this->title = '产品管理';
		$Good        = M('Good');
		$map         = array();
		if( $cate_id !== null ){
			$map['category_id'] = array('like', $cate_id.'%');
		}

		if( isset($query) )
		{
			unset($map['category_id']);
			//$query = iconv("gb2312","utf-8",$query);
			$map['_string'] = "CONCAT(good_name,good_id,barcode,good_spec) like '%".$query."%'";
		}
		$list       = $this->lists($Good,$map,'id DESC');
		//$menu       = D('GoodCategory')->getCategoryTree();
		//$this->menu = $menu;
		$this->assign('_list',$list);
		$this->display();
	}

	public function info()
	{
		$this->title = '商品信息';
		$id          = I('get.id','');
		if(empty($id)){
			$this->error('商品ID不能为空');
		}else{
			$this->goodsinfo = M('Good')->field(true)->find($id);
		}
		$this->display();
	}

	public function upload(){
		
	}
	
}