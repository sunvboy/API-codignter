<link href="template/backend/css/customize.css" rel="stylesheet">

<div id="page-wrapper" class="gray-bg dashbard-1 container">
	<ul class="breadcrumb">
		<li><a href="<?php echo base_url()?>"><i class="fa fa-home"></i></a></li>
		<li><a href="javascript:void(0);">Quản lý sản phẩm</a></li>
	</ul>

	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-sm-9">
				<h2 class="subtitle">Danh sách sản phẩm</h2>
				<form method="post" action="">
				<div class="ibox float-e-margins">

					<div class="ibox-content" style="position:relative;">
						<div>
							<div class="block_filter" style="margin-bottom: 10px">
								<div class="ibox" style="border: none !important; margin-bottom: 0px">
					                <div class="ibox-title">
					                	<div class="uk-flex uk-flex-middle uk-flex-space-between">

											<div class="toolbox">
												<div class="uk-flex uk-flex-middle uk-flex-space-between">
													<div class="uk-button">
														<a href="<?php echo site_url('create-product'); ?>" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i> Thêm sản phẩm mới</a>
													</div>
												</div>
											</div>
						                </div>
					               	</div>

								</div>
			                </div>
							
			


							<table class="table table-striped table-bordered table-hover dataTables-example" id="ajax-content">
								<thead>
									<tr>

										<th>Tiêu đề</th>
										<th style="width:85px;" class="text-center">Giá bán</th>
										<th style="width:100px;" class="text-center">Người tạo</th>
										<th style="width:136px;" class="text-center">Thao tác</th>
									</tr>
								</thead>
								<tbody >
									<?php if(isset($listData) && is_array($listData) && count($listData)){ ?>
										<?php foreach($listData as $key => $val){ ?>
										<?php
											$href = rewrite_url($val['canonical'], true, true);

											$image = getthumb($val['image']);
											$_catalogue_list = '';
											$catalogue = json_decode($val['catalogue'], TRUE);
											if(isset($catalogue) && is_array($catalogue) && count($catalogue)){
												$_catalogue_list = $this->Autoload_Model->_get_where(array(
													'select' => 'id, title, slug, canonical',
													'table' => 'product_catalogue',
													'where_in' => json_decode($val['catalogue'], TRUE),
													'where_in_field' => 'id',
												), TRUE);
											}
										?>
											<tr class="gradeX" id="post-<?php echo $val['id']; ?>">

												<td>
													<div class="uk-flex uk-flex-middle uk-flex-space-between">
														<div class="uk-flex uk-flex-middle ">
															<div class="image mr5">
																<span class="image-post img-cover"><img src="<?php echo $image; ?>" alt="<?php echo $val['title']; ?>" /></span>
															</div>
															<div class="main-info">
																<div class="title">
                                                                    <a class="maintitle" href="<?php echo $href ?>">
                                                                        <?php echo $val['title']; ?> (<?php echo $val['viewed'].' lượt xem'; ?>)
                                                                    </a>
                                                                    <a href="<?php echo $href ?>" title="Lấy địa chỉ liên kết" onclick="prompt('Lấy địa chỉ liên kết','<?php echo $href ?>'); return false;"><img border="0" src="template/backend/img/link.png"></a>
																</div>

															</div>
														</div>

														<div>
															<a target="_blank" href="<?php echo $href ?>" ><i class="fa fa-link" aria-hidden="true"></i></a>
														</div>
													</div>
												</td>
												<td class="text-right price">
													<?php 
														if($val['price_contact'] == 1 ){
															echo '<span>Giá liên hệ</span>';
														}else{
															$price = (!empty($val['price_sale']))? $val['price_sale'] : $val['price'];
															$field =  (!empty($val['price_sale']))? 'price_sale' : 'price';
															if(!empty($val['price_sale'])){
																echo '<i class="fa fa-tag m-r-xs" aria-hidden="true"></i>';
															}
															echo '<span>'.addCommas($price).'</span>';
														    echo form_input('price',addCommas($price) , 'data-id="'.$val['id'].'" data-field="'.$field.'"  class="int form-control" style="text-align:right; padding:6px 3px; display:none"');
														}

													?>
												</td>
												

												<td>
													<div class="switch">
														<div class="onoffswitch">
															<input type="checkbox" <?php echo ($val['publish'] == 0) ? 'checked=""' : ''; ?> class="onoffswitch-checkbox publish" data-id="<?php echo $val['id']; ?>" id="publish-<?php echo $val['id']; ?>">
															<label class="onoffswitch-label" for="publish-<?php echo $val['id']; ?>">
																<span class="onoffswitch-inner"></span>
																<span class="onoffswitch-switch"></span>
															</label>
														</div>
													</div>
												</td>

												<td class="text-center">
													<a type="button" href="update-product.html?id=<?php echo $val['id'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
													<a type="button" href="javascript:void(0)" class="btn btn-danger ajax_delete_product" data-title="Lưu ý: Dữ liệu sẽ không thể khôi phục. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!" data-router="<?php echo $val['canonical']; ?>" data-id="<?php echo $val['id'] ?>" data-catalogueid="<?php echo $val['catalogueid'] ?>" data-module="product"><i class="fa fa-trash"></i></a>

												</td>
											</tr>
										<?php }}else{ ?>
											<tr>
												<td colspan="100"><small class="text-danger">Không có dữ liệu phù hợp</small></td>
											</tr>
										<?php } ?>
								</tbody>
							</table>
						</div>
						<div id="pagination">
							<?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
						</div>
						<div class="loader"></div>
					</div>
				</div>
			</div>
			<?php echo $this->load->view('user/frontend/manage/aside')?>
		</div>
	</div>
