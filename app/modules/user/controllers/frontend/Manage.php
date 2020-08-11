<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends MY_Controller
{

    public $module;

    function __construct()
    {
        parent::__construct();
        $this->module = 'user';
        if (empty($this->FT_auth['id'])) {
            $this->session->set_flashdata('message-danger', 'Bạn phải đăng nhập để sử dụng tính năng này');
            redirect(base_url());
        }

        $this->fc_lang = $this->config->item('fc_lang');
        $this->load->library(array('configbie'));

    }

    public function information()
    {

        $id = $this->FT_auth['id'];
        $data['detailCustomer'] = $this->Autoload_Model->_get_where(array(
            'select' => '*',
            'table' => 'customer',
            'where' => array('id' => $id),
        ));
        if ($this->input->post('update')) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('', ' / ');
            $this->form_validation->set_rules('fullname', 'Họ và tên', 'trim|required');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|required|max_length[11]|min_length[9]|is_natural');
            $this->form_validation->set_rules('address', 'Địa chỉ', 'trim|required');
            if($data['detailCustomer']['catalogueid'] == 1){
                $this->form_validation->set_rules('account', 'Tên shop', 'trim|required');
                $this->form_validation->set_rules('cityid', 'Tỉnh thành', 'trim|required');
                $this->form_validation->set_rules('product_catalogue_id', 'Loại cửa hàng', 'trim|required');
            }

//            $album=$this->input->post('album');
            if ($this->form_validation->run($this)) {
                $flag = $this->Autoload_Model->_update(array(
                    'where' => array('id' => $id),
                    'table' => 'customer',
                    'data' => array(
                        'fullname' => $this->input->post('fullname'),
                        'phone' => $this->input->post('phone'),
                        'address' => $this->input->post('address'),
                        'birthday' => $this->input->post('birthday'),
                        'zalo' => $this->input->post('zalo'),
                        'gender' => $this->input->post('gender'),
                        'account' => $this->input->post('account'),
                        'cityid' => $this->input->post('cityid'),
                        'product_catalogue_id' => $this->input->post('product_catalogue_id'),
                        'shop_link' => $this->input->post('shop_link'),
                        'shop_link_fanpage' => $this->input->post('shop_link_fanpage'),
                        'description' => $this->input->post('description'),
                        'updated' => gmdate('Y-m-d H:i:s', time() + 7 * 3600)),
                ));
                if ($flag > 0) {
                    //upload images
                    $config['upload_path'] = 'uploads/images/1000'.$this->FT_auth['id'];
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = 2000;
                    $config['max_width'] = 1500;
                    $config['max_height'] = 1500;
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('profile_pic')) {
                        $error = array('error' => $this->upload->display_errors());
                    } else {
                        $data = array('image_metadata' => $this->upload->data());
                        $this->Autoload_Model->_update(array(
                                'where' => array('id' => $id),
                                'table' => 'customer',
                                'data' => array(
                                    'images' => $config['upload_path'] . '/' . $data['image_metadata']['file_name'],
                                ))
                        );
                    }
                    if (!$this->upload->do_upload('profile_pic_qr')) {
                        $error = array('error' => $this->upload->display_errors());
                    } else {
                        $data = array('image_metadata' => $this->upload->data());
                        $this->Autoload_Model->_update(array(
                                'where' => array('id' => $id),
                                'table' => 'customer',
                                'data' => array(
                                    'images_qr' => $config['upload_path'] . '/' . $data['image_metadata']['file_name'],
                                ))
                        );
                    }
                    //end
                    $this->session->set_flashdata('message-success', 'Cập nhật hồ sơ thành công');
                    redirect('information');
                }
            }
        }
        $data['canonical'] = base_url('information');
        $data['meta_title'] = "Thông tin tài khoản";
        $data['meta_description'] = "Thông tin tài khoản";
        $data['og_type'] = 'website';
        $data['template'] = 'user/frontend/manage/information';
        $this->load->view('homepage/frontend/layout/home', isset($data) ? $data : NULL);
    }

    public function information_shop()
    {

        $id = $this->FT_auth['id'];
        $data['detailCustomer'] = $this->Autoload_Model->_get_where(array(
            'select' => '*',
            'table' => 'customer',
            'where' => array('id' => $id),
        ));
        if ($this->input->post('update')) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('', ' / ');
            $this->form_validation->set_rules('account', 'Tên shop', 'trim|required');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|required|max_length[11]|min_length[9]|is_natural');
            $this->form_validation->set_rules('address', 'Địa chỉ', 'trim|required');
            $this->form_validation->set_rules('cityid', 'Tỉnh thành', 'trim|required');
            $this->form_validation->set_rules('product_catalogue_id', 'Loại cửa hàng', 'trim|required');
//            $album=$this->input->post('album');
            if ($this->form_validation->run($this)) {
                $flag = $this->Autoload_Model->_update(array(
                    'where' => array('id' => $id),
                    'table' => 'customer',
                    'data' => array(
                        'account' => $this->input->post('account'),
                        'address' => $this->input->post('address'),
                        'cityid' => $this->input->post('cityid'),
                        'phone' => $this->input->post('phone'),
                        'product_catalogue_id' => $this->input->post('product_catalogue_id'),
                        'shop_link' => $this->input->post('shop_link'),
                        'shop_link_fanpage' => $this->input->post('shop_link_fanpage'),
                        'description' => $this->input->post('description'),
                        'updated' => gmdate('Y-m-d H:i:s', time() + 7 * 3600)),
                ));
                if ($flag > 0) {
                    $this->session->set_flashdata('message-success', 'Cập nhật hồ sơ thành công');
                    redirect('information-shop');
                }
            }
        }
        $data['canonical'] = base_url('information-shop');
        $data['meta_title'] = "Hồ sơ shop";
        $data['meta_description'] = "Hồ sơ shop";
        $data['og_type'] = 'website';
        $data['template'] = 'user/frontend/manage/information_shop';
        $this->load->view('homepage/frontend/layout/home', isset($data) ? $data : NULL);
    }

    public function change_pass()
    {
        $id = $this->FT_auth['id'];

        if ($this->input->post('update')) {
            $this->load->library('form_validation');
            $this->form_validation->CI =& $this;
            $this->form_validation->set_error_delimiters('', ' / ');
            $this->form_validation->set_rules('password', 'Mật khẩu cũ', 'trim|required|min_length[6]|callback__Password');
            $this->form_validation->set_rules('newpassword', 'Mật khẩu mới', 'trim|required|min_length[6]|max_length[12]');
            $this->form_validation->set_rules('renewpassword', 'Xác nhận mật khẩu mới', 'trim|required|min_length[6]|max_length[12]|matches[newpassword]');
            if ($this->form_validation->run($this)) {
                $salt = random();
                $password = password_encode($this->input->post('newpassword'), $salt);
                $_update = array(
                    'salt' => $salt,
                    'password' => $password,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'remote_addr' => $_SERVER['REMOTE_ADDR'],
                    'updated' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
                );
                $flag = $this->Autoload_Model->_update(array(
                    'where' => array('id' => $id),
                    'table' => 'customer',
                    'data' => $_update,
                ));
                if ($flag > 0) {
                    $this->session->set_flashdata('message-success', 'Thay đổi mật khẩu thành công');
                    redirect('change-pass');
                }
            }
        }
        $data['canonical'] = base_url('change-pass');
        $data['meta_title'] = "Đổi mật khẩu";
        $data['meta_description'] = "Đổi mật khẩu";
        $data['og_type'] = 'website';
        $data['template'] = 'user/frontend/manage/change_pass';
        $this->load->view('homepage/frontend/layout/home', isset($data) ? $data : NULL);
    }

    public function order_history($page = 1)
    {
        $this->load->library(array('configbie'));

        $id = $this->FT_auth['id'];
        $config['total_rows'] = $this->Autoload_Model->_get_where(array(
            'select' => 'id',
            'table' => 'order',
            'where' => array('userid' => $id),
            'count' => TRUE,
        ));

        if ($config['total_rows'] > 0) {
            $this->load->library('pagination');
            $config['base_url'] = base_url('order-history');
            $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
            $config['first_url'] = $config['base_url'] . $config['suffix'];
            $config['per_page'] = 20;
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
            $totalPage = ceil($config['total_rows'] / $config['per_page']);
            $page = ($page <= 0) ? 1 : $page;
            $page = ($page > $totalPage) ? $totalPage : $page;
            $page = $page - 1;
            $data['from'] = ($page * $config['per_page']) + 1;
            $data['to'] = ($config['per_page'] * ($page + 1) > $config['total_rows']) ? $config['total_rows'] : $config['per_page'] * ($page + 1);
            $data['listorder'] = $this->Autoload_Model->_get_where(array(
                'select' => 'id, created, order, total_cart_final, status, quantity',
                'table' => 'order',
                'where' => array('userid' => $id),
                'limit' => $config['per_page'],
                'start' => $page * $config['per_page'],
                'order_by' => 'order desc, id desc, fullname asc',
            ), TRUE);
        }

        $data['canonical'] = base_url('order-history');
        $data['meta_title'] = "Lịch sử mua hàng";
        $data['meta_description'] = "Lịch sử mua hàng";
        $data['og_type'] = 'order';
        $data['template'] = 'user/frontend/manage/order_history';
        $this->load->view('homepage/frontend/layout/home', isset($data) ? $data : NULL);
    }

    public function order_information()
    {
        $this->load->library(array('configbie'));

        $id = $this->input->get('id');
        $detailorder = $this->Autoload_Model->_get_where(array(
            'select' => 'id, fullname, created, cart_json, updated, order, total_cart_final, status,	quantity, promotional_detail, fullname , phone, email, note, address_detail, cityid, , cart_json, extend_json, districtid, wardid,
				(SELECT name FROM vn_province WHERE order.cityid = vn_province.provinceid) as address_city,
				(SELECT name FROM vn_district WHERE order.districtid = vn_district.districtid) as address_distric,
				(SELECT name FROM vn_ward WHERE order.wardid = vn_ward.wardid) as address_ward',
            'table' => 'order',
            'where' => array('id' => $id),
        ));
        $data['data_order'] = json_decode(base64_decode($detailorder['cart_json']), true);
        $detail_list_prd = $this->Autoload_Model->_get_where(array(
            'select' => 'id, title, created, price_final, moduleid, quantity, image, (SELECT code FROM product WHERE product.id = order_relationship.moduleid) as code',
            'table' => 'order_relationship',
            'where' => array('orderid' => $id),
        ), true);
        if (!isset($detailorder) || is_array($detailorder) == false || count($detailorder) == 0) {
            $this->session->set_flashdata('message-danger', 'Không tồn tại đơn hàng');
            redirect('order/backend/order/view');
        }

        $data['detailorder'] = $detailorder;
        $data['detail_list_prd'] = $detail_list_prd;

        $data['canonical'] = base_url('order-information');
        $data['meta_title'] = "Lịch sử mua hàng";
        $data['meta_description'] = "Lịch sử mua hàng";
        $data['og_type'] = 'order';
        $data['template'] = 'user/frontend/manage/order_information';
        $this->load->view('homepage/frontend/layout/home', isset($data) ? $data : NULL);
    }

    public function wishlist($page = 1)
    {
        $id = $this->FT_auth['id'];
        $json = [];
        $json[] = array('customer_wishlist as tb2', 'tb1.id = tb2.productid', 'full');
        $config['total_rows'] = $this->Autoload_Model->_get_where(array(
            'select' => 'tb1.id',
            'table' => 'product as tb1',
            'where' => array('tb1.publish' => 0, 'tb2.customerid' => $id),
            'join' => $json,
            'distinct' => 'true',
            'count' => TRUE,
        ));
        if ($config['total_rows'] > 0) {
            $this->load->library('pagination');
            $config['base_url'] = base_url('wish-list');
            $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
            $config['first_url'] = $config['base_url'] . $config['suffix'];
            $config['per_page'] = 20;
            $config['uri_segment'] = 2;
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
            $totalPage = ceil($config['total_rows'] / $config['per_page']);
            $page = ($page <= 0) ? 1 : $page;
            $page = ($page > $totalPage) ? $totalPage : $page;
            $page = $page - 1;
            $data['from'] = ($page * $config['per_page']) + 1;
            $data['to'] = ($config['per_page'] * ($page + 1) > $config['total_rows']) ? $config['total_rows'] : $config['per_page'] * ($page + 1);
            $data['listwishlist'] = $this->Autoload_Model->_get_where(array(
                'select' => 'tb1.id, tb1.title, tb1.canonical, tb1.price, tb1.price_sale, tb1.price_contact, tb1.image, tb1.version_json, tb1.image_color_json, tb1.order',
                'table' => 'product as tb1',
                'where' => array('tb1.publish' => 0, 'tb2.customerid' => $id),
                'limit' => $config['per_page'],
                'start' => $page * $config['per_page'],
                'order_by' => 'tb1.order asc, tb1.id desc',
                'join' => $json,
                'distinct' => 'true',
            ), TRUE);
        }


        $data['canonical'] = base_url('wish-list');
        $data['meta_title'] = "Sản phẩm yêu thích";
        $data['meta_description'] = "Sản phẩm yêu thích";
        $data['og_type'] = 'wishlist';
        $data['template'] = 'user/frontend/manage/wishlist';
        $this->load->view('homepage/frontend/layout/home', isset($data) ? $data : NULL);
    }

    public function _Password()
    {
        $password = $this->input->post('password');
        $id = $this->FT_auth['id'];
        $customer = $this->Autoload_Model->_get_where(array(
            'select' => 'salt,password',
            'table' => 'customer',
            'where' => array('id' => $id),
        ));
        $password_encode = password_encode($password, $customer['salt']);
        if ($customer['password'] != $password_encode) {
            $this->form_validation->set_message('_Password', 'Mật khẩu hiện tại không đúng');
            return FALSE;
        }
        return TRUE;
    }
    public function upload(){
        $id = $this->FT_auth['id'];

        if($_FILES['file']['name'] != ''){
            $test = explode('.', $_FILES['file']['name']);
            $extension = end($test);
            $name = rand(100,999).'.'.$extension;
            $location = 'uploads/images/1000'.$this->FT_auth['id'].'/'.$name;
            move_uploaded_file($_FILES['file']['tmp_name'], $location);
            $this->Autoload_Model->_update(array(
                    'where' => array('id' => $id),
                    'table' => 'customer',
                    'data' => array(
                        'images' => $location,
                    ))
            );
            echo '<img src="'.$location.'" alt="'.$this->FT_auth['fullname'].'" style="height: 75px;width: 100%;"/> <h4 class="title1" style="color: #012196;position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);">Tải lên ảnh shop</h4>';
        }
    }
    public function uploadQr(){
        $id = $this->FT_auth['id'];

        if($_FILES['file']['name'] != ''){
            $test = explode('.', $_FILES['file']['name']);
            $extension = end($test);
            $name = rand(100,999).'.'.$extension;
            $location = 'uploads/images/1000'.$this->FT_auth['id'].'/'.$name;
            move_uploaded_file($_FILES['file']['tmp_name'], $location);
            $this->Autoload_Model->_update(array(
                    'where' => array('id' => $id),
                    'table' => 'customer',
                    'data' => array(
                        'images_qr' => $location,
                    ))
            );
            echo '<img src="'.$location.'" alt="'.$this->FT_auth['fullname'].'" style="max-height: 100%;"/> <h4 class="title1" style="color: #012196;position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);">Tải lên ảnh shop</h4>';
        }
    }
    public function uploadVideo(){
        $alert = array(
            'error' => '',
            'message' => '',
            'result' => ''
        );
        $id = $this->FT_auth['id'];
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', ' / ');
        $this->form_validation->set_rules('urlvideo', 'URL video Youtube', 'trim|required');
        if ($this->form_validation->run()){
            $ex = explode('=',$this->input->post('urlvideo'));
            $this->Autoload_Model->_update(array(
                    'where' => array('id' => $id),
                    'table' => 'customer',
                    'data' => array(
                        'urlvideo' => $ex[1],
                    ))
            );
        }else{
            $alert['error'] = validation_errors();
        }
        echo json_encode($alert); die();
    }

}
