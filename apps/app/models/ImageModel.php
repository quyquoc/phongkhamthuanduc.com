<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Phalcon\Mvc\Model\Manager as ModelsManager;

class ImageModel extends DatatableManagerModel {

	public function getSource() {
		return "image";
	}

	public function columnMap() {
    return array(
      'id'            =>  'id', 
      'title'         =>  'title', 
      'code'          =>  'code',
      'image'         =>  'image', 
      'imgs'          =>  'imgs', 
      'content'       =>  'content',
      'album_id'      =>  'album_id',
      'link'          =>  'link', 
      'url_target'    =>  'url_target', 
      'featured'      =>  'featured',
      'status'        =>  'status',
      'hits'          =>  'hits',
      'created'       =>  'created',
      'creator_id'    =>  'creator_id',
      'updated'       =>  'updated',
      'editor_id'     =>  'editor_id',
      'position'      =>  'position'
    );
  }

  public function initialize(){}

	private function getController() {
		return "image";
	}

	public function my_url($_format, $id = null){
		$Ohi = new \Modules\Library\Oh\Ohi();
		return $Ohi->baseAdminUrl($this->getController()."/index/{$_format}/{$id}");
	}

  /*public function beforeSave(){
		if(!isset($this->id) || !($this->id >0)){
			$this->created = date("Y-m-d H:i:s");
		}
  }*/

	public function datatable_column(){
		$init_data = array (
			array (
				'name'  	=> 'i@title',
				'label' 	=> 'Tiêu đề ảnh',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name' 		=> 'i@image',
				'label' 	=> 'Hình ảnh',
				'width' 	=> '100px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name' 		=> 'album_title',
				'label' 	=> 'Album',
				'width' 	=> '100px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),	
			array (
				'name'		=> 'i@featured',
				'label' 	=> 'Nổi bật',
				'width'		=> '50px',
				'filter'	=> array(
					'type' 	=> 'select',
					'value' => array(0=>'Không',1=>'Có')
				)
			),	
			array (
				'name' 		=> 'i@status',
				'label' 	=> 'Hiển thị',
				'width' 	=> '50px',
				'filter'	=> array(
					'type' 	=> 'select',
					'value' => array(0=>'Không',1=>'Có')
				)
			),
			array (
				'name' 		=> 'i@created',
				'label' 	=> 'Ngày tạo',
				'width' 	=> '105px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'  	=> 'i@id',
				'label' 	=> '<a href="'.$this->my_url('add').'" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</a>',
				'width' 	=> '80px'	
			)
		);
		return $init_data;
	}
	
  public function datatable_json_data(){
		$result = $this->datatable_find([
			'select' 		=> ['i.title', 'i.image','ab.title AS album_title', 'i.featured',  'i.status', 'i.created','i.id'],
			'from' 			=> ['i' => 'Modules\App\Models\ImageModel'],
			'innerJoin' => [
				'Modules\App\Models\ImageAlbumModel' 	=> ['alias' => 'ab','on' => 'i.album_id=ab.id']
			],
			'group_by' 	=> array('i.id')
		]);

		$result->json_data = array();
		
		foreach($result->realData as $item){
			$action = array(
				'edit' 		=> array('href' => $this->my_url('update', $item->id)),
				'delete' 	=> array('href' => $this->my_url('delete', $item->id))
			);
			$result->json_data[] = array(
				'i@title'  		=> $item->title,
				'i@image'  		=> '<div style="display:flex;align-items:center;justify-content:center"><img src="'.ROOT_URL.$item->image.'" style="max-width:150px;"/></div>',
				'album_title' => $item->album_title,
				'i@featured'  => $this->changeValue('featured', $item->id, $item->featured, $this->getController()),
				'i@status'    => $this->changeValue('status', $item->id, $item->status, $this->getController()),
				'i@created' 	=> $item->created,
				'i@id'     		=> $this->renderHtmlButton($action)
			);
		}
		return $result;
	}
}