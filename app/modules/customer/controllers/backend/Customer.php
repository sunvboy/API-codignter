<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		$this->load->library(array('configbie'));
		// if(!isset($this->auth)) redirect('admin');
		$this->load->library('nestedsetbie', array('table' => 'customer_catalogue'));

	}
	
	public function test(){
		$menu = array(
			array(
				'id' => 1,
				'title' => 'Menu 1',
				'parentid' => 0,
			),
			array(
				'id' => 2,
				'title' => 'Menu 2',
				'parentid' => 0,
			),
			array(
				'id' => 3,
				'title' => 'Menu 3',
				'parentid' => 0,
			),
			array(
				'id' => 4,
				'title' => 'Menu 4',
				'parentid' => 0,
			),
			array(
				'id' => 5,
				'title' => 'Menu 1.1',
				'parentid' => 1,
			),
			array(
				'id' => 6,
				'title' => 'Menu 1.2',
				'parentid' => 1,
			),
			array(
				'id' => 7,
				'title' => 'Menu 2.1',
				'parentid' => 2,
			),
			array(
				'id' => 8,
				'title' => 'Menu 2.1.1',
				'parentid' => 7,
			),
			array(
				'id' => 9,
				'title' => 'Menu 3.1',
				'parentid' => 3,
			),
			array(
				'id' => 10,
				'title' => 'Menu 4.1',
				'parentid' => 4,
			),
			array(
				'id' => 11,
				'title' => 'Menu 3.2',
				'parentid' => 3,
			),
			array(
				'id' => 12,
				'title' => 'Menu 4.2',
				'parentid' => 4,
			),
			array(
				'id' => 13,
				'title' => 'Menu 4.2.1',
				'parentid' => 12,
			),
			array(
				'id' => 14,
				'title' => 'Menu 4.2.2',
				'parentid' => 12,
			),
		);
		// echo '<pre>';
		// print_r($menu);
		
		// $temp = '';
		// foreach($menu as $key => $val){
			// if($val['parentid'] == 0){
				// $temp[$key] = $val;
				// unset($menu[$key]);
				// foreach($menu as $key1 => $val1){
					// if($val1['parentid'] == $val['id']){
						// $temp[$key]['sub'][] = $val1;
						// unset($menu[$key1]);
						// foreach($menu as $key2 => $val2){
							// if($val2['parentid'] == $val1['id']){
								// foreach($temp[$key]['sub'] as $kt => $vt){}
								// $temp[$key]['sub'][$kt]['child'][] = $val2;
							// }
						// }
					// }
				// }
			// }
		// }
		// echo '<pre>';
		// print_r($temp);
		$this->recursive($menu);
	}
	
	public function recursive($data , $parentid = 0, $text = ''){
		foreach($data as $k => $v){
			if($v['parentid'] == $parentid){
				echo $text.$v['title']."<br/>";
				unset($data[$k]);
				$id = $v['id'];
				$this->recursive($data, $id, $text."--");
			}
		}
	}
	
	public function view($page = 1){
		$this->commonbie->permission("customer/backend/customer/view", $this->auth['permission']);
		$page = (int)$page;
		$data['from'] = 0;
		$data['to'] = 0;
		$config['total_rows'] = $this->Autoload_Model->_get_where(array(
			'select' => 'id',
			'table' => 'customer',
			'count' => TRUE,
		));
		if($config['total_rows'] > 0){


            $this->load->library('pagination');
            $config['base_url'] = base_url('customer/backend/customer/view');
            $config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
            $config['first_url'] = $config['base_url'].$config['suffix'];
            $config['per_page'] = 10;
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
			$data['listCustomer'] = $this->Autoload_Model->_get_where(array(
				'select' => 'id,publish, fullname, email, phone, address, gender, created, catalogue_title,avatar,account,shop_link,ishome,catalogue_title',
				'table' => 'customer',
				'limit' => $config['per_page'],
				'start' => $page * $config['per_page'],
				'order_by' => 'publish desc, ishome desc, fullname asc, created desc',
			), TRUE);
		}
		
		$data['config'] = $config;
		$data['script']='customer';
		$data['template'] = 'customer/backend/customer/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	public function create(){
		$this->commonbie->permission("customer/backend/customer/create", $this->auth['permission']);
		if($this->input->post('create')){
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			$this->form_validation->set_error_delimiters('- ' , '</br>');
			$this->form_validation->set_rules('fullname','Họ tên','trim|required');
			$this->form_validation->set_rules('birthday','Ngày sinh','trim|required');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('catalogueid','Nhóm khách hàng','trim|required|is_natural_no_zero');
			if($this->form_validation->run($this)){
				$catalogue = $this->Autoload_Model->_get_where(array(
					'select' => 'title',
					'table' => 'customer_catalogue',
					'where' => array('id' => $this->input->post('catalogueid')),
				));
				
				$catalogueTitle = '';
				if(isset($catalogue) && is_array($catalogue) && count($catalogue)){
					$catalogueTitle = $catalogue['title'];
				}
				
				$_insert = array(
					'catalogueid' => $this->input->post('catalogueid'),
					'catalogue_title' => $catalogueTitle,
					'fullname' => htmlspecialchars_decode(html_entity_decode($this->input->post('fullname'))),
					'email' => $this->input->post('email'),
					'birthday' => convert_time($this->input->post('birthday')),
					'gender' => (int)$this->input->post('gender'),
					'address' => $this->input->post('address'),
					'phone' => $this->input->post('phone'),
					'cityid' => $this->input->post('cityid'),
					'districtid' => $this->input->post('districtid'),
					'wardid' => $this->input->post('wardid'),
					'description' => $this->input->post('description'),
					'publish' => 0,
					'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				);
				
				
				$insertId = $this->Autoload_Model->_create(array(
					'table' => 'customer',
					'data' => $_insert,
				));
				if($insertId > 0){
					$this->session->set_flashdata('message-success', 'Thêm khách hàng thành công'); 
					redirect(site_url('customer/backend/customer/create')); 
				}
			}
		}
		
		$data['script'] = 'customer';
		$data['template'] = 'customer/backend/customer/create';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
		
	public function update($id = 0){
		$this->commonbie->permission("customer/backend/customer/update", $this->auth['permission']);
		$id = (int)$id;
		$detailCustomer = $this->Autoload_Model->_get_where(array(
			'select' => 'id, catalogueid, account, fullname, email, birthday, gender, address, phone, cityid, districtid, wardid, description',
			'table' => 'customer',
			'where' => array('id' => $id)
		));
		if(!isset($detailCustomer) || is_array($detailCustomer) == FALSE || count($detailCustomer) == 0){
			$this->session->set_flashdata('message-danger', 'Tài khoản thành viên không tồn tại'); 
			redirect(site_url('customer/backend/customer/view')); 
		}
		
		if($this->input->post('update')){
			$data['cityPost'] = $this->input->post('cityid');
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			// $this->form_validation->set_rules('account','Tài khoản','trim|required');
			$this->form_validation->set_rules('fullname','Họ tên','trim|required');
			$this->form_validation->set_rules('catalogueid','Nhóm thành viên','trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			if($this->form_validation->run($this)){
				$catalogue = $this->Autoload_Model->_get_where(array(
					'select' => 'title',
					'table' => 'customer_catalogue',
					'where' => array('id' => $this->input->post('catalogueid')),
				));
				
				$catalogueTitle = '';
				if(isset($catalogue) && is_array($catalogue) && count($catalogue)){
					$catalogueTitle = $catalogue['title'];
				}
				$_update = array(
					'catalogueid' => $this->input->post('catalogueid'),
					'catalogue_title' => $catalogueTitle,
					'account' => $this->input->post('account'),
					'fullname' => htmlspecialchars_decode(html_entity_decode($this->input->post('fullname'))),
					'email' => $this->input->post('email'),
					'birthday' => convert_time($this->input->post('birthday')),
					'gender' => (int)$this->input->post('gender'),
					'address' => $this->input->post('address'),
					'phone' => $this->input->post('phone'),
					'cityid' => $this->input->post('cityid'),
					'districtid' => $this->input->post('districtid'),
					'wardid' => $this->input->post('wardid'),
					'description' => $this->input->post('description'),
					'publish' => 0,
					'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				);
				$flag = $this->Autoload_Model->_update(array(
					'where' => array('id' => $id),
					'table' => 'customer',
					'data' => $_update
				));
				if($flag > 0){
					$this->session->set_flashdata('message-success', 'Cập nhật tài khoản khoản thành công');
					redirect(site_url('customer/backend/customer/update/'.$id.''));
				}
			}
		}
		
		$data['detailCustomer'] = $detailCustomer;
		$data['script'] = 'customer';
		$data['template'] = 'customer/backend/customer/update';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}	
	public function config(){
		$this->commonbie->permission("customer/backend/customer/config", $this->auth['permission']);
		$detailConfig = $this->Autoload_Model->_get_where(array(
			'select' => 'appId, secret, google_client_id, google_client_secret',
			'table' => 'customer_config',
			'where' => array('id' => 1)
		));
		if($this->input->post('update')){
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			$this->form_validation->set_error_delimiters('- ' , '</br>');
			$this->form_validation->set_rules('appId','AppId facebook','trim|required');
			$this->form_validation->set_rules('secret','Secret facebook','trim|required');
			$this->form_validation->set_rules('google_client_id','Google client id','trim|required');
			$this->form_validation->set_rules('google_client_secret','Google client secret','trim|required');
			if($this->form_validation->run($this)){

				$_update = array(
					'appId' => htmlspecialchars_decode(html_entity_decode($this->input->post('appId'))),
					'secret' => $this->input->post('secret'),
					'google_client_id' => $this->input->post('google_client_id'),
					'google_client_secret' => $this->input->post('google_client_secret'),
					'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
					'userid_created' => $this->auth['id'],
				);
				$insertId = $this->Autoload_Model->_update(array(
					'where' => array('id' => 1),
					'table' => 'customer_config',
					'data' => $_update
				));
				if($insertId > 0){
					$this->session->set_flashdata('message-success', 'Cập nhập thành công');
					redirect(site_url('customer/backend/customer/config'));
				}
			}
		}
		$data['script'] = 'customer';
		$data['detailConfig'] = $detailConfig;
		$data['template'] = 'customer/backend/customer/config';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
}
