<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	// public function sleep(){
	// 	sleep(2);
	// }

	public function bookmark(){
		// echo 1;die;

		$id = $this->input->post('idContact');
		$bookmark = $this->input->post('bookmark');
		$_update['bookmark'] = ($bookmark == 0) ? 1 : 0 ;
		$this->Autoload_Model->_update(array(
			'where' => array('id' => $id),
			'table' => 'contact',
			'data' => $_update,
		));
	}

	public function viewed(){
		$id = $this->input->post('id');
		$viewed = $this->input->post('viewed');
		// echo $viewed; die();
		if($viewed == 0){
			$viewed =1;
			$_update['viewed'] = $viewed;
			$result = $this->Autoload_Model->_update(array(
				'where' => array('id' => $id),
				'table' => 'contact',
				'data' => $_update,
			));
			echo $result; die();
		}
	}

    public function listContact()
    {
        $page = (int)$this->input->get('page');
        $data['from'] = 0;
        $data['to'] = 0;
        if (!empty($_GET['module']) && $_GET['module'] == 'registration') {
            $table = 'registration';

        } else if( $_GET['module'] == 'contact') {
            $table = 'contact';
        }else if( $_GET['module'] == 'mailsubricre') {
            $table = 'contact';
        }
        $perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 5;
        $keyword = $this->db->escape_like_str($this->input->get('keyword'));
        $catalogueid = (int)$this->input->get('catalogueid');
        if ($catalogueid > 0) {
            $config['total_rows'] = $this->Autoload_Model->_get_where(array(
                'select' => 'id',
                'table' => $table,
                'count' => TRUE,
                // 'where' => array('catalogueid' => $catalogueid),
                'where' => ($catalogueid == 0) ? '' : array('catalogueid' => $catalogueid),
                'keyword' => '(fullname LIKE \'%' . $keyword . '%\' OR phone LIKE \'%' . $keyword . '%\' OR email LIKE \'%' . $keyword . '%\')',
            ));
        } else if($_GET['module'] == 'contact'){
            $config['total_rows'] = $this->Autoload_Model->_get_where(array(
                'select' => 'id',
                'table' => $table,
                'count' => TRUE,
                'where' => ($catalogueid ==0) ? array('type'=>0) : array( 'catalogueid' => $catalogueid,'type'=>0) ,
                'keyword' => '(fullname LIKE \'%' . $keyword . '%\' OR phone LIKE \'%' . $keyword . '%\' OR email LIKE \'%' . $keyword . '%\')',
            ));
        }else if($_GET['module'] == 'mailsubricre'){
            $config['total_rows'] = $this->Autoload_Model->_get_where(array(
                'select' => 'id',
                'table' => $table,
                'count' => TRUE,
                'where' => ($catalogueid ==0) ? array('type'=>1) : array( 'catalogueid' => $catalogueid,'type'=>1) ,
                'keyword' => '(fullname LIKE \'%' . $keyword . '%\' OR phone LIKE \'%' . $keyword . '%\' OR email LIKE \'%' . $keyword . '%\')',
            ));
        }
        $html = '';
        if ($config['total_rows'] > 0) {
            $this->load->library('pagination');
            $config['base_url'] = base_url('contact/backend/contact/view');
            $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
            $config['first_url'] = $config['base_url'] . $config['suffix'];
            $config['per_page'] = $perpage;
            $config['cur_page'] = $page;
            $config['page'] = $page;
            $config['uri_segment'] = 5;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
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
            $listPagination = $this->pagination->create_links();
            $totalPage = ceil($config['total_rows'] / $config['per_page']);
            $page = ($page <= 0) ? 1 : $page;
            $page = ($page > $totalPage) ? $totalPage : $page;
            $page = $page - 1;
            $data['from'] = ($page * $config['per_page']) + 1;
            $data['to'] = ($config['per_page'] * ($page + 1) > $config['total_rows']) ? $config['total_rows'] : $config['per_page'] * ($page + 1);

            if (!empty($_GET['module']) && $_GET['module'] == 'registration') {
                $listContact = $this->Autoload_Model->_get_where(array(
                    'select' => '*, (SELECT title FROM training_catalogue WHERE training_catalogue.id = registration.nganhhoc) as catalogueTitle',
                    'table' => 'registration',
                    'keyword' => '(fullname LIKE \'%' . $keyword . '%\' OR phone LIKE \'%' . $keyword . '%\' OR email LIKE \'%' . $keyword . '%\')',
                    'start' => $page * $config['per_page'],
                    'limit' => $config['per_page'],
                    'order_by' => 'created desc',
                ), TRUE);
                if (isset($listContact) && is_array($listContact) && count($listContact)) {
                    foreach ($listContact as $key => $val) {
                        $html = $html . '<tr class="gradeX" id="">
													<td class="pd-top text-center pdt25" >
														<input type="checkbox" name="checkbox[]" value="'. $val['id'].'" class="checkbox-item">
														<label for="" class="label-checkboxitem"></label>
													</td>

													<td class="pd-top">
														<div class="">
															'.$val['fullname'].'<br>
															<b>Số điện thoại:</b> '. $val['phone'].'<br>
															<b>Email:</b> '. $val['email'].'<br>
															<b>Địa chỉ:</b> '. $val['address'].'<br>
															<b>Năm sinh:</b> '. $val['namsinh'].'<br>
														</div>
													</td>
													<td class="pd-top">
														'. $val['catalogueTitle'].'
													</td>
													<td class="pd-top">
														'. $val['trinhdo'].'
													</td>
													<td class="pd-top">

														<div class="">
															<a class="detail-contact subtitle-1">
																'. $val['message'].'
															</a>
														</div>
													</td>
													<td class="pd-top text-center">'. gettime($val['created'],' h:i:s d/m/Y').'</td>
													<td class="text-center actions" style="padding-top:18px;">

														<a  type="button" class="btn btn-danger btn-delete ajax-delete"  data-id="'.$val['id'].'" data-title="Lưu ý: Khi bạn xóa nhóm, toàn bộ thành viên trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!" data-router="" data-module="registration" data-child=""><i class="fa fa-trash"></i></a>
													</td>
												</tr>';
                    }
                }


            }
            else if( $_GET['module'] == 'contact'){
                $listContact = $this->Autoload_Model->_get_where(array(
                    'select' => 'id, file, viewed, fullname, email, phone, created, subject, message, bookmark,(SELECT title FROM contact_catalogue WHERE contact_catalogue.id = contact.catalogueid) as catalogueTitle',
                    'table' => 'contact',
                    'where' => ($catalogueid ==0) ? array('type'=>0) : array( 'catalogueid' => $catalogueid,'type'=>0) ,
                    'keyword' => '(fullname LIKE \'%' . $keyword . '%\' OR phone LIKE \'%' . $keyword . '%\' OR email LIKE \'%' . $keyword . '%\')',
                    'start' => $page * $config['per_page'],
                    'limit' => $config['per_page'],
                    'order_by' => 'viewed asc, created desc',
                ), TRUE);
                if (isset($listContact) && is_array($listContact) && count($listContact)) {
                    foreach ($listContact as $key => $val) {

                        $html = $html.'<tr class="gradeX" id="">
													<td class="pd-top text-center pdt25" >
														<input type="checkbox" name="checkbox[]" value="' . $val['id'] . '" class="checkbox-item">
														<label for="" class="label-checkboxitem"></label>
													</td>
												
													<td class="pd-top">
														<a data-id="' . $val['id'] . '" data-viewed="' . $val['viewed'] . '" class="detail-contact title-1" href="" >'.$val['fullname'].'</a>
														<div class="">
															<a data-id="' . $val['id'] . '" data-viewed="' . $val['viewed'] . '" href="" class="detail-contact subtitle-1 " title="' . $val['phone'] . '">
																' . $val['phone'] . '<br>
																'.$val['email'].'<br>
															</a>
														</div>
													</td>
													<td class="pd-top">
														<a data-id="' . $val['id'] . '" data-viewed="' . $val['viewed'] . '" class="maintitle detail-contact title-1 " style="" href="" title="">
															'.$val['subject'].'
														</a>
														<div class="">
															<a data-id="' . $val['id'] . '" data-viewed="' . $val['viewed'] . '" href="" class="detail-contact subtitle-1" title="">
																'.$val['message'].'
															</a>
														</div>
													</td>
													<td class="pd-top text-center">'. gettime($val['created'],' h:i:s d/m/Y').'</td>
													<td class="text-center actions" style="padding-top:18px;">

														<a  type="button" class="btn btn-danger btn-delete ajax-delete"  data-id="' . $val['id'] . '" data-title="Lưu ý: Khi bạn xóa nhóm, toàn bộ thành viên trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!" data-router="" data-module="contact" data-child=""><i class="fa fa-trash"></i></a>
													</td>
												</tr>';
                    }
                }
            }else if($_GET['module'] == 'mailsubricre'){
                $listContact = $this->Autoload_Model->_get_where(array(
                    'select' => '*,(SELECT title FROM contact_catalogue WHERE contact_catalogue.id = contact.catalogueid) as catalogueTitle',
                    'table' => 'contact',
                    'where' => ($catalogueid ==0) ? array('type'=>1) : array( 'catalogueid' => $catalogueid,'type'=>1) ,
                    'keyword' => '(fullname LIKE \'%' . $keyword . '%\' OR phone LIKE \'%' . $keyword . '%\' OR email LIKE \'%' . $keyword . '%\')',
                    'start' => $page * $config['per_page'],
                    'limit' => $config['per_page'],
                    'order_by' => 'viewed asc, created desc',
                ), TRUE);
                if (isset($listContact) && is_array($listContact) && count($listContact)) {
                    foreach ($listContact as $key => $val) {

                        $html = $html.'<tr class="gradeX" id="">
                                                <td class="pd-top text-center pdt25" >
                                                    <input type="checkbox" name="checkbox[]" value="'.$val['id'].'" class="checkbox-item">
                                                    <label for="" class="label-checkboxitem"></label>
                                                </td>

                                                <td class="pd-top">
                                                    <a data-id="' . $val['id'] . '" data-viewed="' . $val['viewed'] . '" class="detail-contact title-1" href="" >'. $val['fullname'].'</a>
                                                    <br>'. $val['phone'].'<div class="">
                                                        <a data-id="' . $val['id'] . '" data-viewed="' . $val['viewed'] . '" href="" class="detail-contact subtitle-1" >'.$val['email'].'</a>
                                                    </div><br>
                                                     '. $val['address'].'<br>Năm sinh:  '. $val['namsinh'].'
                                                </td>
                                                <td>
                                                '. $val['chinhanh'].'
</td>
   <td>
                                                '. $val['productID'].'
</td>

                                                <td class="pd-top text-center">'.gettime($val['created'],' h:i:s d/m/Y').'</td>
                                                <td class="text-center actions" style="padding-top:18px;">
                                                    <a  type="button" class="btn btn-danger btn-delete ajax-delete"  data-id="' . $val['id'] . '" data-title="Lưu ý: Khi bạn xóa nhóm, toàn bộ thành viên trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!" data-router="" data-module="contact" data-child=""><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>';
                    }
                }
            }



        } else {
            $html = $html . '<tr><td colspan="9"><small class="text-danger">Không có dữ liệu phù hợp</small></td></tr> ';
        }
        echo json_encode(array(
            'pagination' => (isset($listPagination)) ? $listPagination : '',
            'html' => (isset($html)) ? $html : '',
            'total' => $config['total_rows'],
        ));
        die();
    }




    /* ================ delete ======================= */
	public function ajax_delete(){
		$param['module'] = $this->input->post('module');
		$param['id'] = (int)$this->input->post('id');
		$param['child'] = (int)$this->input->post('child');

		$flag = $this->Autoload_Model->_delete(array(
			'where' => array('id' => $param['id']),
			'table' => $param['module']
		));
		echo $flag; die();
	}

	public function ajax_group_delete(){
		$param = $this->input->post('param');
		if(isset($param['list']) && is_array($param['list']) && count($param['list'])){
			foreach($param['list'] as $key => $val){
				$result = $this->Autoload_Model->_delete(array(
					'where' => array('id' => $val),
					'table' => $param['module'],
				));
				if($result > 0){
					$countChild = $this->Autoload_Model->_get_where(array(
						'where' => array('catalogueid' => $val),
						'table' => 'contact',
						'count' => TRUE,
					));
					if($countChild >0){
						$resultChild = $this->Autoload_Model->_delete(array(
							'where' => array('catalogueid' => $val),
							'table' => 'contact',
						));
						if($resultChild <= 0){
							$error = array(
								'flag' => 1,
								'message' => 'Xóa không thành công phần tử con trong nhóm',
							);
							echo json_encode(array(
								'error' => $error,
							));die;
						}
					}else{
						$error = array(
							'flag' => 1,
							'message' => 'Xóa không thành công',
						);
						echo json_encode(array(
							'error' => $error,
						));die;
					}
				}
				$error = array(
					'flag' => 0,
					'message' => '',
				);
				echo json_encode(array(
					'error' => $error,
				));die;
			}
		}
	}
	
	
	public function phone_call(){
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
		$this->form_validation->set_error_delimiters('','/');
		$this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|required|is_numeric|min_length[10]|max_length[11]');
		if($this->form_validation->run($this)){
			$this->load->library(array('mailbie'));
			$this->mailbie->sent(array(
				'to' => 'tuannc.dev@gmail.com',
				'cc' => 'minhphuong2811.tb@gmail.com',
				'subject' => 'Thông tin khách hàng: ',
				'message' => '<div>Số điện thoại: <span style="color:red;">'.$this->input->post('phone').'</span></div>',
			));
			$this->session->set_flashdata('message-success', 'Gửi thông tin thành công, Chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất');
			$error['flag'] = 0;
			$error['message'] = ''; 
		}else{
			$error['flag'] = 1;
			$error['message'] = validation_errors(); 
			
		}
		echo json_encode(array(
			'error' => $error,
		));die();
	}

	public function save_contact_register(){
		if($this->input->post('data')){
			$data = $this->input->post('data');
			$email = $this->input->post('email');
			
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			
			
			if($this->form_validation->run($this)){
				$error = '';
				//validate thành công tiến hành lưu thông tin vào db contact
				$_insert = array(
					'subject' => 'Đăng ký nhận bản tin ưu đãi',
					'email' => $email,
					'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				);
				
				$insertId = $this->Autoload_Model->_create(array(
					'table' => 'contact',
					'data' => $_insert,
				));

				//gửi email
				$this->load->library('mailbie');
					
				$this->mailbie->sent(array(
					'to' => array('tudo2109@gmail.com'),
					'cc' => '',
					'subject' => 'Yêu cầu đăng ký nhận thông báo từ hệ thống '.$this->fcSystem['contact_website'].'',
					'message' =>	'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
									<section class="mail-content" style="border: 1px solid #E5E5E5;">
										<div class="header" style="background: #0077bc; padding: 15px;border-bottom: 1px solid #E5E5E5;">
											<h2><span style="display: block; color: #fff; font-size: 18px;text-transform: uppercase;text-align: center;">Thông tin khách hàng</span></h2>
										</div>
										<div class="content" style="padding: 0 15px;">
											<p style="margin-bottom: 10px;"><label class="md-label" style="font-size: 13px;font-weight: 600; margin-right: 20px;">Email: </label><span style="text-transform: capitalize;">'.$email.'</span></p>
										</div>
									</section>
									',
				));	

				$this->mailbie->sent(array(
					// 'to' => array($this->fcSystem['contact_email']),
					'to' => array($email),
					'cc' => '',
					'subject' => 'Thông báo từ hệ thống '.$this->fcSystem['contact_website'].'',
					'message' =>	'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
									<section class="mail-content" style="border: 1px solid #E5E5E5;">
										<div class="header" style="background: #0077bc; padding: 15px;border-bottom: 1px solid #E5E5E5;">
											<h2><span style="display: block; color: #fff; font-size: 18px;text-transform: uppercase;text-align: center;">'.$this->fcSystem['contact_website'].' chào mừng bạn</span></h2>
										</div>
										<div class="content" style="padding: 0 15px;">
											'.$this->fcSystem['email_content_1'].'
										</div>

									</section>
									',
				));

				
				if($insertId > 0){
					echo json_encode(array(
						'error' => $error,
					));die;
				}
				
				echo json_encode(array(
					'error' => 'Đã có lỗi xảy ra. Xin vui lòng quay lại sau ít phút !',
				));die;
				
			}else{
				echo json_encode(array(
					'error' => validation_errors(),
				)); die;
			}
			
		}
	}


	public function save(){
		$post = $this->input->post('post');
		$temp = '';
		if(isset($post) && is_array($post) && count($post)){
			foreach($post as $key => $val){
				$temp[$val['name']] =  $val['value'];
			}


		}

		if(isset($temp) && is_array($temp) && count($temp)){
			$html = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
						<section class="mail-content" style="border: 1px solid #E5E5E5;">
							<div class="header" style="background: #0077bc; padding: 15px;border-bottom: 1px solid #E5E5E5;">
								<h2><span style="display: block; color: #fff; font-size: 18px;text-transform: uppercase;text-align: center;">Thông tin liên hệ</span></h2>
							</div>
							<div class="content" style="padding: 0 15px;">';
								if (isset($temp) && is_array($temp) && count($temp)) {
									$html.= '<p style="margin-bottom: 10px;"><label class="md-label" style="font-size: 13px;font-weight: 600; margin-right: 20px;">'.$temp['email'].': </label><span style="">'.$temp['phone'].'</span></p>';
								}
			$html .= 		'</div>
						</section>';
			$this->load->library('mailbie');
			$this->mailbie->sent(array(
				'to' => $this->fcSystem['contact_email'],
				'cc' => '',
				'subject' => 'Yêu cầu lấy tài liệu từ hệ thống '.$this->fcSystem['contact_website'],
				'message' => $html,
			));
		}




		echo $html;die();


	}

	public function save_info_contact(){
		if($this->input->post()){
			$data = $this->input->post('data');
			$validate = $this->input->post('validate');


			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');

			if (isset($validate) && is_array($validate) && count($validate)) {
				foreach($validate as $key => $val){
					$this->form_validation->set_rules($val['name'], $val['label'], $val['rule']);
				}
			}
			if($this->form_validation->run($this)){
				$error = '';
				//validate thành công tiến hành lưu thông tin vào db contact
				if (isset($data) && is_array($data) && count($data)) {
					foreach($data as $key => $val){
						$_insert[$val['name']] = $val['value'];
					}
				}
				$_insert['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);

				$insertId = $this->Autoload_Model->_create(array(
					'table' => 'contact',
					'data' => $_insert,
				));

				if($insertId > 0){
					// gửi mail cho người quản trị

					$html = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
								<section class="mail-content" style="border: 1px solid #E5E5E5;">
									<div class="header" style="background: #0077bc; padding: 15px;border-bottom: 1px solid #E5E5E5;">
										<h2><span style="display: block; color: #fff; font-size: 18px;text-transform: uppercase;text-align: center;">Thông tin liên hệ</span></h2>
									</div>
									<div class="content" style="padding: 0 15px;">';
										if (isset($data) && is_array($data) && count($data)) {
											foreach ($data as $key => $val) {
												$html.= '<p style="margin-bottom: 10px;"><label class="md-label" style="font-size: 13px;font-weight: 600; margin-right: 20px;">'.$validate[$key]['label'].': </label><span style="">'.$val['value'].'</span></p>';
											}
										}
					$html .= 		'</div>
								</section>';


					$this->load->library('mailbie');
					$this->mailbie->sent(array(
						'to' => $this->fcSystem['contact_email'],
						'cc' => '',
						'subject' => 'Yêu cầu "'.$_insert['subject'].'" từ hệ thống '.$this->fcSystem['contact_website'],
						'message' => $html,
					));

					echo json_encode(array(
						'error' => $error,
					));die;
				}

				echo json_encode(array(
					'error' => 'Đã có lỗi xảy ra. Xin vui lòng quay lại sau ít phút !',
				));die;

			}else{
				echo json_encode(array(
					'error' => validation_errors(),
				)); die;
			}

		}
	}
	
}