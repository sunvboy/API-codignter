<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->auth) || is_array($this->auth) == FALSE || count($this->auth) == 0) redirect(BACKEND_DIRECTORY);
    }

    public function status()
    {
        $id = $this->input->post('objectid');
        $object = $this->Autoload_Model->_get_where(array(
            'select' => 'id, publish',
            'table' => 'customer',
            'where' => array('id' => $id),
        ));

        $_update['publish'] = (($object['publish'] == 1) ? 0 : 1);
        $this->Autoload_Model->_update(array(
            'where' => array('id' => $id),
            'table' => 'customer',
            'data' => $_update,
        ));
        $this->Autoload_Model->_update(array(
            'where' => array('customerid' => $id),
            'table' => 'product',
            'data' => $_update,
        ));
    }

    public function listpage()
    {
        $page = (int)$this->input->get('page');
        $data['from'] = 0;
        $data['to'] = 0;
        $perpage = ($this->input->get('perpage')) ? $this->input->get('perpage') : 10;
        $param['keyword'] = $this->db->escape_like_str($this->input->get('keyword'));
        $catalogueid = $this->input->get('catalogueid');


        $config['total_rows'] = $this->Autoload_Model->_get_where(array( //trả lại all số bản ghi
            'select' => 'id',
            'where' => (!empty($catalogueid)) ? array('catalogueid' => $catalogueid) : '',
            'table' => 'customer',
            'keyword' => '(fullname LIKE \'%' . $param['keyword'] . '%\' OR email LIKE \'%' . $param['keyword'] . '%\' OR catalogue_title LIKE \'%' . $param['keyword'] . '%\')',
            'count' => TRUE,
        ));


        if ($config['total_rows'] > 0) {
            $this->load->library('pagination');
            $config['base_url'] = '#" data-page="';
            $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
            $config['first_url'] = $config['base_url'] . $config['suffix'];
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
            $totalPage = ceil($config['total_rows'] / $config['per_page']);
            $page = ($page <= 0) ? 1 : $page;
            $page = ($page > $totalPage) ? $totalPage : $page;
            $page = $page - 1;
            $data['from'] = ($page * $config['per_page']) + 1;
            $data['to'] = ($config['per_page'] * ($page + 1) > $config['total_rows']) ? $config['total_rows'] : $config['per_page'] * ($page + 1);


            $listCatalogue = $this->Autoload_Model->_get_where(array(
                'select' => 'id, fullname, email, phone, address, gender, updated, catalogue_title,publish,ishome',
                'table' => 'customer',
                'keyword' => '(fullname LIKE \'%' . $param['keyword'] . '%\' OR email LIKE \'%' . $param['keyword'] . '%\' OR catalogue_title LIKE \'%' . $param['keyword'] . '%\')',
                'where' => (!empty($catalogueid)) ? array('catalogueid' => $catalogueid) : '',
                'limit' => $config['per_page'],
                'start' => $page * $config['per_page'],
                'order_by' => 'publish desc, ishome desc, fullname asc, created desc',
            ), TRUE);


        }

        $html = '';
        if (isset($listCatalogue) && is_array($listCatalogue) && count($listCatalogue)) {
            foreach ($listCatalogue as $key => $val) {

                $html .= '<tr style="cursor:pointer;" class="choose" data-info="' . (base64_encode(json_encode($val))) . '" >';
                $html .= '<td style="width: 40px;"><input type="checkbox" name="checkbox[]" value="' . $val['id'] . '" class="checkbox-item"><div for="" class="label-checkboxitem"></div></td>';
                $html .= '<td><a data-toggle="tab" href="#contact-1" class="client-link">' . $val['fullname'] . '</a></td>';
                $html .= '<td class="client-email"> <i class="fa fa-envelope" style="margin-right:5px;"></i>' . ((!empty($val['email'])) ? $val['email'] : '-') . '</td>';
                $html .= '<td class="client-group">' . $val['catalogue_title'] . '</td>';

                $html = $html . '<td>';
                $html = $html . '<div class="switch">';
                $html = $html . '<div class="onoffswitch">';
                $html = $html . '<input type="checkbox" ' . (($val['publish'] == 0) ? 'checked=""' : '') . ' class="onoffswitch-checkbox publish" data-id="' . $val['id'] . '" id="publish-' . $val['id'] . '">';
                $html = $html . '<label class="onoffswitch-label" for="publish-' . $val['id'] . '">';
                $html = $html . '<span class="onoffswitch-inner"></span>';
                $html = $html . '<span class="onoffswitch-switch"></span>';
                $html = $html . '</label>';
                $html = $html . '</div>';
                $html = $html . '</div>';
                $html = $html . '</td>';


                $html = $html . '<td>';
                $html = $html . '<div class="switch">';
                $html = $html . '<div class="onoffswitch">';
                $html = $html . '<input type="checkbox" ' . (($val['ishome'] == 1) ? 'checked=""' : '') . ' class="onoffswitch-checkbox publish_frontend" data-module="customer" data-title="ishome" data-id="' . $val['id'] . '" id="publish_frontend' . $val['id'] . '">';
                $html = $html . '<label class="onoffswitch-label" for="publish_frontend' . $val['id'] . '">';
                $html = $html . '<span class="onoffswitch-inner"></span>';
                $html = $html . '<span class="onoffswitch-switch"></span>';
                $html = $html . '</label>';
                $html = $html . '</div>';
                $html = $html . '</div>';
                $html = $html . '</td>';

                $html .= '<td class="client-status" style="text-align:center;">
							<a type="button" href="' . site_url('customer/backend/customer/update/' . $val['id']) . '"   class="btn btn-sm btn-primary btn-update"><i class="fa fa-edit"></i></a>
							<a type="button" class="btn btn-sm btn-danger ajax-delete" data-title="Lưu ý: Khi bạn xóa thành viên, người này sẽ không thể truy cập vào hệ thống quản trị được nữa." data-id="' . $val['id'] . '" data-module="customer"><i class="fa fa-trash"></i></a>
						</td>';
                $html .= '</tr>';
            }
        } else {
            $html = $html . '<tr>
				<td colspan="9"><small class="text-danger">Không có dữ liệu phù hợp</small></td>
			</tr>';
        }
        echo json_encode(array(
            'pagination' => (isset($listPagination)) ? $listPagination : '',
            'html' => (isset($html)) ? $html : '',
            'total' => $config['total_rows'],
        ));
        die();
    }


    public function ajax_delete()
    {
        $id = (int)$this->input->post('id');
        $module = $this->input->post('module');

        //tiến hành xóa dữ liệu với id vừa lấy được
        $result = $this->Autoload_Model->_delete(array(
            'where' => array('id' => $id),
            'table' => $module,
        ));
        $_update['publish'] = 1;
        $this->Autoload_Model->_update(array(
            'where' => array('customerid' => $id),
            'table' => 'product',
            'data' => $_update,
        ));
        //xóa all các khách hàng trong nhóm này
        //	...
        //	để lại
        //

        if ($result > 0) {
            $error = array(
                'flag' => 0,
                'message' => '',
            );

            echo json_encode(array(
                'error' => $error,
            ));
            die;
        } else {
            $error = array(
                'flag' => 1,
                'message' => 'Xóa không thành công',
            );
        }

        echo json_encode(array(
            'error' => $error,
        ));
        die;
    }

    //xóa nhiều
    //################  xóa nhóm => xóa all thành viên trong nhóm ################################
    public function ajax_group_delete()
    {

        $param = $this->input->post('param');

        //tiến hành xóa dữ liệu với danh sách id vừa lấy được
        if (isset($param['list']) && is_array($param['list']) && count($param['list'])) {
            foreach ($param['list'] as $key => $val) {
                $result = $this->Autoload_Model->_delete(array(
                    'where' => array('id' => $val),
                    'table' => $param['module'],
                ));
                $_update['publish'] = 1;
                $this->Autoload_Model->_update(array(
                    'where' => array('customerid' => $val),
                    'table' => 'product',
                    'data' => $_update,
                ));
                if ($result <= 0) {
                    $error = array(
                        'flag' => 1,
                        'message' => 'Xóa không thành công',
                    );

                    echo json_encode(array(
                        'error' => $error,
                    ));
                    die;
                }
            }
            //kết thúc quá trình delete dữ liệu
            $error = array(
                'flag' => 0,
                'message' => '',
            );

            echo json_encode(array(
                'error' => $error,
            ));
            die;
        }
    }
}
