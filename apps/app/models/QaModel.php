<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Phalcon\Mvc\Model\Manager as ModelsManager;

class QaModel extends DatatableManagerModel {  
	
	public function getSource() {
		return "question_answer";
	}

	public function columnMap() {
		return array(
			'id'        	=> 'id', 
			'fullname'    => 'fullname', 
			'phone'      	=> 'phone', 
			'email'   		=> 'email',
			'question'    => 'question',
			'code'      	=> 'code',
			'answer'   		=> 'answer',
			'status'    	=> 'status',
			'created'     => 'created',
			'updated'     => 'updated',
			'editor_id'   => 'editor_id',
			'creator_id'  => 'creator_id',
		);
	}

	private function getController() {
		return "qa";
	}
	
	public function my_url($_format, $id = null){
		$Ohi = new \Modules\Library\Oh\Ohi();
		return $Ohi->baseAdminUrl($this->getController()."/index/{$_format}/{$id}");
	}

	public static function findFinished(){
		$queryBuilder = new \Phalcon\Mvc\Model\Query\Builder();
		return $queryBuilder
			->from(['qa' => '\Modules\App\Models\QaModel'])
			->where('qa.status = :status:', ['status' => 1])
			->orderBy('qa.created')
			->getQuery()->execute();
	}
	
	public function datatable_column(){
		$init_data = array (
			array (
				'name' 		=> 'qa@question',
				'label' 	=> 'Câu hỏi tư vấn',
				'width' 	=> '130px',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'  	=> 'qa@fullname',
				'label' 	=> 'Họ và tên',
				'filter'	=> array(
					'type'	=> 'text'
				),
				'width' 	=> '100px',
			),
			array (
				'name' 		=> 'qa@email',
				'label' 	=> 'Địa chỉ email',
				'filter'	=> array(
					'type' 	=> 'text'
				),
				'width' 	=> '120px',
			),
			array (
				'name'		=> 'qa@status',
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
				'name'		=> 'qa@created',
				'width'		=> '100px',
				'label' 	=> 'Ngày tạo',
				'filter'	=> array(
					'type' 	=> 'text'
				)
			),
			array (
				'name'  	=> 'qa@id',
				'label'		=> '<a href="'.$this->my_url('add').'" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</a>',
				'width' 	=> '100px'
			)
		);
		return $init_data;
	}
	
	public function datatable_json_data(){

		$result = $this->datatable_find([
			'select' 		=> ['qa.question','qa.fullname','qa.email', 'qa.status','m.username as creator','qa.created','qa.id'],
			'from' 			=> ['qa' => 'Modules\App\Models\QaModel'],
			'innerJoin' => [
				'Modules\App\Models\MemberModel' => ['alias' => 'm','on' => 'qa.creator_id=m.id']
			]
		]);

		$result->json_data = array();
		
		foreach($result->realData as $item){
			$action = array(
				'view' 		=> array('href' => $this->my_url('update', $item->id)),
				'delete' 	=> array('href' => $this->my_url('delete', $item->id))
			);
			$result->json_data[] = array(
				'qa@question'  	=> $item->question,
				'qa@fullname'  	=> $item->fullname,
				'qa@email'     	=> $item->email,
				'qa@status'   	=> $this->changeValue('status', $item->id, $item->status, $this->getController()),
				'creator' 			=> $item->creator,
				'qa@created' 		=> $item->created,
				'qa@id'     		=> $this->renderHtmlButton($action)
			);
		}
		return $result;
	}
}