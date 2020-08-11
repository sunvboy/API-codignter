<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('myconstant'));
        $this->load->library('nestedsetbiefrontend', array('table' => 'comment'));
        $this->fc_lang = $this->config->item('fc_lang');

    }

    public function listComment()
    {
        $module = $this->input->post('module');
        $moduleid = $this->input->post('moduleid');
        $page = (int)$this->input->post('page');
        //Tính tổng số bản ghi của trang danh mục
        $config['total_rows'] = $this->Autoload_Model->_get_where(array( //trả lại all số bản ghi
            'select' => 'id',
            'table' => 'comment',
            'where' => array('publish' => 1, 'module' => $module, 'detailid' => $moduleid, 'parentid' => 0),
            'count' => TRUE,
        ));
        $listComment = '';
        if ($config['total_rows'] > 0) {
            $this->load->library('pagination');
            $config['base_url'] = '#" data-page="';
            $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
            $config['first_url'] = $config['base_url'] . $config['suffix'];
            $config['per_page'] = 10;
            $config['cur_page'] = $page;
            $config['page'] = $page;
            $config['uri_segment'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['full_tag_open'] = '<div class="ajax-pagination " style="float: right;border: 0px;margin: 0px;padding: 0px"><ul class=""><li>';
            $config['full_tag_close'] = '</li></ul></div>';
            $config['first_tag_open'] = '';
            $config['first_tag_close'] = '';
            $config['last_tag_open'] = '';
            $config['last_tag_close'] = '';
            $config['cur_tag_open'] = '<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_tag_open'] = '';
            $config['next_tag_close'] = '';
            $config['prev_tag_open'] = '';
            $config['prev_tag_close'] = '';
            $config['num_tag_open'] = '';
            $config['num_tag_close'] = '';
            $this->pagination->initialize($config);
            $data['listPagination'] = $this->pagination->create_links();
            $totalPage = ceil($config['total_rows'] / $config['per_page']);
            //print_r($data['listPagination']);
            $page = ($page <= 0) ? 1 : $page;
            $page = ($page > $totalPage) ? $totalPage : $page;
            $page = $page - 1;
            $data['listComment'] = $this->Autoload_Model->_get_where(array(
                'select' => 'id, fullname, email, phone, module, detailid, parentid, rate, comment, image, created,comment_reply,title',
                'table' => 'comment',
                'where' => array('publish' => 1, 'module' => $module, 'detailid' => $moduleid, 'parentid' => 0),
                'limit' => $config['per_page'],
                'start' => $page * $config['per_page'],
                'order_by' => 'id desc,fullname asc',
            ), TRUE);
            if (isset($data['listComment']) && is_array($data['listComment']) && count($data['listComment'])) {
                foreach ($data['listComment'] as $key => $val) {
                    $data['listComment'][$key]['child'] = $this->Autoload_Model->_get_where(array(
                        'select' => 'id, fullname, comment, image, rate, module, detailid, parentid, created, updated,comment_reply,title',
                        'table' => 'comment',
                        'where' => array(
                            'module' => $module,
                            'detailid' => $moduleid,
                            'publish' => 1,
                            'parentid' => $val['id'],
                        ),
                        'order_by' => 'id desc,fullname asc',
                    ), true);
                }
            }
            if (isset($data['listComment']) && is_array($data['listComment']) && count($data['listComment'])) {
                foreach ($data['listComment'] as $key => $val) {
                    /*
                    $listComment .= '<div class="item" >
										<div class="left">
											<div class="image">
												<img src="' . $val['image'] . '" alt="' . $val['fullname'] . '">
											</div>
											<h3 class="title">' . $val['fullname'] . '</h3>

											<p class="date">' . $val['created'] . '</p>
										</div>
										<div class="right">';

                    $listComment .= '<p class="start"><span class="start">';
                                            for($i=1;$i<=$val['rate'];$i++){
                                                $listComment .= '<i class="fas fa-star"></i>';
                                             }
                                            for($i=1;$i<=(5-$val['rate']);$i++){
                                                $listComment .= '<i class="far fa-star"></i>';
                                            }

                    $listComment .= '</span>';


                    $listComment .= ($val['rate']) ? review_render((int)$val['rate']) : 'Rất tốt';
                    $listComment .= '</p>


                                        <p class="desc">' . (($val['title'] == 'ADMIN') ? $val['comment_reply'] : $val['comment']) . '</p>
										</div>
										<div class="clearfix"></div>';
                    if (isset($val['child']) && is_array($val['child']) && count($val['child'])) {

                        $listComment .= '<ul style="padding: 0px;list-style: none;">';
                        foreach ($val['child'] as $keyC => $valC) {
                            $listComment .= '<li>
										<div class="item" style="border-bottom: 0px;padding: 0px;margin: 0px">

											<div class="right"><div class="title"  style="border-top: 1px dashed #ddd;padding-top: 10px"><span class="btn btn-danger">' . (($valC['title'] == '') ? $valC['fullname'] : ($valC['title'] == 'SHOP') ? $valC['title'].'-'.$valC['fullname'] : 'ADMIN') . '</span> đã trả lời</div><p></p>';
                            $listComment .= '<p class="desc">' . (($valC['title'] == 'ADMIN') ? $valC['comment_reply'] : $valC['comment']) . '</p>
											</div>
											<div class="clearfix"></div>
										</div>
										</li>';
                        }


                        $listComment .= '</ul>';
                    }
                    $listComment .= '</div>';*/
                    $listComment .= '<li class="review">
                    <div class="comment_container">
                        <img class="avatar" src="' . $val['image'] . '" alt="' . $val['title'] . '" >
                        <div class="comment-text">
                            <ul class="star-rating">';

                                for($i=1;$i<=$val['rate'];$i++){
                                                $listComment .= '<li class="fa fa-star"></li>';
                                             }
                                            for($i=1;$i<=(5-$val['rate']);$i++){
                                                $listComment .= '<li class="fa fa-star-o"></li>';
                                            }
                            $listComment .= '</ul>
                            <p class="meta">
                                <strong class="eview__author">' . $val['fullname'] . ' </strong><span class="review__dash">–</span>
                                <time class="woocommerce-review__published-date" datetime="2018-11-01T04:58:58+00:00">' . $val['created'] . '</time>
                            </p>
                            <div class="description">
                                <p>' . $val['comment'] . '</p>
                            </div>
                        </div>
                    </div>
                </li>';




                }
            }
        }
        echo json_encode(array(
            'listComment' => $listComment,
            'paginationList' => isset($data['listPagination']) ? $data['listPagination'] : '',
        ));
        die;
    }
    public function listCommentUser()
    {
        $module = $this->input->post('module');
        $moduleid = $this->input->post('moduleid');
        $page = (int)$this->input->post('page');
        //Tính tổng số bản ghi của trang danh mục
        $config['total_rows'] = $this->Autoload_Model->_get_where(array( //trả lại all số bản ghi
            'select' => 'id',
            'table' => 'comment',
            'where' => array('publish' => 1, 'module' => $module, 'detailid' => $moduleid, 'parentid' => 0),
            'count' => TRUE,
        ));
        $listComment = '';
        if ($config['total_rows'] > 0) {
            $this->load->library('pagination');
            $config['base_url'] = '#" data-page="';
            $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
            $config['first_url'] = $config['base_url'] . $config['suffix'];
            $config['per_page'] = 10;
            $config['cur_page'] = $page;
            $config['page'] = $page;
            $config['uri_segment'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['full_tag_open'] = '<div class="ajax-pagination pagenavi" style="float: right;border: 0px;margin: 0px;padding: 0px"><ul class=""><li>';
            $config['full_tag_close'] = '</li></ul></div>';
            $config['first_tag_open'] = '';
            $config['first_tag_close'] = '';
            $config['last_tag_open'] = '';
            $config['last_tag_close'] = '';
            $config['cur_tag_open'] = '<a class="active ">';
            $config['cur_tag_close'] = '</a>';
            $config['next_tag_open'] = '';
            $config['next_tag_close'] = '';
            $config['prev_tag_open'] = '';
            $config['prev_tag_close'] = '';
            $config['num_tag_open'] = '';
            $config['num_tag_close'] = '';
            $this->pagination->initialize($config);
            $data['listPagination'] = $this->pagination->create_links();
            $totalPage = ceil($config['total_rows'] / $config['per_page']);
            //print_r($data['listPagination']);
            $page = ($page <= 0) ? 1 : $page;
            $page = ($page > $totalPage) ? $totalPage : $page;
            $page = $page - 1;
            $data['listComment'] = $this->Autoload_Model->_get_where(array(
                'select' => 'id, fullname, email, phone, module, detailid, parentid, rate, comment, image, created,comment_reply,title',
                'table' => 'comment',
                'where' => array('publish' => 1, 'module' => $module, 'detailid' => $moduleid, 'parentid' => 0),
                'limit' => $config['per_page'],
                'start' => $page * $config['per_page'],
                'order_by' => 'id desc,fullname asc',
            ), TRUE);
            if (isset($data['listComment']) && is_array($data['listComment']) && count($data['listComment'])) {
                foreach ($data['listComment'] as $key => $val) {
                    $data['listComment'][$key]['child'] = $this->Autoload_Model->_get_where(array(
                        'select' => 'id, fullname, comment, image, rate, module, detailid, parentid, created, updated,comment_reply,title',
                        'table' => 'comment',
                        'where' => array(
                            'module' => $module,
                            'detailid' => $moduleid,
                            'publish' => 1,
                            'parentid' => $val['id'],
                        ),
                        'order_by' => 'id desc,fullname asc',
                    ), true);
                }
            }
            if (isset($data['listComment']) && is_array($data['listComment']) && count($data['listComment'])) {
                foreach ($data['listComment'] as $key => $val) {
                    $listComment .= '<div class="item" >
										<div class="left">
											<div class="image">
												<img src="' . $val['image'] . '" alt="' . $val['fullname'] . '">
											</div>
											<h3 class="title">' . $val['fullname'] . '</h3>

											<p class="date">' . $val['created'] . '</p>
										</div>
										<div class="right">';

                    $listComment .= '<p class="start"><span class="start">';
                    for($i=1;$i<=$val['rate'];$i++){
                        $listComment .= '<i class="fas fa-star"></i>';
                    }
                    for($i=1;$i<=(5-$val['rate']);$i++){
                        $listComment .= '<i class="far fa-star"></i>';
                    }

                    $listComment .= '</span>';


                    $listComment .= ($val['rate']) ? review_render((int)$val['rate']) : 'Rất tốt';
                    $listComment .= '</p>


                                        <p class="desc">' . (($val['title'] == 'ADMIN') ? $val['comment_reply'] : $val['comment']) . '</p><p><a href="javascript:void(0)" class="js_btn_reply" data-id="' . $val['id'] . '" data-title="' . $val['fullname'] . '" data-comment="1">Trả lời</a></p>
                                        <div class="show-reply" ></div>
										</div>
										<div class="clearfix"></div>';
                    if (isset($val['child']) && is_array($val['child']) && count($val['child'])) {

                        $listComment .= '<ul style="padding: 0px;list-style: none;">';
                        foreach ($val['child'] as $keyC => $valC) {
                            $listComment .= '<li>
										<div class="item" style="border-bottom: 0px;padding: 0px;margin: 0px">

											<div class="right"><div class="title"  style="border-top: 1px dashed #ddd;padding-top: 10px"><span class="btn btn-danger">' . (($valC['title'] == '') ? $valC['fullname'] : ($valC['title'] == 'SHOP') ? $valC['title'].'-'.$valC['fullname'] : 'ADMIN') . '</span> đã trả lời</div><p></p>';
                            $listComment .= '<p class="desc">' . (($valC['title'] == 'ADMIN') ? $valC['comment_reply'] : $valC['comment']) . '</p>
											</div>
											<div class="clearfix"></div>
										</div>
										</li>';
                        }


                        $listComment .= '</ul>';
                    }
                    $listComment .= '</div>';


                }
            }
        }
        echo json_encode(array(
            'listComment' => $listComment,
            'paginationList' => isset($data['listPagination']) ? $data['listPagination'] : '',
        ));
        die;
    }
    public function sent_comment()
    {
        if ($this->input->post()) {
            $param = $this->input->post('param');
            $cmtName = $this->input->post('cmtName');

            //validation form
            $this->load->library('form_validation');
            $this->form_validation->CI =& $this;
            $this->form_validation->set_error_delimiters(' ', ' /');
            $this->form_validation->set_rules('cmtName', 'Họ tên', 'trim|required');
            $this->form_validation->set_rules('cmtPhone', 'Số điện thoại', 'trim|required|max_length[10]|min_length[10]');
            $this->form_validation->set_rules('cmtContent', 'Nội dung bình luận', 'trim|required');

            if ($this->form_validation->run($this)) {
                // lưu db thông tin người reply
                $_insert = array(
                    'title' => '',
                    'fullname' => $cmtName,
                    'comment' => $param['comment'],
                    'phone' => $param['phone'],
                    'email' => $param['email'],
                    'rate' => $param['rate'],
                    'module' => $param['module'],
                    'detailid' => $param['detailid'],
                    'customerid' => isset($this->FT_auth['id']) ? $this->FT_auth['id'] : '',
                    'parentid' => isset($param['parentid']) ? $param['parentid'] : '',
                    'publish' => 0,
                    'created' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
                    'alanguage' => $this->fc_lang,
                    'image' => isset($this->FT_auth['images']) ? $this->FT_auth['images'] : 'template/not-found.png'
                );

                // pre($_insert);die;
                $insertId = $this->Autoload_Model->_create(array(
                    'table' => 'comment',
                    'data' => $_insert,
                ));
                if ($insertId > 0) {

                    $this->nestedsetbiefrontend->Get('level ASC, order ASC');
                    $this->nestedsetbiefrontend->Recursive(0, $this->nestedsetbiefrontend->Set());
                    $this->nestedsetbiefrontend->Action();
                    echo json_encode(array(
                        'error' => 0,
                        'message' => 'Cám ơn bạn đã đánh giá. Vui lòng chờ chúng tôi kiểm duyệt !',
                    ));
                    die;
                }
            }
            echo json_encode(array(
                'error' => 1,
                'message' => validation_errors(),
            ));
            die;
        }

    }
    public function sent_commentuser()
    {
        $id = $this->FT_auth['id'];
        $detailCustomer = $this->Autoload_Model->_get_where(array(
            'select' => 'id,email,fullname,phone,address,birthday,zalo,gender,account',
            'table' => 'customer',
            'where' => array('id' => $id),
        ));

        if ($this->input->post()) {
            $param = $this->input->post('param');
            $cmtName = $this->input->post('cmtName');

            //validation form
            $this->load->library('form_validation');
            $this->form_validation->CI =& $this;
            $this->form_validation->set_error_delimiters(' ', ' /');
            $this->form_validation->set_rules('cmtContent', 'Nội dung bình luận', 'trim|required');

            if ($this->form_validation->run($this)) {
                // lưu db thông tin người reply
                $_insert = array(
                    'title' => 'SHOP',
                    'fullname' => $detailCustomer['account'],
                    'comment' => $param['comment'],
                    'phone' => $detailCustomer['phone'],
                    'email' => $detailCustomer['email'],
                    'rate' => $param['rate'],
                    'module' => $param['module'],
                    'detailid' => $param['detailid'],
                    'customerid' => isset($this->FT_auth['id']) ? $this->FT_auth['id'] : '',
                    'parentid' => isset($param['parentid']) ? $param['parentid'] : '',
                    'publish' => 1,
                    'created' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
                    'alanguage' => $this->fc_lang,
                    'image' => isset($detailCustomer['images']) ? $detailCustomer['images'] : 'template/not-found.png'
                );
                // pre($_insert);die;
                $insertId = $this->Autoload_Model->_create(array(
                    'table' => 'comment',
                    'data' => $_insert,
                ));
                if ($insertId > 0) {
                    $this->nestedsetbiefrontend->Get('level ASC, order ASC');
                    $this->nestedsetbiefrontend->Recursive(0, $this->nestedsetbiefrontend->Set());
                    $this->nestedsetbiefrontend->Action();
                    echo json_encode(array(
                        'error' => 0,
                        'message' => 'Đã trả lời bình luận thành công',
                    ));
                    die;
                }
            }
            echo json_encode(array(
                'error' => 1,
                'message' => validation_errors(),
            ));
            die;
        }

    }

    public function get_title_rate()
    {
        $numStar = (int)$this->input->post('numStar');

        $htmlReview = review_render($numStar);

        echo json_encode(array(
            'htmlReview' => $htmlReview,
        ));
        die;
    }


    public function loadmore_comment()
    {
        $param = $this->input->post('param');

        $listComment = comment_render($param);
        $html = $this->get_html_loadmore_comment($listComment);
        echo json_encode(array(
            'html' => $html,
        ));
        die;
    }

    public function get_html_loadmore_comment($data = '')
    {
        $html = '';
        if (isset($data) && is_array($data) && count($data)) {
            foreach ($data as $key => $val) {
                $html .= '<li>';
                $html .= '<div class="comment">';
                $html .= '<div class="uk-flex uk-flex-middle uk-flex-space-between">';
                $html .= '<div class="cmt-profile">';
                $html .= '<div class="uk-flex uk-flex-middle">';
                $html .= '<div class="_cmt-avatar"><img src="template/avatar.png" alt="" class="img-sm"></div>';
                $html .= '<div class="_cmt-name">' . $val['fullname'] . '</div>';
                $html .= '<div class="label label-primary _cmt-tag">Khách hàng</div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '<div class="cmt-time">';
                $html .= '<i class="fa fa-clock-o"></i> ';
                $html .= '<time class="timeago meta" datetime="' . (($val['updated'] > $val['created']) ? $val['updated'] : $val['created']) . '"></time>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '<div class="cmt-content">';
                $html .= '<p>' . $val['comment'] . '</p>';

                $album = json_decode($val['image']);

                if (isset($album) && is_array($album) && count($album)) {
                    $html .= '<div class="gallery-block mb10">';
                    $html .= '<ul class="uk-list uk-flex uk-flex-middle clearfix lightBoxGallery">';
                    foreach ($album as $k => $v) {
                        $html .= '<li>';
                        $html .= '<div class="thumb">';
                        $html .= '<a href="<?php echo $v;?>" title="" data-gallery="#blueimp-gallery-' . $val['id'] . '"><img src="' . $v . '" class="img-md"></a>';
                        $html .= '</div>';
                        $html .= '</li>';
                    }
                    $html .= '</ul>';
                    $html .= '</div>';
                }
                $html .= '<div class="_cmt-reply">';
                $html .= '<a href="" title="" class="btn-reply" data-comment="1" data-id="' . $val['id'] . '" data-module ="' . $val['module'] . '" data-detailid = "' . $val['detailid'] . '">Trả lời</a> ';
                $html .= '<span class="mr5 num-reply" data-num="' . (isset($val['child']) ? count($val['child']) : 0) . '">(' . (isset($val['child']) ? count($val['child']) : 0) . ')</span> ';
                $html .= '<span class="rating order-1 rt-cmt" data-stars="5" data-default-rating="' . $val['rate'] . '" disabled ></span>';
                $html .= '</div>';
                $html .= '<div class="show-reply"></div>';
                $html .= '<div class="wrap-list-reply">';
                $html .= '<ul class="list-reply uk-list uk-clearfix" id="reply-to-' . $val['id'] . '">';
                if (isset($val['child']) && is_array($val['child']) && count($val['child'])) {
                    foreach ($val['child'] as $keyChild => $valChild) {
                        $html .= '<li>';
                        $html .= '<div class="comment">';
                        $html .= '<div class="uk-flex uk-flex-middle uk-flex-space-between">';
                        $html .= '<div class="cmt-profile">';
                        $html .= '<div class="uk-flex uk-flex-middle">';
                        $html .= '<div class="_cmt-avatar"><img src="template/avatar.png" alt="" class="img-sm"></div>';
                        $html .= '<div class="_cmt-name">' . $valChild['fullname'] . '</div>';
                        $html .= '<i>QTV</i>';
                        $html .= '</div>';
                        $html .= '</div>';
                        $html .= '</div>';
                        $html .= '<div class="cmt-content">';
                        $html .= '<p>' . $valChild['comment'] . '</p>';
                        $albumReply = json_decode($valChild['image']);
                        if (isset($albumReply) && is_array($albumReply) && count($albumReply)) {
                            $html .= '<div class="gallery-block mb10">';
                            $html .= '<ul class="uk-list uk-flex uk-flex-middle clearfix lightBoxGallery">';
                            foreach ($albumReply as $kR => $vR) {
                                $html .= '<li>';
                                $html .= '<div class="thumb">';
                                $html .= '<a href="' . $vR . '" title="" data-gallery="#blueimp-gallery-' . $val['id'] . '-' . $valChild['id'] . '"><img src="' . $vR . '" class="img-md"></a>';
                                $html .= '</div>';
                                $html .= '</li>';
                            }
                            $html .= '</ul>';
                            $html .= '</div>';
                        }
                        $html .= '<i class="fa fa-clock-o"></i> ';
                        $html .= '<time class="timeago meta" datetime="' . (($valChild['updated'] > $valChild['created']) ? $valChild['updated'] : $valChild['created']) . '"></time>';
                        $html .= '</div>';
                        $html .= '</div>';
                        $html .= '</li>';
                    }
                }
                $html .= '</ul>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</li>';
            }
        }

        return $html;
    }

}
