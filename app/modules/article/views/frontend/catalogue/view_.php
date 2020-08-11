


<!-- Main Container  -->
<div class="main-container container">
	<ul class="breadcrumb">
		<li><a href="<?php echo base_url()?>"><i class="fa fa-home"></i></a></li>

		<?php foreach ($breadcrumb as $key => $val) { ?>
			<?php
			$title = $val['title'];
			$href = rewrite_url($val['canonical'], true, true);
			?>
			<li class="<?php if ($key == count($breadcrumb) - 1) echo 'uk-active'; ?>"><a href="<?php echo $href; ?>"
																						  title="<?php echo $title; ?>"><?php echo $title; ?></a>
			</li>
		<?php } ?>

	</ul>

	<div class="row">
		<!--Left Part Start -->
		<?php echo $this->load->view('homepage/frontend/common/aside');?>

		<!--Left Part End -->

		<!--Middle Part Start-->
		<div id="content" class="col-md-9 col-sm-8">
			<div class="blog-header">
				<h3><?php echo $detailCatalogue['title']?></h3>

			</div>
			<div class="blog-category clearfix">


				<div class="blog-listitem row">
					<?php if(isset($articleList) && is_array($articleList) && count($articleList)){ ?>
						<?php foreach($articleList as $key => $val){ ?>
							<?php
							$title = $val['title'];
							$image = $val['image'];
							$href = rewrite_url($val['canonical'], TRUE, TRUE);
							$description = cutnchar(strip_tags($val['description']),100);
							?>
					<div class="blog-item col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="blog-item-inner clearfix">
							<div class="itemBlogImg clearfix">
								<div class="article-image">
									<div>
										<a href="<?php echo $href; ?>">
											<img src="<?php echo $image; ?>" alt="Lorem ipsum dolor sit amet" />
										</a>
									</div>
									<div class="article-date">
										<div class="date">
											<span class="article-date">
												<b><?php echo show_time($val['created'], 'd')?></b> <?php echo show_time($val['created'], 'M')?>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="itemBlogContent clearfix ">
								<div class="blog-content">
									<div class="article-title font-title">
										<h4><a href="<?php echo $href; ?>"><?php echo $title; ?></a></h4>
									</div>
									<div class="blog-meta">
										<span class="author"><i class="fa fa-clock-o"></i> <?php echo $val['created']?></span>
										<span class="comment_count"><i class="fa fa-eye"></i><?php echo $val['viewed']?> lượt xem</span>
									</div>
									<p class="article-description"><?php echo $description; ?></p>
									<div class="readmore">  <a class="btn-readmore font-title" href="<?php echo $href; ?>"><i class="fa fa-caret-right"></i>Xem chi tiết</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?><?php } ?>
				</div>
				<div class="product-filter product-filter-bottom filters-panel clearfix">
					<div class="row">
						<div class="col-md-12">
							<?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Middle Part End-->
</div>
