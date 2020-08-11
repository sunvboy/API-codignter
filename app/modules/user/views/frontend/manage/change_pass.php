<div id="main" class="wrapper main-change-pasword">
	<div class="breadcrumb">
		<div class="container">
			<ul>
				<li><a href="<?php echo base_url()?>">Trang chủ  /</a></li>
				<li><a href="change-pass.html">Quên mật khẩu</a></li>
			</ul>
		</div>
	</div>
	<div class="main-account">
		<div class="container">
			<div class="conten-account">
				<div class="row">
					<?php echo $this->load->view('user/frontend/manage/aside')?>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<div class="account-right">
							<h2 class="title-primary">Đổi mật khẩu</h2>

							<form method="post" action="" class="nav-account-right">
								<div class="item">
									<?php $error = validation_errors(); echo !empty($error)?'<div class="mt10 alert alert-danger">'.$error.'</div>':'';?>
								</div>
								<div class="item">
									<div class="left"><label for="">Mật khẩu cũ</label></div>
									<div class="right">
										<?php echo form_password('password', set_value('password'), 'placeholder="" autocomplete="off"');?>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="item">
									<div class="left"><label for="">Mật khẩu mới</label></div>
									<div class="right">
										<?php echo form_password('newpassword', set_value('newpassword'), 'placeholder="" autocomplete="off"');?>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="item">
									<div class="left"><label for="">Nhập lại mật khẩu</label></div>
									<div class="right">
										<?php echo form_password('renewpassword', set_value('renewpassword'), ' placeholder="" autocomplete="off"');?>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="item">
									<div class="left"></div>
									<div class="right">
										<input type="submit" name="update" class="btn btn-md btn-primary" value="Cập nhập">
										<?php /*?>
										<span>Quên mật khẩu <a href="">Lấy lại mật khẩu</a></span>
 										<?php */?>

									</div>
									<div class="clearfix"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>


	</div>
</div>
<script>
	$('.litaikhoan .acc__panel').addClass('open');
</script>