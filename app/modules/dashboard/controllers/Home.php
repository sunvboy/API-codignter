<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {


	public function __construct(){
		parent::__construct();
		if(!isset($this->auth)) redirect('sadmin');

	}

	public function index(){
		$data['time_start'] = microtime(true);
		$data['load_extend_script'] = $this->load_extend_script();
		$data['template'] = 'dashboard/backend/home/index';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	public function publish_frontend(){
		$id = $this->input->post('objectid');
		$module = $this->input->post('module');
		$title = $this->input->post('title');
		$object = $this->Autoload_Model->_get_where(array(
			'select' => 'id, '.$title.'',
			'table' => $module,
			'where' => array('id' => $id),
		));

		$_update[''.$title.''] = (($object[''.$title.''] == 1)?0:1);
		$this->Autoload_Model->_update(array(
			'where' => array('id' => $id),
			'table' => $module,
			'data' => $_update,
		));
	}

	
		
}
