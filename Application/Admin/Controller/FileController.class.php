<?php

namespace Admin\Controller;

class FileController extends AdminController {

	public function uploadPicture() {
		if(IS_POST){
			$Picture = D('Picture');
			$goodid  = I('post.good_id');
			$info    = $Picture->upload($goodid,$_FILES,C('PICTURE_UPLOAD'));

			if(!$info){
				$return['error'] = $Picture->getError();
			}else{
				$return = $info['files'];
				$return['url'] = U($return['path'], '', false, true);
				$return['thumbnailUrl']=U($return['thumb'], '', false, true);
			}
			$files[]= $return;

			$this->ajaxReturn(array('files'=>$files));
		}
	}
}