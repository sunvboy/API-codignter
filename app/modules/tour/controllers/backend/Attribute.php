<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attribute extends MY_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		if(!isset($this->auth) || is_array($this->auth) == FALSE || count($this->auth) == 0 ) redirect(BACKEND_DIRECTORY);
		$this->load->library(array('configbie'));
		$this->load->library('nestedsetbie', array('table' => 'attribute_catalogue'));
	}
	
	public function view($page = 1){
		$this->commonbie->permission("tour/backend/attribute/view", $this->auth['permission']);
		$page = (int)$page;
		$data['from'] = 0;
		$data['to'] = 0;

		$perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
		$keyword = $this->db->escape_like_str($this->input->get('keyword'));
		$catalogueid = (int)$this->input->get('catalogueid');
        $extend = '';
		if($catalogueid > 0){
            $extend = $extend.(!empty($extend))?' AND':''.' catalogueid = '.$catalogueid;
		}
		$join = [];
        $join[] =  array('attribute_catalogue','attribute_catalogue.id = attribute.catalogueid','inner');
        $config['total_rows'] = $this->Autoload_Model->_get_where(array(
            'select' => 'attribute.id',
            'table' => 'attribute',
            'where' => array('attribute.alanguage' => $this->fclang,'attribute_catalogue.tour' => 1),
            'join' => $join,
            'query' => $extend,
            'keyword' => '(attribute.title LIKE \'%'.$keyword.'%\' OR attribute.description LIKE \'%'.$keyword.'%\')',
            'count' => TRUE,
        ));

		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['base_url'] = base_url('attribute/backend/attribute/view');
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
            $data['listattribute'] = $this->Autoload_Model->_get_where(array(
                'select' => 'attribute.id,attribute.publish,attribute.title,attribute.created,attribute.order,attribute.canonical,attribute_catalogue.title as catalogue_title,(SELECT fullname FROM user WHERE user.id = attribute.userid_created) as user_created',
                'table' => 'attribute',
                'where' => array('attribute.alanguage' => $this->fclang,'attribute_catalogue.tour' => 1),
                'query' => $extend,
                'join' => $join,
                'limit' => $config['per_page'],
                'start' => $page * $config['per_page'],
                'keyword' => '(attribute.title LIKE \'%'.$keyword.'%\' OR attribute.description LIKE \'%'.$keyword.'%\')',
                'order_by' => 'attribute.catalogueid desc, attribute.id desc',
            ), TRUE);
		}
		$data['script'] = 'attribute';
		$data['config'] = $config;
		$data['template'] = 'tour/backend/attribute/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	
	public function Create(){
		$this->commonbie->permission("tour/backend/attribute/create", $this->auth['permission']);
		if($this->input->post('create')){
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			$this->form_validation->set_error_delimiters('','/');
			$this->form_validation->set_rules('title', 'Tiêu đề thuộc tính', 'trim|required');
			$this->form_validation->set_rules('catalogueid', 'Danh mục chính', 'trim|is_natural_no_zero');

			if($this->form_validation->run($this)){
				$_insert = array(
					'title' => htmlspecialchars_decode(html_entity_decode($this->input->post('title'))),
					'slug' => slug(htmlspecialchars_decode(html_entity_decode($this->input->post('title')))),
					'canonical' => slug($this->input->post('canonical')),
					'description' => $this->input->post('description'),
					'color' => $this->input->post('color'),
					'start_price' => (int)str_replace('.','',$this->input->post('start_price')),
					'end_price' => (int)str_replace('.','',$this->input->post('end_price')),
					'catalogueid' => $this->input->post('catalogueid'),
					'publish' => $this->input->post('publish'),
					'image' => $this->input->post('image'),
					'meta_title' => $this->input->post('meta_title'),
					'meta_description' => $this->input->post('meta_description'),
					'userid_created' => $this->auth['id'],
					'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
					'alanguage' => $this->fclang
				);
				$resultid = $this->Autoload_Model->_create(array(
					'table' => 'attribute',
					'data' => $_insert,
				));
				if($resultid > 0){
					$this->session->set_flashdata('message-success', 'Thêm thuộc tính mới thành công');
					redirect('attribute/backend/attribute/view');
				}
			}
		}
		$data['script'] = 'attribute';
		$data['template'] = 'tour/backend/attribute/create';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	
	public function Update($id = 0){
		$this->commonbie->permission("tour/backend/attribute/update", $this->auth['permission']);
		$id = (int)$id;
		$detailattribute = $this->Autoload_Model->_get_where(array(
			'select' => 'id, title, slug, color, canonical, description, meta_title, catalogueid, meta_description, image, publish, start_price, end_price',
			'table' => 'attribute',
			'where' => array('id' => $id,'alanguage' => $this->fclang),
		));
		if(!isset($detailattribute) || is_array($detailattribute) == false || count($detailattribute) == 0){
			$this->session->set_flashdata('message-danger', 'thuộc tính không tồn tại');
			redirect('tour/backend/attribute/view');
		}
		if($this->input->post('update')){
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			$this->form_validation->set_error_delimiters('','/');
			$this->form_validation->set_rules('title', 'Tiêu đề thuộc tính', 'trim|required');
			$this->form_validation->set_rules('catalogueid', 'Danh mục chính', 'trim|is_natural_no_zero');
			if($this->form_validation->run($this)){
				$_update = array(
					'title' => htmlspecialchars_decode(html_entity_decode($this->input->post('title'))),
					'slug' => slug(htmlspecialchars_decode(html_entity_decode($this->input->post('title')))),
					'canonical' => slug($this->input->post('canonical')),
					'description' => $this->input->post('description'),
					'color' => $this->input->post('color'),
					'start_price' => (int)str_replace('.','',$this->input->post('start_price')),
					'end_price' => (int)str_replace('.','',$this->input->post('end_price')),
					'catalogueid' => $this->input->post('catalogueid'),
					'meta_title' => $this->input->post('meta_title'),
					'meta_description' => $this->input->post('meta_description'),
					'publish' => $this->input->post('publish'),
					'image' => $this->input->post('image'),
					'userid_created' => $this->auth['id'],
					'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				);
				$flag = $this->Autoload_Model->_update(array(
					'where' => array('id' => $id),
					'table' => 'attribute',
					'data' => $_update,
				));
				if($flag > 0){

					$this->session->set_flashdata('message-success', 'Cập nhật thuộc tính thành công');
					redirect('tour/backend/attribute/view');
				}
			}
		}
		
		$data['script'] = 'attribute';
		$data['detailattribute'] = $detailattribute;
		$data['template'] = 'tour/backend/attribute/update';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	

	
}
