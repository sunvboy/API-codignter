<div id="page-wrapper" class="gray-bg dashbard-1">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/navbar'); ?>
	</div>
	 <div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Thêm mới nhóm thành viên</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Thêm mới nhóm thành viên</strong></li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<form method="post" action="" class="form-horizontal">
			<div class="row">
				<div class="box-body">
					<?php $error = validation_errors(); echo !empty($error)?'<div class="alert alert-danger">'.$error.'</div>':'';?>
				</div><!-- /.box-body -->
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<div class="toolbox">
								<div class="uk-flex uk-flex-middle uk-flex-space-between">
									<h5>Thông tin cơ bản <small class="text-danger">(Điền đầy đủ các thông tin được hướng dẫn dưới đây.)</small></h5>
									<div class="uk-button">
										<button style="margin-right:2px;" class="btn btn-primary btn-sm" name="create" value="create" type="submit">Khởi tạo nhóm thành viên mới</button>
										<button class="btn btn-sm btn-warning" type="reset">Làm mới</button>
									</div>
								</div>
							</div>
						</div>
						<div class="ibox-content">
								<div class="form-group">
									<label class="col-md-2 control-label text-left">
										<span>Tên nhóm người dùng</span>
									</label>
									<div class="col-md-10">
										<?php echo form_input('title', set_value('title', ((isset($draft['title'])) ? $draft['title'] : '')), 'class="form-control static-link" placeholder="" autocomplete="off"');?>
									</div>
								</div>
								
								<div class="hr-line-dashed"></div>
                            <?php
                            $dropdown = dropdown(array(
                                'select' => 'id,keyword',
                                'query' => array('publish' => 1,'trash' => 0),
                                'table' => 'functions',
                                'order_by' => 'id asc',
                                'text' => '',
                                'field' => 'id',
                                'value' => 'keyword'
                            ));
                            ?>
								<?php 
									$dir = 'app/modules';
									$folder = scandir($dir);
									$permission = $this->input->post('permission');
								?>
								<?php if(isset($folder) && is_array($folder) && count($folder)){  ?>
								<?php foreach($folder as $keyFolder=> $valFolder){ ?>
								<?php if(in_array($valFolder, array('.', '..'))) continue; 	if(!in_array($valFolder, $dropdown)) continue;?>

								<?php if(!file_exists($dir.'/'.$valFolder.'/config.xml')) continue; ?>
								<?php 
									$xml = simplexml_load_file($dir.'/'.$valFolder.'/config.xml') or die('Error: Cannot create object '.$dir.'/'.$valFolder.'/config.xml');  
									$xml = json_decode(json_encode((array)$xml), TRUE);
								?>
								<?php if(isset($xml['permissions']) && is_array($xml['permissions']) && count($xml['permissions'])){ ?>
								<?php foreach($xml['permissions'] as $keyPermission => $valPermission){  ?>
								<?php if(!isset($valPermission['title']) || empty($valPermission['title'])) continue ?>
								<div class="form-group">
									<label class="col-md-2 control-label text-left">
										<span><?php echo $valPermission['title']; ?></span>
									</label>
									<?php if(isset($valPermission['item']) && is_array($valPermission['item']) && count($valPermission['item'])){ ?>
									<div class="col-md-10">
										<div class="userGroupContainer clearfix">
											<?php foreach($valPermission['item'] as $keyItems => $valItems){ ?>
											<div class="i-checks">
												<label><input name="permission[]" <?php echo (isset($permission) && is_array($permission) && in_array($valItems['param'], $permission))?'checked="checked"':'';?> type="checkbox" value="<?php echo $valItems['param']; ?>"> <i></i> <?php echo $valItems['description']; ?></label>
											</div>
											<?php } ?>
										</div>
									</div>
									<?php } ?>
								</div>
								<?php }}}} ?>
								
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-12">
										<label class="col-md-2 control-label text-left" style="padding-top:0">Hoạt động</label>
										<div class="col-md-2">
											<div class="switch">
												<div class="onoffswitch">
													<input type="checkbox" checked class="onoffswitch-checkbox publish" id="publish" name="publish" value="1">
													<label class="onoffswitch-label status" for="publish">
														<span class="onoffswitch-inner"></span>
														<span class="onoffswitch-switch"></span>
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="hr-line-dashed"></div>
								<div class="toolbox action clearfix">
									<div class="uk-flex uk-flex-middle uk-button pull-right">
										<button class="btn btn-primary btn-sm" name="create" value="create" type="submit">Khởi tạo nhóm thành viên mới</button>
										<button class="btn btn-sm btn-warning" type="reset" name="reset">Làm mới</button>
									</div>
								</div>
						</div>
					</div>
				</div>
			</div>
			
		</form>
	</div>
	<?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>
