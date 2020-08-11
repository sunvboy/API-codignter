<div id="page-wrapper" class="gray-bg dashboard-1">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/navbar');?>
	</div>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-12">
			<h2>Modules</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Danh sách modules</strong></li>
			</ol>
		</div>
	</div>
	<!-- --------------------------- -->
	<div class="wrapper wrapper-content animated fadeInRight">
		<form method="post" action="" class="form-horizontal box">
			<div class="row">
				<div class="col-lg-12">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<h5>DANH SÁCH MODULES</h5>

						</div>
						<div class="ibox-content" style="position:relative;">
							<div class="table-responsive">

								<table class="table table-striped table-bordered table-hover dataTables-example" >
									<thead>
									<tr>


										<th style="width:250px;">ID</th>
										<th>Tên modules</th>
										<th>Từ khóa</th>
										<th>Kích hoạt</th>
										<th style="width:110px;" class="text-center">Thao tác</th>
									</tr>
									</thead>
									<tbody id="ajax-content">

									<?php if(isset($listContact) && is_array($listContact) && count($listContact)){ ?>
										<?php foreach($listContact as $key => $item){?>
											<tr class="gradeX" id="">

												<td><?php echo $item['id'];?></td>
												<td><?php echo $item['title'];?></td>
												<td><?php echo $item['keyword'];?></td>
												<td style="text-align:center;">
													<div class="switch">
														<div class="onoffswitch">
															<input type="checkbox" <?php echo ($item['publish'] == 1) ? 'checked=""' : ''; ?> class="onoffswitch-checkbox publish" data-id="<?php echo $item['id']; ?>" id="publish-<?php echo $item['id']; ?>">
															<label class="onoffswitch-label" for="publish-<?php echo $item['id']; ?>">
																<span class="onoffswitch-inner"></span>
																<span class="onoffswitch-switch"></span>
															</label>
														</div>
													</div>
												</td>
												<td class="text-center">
													<div class="btn-group">
														<a href="<?php echo site_url('functions/backend/functions/update/'.$item['id']).'?redirect='.urlencode(current_url());?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
													</div>
												</td>
											</tr>
										<?php }} else{ ?>
										<tr>
											<td colspan="9"><small class="text-danger">Không có dữ liệu phù hợp</small></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
							<div id="pagination" class="p-pagination">
								<?php echo (isset($PaginationList))? $PaginationList :'';?>
							</div>
						</div>
					</div>

				</div>
			</div>

			<!-- --------------------------- -->

	</div>
	</form>
	<?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>
<script>
	$(document).on('change','.publish',function(){
		let _this = $(this);
		let objectid = _this.attr('data-id');
		let formURL = 'functions/backend/functions/status';
		$.post(formURL, {
				objectid: objectid},
			function(data){

			});
	});
</script>