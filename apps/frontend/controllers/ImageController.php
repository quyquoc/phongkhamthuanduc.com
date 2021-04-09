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
		$this->view->menu 	= 'thu-vien';
		$album = ImageAlbumModel::findFirstByCode('gallery');
		$this->view->gallery = ImageModel::find(array(
			"conditions" => "status = 1 and album_id = {$album->id}",
		 	"order" => "created DESC",
			"limit" => 12));
			
		$gallery_count = ImageModel::find(array(
			"conditions" => "status = 1 and album_id = {$album->id}",
		 	"order" => "created DESC"
		));
		$this->view->album = $album;
		$this->view->gallery_count = $gallery_count->count();
	}


	public function addImageAction(){

		$this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

		if ($this->request->isAjax()) {

			$album_id 	= !empty($this->request->get('album_id')) ? $this->request->get('album_id') : '';
			$limit			= !empty($this->request->get('limit')) ? $this->request->get('limit') : 6;
			$offset			= !empty($this->request->get('offset')) ? $this->request->get('offset') : 0;

			$conditions 	= "status = 1 and album_id = $album_id ";
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
