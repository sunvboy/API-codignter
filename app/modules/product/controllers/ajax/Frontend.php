<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends MY_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->library(array('configbie'));
        $this->fc_lang = $this->config->item('fc_lang');
	}
	public function get_list_prd_cat(){
		$this->load->helper(array('myfrontendcommon'));
        $json = [];
        $data['from'] = 0;
        $data['to'] = 0;
        $listPerpage = $this->configbie->data('perpage_frontend');
        $perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : current($listPerpage);
        $page = ($this->input->get('page')) ? $this->input->get('page') : '';
        $keyword = $this->db->escape_like_str($this->input->get('keyword'));
        $param['catalogueid'] = ($this->input->get('catalogueid')) ? $this->input->get('catalogueid') : '';
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
            'select' => 'id, title, level, lft, rgt, parentid, brand_json, attrid, canonical,description, image',
            'table' => 'product_catalogue',
            'query' => 'id = '.$param['catalogueid'],
        ));
        $data['post_min_price'] = (int)$param['min_price'];
        $data['post_max_price'] = (int)$param['max_price'];

        $query = '';
        $query = $query.' AND tb1.price >= '.$param['min_price'].' AND tb1.price <= '.$param['max_price'].' ';
        $order_by = ' tb1.order ASC';
        if(isset($param['sort']) && $param['sort'] != 0 ){
            $sort = explode('|', $param['sort']);
            $order_by =  ' tb1.'.$sort[0].' '.$sort[1].', '.$order_by. ', ';
        }

        if(!empty($param['catalogueid'])){
            $query = $query.' AND tb3.catalogueid =  '.$param['catalogueid'];
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
                    $json[] = array('attribute_relationship as tb_attr_'.$index, 'tb1.id = tb_attr_'.$index.'.moduleid AND tb_attr_'.$index.'.module ="product"', 'inner');
                }
                $query = substr( $query,  0, strlen($query) -3 );
                $query = $query.' ) ';
            }
            // $query = $query.' GROUP BY `tb_attr_102`.`moduleid`';
        }
        $json[] = array('catalogue_relationship as tb3', 'tb1.id = tb3.moduleid AND tb3.module = "product"', 'inner');
        $json[] = array('promotional_relationship as tb2', 'tb1.id = tb2.moduleid AND tb2.module = "product"', 'left');

        $query = substr( $query,  4, strlen($query));

        $config['total_rows'] = $this->Autoload_Model->_get_where(array(
            'select' => 'tb1.id',
            'table' => 'product as tb1',
            'where' => array('tb1.publish' => 0),
            'keyword' => $keyword,
            'join' => $json,
            'query' => $query,
            'distinct' => 'true',
            'count' =>TRUE,
        ));
        
        $config['base_url']  = '';
        if($config['total_rows'] > 0){
            $this->load->library('pagination');

            $config['base_url'] = rewrite_url($detailCatalogue['canonical'], false, true) ;
            $config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');

            $config['prefix'] = 'trang-';

            $config['first_url'] = $config['base_url'].$config['suffix'];
            $config['per_page'] = $perpage;
            $config['uri_segment'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['full_tag_open'] = '<ul class="uk-pagination uk-pagination-right">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="uk-active"><a>';
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
            $seoPage = ($page >= 2) ? '-Trang '.$page : '';
            if($page >= 2){
                $data['canonical'] = $config['base_url'].'/trang-'.$page.$this->config->item('url_suffix');
            }
            $page = $page - 1;
            $data['from'] = ($page * $config['per_page']) + 1;
            $data['to'] = ($config['per_page']*($page+1) > $config['total_rows']) ? $config['total_rows']  : $config['per_page']*($page+1);
            $productList = $this->Autoload_Model->_get_where(array(
                'select' => 'tb1.id, tb1.id as productid, tb1.title, tb1.canonical, tb1.price, tb1.price_sale, tb1.price_contact, tb1.image, tb1.version_json, tb1.image_color_json, tb2.end_date',
                'table' => 'product as tb1',
                'where' => array('tb1.publish' => 0),
                'limit' => $config['per_page'],
                'start' => $page * $config['per_page'],
                'keyword' => $keyword,
                'join' => $json,
                'query' => $query,
                'distinct' => 'true',
                'order_by' => $order_by,
            ), true);
            $productList = getDetailListPrd(array('productList' => $productList));
            
            foreach ($productList as $key => $value) {
                $commnet = comment(array('id' => $value['productid'], 'module' => 'product'));
                $productList[$key]['rate'] = '';
                $productList[$key]['totalComment'] = '';
                if(isset($commnet) && is_array($commnet) && count($commnet)){
                    $productList[$key]['totalComment'] = round($commnet['statisticalRating']['totalComment']);
                    $productList[$key]['rate'] = round($commnet['statisticalRating']['averagePoint']);
                }
                $productList[$key]['info'] = getPriceFrontend(array('productDetail' => $value));
            }
        }

        $html = '';

        if(isset($productList) && is_array($productList) && count($productList)){ 
            foreach($productList as $key => $val){
                $title = $val['title'];
                $rate = $val['rate'];
                $totalComment = $val['totalComment'];
                $image = $val['image'];
                $href = rewrite_url($val['canonical']);
                $info = $val['info'];
                $end_date = '';
                if(isset($val['end_date'])){
                    $end_date  =  $val['end_date'] ;
                }
            

                $html = $html.'<div class="product uk-clearfix">';
                    $html = $html.'<div class="thumb">';
                        if($info['percent'] != 0){
                            $html = $html.'<div class="percent">-'.$info['percent'].'</div>';
                        }
                        $html = $html.'<a href="'.$href.'" title="'.$title.'" class="image img-scaledown img-shine"><img  src="'.$image.'" alt="" /></a>';
                        $html = $html.renderCountDown($end_date);
                    $html = $html.'</div>';
                    $html = $html.'<div class="info">';
                        $html = $html.'<h3 class="title"><a href="'.$href.'" title="'.$title.'">'.$title.'</a></h3>';

                        $html = $html.'<div class="product-ratings">';
                            $html = $html.'<div class="rating-box">';
                                    $html = $html.'<ul class="uk-list uk-clearfix uk-flex uk-flex-middle d-flex">';
                                        for($e = 1; $e <= $rate; $e++){
                                            $html = $html.'<li class="rating-true"><i class="fa fa-star"></i></li>';
                                        }
                                        for($e = 1; $e <= (5 - $rate); $e++){
                                            $html = $html.'<li class="rating-false"><i class="fa fa-star"></i></li>';
                                        }
                                        $html = $html.'('.$totalComment.')';
                                    $html = $html.'</ul>';
                            $html = $html.'</div>';
                        $html = $html.'</div>';
                        $html = $html.'<div class="product-price">';
                            if($info['flag'] == 1){
                                $html = $html.'<div class="new-price text-center"> '.$info['price_final'].'</div>';
                            }else{
                                $html = $html.'<div class="uk-grid uk-grid-collaps">';
                                    $html = $html.'<div class="uk-width-1-2">';
                                        $html = $html.'<div class="old-price text-center">'.$info['price_old'].'</div>';
                                    $html = $html.'</div>';
                                    $html = $html.'<div class="uk-width-1-2">';
                                        $html = $html.'<div class="new-price text-center">'.$info['price_final'].'</div>';
                                    $html = $html.'</div>';
                                $html = $html.'</div>';
                            }
                        $html = $html.'</div>';
                   $html = $html.' </div>';
                $html = $html.'</div>';
            }
        }
        echo json_encode(array(
            'pagination' => (isset($data['PaginationList'])) ? $data['PaginationList'] : '',
            'html' => (isset($html)) ? $html : '',
            'from' => $data['from'],
            'to' => $data['to'],
            'total_row' => $config['total_rows'],
        ));die();

        
    }
    public function filter(){
        $page = (int)$this->input->get('page');
        $json = [];
        $data['from'] = 0;
        $data['to'] = 0;
        $perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
        $keyword = $this->db->escape_like_str($this->input->get('keyword'));
        $param['catalogueid'] = $this->input->get('catalogueid');
        $param['attr'] = $this->input->get('attr');
        $query = '';


        if(!empty($param['catalogueid'])){
            $query = $query.'AND tb1.publish = 0 AND tb3.catalogueid IN'.' ('.$param['catalogueid'].')';
        }


        // xử lí điêu kiên loc thuôc tinh
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
                    $query = $query.' tb'.$index.'.attrid =  '.$subs.' OR ';
                    $json[] = array('attribute_relationship as tb'.$index, 'tb1.id = tb'.$index.'.moduleid AND tb'.$index.'.module ="product"', 'inner');
                }
                $query = substr( $query,  0, strlen($query) -3 );
                $query = $query.' ) ';
            }
            $query = $query.' GROUP BY `tb102`.`moduleid`';
        }
        $json[] = array('catalogue_relationship as tb3', 'tb1.id = tb3.moduleid AND tb3.module = "product"', 'full');
        $json[] = array('promotional_relationship as tb2', 'tb1.id = tb2.moduleid AND tb2.module = "product"', 'left');
        $query = substr( $query,  4, strlen($query));
        $config['total_rows'] = $this->Autoload_Model->_get_where(array(
            'select' => 'tb1.id',
            'table' => 'product as tb1',
            'keyword' => (!empty($keyword))? '(tb1.title LIKE \'%'.$keyword.'%\')' : '',
            'join' => $json,
            'query' => $query,
            'distinct' => 'true',
            'count' =>TRUE,
        ));
        if($config['total_rows'] > 0){
            $this->load->library('pagination');
            $config['base_url'] ='#" data-page="';
            $config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
            $config['first_url'] = $config['base_url'].$config['suffix'];
            $config['per_page'] = $perpage;
            $config['cur_page'] = $page;
            $config['page'] = $page;
            $config['uri_segment'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['full_tag_open'] = '<div class="box-pagination col-md-12 col-sm-12 col-xs-12 text-right"><ul class="pagination">';
            $config['full_tag_close'] = '</ul></div>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $listPagination = $this->pagination->create_links();
            $totalPage = ceil($config['total_rows']/$config['per_page']);
            $page = ($page <= 0)?1:$page;
            $page = ($page > $totalPage)?$totalPage:$page;
            $page = $page - 1;
            $data['from'] = ($page * $config['per_page']) + 1;
            $data['to'] = ($config['per_page']*($page+1) > $config['total_rows']) ? $config['total_rows']  : $config['per_page']*($page+1);
            $listproduct = $this->Autoload_Model->_get_where(array(
                'distinct' => 'true',
                'select' =>'tb1.image, tb1.description, tb1.title, tb1.price, tb1.price_sale,tb1.id, tb1.canonical',
                'table' => 'product as tb1',

                'limit' => $config['per_page'],
                'start' => $page * $config['per_page'],
                'keyword' => (!empty($keyword))? '(tb1.title LIKE \'%'.$keyword.'%\')' : '',
                'join' => $json,
                'query' => $query,
                'order_by' => 'tb1.order desc, tb1.created asc',
            ),true);
        }

        $html = '';
        if(isset($listproduct) && is_array($listproduct) && count($listproduct)){
            foreach($listproduct as $key => $valPost){
                $title = $valPost['title'];
                $href = rewrite_url($valPost['canonical'], TRUE, TRUE);
                $image = getthumb($valPost['image']);
                $description = cutnchar(strip_tags($valPost['description']), 250);
                $getPrice = getPriceFrontend(array('productDetail' => $valPost));
                $comment = comment(array('module' => 'product', 'id' => $valPost['id']));
                if (isset($comment) && is_array($comment) && count($comment)) {
                    $prd_rate = (float)$comment['statisticalRating']['averagePoint'];
                }
                $html = $html.'<div class="product-layout col-lg-15 col-md-4 col-sm-6 col-xs-6">
                                <div class="product-item-container">
                                    <div class="left-block left-b">

                                        <div class="product-image-container second_img">
                                            <a href="'.$href.'" target="_self" title="Lastrami bacon">
                                                <img src="'.$image.'"
                                                     class="img-1 img-responsive" alt="'.$title.'">
                                                <img
                                                    src="'.$image.'"
                                                    class="img-2 img-responsive" alt="'.$title.'">
                                            </a>
                                        </div>
                                        <div class="so-quickview">
                                            <a class="iframe-link btn-button quickview quickview_handler visible-lg"
                                               href="" title="Quick view" data-fancybox-type="iframe"><i
                                                    class="fa fa-eye"></i><span>Quick view</span></a>
                                        </div>
                                    </div>
                                    <div class="right-block">
                                        <div class="button-group so-quickview cartinfo--left">
                                            <button type="button" class="addToCart" title="Add to cart">
                                                <span>Add to cart </span>
                                            </button>
                                            <button type="button" class="wishlist btn-button" title="Add to Wish List">
                                                <i class="fa fa-heart-o"></i><span>Add to Wish List</span>
                                            </button>
                                        </div>
                                        <div class="caption hide-cont">
                                            <div class="ratings">
                                                <div class="rating-box">';
                for ($i = 1; $i <= $prd_rate; $i++) {
                    $html = $html.'<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>';
                }

                $html = $html.'</div>';
                if ($comment['statisticalRating']['totalComment'] > 0) {
                    $html = $html.'<span
                                                        class="rating-num">( '.$comment['statisticalRating']['totalComment'].'
                                                        )</span>';
                }
                $html = $html.'</div>
                                            <h4><a href="'.$href.'" title="'.$title.'"
                                                   target="_self">'.$title.'</a></h4>

                                        </div>
                                        <p class="price">
                                            <span class="price-new">'.$getPrice['price_final'].'</span>
                                            <span class="price-old">'.$getPrice['price_old'].'</span>

                                        </p>

                                        <div class="description item-desc">
                                            <p>'.$description.'</p>
                                        </div>

                                    </div>

                                </div>
                            </div>';


            }
        }else{
            $html = $html.'';
        }
        echo json_encode(array(
            'pagination' => (isset($listPagination)) ? $listPagination : '',
            'html' => (isset($html)) ? $html : '',
            'total' => $config['total_rows'],
        ));die();
    }
    public function quickview(){
        $id = $this->input->post('id');
        $productDetail = $this->Autoload_Model->_get_where(array(
            'select' => 'id, id as productid,icon_hot, title,canonical, catalogue, image, publish, order, price,	price_contact, price_sale,  (SELECT account FROM user WHERE user.id = product.userid_created) as user_created, version, viewed, catalogueid, (SELECT title FROM product_catalogue WHERE product_catalogue.id = product.catalogueid) as catalogue_title, viewed,description, image_json, (SELECT title FROM product_brand WHERE product_brand.id = product.brandid) as brand, (SELECT title FROM product_catalogue WHERE product_catalogue.id = product.catalogueid) as catalogue, code, version_json, unlimited_sale, image_color_json, model, made_in, video, extend_description, prd_rela, file_price',
            'table' => 'product',
            'where' => array('id' => $id, 'publish' => 0),
        ));
        $data['product_wholesale'] = $this->Autoload_Model->_get_where(array(
            'select' => 'id, quantity_start, quantity_end, price_wholesale',
            'table' => 'product_wholesale',
            'where' => array('productid ' => $id),
        ), TRUE);
        $data['list_version'] = $this->Autoload_Model->_get_where(array(
            'select' => 'id, title, productid, attribute1, attribute2, price_version, image',
            'table' => 'product_version',
            'where' => array('productid ' => $id),
        ), TRUE);
        if(empty($productDetail['price_sale']) && empty($productDetail['price_contact'])){
            $promotion_relationship = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title ,discount_value, discount_type, discount_moduleid, use_common, promotionalid, condition_type, condition_value, condition_type_1, condition_value_1, module, freeship, freeshipAll, cityid, start_date, end_date, (SELECT canonical FROM promotional WHERE promotional.id = promotional_relationship.promotionalid) as canonical',
                'table' => 'promotional_relationship',
                'where' => array('moduleid' => $productDetail['id'], 'module' => 'product'),
            ), true);
            $block_promotional = '';
            if(isset($promotion_relationship) && is_array($promotion_relationship) && count($promotion_relationship)){
                foreach ($promotion_relationship as $key => $value) {
                    $promotion = json_decode(getPromotional($value, 0), true);
                    $detail_discount[$value['promotionalid']] = $promotion['detail'];
                    $title[$value['promotionalid']] = $value['title'];
                    $canonical[$value['promotionalid']] = $value['canonical'];
                    $use_common[$value['promotionalid']] = $value['use_common'];
                }

                if(isset($use_common) && is_array($use_common) && count($use_common)){
                    foreach ($use_common as $key => $value) {
                        $block_promotional[$value][$key]['detail'] = $detail_discount[$key];
                        $block_promotional[$value][$key]['canonical'] = $canonical[$key];
                        $block_promotional[$value][$key]['title'] = $title[$key];
                    };
                }
            }
            $data['block_promotional'] = $block_promotional;
        }
        $data_info = base64_encode(json_encode(array(
            'product_wholesale'=> (isset($data['product_wholesale']))? $data['product_wholesale']: '',
            'product_version'=> (isset($data['list_version']))? $data['list_version']: '',
            'promotional'=> (isset($promotion_relationship))? $promotion_relationship: '',
        )));
        $html = '';
        if(isset($productDetail) && is_array($productDetail) && count($productDetail)){
            $result = 1;
            $prd_info = getPriceFrontend(array('productDetail' => $productDetail));
            $prd_href = rewrite_url($productDetail['canonical']);
            $commnet = comment(array('id' => $productDetail['id'], 'module' => 'product'));
            $prd_rate = '';
            if (isset($commnet) && is_array($commnet) && count($commnet)) {
                $prd_rate = round($commnet['statisticalRating']['averagePoint']);
            }
            $list_image = json_decode(base64_decode($productDetail['image_json']), TRUE);
            $html = $html.'<div id="js_prd_info" data-info="'.$data_info.'"
     data-price="'.$productDetail['price'].'"
     data-price_sale="'.$productDetail['price_sale'].'"
     data-price_contact="'.$productDetail['price_contact'].'"
     data-id="'.$productDetail['id'].'"
     data-name="'.$productDetail['title'].'"
     data-redirect="false">

</div>
<div id="quantity" data-quantity="1"></div><div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-body">
 <div class="product-view row">
                <div class="left-content-product">

                    <div class="content-product-left class-honizol col-md-5 col-sm-12 col-xs-12">
                        <div id="sync1" class="owl-carousel owl-theme">
    <div class="item"> <img src="'.$productDetail['image'].'"
                                     title="'.$productDetail['title'].'"
                                     alt="'.$productDetail['title'].'"></div>';

            if (isset($list_image) && is_array($list_image) && count($list_image)) { foreach ($list_image as $key => $val) {
                $html = $html.'<div class="item" ><img src="'.$val.'"
                                     title="'.$productDetail['title'].'"
                                     alt="'.$productDetail['title'].'"></div >';
            }
            }



            $html = $html.'</div>

<div id="sync2" class="owl-carousel owl-theme">
    <div class="item"><img src="'.$productDetail['image'].'"
                                     title="'.$productDetail['title'].'"
                                     alt="'.$productDetail['title'].'"></div>';

            if (isset($list_image) && is_array($list_image) && count($list_image)) { foreach ($list_image as $key => $val) {


                $html = $html.'<div class="item" ><img src="'.$val.'"
                                     title="'.$productDetail['title'].'"
                                     alt="'.$productDetail['title'].'"></div >';
            }}
            $html = $html.'</div>
                    </div>
                    <div class="content-product-right col-md-7 col-sm-12 col-xs-12">
                        <div class="title-product">
                            <h1><a href="'.$prd_href.'">'.$productDetail['title'].'</a></h1>
                        </div>';
            if($prd_rate>0){
                $html = $html.'<div class="box-review form-group">
                            <div class="ratings">
                                <div class="rating-box">';

                for ($i = 1; $i <= $prd_rate; $i++) {
                    $html = $html . '<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>';
                }                                $html = $html . '</div>
                            </div>

                        </div>';
            }
            $html = $html.'<div class="product-label form-group">';
            if ($prd_info['flag'] == 0) {
                $html = $html.'<div class="product_page_price price" itemprop="offerDetails" itemscope=""
		 itemtype="http://data-vocabulary.org/Offer">
                                    <span class="price-new"
										  itemprop="price">Giá: '.$prd_info['price_final'].'</span>
		<span class="price-old">'.$prd_info['price_old'].'</span>
	</div>';
            } else {
                if ($prd_info['price_old'] == 0 && $prd_info['price_final'] == 0) {
                    $html = $html.'<div class="product_page_price price" itemprop="offerDetails" itemscope=""
			 itemtype="http://data-vocabulary.org/Offer">
			<span class="price-new" itemprop="price">Giá: Liên hệ</span>
		</div>';
                } else {
                    $html = $html.'<div class="product_page_price price" itemprop="offerDetails" itemscope=""
			 itemtype="http://data-vocabulary.org/Offer">
                                        <span class="price-new"
											  itemprop="price">Giá: '.$prd_info['price_final'].'</span>
		</div>';
                }
            }

            $html = $html.'</div>
<div class="description">
	'. $productDetail['description'].'
</div>
<div id="product">
	<div class="form-group box-info-product">
		<div class="option quantity">
			<div class="input-group quantity-control" unselectable="on"
				 style="-webkit-user-select: none;">
				<label>Số lượng</label>
				<input class="form-control js_quantity" type="text" name="quantity" value="1">
				<span class="input-group-addon product_quantity_down js_quantity_minus">−</span>
				<span class="input-group-addon product_quantity_up js_quantity_plus">+</span>
			</div>
		</div>
		<div class="cart">
			<input type="button" data-toggle="tooltip" title="" value="Add to Cart"
				   id="button-cart" class="btn btn-mega btn-lg js_buy">
		</div>


	</div>

</div>

</div>

</div>
</div>
            </div>

        </div>
                        <button style="position: absolute;top: 0px;right: 0px;border-top-right-radius: 7px;" type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Đóng</button>

    </div>

<script>
    $(document).ready(function() {

        var sync1 = $("#sync1");
        var sync2 = $("#sync2");
        var slidesPerPage = 4;
        var syncedSecondary = true;

        sync1.owlCarousel({
            items : 1,
            slideSpeed : 5000,
            nav: false,
            autoplay: true,
            dots: false,
            loop: true,
            responsiveRefreshRate : 200,
            navText: [\'<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>\',\'<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>\'],
        }).on(\'changed.owl.carousel\', syncPosition);

        sync2
            .on(\'initialized.owl.carousel\', function () {
                sync2.find(".owl-item").eq(0).addClass("current");
            })
            .owlCarousel({
                items : slidesPerPage,
                dots: false,
                nav: false,
                smartSpeed: 200,
                slideSpeed : 500,
                slideBy: slidesPerPage,
                responsiveRefreshRate : 100
            }).on(\'changed.owl.carousel\', syncPosition2);

        function syncPosition(el) {

            var count = el.item.count-1;
            var current = Math.round(el.item.index - (el.item.count/2) - .5);

            if(current < 0) {
                current = count;
            }
            if(current > count) {
                current = 0;
            }


            sync2
                .find(".owl-item")
                .removeClass("current")
                .eq(current)
                .addClass("current");
            var onscreen = sync2.find(\'.owl-item.active\').length - 1;
            var start = sync2.find(\'.owl-item.active\').first().index();
            var end = sync2.find(\'.owl-item.active\').last().index();

            if (current > end) {
                sync2.data(\'owl.carousel\').to(current, 100, true);
            }
            if (current < start) {
                sync2.data(\'owl.carousel\').to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) {
            if(syncedSecondary) {
                var number = el.item.index;
                sync1.data(\'owl.carousel\').to(number, 100, true);
            }
        }

        sync2.on("click", ".owl-item", function(e){
            e.preventDefault();
            var number = $(this).index();
            sync1.data(\'owl.carousel\').to(number, 300, true);
        });
    });
</script>';
        }else{
            $result = 0;
            $html = $html.'';
        }
        echo json_encode(array(
            'result' => $result,
            'html' => (isset($html)) ? $html : '',
        ));die();
    }
}
