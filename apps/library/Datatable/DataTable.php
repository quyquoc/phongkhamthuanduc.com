<?php
/**
 *  https://github.com/m1ome/phalcon-datatables
 */
namespace Modules\Library\Datatable;

use Modules\Library\Datatable\QueryBuilder;
use Modules\Library\Datatable\ResultSet;
use Modules\Library\Datatable\ArrayAdapter;
use Phalcon\Http\Response;

class DataTable extends \Phalcon\Mvc\User\Plugin {

	protected $model;
	protected $options;
	protected $params;
	protected $response;
	public    $parser;

	public function __construct($options = [],$model = null) {
		$this->model = $model;
		$default = [
		  'limit'   => 20,
		  'length'  => 50,
		];

		$this->options = $options + $default;
		$this->parser = new \Modules\Library\Datatable\ParamsParser($this->options['limit']);
	}

	public function getParams() {
		return $this->parser->getParams();
	}

	public function getResponse() {
		return !empty($this->response) ? $this->response : [];
	}

	public function getButton($id = null){
		$str = $this->tag->linkTo(array($this->define->backend.'/'.$this->router->getControllerName().'/edit/'.$id,'<i class="fa fa-pencil"></i> '.$this->language->_('edit'),'class'=>'btn btn-info btn-xs'));
		$str .= $this->tag->linkTo(array($this->define->backend.'/'.$this->router->getControllerName().'/delete/'.$id,'<i class="fa fa-trash-o"></i> '.$this->language->_('delete'),'class'=>'btn btn-danger btn-xs btn-delete'));
		
		return $str;
	}

	public function sendResponse() {
		if ($this->di->has('view')) {
			$this->di->get('view')->disable();
		}

		$response = new Response();
		$response->setContentType('application/json', 'utf8');
		$item = array();

		foreach ($this->getResponse() as $key => $value) {
			if($key != 'data'){
				$item[$key] = $value;    
			} else {
				if(!empty($value)){
					foreach ($value as $k => $v) {						
						if(isset($v['image']) && !empty($v['image'])){
							$v['image'] 	= '<a target="_blank" href="'.ROOT_URL.'/'.$v['image'].'"><img width="100px" height="100px" src="'.ROOT_URL.$v['image'].'" /></a>';
						}
						$v['status'] 		= isset($v['status']) ? $v['status'] == 1 ? '<span class="glyphicon glyphicon-check glyphicon-check-on"></span>' : '<span class="glyphicon glyphicon-ban-circle glyphicon-ban-circle-off"></span>' : '';
						$v['action']    = $this->getButton($v['id']);
						$item['data'][] = $v;
					}
				} else {
					$item['data'] = [];
				}
			}
		}

		$response->setJsonContent($item);
		$response->send();
	}

	public function fromBuilder($builder, $columns = []) {
		if (empty($columns)) {
			$columns = $builder->getColumns();
			$columns = (is_array($columns)) ? $columns : array_map('trim', explode(',', $columns));
		}

		$adapter = new QueryBuilder($this->options['length']);
		$adapter->setBuilder($builder);
		$adapter->setParser($this->parser);
		$adapter->setColumns($columns);
		$this->response = $adapter->getResponse();
		return $this;
	}

	public function fromResultSet($resultSet, $columns = []) {
		if(empty($columns) && $resultSet->count() > 0) {
			$columns = array_keys($resultSet->getFirst()->toArray());
			$resultSet->rewind();
		}

		$adapter = new ResultSet($this->options['length']);
		$adapter->setResultSet($resultSet);
		$adapter->setParser($this->parser);
		$adapter->setColumns($columns);
		$this->response = $adapter->getResponse();
		return $this;
	}

	public function fromArray($array, $columns = []) {
		if(empty($columns) && count($array) > 0) {
		  $columns = array_keys(current($array));
		}

		$adapter = new ArrayAdapter($this->options['length']);
		$adapter->setArray($array);
		$adapter->setParser($this->parser);
		$adapter->setColumns($columns);
		$this->response = $adapter->getResponse();
		return $this;
	}
}
