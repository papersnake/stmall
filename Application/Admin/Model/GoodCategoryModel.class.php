<?php

namespace Admin\Model;
use Think\Model;

class GoodCategoryModel extends Model {

	protected $treeList = array();
	protected $level    = 0;

	public function getCategoryTree(){
		$tmparr = array();
		$items = $this->field(true)->select();
		foreach($items as $item){
			$tmparr[strlen($item['category_id'])][$item['category_id']]=$item;
		}

		$this->treeList = $tmparr;
		$root               = new CategoryNodeModel();
		$root->depth        = 0;
		$root->categoryId   = 'root';
		$root->categoryName = 'root';
		$this->makeTree($root);
		return $root;
	}

	public function makeTree($node){
		$childsArray = array();
		$tmp         = array();
		if(isset($this->treeList[($node->depth+1)*2])){
			$tmp         =  $this->treeList[($node->depth+1)*2];
		}
		if($node->depth === 0){
			$childsArray = $tmp;
		}else{
			if(is_array($tmp)){
				foreach ($tmp as $key => $item) {
					$fartherId = $node->categoryId;
					if(substr_compare($key, $fartherId, 0, strlen($fartherId)) === 0)
					{
						$childsArray[] = $item;
					}
				}
			}
		}

		$count       = count($childsArray);
		if($count > 0 ){
			$node->hasChild = true;
			foreach($childsArray as $item){
				$childNode                          = new CategoryNodeModel();
				$childNode->depth                   = $node->depth+1;
				$childNode->categoryId              = $item['category_id'];
				$childNode->categoryName            = $item['name'];
				$node->childs[$item['category_id']] = $childNode;
				$this->makeTree($childNode);
			}
		}

	}
}