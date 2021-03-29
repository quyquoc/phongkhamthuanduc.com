<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Phalcon\Mvc\Model\Manager as ModelsManager;
use Modules\Library\Oh\Character;

abstract class DatatableManagerModel extends Model {

	public function dt_init($dataParams = Null){
		return array (
			'init_data' => $this->datatable_column($dataParams),
			'data_url'	=> $this->my_url('datatable', $dataParams)
		);
	}

	public function json_data($dataParams = Null){
		$datatable_data = $this->datatable_json_data($dataParams);
		return array(
			'draw' 						=> $datatable_data->draw,
			'data' 						=> $datatable_data->json_data,
			'recordsTotal'    => $datatable_data->total,
      'recordsFiltered' => $datatable_data->totalRealData
		);
	}

	public function export($dataParams = Null){
		return $this->datatable_export($dataParams);
	}
	
	public function renderHtmlButton($action = array()){
		$actionDefault = array(
			'view' => array(
				'href' 	=> '#',
				'text'	=> 'Xem'
			),
			'edit' => array(
				'href' 	=> '#',
				'text'	=> 'Sửa'
			),
			'delete' => array(
				'href' 	=> '#',
				'text'	=> 'Xóa'
			)
		);

		$string = "";
		
		foreach($action as $key => $val){
			if(!isset($actionDefault[$key])) {
				continue;
			}
			$actionDefault[$key] = array_merge($actionDefault[$key], $val);
			if($key == 'view') {
				$string .= '<a href="'.$actionDefault['view']['href'].'" class="btn btn-info btn-xs"><i class="ion-eye"></i> '.$actionDefault['view']['text'].'</a>';
			}
			if($key == 'edit') {
				$string .= '<a href="'.$actionDefault['edit']['href'].'" class="btn btn-info btn-xs"><i class="ion-edit"></i> '.$actionDefault['edit']['text'].'</a>';
			}
			if($key == 'delete') {
				$string .= '<a class="item choose-delete btn btn-danger btn-xs btn-delete" data-toggle="modal" data-target="#modal-delete" action="enabled" ref="'.$actionDefault['delete']['href'].'"><i class="ion-ios-trash-outline"></i> '.$actionDefault['delete']['text'].'</a>';
			}
		}

		return $string;

		// return <<<HTMLText
		// 	<a href="{$actionDefault['view']['href']}" class="btn btn-info btn-xs"><i class="ion-view"></i> {$actionDefault['view']['text']}</a>
		// 	<a href="{$actionDefault['edit']['href']}" class="btn btn-info btn-xs"><i class="ion-edit"></i> {$actionDefault['edit']['text']}</a>
		// 	<a class="item choose-delete btn btn-danger btn-xs btn-delete" data-toggle="modal" data-target="#modal-delete" action="enabled" ref="{$actionDefault['delete']['href']}"><i class="ion-ios-trash-outline"></i> {$actionDefault['delete']['text']}</a>
		// HTMLText;
	}

	public function changeValue($field = 'status', $id=0, $value = 1, $controler = '') {
		return $value ?
			'<i id="'.$field.$id.'" class="ion-ios-checkmark-outline status status-1" onclick="changeStatus(\''.$field.$id.'\', \''.$controler.'\')" data-id="'.$id.'" data-field="'.$field.'" data-value="0"></i>' : 
			'<i id="'.$field.$id.'" class="ion-ios-close-outline status status-0" onclick="changeStatus(\''.$field.$id.'\', \''.$controler.'\')" data-id="'.$id.'" data-field="'.$field.'" data-value="1"></i>';
	}

