<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class NewsCategoryModel extends DatatableManagerModel{

	public function getSource() {
		return "news_category";
	}
	
	public function columnMap() {
		return array(
			'id'        	=> 'id', 
			'parents'			=> 'parents',
			'title'      	=> 'title', 
			'code'        => 'code',
			'image'				=> 'image',
			'description'	=> 'description',
			'status'    	=> 'status', 
			'creator_id'  => 'creator_id',
			'editor_id'   => 'editor_id',
			'created'     => 'created',
			'updated'     => 'updated',
			'position'    => 'position'
		);
	}
	
	public function initialize(){		
	}
	
	private function getController() {
		return "news-category";
	}

	public function my_url($_format, $id = null){
		$Ohi = new \Modules\Library\Oh\Ohi();
		return $Ohi->baseAdminUrl($this->getController()."/index/{$_format}/{$id}");
	}
	
	/*public function beforeSave(){
		if(empty($this->id)){
			$this->created = date("Y-m-d H:i:s");
		}else {
			$this->updated = date("Y-m-d H:i:s");
		}
	}*/
	
	public function datatable_column(){
		$newsCategoryMenu = $this->findMenu();
		$init_data = array (
			array (
				'name'		=> 'nc@title',
				'label' 	=> 'Tiêu đề',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'		=> 'nc@parents',
				'width'		=> '120px',
				'label' 	=> 'Thuộc danh mục',
				'filter'	=> array(
					"type"  => "select",
					"value" => $newsCategoryMenu
				)
			),
			array (
				'name'		=> 'nc@status',
				'width'		=> '80px',
				'label' 	=> 'Hiển thị',
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
				'name'		=> 'nc@created',
				'width'		=> '100px',
				'label' 	=> 'Ngày tạo',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name' 		=> 'nc@id',
				'label'		=> '<a href="'.$this->my_url('add').'" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</a>',
				'width'		=> '100px'
			)
		);
		return $init_data;
	}

	public function datatable_json_data(){
		$result = $this->datatable_find([
			'select' 		=> ['nc.title','nc.parents','nc.status','m.username as creator', 'nc.created','nc.id'],
			'from' 			=> ['nc' => 'Modules\App\Models\NewsCategoryModel'],
			'innerJoin' => [
				'Modules\App\Models\MemberModel' => ['alias' => 'm','on' => 'nc.creator_id=m.id']
			],
			'group_by' => array('nc.id')
		]);

		$result->json_data = array();
		
		foreach($result->realData as $item){
			$action = array(
				'edit' 		=> array('href' => $this->my_url('update', $item->id)),
				'delete' 	=> array('href' => $this->my_url('delete', $item->id))
			);

			$parent_name = "";
			if($item->parents > 0){
				$parent_model = $this->findFirstById($item->parents);
				if($parent_model && !empty($parent_model)){
					$parent_name = $parent_model->title;
				}
			}
			
			$result->json_data[] = array(
				'nc@title' 		=> $item->title,
				'nc@parents' 	=> $parent_name,
				'nc@status'   => $this->changeValue('status', $item->id, $item->status, $this->getController()),
				'creator' 		=> $item->creator,
				'nc@created' 	=> $item->created,
				'nc@id'				=> $this->renderHtmlButton($action)
			);
		}
		return $result;
	}

	public function findMenu(){
		$object = $this->find(array(
			'condition' => 'status = 1'
		));
		$this->data = array();
		if($object != null && count($object) > 0){
			$array = array();
			foreach ($object as $key => $value) {
				$this->data[] = $value;
			}
		}
		$this->recursive();
		return $this->getListTreeCategorySearch();
	}

	private $data = [];
	private $result = [];
	public function recursive($parents = 0, $level = 1){
		if(count($this->data) > 0){
			foreach($this->data as $key => $value){
				if($value->parents == $parents){
					$value->level = $level;
					$this->result[] = $value;
					$newParents = $value->id;
					unset($this->data[$key]);
					$this->recursive($newParents, $level + 1);	
				}
			}
		}
	}

	// Sử dụng cho lọc tìm kiếm ở datatable
	public function getListTreeCategorySearch(){
		$record = array('0' => '--- Chọn danh mục ---');
		if(is_array($this->result) && count($this->result) > 0){
			foreach ($this->result as $key => $value) {
				$space = "";
				if($value->level > 1){
					for ($i=1; $i <= $value->level; $i++) { 
						$space .= "&nbsp;&nbsp;";
					}
					$record[$value->id] = $space."- ".$value->title;
				} else {
					$record[$value->id] = $value->title;
				}
			}
		}
		return $record;
	}

	public function detail($code){
		return $this->findFirstByCode($code);
	}
}