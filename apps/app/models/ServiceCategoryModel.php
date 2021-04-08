<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class ServiceCategoryModel extends DatatableManagerModel{
	public function getSource() {
        return "service_category";
    }
	private function getController() {
		return "service-category";
	}
    public function my_url($_format, $id = null) {
		$Ohi = new \Modules\Library\Oh\Ohi();
		return $Ohi->baseAdminUrl($this->getController()."/index/{$_format}/{$id}");
	}

	public function datatable_column() {
		$init_data = array (
			array (
				'name'	=> 'c@title', /* <Class>@<column> => <class>.<column>*/
				'label' => 'Tiêu đề',
				'filter'=> array(
					'type' => 'text'
				)
			),
			
			array (
				'name'	=> 'c@status',
				'width'	=> '80px',
				'label' => 'Hiển thị',
				'filter'=> array(
					'type' => 'select',
					'value' => array(0=>'Không',1=>'Có')
				)
			),
			array (
				'name'	=> 'creator',
				'width'	=> '100px',
				'label' => 'Người tạo',
				'filter'=> array(
					'type' => 'text'
				)
			),
			array (
				'name'	=> 'c@created',
				'width'	=> '100px',
				'label' => 'Ngày tạo',
				'filter'=> array(
					'type' => 'text'
				)
			),
			array (
				'name' 	=> 'c@id',
				'width'	=> '100px',
				'label'	=> '<a href="'.$this->my_url('add').'" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</a>',
				'filter'=> null
			)
		);
		return $init_data;
	}
	public function datatable_json_data(){
		$result = $this->datatable_find([
			'select' 		=> ['c.title','c.status','m.username as creator', 'c.created','c.id'],
			'from' 			=> ['c' => 'Modules\App\Models\ServiceCategoryModel'],
			'innerJoin' => [
				'Modules\App\Models\MemberModel' => [
					'alias' => 'm',
					'on' => 'c.creator_id=m.id'
				]
			],
			'group_by' => array('c.id')
		]);

		$result->json_data = array();
		
		foreach($result->realData as $item){
			$action = array(
				'edit' 		=> array('href' => $this->my_url('update', $item->id)),
				'delete' 	=> array('href' => $this->my_url('delete', $item->id))
			);

			$result->json_data[] = array(
				'c@title' 		=> $item->title,
				'c@status'   	=> $this->changeValue('status', $item->id, $item->status, $this->getController()),
				'creator' 		=> $item->creator,
				'c@created' 	=> $item->created,
				'c@id'			=> $this->renderHtmlButton($action)
			);
		}
		return $result;
	}
}