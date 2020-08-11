<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Commonbie{



    function __construct($params = NULL){

        $this->CI =& get_instance();



    }

    public function CheckLang(){

        $auth = (isset($_SESSION[AUTH.'auth'])) ? $_SESSION[AUTH.'auth'] : '';

        if(!isset($auth) || empty($auth)) return NULL;

        $auth = json_decode($auth, TRUE);

        if(!isset($auth['lang']) && !empty($auth['lang'])){

            $lang = 'vietnamese';

        }

        else{

            $lang = $auth['lang'];

        }

        return $lang;

    }





    public function CheckCustomerAuth(){

        $customer = isset($_COOKIE[CODE.'customer'])?$_COOKIE[CODE.'customer']:NULL;

        $customer = isset($customer)?$customer:NULL;

        if(!isset($customer) || empty($customer)) return NULL;

        $customer = json_decode($customer, TRUE);

        $customer_auth = $this->CI->Autoload_Model->_get_where(array(

            'select' => 'id,fullname,phone,email,address,cityid,districtid,wardid,account,images,created,avatar,catalogueid',

            'table' => 'customer',

            'where' => array(
                'email' => $customer['email'],
                'password' => $customer['password'],
            ),

        ));

        if(!isset($customer_auth) || is_array($customer_auth) == FALSE || count($customer_auth) == 0){

            setcookie(CODE . 'customer', '', time() - 86400, '/');

            return NULL;

        }

        return $customer_auth;

    }



    // Hàm này trả về thông tin tài khoản của người đang đăng nhập. Nếu ko có tình trạng đăng nhập trả về NULL;

    public function CheckBackendAuthentication(){

        $auth = (isset($_SESSION[AUTH.'auth'])) ? $_SESSION[AUTH.'auth'] : '';

        if(!isset($auth) || empty($auth)) return NULL;

        $auth = json_decode($auth, TRUE);

        $user = $this->CI->Autoload_Model->_get_where(array(

            'select' => 'id, account, fullname, email, password, avatar, salt, (SELECT permission FROM user_catalogue WHERE user_catalogue.id = user.catalogueid ) as permission, (SELECT title FROM user_catalogue WHERE user.catalogueid = user_catalogue.id) as catalogue,',



            'table' => 'user',

            'where' => array(

                'id' => $auth['id'],

            ),

        ));



        if(!isset($user) || is_array($user) == FALSE || count($user) == 0){

            unset($_SESSION[AUTH.'auth']);

            return NULL;

        }

//		var_dump($user);die;



        return $user;



    }



    public function permission($access = '', $permission = ''){

        $permission=json_decode($permission, true);

        if(!in_array($access, $permission)){

            $this->CI->session->set_flashdata('message-danger','Bạn không có quyền truy cập vào chức năng này');

            redirect('dashboard/home');

        }

    }





}

