<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Phalcon\Mvc\Model\Manager as ModelsManager;

class ImageGroupModel extends DatatableManagerModel {

	public function getSource() {
		return "image_group";
	}

	public function columnMap() {
    return array(
      'id'            => 'id', 
      'title'         => 'title', 
      'code'          => 'code',
      'image'         => 'image', 
      'content'       => 'content', 
      'featured'      => 'featured',
      'status'        => 'status',
      'creator_id'    => 'creator_id',
      'editor_id'     => 'editor_id',
      'created'       => 'created',
      'updated'       => 'updated',
      'position'      => 'position'
    );
  }
    
  public function initialize() {}

	private function getController() {
		return "image-group";
	}

	public function my_url($_format, $id = null){
		$Ohi = new \Modules\Library\Oh\Ohi();
		return $Ohi->baseAdminUrl($this->getController()."/index/{$_format}/{$id}");
	}

	/*public function beforeSave() {
		if(!isset($this->id) || !($this->id >0)){
			$this->created = date("Y-m-d H:i:s");
		}
	}*/

	public function datatable_column(){
		$init_data = array (
			array (
				'name'  	=> 'ig@title',
				'label' 	=> 'Chủ đề ảnh',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),	
			array (
				'name'		=> 'ig@featured',
				'label' 	=> 'Nổi bật',
				'width'		=> '80px',
				'filter'	=> array(
					'type' 	=> 'select',
					'value' => array(0=>'Không',1=>'Có')
				)
			),	
			array (
				'name'		=> 'ig@status',
				'label' 	=> 'Hiển thị',
				'width'		=> '80px',
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
				'name'		=> 'ig@created',
				'label' 	=> 'Ngày tạo',
				'width'		=> '100px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'  	=> 'ig@id',
				'label' 	=> '<a href="'.$this->my_url('add').'" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</a>',
				'width' 	=> '100px'
			)
		);
		return $init_data;
	}
	
  public function datatable_json_data() {
		$result = $this->datatable_find([
			'select' 		=> ['ig.title', 'ig.featured',  'ig.status', 'm.username AS creator', 'ig.created', 'ig.id'],
			'from' 			=> ['ig' => 'Modules\App\Models\ImageGroupModel'],
			'innerJoin' => [
				'Modules\App\Models\MemberModel' => ['alias' => 'm','on' => 'ig.creator_id=m.id']
			],
			'group_by' 	=> array('ig.id')
		]);

		$result->json_data = array();
		
		foreach($result->realData as $item){
			$action = array(
				'edit' 		=> array('href' => $this->my_url('update', $item->id)),
				'delete' 	=> array('href' => $this->my_url('delete', $item->id))
			);
			$result->json_data[] = array(
				'ig@title'  	=> $item->title,
				'ig@featured' => $this->changeValue('featured', $item->id, $item->featured, $this->getController()),
				'ig@status'   => $this->changeValue('status', $item->id, $item->status, $this->getController()),
				'ig@created'  => $item->created,
				'creator'  		=> $item->creator,
				'ig@id'     	=> $this->renderHtmlButton($action)
			);
		}
		return $result;
	}
}