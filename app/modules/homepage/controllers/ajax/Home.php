<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {


	public function __construct(){
		parent::__construct();
		$this->fc_lang = $this->config->item('fc_lang');

	}
	
	public function whois(){
		define('USERNAME','');//Username đại lý
		define('API_KEY','');//API KEY
		define('API_URL','https://daily.pavietnam.vn/interface.php');//Link API (Mặc định đang là link API test)
		$error = '';
		$domain 	= $this->input->post('domain');
		$result 	= file_get_contents(API_URL."?cmd=check_whois&apikey=".API_KEY."&username=".USERNAME."&domain=".$domain);
		if($result == '0')//Tên miền đã được đăng ký
		{
			$error['flag'] = '1';
			$error['message'] = 'Không thể đăng ký';
		}
		else if($result == '1')//Tên miền chưa đăng ký
		{
			$error['flag'] = '0';
			$error['message'] = 'Có thể đăng ký';
		}
		else//Các trường hợp lỗi khi truy cập API
		{
			echo "<span style='color:#F00'>$result</span>";
		}
		
		
		echo json_encode($error);die();	
	}
	public function ajax_listCuahang(){
		$id = $this->input->post('id');
		$detailCustomer = $this->Autoload_Model->_get_where(array(
			'select' => 'id,account',
			'table' => 'customer',
			'where' => array('id' => $id)
		));
		if (!isset($detailCustomer) || is_array($detailCustomer) == false || count($detailCustomer) == 0) {
			echo json_encode(array(
				'html' => 'Dữ liệu đang được cập nhập',
				'pagination' => '',
			));
			die();
		}
		$page = $this->input->post('page');
		$page = (int)$page;
		$config['total_rows'] = $this->Autoload_Model->_get_where(array(
			'select' => 'tb1.id',
			'table' => 'product as tb1',
			'where' => array('tb1.publish' => 0, 'tb1.customerid' => $id, 'tb1.alanguage' => $this->fc_lang),
			'distinct' => 'true',
			'count' => TRUE,
		));
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['base_url'] ='#" data-page="';
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 18;
			$config['cur_page'] = $page;
			$config['page'] = $page;
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['reuse_query_string'] = TRUE;
			$config['full_tag_open'] = '<div class="pagenavi"><ul class="ajax-pagination"><li>';
			$config['full_tag_close'] = '</li></ul></div>';
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
			$data['listPagination'] = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			// print_r($data['listPagination']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$productList = $this->Autoload_Model->_get_where(array(
				'distinct' => 'true',
				'select' => '`id`, `customerid`, `title`,`slug`, `canonical`,`image`,`price`,`price_sale`,`price_contact`,`description`,`time_sale`,`mota`,`khuyenmai`',
				'table' => 'product',
				'where' => array('publish' => 0, 'customerid' => $id, 'alanguage' => $this->fc_lang),
				'limit' => $config['per_page'],
				'start' => $page * $config['per_page'],
				'order_by' => 'order asc,id desc',
			), true);
		}
		$html = '';
		$pagination = '';
		if(isset($productList) && is_array($productList) && count($productList)){
			foreach($productList as $key => $val){
				$title = $val['title'];
				$href = rewrite_url($val['canonical'], TRUE, TRUE);
				$getPrice = getPriceFrontend(array('productDetail' => $val));
				$html = $html.'<div class="col-md-2 col-xs-6 col-sm-3"><div class="item">
                            <div class="image">
                                <a href="'.$href.'"><img src="'.$val['image'].'" alt="'.$title.'"></a>
                            </div>
                            <div class="nav-image">
                                <h3 class="title"><a href="'.$href.'">'.$title.'</a></h3>
                                <p class="price">'.$getPrice['price_final'].'  <span class="start"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span></p>
                                <p class="shop-vp"><img src="template/frontend/images/icon4.png" alt="'.$detailCustomer['account'].'">'.$detailCustomer['account'].'</p>
                            </div>
                        </div></div>';
			}
			$html = $html.'<div class="clearfix"></div>';
			$pagination = $pagination . '<div class="ajax-pagination">'.$data['listPagination'].'</div>';
		}else{
			$html = $html.'<div class="col-md-12">Dữ liệu đang được cập nhập...</div>';
		}
		echo json_encode(array(
			'html' => $html,
			'pagination' => $pagination,
		));
		die();
	}

}
