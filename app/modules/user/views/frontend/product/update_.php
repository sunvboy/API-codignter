<div id="main" class="wrapper main-change-pasword">
	<div class="breadcrumb">
		<div class="container">
			<ul>
				<li><a href="<?php echo base_url()?>">Trang chủ  /</a></li>
				<li><a href="javascript:void(0)">Cập nhập sản phẩm</a></li>
			</ul>
		</div>
	</div>

	<div class="main-account">
		<div class="container">
			<div class="conten-account">
				<div class="row">
					<?php echo $this->load->view('user/frontend/manage/aside') ?>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<div class="account-right">
							<h2 class="title-primary">Cập nhập sản phẩm</h2>
							<div style="clear: both;height: 20px"></div>
							<div id="page-wrapper" class="gray-bg dashbard-1 fix-wrapper container">

								<form method="post" action="" class="form-horizontal box">


									<script type="text/javascript">
										var submit = '<?php echo $this->input->post('create'); ?>';
										var catalogueid = '<?php echo json_encode($this->input->post('catalogue')); ?>';
										var tag = '<?php echo json_encode($this->input->post('tag')); ?>';
									</script>
									<div class="wrapper wrapper-content animated fadeInRight">
										<div class="row">
											<div class="box-body">
												<?php $error = validation_errors();
												echo !empty($error) ? '<div class="alert alert-danger">' . $error . '</div>' : ''; ?>
											</div>
											<!-- /.box-body -->
										</div>
										<div class="row">
											<div class="col-lg-8 clearfix">
												<div class="ibox mb20">

													<div class="ibox-content">
														<div class="row mb15">
															<div class="col-lg-12">
																<div class="form-row">
																	<label class="control-label text-left">
																		<span>Tiêu đề sản phẩm<b class="text-danger">(*)</b></span>
																	</label>
																	<input type="hidden" value="" name="catalogue[]">
																	<?php echo form_input('title', htmlspecialchars_decode(html_entity_decode(set_value('title', $product['title']))), 'class="form-control title" placeholder="" id="title" autocomplete="off"');?>
																</div>
															</div>
														</div>
														<div class="row mb15">
															<div class="col-lg-12">
																<div class="form-row">
																	<div class="uk-flex uk-flex-middle uk-flex-space-between">
																		<label class="control-label ">
																			<span>Đường dẫn <b class="text-danger">(*)</b></span>
																		</label>
																	</div>
																	<div class="outer">
																		<div class="uk-flex uk-flex-middle">
																			<div class="base-url"><?php echo base_url(); ?></div>
																			<?php echo form_input('canonical', htmlspecialchars_decode(html_entity_decode(set_value('canonical', $product['canonical']))), 'class="form-control canonical" placeholder="" autocomplete="off" data-flag="0" ');?>

																			<?php echo form_input('original_canonical', htmlspecialchars_decode(html_entity_decode(set_value('canonical', $product['canonical']))), 'class="form-control" placeholder="" style="display:none;" autocomplete="off"');?>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="row mb15">
															<div class="col-lg-12 m-b">
																<div class="form-row">
																	<div class="uk-flex uk-flex-middle uk-flex-space-between">
																		<label class="control-label text-left">
																			<span>Nội dung</span>
																		</label>

																	</div>
																	<?php echo form_textarea('description', htmlspecialchars_decode(html_entity_decode(set_value('description', $product['description']))), 'class="form-control ck-editor" id="ckDescription" placeholder="" autocomplete="off" '); ?>
																</div>
															</div>

														</div>
													</div>
												</div>

												<div class="ibox mb20 album">
													<div class="ibox-title">
														<div class="uk-flex uk-flex-middle uk-flex-space-between">
															<h5>Album Ảnh </h5>

															<div class="uk-flex uk-flex-middle uk-flex-space-between">
																<div class="edit">
																	<a onclick="openKCFinderImage(this);return false;" href="" title="" class="upload-picture">Chọn hình</a>
																</div>
															</div>
														</div>
													</div>
													<div class="ibox-content">
														<?php
														$album = $this->input->post('album');
														if(!empty($album) && is_array($album) && count($album)){
															$album = $album;
														}else{
															$album = json_decode(base64_decode($product['image_json']), true);
														}
														?>
														<div class="row">
															<div class="col-lg-12">
																<div class="click-to-upload" <?php echo (isset($album))?'style="display:none"':'' ?>>
																	<div class="icon">
																		<a type="button" class="upload-picture" onclick="openKCFinderImage(this);return false;">
																			<svg style="width:80px;height:80px;fill: #d3dbe2;margin-bottom: 10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80"><path d="M80 57.6l-4-18.7v-23.9c0-1.1-.9-2-2-2h-3.5l-1.1-5.4c-.3-1.1-1.4-1.8-2.4-1.6l-32.6 7h-27.4c-1.1 0-2 .9-2 2v4.3l-3.4.7c-1.1.2-1.8 1.3-1.5 2.4l5 23.4v20.2c0 1.1.9 2 2 2h2.7l.9 4.4c.2.9 1 1.6 2 1.6h.4l27.9-6h33c1.1 0 2-.9 2-2v-5.5l2.4-.5c1.1-.2 1.8-1.3 1.6-2.4zm-75-21.5l-3-14.1 3-.6v14.7zm62.4-28.1l1.1 5h-24.5l23.4-5zm-54.8 64l-.8-4h19.6l-18.8 4zm37.7-6h-43.3v-51h67v51h-23.7zm25.7-7.5v-9.9l2 9.4-2 .5zm-52-21.5c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3zm-13-10v43h59v-43h-59zm57 2v24.1l-12.8-12.8c-3-3-7.9-3-11 0l-13.3 13.2-.1-.1c-1.1-1.1-2.5-1.7-4.1-1.7-1.5 0-3 .6-4.1 1.7l-9.6 9.8v-34.2h55zm-55 39v-2l11.1-11.2c1.4-1.4 3.9-1.4 5.3 0l9.7 9.7c-5.2 1.3-9 2.4-9.4 2.5l-3.7 1h-13zm55 0h-34.2c7.1-2 23.2-5.9 33-5.9l1.2-.1v6zm-1.3-7.9c-7.2 0-17.4 2-25.3 3.9l-9.1-9.1 13.3-13.3c2.2-2.2 5.9-2.2 8.1 0l14.3 14.3v4.1l-1.3.1z"></path></svg>
																		</a>
																	</div>
																	<div class="small-text">Sử dụng nút <b>Chọn hình</b> để thêm hình.</div>
																</div>
																<div class="upload-list" <?php echo (isset($album))?'':'style="display:none"' ?> style="padding:5px;">
																	<div class="row">
																		<ul id="sortable" class="clearfix sortui">
																			<?php if(isset($album) && is_array($album) && count($album)){ ?>
																				<?php foreach($album as $key => $val){ ?>
																					<li class="ui-state-default">
																						<div class="thumb">
															<span class="image img-scaledown">
																<img src="<?php echo $val; ?>" alt="" /> <input type="hidden" value="<?php echo $val; ?>" name="album[]" />
															</span>
																							<div class="overlay"></div>
																							<div class="delete-image"><i class="fa fa-trash" aria-hidden="true"></i></div>
																						</div>
																					</li>
																				<?php }} ?>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="ibox mb20 block-detail-product">
													<div class="ibox-title uk-flex uk-flex-middle uk-flex-space-between">
														<h5>Thông tin chi tiết</h5>
													</div>
													<div class="ibox-content">
														<div class="row">
															<div class="col-lg-6 m-b">
																<label class="control-label ">
																	<span>Giá<b class="text-danger">(*)</b></span>
																</label>

																<div class="form-row">
																	<?php echo form_input('price', set_value('price',$product['price']), 'class=" m-b-sm form-control " placeholder="đ" autocomplete="off"');?>
																	<div class="uk-flex uk-flex-middle">
																		<div class="m-r-sm">
																			<?php if (isset($price_contact) && $price_contact == 1) { ?>
																				<input type="checkbox" checked name="price_contact" value="1"
																					   id="checkbox-item">
																			<?php } else { ?>
																				<input type="checkbox" name="price_contact" value="1"
																					   id="checkbox-item">
																			<?php } ?>
																		</div>
																		<div style="margin-left: 5px">
																			Liên hệ để biết giá
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-6 m-b">
																<label class="control-label ">
																	<span>Giá khuyến mại</span>
																</label>

																<div class="form-row">
																	<?php echo form_input('price_sale', set_value('price_sale', $product['price_sale']), 'class="form-control " placeholder="đ" autocomplete="off"');?>
																</div>
															</div>
														</div>
														<div class="row" style="margin-top: 20px">
															<div class="col-lg-6 mb15">
																<label class="control-label ">
																	<span>Mã sản phẩm<b class="text-danger">(*)</b></span>
																</label>

																<div class="form-row">
																	<?php $code = CodeRender('product') ?>
																	<?php echo form_input('code', set_value('code', $product['code']), 'class="form-control" placeholder="SP001" autocomplete="off"');?>
																</div>
															</div>
															<div class="col-lg-6 mb15">
																<label class="control-label ">
																	<span>Thời gian khuyến mại</span>
																</label>

																<div class="form-row">
																	<?php echo form_input('time_sale', htmlspecialchars_decode(html_entity_decode(set_value('time_sale', $product['time_sale']))), 'class="form-control datetimepicker" placeholder=""  autocomplete="off"');?>
																</div>
															</div>
														</div>
														<div class="row" style="margin-top: 20px">
															<div class="col-lg-12 mb15">
																<label class="control-label ">
																	<span>Khuyến mại</span>
																</label>
																<div class="form-row">
																	<?php echo form_input('khuyenmai', set_value('khuyenmai', $product['khuyenmai']), 'class="form-control" placeholder="Khuyến mại" autocomplete="off"'); ?>
																</div>
															</div>

														</div>
														<div class="row" style="margin-top: 20px">
															<div class="col-lg-12 mb15">
																<label class="control-label ">
																	<span>Mô tả</span>
																</label>
																<div class="form-row">
																	<?php echo form_textarea('mota',htmlspecialchars_decode(html_entity_decode(set_value('mota', $product['mota']))), 'class="form-control" placeholder="" autocomplete="off"'); ?>
																</div>
															</div>

														</div>
													</div>
												</div>
												<button type="submit" name="update" value="update" class="btn btn-success block m-b pull-right">Cập nhập
												</button>
											</div>
											<div class="col-lg-4">
												<div class="ibox mb20">
													<div class="ibox-title">
														<h5>Hiển thị </h5>
													</div>
													<div class="ibox-content">
														<div class="row">
															<div class="col-lg-12">
																<div class="form-row">
																	<span class="text-black mb15">Quản lý thiết lập hiển thị cho blog này.</span>
																	<div class="block clearfix">
																		<div class="i-checks mr30" style="width:100%;"><span style="color:#000;"> <input <?php echo ($this->input->post('publish') == 0) ? 'checked' : (($product['publish'] == 0) ? 'checked' : '') ?>  class="popup_gender_1 gender" type="radio" value="0"  name="publish"> <i></i>Cho phép hiển thị trên website</span></div>
																	</div>
																	<div class="block clearfix">
																		<div class="i-checks" style="width:100%;"><span style="color:#000;"> <input type="radio" <?php echo ($this->input->post('publish') == 1) ? 'checked' : (($product['publish'] == 1) ? 'checked' : '') ?>  class="popup_gender_0 gender" required value="1" name="publish"> <i></i> Tắt chức năng hiển thị trên website. </span></div>
																	</div>
																</div>
																<?php
																$publish_time = gettime($product['publish_time'],'d/m/Y H:i');
																$publish_time = explode(' ', $publish_time);
																?>
																<div class="post-setting hidden">
																	<a href="" title="" class="setting-button mb5" data-flag="1">Xóa thiết lập</a>
																	<div class="setting-group">
																		<div class="uk-flex uk-flex-middle uk-flex-space-between">
																			<?php echo form_input('post_date', htmlspecialchars_decode(html_entity_decode(set_value('post_date', $publish_time[0]))), 'class="form-control datetimepicker" placeholder=""  autocomplete="off"');?>
																			<span style="margin-right:5px;color:#141414;">lúc</span>
																			<?php echo form_input('post_time', htmlspecialchars_decode(html_entity_decode(set_value('post_time', $publish_time[1]))), 'class="form-control" placeholder="" id="input-clock" autocomplete="off" data-default="20:48"');?>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="ibox mb20">
													<div class="ibox-title uk-flex uk-flex-middle uk-flex-space-between">
														<h5>Danh mục sản phẩm</h5>
													</div>
													<?php
													$dropdown = $this->Autoload_Model->_get_where(array('table' => 'product_catalogue', 'select' => 'id, title, parentid, lft, rgt, level, order', 'order_by' => 'lft ASC, order ASC', 'where' => array('publish' => 0, 'alanguage' => $this->fc_lang)), true);
													?>
													<div class="ibox-content">
														<div class="row mb15">
															<div class="col-lg-12">
																<div class="form-row">
																	<label class="control-label text-left">
																		<span>Danh mục sản phẩm <b class="text-danger">(*)</b></span>
																	</label>
																	<div class="form-row">
																		<select name="catalogueid" style="height: 32px;border: 1px solid #c4cdd5;padding-left: 10px;font-size: 12px;border-radius: 5px;width: 100%;" >
																			<?php if(!empty($dropdown)){ ?>
																				<?php foreach($dropdown as $key=>$val){?>
																					<option <?php if($val['id'] == $product['catalogueid']){?>selected<?php }?> value="<?php echo $val['id']?>"><?php echo str_repeat('|-----', (($val['level'] > 0) ? ($val['level'] - 1) : 0)) . $val['title']?></option>
																				<?php }?>
																			<?php }?>
																		</select>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="ibox mb20">
													<div class="ibox-title uk-flex uk-flex-middle uk-flex-space-between">
														<h5>Phân loại </h5>
													</div>
													<div class="ibox-content">
														<div class="row mb15">
															<div class="col-lg-12">
																<div class="form-row">
																	<label class="control-label text-left">
																		<span>Quốc gia <b class="text-danger">(*)</b></span>
																	</label>
																	<?php $nationalityDropdown = nationalityDropdown();?>
																	<div class="form-row">
																		<select name="nationality" style="height: 32px;border: 1px solid #c4cdd5;padding-left: 10px;font-size: 12px;border-radius: 5px;width: 100%;" >
																			<?php if(!empty($nationalityDropdown)){ ?>

																				<?php foreach($nationalityDropdown as $key=>$val){?>
																					<option <?php if($val==$product['nationality']){?>selected<?php }?> value="<?php echo $val?>"><?php echo $val?></option>
																				<?php }?>
																			<?php }?>
																		</select>
																	</div>
																</div>
															</div>
														</div>

													</div>
												</div>

											</div>
										</div>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>


	</div>
</div>
<?php echo $this->load->view('user/frontend/product/script')?>

<script>
	$(document).ready(function () {
		Dropzone.autoDiscover = false;
		$("#myAwesomeDropzone").dropzone({
			url: "uploaddropzone.html",
			addRemoveLinks: true,
			removedfile: function(file) {
				var name = file.name;
				var result = file.name.split('.');
				$('#'+result[0]).remove();
				$.ajax({
					type: 'POST',
					url: 'uploaddropzone.html',
					data: {name: name,request: 2},
					sucess: function(e){
						alert(e);
					}
				});
				var _ref;
				return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
			},
			success: function (file, response) {
				var imgName = response;
				file.previewElement.classList.add("dz-success");
				//console.log("Successfully uploaded :" + imgName);
				$('#listalbums').append(imgName);
			},
			error: function (file, response) {
				file.previewElement.classList.add("dz-error");
			}
		});
	});
</script>

<script>
	$('.lisanpham .acc__panel').addClass('open');
</script>