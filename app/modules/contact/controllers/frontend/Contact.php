<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {

	public $module;
	public function __construct(){
		parent::__construct();
		$this->load->helper(array("form", "url", "captcha"));
        $this->fc_lang = $this->config->item('fc_lang');

    }

	public function view(){

		$data['header'] = FALSE;
		$data['meta_title'] = 'Liên hệ';
		$data['meta_keyword'] = '';
		$data['meta_description'] = '';
		$data['template'] = 'contact/frontend/contact/view';
		$this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);
	}
    public function ajaxSendcontact(){
        $alert = array(
            'error' => '',
            'message' => 'Gửi thông tin liên hệ thành công!',
            'result' => ''
        );
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', ' / ');
        $this->form_validation->set_rules('fullname', 'Họ và tên', 'trim|required');
        $this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|required|max_length[11]|min_length[10]');

        if ($this->form_validation->run()) {

            $insert = array(
                'fullname' => $this->input->post('fullname'),
//                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
//                'address' => $this->input->post('address'),
                'title' => 'Gửi thông tin liên hệ',
                'message' => $this->input->post('message'),
                'type' => 0,
                'created' => $this->currentTime,
            );
            $this->Autoload_Model->_create(array(
                'table' => 'contact',
                'data' => $insert
            ));
        } else {
            $alert['error'] = validation_errors();
        }
        echo json_encode($alert);
        die();
    }
	public function create(){
		$alert = array(
			'error' => '',
			'message' => '',
			'result' => ''
		);
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', ' / ');
		$this->form_validation->set_rules('fullname', 'họ và tên', 'trim|required');
		$this->form_validation->set_rules('phone', 'số điện thoại', 'trim|required|max_length[11]|min_length[10]');
		$this->form_validation->set_rules('email', 'Địa chỉ Email', 'trim|required|valid_email');
		if ($this->form_validation->run()){
			$insert = array(
				'fullname' => $this->input->post('fullname'),
				'chinhanh' => $this->input->post('chinhanh'),
				'namsinh' => $this->input->post('namsinh'),
				'address' => $this->input->post('address'),
				'phone' => $this->input->post('phone'),
				'productID' => $this->input->post('productID'),
				'email' => $this->input->post('email'),
				'title' => 'Đăng ký tư vấn',
				'type' => 1,
				'created' => $this->currentTime,
			);
			$this->Autoload_Model->_create(array(
				'table' => 'contact',
				'data' => $insert
			));
		}else{
			$alert['error'] = validation_errors();
		}
		echo json_encode($alert); die();
	}



}
