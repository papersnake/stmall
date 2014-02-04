<?php

namespace Admin\Controller;

class FileController extends AdminController {

	public function uploadPicture() {
		if(IS_POST){
			$Picture = D('Picture');
			$goodid  = I('post.good_id');
			$info    = $Picture->upload($goodid,$_FILES,C('PICTURE_UPLOAD'));

			//dump($info);
			if(!$info){
				//$this->error($Picture->getError());
				$return['error'] = $Picture->getError();
			}else{
				$return = $info['files'];
				$return['url'] = 'http://www.test.com'.$return['path'];
				$return['thumbnailUrl'] = 'http://www.test.com'.$return['thumb'];
			}
			$files[]= $return;

			$this->ajaxReturn(array('files'=>$files));
		}
	}
}