<div class="main-container container">
	<ul class="breadcrumb">
		<li><a href="<?php echo base_url()?>"><i class="fa fa-home"></i></a></li>
		<li><a href="javascript:void(0);">Đổi mật khẩu</a></li>
	</ul>

	<div class="row">
		<!--Middle Part Start-->
		<div class="col-sm-9" id="content">
			<h2 class="subtitle">Đổi mật khẩu</h2>
			<p class="lead">Xin chào, <strong><?php echo $this->FT_auth['fullname']?></strong> - Để đổi mật khẩu tài khoản của bạn.</p>
			<form method="post" action="">
				<div class="row">
					<div class="col-md-12">
						<?php $error = validation_errors(); echo !empty($error)?'<div class="mt10 alert alert-danger">'.$error.'</div>':'';?>

					</div>
					<div class="col-sm-12">
						<fieldset id="personal-details">

							<div class="form-group required">
								<label for="input-lastname" class="control-label">Mật khẩu mới</label>
								<?php echo form_password('newpassword', set_value('newpassword'), 'class="field__input form-control" placeholder="" autocomplete="off"');?>
							</div>

							<div class="form-group required">
								<label for="input-telephone" class="control-label">Nhập lại mật khẩu mới</label>
								<?php echo form_password('renewpassword', set_value('renewpassword'), 'class="field__input form-control" placeholder="" autocomplete="off"');?>
							</div>

						</fieldset>
						<br>
					</div>
				</div>
				<div class="buttons clearfix">
					<div class="pull-right">
						<input type="submit" name="update" class="btn btn-md btn-primary" value="Cập nhập">
					</div>
				</div>
			</form>
		</div>
		<!--Middle Part End-->
		<!--Right Part Start -->
		<?php echo $this->load->view('user/frontend/manage/aside')?>
		<!--Right Part End -->
	</div>
</div>