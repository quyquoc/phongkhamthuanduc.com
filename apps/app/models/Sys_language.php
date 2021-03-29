<?php
namespace Modules\App\Models;
use Phalcon\Mvc\Model;

class Sys_language extends Model {   

	public function columnMap() {
		return array(
			'id'    			=>  'id', 
			'code' 				=>  'code', 
			'description' =>  'description',
			'default' 		=>  'default'
		);
	}
	
	public function initialize(){}

	public function sql(){
		return "SELECT lang.code,lang.description,lang.default AS status,lang.id FROM \Modules\App\Models\Sys_language AS lang";
	}

	public function json_data($option = null){

		$json_data = array(
			array(
				"data"      => "code",
				"title"     => $this->getDI()->getLanguage()->_('code'),
				"search"    => array(
					"type" => "text"
				)
			),
			array(
				"data"      => "description",
				"title"     => $this->getDI()->getLanguage()->_('description'),
				"search"    => array(
					"type" => "text"
				)
			),
			array(
				"data"      => "status",
				"title"     => $this->getDI()->getLanguage()->_('default'),
				"width"     => "10%",
				"search"    => array(
					"type"  	=> "select",
					"value" 	=> array(''=>'','0'=>'Không','1'=>'Mặc định')
				)
			),
			array(
				"data"      => "action",
				"title"     => '<a class="btn btn-success add-new" href="'.BACKEND_URL.'/sys-language/add"><i class="fa fa-plus m-right-xs"></i> '.$this->getDI()->getLanguage()->_('add_new').'</a>',
				"orderable" => false,
				"width"     => "10%",
				"search"    => array(
					"type"  => "button-add",
					"value" => '<a class="btn btn-success add-new" href="'.BACKEND_URL.'/sys-language/add"><i class="fa fa-plus m-right-xs"></i> '.$this->getDI()->getLanguage()->_('add_new').'</a>'
				)
			)       
		);

		return $option == null ? preg_replace('/[\[\]]/','',json_encode($json_data)) : json_encode($json_data);
	}
}