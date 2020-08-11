<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		$this->load->library(array('configbie'));
		$this->load->library('nestedsetbie', array('table' => 'product_catalogue'));
		$this->load->helper('myproduct');
		$this->module = 'product';
		$this->fc_lang = $this->config->item('fc_lang');
		if(empty($this->FT_auth['id'])){
			$this->session->set_flashdata('message-danger', 'Bạn phải đăng nhập để sử dụng tính năng này');
			redirect(base_url());
		}
	

	}
	public function status(){
		$id = $this->input->post('objectid');
		$object = $this->Autoload_Model->_get_where(array(
			'select' => 'id, publish',
			'table' => 'product',
			'where' => array('id' => $id),
		));

		$_update['publish'] = (($object['publish'] == 1)?0:1);
		$this->Autoload_Model->_update(array(
			'where' => array('id' => $id),
			'table' => 'product',
			'data' => $_update,
		));
	}
	public function view($page = 1){
		$data['attribute_catalogue'] = $this->Autoload_Model->_get_where(array(
			'table' => 'attribute_catalogue',
			'count' => 'true',
		),true);
		$page = (int)$page;
		$query = '';
		$data['from'] = 0;
		$data['to'] = 0;
		$perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 28;
		$keyword = $this->input->get('keyword');
		if(!empty($keyword)){
			$keyword = '(title LIKE \'%'.$keyword.'%\' OR description LIKE \'%'.$keyword.'%\')';
		}
		$catalogueid = ($this->input->get('catalogueid')) ? $this->input->get('catalogueid') : '';

		if(!empty($catalogueid)){
			$query = 'catalogueid =  '.$catalogueid;
			$detailCatalogue = $this->Autoload_Model->_get_where(array(
				'select' => 'id, attrid',
				'table' => 'product_catalogue',
				'where' => array('id' => $catalogueid),
			));
			$data['attribute_catalogue'] = getListAttr($detailCatalogue['attrid']);
		}

		$config['total_rows'] = $this->Autoload_Model->_get_where(array(
			'select' => 'id',
			'table' => 'product',
			'where' => array('customerid' => $this->FT_auth['id'],'alanguage' => $this->fc_lang),
			'keyword' => $keyword,
			'count' => TRUE,
		));
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['base_url'] = base_url('list-product');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = $perpage;
			$config['cur_page'] = $page;
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<div class="pagenavi"><ul><li>';
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
			$data['PaginationList'] = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$data['from'] = ($page * $config['per_page']) + 1;
			$data['to'] = ($config['per_page']*($page+1) > $config['total_rows']) ? $config['total_rows']  : $config['per_page']*($page+1);
			$data['listData'] = $this->Autoload_Model->_get_where(array(
				'select' => 'id, title, canonical, image, publish, order, price, price_sale, quantity_cuoi_ki, quantity_dau_ki, catalogue,  ishome,  highlight,  isaside,  isfooter, (SELECT account FROM user WHERE user.id = product.userid_created) as user_created, version, viewed, catalogueid, (SELECT title FROM product_catalogue WHERE product_catalogue.id = product.catalogueid) as catalogue_title, price_contact',
				'table' => 'product',
				'where' => array('customerid' => $this->FT_auth['id'],'alanguage' => $this->fc_lang),
				'query' => $query,
				'limit' => $config['per_page'],
				'start' => $page * $config['per_page'],
				'keyword' => $keyword,
				'order_by' => 'order asc, id desc',
			), TRUE);
		}
		
		$data['script'] = 'product';
		$data['canonical'] = base_url('list-product');
		$data['meta_title'] = "Quản lý sản phẩm";
		$data['meta_description'] = "Quản lý sản phẩm";
		$data['og_type'] = 'product';
		$data['config'] = $config;
		$data['template'] = 'user/frontend/product/view';
		$this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);
	}
	
	public function Create(){
		$data['detailCustomer'] = $this->Autoload_Model->_get_where(array(
			'select' => 'id, product_catalogue_id',
			'table' => 'customer',
			'where' => array('id' => $this->FT_auth['id'])
		));
		$attribute_catalogue = $this->Autoload_Model->_get_where(array(
			'table' => 'attribute_catalogue',
			'where' => array('alanguage' => $this->fclang),
			'count' => 'true',
		),true);
		$data['countAttribute_catalogue'] = $attribute_catalogue;
		if($this->input->post('create')){
			$album=$this->input->post('album');
			$data = getDataPost($data);
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			$this->form_validation->set_error_delimiters('','/');
			$this->form_validation->set_rules('title', 'Tiêu đề sản phẩm', 'trim|required');
			$this->form_validation->set_rules('catalogueid', 'Danh mục sản phẩm', 'trim|is_natural_no_zero');
			$this->form_validation->set_rules('canonical', 'Đường dẫn bài viết', 'trim|required|callback__CheckCanonical');
			$this->form_validation->set_rules('description', 'Nội dung', 'trim|required');
			if($this->form_validation->run($this)){


				$_insert = array(
					'title' => htmlspecialchars_decode(html_entity_decode($this->input->post('title'))),
					'slug' => slug(htmlspecialchars_decode(html_entity_decode($this->input->post('title')))),
					'canonical' => slug($this->input->post('canonical')),
					'description' => $this->input->post('description'),
					'catalogueid' => $this->input->post('catalogueid'),
					'publish' => $this->input->post('publish'),
					'image' => !empty(is($album[0]))?is($album[0]):'template/not-found.png',
					'image_json' => is(base64_encode(json_encode($album))),
					'customerid' => $this->FT_auth['id'],
					'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
					'price' => $this->input->post('price'),
					'price_sale' => $this->input->post('price_sale'),
					'price_contact' => is($this->input->post('price_contact')),
					//'code' => $this->input->post('code'),
					'nationality' => $this->input->post('nationality'),
					//'time_sale' => $this->input->post('time_sale'),
					//'mota' => $this->input->post('mota'),
					//'khuyenmai' => $this->input->post('khuyenmai'),
					'publish_time' => merge_time($this->input->post('post_date'), $this->input->post('post_time')),
					'alanguage' => $this->fc_lang
				);
				$resultid_main = $this->Autoload_Model->_create(array(
					'table' => 'product',
					'data' => $_insert,
				));
				if($resultid_main > 0){
					$canonical = slug($this->input->post('canonical'));
					createData($data, $resultid_main, $canonical);
					$this->session->set_flashdata('message-success', 'Thêm sản phẩm mới thành công');
					redirect('list-product');
				}
			}
		}
		$data['script'] = 'product';
		$data['meta_title'] = "Thêm mới sản phẩm";
		$data['meta_description'] = "Thêm mới sản phẩm";
		$data['og_type'] = 'product';
		$data['template'] = 'user/frontend/product/create';
		$this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);
	}
	public function Update(){

		$id = (int)$_GET['id'];
		$attribute_catalogue = $this->Autoload_Model->_get_where(array(
			'table' => 'attribute_catalogue',
			'where' => array('alanguage' => $this->fclang),

			'count' => 'true',
		),true);
		$data['countAttribute_catalogue'] = $attribute_catalogue;
		$product = $this->Autoload_Model->_get_where(array(
			'select' => 'id,nationality,time_sale,mota,khuyenmai, code, title, slug, canonical, description, meta_title, meta_description, tag, catalogueid, catalogue, brandid, image, image_json, price, price_sale, price_contact,  barcode, inventory, quantity_dau_ki, quantity_cuoi_ki, wholesale, wholesale_json, version_json, publish, publish_time, unlimited_sale, image_color_json, made_in, model, extend_description, video, icon_hot, prd_rela, file_price',
			'table' => 'product',
			'where' => array('customerid' => $this->FT_auth['id'],'id' => $id,'alanguage' => $this->fc_lang),
		));
		if(!isset($product) || is_array($product) == false || count($product) == 0){
			$this->session->set_flashdata('message-danger', 'sản phẩm không tồn tại');
			redirect('list-product');
		}
		$data['product']=$product;
		$data['image_color'] = json_decode(base64_decode($product['image_color_json']), true);
		$data['image_json'] = json_decode(base64_decode($product['image_json']), true);
//Kiểm tra xem sản phẩm có nằm trong chương trình khuyến mại nào không
		$current = gmdate('Y-m-d H:i:s', time() + 7*3600);
		$query = ' AND tb2.publish =  1 AND tb2.start_date  <=  "'.$current. '" AND ( tb2.end_date >= "'.$current.'" OR tb2.end_date = "0000-00-00 00:00:00" ) ';
		$promotional = $this->Autoload_Model->_get_where(array(
			'select' => 'tb2.id, tb2.catalogue, tb2.title, tb2.canonical, tb2.created, tb2.image_json, tb2.module, tb2.start_date, tb2.end_date, tb2.publish, tb2.discount_type, tb2.discount_value, tb2.condition_value, tb2.condition_type, tb2.freeship, tb2.freeshipAll, tb2.condition_value_1, tb2.condition_type_1, tb2.use_common, tb2.code, tb2.limmit_code, tb2.cityid, tb2.discount_moduleid',
			'table' => 'promotional',
			'table' => 'promotional_relationship as tb1',
			'join' => array(
				array('promotional as tb2', 'tb1.promotionalid = tb2.id', 'inner'),
			),
			'query' => 'tb1.module = "product" AND tb1.moduleid = '.$id.$query,
		),true);
		if(check_array($promotional)){
			foreach ($promotional as $key => $value) {
				$promotional1 = json_decode(getPromotional($value), true);
				$data['promotional'][$key] = $value;
				$data['promotional'][$key]['use_common'] = $promotional1['use_common'];
				$data['promotional'][$key]['detail'] = $promotional1['detail'];
			}
		}

		$version_json = json_decode(base64_decode($product['version_json']), true);
		$data['price_contact'] =$product['price_contact'];
		$data['inventory'] =$product['inventory'];

		$data['attribute'] = $version_json[2];
		if(isset($data['attribute']) && is_array($data['attribute']) && count($data['attribute'])){
			foreach ($data['attribute'] as $key => $value) {
				if($value == ''){
					$data['attribute_json'][$key]['json']='';
				}else{
					$data['attribute_json'][$key]['json']=base64_encode(json_encode($value));
				}
			}
		}

		$data['checkbox']= $version_json[0];
		$data['attribute_catalogue']= $version_json[1];
		if(isset($version_json[1]) && is_array($version_json[1]) && count($version_json[1])){
			foreach ($version_json[1] as $key => $value) {
				if($value == 2){
					if(isset($version_json[2][$key]) && is_array($version_json[2][$key]) && count($version_json[2][$key])){
						$color= $this->Autoload_Model->_get_where(array(
							'select' => 'id, title, color',
							'table' => 'attribute',
							'where_in' => $version_json[2][$key],
							'where_in_field' => 'id',
						),true);
						foreach ($color as $key => $value) {
							$data['color'][$value['id']]['title'] = $value['title'];
							$data['color'][$value['id']]['color'] = $value['color'];
						}
					}
				}
			}
		}


		$data['image_color'] = json_decode(base64_decode($product['image_color_json']), true);
		$data['image_json'] = json_decode(base64_decode($product['image_json']), true);
		$product_version = $this->Autoload_Model->_get_where(array(
			'select' => 'code_version, title, image, price_version,  barcode_version, attribute1, attribute2',
			'table' => 'product_version',
			'where' => array('productid' => $id),
			'order_by'=>'id ASC'
		),true);

		foreach ($product_version as $key => $val) {
			$data['image_version'][]=$val['image'];
			$data['title_version'][]=$val['title'];
			$data['price_version'][]=$val['price_version'];
			$data['code_version'][]=$val['code_version'];
			$data['barcode_version'][]=$val['barcode_version'];
			$data['attribute1'][] = $val['attribute1'];
			$data['attribute2'][] = $val['attribute2'];
		}
		if(isset($data['title_version']) && is_array($data['title_version']) && count($data['title_version'])){
			$data['version']= count($data['title_version']);
		}else{
			$data['version'] = 0;
		}

		$data['wholesale'] =0;
		if(isset($data['price_wholesale']) && is_array($data['price_wholesale']) && count($data['price_wholesale'])){
			$data['wholesale'] =1;
		}

		$product_wholesale = $this->Autoload_Model->_get_where(array(
			'select' => 'quantity_start, quantity_end, price_wholesale',
			'table' => 'product_wholesale',
			'where' => array('productid' => $id),
			'order_by'=>'id ASC'
		),true);
		foreach ($product_wholesale as $key => $val) {
			$data['quantity_start'][]=$val['quantity_start'];
			$data['quantity_end'][]=$val['quantity_end'];
			$data['price_wholesale'][]=$val['price_wholesale'];
		}

		$data['brandid'] = $product['brandid'];
		if($this->input->post('update')){

			$album = $this->input->post('album');

			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			$this->form_validation->set_error_delimiters('','/');
			$this->form_validation->set_rules('title', 'Tiêu đề sản phẩm', 'trim|required');
			$this->form_validation->set_rules('catalogueid', 'Danh mục sản phẩm', 'trim|is_natural_no_zero');
			$this->form_validation->set_rules('canonical', 'Đường dẫn bài viết', 'trim|required|callback__CheckCanonical');
			$this->form_validation->set_rules('description', 'Nội dung', 'trim|required');

			if($this->form_validation->run($this)){
				$album = $this->input->post('album');
				$data = getDataPost($data);
				$_update = array(
					'title' => htmlspecialchars_decode(html_entity_decode($this->input->post('title'))),
					'slug' => slug(htmlspecialchars_decode(html_entity_decode($this->input->post('title')))),
					'canonical' => slug($this->input->post('canonical')),
					'description' => $this->input->post('description'),
                    'catalogueid' => $this->input->post('catalogueid'),
					'publish' => $this->input->post('publish'),
					'image' => !empty(is($album[0]))?is($album[0]):'template/not-found.png',
					'image_json' => is(base64_encode(json_encode($album))),
					'customerid' => $this->FT_auth['id'],
					'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
                    'price' => $this->input->post('price'),
                    'price_sale' => $this->input->post('price_sale'),
					'price_contact' => is($this->input->post('price_contact')),
					'publish_time' => merge_time($this->input->post('post_date'), $this->input->post('post_time')),
					'nationality' => $this->input->post('nationality'),
					//'time_sale' => $this->input->post('time_sale'),
					//'khuyenmai' => $this->input->post('khuyenmai'),
					//'mota' => $this->input->post('mota'),
					//'code' => $this->input->post('code'),
				);
				

				$flag = $this->Autoload_Model->_update(array(
					'where' => array('id' => $id),
					'table' => 'product',
					'data' => $_update,
				));
				if($flag > 0){
					// tạo đường dẫn cho sản phẩm
					$this->Autoload_Model->_delete(array(
						'where' => array('canonical' => $product['canonical'],'uri' => 'product/frontend/product/view','param' => $id),
						'table' => 'router',
					));
					
					// thêm danh mục cha vào bảng catalogue_relationship để sau này search
					$this->Autoload_Model->_delete(array(
						'where' => array('module' => 'product','moduleid' => $id),
						'table' => 'catalogue_relationship',
					));
					
					// thêm tag vào bảng tag_relationship để dễ dàng search
					$this->Autoload_Model->_delete(array(
						'where' => array('module' => 'product','moduleid' => $id),
						'table' => 'tag_relationship',
					));

					// thêm phiên bản sản phẩm
					$this->Autoload_Model->_delete(array(
						'where' => array('productid' => $id),
						'table' => 'product_version',
					));

					//thêm thuộc tính
					$this->Autoload_Model->_delete(array(
						'where' => array('moduleid' => $id, 'module' =>'product'),
						'table' => 'attribute_relationship',
					));

					// thêm bán buôn
					$this->Autoload_Model->_delete(array(
						'where' => array('productid' => $id),
						'table' => 'product_wholesale',
					));

					$canonical = slug($this->input->post('canonical'));
					createData($data, $id, $canonical);
					$this->session->set_flashdata('message-success', 'Cập nhật sản phẩm mới thành công');
					redirect('list-product');
				}
			}
		}
		$data['module'] = "product";
		$data['meta_title'] = "Cập nhập sản phẩm";
		$data['meta_description'] = "Cập nhập sản phẩm";
		$data['og_type'] = 'product';
		$data['script'] = 'product';
		$data['template'] = 'user/frontend/product/update';
		$this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);
	}

	public function _CheckCanonical($canonical = ''){
		$originalCanonical = $this->input->post('original_canonical');
		if($canonical != $originalCanonical){
			$crc32 = sprintf("%u", crc32(slug($canonical)));
			$router = $this->Autoload_Model->_get_where(array(
				'select' => 'id',
				'table' => 'router',
				'where' => array('crc32' => $crc32),
				'count' => TRUE
			));
			if($router > 0){
				$this->form_validation->set_message('_CheckCanonical','Đường dẫn đã tồn tại, hãy chọn một đường dẫn khác');
				return false;
			}
		}
		return true;
	}
	public function ajax_delete_product(){
		$param['id'] = (int)$this->input->post('id');
		$param['router'] = $this->input->post('router');

		if($param['router'] != '' && !empty($param['router'])){
			$router = $this->Autoload_Model->_delete(array(
				'where' => array('canonical' => $param['router']),
				'table' => 'router',
			));
		}
		//xóa phiên bản
		$this->Autoload_Model->_delete(array(
			'where' => array('productid' => $param['id']),
			'table' => 'product_version'
		));
		// xóa bán buôn bán lẻ
		$this->Autoload_Model->_delete(array(
			'where' => array('productid' => $param['id']),
			'table' => 'product_wholesale'
		));
		// xóa thuộc tính
		$this->Autoload_Model->_delete(array(
			'where' => array('moduleid' => $param['id'], 'module' => 'product'),
			'table' => 'attribute_relationship'
		));
		// xóa nhóm thuộc tính trong nhóm danh mục
		// $product = $this->Autoload_Model->_get_where(array(
		// 	'select' => 'version_json',
		// 	'table' => 'product',
		// 	'where' => array('id' => $param['id']),
		// ));
		// $version_json = json_decode(base64_decode($product['version_json']));
		// $product_catalogue = $this->Autoload_Model->_get_where(array(
		// 	'select' => 'attrid',
		// 	'table' => 'product_catalogue',
		// 	'where' => array('id' => $param['catalogueid']),
		// ));
		// $attrid=is(json_decode($product_catalogue['attrid'],true));
		// $attrid_old= $version_json[1];
		// foreach($attrid_old as $key => $val){
		// 	foreach ($attrid as $sub => $subs) {
		// 		if($val == $subs){
		// 			unset($attrid[$sub]);
		// 		}
		// 	}
		// }
		// $_update_attrid = array(
		// 	'attrid' => json_encode($attrid),
		// );
		// $this->Autoload_Model->_update(array(
		// 	'where' => array('id' => $param['catalogueid']),
		// 	'table' => 'product_catalogue',
		// 	'data' => $_update_attrid,
		// ));
		// xóa sản phẩm
		$flag = $this->Autoload_Model->_delete(array(
			'where' => array('id' => $param['id']),
			'table' => 'product'
		));
		echo $flag;die();
	}
	public function uploaddropzone(){

		$target_dir = 'uploads/images/1000'.$this->FT_auth['id'].'/'; // Upload directory
		$request = 1;
		if(isset($_POST['request'])){
			$request = $_POST['request'];
		}
		// Upload file
		if($request == 1){
			$target_file = $target_dir . basename($_FILES["file"]["name"]);
			$idex = explode('.',basename($_FILES["file"]["name"]));
			$msg = "";
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {
				$msg = '<input type="hidden" value="'.$target_file.'" name="album[]" id="'.$idex[0].'"/>';
			}else{
				$msg = "Error while uploading";
			}
			echo $msg;
		}
		// Remove file
		if($request == 2){
			$filename = $target_dir.$_POST['name'];
			//var_dump($filename);die;
            $msg = $_POST['name'];
			unlink($filename); exit;
		}
	}

}
