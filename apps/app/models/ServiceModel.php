<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Phalcon\Mvc\Model\Manager as ModelsManager;

class ServiceModel extends DatatableManagerModel {

	public function getSource() {
		return "service";
	}

	public function columnMap() {
		return array(
			'id'        		=> 'id', 
			'title'        	 	=> 'title', 
			'category_id'       => 'category_id', 
			'code'      		=> 'code', 
			'description'   	=> 'description',
			'content'       	=> 'content',
			'featured'      	=> 'featured',
			'image'         	=> 'image',
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
		$this->belongsTo('category_id', '\Modules\App\Models\ServiceCategoryModel', 'id', ['alias' => 'service_category']);
	}
	
	private function getController() {
		return "service";
	}

	public function my_url($_format, $id = null){
		$Ohi = new \Modules\Library\Oh\Ohi();
		return $Ohi->baseAdminUrl($this->getController()."/index/{$_format}/{$id}");
	}

	public function datatable_column(){
		$init_data = array (
			array (
				'name'		=> 'na@title',
				'label' 	=> 'Tiêu đề',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'		=> 'na@featured',
				'label' 	=> 'Nổi bật',
				'width'		=> '80px',
				'filter'	=> array(
					'type' 	=> 'select',
					'value' => array(0=>'Không',1=>'Có')
				)
			),	
			array (
				'name'		=> 'na@status',
				'label' 	=> 'Hiển thị',
				'width'		=> '80px',
				'filter'	=> array(
					'type' 	=> 'select',
					'value' => array(0=>'Không',1=>'Có')
				)
			),
		
			array (
				'name'		=> 'na@created',
				'label' 	=> 'Ngày tạo',
				'width'		=> '100px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'		=> 'na@published',
				'label' 	=> 'Ngày đăng',
				'width'		=> '100px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			
			array (
				'name' 		=> 'na@id',
				'label'		=> '<a href="'.$this->my_url('add').'" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</a>',
				'width'		=> '100px'
			)
		);
		return $init_data;
	}

	public function datatable_json_data(){
		$result = $this->datatable_find([
			'select' 		=> ['na.title', 'na.featured',  'na.status','m.username as creator','na.created', 'na.published', 'na.id'],
			'from' 			=> ['na' => 'Modules\App\Models\ServiceModel'],
			'innerJoin' => [
				'Modules\App\Models\MemberModel' 				=> ['alias' => 'm','on' => 'na.creator_id=m.id'],
			],
			'group_by' 	=> array('na.id')
		]);

		$result->json_data = array();
		foreach($result->realData as $item){
			$action = array(
				'edit' 		=> array('href' => $this->my_url('update', $item->id)),
				'delete' 	=> array('href' => $this->my_url('delete', $item->id))
			);
			$result->json_data[] = array(
				'na@title' 		  => $item->title,
				'na@featured'     => $this->changeValue('featured', $item->id, $item->featured, $this->getController()),
				'na@status'       => $this->changeValue('status', $item->id, $item->status, $this->getController()),
				'na@created'	  => $item->created,
				'na@published' 	  => $item->published,
				'na@id'			  => $this->renderHtmlButton($action)
			);
		}
		return $result;
	}

	public function statistic($month = 1){
		$sql = "SELECT COUNT(id) as total
						FROM \Modules\App\Models\ServiceModel 
						WHERE YEAR(created) = YEAR(CURDATE()) AND MONTH(created) = ".$month." 
						GROUP BY MONTH(created) 
						ORDER BY MONTH(created)
					";

		$query  = new Query($sql, $this->getDI());
		$robots = $query->execute();
		return $robots;
	}

	
}