<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		$this->module = 'user';
		$this->load->library('facebook');
		$this->load->library('google');
		$this->fc_lang = $this->config->item('fc_lang');
		$this->load->library(array('configbie'));
	}
	public function Loginajax()
	{
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
		$this->form_validation->set_error_delimiters('',' / ');
		$this->form_validation->set_rules('email','Tài khoản','trim|required');
		$this->form_validation->set_rules('password','Mật khẩu','trim|required|callback__CheckAuth');
		if($this->form_validation->run($this)){
			$email = $this->input->post('email');

			$user = $this->Autoload_Model->_get_where(array('select' => 'id, email, fullname,phone, address,password','table' => 'customer','where' => array('email' => $email)));
			$_update = array(
				'last_login' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				'user_agent' => $_SERVER['HTTP_USER_AGENT'],
				'remote_addr' => $_SERVER['REMOTE_ADDR']
			);

			$flag = $this->Autoload_Model->_update(array(
				'where' => array('id' => $user['id']),
				'table' => 'customer',
				'data' => $_update,
			));


			if($flag > 0){
				setcookie(CODE . 'customer', json_encode(array(
					'id' => $user['id'],
					'email' => $user['email'],
					'password' => $user['password'],
					'folder_upload' => ($user['id'] * 1010) * 1010 + 1010,
				)), time() + (86400 * 30), '/');
				echo json_encode(array(
					'message' => 'Đăng nhập thành công',
					'flag' => true,
				));
				die();
			}
		} else {
			$error = validation_errors();
			echo json_encode(array(
				'message' => $error,
				'flag' => false,
			));
			die();
		}

	}

	public function login(){
		if (isset($this->FT_auth) && is_array($this->FT_auth) && count($this->FT_auth)) {
            $this->session->set_flashdata('message-success', 'Bạn đã đăng nhập hệ thống');
            redirect('information');
		}
		if($this->input->post('login')){
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			$this->form_validation->set_error_delimiters('',' / '); 
			$this->form_validation->set_rules('email','Tài khoản','trim|required');
			$this->form_validation->set_rules('password','Mật khẩu','trim|required|callback__CheckAuth');
			if($this->form_validation->run($this)){
				$email = $this->input->post('email');
				
				$user = $this->Autoload_Model->_get_where(array('select' => 'id, email, fullname,phone, address,password','table' => 'customer','where' => array('email' => $email)));
				$_update = array(
					'last_login' => gmdate('Y-m-d H:i:s', time() + 7*3600),
					'user_agent' => $_SERVER['HTTP_USER_AGENT'],
					'remote_addr' => $_SERVER['REMOTE_ADDR']
				);
				
				$flag = $this->Autoload_Model->_update(array(
					'where' => array('id' => $user['id']),
					'table' => 'customer',
					'data' => $_update,
				));
				
				if($flag > 0){

//					$_SESSION[AUTH_FRONTEND.'auth'] = json_encode(array(
//						'id' => $user['id'],
//						'email' => $user['email'],
//						'fullname' => $user['fullname'],
//						'address' => $user['address'],
//						'phone' => $user['phone'],
//						'password' => $user['password'],
//						'folder_upload' => ($user['id'] * 1010) * 1010 + 1010,//Lưu ý: Nếu thêm Foder upload ảnh
//					));
					setcookie(CODE . 'customer', json_encode(array(
						'id' => $user['id'],
						'email' => $user['email'],
						'password' => $user['password'],
						'folder_upload' => ($user['id'] * 1010) * 1010 + 1010,
					)), time() + (86400 * 30), '/');
				}
				$this->session->set_flashdata('message-success', 'Đăng nhập thành công');
				redirect('information');
			}
		}
		$data['canonical'] = base_url('login');
		$data['meta_title'] = "Đăng nhập";
		$data['meta_description'] = "Đăng nhập";
		$data['og_type'] = 'login';
		$data['template'] = 'user/frontend/user/login';
		$this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);
	}

	public function register(){
		if (isset($this->FT_auth) && is_array($this->FT_auth) && count($this->FT_auth)) {
            if(!isset($this->FT_auth)) redirect('register');
            setcookie(CODE . 'customer', '', time() - 86400, '/');
            redirect('register');
		}
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$fullname = $this->input->post('fullname');
		$phone = $this->input->post('phone');
		if($this->input->post('register')){
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			$this->form_validation->set_error_delimiters('', ' / ');
            $this->form_validation->set_rules('catalogueid', 'Chọn tài khoản', 'trim|required');
            $this->form_validation->set_rules('email', 'Email(Tên đăng nhập)', 'trim|required|valid_email|callback__Email');
            $this->form_validation->set_rules('fullname', 'Họ và tên', 'trim|required');
            $this->form_validation->set_rules('phone', 'Số điện thoại','trim|required|max_length[10]|min_length[10]|callback__Phone');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required');
            if($_POST['catalogueid'] == 1){
                $this->form_validation->set_rules('address', 'Địa chỉ','trim|required');
                $this->form_validation->set_rules('account', 'Tên shop', 'trim|required');
            }

			if($this->form_validation->run($this)){
				$catalogue_title = !empty($this->input->post('catalogueid')==1)?"Cửa hàng":'Khách hàng';
				$salt = random();
				$password = password_encode($password, $salt);
				$_insert = array(
                    'email' => $email,
                    'password' => $password,
                    'salt' => $salt,
                    'created' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
                    'fullname' => $fullname,
                    'address' => $this->input->post('address'),
                    'phone' => $phone,
                    'publish' => 1,
                    'catalogueid' => $this->input->post('catalogueid'),
                    'catalogue_title' => $catalogue_title,
                    'account' => $this->input->post('account'),
                    'avatar' => 'template/not-found.png',
                    'images' => 'template/not-found.png',
                    'verify' => '',
				);
				$this->db->insert('customer', $_insert);
				$resultid = $this->db->insert_id();
				if ($resultid > 0) {
//					$verify = random(68, TRUE);
//					$this->load->library(array('mailbie'));
//					$this->mailbie->sent(array(
//						'to' => $this->input->post('email'),
//						'cc' => '',
//						'subject' => 'Xác nhận tài khoản',
//						'message' => 'Click vào link dưới để xác nhận tài khoản của bạn: ' . '<br>' . '<a href="' . BASE_URL . 'xac-minh.html?id=' . $resultid . '&verify=' . $verify . '" style="color:#3b5998;text-decoration:none;font-size:11px" target="_blank">' . (site_url('xac-minh') . '?id=' . $resultid . '&verify=' . $verify) . '</a>'
//					));
//					$flag = $this->Autoload_Model->_update(array(
//						'where' => array('id' => $resultid),
//						'table' => 'customer',
//						'data' => array('verify' => $verify),
//					));
//					if ($flag > 0) {
//						$this->session->set_flashdata('message-success', 'Đăng ký tài khoản thành công, vui lòng kiểm tra email');
//						redirect(base_url());
//
//					}
					$this->session->set_flashdata('message-success', 'Đăng ký tài khoản thành công');
					redirect('login');
				}
			}
		}
		$data['canonical'] = base_url('register');
		$data['meta_title'] = "Đăng ký";
		$data['meta_description'] = "Đăng ký";
		$data['og_type'] = 'register';
		$data['template'] = 'user/frontend/user/register';
		$this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);
	}
	public function registerajax()
	{
		$this->load->library('session');
		$this->load->helper('captcha');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$fullname = $this->input->post('fullname');
		$address = $this->input->post('address');
		$phone = $this->input->post('phone');
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
		$this->form_validation->set_error_delimiters('', ' / ');
		$this->form_validation->set_rules('catalogueid', 'Chọn tài khoản', 'trim|required');
		$this->form_validation->set_rules('email', 'Email(Tên đăng nhập)', 'trim|required|valid_email|callback__Email');
		$this->form_validation->set_rules('fullname', 'Họ và tên', 'trim|required');
		$this->form_validation->set_rules('phone', 'Số điện thoại','trim|required|max_length[10]|min_length[10]|callback__Phone');
		$this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required');
		if($_POST['catalogueid'] == 1){
            $this->form_validation->set_rules('address', 'Địa chỉ','trim|required');

            $this->form_validation->set_rules('account', 'Tên shop', 'trim|required');
		}




		if($this->form_validation->run($this)){
			/*
			$inputCaptcha = $this->input->post('captcha');
			$sessCaptcha = $this->session->userdata('captchaCode');
			if($inputCaptcha === $sessCaptcha){

			}else{
				$config = array(
					'img_path'      => 'captcha_images/',
					'img_url'       => base_url().'captcha_images/',
					'font_path'     => 'core3x/fonts/texb.ttf',
					'img_width'     => '160',
					'img_height'    => 40,
					'word_length'   => 6,
					'font_size'     => 18
				);
				$captcha = create_captcha($config);
				$this->session->unset_userdata('captchaCode');
				$this->session->set_userdata('captchaCode',$captcha['word']);
				echo json_encode(array(
					'message' => 'Mã capcha sai. Vui lòng nhập lại',
					'capcha' => $captcha['image'],
					'flag' => false,
				));
				die();
			}
			*/
			$catalogue_title = !empty($this->input->post('catalogueid')==1)?"Cửa hàng":'Khách hàng';
			$salt = random();
			$password = password_encode($password, $salt);
			$_insert = array(
				'email' => $email,
				'password' => $password,
				'salt' => $salt,
				'created' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
				'fullname' => $fullname,
				'address' => $address,
				'phone' => $phone,
				'publish' => 1,
				'catalogueid' => $this->input->post('catalogueid'),
				'catalogue_title' => $catalogue_title,
				'account' => $this->input->post('account'),
				'avatar' => 'template/not-found.png',
				'images' => 'template/not-found.png',
				'verify' => '',
			);
			$this->db->insert('customer', $_insert);
			$resultid = $this->db->insert_id();
			if ($resultid > 0) {
				//$this->session->unset_userdata('captchaCode');

				echo json_encode(array(
					'message' => 'Đăng ký thành công',
					'flag' => true,
				));
				die();
			}


		}else{
			/*
			$config = array(
				'img_path'      => 'captcha_images/',
				'img_url'       => base_url().'captcha_images/',
				'font_path'     => 'core3x/fonts/texb.ttf',
				'img_width'     => '160',
				'img_height'    => 40,
				'word_length'   => 6,
				'font_size'     => 18
			);
			$captcha = create_captcha($config);
			$this->session->unset_userdata('captchaCode');
			$this->session->set_userdata('captchaCode',$captcha['word']);
			*/
			$error = validation_errors();
			echo json_encode(array(
				'message' => $error,
				//'capcha' => $captcha['image'],
				'flag' => false,
			));
			die();
		}


	}
	public function verify()
	{
		$verify = $this->input->get('verify');
		$id = $this->input->get('id');
		if (isset($id) && $id > 0 && isset($verify) && !empty($verify)) {
			$customer = $this->Autoload_Model->_get_where(array(
				'select' => 'id,verify',
				'table' => 'customer',
				'where' => array(
					'id' => $id,
				),
			));
			if (!isset($customer) || is_array($customer) == FALSE || count($customer) == 0) {
				$this->session->set_flashdata('message-success', 'Tài khoản không tồn tại');
				redirect(base_url());
			}
			if ($customer['verify'] != $verify) {
				$this->session->set_flashdata('message-success', 'Mã xác nhận không hợp lệ');
				redirect(base_url());
			}
			$flag = $this->Autoload_Model->_update(array(
				'where' => array('id' => $customer['id']),
				'table' => 'customer',
				'data' => array('verify' => ''),
			));
			if ($flag > 0) {
				$this->session->set_flashdata('message-success', 'Xác minh tài khoản thành công, Bạn đã có thể đăng nhập vào hệ thống sau thông báo này');
				redirect('login');
			}
		}

	}

	public function forgotpassword(){
		if (isset($this->FT_auth) && is_array($this->FT_auth) && count($this->FT_auth)) {
			$this->session->set_flashdata('message-danger', 'Bạn đã đăng nhập');
			redirect(base_url());
		}
		$email = $this->input->get('email');
		$verify = $this->input->get('verify');
		if (isset($email) && !empty($email) && isset($verify) && !empty($verify)) {
			$user = $this->Autoload_Model->_get_where(array(
				'select' => 'id,email,verify',
				'table' => 'customer',
				'where' => array(
					'email' => $email,
				),
			));
			if (!isset($user) || is_array($user) == FALSE || count($user) == 0) {
				$this->session->set_flashdata('message-success', 'Tài khoản không tồn tại');
				redirect('login');
			}
			if ($user['verify'] != $verify) {
				$this->session->set_flashdata('message-success', 'Mã xác nhận không hợp lệ');
				redirect('login');
			}
			$salt = random();
			$newpassword = random(6, TRUE);
			$password = password_encode($newpassword, $salt);
			$flag = $this->Autoload_Model->_update(array(
				'where' => array('email' => $user['email']),
				'table' => 'customer',
				'data' => array(
					'verify' => '',
					'salt' => $salt,
					'password' => $password,
				)
			));
			if ($flag > 0) {
				$this->session->set_flashdata('message-success', 'Mật khẩu mới: <strong>' . $newpassword . '</strong>');
				redirect('login');
			}
		}
		if($this->input->post('forgot')){
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			$this->form_validation->set_error_delimiters('',' / ');
			$this->form_validation->set_rules('email','Tài khoản','trim|required|callback__CheckAuthForgot');
			if($this->form_validation->run($this)){
				$this->load->library(array('mailbie'));
				$user = $this->Autoload_Model->_get_where(array(
					'select' => 'id,email',
					'table' => 'customer',
					'where' => array(
						'email' => $this->input->post('email'),
					),
				));
				$verify = random(68, TRUE);
				$this->mailbie->sent(array(
						'to' => $user['email'],
						'cc' => '',
						'subject' => 'Yêu cầu lấy lại mật khẩu',
						'message' => 'Yêu cầu lấy lại mật khẩu của bạn. Bạn vui lòng Click link dưới để lấy mật khẩu mới cho tài khoản của bạn: <br/><a href="' . (site_url('forgot-password') . '?email=' . $user['email'] . '&verify=' . $verify) . '" style="color:#3b5998;text-decoration:none;font-size:11px" target="_blank">' . (site_url('forgot-password') . '?email=' . $user['email'] . '&verify=' . $verify) . '</a>'
					)
				);
				$flag = $this->Autoload_Model->_update(array(
					'where' => array('email' => $user['email']),
					'table' => 'customer',
					'data' => array('verify' => $verify),
				));
				if ($flag > 0) {
					$this->session->set_flashdata('message-success', 'Bạn gửi yêu cầu thành công!. Kiểm tra Email để xác nhận');
					redirect('login');
				}
			}
		}
		$data['canonical'] = base_url('forgot-password');
		$data['meta_title'] = "Quên mật khẩu";
		$data['meta_description'] = "Quên mật khẩu";
		$data['og_type'] = 'webiste';
		$data['template'] = 'user/frontend/user/forgot-password';
		$this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);
	}
    public function forgotpasswordajax(){

        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
        $this->form_validation->set_error_delimiters('',' / ');
        $this->form_validation->set_rules('email','Tài khoản','trim|required|callback__CheckAuthForgot');
        if($this->form_validation->run($this)){
            $this->load->library(array('mailbie'));
            $user = $this->Autoload_Model->_get_where(array(
                'select' => 'id,email',
                'table' => 'customer',
                'where' => array(
                    'email' => $this->input->post('email'),
                ),
            ));
            $salt = random();
            $newpassword = random(6, TRUE);
            $password = password_encode($newpassword, $salt);
            $this->Autoload_Model->_update(array(
                'where' => array('email' => $user['email']),
                'table' => 'customer',
                'data' => array(
                    'verify' => '',
                    'salt' => $salt,
                    'password' => $password,
                )
            ));
            $this->mailbie->sent(array(
                    'to' => $user['email'],
                    'cc' => '',
                    'subject' => 'Yêu cầu lấy lại mật khẩu',
                    'message' => 'Yêu cầu lấy lại mật khẩu của bạn. Mât khẩu mới của bạn là: '.$newpassword
                )
            );
            echo json_encode(array(
                'message' => 'Yêu cầu lấy lại mật khẩu thành công. Vui lòng kiểm tra Email của bạn',
                'flag' => true,
            ));
            die();
        }else{
            $error = validation_errors();
            echo json_encode(array(
                'message' => $error,
                'flag' => false,
            ));
            die();
        }

    }

	public function _CheckAuth(){
		$email = $this->input->post('email');
		//Kiểm tra xem cơ sở dữ liệu có tài khoản nào phù hợp không.
		$auth = $this->Autoload_Model->_get_where(array(
			'select' => 'id, email, fullname, email, password, salt,verify,publish',
			'table' => 'customer',
			'where' => array(
				'email' => $email,
			),
		));
		if(!isset($auth) || is_array($auth) == FALSE || count($auth) == 0){
			$this->form_validation->set_message('_CheckAuth','Tài khoản không tồn tại');
			return FALSE;
		}

		if (isset($auth) && $auth['verify'] != '') {
			$this->form_validation->set_message('_CheckAuth', 'Tài khoản chưa được xác minh');
			return FALSE;
		}
//        if (isset($auth) && $auth['publish'] == 1) {
//			$this->form_validation->set_message('_CheckAuth', 'Tài khoản đang chờ xét duyệt');
//			return FALSE;
//		}

		//Kiểm tra tiếp là mật khẩu có đúng hay không.
		$password = $this->input->post('password');
		$passwordCompare = password_encode($password, $auth['salt']);
		if($passwordCompare != $auth['password']){
			$this->form_validation->set_message('_CheckAuth','Mật khẩu không chính xác');
			return FALSE;
		}
		return TRUE;
	}
	public function _CheckAuthForgot(){
		$email = $this->input->post('email');
		//Kiểm tra xem cơ sở dữ liệu có tài khoản nào phù hợp không.
		$auth = $this->Autoload_Model->_get_where(array(
			'select' => 'id, email, fullname, email, password, salt,verify',
			'table' => 'customer',
			'where' => array(
				'email' => $email,
			),
		));
		if(!isset($auth) || is_array($auth) == FALSE || count($auth) == 0){
			$this->form_validation->set_message('_CheckAuthForgot','Tài khoản không tồn tại');
			return FALSE;
		}

		if (isset($auth) && $auth['verify'] != '') {
			$this->form_validation->set_message('_CheckAuthForgot', 'Tài khoản chưa được xác minh');
			return FALSE;
		}
		return TRUE;
	}
	public function _Email()
	{
		$email = $this->input->post('email');
		$count = $this->Autoload_Model->_get_where(array(
			'select' => 'email',
			'table' => 'customer',
			'where' => array(
				'email' => $email,
			),
		));
		if (!empty($count)) {
			$this->form_validation->set_message('_Email', 'Tên đăng nhập đã tồn tại');
			return false;
		}
		return true;
	}


	public function _Phone()
	{
		$phone = $this->input->post('phone');
		$count = $this->Autoload_Model->_get_where(array(
			'select' => 'phone',
			'table' => 'customer',
			'where' => array(
				'phone' => $phone,
			),
		));
		if (!empty($count)) {
			$this->form_validation->set_message('_Phone', 'Số điện thoại đã tồn tại');
			return false;
		}
		return true;
	}

	public function Logout(){
		if(!isset($this->FT_auth)) redirect();
//		unset($_SESSION[AUTH_FRONTEND.'auth']);
		setcookie(CODE . 'customer', '', time() - 86400, '/');

		redirect();
	}

	public function update(){
		$id = $this->FT_auth['id'];
		$data['slide'] = slide(array('keyword' => 'main-slide'));
		$detailuser = $this->Autoload_Model->_get_where(array(
			'select' => 'id, gender, fullname, birthday, address, academic_level, job, position, cmt, cmt_date, cmt_address, email, phone',
			'table' => 'user_frontend',
			'where' => array('id' => $id),
		));

		if(!isset($detailuser) || is_array($detailuser) == false || count($detailuser) == 0){
			$this->session->set_flashdata('message-danger', 'Tài khoản không tồn tại');
			redirect(BASE_URL);
		}

		if($this->input->post('update')){
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			$this->form_validation->set_error_delimiters('','/');
			$this->form_validation->set_rules('fullname', 'Tên liên lạc', 'trim|required');
			if($this->form_validation->run($this)){
				$_update = array(
					'fullname' => htmlspecialchars_decode(html_entity_decode($this->input->post('fullname'))),
					'birthday' => convert_time($this->input->post('birthday')),
					'gender' => $this->input->post('gender'),
					'address' => $this->input->post('address'),
					'academic_level' => $this->input->post('academic_level'),
					'job' => $this->input->post('job'),
					'position' => $this->input->post('position'),
					'cmt' => $this->input->post('cmt'),
					'cmt_date' => convert_time($this->input->post('cmt_date')),
					'cmt_address' => $this->input->post('cmt_address'),
					'email' => $this->input->post('email'),
					'phone' => $this->input->post('phone'),
					'userid_updated' => $this->auth['id'],
					'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				);
				$flag = $this->Autoload_Model->_update(array(
					'where' => array('id' => $id),
					'table' => 'user_frontend',
					'data' => $_update,
				));
				if($flag > 0){
					$this->session->set_flashdata('message-success', 'Cập nhật tài khoản thành công');
					redirect('user/frontend/user/update');
				}
			}
		}
		$data['detailuser'] = $detailuser;
		$data['template'] = 'user/frontend/user/update';
		$this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);
	}



	
	
	
}
