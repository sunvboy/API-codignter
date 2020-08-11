<div id="page-wrapper" class="gray-bg dashbard-1">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/navbar'); ?>
	</div>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Quản lý nhóm thuộc tính</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Quản lý nhóm thuộc tính</strong></li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Danh sách nhóm thuộc tính</h5>
						<div class="ibox-tools">
							<a class="collapse-link">
								<i class="fa fa-chevron-up"></i>
							</a>
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="fa fa-wrench"></i>
							</a>
							<ul class="dropdown-menu dropdown-attribute">
								<li><a type="button" class="ajax-recycle-all" data-title="Lưu ý: Khi bạn xóa nhóm thuộc tính, toàn bộ sản phẩm trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện chức năng này!" data-module="attribute_catalogue">Xóa tất cả</a>
								</li>
							</ul>
							<a class="close-link">
								<i class="fa fa-times"></i>
							</a>
						</div>
					</div>
					<div class="ibox-content" style="position:relative;">
						<div class="table-responsive">
							<div class="uk-flex uk-flex-middle uk-flex-space-between">
								<div class="perpage">
									<div class="uk-flex uk-flex-middle mb10">
										<?php echo form_dropdown('perpage', $this->configbie->data('perpage'), set_value('perpage',$this->input->get('perpage')) ,'class="form-control input-sm perpage filter"  data-url="'.site_url('attribute/backend/catalogue/view').'"'); ?>
									</div>
								</div>
								<div class="toolbox">
									<div class="uk-flex uk-flex-middle uk-flex-space-between">
										<div class="uk-search uk-flex uk-flex-middle mr10">
											<form class="uk-form" id="search">

                                                <div class="hidden">
                                                    <?php echo form_dropdown('view', array(1=>'Tour'), set_value('view',$this->input->get('view')) ,'class=" form-control select3 input-sm filter view" '); ?>
                                                </div>

                                                <input type="search" name="keyword"  class="keyword form-control input-sm filter" placeholder="Nhập từ khóa tìm kiếm ..." autocomplete="off" value="<?php echo $this->input->get('keyword'); ?>" >

                                            </form>
										</div>
										<div class="uk-button">
											<a href="<?php echo site_url('tour/backend/acatalogue/create'); ?>" class="btn btn-danger"><i class="fa fa-plus"></i> Thêm mới</a>
										</div>
									</div>
								</div>
							</div>
							<div class="uk-flex uk-flex-middle uk-flex-space-between">
								<div class="text-small mb10">Hiển thị từ <?php echo $from; ?> đến <?php echo $to ?> trên tổng số <?php echo $config['total_rows']; ?> bản ghi</div>
								<div class="text-small text-danger">*Sắp xếp Vị trí hiển thị theo quy tắc: Số lớn hơn được ưu tiên hiển thị trước. </div>
							</div>
							<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
									<tr>
										<th style="width:40px;">
											<input type="checkbox" id="checkbox-all">
											<label for="check-all" class="labelCheckAll"></label>
										</th>
										<th style="width:45px;">ID</th>
										<th>Tiêu đề</th>
										<th style="width:67px;" class="text-center">Vị trí</th>
										<th style="width:175px;">Người tạo</th>
										<th style="width:100px;">Ngày tạo</th>

                                        <th style="width:81px;">Hiển thị</th>
                                        <th style="width:81px;">Nổi bật</th>
                                        <th style="width:81px;">Trạng thái</th>

                                        <th style="width:150px;" class="text-center">Thao tác</th>
									</tr>
								</thead>
								<tbody id="ajax-content">
									<?php if(isset($listCatalogue) && is_array($listCatalogue) && count($listCatalogue)){ ?>
										<?php foreach($listCatalogue as $key => $val){ ?>
											<tr class="gradeX" id="cat-<?php echo $val['id']; ?>">
												<td>
													<input type="checkbox" name="checkbox[]" value="<?php echo $val['id']; ?>" class="checkbox-item">
													<label for="" class="label-checkboxitem"></label>
												</td>
												<td><?php echo $val['id']; ?></td>
												<td>

                                                    <a class="maintitle"  href="<?php echo site_url('attribute/backend/attribute/view?catalogueid='.$val['id'].''); ?>" ></a><?php echo str_repeat('|----', (($val['level'] > 0)?($val['level'] - 1):0)).$val['title']; ?></a>

                                                </td>
												<td>
													<?php echo form_input('order['.$val['id'].']', $val['order'], 'data-module="attribute_catalogue" data-id="'.$val['id'].'"  class="form-control sort-order" placeholder="Vị trí" style="width:50px;text-align:right;"');?>
												</td>
												<td><?php echo $val['user_created']; ?></td>
												<td><?php echo gettime($val['created'],'d/m/Y'); ?></td>
                                                <td>
                                                    <div class="switch">
                                                        <div class="onoffswitch">
                                                            <input type="checkbox" <?php echo ($val['highlight'] == 1) ? 'checked=""' : ''; ?> class="onoffswitch-checkbox publish_frontend" data-module="attribute_catalogue" data-title="highlight" data-id="<?php echo $val['id']; ?>" id="publish_highlight<?php echo $val['id']; ?>">
                                                            <label class="onoffswitch-label" for="publish_highlight<?php echo $val['id']; ?>">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="switch">
                                                        <div class="onoffswitch">
                                                            <input type="checkbox" <?php echo ($val['ishome'] == 1) ? 'checked=""' : ''; ?> class="onoffswitch-checkbox publish_frontend" data-module="attribute_catalogue" data-title="ishome" data-id="<?php echo $val['id']; ?>" id="publish_ishome<?php echo $val['id']; ?>">
                                                            <label class="onoffswitch-label" for="publish_ishome<?php echo $val['id']; ?>">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
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
													<a type="button" href="<?php echo site_url('tour/backend/acatalogue/update/'.$val['id'].'') ?>" class="btn btn-primary" ><i class="fa fa-edit"></i></a>
													<a  type="button" class="btn btn-danger ajax-delete" data-title="Lưu ý: Khi bạn xóa danh mục, toàn bộ sản phẩm trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!"  data-id="<?php echo $val['id'] ?>" data-module="attribute_catalogue" data-child="1" ><i class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php }}else{ ?>
											<tr>
												<td colspan="9"><small class="text-danger">Không có dữ liệu phù hợp</small></td>
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
			</div>
		</div>
		<?php $this->load->view('dashboard/backend/common/footer'); ?>
	</div>