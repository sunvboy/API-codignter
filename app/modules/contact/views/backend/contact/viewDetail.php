<div id="page-wrapper" class="gray-bg dashboard-1 fix-wrapper">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/navbar');?>
	</div>

	<!-- --------------------------- -->
	<form method="post" action="" class="form-horizontal box">
		<div class="wrapper wrapper-content animated fadeInRight">


			<?php 
				  // echo '<pre>';
				// print_r($contact);die();

			if(isset($contact) && is_array($contact) && count($contact)){ ?>

					<div class="row">
						<div class="col-md-6 col-xs-12 col-sm-6">
							<div class=" animated fadeInRight">
								<div class="mail-box-header">

									<h2>Thông tin chi tiết liên hệ của khách hàng</h2>
									<div class="mail-tools tooltip-demo">
										<h3 class="contact-viewdetail-subject">
											<span class="font-normal">Tiêu đề: </span><?php echo $contact['subject']; ?>
										</h3>
										<h5 class="contact-box-info">
											<p><span class="font-normal">Khách hàng: </span><?php echo $contact['fullname']; ?></p>
											<p><span class="font-normal">Email: </span><?php echo $contact['email']; ?></p>
											<p><span class="font-normal">Phone: </span><?php echo $contact['phone']; ?></p>
											<p><span class="font-normal">Ngày gửi: </span><?php echo gettime($contact['created'],'h:i:s - d/m/Y '); ?></p>
										</h5>
									</div>
								</div>
								<div class="mail-box">
									<div class="mail-body">
										<h3 class="contact-viewdetail-content">
											<span class="font-normal">Nội dung thư: </span>
										</h3>
										<div>
											<?php echo $contact['message']; ?>
										</div>
									</div>
								</div>
								<div class="mail-attachment hidden">
									<p>
										<span><i class="fa fa-paperclip"></i> File đính kèm - </span>
										<span>(Click vào file để tải xuống)</span>
									</p>

									<div class="attachment clearfix ">
										<?php if(isset($contact['file']) && is_array($contact['file']) && count($contact['file'])){ ?>
											<ul class="mgb0 uk-list ">
												<?php foreach($contact['file'] as $keyFile => $contactFile){ ?>
													<?php $typeFile = pathinfo($contactFile, PATHINFO_EXTENSION ); ?>
													<li class="col-lg-3">
														<div class="file-box">
															<div class="file">
																<a href="<?php echo $contactFile; ?>" download title="<?php echo basename($contactFile) ; ?>">
																	<span class="corner"></span>

																	<div class="icon">
																		<?php echo type_file_html($typeFile) ;?>

																	</div>
																	<div class="file-name text-center">
																		<?php echo basename($contactFile) ; ?>
																	</div>
																</a>
															</div>
														</div>
													</li>
												<?php } ?>
											</ul>
										<?php }else {
											echo '<p class="text-danger"> Không có file đính kèm </p>';
										} ?>
									</div>

								</div>
							</div>

						</div>
						<div class="col-md-6 col-xs-12 col-sm-6">
							<div class=" animated fadeInRight">

								<div class="mail-box">
									<div class="mail-body">
										<div class="row">
											<div class="box-body">
												<?php $error = validation_errors(); echo !empty($error)?'<div class="alert alert-danger">'.$error.'</div>':'';?>
											</div><!-- /.box-body -->
										</div>
										<h3 class="contact-viewdetail-content">
											<span class="font-normal">Email:</span>
										</h3>
										<div>
											<input type="hidden" name="id" value="<?php echo $contact['id']?>">
											<?php echo form_input('email', html_entity_decode(set_value('email',!empty($this->input->post('email'))?$this->input->post('email'):$contact['email'])), 'class="form-control " placeholder="" autocomplete="off"');?>
										</div>
										<h3 class="contact-viewdetail-content">
											<span class="font-normal">Subject: </span>
										</h3>
										<div>
											<?php echo form_input('subject', html_entity_decode(set_value('subject','Trả lời liên hệ')), 'class="form-control " placeholder="" autocomplete="off"');?>
										</div>
										<h3 class="contact-viewdetail-content">
											<span class="font-normal">Trả lời: </span>
										</h3>
										<div>
											<?php echo form_textarea('reply', htmlspecialchars_decode(html_entity_decode(set_value('reply'))), 'class="form-control ck-editor" id="ckDescription" placeholder="" autocomplete="off"');?>
										</div>
									</div>

									<div class="mail-body text-right tooltip-demo">
										<button class="btn btn-sm btn-primary" type="submit" name="update" value="update"><i class="fa fa-reply"></i> Trả lời</button>
									</div>
									<div class="clearfix"></div>
								</div>

							</div>

						</div>
					</div>

				<?php }?>

			</div>
		</form>
		<?php $this->load->view('dashboard/backend/common/footer'); ?>
	</div>