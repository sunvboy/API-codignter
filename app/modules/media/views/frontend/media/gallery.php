<div id="artdetail" class="page-body">
	<?php 
		$banner = slide(array('keyword' => 'banner-parent'));
		$banner = $banner[0];
	 ?>

	<section class="banner">
	<?php if(isset($banner) && is_array($banner) && count($banner)){ ?>
		<div class="image img-cover"><img src="<?php echo $banner['src']; ?>" alt="<?php echo $banner['src']; ?>"></div>
		<div class="uk-container uk-container-center">
			<div class="breadcrumb">
				<div class="title"><?php echo $breadcrumb[0]['title']; ?></div>
				<ul class="uk-breadcrumb">
					<li><a href="" title=""><?php //echo '<i class="fa fa-home"></i>'; ?> Trang chủ</a></li>
					<?php foreach($breadcrumb as $key => $val){ ?>
					<?php
						$title = $val['title'];
						$href = rewrite_url($val['canonical'], true, true);
					?>
					<li class="<?php if($key == count($breadcrumb) - 1) echo 'uk-active'; ?>"><a href="<?php echo $href; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div><!-- .breadcrumb -->
	<?php } ?>
	</section>
	
	
	
	<div class="mediadetail">
		<div class="uk-container uk-container-center">
			<div class="artdetail-content">
				<h1 class="entry-title"><?php echo $detailMedia['title']; ?></h1>
				
				<div class="mediacatalogue-list about-section gallery-section">
					<section class="panel-body">
						<?php $album = json_decode($detailMedia['image_json'], TRUE); ?>
						<?php if(isset($album) && is_array($album)  && count($album)){ ?>
							<div class="uk-grid lib-grid-20 uk-grid-width-1-2 uk-grid-width-medium-1-3  list-photo">
							<?php foreach($album as $key => $val){ ?>
								<div class="item">
									<div class="photo">
										<div class="thumb"><a data-uk-lightbox="{group:'my-group'}" class="image img-cover" href="<?php echo $val; ?>" title="<?php echo $val; ?>" ><img src="<?php echo $val; ?>" alt="<?php echo $val; ?>" /></a></div>
										<div class="title"><a href="<?php echo $val; ?>" title="<?php echo $val; ?>"><?php echo $detailMedia['title']; ?></a></div>
									</div>
								</div>
								<?php } ?>
							</div><!-- .uk-grid -->
						<?php } ?>
					</section><!-- .panel-body -->
				</div>
			</div>
			
			<?php $this->load->view('homepage/frontend/core/artrelate', array('style' => 1)); ?>
			
			<?php $this->load->view('homepage/frontend/core/comment', array('module' => $module,'moduleid' => $detailMedia['id'])); ?>
			
		</div>
	</div>
	
	
</div><!-- #prdcatalogue -->