<?php

namespace Admin\Model;
use Think\Model;
use COM\Upload;
use ORG\Util;
use Think\Image;
use Think\Image\Driver\ImageGd;

class PictureModel extends Model{
	protected $_auto = array(
			array('status', 1, self::MODEL_INSERT),
			array('create_time', NOW_TIME, self::MODEL_INSERT),
	);

	public function isFile($file){
		if(empty($file['md5'])){
			throw new \Exception('缺少参数：md5');
		}

		$map = array('md5' => $file['md5']);
		return $this->field(true)->where($map)->find();
	}

	public function upload($goodid = null, $files, $setting, $driver = 'Local', $config = null){

		if(!$goodid){
			$this->error = '商品ID不能为空!';
		}

		$setting['callback'] = array($this,'isFile');
		$Upload              = new Upload($setting,$driver,$config);
		$Upload->savePath    = '/'.$goodid.'/';
		$info                = $Upload->upload($files);
		if($info){
			foreach ($info as $key => &$value) {
				if(isset($value['id']) && is_numeric($value['id'])){
					contiune;
				}

				$value['good_id'] = $goodid;
				$value['path']    = substr($setting['rootPath'],1).$value['savepath'].$value['savename'];
				$value['thumb']   = substr($setting['rootPath'],1).'/thumb/'.'thumb_'.$value['savename'];
				$Image = new Image();
				$Image->open('.'.$value['path']);
				$Image->thumb(150,150)->save('.'.$value['thumb']);
				//$Image.thumb($value['path'],$thumbname);
				//\ORG\Util\Image::thumb($value['path'],$thumbname);
				if($this->create($value) && ($id = $this->add()))
				{
					$value['id'] = $id;
				} else {
					unset($info[$key]);
				}
			}
			return $info;
		} else {
			$this->error = $Upload->getError();
			return false;
		}
	}
}