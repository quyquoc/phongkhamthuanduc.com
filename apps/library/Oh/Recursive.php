<?php
namespace Modules\Library\Oh;
use Phalcon\Mvc\User\Component;

class Recursive  extends Component {
	
	private $model;
	private $category;
	private $data = array();
	private $result;
	private $where = null;

	public function __construct($model = null,$where = null){
		$this->model = $model;
		$this->Where($where);
		$this->getData();
		$this->recursive();
	}

	private function getData(){
		$model = "\Modules\Backend\Models\\".$this->model;
		$object = $model::find(
			array(
		        "conditions" => $this->where,
		    )
		);
		if($object != null && count($object) > 0){
			$array = array();
			foreach ($object as $key => $value) {
				$this->data[] = $value;
			}
		}
	}

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

	// Sử dụng cho thêm danh mục
	public function getListTreeCategory(){
		$record = array();
		$record[0]	=	"&nbsp ".$this->language->_('category_root');
		if(is_array($this->result) && count($this->result) > 0){
			foreach ($this->result as $key => $value) {
				$space = "&nbsp";
				if($value->level > 1){
					for ($i=1; $i <= $value->level; $i++) { 
						$space .= ";&nbsp;&nbsp;&nbsp";
					}
					$record[$value->id] = $space." - ".$value->title;
				} else {
					$record[$value->id] = $space." ".$value->title;
				}
			}
			return $record;
		}
		return $record;
	}

	private function Where($where = null){
		$str = "";
		if($where != null){
			foreach ($where as $key => $value) {
				$str .= $key." = ".$value;
			}
		}
		$this->where = $str;
	}
	
	// Sử dụng cho lọc tìm kiếm ở datatable
	public function getListTreeCategorySearch(){
		$record = array();
		
		if(is_array($this->result) && count($this->result) > 0){
			foreach ($this->result as $key => $value) {
				$space = "&nbsp;";
				if($value->level > 1){
					for ($i=1; $i <= $value->level; $i++) { 
						$space .= "&nbsp;&nbsp;&nbsp;";
					}
					$record[$value->title] = $space." - ".$value->title;
				} else {
					$record[$value->title] = $space." ".$value->title;
				}
			}
			return $record;
		}
		return $record;
	}

	// Sử dụng cho thêm ở Tin tức
	public function getListTreeCategoryNews(){
		$record = array();
		if(is_array($this->result) && count($this->result) > 0){
			foreach ($this->result as $key => $value) {
				$space = "&nbsp";
				if($value->level > 1){
					for ($i=1; $i <= $value->level; $i++) { 
						$space .= ";&nbsp;&nbsp;&nbsp";
					}
					$record[$value->id] = $space." - ".$value->title;
				} else {
					$record[$value->id] = $space." ".$value->title;
				}
			}
			return $record;
		}
		return $record;
	}
}