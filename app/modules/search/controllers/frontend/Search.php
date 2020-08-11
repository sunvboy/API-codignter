<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MY_Controller {
	public $module;
	function __construct() {
		parent::__construct();
		$this->load->library(array('configbie'));
		$this->load->helper(array('myfrontendcommon'));
		$this->module = array(
			'article' => 'Bài viết',
			'product' => 'Sản phẩm',
			'media' => 'Thư viện',	
		);
		$this->fc_lang = $this->config->item('fc_lang');
	}
	public function view($page = 1){
		$seoPage = '';
		$page = (int)$page;
		$keyword = $this->db->escape_like_str($this->input->get('keyword'));
        $param['catalogueid'] = $this->input->get('catalogueid');
        $query = '';
        if(!empty($param['catalogueid'])){
            $query = $query.'  tb3.catalogueid IN'.' ('.$param['catalogueid'].')';
        }
		$json = [];
        $json[] = array('catalogue_relationship as tb3', 'tb1.id = tb3.moduleid AND tb3.module = "product"', 'full');
		$module = 'product';
		if(!empty($module)){
			$config['total_rows'] = $this->Autoload_Model->_get_where(array(
				'distinct' => 'true',
				'select' => 'tb1.title',
				'table' =>'product as tb1',
				'join' => $json,
                'query' => $query,
				'keyword' => '(tb1.title LIKE \'%'.$keyword.'%\'  AND `tb1`.`publish` = 0  AND  `tb1`.`alanguage` = \''.$this->fc_lang.'\') ',
				'count'=>true,
			));
			$data['total_rows'] = $config['total_rows'];
			$config['base_url'] = base_url('tim-kiem');
			if($config['total_rows'] > 0){
				$this->load->library('pagination');
				$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
				$config['prefix'] = 'trang-';
				$config['first_url'] = $config['base_url'].$config['suffix'];
				$config['per_page'] = ($module == 'product') ? 28: 5;
				$config['uri_segment'] = 2;
				$config['use_page_numbers'] = TRUE;
				$config['full_tag_open'] = '';
				$config['full_tag_close'] = '';
				$config['first_tag_open'] = '';
				$config['first_tag_close'] = '';
				$config['last_tag_open'] = '';
				$config['last_tag_close'] = '';
				$config['cur_tag_open'] = '<a class="current">';
				$config['cur_tag_close'] = '</a>';
				$config['next_tag_open'] = '';
				$config['next_tag_close'] = '';
				$config['prev_tag_open'] = '';
				$config['prev_tag_close'] = '';
				$config['num_tag_open'] = '';
				$config['num_tag_close'] = '';
				$this->pagination->initialize($config);
				$data['PaginationList'] = $this->pagination->create_links();
				$totalPage = ceil($config['total_rows']/$config['per_page']);
				$page = ($page <= 0)?1:$page;
				$page = ($page > $totalPage)?$totalPage:$page;
				$seoPage = ($page >= 2)?(' - Trang '.$page):'';
				if($page >= 2){
					$data['canonical'] = $config['base_url'].'/trang-'.$page.$this->config->item('url_suffix');
				}
				$page = $page - 1;
				$data['productList'] = $this->Autoload_Model->_get_where(array(
					'distinct' => 'true',
					'select' =>'tb1.image,  tb1.customerid, tb1.title, tb1.price, tb1.price_sale, tb1.price_contact, tb1.id, tb1.canonical, tb1.viewed, tb1.order, tb1.catalogue, tb1.description',
					'table' => 'product as tb1',
					'limit' => $config['per_page'],
					'start' => $page * $config['per_page'],
					'keyword' => '(tb1.title LIKE \'%'.$keyword.'%\'  AND `tb1`.`publish` = 0  AND  `tb1`.`alanguage` = \''.$this->fc_lang.'\') ',
					'join' => $json,
                    'query' => $query,
                    'order_by' => 'tb1.order desc, tb1.id desc',
				), true);
			}
			$data['module'] = $module;
			$data['template'] = 'search/frontend/search/view';
		}else{
			$temp = '';
			foreach($this->module as $key => $val){
				$temp[] = array(
					'result' => array(
						'module' => $key,
						'title' => $val,
						'data' => $this->Autoload_Model->_get_where(array(
							'select' => 'tb1.id, tb1.title, tb1.slug, tb1.canonical, tb1.image, tb1.created, tb1.description, tb1.viewed, '.(($key == 'product') ? 'tb1.price, tb1.price_sale, tb1.quantity_dau_ki, tb1.quantity_cuoi_ki' : '').'',
							'table' => $key.' as tb1',
							'query' => '(id IN (SELECT moduleid FROM tag_relationship WHERE module = \''.$key.'\' AND tagid = '.$tagid.'))',
							'where' => array('publish' => 0),
							'limit' => 5,
							'order_by' => 'tb1.id desc, tb1.order asc',
						),TRUE)
					)
				);
			}
			$data['objectTag'] = $temp;
		}
		if(!isset($data['canonical']) || empty($data['canonical'])){
			$data['canonical'] = $config['base_url'].$this->config->item('url_suffix');
		}
		$data['meta_title'] = 'Kết quả tìm kiếm cho từ khóa: '.$this->input->get('keyword').''.$seoPage;
		$data['meta_image'] = !empty($detailTag['image'])?base_url($detailTag['image']):'';
		$this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);
	}
	public function viewCuahang($page = 1){
		$seoPage = '';
		$page = (int)$page;
		$keyword = $this->db->escape_like_str($this->input->get('keyword'));

		$config['total_rows'] = $this->Autoload_Model->_get_where(array(
			'distinct' => 'true',
			'select' => 'id',
			'table' =>'customer',
			'keyword' => '(account LIKE \'%'.$keyword.'%\')',
			'count'=>true,
		));
		$data['total_rows'] = $config['total_rows'];
		$config['base_url'] = base_url('tim-kiem-cua-hang');
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['prefix'] = 'trang-';
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 28;
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<ul>';
			$config['full_tag_close'] = '</ul>';
			$config['first_tag_open'] = '';
			$config['first_tag_close'] = '';
			$config['last_tag_open'] = '';
			$config['last_tag_close'] = '';
			$config['cur_tag_open'] = '<a class="active">';
			$config['cur_tag_close'] = '</a>';
			$config['next_tag_open'] = '';
			$config['next_tag_close'] = '';
			$config['prev_tag_open'] = '';
			$config['prev_tag_close'] = '';
			$config['num_tag_open'] = '';
			$config['num_tag_close'] = '';
			$this->pagination->initialize($config);
			$data['PaginationList'] = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$seoPage = ($page >= 2)?(' - Trang '.$page):'';
			if($page >= 2){
				$data['canonical'] = $config['base_url'].'/trang-'.$page.$this->config->item('url_suffix');
			}
			$page = $page - 1;
			$data['relaListCustomer'] = $this->Autoload_Model->_get_where(array(
				'distinct' => 'true',
				'select' => 'id,account,images,(SELECT title FROM product_catalogue WHERE product_catalogue.id = customer.product_catalogue_id) as catalogue,(SELECT canonical FROM product_catalogue WHERE product_catalogue.id = customer.product_catalogue_id) as canonical_catalogue',
				'table' => 'customer',
				'limit' => $config['per_page'],
				'start' => $page * $config['per_page'],
				'keyword' => '(account LIKE \'%'.$keyword.'%\')',
				'order_by' => 'id desc',
			), true);
		}
		if(!isset($data['canonical']) || empty($data['canonical'])){
			$data['canonical'] = $config['base_url'].$this->config->item('url_suffix');
		}
		$data['meta_title'] = 'Kết quả tìm kiếm cho từ khóa: '.$this->input->get('keyword').''.$seoPage;
		$data['meta_image'] = !empty($detailTag['image'])?base_url($detailTag['image']):'';
		$data['template'] = 'search/frontend/search/viewCuahang';
		$this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);
	}
	
}
