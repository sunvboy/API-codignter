<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model(array(
			'BackendAuth_Model',
		));

	}



	public function Login(){
		if(isset($this->auth)) redirect('dashboard/home/index');

		if($this->input->post('login')){
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
			$this->form_validation->set_error_delimiters('',' / ');
			$this->form_validation->set_rules('account','Tài khoản','trim|required');
			$this->form_validation->set_rules('password','Mật khẩu','trim|required|callback__CheckAuth');
			if($this->form_validation->run($this)){
				$account = $this->input->post('account');

				$user = $this->Autoload_Model->_get_where(array(
				    'select' => 'tb1.id, tb1.account, tb1.fullname, tb1.email,tb1. password, tb1.salt,tb2.permission',
                    'table' => 'user as tb1',
                    'join' => array(array('user_catalogue as tb2', 'tb1.catalogueid = tb2.id', 'inner')),
                    'where' => array('tb1.account' => $account,)
                ));
                $upload_permission = json_decode($user['permission'], TRUE);
                $temp_permission = [];
                if(isset($upload_permission) && is_array($upload_permission) && count($upload_permission)){
                    foreach($upload_permission as $key => $val){
                        $explode = explode('/', $val);
                        if($explode[2] == 'files' || $explode[2] == 'dirs'){
                            $temp_permission[] = $val;
                        }
                    }
                }
				$_update = array(
					'last_login' => gmdate('Y-m-d H:i:s', time() + 7*3600),
					'user_agent' => $_SERVER['HTTP_USER_AGENT'],
					'remote_addr' => $_SERVER['REMOTE_ADDR']
				);

				$flag = $this->Autoload_Model->_update(array(
					'where' => array('id' => $user['id']),
					'table' => 'user',
					'data' => $_update,
				));

				if($flag > 0){
					$_SESSION[AUTH.'auth'] = json_encode(array(
						'id' => $user['id'],
						'account' => $user['account'],
						'email' => $user['email'],
						'password' => $user['password'],
						'folder_upload' => $user['account'],
						'lang' => $this->input->post('lang'),
					));
                    setcookie(CODE.'auth', json_encode(array(
                        'id' => $user['id'],
                        'email' => $user['email'],
                        'password' => $user['password'],
                        'permission' => $temp_permission,
                        'lang' => $this->input->post('lang'),
                        'folder_upload' => ($user['id'] * 168) * 168 + 168,
                    )), time() + (86400 * 30), '/');
				}
				$this->session->set_flashdata('message-success', 'Đăng nhập thành công');
				redirect(base_url('dashboard/home/index'));
			}
		}

		$this->load->view('user/backend/auth/login');
	}

	public function Recovery(){
		if(isset($this->auth)) redirect('dashboard/home/index');



		$this->load->view('user/backend/auth/recovery');
	}

	public function Logout(){
		if(!isset($this->auth)) redirect('sadmin');
        setcookie(CODE.'auth', '', time() - 86400, '/');
		unset($_SESSION[AUTH.'auth']);
		redirect('sadmin');
	}


	public function _CheckAuth(){
		$account = $this->input->post('account');
		//Kiểm tra xem cơ sở dữ liệu có tài khoản nào phù hợp không.
		$auth = $this->Autoload_Model->_get_where(array(
			'select' => 'id, account, fullname, email, password, salt',
			'table' => 'user',
			'where' => array(
				'account' => $account,
			),
		));
		if(!isset($auth) || is_array($auth) == FALSE || count($auth) == 0){
			$this->form_validation->set_message('_CheckAuth','Tài khoản hoặc mật khẩu không chính xác');
			return FALSE;
		}
		//Kiểm tra tiếp là mật khẩu có đúng hay không.
		$password = $this->input->post('password');
		$passwordCompare = password_encode($password, $auth['salt']);
		if($passwordCompare != $auth['password']){
			$this->form_validation->set_message('_CheckAuth','Tài khoản hoặc mật khẩu không chính xác');
			return FALSE;
		}
		return TRUE;
	}

}