</div>
<link href="template/backend/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

<style>
	/* SWITCHES */
	.onoffswitch {
		position: relative;
		width: 54px;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
	}
	.onoffswitch-checkbox {
		display: none;
	}
	.onoffswitch-label {
		display: block;
		overflow: hidden;
		cursor: pointer;
		border: 2px solid #3a88be;
		border-radius: 3px;
	}
	.onoffswitch-inner {
		display: block;
		width: 200%;
		margin-left: -100%;
		-moz-transition: margin 0.3s ease-in 0s;
		-webkit-transition: margin 0.3s ease-in 0s;
		-o-transition: margin 0.3s ease-in 0s;
		transition: margin 0.3s ease-in 0s;
	}
	.onoffswitch-inner:before,
	.onoffswitch-inner:after {
		display: block;
		float: left;
		width: 50%;
		height: 16px;
		padding: 0;
		line-height: 16px;
		font-size: 10px;
		color: white;
		font-family: Trebuchet, Arial, sans-serif;
		font-weight: bold;
		-moz-box-sizing: border-box;
		-webkit-box-sizing: border-box;
		box-sizing: border-box;
	}
	.onoffswitch-inner:before {
		content: "ON";
		padding-left: 7px;
		background-color: #3a88be;
		color: #FFFFFF;
	}
	.onoffswitch-inner:after {
		content: "OFF";
		padding-right: 7px;
		background-color: #FFFFFF;
		color: #919191;
		text-align: right;
	}
	.onoffswitch-switch {
		display: block;
		width: 18px;
		margin: 0;
		background: #FFFFFF;
		border: 2px solid #3a88be;
		border-radius: 3px;
		position: absolute;
		top: 0;
		bottom: 0;
		right: 36px;
		-moz-transition: all 0.3s ease-in 0s;
		-webkit-transition: all 0.3s ease-in 0s;
		-o-transition: all 0.3s ease-in 0s;
		transition: all 0.3s ease-in 0s;
	}
	.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
		margin-left: 0;
	}
	.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
		right: 0;
	}
</style>
<script src="template/backend/js/plugins/sweetalert/sweetalert.min.js"></script>

<script>
	$(document).on('change','.publish',function(){
		let _this = $(this);
		let objectid = _this.attr('data-id');
		let formURL = 'user/frontend/product/status';
		$.post(formURL, {
				objectid: objectid},
			function(data){

			});
	});
	$(document).on('click','.ajax_delete_product',function(){
		let _this = $(this);
		let param = {
			'title' : _this.attr('data-title'),
			'id'    : _this.attr('data-id'),
			'router' : _this.attr('data-router'),
		}
		swal({
				title: "Hãy chắc chắn rằng bạn muốn thực hiện thao tác này?",
				text: param.title,
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Thực hiện!",
				cancelButtonText: "Hủy bỏ!",
				closeOnConfirm: false,
				closeOnCancel: false },
			function (isConfirm) {
				if (isConfirm) {
					let ajax_url = 'user/frontend/product/ajax_delete_product';
					$.post(ajax_url, {
							id: param.id, router: param.router, },
						function(data){
							if(data == 0){
								sweet_error_alert('Có vấn đề xảy ra','Vui lòng thử lại')
							}else{
								_this.parents('tr').hide().remove();
								swal("Xóa thành công!", "Hạng mục đã được xóa khỏi danh sách.", "success");
							}
						});

				} else {
					swal("Hủy bỏ", "Thao tác bị hủy bỏ", "error");
				}
			});
	});
</script>