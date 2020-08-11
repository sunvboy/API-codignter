<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogue extends MY_Controller {



	public $module;
	function __construct() {
		parent::__construct();
		$this->load->library(array('configbie'));
		$this->load->helper(array('myfrontendcommon'));
		$this->load->library('nestedsetbie', array('table' => 'tour_catalogue'));
        $this->fc_lang = $this->config->item('fc_lang');
	}
	public function view($catalogueid = 0, $page = 1){

        $data['page'] = $page;

		$catalogueid = (int)$catalogueid;
		$seoPage = '';

		$tour = $this->Autoload_Model->_get_where(array(
            'select' => 'MAX(tb1.price) as max_price, MIN(tb1.price) as min_price',
            'table' => 'tour as tb1',
            'where' => array('tb1.publish' => 0,'tb1.alanguage' => $this->fc_lang),
            'join' => array(array('catalogue_relationship as tb3', 'tb1.id = tb3.moduleid AND tb3.module = "tour"', 'inner')),
            'query' => 'tb3.catalogueid = '.$catalogueid,
            'distinct' => 'true',
        ));

        $data['min_price'] = ($tour['min_price'] != '') ? $tour['min_price'] : 0;
        $data['max_price'] = ($tour['max_price'] != '') ? $tour['max_price'] : 0;


        $json = [];
        $data['from'] = 0;
        $data['to'] = 0;
        $listPerpage = $this->configbie->data('perpage_frontend');
        $perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : current($listPerpage);
        $page = ($this->input->get('page')) ? $this->input->get('page') : $page;
        $keyword = $this->db->escape_like_str($this->input->get('keyword'));
        $param['catalogueid'] = $catalogueid;
        $param['brand'] = ($this->input->get('brand')) ? $this->input->get('brand') : '';
        $param['attr'] = ($this->input->get('attr')) ? $this->input->get('attr') : '';
        if(isset($param['attr']) ){
        	$attr = explode(';',$param['attr']) ;
	        foreach ($attr as $key => $val) {
		        if ($key % 2 == 1){
		            if($val != '' ){
		                $data['attrList'][] = $val;
		            }
		        }
		    }
		}
        $param['min_price'] = ($this->input->get('min_price')) ? $this->input->get('min_price') : $data['min_price'];
        $param['max_price'] = ($this->input->get('max_price')) ? $this->input->get('max_price') : $data['max_price'];
        $param['sort'] = ($this->input->get('sort')) ? $this->input->get('sort') : '';
        $detailCatalogue = $this->Autoload_Model->_get_where(array(
            'select' => 'id, title, level, lft, rgt, parentid, brand_json, image_json, attrid, canonical,description, image, icon',
            'table' => 'tour_catalogue',
            'where' => array('alanguage' => $this->fc_lang),
            'query' => 'id = '.$param['catalogueid'],
        ));

		if(!isset($detailCatalogue) || is_array($detailCatalogue) == false || count($detailCatalogue) == 0){
			$this->session->set_flashdata('message-danger', 'Danh mục tour không tồn tại');
			redirect(BASE_URL);
		}
        $data['post_min_price'] = $param['min_price'];
        $data['post_max_price'] = $param['max_price'];

        $query = '';


        $order_by = 'tb1.order asc,tb1.id desc';
        if(!empty($param['sort']) ){
            $sort = explode('|', $param['sort']);
            $order_by =  'tb1.'.$sort[0].' '.$sort[1].', '.$order_by;
        }

        if(!empty($param['catalogueid'])){
            $temp = $this->Autoload_Model->_get_where(array(
                'select' => 'id, attrid',
                'table' => 'tour_catalogue',
                'query' => 'lft >= '.$detailCatalogue['lft'].' AND '.'rgt <= '.$detailCatalogue['rgt'],
            ), true);

            $cataList = getColumsInArray($temp, 'id');
            $str_cata = '';
            if(isset($cataList) && is_array($cataList) && count($cataList)){
                foreach ($cataList as $key => $val) {
                    $str_cata = $str_cata.$val.', ';
                }
            }
            $str_cata = substr( $str_cata, 0, strlen($str_cata) -2);
            $str_cata = '('.$str_cata.')';

            $query = $query.' AND tb3.catalogueid IN  '.$str_cata;
        }
        if(!empty($param['brand'])){
            $str_brand= '';
            foreach ($param['brand'] as $key => $value) {
                $str_brand = $str_brand.$value.', ';
            }
            $str_brand = substr( $str_brand, 0, strlen($str_brand) -2);
            $str_brand = '('.$str_brand.')';
            $query = $query.' AND tb1.brandid IN  '.$str_brand;
        }
        // xử lí điều kiện lọc thuộc tính
        if(!empty($param['attr'])){
            $attr = explode(';',$param['attr']) ;
            foreach ($attr as $key => $val) {
                if ($key % 2 == 0){
                    if($val != '' ){
                        $attribute[$val][] = $attr[$key +1];
                    }
                }else{
                    continue;
                }
            }
            $total = 0;
            $index = 100;
            foreach ($attribute as $key => $val) {
                $attribute_catalogue = $this->Autoload_Model->_get_where(array(
                    'select' =>'id',
                    'table' =>'attribute_catalogue',
                    'where'=> array('keyword'=> $key),
                ));
                $query = $query.' AND ( ';
                $total++;
                $index ++;
                foreach ($val as $sub => $subs) {
                    $index = $index + $total;
                    $query = $query.' tb_attr_'.$index.'.attrid =  '.$subs.' OR ';
                    $json[] = array('attribute_relationship as tb_attr_'.$index, 'tb1.id = tb_attr_'.$index.'.moduleid AND tb_attr_'.$index.'.module ="tour"', 'inner');
                }
                $query = substr( $query,  0, strlen($query) -3 );
                $query = $query.' ) ';
            }
            // $query = $query.' GROUP BY `tb_attr_102`.`moduleid`';
        }
        $json[] = array('catalogue_relationship as tb3', 'tb1.id = tb3.moduleid AND tb3.module = "tour"', 'full');
        $json[] = array('promotional_relationship as tb2', 'tb1.id = tb2.moduleid AND tb2.module = "tour"', 'left');

        $query = substr( $query,  4, strlen($query));

        $config['total_rows'] = $this->Autoload_Model->_get_where(array(
            'select' => 'tb1.id',
            'table' => 'tour as tb1',
            'where' => array('tb1.publish' => 0,'tb1.alanguage' => $this->fc_lang),
            'keyword' => $keyword,
            'join' => $json,
            'query' => $query,
            'distinct' => 'true',
            'count' =>TRUE,
        ));
        $data['total_rows'] = $config['total_rows'];
        $data['totalPage'] = $data['per_page'] = 0;
        $config['base_url']  = '';
        if($config['total_rows'] > 0){
            $this->load->library('pagination');

            $config['base_url'] = rewrite_url($detailCatalogue['canonical'], false, true) ;
            $config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');

            $config['prefix'] = 'trang-';

            $config['first_url'] = $config['base_url'].$config['suffix'];
            $config['per_page'] = 18;
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
            $data['totalPage'] = $totalPage;
            $page = ($page <= 0)?1:$page;
            $page = ($page > $totalPage)?$totalPage:$page;
            $seoPage = ($page >= 2) ? '-Trang '.$page : '';
            if($page >= 2){
                $data['canonical'] = $config['base_url'].'/trang-'.$page.$this->config->item('url_suffix');
            }
            $page = $page - 1;
            $data['from'] = ($page * $config['per_page']) + 1;
            $data['to'] = ($config['per_page']*($page+1) > $config['total_rows']) ? $config['total_rows']  : $config['per_page']*($page+1);
            $data['tourList'] = $this->Autoload_Model->_get_where(array(
                'distinct' => 'true',
                'select' => 'tb1.customerid,tb1.id, tb1.id as tourid, tb1.title, tb1.canonical, tb1.price, tb1.price_sale, tb1.price_contact, tb1.image, tb1.order,tb1.description,tb1.duration',
                'table' => 'tour as tb1',
                'where' => array('tb1.publish' => 0,'tb1.image !=' => '','tb1.alanguage' => $this->fc_lang),
                'limit' => $config['per_page'],
                'start' => $page * $config['per_page'],
                'keyword' => $keyword,
                'join' => $json,
                'query' => $query,
                'order_by' => $order_by,
            ), true);



            $data['per_page'] = $config['per_page'];

        }




		// xử lí đường dẫn tới tour
		$data['breadcrumb'] = $this->Autoload_Model->_get_where(array(
			'select' => 'id, title, slug, canonical, lft, rgt',
			'table' => 'tour_catalogue',
			'where' => array('lft <=' => $detailCatalogue['lft'],'rgt >=' => $detailCatalogue['lft'],'alanguage' => $this->fc_lang),
            'limit' => 1,
			'order_by' => 'lft ASC, order ASC'
		), TRUE);


		$data['meta_title'] = (!empty($detailCatalogue['meta_title'])?$detailCatalogue['meta_title']:$detailCatalogue['title']).$seoPage;
		$data['meta_description'] = (!empty($detailCatalogue['meta_description'])?$detailCatalogue['meta_description']:cutnchar(strip_tags($detailCatalogue['description']), 255)).$seoPage;
		$data['meta_image'] = !empty($detailCatalogue['image'])?base_url($detailCatalogue['image']):'';
		if(!isset($data['canonical']) || empty($data['canonical'])){
			$data['canonical'] = $config['base_url'].$this->config->item('url_suffix');
		}

        // sửa lại biến attrid cũ
        //  vì đây là thuộc tính của cả nhóm danh mục con
        $temp = [];
        if(isset($attrList) && check_array($attrList)){
            foreach ($attrList as $key => $val) {
                $temp1 = json_decode($val, true);
                if(isset($temp1) && check_array($temp1)){
                    foreach ($temp1 as $sub => $subs) {
                        $temp[$sub] = (isset($temp[$sub])) ? array_merge($temp[$sub], $subs) : $subs;
                    }
                }
            }
        }
		$data['attribute'] = getListAttr( (check_array($temp)) ? json_encode($temp) : '');
		$data['detailCatalogue'] = $detailCatalogue;
		$data['template'] = 'tour/frontend/catalogue/view';
		$this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);

	}


}
