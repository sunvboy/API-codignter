<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps extends MY_Controller{

	public function __construct(){
		parent::__construct();
		if(!isset($this->auth) || is_array($this->auth) == FALSE || count($this->auth) == 0 ) redirect(BACKEND_DIRECTORY);
		$this->load->library(array('configbie'));
	}
	public function View(){
		$row = $this->Autoload_Model->_get_where(array(
			'select' => 'map_hdfMap,map_search_address',
			'table' => 'customer_config',
			'where' => array('id' => 1)
		));

		if($this->input->post('update')){
			$_update=array(
				'map_hdfMap'            => $this->input->post('hdfMap'),
				'map_search_address'            => $this->input->post('map_search_address'),
			);
			$insertId = $this->Autoload_Model->_update(array(
				'where' => array('id' => 1),
				'table' => 'customer_config',
				'data' => $_update
			));

			if($insertId > 0){
				$this->session->set_flashdata('message-success', 'Cập nhập thành công');
				redirect(site_url('general/backend/maps/view'));
			}
		}
		$data['row']=$row;

		$data['template'] = 'general/backend/maps/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}


	

}
