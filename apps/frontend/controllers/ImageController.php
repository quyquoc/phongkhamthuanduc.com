<?php
namespace Modules\Frontend\Controllers;
use Phalcon\Mvc\Controller;
use Modules\App\Models\ImageGroupModel;
use Modules\App\Models\ImageAlbumModel;
use Modules\App\Models\ImageModel;

class ImageController extends ControllerBase {
	
	protected function onConstruct(){
		parent::onConstruct();
	}

	public function indexAction($group_code = null, $album_code = null, $code = null){

		// Gallery
		$gallery 		= ImageModel::find(array(
			"conditions"	=> "album_id = :album_id: AND status = 1",
			"bind" 			=> array("album_id" => '2'),
			"order"			=> "position ASC, created DESC",
			"limit" 		=> 12
		));
		$this->view->gallery 	= $gallery;
		$this->view->menu 		= 'thu-vien';

		$this->assets->addCss('/library/DirectionAwareHoverEffect/css/style.css');
		$this->assets->addJs('/library/DirectionAwareHoverEffect/js/jquery.hoverdir.js')
								 ->addJs('/library/DirectionAwareHoverEffect/js/modernizr.custom.97074.js');
	}

	public function add_imageAction(){

		$this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

		if ($this->request->isAjax()) {

			$offset				= $this->request->get('num_items');
			$offset 			= (isset($offset) && $offset != "0") ? $offset : 0;
			$limit 				= (isset($limit) && $limit != "0") ? $limit : 6;

			$conditions 	= "album_id = 2 AND status = 1 and created <= '".date('Y-m-d H:i:s')."' ";
			$list 			= ImageModel::find(array(
				'conditions'	=> $conditions,
				'limit'			=> $limit,
				'offset'		=> $offset,
				'order'			=> 'created DESC'
			));
			
			$this->view->list = $list;
		}
	}
}

/* End of file ImageController.php */
/* Location: ./apps/frontend/controllers/ImageController.php */
