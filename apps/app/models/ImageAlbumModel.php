<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Phalcon\Mvc\Model\Manager as ModelsManager;

class ImageAlbumModel extends DatatableManagerModel{

	public function getSource() {
		return "image_album";
	}

	public function columnMap() {
    return array(
      'id'            =>  'id', 
      'title'         =>  'title', 
      'code'          =>  'code',
      'image'         =>  'image', 
      'imgs'          =>  'imgs', 
      'featured'      =>  'featured', 
      'creator_id'    =>  'creator_id', 
      'editor_id'     =>  'editor_id', 
      'attr_image'    =>  'attr_image', 
      'content'       =>  'content',
      'group_id'      =>  'group_id',
      'status'        =>  'status',
      'position'      =>  'position',
      'created'       =>  'created',
      'updated'       =>  'updated'
    );
  }

  public function initialize(){
  	$this->belongsTo('group_id', '\Modules\App\Models\ImageGroupModel', 'id', ['alias' => 'image_group']);
  }

	private function getController() {
		return "image-album";
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
				'name'  	=> 'ab@title',
				'label' 	=> 'Album',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'  	=> 'group_title',
				'label' 	=> 'Chủ đề',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),	
			array (
				'name'		=> 'ab@featured',
				'label' 	=> 'Nổi bật',
				'width'		=> '80px',
				'filter'	=> array(
					'type' 	=> 'select',
					'value' => array(0=>'Không',1=>'Có')
				)
			),	
			array (
				'name' 		=> 'ab@status',
				'label' 	=> 'Hiển thị',
				'width' 	=> '80px',
				'filter'	=> array(
					'type' 	=> 'select',
					'value' => array(0=>'Không',1=>'Có')
				)
			),
			array (
				'name'		=> 'creator',
				'label' 	=> 'Người tạo',
				'width'		=> '80px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name' 		=> 'ab@created',
				'label' 	=> 'Ngày tạo',
				'width' 	=> '100px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'  	=> 'ab@id',
				'label' 	=> '<a href="'.$this->my_url('add').'" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</a>',
				'width' 	=> '100px'
			)
		);
		return $init_data;
	}
	
  public function datatable_json_data(){
		$result = $this->datatable_find([
			'select' 		=> ['ab.title', 'ig.title AS group_title', 'ab.featured',  'ab.status', 'm.username AS creator', 'ab.created', 'ab.id'],
			'from' 			=> ['ab' => 'Modules\App\Models\ImageAlbumModel'],
			'innerJoin' => [				
				'Modules\App\Models\ImageGroupModel' 	=> ['alias' => 'ig','on' => 'ab.group_id=ig.id'],
				'Modules\App\Models\MemberModel' 			=> ['alias' => 'm','on' => 'ab.creator_id=m.id']
			],
			'group_by' 	=> array('ab.id')
		]);

		$result->json_data = array();
		
		foreach($result->realData as $item){
			$action = array(
				'edit' 		=> array('href' => $this->my_url('update', $item->id)),
				'delete' 	=> array('href' => $this->my_url('delete', $item->id))
			);
			$result->json_data[] = array(
				'ab@title' 			=> $item->title,
				'group_title' 	=> $item->group_title,
				'ab@featured'   => $this->changeValue('featured', $item->id, $item->featured, $this->getController()),
				'ab@status'     => $this->changeValue('status', $item->id, $item->status, $this->getController()),
				'creator'  			=> $item->creator,
				'ab@created'  	=> $item->created,
				'ab@id'     		=> $this->renderHtmlButton($action)
			);
		}
		return $result;
	}
}