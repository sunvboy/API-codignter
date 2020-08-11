<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {

	public $module;
	public function __construct(){
		parent::__construct();
		if(!isset($this->auth) || is_array($this->auth) == FALSE || count($this->auth) == 0 ) redirect(BACKEND_DIRECTORY);
		$this->load->library(array('configbie'));
		// $this->load->library('nestedsetbie', array('table' => 'support'));
	}

	public function View($page = 1){
		$this->commonbie->permission("contact/backend/contact/view", $this->auth['permission']);

		$page = (int)$page;
		$data['from'] = 0;
		$data['to'] = 0;

		$perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
		$keyword = $this->input->get('keyword');
		$catalogueid = (int)$this->input->get('catalogueid');
		if(!empty($keyword)){
			$keyword = '(title LIKE \'%'.$keyword.'%\')';
		}
		$config['total_rows'] = $this->Autoload_Model->_get_where(array(
			'select' => 'id',
			'table' => 'contact',
			'count' => TRUE,
			'where' => ($catalogueid ==0) ? array('type'=>0) : array( 'catalogueid' => $catalogueid,'type'=>0) ,
			'keyword' => '(fullname LIKE \'%'.$keyword.'%\')',
		));
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['base_url'] = base_url('contact/backend/contact/view');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = $perpage;
			$config['uri_segment'] = 5;
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
				'select' => '*, (SELECT title FROM contact_catalogue WHERE contact_catalogue.id = contact.catalogueid) as catalogueTitle',
				'table' => 'contact',
				'where' => ($catalogueid ==0) ? array('type'=>0) : array( 'catalogueid' => $catalogueid,'type'=>0) ,
				'keyword' => '(fullname LIKE \'%'.$keyword.'%\')',
				'start' => $page * $config['per_page'],
				'limit' => $config['per_page'],
				'order_by' => 'viewed asc, created desc',
			), TRUE);
		}

		$data['script'] = 'contact';
		$data['config'] = $config;
		$data['template'] = 'contact/backend/contact/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	public function mailsubricre($page = 1){
		$this->commonbie->permission("contact/backend/contact/mailsubricre", $this->auth['permission']);

		$page = (int)$page;
		$data['from'] = 0;
		$data['to'] = 0;

		$perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
		$keyword = $this->input->get('keyword');
		$catalogueid = (int)$this->input->get('catalogueid');
		if(!empty($keyword)){
			$keyword = '(title LIKE \'%'.$keyword.'%\')';
		}
		$config['total_rows'] = $this->Autoload_Model->_get_where(array(
			'select' => 'id',
			'table' => 'contact',
			'count' => TRUE,
			'where' => ($catalogueid ==0) ? array('type'=>1) : array( 'catalogueid' => $catalogueid,'type'=>1) ,
			'keyword' => '(fullname LIKE \'%'.$keyword.'%\')',
		));
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['base_url'] = base_url('contact/backend/contact/view');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = $perpage;
			$config['uri_segment'] = 5;
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
				'select' => '*, (SELECT title FROM contact_catalogue WHERE contact_catalogue.id = contact.catalogueid) as catalogueTitle',
				'table' => 'contact',
				'where' => ($catalogueid ==0) ? array('type'=>1) : array( 'catalogueid' => $catalogueid,'type'=>1) ,
				'keyword' => '(fullname LIKE \'%'.$keyword.'%\')',
				'start' => $page * $config['per_page'],
				'limit' => $config['per_page'],
				'order_by' => 'viewed asc, created desc',
			), TRUE);
		}

		$data['script'] = 'contact';
		$data['config'] = $config;
		$data['template'] = 'contact/backend/contact/mailsubricre';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}

	public function ViewDetail($id = 0){
		$data['contact'] = $this->Autoload_Model->_get_where(array(
			'select' => 'id, fullname, email, phone, created, subject, message, file',
			'table' => 'contact',
			'order_by' => 'created asc',
			'where' => array('id' => $id),
		));

		if(!empty($data['contact'])){
			$data['contact']['file'] = json_decode(base64_decode($data['contact']['file']), TRUE);

		}

		if($this->input->post('update')){
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			$this->form_validation->set_error_delimiters('',' /');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('reply', 'Nội dung trả lời', 'trim|required');
			if($this->form_validation->run($this)){
				$_update = array(
					'subject' => $this->input->post('subject'),
					'reply' => $this->input->post('reply'),
					'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),

				);
				$flag = $this->Autoload_Model->_update(array(
					'where' => array('id' => $this->input->post('id')),
					'table' => 'contact',
					'data' => $_update,
				));
				if($flag > 0){
					$this->load->library(array('mailbie'));
					$this->mailbie->sent(array(
						'to' => $this->input->post('email'),
						'cc' => '',
						'subject' => 'Trả lời thông tin liên hệ',
						'message' => mail_html_contact(array(
							'fullname' => $data['contact']['fullname'],
							'email' => $data['contact']['email'],
							'phone' => $data['contact']['phone'],
							'message' => $data['contact']['message'],
							'reply' => $this->input->post('reply'),

						))
					));
					$this->session->set_flashdata('message-success', 'Trả lời liên hệ thành công');
					redirect('contact/backend/contact/view');
				}
			}
		}
		
		$data['script'] = 'contact';
		$data['template'] = 'contact/backend/contact/viewDetail';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}

	
}