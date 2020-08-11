<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour extends MY_Controller {

    public $module;
    function __construct() {
        parent::__construct();
        if(!isset($this->auth) || is_array($this->auth) == FALSE || count($this->auth) == 0 ) redirect(BACKEND_DIRECTORY);
        $this->load->library(array('configbie'));
        $this->load->library('nestedsetbie', array('table' => 'tour_catalogue'));
        $this->load->helper('myproduct');
        $this->module = 'tour';
    }

    public function view($page = 1){
        $data['attribute_catalogue'] = $this->Autoload_Model->_get_where(array(
            'table' => 'attribute_catalogue',
            'count' => 'true',
        ),true);
        $page = (int)$page;
        $query = '';
        $this->commonbie->permission("tour/backend/tour/view", $this->auth['permission']);
        $data['from'] = 0;
        $data['to'] = 0;
        $perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
        $keyword = $this->input->get('keyword');
        if(!empty($keyword)){
            $keyword = '(title LIKE \'%'.$keyword.'%\' OR description LIKE \'%'.$keyword.'%\')';
        }


        $catalogueid = ($this->input->get('catalogueid')) ? $this->input->get('catalogueid') : '';

        if(!empty($catalogueid)){
            $query = 'catalogueid =  '.$catalogueid;
            $detailCatalogue = $this->Autoload_Model->_get_where(array(
                'select' => 'id, attrid',
                'table' => 'tour_catalogue',
                'where' => array('id' => $catalogueid),
            ));
            $data['attribute_catalogue'] = getListAttr($detailCatalogue['attrid']);
        }

        $config['total_rows'] = $this->Autoload_Model->_get_where(array(
            'select' => 'id',
            'table' => 'tour',
            'where' => array('alanguage' => $this->fclang),
            'keyword' => $keyword,
            'count' => TRUE,
        ));
        if($config['total_rows'] > 0){
            $this->load->library('pagination');
            $config['base_url'] = base_url('tour/backend/tour/view');
            $config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
            $config['first_url'] = $config['base_url'].$config['suffix'];
            $config['per_page'] = $perpage;
            $config['cur_page'] = $page;
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
            $data['listData'] = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title, canonical, image, publish, order, price, price_sale, quantity_cuoi_ki, quantity_dau_ki, catalogue,  ishome,  highlight,  isaside,  isfooter, (SELECT account FROM user WHERE user.id = tour.userid_created) as user_created, version, viewed, catalogueid, (SELECT title FROM tour_catalogue WHERE tour_catalogue.id = tour.catalogueid) as catalogue_title, price_contact',
                'table' => 'tour',
                'where' => array('alanguage' => $this->fclang),
                'query' => $query,
                'limit' => $config['per_page'],
                'start' => $page * $config['per_page'],
                'keyword' => $keyword,
                'order_by' => 'id desc',
            ), TRUE);
        }

        $data['script'] = 'tour';
        $data['config'] = $config;
        $data['template'] = 'tour/backend/tour/view';
        $this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
    }

    public function Create(){


        if($this->input->post('create')){
            $this->commonbie->permission("tour/backend/tour/create", $this->auth['permission']);

            $album=$this->input->post('album');
            //info
            /*$content_info = $this->input->post('content_info');
            $content_info_data = [];
            if(isset($content_info['title']) && is_array($content_info['title'])  && count($content_info['title'])) {
                foreach ($content_info['title'] as $key => $val) {
                    $content_info_data[] = array('title' => $val);
                }
            }
            if(isset($content_info_data) && is_array($content_info_data)  && count($content_info_data) && isset($content_info['description']) && is_array($content_info['description']) && count($content_info['description'])) {
                foreach ($content_info_data as $key => $val) {
                    $content_info_data[$key]['description'] = $content_info['description'][$key];
                }
            }
            $content_highlight = $this->input->post('content_highlight');*/


            //end

            $this->load->library('form_validation');
            $this->form_validation->CI =& $this;
            $this->form_validation->set_error_delimiters('','/');
            $this->form_validation->set_rules('title', 'Tiêu đề tour', 'trim|required');
            // $this->form_validation->set_rules('content[title][]', 'Tiêu đề thành phần mở rộng', 'trim|required');
            $this->form_validation->set_rules('catalogueid', 'Danh mục chính', 'trim|is_natural_no_zero');
            $this->form_validation->set_rules('canonical', 'Đường dẫn bài viết', 'trim|required|callback__CheckCanonical');
            $this->form_validation->set_rules('attribute[]', '', 'callback__CheckAttribute');
            $this->form_validation->set_rules('quantity_start[]', '', 'callback__CheckQuantity_start');
            $this->form_validation->set_rules('quantity_end[]', '', 'callback__CheckQuantity_end');
            if($this->form_validation->run($this)){
                $_insert = array(
                    'title' => htmlspecialchars_decode(html_entity_decode($this->input->post('title'))),
                    'slug' => slug(htmlspecialchars_decode(html_entity_decode($this->input->post('title')))),
                    'canonical' => slug($this->input->post('canonical')),
                    'description' => $this->input->post('description'),
                    'extend_description' =>json_encode($this->input->post('content')),
                    'catalogueid' => $this->input->post('catalogueid'),
                    'duration' => $this->input->post('duration'),
                    'catalogue' => json_encode($this->input->post('catalogue')),
//                    'content_info' => json_encode($content_info),
//                    'content_highlight' => json_encode($content_highlight),
                    'meta_title' => $this->input->post('meta_title'),
                    'meta_description' => $this->input->post('meta_description'),
                    'publish' => $this->input->post('publish'),
                    'image' => is($album[0]),
                    'image_json' => is(base64_encode(json_encode($album))),
                    'userid_created' => $this->auth['id'],
                    'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
                    'price' => (int)str_replace('.','',$this->input->post('price')),
                    'price_sale' => (int)str_replace('.','',$this->input->post('price_sale')),
                    'price_contact' => is($this->input->post('price_contact')),
                    'publish_time' => merge_time($this->input->post('post_date'), $this->input->post('post_time')),
                    'alanguage' => $this->fclang
                );
                $resultid_main = $this->Autoload_Model->_create(array(
                    'table' => 'tour',
                    'data' => $_insert,
                ));

                if($resultid_main > 0){
                    //tạo đường dẫn cho sản phẩm
                    $canonical = slug($this->input->post('canonical'));
                    createCanonical(array(
                        'module' => 'tour',
                        'canonical' => $canonical,
                        'resultid' => $resultid_main,
                    ));
                    //end

                    //tạo bảng catalogue_relationship
                    createCatalogue_relationship(array(
                        'module' => 'tour',
                        'catalogue' => $this->input->post('catalogue'),
                        'catalogueid' => $this->input->post('catalogueid'),
                        'resultid' => $resultid_main,
                    ));
                    //end
                    //thêm bảng attribute_relationship mới
                    $attr = $this->input->post('attr');
                    $temp = [];
                    if(isset($attr) && is_array($attr) && count($attr)){
                        foreach($attr as $key => $val){
                            $temp[] = array(
                                'moduleid' => $resultid_main,
                                'attrid' => $val,
                                'module' => 'tour',
                                'created' =>  gmdate('Y-m-d H:i:s', time() + 7*3600),
                            );
                        }
                    }
                    if(isset($temp) && is_array($temp) && count($temp)){
                        $this->Autoload_Model->_create_batch(array(
                            'table' => 'attribute_relationship',
                            'data' => $temp,
                        ));

                    }
                    //end


                    $this->session->set_flashdata('message-success', 'Thêm tour mới thành công');
                    redirect('tour/backend/tour/view');
                }
            }
        }
        $data['script'] = 'tour';
        $data['template'] = 'tour/backend/tour/create';
        $this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
    }
    public function Update($id = 0){
        $data = comment(array('id' => $id, 'module' => $this->module));
        $page = ($this->input->get('page')) ? $this->input->get('page') : 1;
        $this->commonbie->permission("tour/backend/tour/update", $this->auth['permission']);
        $attribute_catalogue = $this->Autoload_Model->_get_where(array(
            'table' => 'attribute_catalogue',
            'where' => array('alanguage' => $this->fclang),
            'count' => 'true',
        ),true);

        $data['countAttribute_catalogue'] = $attribute_catalogue;




        $id = (int)$id;
        $tour = $this->Autoload_Model->_get_where(array(
            'select' => 'id, code, title, slug, canonical, description, meta_title, meta_description, tag, catalogueid, catalogue, image, image_json, price, price_sale, price_contact, publish, publish_time, extend_description, content_highlight,content_info',
            'table' => 'tour',
            'where' => array('id' => $id,'alanguage' => $this->fclang),
        ));
        if(!isset($tour) || is_array($tour) == false || count($tour) == 0){
            $this->session->set_flashdata('message-danger', 'tour không tồn tại');
            redirect('tour/backend/tour/view');
        }
        $data['tour']=$tour;
        //Kiểm tra xem tour có nằm trong chương trình khuyến mại nào không
        $current = gmdate('Y-m-d H:i:s', time() + 7*3600);

        $data['price_contact'] =$tour['price_contact'];


        $data['image_json'] = json_decode(base64_decode($tour['image_json']), true);



        if($this->input->post('update')){
            //info
            /*$content_info = $this->input->post('content_info');
            $content_info_data = [];
            if(isset($content_info['title']) && is_array($content_info['title'])  && count($content_info['title'])) {
                foreach ($content_info['title'] as $key => $val) {
                    $content_info_data[] = array('title' => $val);
                }
            }
            if(isset($content_info_data) && is_array($content_info_data)  && count($content_info_data) && isset($content_info['description']) && is_array($content_info['description']) && count($content_info['description'])) {
                foreach ($content_info_data as $key => $val) {
                    $content_info_data[$key]['description'] = $content_info['description'][$key];
                }
            }
            $content_highlight = $this->input->post('content_highlight');
            */

            //end
            $album = $this->input->post('album');
            $data = getDataPost($data);

            $this->load->library('form_validation');
            $this->form_validation->CI =& $this;
            $this->form_validation->set_error_delimiters('','/');
            $this->form_validation->set_rules('title', 'Tiêu đề tour', 'trim|required');
            // $this->form_validation->set_rules('content[title][]', 'Tiêu đề thành phần mở rộng', 'trim|required');
            $this->form_validation->set_rules('catalogueid', 'Danh mục chính', 'trim|is_natural_no_zero');
            $this->form_validation->set_rules('canonical', 'Đường dẫn bài viết', 'trim|required|callback__CheckCanonical');
            $this->form_validation->set_rules('attribute[]', '', 'callback__CheckAttribute');
            $this->form_validation->set_rules('attribute_catalogue[]', '', 'callback__CheckAttribute_catalogue');
            $this->form_validation->set_rules('quantity_start[]', '', 'callback__CheckQuantity_start');
            $this->form_validation->set_rules('quantity_end[]', '', 'callback__CheckQuantity_end');

            if($this->form_validation->run($this)){
                $_update = array(
                    'title' => htmlspecialchars_decode(html_entity_decode($this->input->post('title'))),
                    'slug' => slug(htmlspecialchars_decode(html_entity_decode($this->input->post('title')))),
                    'canonical' => slug($this->input->post('canonical')),
                    'description' => $this->input->post('description'),
					'extend_description' =>json_encode( $this->input->post('content')),
                    'duration' => $this->input->post('duration'),

//                    'content_info' => json_encode($content_info),
//                    'content_highlight' => json_encode($content_highlight),
                    'catalogueid' => $this->input->post('catalogueid'),
                    'catalogue' => json_encode($this->input->post('catalogue')),
                    'meta_title' => $this->input->post('meta_title'),
                    'meta_description' => $this->input->post('meta_description'),
                    'publish' => $this->input->post('publish'),
                    'image' => is($album[0]),
                    'image_json' => is(base64_encode(json_encode($album))),
                    'userid_created' => $this->auth['id'],
                    'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
                    'price' => (int)str_replace('.','',$this->input->post('price')),
                    'price_sale' => (int)str_replace('.','',$this->input->post('price_sale')),
                    'price_contact' => is($this->input->post('price_contact')),
                    'publish_time' => merge_time($this->input->post('post_date'), $this->input->post('post_time')),
                );


                $flag = $this->Autoload_Model->_update(array(
                    'where' => array('id' => $id),
                    'table' => 'tour',
                    'data' => $_update,
                ));
                if($flag > 0){
                    // xóa đường dẫn cũ
                    $this->Autoload_Model->_delete(array(
                        'where' => array('canonical' => $tour['canonical'],'uri' => 'tour/frontend/tour/view','param' => $id),
                        'table' => 'router',
                    ));

                    // xóa catalogue_relationship cũ
                    $this->Autoload_Model->_delete(array(
                        'where' => array('module' => 'tour','moduleid' => $id),
                        'table' => 'catalogue_relationship',
                    ));

                    //tạo đường dẫn cho sản phẩm mới
                    $canonical = slug($this->input->post('canonical'));
                    createCanonical(array(
                        'module' => 'tour',
                        'canonical' => $canonical,
                        'resultid' => $id,
                    ));
                    //end

                    //tạo bảng catalogue_relationship mới
                    createCatalogue_relationship(array(
                        'module' => 'tour',
                        'catalogue' => $this->input->post('catalogue'),
                        'catalogueid' => $this->input->post('catalogueid'),
                        'resultid' => $id,
                    ));
                    //end
                    //xóa bảng attribute_relationship
                    $this->Autoload_Model->_delete(array(
                        'where' => array('module' => 'tour','moduleid' => $id),
                        'table' => 'attribute_relationship',
                    ));
                    //end
                    //thêm bảng attribute_relationship mới
                    $attr = $this->input->post('attr');
                    $temp = [];
                    if(isset($attr) && is_array($attr) && count($attr)){
                        foreach($attr as $key => $val){
                            $temp[] = array(
                                'moduleid' => $id,
                                'attrid' => $val,
                                'module' => 'tour',
                                'created' =>  gmdate('Y-m-d H:i:s', time() + 7*3600),
                            );
                        }
                    }
                    if(isset($temp) && is_array($temp) && count($temp)){
                        $this->Autoload_Model->_create_batch(array(
                            'table' => 'attribute_relationship',
                            'data' => $temp,
                        ));

                    }
                    //end

                    $this->session->set_flashdata('message-success', 'Cập nhật tour mới thành công');
                    redirect('tour/backend/tour/view?page='.$page);
                }
            }
        }
        $data['attribute_checked'] = $this->Autoload_Model->_get_where(array(
            'select' => 'moduleid,attrid',
            'table' => 'attribute_relationship',
            'where' => array('module' => 'tour', 'moduleid' => $id)), TRUE);

        $data['script'] = 'tour';
        $data['template'] = 'tour/backend/tour/update';
        $this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
    }
    public function duplicate($id = 0){
        $data = comment(array('id' => $id, 'module' => $this->module));
        $page = ($this->input->get('page')) ? $this->input->get('page') : 1;
        $this->commonbie->permission("tour/backend/tour/duplicate", $this->auth['permission']);

        $id = (int)$id;
        $tour = $this->Autoload_Model->_get_where(array(
            'select' => 'id, code, title, slug, canonical, description, meta_title, meta_description, tag, catalogueid, catalogue, image, image_json, price, price_sale, price_contact, publish, publish_time, extend_description, content_highlight,content_info',
            'table' => 'tour',
            'where' => array('id' => $id),
        ));
        if(!isset($tour) || is_array($tour) == false || count($tour) == 0){
            $this->session->set_flashdata('message-danger', 'tour không tồn tại');
            redirect('tour/backend/tour/view');
        }
        $tour['title'] = str_duplicate(array('value' => $tour['title']));
        $tour['canonical'] = str_duplicate(array('value' => $tour['canonical'], 'field' => 'canonical'));
        $data['tour'] = $tour;
        $data['price_contact'] =$tour['price_contact'];
        $data['image_json'] = json_decode(base64_decode($tour['image_json']), true);

        if($this->input->post('create')){
            //info
            /*$content_info = $this->input->post('content_info');
            $content_info_data = [];
            if(isset($content_info['title']) && is_array($content_info['title'])  && count($content_info['title'])) {
                foreach ($content_info['title'] as $key => $val) {
                    $content_info_data[] = array('title' => $val);
                }
            }
            if(isset($content_info_data) && is_array($content_info_data)  && count($content_info_data) && isset($content_info['description']) && is_array($content_info['description']) && count($content_info['description'])) {
                foreach ($content_info_data as $key => $val) {
                    $content_info_data[$key]['description'] = $content_info['description'][$key];
                }
            }
            $content_highlight = $this->input->post('content_highlight');*/


            //end
            $album = $this->input->post('album');
            $data = getDataPost($data);

            $this->load->library('form_validation');
            $this->form_validation->CI =& $this;
            $this->form_validation->set_error_delimiters('','/');
            $this->form_validation->set_rules('title', 'Tiêu đề tour', 'trim|required');
            $this->form_validation->set_rules('catalogueid', 'Danh mục chính', 'trim|is_natural_no_zero');
            $this->form_validation->set_rules('canonical', 'Đường dẫn bài viết', 'trim|required|callback__CheckCanonical');

            if($this->form_validation->run($this)){
                $_insert = array(
                    'title' => htmlspecialchars_decode(html_entity_decode($this->input->post('title'))),
                    'slug' => slug(htmlspecialchars_decode(html_entity_decode($this->input->post('title')))),
                    'canonical' => slug($this->input->post('canonical')),
                    'description' => $this->input->post('description'),
                    'extend_description' =>json_encode( $this->input->post('content')),
//                    'content_info' => json_encode($content_info),
//                    'content_highlight' => json_encode($content_highlight),
                    'catalogueid' => $this->input->post('catalogueid'),
                    'catalogue' => json_encode($this->input->post('catalogue')),
                    'meta_title' => $this->input->post('meta_title'),
                    'meta_description' => $this->input->post('meta_description'),
                    'publish' => $this->input->post('publish'),
                    'image' => is($album[0]),
                    'image_json' => is(base64_encode(json_encode($album))),
                    'userid_created' => $this->auth['id'],
                    'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
                    'price' => (int)str_replace('.','',$this->input->post('price')),
                    'price_sale' => (int)str_replace('.','',$this->input->post('price_sale')),
                    'price_contact' => is($this->input->post('price_contact')),
                    'publish_time' => merge_time($this->input->post('post_date'), $this->input->post('post_time')),
                    'alanguage' => $this->fclang
                );
                $resultid_main = $this->Autoload_Model->_create(array(
                    'table' => 'tour',
                    'data' => $_insert,
                ));

                if($resultid_main > 0){
                    //tạo đường dẫn cho sản phẩm
                    $canonical = slug($this->input->post('canonical'));
                    createCanonical(array(
                        'module' => 'tour',
                        'canonical' => $canonical,
                        'resultid' => $resultid_main,
                    ));
                    //end

                    //tạo bảng catalogue_relationship
                    createCatalogue_relationship(array(
                        'module' => 'tour',
                        'catalogue' => $this->input->post('catalogue'),
                        'catalogueid' => $this->input->post('catalogueid'),
                        'resultid' => $resultid_main,
                    ));
                    //end
                    //thêm bảng attribute_relationship mới
                    $attr = $this->input->post('attr');
                    $temp = [];
                    if(isset($attr) && is_array($attr) && count($attr)){
                        foreach($attr as $key => $val){
                            $temp[] = array(
                                'moduleid' => $resultid_main,
                                'attrid' => $val,
                                'module' => 'tour',
                                'created' =>  gmdate('Y-m-d H:i:s', time() + 7*3600),
                            );
                        }
                    }
                    if(isset($temp) && is_array($temp) && count($temp)){
                        $this->Autoload_Model->_create_batch(array(
                            'table' => 'attribute_relationship',
                            'data' => $temp,
                        ));

                    }
                    //end

                    $this->session->set_flashdata('message-success', 'Thêm tour mới thành công');
                    redirect('tour/backend/tour/view?page='.$page);
                }
            }
        }
        $data['attribute_checked'] = $this->Autoload_Model->_get_where(array(
            'select' => 'moduleid,attrid',
            'table' => 'attribute_relationship',
            'where' => array('module' => 'tour', 'moduleid' => $id)), TRUE);
        $data['script'] = 'tour';
        $data['template'] = 'tour/backend/tour/duplicate';
        $this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
    }
    public function order($page = 1){
        $this->commonbie->permission("tour/backend/tour/order", $this->auth['permission']);
        $keyword = $this->input->get('keyword');
        if(!empty($keyword)){
            $keyword = '(fullname LIKE \'%'.$keyword.'%\' OR email LIKE \'%'.$keyword.'%\')';
        }
        $config['total_rows'] = $this->Autoload_Model->_get_where(array(
            'select' => 'id',
            'table' => 'tour_book',
            'keyword' => $keyword,
            'count' => TRUE,
        ));
        if($config['total_rows'] > 0){
            $this->load->library('pagination');
            $config['base_url'] = base_url('tour/backend/tour/order');
            $config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
            $config['first_url'] = $config['base_url'].$config['suffix'];
            $config['per_page'] = 20;
            $config['cur_page'] = $page;
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
            $data['listData'] = $this->Autoload_Model->_get_where(array(
                'select' => '*',
                'table' => 'tour_book',
                'limit' => $config['per_page'],
                'start' => $page * $config['per_page'],
                'keyword' => $keyword,
                'order_by' => 'id desc',
            ), TRUE);
        }
        $data['script'] = 'tour_order';
        $data['template'] = 'tour/backend/tour/order';
        $this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
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
    public function _CheckAttribute($attribute = ''){
        $attribute = $this->input->post('attribute');
        $attribute_catalogue = $this->input->post('attribute_catalogue');
        if(isset($attribute) && is_array($attribute) && count($attribute)){
            foreach ($attribute as $key => $value) {
                if($value==''|| $value =null){
                    $this->form_validation->set_message('_CheckAttribute','Bạn phải chọn thuộc tính');
                    return false;
                }
            }
            return true;
        }
        if(isset($attribute_catalogue) && is_array($attribute_catalogue) && count($attribute_catalogue) && $attribute_catalogue != array(0)){
            $this->form_validation->set_message('_CheckAttribute','Bạn phải chọn thuộc tính');
            return false;
        }
    }
    public function _CheckAttribute_catalogue($attribute_catalogue = []){
        if(isset($attribute_catalogue) && is_array($attribute_catalogue) && count($attribute_catalogue) && $attribute_catalogue != Array(0 => 0)){
            foreach ($attribute_catalogue as $key => $value) {
                if($value==''|| $value ==null|| $value ==0){
                    $this->form_validation->set_message('_CheckAttribute_catalogue','Bạn phải chọn nhóm thuộc tính');
                    return false;
                }
            }
            return true;
        }
        return true;
    }
    public function _CheckQuantity_start(){
        $quantity_start = $this->input->post('quantity_start');
        if(isset($quantity_start) && is_array($quantity_start) && count($quantity_start)){
            foreach ($quantity_start as $key => $value) {
                if($value==''|| $value =null){
                    $this->form_validation->set_message('_CheckQuantity_start','Bạn phải nhập số lượng bán buôn');
                    return false;
                }
            }
            return true;
        }
        return true;
    }
    public function _CheckQuantity_end(){
        $quantity_end = $this->input->post('quantity_end');
        if(isset($quantity_end) && is_array($quantity_end) && count($quantity_end)){
            foreach ($quantity_end as $key => $value) {
                if($value==''|| $value =null){
                    $this->form_validation->set_message('_CheckQuantity_end','Bạn phải nhập số lượng bán buôn');
                    return false;
                }
            }
            return true;
        }
        return true;
    }
}


