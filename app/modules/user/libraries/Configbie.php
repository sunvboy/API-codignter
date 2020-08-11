<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ConfigBie{
	
	function __construct($params = NULL){
		$this->params = $params;
	}

	public function data($field = 'process', $value = -1){
		$data['state_order'] = array(
			'-1' => 'Chọn trạng thái',
			'pending' => '<span class="label label-primary">Đang chờ</span>',
			'pending_payment' => 'Đang chờ cổng thanh toán',
			'processing' => 'Đã xử lí',
			'completed' => 'Đã hoàn thành',
			'canceled' => 'Hủy',
		);
		$data['publish'] = array(
			-1 => '- Chọn xuất bản -',
			0 => 'Không xuất bản',
			1 => 'Xuất bản',
		);
		$data['perpage'] = array(
			20 => '20 bản ghi',
			30 => '30 bản ghi',
			40 => '40 bản ghi',
			50 => '50 bản ghi',
			60 => '60 bản ghi',
			70 => '70 bản ghi',
			80 => '80 bản ghi',
			90 => '90 bản ghi',
			100 => '100 bản ghi',
		);
		$data['gender'] = array(
			'0' => 'Chọn giới tính',
			'1' => 'Nam',
			'2' => 'Nữ',
		);
		$data['catalogueid'] = array(
			'' => 'Chọn tài khoản*',
			'1' => 'Cửa hàng',
			'2' => 'Khách hàng',
		);
		if($value == -1){
			return $data[$field];
		}
		else{
			return $data[$field][$value];
		}
	}
}