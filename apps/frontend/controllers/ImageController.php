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

	public function indexAction(){
		// Gallery
		$album = ImageAlbumModel::findFirstByCode('gallery');
		$this->view->gallery = ImageModel::find(array(
			"conditions" => "status = 1 and album_id = {$album->id}",
		 	"order" => "created DESC",
			"limit" => 12));
			
		$gallery_count = ImageModel::find(array(
			"conditions" => "status = 1 and album_id = {$album->id}",
		 	"order" => "created DESC"
		));
		$this->view->gallery_count = $gallery_count->count();
	}


	public function addImageAction(){

		$this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

		if ($this->request->isAjax()) {

			$offset				= $this->request->get('offset');
			$offset				= $this->request->get('limit');
			$offset 			= (isset($offset) && $offset != "0") ? $offset : 0;
			$limit 				= (isset($limit) && $limit != "0") ? $limit : 12;

			$conditions 	= "status = 1";
			$list 			= ImageModel::find(array(
				'conditions'	=> $conditions,
				'limit'			=> $limit,
				'offset'		=> $offset,
				'order'			=> 'created DESC'
			));
			
			$this->view->gallery = $list;
		}
	}
}

/* End of file ImageController.php */
/* Location: ./apps/frontend/controllers/ImageController.php */
