<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour extends MY_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		$this->load->helper(array('myfrontendcommon'));
		$this->load->library('nestedsetbie', array('table' => 'tour_catalogue'));
		$this->fc_lang = $this->config->item('fc_lang');
	}
	public function view($id = 0){
		$id = (int)$id;
        $publish_time = gmdate('Y-m-d H:i:s', time() + 7*3600);
		//chi tiết tour
		$tourDetail = $this->Autoload_Model->_get_where(array(
			'select' => 'id,viewed,title,extend_description,catalogueid,description,canonical,image_json,price,price_sale,price_contact',
			'table' => 'tour',
			'where' => array('publish_time <=' =>  $publish_time,'id' => $id, 'publish' => 0,'alanguage' => $this->fc_lang),
		));

        if(!isset($tourDetail) || is_array($tourDetail) == false || count($tourDetail) == 0){
            $this->session->set_flashdata('message-danger', 'Tour does not exist');
            redirect(BASE_URL);
        }
		//lấy danh sách comment
		$temp = '';
		//khối mở rộng
		$extend_description = json_decode($tourDetail['extend_description'], true);
		// print_r($extend_description);die;
		if(isset($extend_description) && is_array($extend_description) && count($extend_description)){
			foreach($extend_description as $key => $val){
				foreach($val as $keyChild => $valChild){
					if($key == 'title') $temp[$keyChild]['title'] = $valChild;
					else $temp[$keyChild]['desc'] = $valChild;
				}
			}
			krsort($extend_description['title']);
			krsort($extend_description['description']);
			$data['extend_description'] = $extend_description;
		}
        array_multisort(array_column($temp, 'title'), SORT_ASC, $temp);
        $data['prdExtendDesc'] = $temp;
		// xư li đương dân tơi san phâm
		$detailCatalogue = $this->Autoload_Model->_get_where(array(
			'select' => 'id, title, canonical, image, lft, rgt, description, article_json',
			'table' => 'tour_catalogue',
			'where' => array('id' => $tourDetail['catalogueid'],'alanguage' => $this->fc_lang),
		));
		$data['breadcrumb'] = $this->Autoload_Model->_get_where(array(
			'select' => 'id, title, slug, canonical, lft, rgt',
			'table' => 'tour_catalogue',
			'where' => array('lft <=' => $detailCatalogue['lft'],'rgt >=' => $detailCatalogue['lft'],'alanguage' => $this->fc_lang),
			'limit' => 1,
			'order_by' => 'lft ASC, order ASC'
		), TRUE);
		// câp nhât lươt xem tư nhiên
		updateView($tourDetail['id'], $tourDetail['viewed']);
		//tour liên quan
        $data['relaList'] = $this->Autoload_Model->_get_where(array(
            'select' => 'id,title,canonical,price,price_sale,price_contact,image,description,duration',
            'table' => 'tour',
            'limit' => 20,
            'where' => array('publish_time <=' =>  $publish_time,'publish' => 0,'catalogueid' => $detailCatalogue['id'],'id !=' => $id,'alanguage' => $this->fc_lang),
        ), true);
		//end tour liên quan
		$data['module'] = 'tour';
		$data['moduleid'] = $tourDetail['id'];
		$data['tourDetail'] = $tourDetail;
		$data['meta_title'] = !empty($tourDetail['meta_title'])?$tourDetail['meta_title']:$tourDetail['title'];
		$data['meta_description'] = !empty($tourDetail['meta_description'])?$tourDetail['meta_description']:cutnchar(strip_tags($tourDetail['description']), 320);
		$data['meta_image'] = !empty($tourDetail['image'])?base_url($tourDetail['image']):'';
		$data['detailCatalogue'] = $detailCatalogue;
		$data['canonical'] = rewrite_url($tourDetail['canonical'], TRUE, TRUE);
		$data['og_type'] = 'tour';
		$data['template'] = 'tour/frontend/tour/view';
		$this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);

	}
	public function book_tour(){
		$id = (int)$_GET['id'];
        $publish_time = gmdate('Y-m-d H:i:s', time() + 7*3600);
		//chi tiết tour
		$tourDetail = $this->Autoload_Model->_get_where(array(
			'select' => 'id,viewed,title,extend_description,catalogueid,description,canonical,image_json,price,price_sale,price_contact',
			'table' => 'tour',
			'where' => array('publish_time <=' =>  $publish_time,'id' => $id, 'publish' => 0,'alanguage' => $this->fc_lang),
		));

        if(!isset($tourDetail) || is_array($tourDetail) == false || count($tourDetail) == 0){
            $this->session->set_flashdata('message-danger', 'Tour does not exist');
            redirect(BASE_URL);
        }
		$data['moduleid'] = $tourDetail['id'];
		$data['tourDetail'] = $tourDetail;
		$data['meta_title'] = !empty($tourDetail['meta_title'])?'Book tour '.$tourDetail['meta_title']:'Book tour '.$tourDetail['title'];
		$data['meta_description'] = !empty($tourDetail['meta_description'])?$tourDetail['meta_description']:cutnchar(strip_tags($tourDetail['description']), 320);
		$data['meta_image'] = !empty($tourDetail['image'])?base_url($tourDetail['image']):'';
		$data['og_type'] = 'tour';
		$data['template'] = 'tour/frontend/tour/book_tour';
		$this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);

	}
    public function submit_book_tour(){
        $alert = array(
            'error' => '',
            'message' => '',
            'result' => ''
        );
        $id = $this->input->post('tourID');
        $publish_time = gmdate('Y-m-d H:i:s', time() + 7*3600);
        $tourDetail = $this->Autoload_Model->_get_where(array(
            'select' => 'id,viewed,title,extend_description,catalogueid,description,canonical,image_json,price,price_sale,price_contact,image',
            'table' => 'tour',
            'where' => array('publish_time <=' =>  $publish_time,'id' => $id, 'publish' => 0,'alanguage' => $this->fc_lang),
        ));
        if(!isset($tourDetail) || is_array($tourDetail) == false || count($tourDetail) == 0){
            $alert = array(
                'error' => 'Tour does not exist',
                'message' => '',
                'result' => ''
            );
        }
        $prd_info = getPriceFrontend(array('productDetail' => $tourDetail));

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', ' / ');
        $this->form_validation->set_rules('fullname', 'Fullname', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[11]|min_length[10]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');

        if ($this->form_validation->run()){
            $insert = array(
                'tourID' => $this->input->post('tourID'),
                'fullname' => $this->input->post('fullname'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address'),
                'message' => $this->input->post('message'),
                'created' => $this->currentTime,
            );
            $flag = $this->Autoload_Model->_create(array(
                'table' => 'tour_book',
                'data' => $insert
            ));
            /*
            if($flag > 0){
                $this->load->library(array('mailbie'));
                $this->mailbie->sent(array(
                    'to' => 'Booking tour',
                    'cc' => isset($_POST['email'])?$_POST['email'].','.$this->fcSystem['contact_email']:$this->fcSystem['contact_email'] ,
                    'subject' => 'Booking tour',
                    'message' => '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><div id="ht-order-email" style="max-width: 600px;margin: 0 auto;background: #fff;color: #444;font-size: 12px;font-family: Arial;line-height: 18px;"><div class="panel"><div class="panel-head" style="margin: 0 0 15px 0;padding: 35px 20px 10px 20px;border-bottom: 3px solid #00b7f1;"></div><div class="panel-body"><div class="infor"><div class="title"><h3 style="font-size:13px;font-weight:bold;color:#02acea;text-transform:uppercase;margin:20px 0 0 0;border-bottom:1px solid #ddd">Contact info <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">('.$this->currentTime.')</span></h3></div><table cellspacing="0" cellpadding="0" border="0" width="100%"><tbody><tr><td valign="top" style="padding:7px 9px 0px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444" colspan="2"><p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Fullname: </strong>'.$this->input->post('fullname').'<br><strong>Email:</strong> '.$this->input->post('email').' <br><strong>Phone: </strong> '.$this->input->post('phone').' <br><strong>Address: </strong>'.$this->input->post('address').' <br><strong>Note: </strong>'.$this->input->post('message').' <br></p></td></tr></tbody></table></div><div class="detail"><table cellspacing="0" cellpadding="0" border="0" width="100%" style="background:#f5f5f5"><thead><tr> <th colspan="2" align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Tour</th><th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px"> Price</th></tr></thead><tbody bgcolor="#eee" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px"><tr><td style="padding:5px 9px"><img style="width:40px ; height: 40px" src="'.$tourDetail['image'].'"></td><td style=" padding:5px 9px">'.$tourDetail['title'].'</td><td style="padding:5px 9px">$ '.$prd_info['price_final'].'</td></tbody></table></div></div></div></div>'
                ));

            }*/
        }else{
            $alert['error'] = validation_errors();
        }
        echo json_encode($alert); die();
    }

}