	public function queryParams($params){
		$params_default = [
			'from',
			'select',
			'where',
			'innerJoin',
			'join',
			'where_group',
			'or_where_group',
			'where_or_group'
		];
		foreach($params_default as $key){
			if(isset($params[$key])){
				$$key = $params[$key];
			} else {
				$$key = null;
			}
		}
		if($from){
			$this->queryBuilder->from($from);
		}
		if($select && !empty($select)){
			$this->queryBuilder->columns($select);
		}
		if($where){
			if(!is_array($where)) $where = [$where];
			$bindData = null;
			if(count($where) > 1){
				$bindData = $where[1];
			}
			$this->queryBuilder->andWhere($where[0], $bindData);
		}
		if($where_group){
			$str = "";
			$bindParams = [];
			foreach($where_group as $where_of_group){
				if(!is_array($where_of_group)) $where_of_group = [$where_of_group];
				$bindData = null;
				if(count($where_of_group) > 1){
					$bindData = $where_of_group[1];
					$bindParams = array_merge($bindParams, $bindData);
				}
				if(strlen($str) > 0){
					$str .= " AND ";
				}
				$str .= "({$where_of_group[0]})";				
			}
			$str = "($str)";
			$this->queryBuilder->andWhere($str, $bindParams);
		}
		if($or_where_group){
			$str = "";
			$bindParams = [];
			foreach($or_where_group as $where_of_group){
				if(!is_array($where_of_group)) $where_of_group = [$where_of_group];
				$bindData = null;
				if(count($where_of_group) > 1){
					$bindData = $where_of_group[1];
					$bindParams = array_merge($bindParams, $bindData);
				}
				if(strlen($str) > 0){
					$str .= " OR ";
				}
				$str .= "({$where_of_group[0]})";				
			}
			$str = "($str)";
			$this->queryBuilder->andWhere($str, $bindParams);
		}
		if($where_or_group){
			$str = "";
			$bindParams = [];
			foreach($where_or_group as $where_of_group){
				if(!is_array($where_of_group)) $where_of_group = [$where_of_group];
				$bindData = null;
				if(count($where_of_group) > 1){
					$bindData = $where_of_group[1];
					$bindParams = array_merge($bindParams, $bindData);
				}
				if(strlen($str) > 0){
					$str .= " AND ";
				}
				$str .= "({$where_of_group[0]})";				
			}
			$str = "($str)";
			$this->queryBuilder->orWhere($str, $bindParams);
		}

		if($innerJoin && !empty($innerJoin)){
			foreach($innerJoin as $innerJoinModel => $innerJoinItem){
				$alias = null;
				if(isset($innerJoinItem['alias'])){
					$alias = $innerJoinItem['alias'];
				}
				$this->queryBuilder->innerJoin($innerJoinModel, $innerJoinItem['on'], $alias);
			}
		}

		if($join && !empty($join)){
			foreach($join as $joinModel => $joinItem){
				$alias = null;
				$type = null;
				if(isset($joinItem['alias'])){
					$alias = $joinItem['alias'];
				}
				if(isset($joinItem['type'])){
					$type = strtoupper($joinItem['type']);
				}
				$this->queryBuilder->join($joinModel, $joinItem['on'], $alias, $type);
			}
		}
	}

	public function datatable_find($params = null){
		/* check request */
		/*
			REQUEST PARAMETER
			- draw: số lần truy vấn
			- columns: truy vấn cột
				- search: truy vấn chung
			- order: truy vấn sắp xếp
			- start: lấy kết quả bắt đầu từ
			- length: giới hạn dòng
		*/

		$this->queryBuilder = new \Phalcon\Mvc\Model\Query\Builder();
		$this->queryBuilder->addFrom(get_called_class());

		$request 	= new \Phalcon\Http\Request();
		$draw 		= (int)$request->get('draw');
		$columns 	= $request->get('columns');
		$order 		= $request->get('order');
		$start 		= (int)$request->get('start');
		$limit 		= (int)$request->get('length');
		$globalSearch = $request->get('search');
		$export 	= $request->get('export');

		$this->conditionQuery();
		$this->orderQuery();
		$this->queryParams($params);

		if(isset($params['raw']) && $params['raw'] ===true){
			return $this->queryBuilder->getQuery()->getSql();
		}

		/**
		*	- phân trang: giới hạn và lấy kết quà bắt đầu từ start
		**/
		$limit 	= $limit > 0? $limit : 0;
		$offset = $limit > 0 && $start > 0? $start : 0;
		
		/* đếm */
		$totalData = $this->queryBuilder->getQuery()->execute();
		$countTotal = $totalData ? count($totalData) : 0;

		if($limit>0){
			$this->queryBuilder->limit($limit);
			$this->queryBuilder->offset($offset);
		}		

		$realData = $this->queryBuilder->getQuery()->execute();
		$result = new \stdClass;
		$result->draw 		= $draw;
		$result->total 		= $countTotal;
		$result->realData 	= $realData ? $realData : array();
		$result->totalRealData = $countTotal;

		return $result;
	}

