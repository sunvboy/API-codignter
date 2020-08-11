<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Functions extends MY_Controller{

	public $module;
	public function __construct(){
		parent::__construct();
		if(!isset($this->auth) || is_array($this->auth) == FALSE || count($this->auth) == 0 ) redirect(BACKEND_DIRECTORY);
		$this->load->library(array('configbie'));
	}

	public function view($page = 1){
		$this->commonbie->permission("functions/backend/functions/view", $this->auth['permission']);
		$page = (int)$page;
		$data['from'] = 0;
		$data['to'] = 0;

		$perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 1000;
		$keyword = $this->input->get('keyword');
		$catalogueid = (int)$this->input->get('catalogueid');
		if(!empty($keyword)){
			$keyword = '(title LIKE \'%'.$keyword.'%\')';
		}
		$config['total_rows'] = $this->Autoload_Model->_get_where(array(
			'select' => 'id',
			'table' => 'functions',
			'count' => TRUE,
			'keyword' => '(title LIKE \'%'.$keyword.'%\')',
		));
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['base_url'] = base_url('contact/backend/contact/view');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = $perpage;
			$config['uri_segment'] = 1000;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<ul class="pagination no-margin">';
			$config['full_tag_close'] = '</ul>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a class="btn-primary">';
			$config['cur_tag_close'] = '</a></li>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['PaginationList'] = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$data['from'] = ($page * $config['per_page']) + 1;
			$data['to'] = ($config['per_page']*($page+1) > $config['total_rows']) ? $config['total_rows']  : $config['per_page']*($page+1);

			$data['listContact'] = $this->Autoload_Model->_get_where(array(
				'select' => '*',
				'table' => 'functions',
				'keyword' => '(title LIKE \'%'.$keyword.'%\')',
				'start' => $page * $config['per_page'],
				'limit' => $config['per_page'],
				'order_by' => 'id desc, created desc',
			), TRUE);
		}
		$data['script'] = 'functions';
		$data['config'] = $config;
		
		$data['template'] = 'functions/backend/functions/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}

	public function create(){
		if($this->input->post('create')){
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('title', 'Tiêu đề modules', 'trim|required');
			$this->form_validation->set_rules('keyword', 'Tiêu đề modules', 'trim|required|callback__Keyword');
			if ($this->form_validation->run($this)){
				$flag = $this->BackendFunctions_Model->create();
				if($flag > 0){
					$this->session->set_flashdata('message-success', 'Thêm  mới modules thành công');
					redirect('functions/backend/functions/view');
				}
			}
		}
		$data['template'] = 'functions/backend/functions/create';
		$this->load->view('dashboard/backend/layouts/home', isset($data)?$data:NULL);
	}

	public function _Keyword(){
		$keyword = $this->input->post('keyword');
		$count = $this->BackendFunctions_Model->CountFunctions(array('keyword' => $keyword));
		if($count > 0){
			$this->form_validation->set_message('_Keyword','Từ khóa đã tồn tại');
			return false;
		}
		return true;
	}
	
	public function read($id = 0){
		$data['DetailFunctions'] = $this->BackendFunctions_Model->read($id);
		if(!isset($data['DetailFunctions']) && !is_array($data['DetailFunctions']) && count($data['DetailFunctions']) == 0){
			$this->session->set_flashdata('message-danger', ' không tồn tại');
			redirect_custom('functions/backend/functions/view');
		}
		
		$data['template'] = 'functions/backend/functions/read';
		$this->load->view('dashboard/backend/layouts/home', isset($data)?$data:NULL);
	}

	public function update($id = 0){

		$id = (int)$id;
		$data['DetailFunctions'] = $this->BackendFunctions_Model->read($id);
		if(!isset($data['DetailFunctions']) && !is_array($data['DetailFunctions']) && count($data['DetailFunctions']) == 0){
			$this->session->set_flashdata('message-danger', ' không tồn tại');
			redirect_custom('functions/backend/functions/view');
		}
		if($this->input->post('update')){
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('title', 'Tiêu đề modules', 'trim|required');
			$this->form_validation->set_rules('keyword', 'Tiêu đề modules', 'trim|required');
			if ($this->form_validation->run($this)){
				$flag = $this->BackendFunctions_Model->update($id);
				if($flag > 0){
					$this->session->set_flashdata('message-success', 'Cập nhật  thành công');
					redirect_custom('functions/backend/functions/view');
				}
			}
		}
		$data['template'] = 'functions/backend/functions/update';
		$this->load->view('dashboard/backend/layouts/home', isset($data)?$data:NULL);
	}

	public function delete($id = 0){
		$id = (int)$id;
		$data['DetailFunctions'] = $this->BackendFunctions_Model->read($id);
		if(!isset($data['DetailFunctions']) && !is_array($data['DetailFunctions']) && count($data['DetailFunctions']) == 0){
			$this->session->set_flashdata('message-danger', ' không tồn tại');
			redirect_custom('functions/backend/functions/view');
		}
		if($this->input->post('delete')){
			$flag = $this->BackendFunctions_Model->delete($id);
			if($flag > 0){
				$this->session->set_flashdata('message-success', 'Xóa  thành công');
				redirect('functions/backend/functions/view');
			}
		}
		$data['template'] = 'functions/backend/functions/delete';
		$this->load->view('dashboard/backend/layouts/home', isset($data)?$data:NULL);
	}

	public function status(){
		$id = $this->input->post('objectid');
		$object = $this->Autoload_Model->_get_where(array(
			'select' => 'id, publish',
			'table' => 'functions',
			'where' => array('id' => $id),
		));

		$_update['publish'] = (($object['publish'] == 1)?0:1);
		$this->Autoload_Model->_update(array(
			'where' => array('id' => $id),
			'table' => 'functions',
			'data' => $_update,
		));
	}
}
