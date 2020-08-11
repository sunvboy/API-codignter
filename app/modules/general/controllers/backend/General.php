<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends MY_Controller{

	public function __construct(){
		parent::__construct();
		if(!isset($this->auth) || is_array($this->auth) == FALSE || count($this->auth) == 0 ) redirect(BACKEND_DIRECTORY);
		$this->load->library(array('configbie'));
	}
	

	public function View(){
		$this->commonbie->permission("general/backend/general/view", $this->auth['permission']);
		$data['tab'] = $this->configbie->system();
		
		$general = $this->Autoload_Model->_get_where(array(
			'select' => 'keyword, content,content_lang',
			'table' => 'general',
			'order_by' => 'keyword asc'
		), TRUE);
		if(isset($general) && is_array($general) && count($general)){
			foreach($general as $key => $val){
				$data['systems'][$val['keyword']] = (($this->fclang == 'vietnamese') ? $val['content'] : $val['content_lang']);
			}
		}


		
		if($this->input->post('save')){
			$config = $this->input->post('config');
			if(isset($config) && is_array($config) && count($config)){
				foreach($config as $key => $val){
					$_update = NULL;
					$_update['keyword'] = $key;
					$_update[''.(($this->fclang == 'vietnamese') ? 'content' : 'content_lang').''] = $val;
					$_update['userid_created'] = $this->auth['id'];
					$_update['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
					$flag = $this->_Check($key);
					if($flag == FALSE){
						$this->Autoload_Model->_create(array(
							'table' => 'general',
							'data' => $_update,
						));
					} else {
						$this->Autoload_Model->_update(array(
							'where' => array('keyword' => $key),
							'table' => 'general',
							'data' => $_update,
						));
					}
				}
			}
			$this->session->set_flashdata('message-success', 'Lưu thông tin cấu hình hệ thống thành công');
			redirect('general/backend/general/view');
		}
		$data['template'] = 'general/backend/general/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	
	public function _Check($keyword = ''){
		$result = $this->Autoload_Model->_get_where(array(
			'select' => 'keyword',
			'table' => 'general',
			'where' => array('keyword' => $keyword),
			'count' => TRUE
		));
		return (($result >= 1) ? TRUE : FALSE);
	}
}