	private function conditionQuery(){
		$request 	= new \Phalcon\Http\Request();
		$columns 	= $request->get('columns');
		$globalSearch = $request->get('search');

		/**
		*	- Truy vấn cột
		**/
		$bindParams = [];
		if($columns && !empty($columns)){
			$condition_all = $condition_column = array();
			foreach($columns as $key => $col_item){
				$field = $col_item['data'];
				$search = $col_item['search'];
				if($search && isset($search['value']) && !empty($search['value'])){
					/* kiểm tra table */
					$field = str_replace('@', '.', $field);

					$searchValue = $search['value'];
					preg_match('/^((=)|(>=)|(<=)|(>)|(<))/', $searchValue, $match);

					$operator = 'LIKE';
					if($match && !empty($match)) {
						$operator = $match[0];
						$searchValue = trim(substr($searchValue, strlen($operator)));
					} else {
						$searchValue = '%'.$search['value'].'%';
					}

					$bindKey = "key_col_".preg_replace("@[^a-z0-9]@i", "", $field).rand(1,100)*time();
					$bindParams[$bindKey] = $searchValue;
					$condition_column[] = "{$field} {$operator} :{$bindKey}:";
				}
			}

			if(!empty($condition_column)){
				$str = "";
				foreach($condition_column as $col){
					if(strlen($str) > 0){
						$str .= " AND ";
					}
					$str .= "({$col})";
				}
				$str = "($str)";
				$condition_all[] = $str;
			}
			/**
			*	- truy vấn toàn cục
			**/
			if(isset($globalSearch['value']) && !empty($globalSearch['value'])){
				$globalSearchValue = $globalSearch['value'];
				$operator = 'LIKE';
				$searchValue = '%'.$globalSearchValue.'%';

				$condition = array();
				foreach($columns as $key => $col_item) {
					$field = $col_item['data'];
					$field = str_replace('@', '.', $field);

					$bindKey = "key_col_glo_".preg_replace("@[^a-z0-9]@i", "", $field).rand(1,100)*time();
					$bindParams[$bindKey] = $searchValue;
					$condition[] = "{$field} {$operator} :{$bindKey}:";					
				}
				if(!empty($condition)){
					$str = "";
					foreach($condition as $col){
						if(strlen($str) > 0){
							$str .= " OR ";
						}
						$str .= "({$col})";
					}
					$str = "($str)";
					$condition_all[] = $str;
				}
			}

			if(!empty($condition_all)){
				$str = "";
				foreach($condition_all as $col){
					if(strlen($str) > 0){
						$str .= " AND ";
					}
					$str .= "({$col})";
				}
				$this->queryBuilder->andWhere($str, $bindParams);
			}
		}
	}

	private function orderQuery(){
		$request 	= new \Phalcon\Http\Request();
		$order 		= $request->get('order');
		$columns 	= $request->get('columns');

		/**
		*	- sắp xếp theo cột
		**/
		if(!empty($order)){
			$order_0 = $order[0];
			$order_column_index = $order_0['column'];
			$order_dir = strtoupper($order_0['dir'])=='DESC'?'DESC':'ASC';
			if(isset($columns[$order_column_index]) && !empty($columns[$order_column_index])){
				$field = $columns[$order_column_index]['data'];
				if($field && !empty($field)){
					$this->queryBuilder->orderBy(str_replace('@', '.', $field). " " .$order_dir);
				}				
			}
		}
	}

	public static function init(){
		$class = "\\".get_called_class();
		return new $class();
	}

	public function createSlug($dataField, $slugField = 'code'){
		$slug = null;
		$character= new Character();
		if(isset($this->$slugField) && !empty($this->$slugField)){
			$slug = $character->normalizeString($this->$slugField);
		} else {			
			$slug = $character->normalizeString($this->$dataField);
		}
		if(isset($this->id) && $this->id>0){
			$model = $this->findFirst("{$slugField} = '{$slug}' AND id != {$this->id}");
		} else {
			$model = $this->findFirst("{$slugField} = '{$slug}'");
		}
		
		if($model && !empty($model)){
			$slug .= '-'.time();
		}
		return $slug;	
	}
}