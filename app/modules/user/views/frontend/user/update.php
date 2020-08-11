<div class="uk-container uk-container-center user-view">
	<div id="homepage" class="page-body">
		<div class="uk-grid uk-grid-small mb10">

			<div class="uk-width-1-4">
				<?php $this->load->view('homepage/frontend/common/aside-2');?>
			</div>

			<div class="uk-width-3-4">

				<?php $this->load->view('homepage/frontend/common/mainslide');?>
				<div class="article-panel">
					<div class="head">
						<span class="icon">
							<i class="fa fa-info-circle"></i>
						</span>
						THÔNG TIN KHÁCH HÀNG
					</div>
					<form class="m-t" role="form" method="post" action="<?php echo site_url('user/frontend/user/update') ?>">
						<ul class="content uk-list">
							<li class="mb10">
								<div class="uk-grid uk-grid-small mb10">
									<div class="uk-width-1-6">
										<div class="label">Tên liên lạc:</div>
									</div>
									<div class="uk-width-3-6">
										<div class="uk-flex">
											<select name="gender" class="mr10">
												<option value="1">Ông</option>
												<option value="2" <?php echo (isset($detailuser['gender']) && $detailuser['gender'] == 2) ? 'selected' : '' ?> >Bà</option>
											</select>
											<input class="form" type="text" name="fullname" value="<?php echo isset($detailuser['fullname']) ? $detailuser['fullname'] : '' ?>">
										</div>
									</div>
								</div>

								<div class="uk-grid uk-grid-small mb10">
									<div class="uk-width-1-6">
										<div class="label">Ngày sinh:</div>
									</div>
									<div class="uk-width-3-6">
										<div class="uk-flex">
											<input type="text" name="birthday" class="form width100 mr10" data-mask="99/99/9999" placeholder="" value="<?php echo isset($detailuser['birthday']) ? gettime($detailuser['birthday'], 'd/m/Y') : '' ?>">

											<!-- <input class="form datetimepicker" type="text" name="birthday" value="<?php echo isset($detailuser['birthday']) ? gettime($detailuser['birthday'], 'd/m/Y') : '' ?>"> -->
										</div>
									</div>
								</div>

								<div class="uk-grid uk-grid-small mb10">
									<div class="uk-width-1-6">
										<div class="label">Địa chỉ:</div>
									</div>
									<div class="uk-width-3-6">
										<input name="address" value="<?php echo isset($detailuser['address']) ? $detailuser['address'] : '' ?>" placeholder="Địa chỉ" autocomplete="off" type="text" class="form">
									</div>
								</div>
								

								<div class="uk-grid uk-grid-small mb10">
									<div class="uk-width-1-6">
										<div class="label">Trình độ:</div>
									</div>
									<div class="uk-width-3-6">
										<input name="academic_level" value="<?php echo isset($detailuser['academic_level']) ? $detailuser['academic_level'] : '' ?>" placeholder="Trình độ" autocomplete="off" type="text" class="form">
									</div>
								</div>

								<div class="uk-grid uk-grid-small mb10">
									<div class="uk-width-1-6">
										<div class="label">Nghề nghiệp:</div>
									</div>
									<div class="uk-width-3-6">
										<input name="job" value="<?php echo isset($detailuser['job']) ? $detailuser['job'] : '' ?>" placeholder="Nghề nghiệp" autocomplete="off" type="text" class="form">
									</div>
								</div>


								<div class="uk-grid uk-grid-small mb10">
									<div class="uk-width-1-6">
										<div class="label">Chức vụ:</div>
									</div>
									<div class="uk-width-3-6">
										<input name="position" value="<?php echo isset($detailuser['position']) ? $detailuser['position'] : '' ?>" placeholder="Chức vụ" autocomplete="off" type="text" class="form">
									</div>
								</div>

								<div class="uk-grid uk-grid-small mb10">
									<div class="uk-width-1-6">
										<div class="label">Số CMND:</div>
									</div>
									<div class="uk-width-3-6">
										<input name="cmt" value="<?php echo isset($detailuser['cmt']) ? $detailuser['cmt'] : '' ?>" placeholder="Số CMND" autocomplete="off" type="text" class="form">
									</div>
								</div>


								<div class="uk-grid uk-grid-small mb10">
									<div class="uk-width-1-6">
										<div class="label">Ngày cấp:</div>
									</div>
									<div class="uk-width-3-6">
										<input type="text" name="cmt_date" class="form width100 mr10" data-mask="99/99/9999" placeholder="" value="<?php echo isset($detailuser['cmt_date']) ? gettime($detailuser['cmt_date'], 'd/m/Y') : '' ?>">

										<!-- <input class="form datetimepicker" type="text" name="cmt_date" value="<?php echo isset($detailuser['cmt_date']) ? gettime($detailuser['cmt_date'], 'd/m/Y') : '' ?>"> -->
									</div>
								</div>


								<div class="uk-grid uk-grid-small mb10">
									<div class="uk-width-1-6">
										<div class="label">Nơi cấp:</div>
									</div>
									<div class="uk-width-3-6">
										<input name="cmt_address" value="<?php echo isset($detailuser['cmt_address']) ? $detailuser['cmt_address'] : '' ?>" placeholder="Nơi cấp" autocomplete="off" type="text" class="form">
									</div>
								</div>

								<div class="uk-grid uk-grid-small mb10">
									<div class="uk-width-1-6">
										<div class="label">SĐT:</div>
									</div>
									<div class="uk-width-3-6">
										<input name="phone" value="<?php echo isset($detailuser['phone']) ? $detailuser['phone'] : '' ?>" placeholder="Số điện thoại" autocomplete="off" type="text" class="form">
									</div>
								</div>

								<div class="uk-grid uk-grid-small mb10">
									<div class="uk-width-1-6">
										<div class="label">Email:</div>
									</div>
									<div class="uk-width-3-6">
										<input name="email" value="<?php echo isset($detailuser['email']) ? $detailuser['email'] : '' ?>" placeholder="Email" autocomplete="off" type="text" class="form">
									</div>
								</div>

							</li>
							<li>
								<div class="uk-grid uk-grid-small mb10">
									<div class="uk-width-4-6">
										<div class="submit">
											<input type="submit" value="Thực hiện" name="update">
										</div>
									</div>
								</div>
								
							</li>
						</ul>
					</form>
					
				</div>
			</div>
		</div>
		<?php $this->load->view('homepage/frontend/common/footer');?>
	</div><!-- .page-body -->
</div>
