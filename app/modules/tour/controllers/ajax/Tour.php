<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour extends MY_Controller {

	public function __construct(){
		parent::__construct();
		if(!isset($this->auth) || is_array($this->auth) == FALSE || count($this->auth) == 0 ) redirect(BACKEND_DIRECTORY);
	}
	
	// xóa SP
	public function ajax_delete_tour(){
		$param['id'] = (int)$this->input->post('id');
		$param['router'] = $this->input->post('router');
			
		if($param['router'] != '' && !empty($param['router'])){
			$router = $this->Autoload_Model->_delete(array(
				'where' => array('canonical' => $param['router']),
				'table' => 'router',
			));
		}
		//xóa phiên bản
		$this->Autoload_Model->_delete(array(
			'where' => array('tourid' => $param['id']),
			'table' => 'tour_version'
		));
		// xóa bán buôn bán lẻ
		$this->Autoload_Model->_delete(array(
			'where' => array('tourid' => $param['id']),
			'table' => 'tour_wholesale'
		));
		// xóa thuộc tính
		$this->Autoload_Model->_delete(array(
			'where' => array('moduleid' => $param['id'], 'module' => 'tour'),
			'table' => 'attribute_relationship'
		));
		
		// xóa tour
		$flag = $this->Autoload_Model->_delete(array(
			'where' => array('id' => $param['id']),
			'table' => 'tour'
		));
		echo $flag;die();
	}
	public function ajax_delete_tour_all(){
		$param = $this->input->post('post');
		$id  = $param['id_checked'];
		$router  = $param['router'];
			
		$router = $this->Autoload_Model->_delete(array(
			'table' => 'router',
			'where_in' => $router,
			'where_in_field' => 'canonical',
		));
		//xóa phiên bản
		$this->Autoload_Model->_delete(array(
			'table' => 'tour_version',
			'where_in' => $id,
			'where_in_field' => 'tourid',
		));
		// xóa bán buôn bán lẻ
		$this->Autoload_Model->_delete(array(
			'table' => 'tour_wholesale',
			'where_in' => $id,
			'where_in_field' => 'tourid',
		));
		// xóa thuộc tính
		$this->Autoload_Model->_delete(array(
			'table' => 'attribute_relationship',
			'where_in' => $id,
			'where_in_field' => 'moduleid',
			'where' => array('module' => 'tour'),
		));
		//
		$flag = $this->Autoload_Model->_delete(array(
			'table' => 'tour',
			'where_in' => $id,
			'where_in_field' => 'id',
		));
		echo $flag;die();
	}
	
	
	public function status(){
		$id = $this->input->post('objectid');
		$object = $this->Autoload_Model->_get_where(array(
			'select' => 'id, publish',
			'table' => 'tour',
			'where' => array('id' => $id),
		));
		
		$_update['publish'] = (($object['publish'] == 1)?0:1);
		$this->Autoload_Model->_update(array(
			'where' => array('id' => $id),
			'table' => 'tour',
			'data' => $_update,
		));
	}
	
	public function listtour(){
		$page = (int)$this->input->get('page');
		$json = [];
		$data['from'] = 0;
		$data['to'] = 0;
		$perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
		$keyword = $this->db->escape_like_str($this->input->get('keyword'));
		$param['catalogueid'] = $this->input->get('catalogueid');
		$query = '';


		if(!empty($param['catalogueid'])){
			$query = $query.' AND tb3.catalogueid IN'.' ('.$param['catalogueid'].') AND `tb1`.`alanguage` = \''.$this->fclang.'\'';
		}
		if(!empty($param['publish']) && $param['publish'] !=-1){
			$query = $query.' AND tb1.publish =  '.$param['publish'];
		}

		$json[] = array('catalogue_relationship as tb3', 'tb1.id = tb3.moduleid AND tb3.module = "tour"', 'full');
		$query = substr( $query,  4, strlen($query));
		$config['total_rows'] = $this->Autoload_Model->_get_where(array(
			'select' => 'tb1.id',
			'table' => 'tour as tb1',
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
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$data['from'] = ($page * $config['per_page']) + 1;
			$data['to'] = ($config['per_page']*($page+1) > $config['total_rows']) ? $config['total_rows']  : $config['per_page']*($page+1);
			$listtour = $this->Autoload_Model->_get_where(array(
				'distinct' => 'true',
				'select' =>'tb1.image, tb1.ishome,tb1.highlight, tb1.version, tb1.title, tb1.price, tb1.price_sale, tb1.price_contact, tb1.id, tb1.canonical, tb1.viewed, tb1.order, (SELECT account FROM user WHERE tb1.userid_created = user.id) as user_created, tb1.created, tb1.publish, tb1.catalogueid, tb1.quantity_dau_ki, tb1.quantity_cuoi_ki, (SELECT title FROM tour_catalogue WHERE tour_catalogue.id = tb1.catalogueid) as catalogue_title,tb1.catalogue, (SELECT fullname FROM customer WHERE customer.id = tb1.customerid) as customer_fullname, (SELECT account FROM customer WHERE customer.id = tb1.customerid) as customer_account',
				'table' => 'tour as tb1',
				'limit' => $config['per_page'],
				'start' => $page * $config['per_page'],
				'keyword' => (!empty($keyword))? '(tb1.title LIKE \'%'.$keyword.'%\')' : '',
				'join' => $json,
				'query' => $query,
				'order_by' => 'tb1.id desc',
			),true);
		}
		
		$html = '';
		 if(isset($listtour) && is_array($listtour) && count($listtour)){ 
			foreach($listtour as $key => $val){
                $href = $val['canonical'];

				$image = $val['image'];
				$_catalogue_list = '';
				$catalogue = json_decode($val['catalogue'], TRUE);
				if(isset($catalogue) && is_array($catalogue) && count($catalogue)){
					$_catalogue_list = $this->Autoload_Model->_get_where(array(
						'select' => 'id, title, slug, canonical',
						'table' => 'article_catalogue',
						'where_in' => json_decode($val['catalogue'], TRUE),
						'where_in_field' => 'id',
					), TRUE);
				}
				$html = $html.'<tr class="gradeX" id="post-'.$val['id'].'">';
					$html = $html.'<td>';
						$html = $html.'<input type="checkbox" name="checkbox[]" value="'.$val['id'].'" data-router="'.$val['canonical'].'" class="checkbox-item">';
						$html = $html.'<label for="" class="label-checkboxitem"></label>';
					$html = $html.'</td>';
					$html = $html.'<td>';
						$html = $html.'<div class="uk-flex uk-flex-middle uk-flex-space-between">';
							$html = $html.'<div class="uk-flex uk-flex-middle ">';
								$html = $html.'<div class="image mr5">';
									$html = $html.'<span class="image-post img-cover"><img src="'.$image.'" alt="'.$val['title'].'" /></span>';
								$html = $html.'</div>';
								$html = $html.'<div class="main-info">';
									$html = $html.'<div class="title"><a class="maintitle" href="'.site_url('tour/backend/tour/update/'.$val['id']).'" title="">'.$val['title'].' ('.$val['viewed'].' lượt xem ) '.(($val['version']>0)?"(có ".$val['version']." phiên bản)":'').'</a>
<a href="'.$href.'" onclick="prompt(\'Lấy địa chỉ liên kết\',\''.$val['canonical'].'.html\'); return false;"><img src="template/backend/img/link.png"></a></div>';
									$html = $html.'<div class="catalogue" style="font-size:10px">';
										$html = $html.'<span style="color:#f00000;">Nhóm hiển thị: </span>';
										$html = $html.'<a class="" style="color:#333;" href="'.site_url('tour/backend/tour/view?catalogueid='.$val['catalogueid']).'" title="">'.$val['catalogue_title'].'</a>'.((check_array($_catalogue_list)) ? ' ,' :'');
										if(check_array($_catalogue_list)){ 
											foreach($_catalogue_list as $keyCat => $valCat){
											$html = $html.'<a style="color:#333;" class="" href="'.site_url('tour/backend/tour/view?catalogueid='.$valCat['id']).'" title="">'.$valCat['title'].'</a> '.($keyCat + 1 < count($_catalogue_list)) ? ', ' : '';
											}
										}
									$html = $html.'</div>';
								$html = $html.'</div>';
							$html = $html.'</div>';
							$html = $html.'<div>';
								$html = $html.'<a target=_blank href="'.site_url($val['canonical']).'" ><i class="fa fa-link" aria-hidden="true"></i></a>';
							$html = $html.'</div>';
						$html = $html.'</div>';
					$html = $html.'</td>';
					$html = $html.'<td class="text-right hidden">'.$val['quantity_dau_ki'].'</td>';
					$html = $html.'<td class="text-right hidden">'.$val['quantity_cuoi_ki'].'</td>';
					$html = $html.'<td class="text-right price">';
						if($val['price_contact'] == 1 ){
							$html = $html.'<span>Giá liên hệ</span>';
						}else{
							$price = (!empty($val['price_sale']))? $val['price_sale'] : $val['price'];
							$field =  (!empty($val['price_sale']))? 'price_sale' : 'price';
							if(!empty($val['price_sale'])){
								$html = $html.'<i class="fa fa-tag m-r-xs" aria-hidden="true"></i>';
							}
							$html = $html.'<span>'.addCommas($price).'</span>';
						    $html = $html.form_input('price',addCommas($price) , 'data-id="'.$val['id'].'" data-field="'.$field.'"  class="int form-control" style="text-align:right; padding:6px 3px; display:none"');
						}
					$html = $html.'</td>';
					
					$html = $html.'<td>';
						$html = $html.form_input('order['.$val['id'].']', $val['order'], 'data-module="tour" data-id="'.$val['id'].'"  class="form-control sort-order" placeholder="Vị trí" style="width:50px;text-align:right;"');
					$html = $html.'</td>';
					$html = $html.'<td class="text-center">';
					 if(!empty($val['user_created'])){
                         $html = $html.$val['user_created'];
												}else{


                         $html = $html.$val['customer_fullname'] ; $html = $html.'-';  $html = $html.$val['customer_account'];
												 }

					$html = $html.'</td>';


                $html = $html.'<td class="">
													<div class="switch">
														<div class="onoffswitch">
															<input type="checkbox" '.(($val['ishome'] == 1) ? 'checked=""' : '').' class="onoffswitch-checkbox publish_frontend" data-module="tour" data-title="ishome" data-id="'.$val['id'].'" id="publish_frontend-'.$val['id'].'">
															<label class="onoffswitch-label" for="publish_frontend-'.$val['id'].'">
																<span class="onoffswitch-inner"></span>
																<span class="onoffswitch-switch"></span>
															</label>
														</div>
													</div>
												</td>';
												$html = $html.'<td class="hidden">
													<div class="switch">
														<div class="onoffswitch">
															<input type="checkbox" '.(($val['highlight'] == 1) ? 'checked=""' : '').' class="onoffswitch-checkbox publish_frontend" data-module="tour" data-title="highlight" data-id="'.$val['id'].'" id="publish_highlight'.$val['id'].'">
															<label class="onoffswitch-label" for="publish_highlight'.$val['id'].'">
																<span class="onoffswitch-inner"></span>
																<span class="onoffswitch-switch"></span>
															</label>
														</div>
													</div>
												</td>';

					$html = $html.'<td>';
						$html = $html.'<div class="switch">';
							$html = $html.'<div class="onoffswitch">';
								$html = $html.'<input type="checkbox" '.(($val['publish'] == 0) ? 'checked=""' : '').' class="onoffswitch-checkbox publish" data-id="'.$val['id'].'" id="publish-'.$val['id'].'">';
								$html = $html.'<label class="onoffswitch-label" for="publish-'.$val['id'].'">';
									$html = $html.'<span class="onoffswitch-inner"></span>';
									$html = $html.'<span class="onoffswitch-switch"></span>';
								$html = $html.'</label>';
							$html = $html.'</div>';
						$html = $html.'</div>';
					$html = $html.'</td>';


					$html = $html.'<td class="text-center">';
						$html = $html.'<a type="button" href="'.(site_url('tour/backend/tour/update/'.$val['id'].'?page='.($page+1))).'" class="btn btn-primary m-r-xs"><i class="fa fa-edit"></i></a>';
						$html = $html.'<a type="button" class="btn btn-danger ajax_delete_tour" data-title="Lưu ý: Dữ liệu sẽ không thể khôi phục. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!" data-router="'.$val['canonical'].'" data-id="'.$val['id'].'" data-catalogueid="'.$val['catalogueid'].'" data-module="tour"><i class="fa fa-trash"></i></a>';
					$html = $html.'</td>';
				$html = $html.'</tr>';


			}
		}else{ 
			$html = $html.'<tr>
				<td colspan="10"><small class="text-danger">Không có dữ liệu phù hợp</small></td>
			</tr>';
		}
		echo json_encode(array(
			'pagination' => (isset($listPagination)) ? $listPagination : '',
			'html' => (isset($html)) ? $html : '',
			'total' => $config['total_rows'],
		));die();		
	}

    public function listorderTour(){
        $page = (int)$this->input->get('page');

        $perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 20;
        $keyword = $this->db->escape_like_str($this->input->get('keyword'));

        $config['total_rows'] = $this->Autoload_Model->_get_where(array(
            'select' => 'tb1.id',
            'table' => 'tour_book as tb1',
            'keyword' => (!empty($keyword))? '(tb1.fullname LIKE \'%'.$keyword.'%\' OR tb1.phone LIKE \'%'.$keyword.'%\' OR tb1.email LIKE \'%'.$keyword.'%\')' : '',
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
            $totalPage = ceil($config['total_rows']/$config['per_page']);
            $page = ($page <= 0)?1:$page;
            $page = ($page > $totalPage)?$totalPage:$page;
            $page = $page - 1;
            $data['from'] = ($page * $config['per_page']) + 1;
            $data['to'] = ($config['per_page']*($page+1) > $config['total_rows']) ? $config['total_rows']  : $config['per_page']*($page+1);
            $listtour = $this->Autoload_Model->_get_where(array(
                'distinct' => 'true',
                'select' =>'*',
                'table' => 'tour_book as tb1',
                'limit' => $config['per_page'],
                'start' => $page * $config['per_page'],
                'keyword' => (!empty($keyword))? '(tb1.fullname LIKE \'%'.$keyword.'%\' OR tb1.phone LIKE \'%'.$keyword.'%\' OR tb1.email LIKE \'%'.$keyword.'%\')' : '',
                'order_by' => 'tb1.id desc',
            ),true);
        }

        $html = '';
        if(isset($listtour) && is_array($listtour) && count($listtour)){
            foreach($listtour as $key => $val){
                $detailTour = $this->Autoload_Model->_get_where(array(
                    'select' => 'canonical,title',
                    'table' => 'tour',
                    'where' => array('id'=>$val['tourID']),
                ));
                $html = $html.' <tr class="gradeX" id="post-'.$val['id'].'">
                                            <td>
                                                <input type="checkbox" name="checkbox[]" value="'.$val['id'].'" data-router=""  class="checkbox-item">
                                                <label for="" class="label-checkboxitem"></label>
                                            </td>
                                            <td>
                                                <b>Họ và tên:</b> '.$val['fullname'].'<br>
                                                <b>Số điện thoại:</b> '.$val['phone'].'<br>
                                                <b>Email:</b> '.$val['email'].'<br>
                                                <b>Địa chỉ:</b> '.$val['address'].'<br>

                                            </td>
                                            <td>
                                                '.$val['message'].'
                                            </td>

                                            <td class="text-center">
                                                <a href="'.$detailTour['canonical'].'" target="_blank">'.$detailTour['title'].'</a>
                                            </td>
                                            <td class="text-center">
                                                '.$val['created'].'
                                            </td>

                                            <td class="text-center">

                                                <a type="button" class="btn btn-danger ajax_delete_tour"
                                                   data-title="Lưu ý: Dữ liệu sẽ không thể khôi phục. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!"
                                                   data-router=""
                                                   data-id="'.$val['id'].'"
                                                   data-catalogueid=""
                                                   data-module="tour_book"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>';


            }
        }else{
            $html = $html.'<tr>
				<td colspan="10"><small class="text-danger">Không có dữ liệu phù hợp</small></td>
			</tr>';
        }
        echo json_encode(array(
            'pagination' => (isset($listPagination)) ? $listPagination : '',
            'html' => (isset($html)) ? $html : '',
            'total' => $config['total_rows'],
        ));die();
    }



}
