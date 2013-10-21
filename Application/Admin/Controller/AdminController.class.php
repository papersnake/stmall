<?php

namespace Admin\Controller;
use Think\Controller;

class AdminController extends Controller {


/**
 * [_initialize description]
 * @return [type] [description]
 */
	protected function _initialize() {
		define('UID',is_login());

		if( !UID ) {
			$this->redirect('Public/login');
		}

		$this->assign('__controller__',$this);
	}

	protected function lists($model,$where=array(),$order='',$base=array('status'=>array('egt',0)),$field=true){
		$options = array();                                          
		$REQUEST = (array)I('request.');                
		//dump($where);
		//dump($order);
		//dump($base);
		//dump($REQUEST);
		if(is_string($model)){
			$model = M($model);
		}

		$OPT = new \ReflectionProperty($model,'options');
		$OPT->setAccessible(true);

		//dump($OPT);

		$pk = $model->getPk();

		if($order===null){

		}else if( isset($REQUEST['_order']) && isset($REQUEST['_field']) && in_array(strtolower($REQUEST['_order']),array('desc','asc')) ){
			$options['order'] = '`'.$REQUEST['_field'].'` '.$REQUEST['_order'];
		}elseif( $order==='' && empty($options['order']) && !empty($pk) ){
			$options['order'] = $pk.' desc';
		}elseif($order){
			$options['order'] = $order;
		}
		unset($REQUEST['_order'],$REQUEST['_field']);

		$options['where'] = array_filter(array_merge( (array)$base, $REQUEST, (array)$where ),function($val){
			if($val===''||$val===null){
				return false;
			}else{
				return true;
			}
		});
		//dump($options);
		if( empty($options['where'] )){
			unset($options['where']);
		}

		$options	=	array_merge( (array)$OPT->getValue($model),$options);
		$total		=	$model->where($options['where'])->count();
		//dump($options);
		if( isset($REQUEST['r']) ){
			$listRows = (int)$REQUEST['r'];
		}else{
			$listRows = C('LIST_ROWS') > 0 ? C('LIST_ROWS') :10;
		}
		$page = new \COM\Page($total, $listRows, $REQUEST);
		//dump($page);
		if($total>$listRows){
			$page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
			$page->setConfig('header','<li class="active"><a href="#">共 %TOTAL_ROW% 条记录</a></li>');
		}

		$p = $page->show();
		$this->assign('_page',$p? $p: '');
		$this->assign('_total',$total);
		$options['limit'] = $page->firstRow.','.$page->listRows;

		$model->setProperty('options',$options);
		
		return $model->field($field)->select();

	}

	public function tableList( $list, $thead ){
        $list = (array)$list;
        if(APP_DEBUG){
            //debug模式检测数据
            $List  = new \RecursiveArrayIterator($list);
            $RList = new \RecursiveIteratorIterator($List,\RecursiveIteratorIterator::CHILD_FIRST);
            foreach($RList as $v){
                if($RList->getDepth()==2){
                    //数据集不是二维数组
                    die('<h1>'.'严重问题：表格列表数据集参数不是二维数组'.'</h1>');
                    break;
                }
            }

            $keys   =   array_keys( (array)reset($list) );
            foreach($list as $row){
                $keys = array_intersect( $keys, array_keys($row) );
            }
            $s_thead =  serialize($thead);
            if(!empty($list)){
                preg_replace_callback('/\$([a-zA-Z_]+)/',function($matches) use($keys){
                    if( !in_array($matches[1],$keys) ){
                        die('<h1>'.'严重问题：数据列表表头定义使用了数据集中不存在的字段:$'.$matches[1].', 请检查表头和数据集.</h1>');
                    }
                },$s_thead);
            }
        }
        $keys       =   array_keys($thead);//表头所有的key
        array_walk($list,function(&$v,$k) use($keys,$thead) {
            $arr    =   array();//保存数据集字段的值
            foreach ($keys as $value){
                //判断表头key是否在数据集中存在对应字段
                if ( isset($v[$value]) ) {
                    $arr[$value] = $v[$value];
                }elseif( strpos($value,'_')===0 ){
                    $arr[$value] = @$thead[$value]['td'];
                }elseif( isset($thead[$value]['_title']) ){
                    $arr[$value] = '';
                }
            }
            $v      =   array_merge($arr,$v);//根据$arr的顺序更新数据集字段顺序
        });
        $this->assign('_thead',$thead);
        $this->assign('_list',$list);
        $this->assign('_table_class','table table-striped table-bordered table-hover table-full-width dataTable');
        return $this->fetch('Public:_list');
    }
}