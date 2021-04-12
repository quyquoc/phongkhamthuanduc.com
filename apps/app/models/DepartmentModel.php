<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Phalcon\Mvc\Model\Manager as ModelsManager;

class DepartmentModel extends DatatableManagerModel {

	public function getSource() {
		return "department";
	}

	public function columnMap() {
		return array(
			'id'        		=> 'id', 
			'title'        	 	=> 'title', 
			'code'      		=> 'code', 
			'description'   	=> 'description',
			'content'       	=> 'content',
			'featured'      	=> 'featured',
			'image'         	=> 'image',
			'banner'         	=> 'banner',
			'logo'         		=> 'logo',
			'logo_white'        => 'logo_white',
			'imgs'         		=> 'imgs',
			'link'				=> 'link',
			'url_target'    	=> 'url_target',
			'status'        	=> 'status',
			'seo_title'     	=> 'seo_title',
			'seo_image'     	=> 'seo_image',
			'seo_description'	=> 'seo_description',
			'hits'          	=> 'hits',
			'created'       	=> 'created',
			'updated'       	=> 'updated',
			'creator_id'    	=> 'creator_id',
			'editor_id'     	=> 'editor_id',
			'published'     	=> 'published',
			'position'    		=> 'position'
		);
	}
	
	public function initialize(){
	}
	
	private function getController() {
		return "department";
	}

	public function my_url($_format, $id = null){
		$Ohi = new \Modules\Library\Oh\Ohi();
		return $Ohi->baseAdminUrl($this->getController()."/index/{$_format}/{$id}");
	}

	public function datatable_column(){
		$init_data = array (
			array (
				'name'		=> 'de@title',
				'label' 	=> 'Tiêu đề',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'		=> 'de@featured',
				'label' 	=> 'Nổi bật',
				'width'		=> '80px',
				'filter'	=> array(
					'type' 	=> 'select',
					'value' => array(0=>'Không',1=>'Có')
				)
			),	
			array (
				'name'		=> 'de@status',
				'label' 	=> 'Hiển thị',
				'width'		=> '80px',
				'filter'	=> array(
					'type' 	=> 'select',
					'value' => array(0=>'Không',1=>'Có')
				)
			),
		
			array (
				'name'		=> 'de@created',
				'label' 	=> 'Ngày tạo',
				'width'		=> '100px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'		=> 'de@published',
				'label' 	=> 'Ngày đăng',
				'width'		=> '100px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			
			array (
				'name' 		=> 'de@id',
				'label'		=> '<a href="'.$this->my_url('add').'" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</a>',
				'width'		=> '100px'
			)
		);
		return $init_data;
	}

	public function datatable_json_data(){
		$result = $this->datatable_find([
			'select' 		=> ['de.title', 'de.featured',  'de.status','m.username as creator','de.created', 'de.published', 'de.id'],
			'from' 			=> ['de' => 'Modules\App\Models\DepartmentModel'],
			'innerJoin' => [
				'Modules\App\Models\MemberModel' => ['alias' => 'm','on' => 'de.creator_id=m.id'],
			],
			'group_by' 	=> array('de.id')
		]);

		$result->json_data = array();
		foreach($result->realData as $item){
			$action = array(
				'edit' 		=> array('href' => $this->my_url('update', $item->id)),
				'delete' 	=> array('href' => $this->my_url('delete', $item->id))
			);
			$result->json_data[] = array(
				'de@title' 		  => $item->title,
				'de@featured'     => $this->changeValue('featured', $item->id, $item->featured, $this->getController()),
				'de@status'       => $this->changeValue('status', $item->id, $item->status, $this->getController()),
				'de@created'	  => $item->created,
				'de@published' 	  => $item->published,
				'de@id'			  => $this->renderHtmlButton($action)
			);
		}
		return $result;
	}

}