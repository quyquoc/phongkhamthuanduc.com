<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Phalcon\Mvc\Model\Manager as ModelsManager;

class SysConfigModel extends DatatableManagerModel {

	public function getSource() {
		return "sys_config";
  }

	public function columnMap() {
		return array(
			'id'        	=> 'id', 
			'title'       => 'title', 
			'code'      	=> 'code', 
			'data'      	=> 'data', 
			'description' => 'description',
			'image'       => 'image',
			'link'				=> 'link',
			'url_target'  => 'url_target',
			'status'      => 'status',
			'editor_id'   => 'editor_id',
			'updated'     => 'updated'
		);
	}
	
	private function getController() {
		return "sys-config";
	}

	public function my_url($_format, $id = null){
		$Ohi = new \Modules\Library\Oh\Ohi();
		return $Ohi->baseAdminUrl($this->getController()."/index/{$_format}/{$id}");
	}

	public function datatable_column(){
		$init_data = array (
			array (
				'name'		=> 'sc@title',
				'label' 	=> 'Tiêu đề',
				'width' 	=> '140px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'		=> 'sc@data',
				'label' 	=> 'Dữ liệu',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'		=> 'sc@description',
				'label' 	=> 'Mô tả',
				'width' 	=> '200px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'		=> 'sc@link',
				'label' 	=> 'Liên kết',
				'width' 	=> '300px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'  	=> 'sc@status',
				'label' 	=> 'Trạng thái',
				'width' 	=> '100px',
				'filter'	=> array(
					'type' 	=> 'select',
					'value' => array(0=>'Không',1=>'Có')
				)
			),
			array (
				'name' 		=> 'sc@id',
				'label'		=> 'Chỉnh sửa',
				'width'		=> '100px',
				'filter'	=> null
			)
		);
		return $init_data;
	}

	public function datatable_json_data(){
		$result = $this->datatable_find([
			'select' => ['sc.title', 'sc.data', 'sc.description', 'sc.link', 'sc.status','m.username as editor', 'sc.updated', 'sc.id'],
			'from' 			=> ['sc' => 'Modules\App\Models\SysConfigModel'],
			'innerJoin' => [
				'Modules\App\Models\MemberModel' => ['alias' => 'm','on' => 'sc.editor_id=m.id']
			]
		]);

		$result->json_data = array();
		
		foreach($result->realData as $item){
			$action = array(
				'edit' 		=> array('href' => $this->my_url('update', $item->id))
			);
			$result->json_data[] = array(
				'sc@title' 		=> $item->title,
				'sc@data' 		=> $item->data,
				'sc@description' 		=> $item->description,
				'sc@link' 		=> $item->link,
				'sc@status'  	=> $this->changeValue('status', $item->id, $item->status, $this->getController()),
				'sc@id'				=> $this->renderHtmlButton($action)
			);
		}
		return $result;
  }

  public function statusList(){
  	return ['0' => 'Đóng', '1' => 'Mở'];
  }

	public function findByCode($code, $field = 'data'){
		$sysConfig = $this->findFirst("code = '{$code}'");
		if($sysConfig && !empty($sysConfig) && !empty($field)){
			return $sysConfig->$field;
		}
		return "";
	}

	public function findConfigByCode($code){
		$sysConfig = $this->findFirst("code = '{$code}'");
		return $sysConfig;
	}
}