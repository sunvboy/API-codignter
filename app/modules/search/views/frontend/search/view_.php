<!-- Main Container  -->
<div class="main-container container">
	<ul class="breadcrumb">
		<li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
		<li><a href="javascript:void(0)">Kết quả tìm kiếm</a></li>

	</ul>

	<div class="row">

		<!--Middle Part Start-->
		<div id="content" class="col-md-12 col-sm-12">
			<div class="products-category">
				<h3 class="title-category ">Kết quả tìm kiếm</h3>

				<!--changed listings-->
				<div class="products-list row nopadding-xs so-filter-gird grid" id="ajax-content">
					<?php if (isset($productList) && is_array($productList) && count($productList)) { ?>
						<?php foreach ($productList as $keyPost => $valPost) { ?>
							<?php
							$title = $valPost['title'];
							$href = rewrite_url($valPost['canonical'], TRUE, TRUE);
							$image = getthumb($valPost['image']);
							$getPrice = getPriceFrontend(array('productDetail' => $valPost));
							$comment = comment(array('module' => 'product', 'id' => $valPost['id']));
							if (isset($comment) && is_array($comment) && count($comment)) {
								$prd_rate = (float)$comment['statisticalRating']['averagePoint'];
							}
							?>

							<div class="product-layout col-lg-15 col-md-4 col-sm-6 col-xs-6">
								<div class="product-item-container">
									<div class="left-block left-b">

										<div class="product-image-container second_img">
											<a href="<?php echo $href; ?>" target="_self" title="Lastrami bacon">
												<img src="<?php echo $image ?>"
													 class="img-1 img-responsive" alt="<?php echo $title ?>">
												<img
													src="<?php echo $image ?>"
													class="img-2 img-responsive" alt="<?php echo $title ?>">
											</a>
										</div>
										<!--quickview-->
										<div class="so-quickview">
											<a class="btn-button quickview quickview_handler visible-lg js_quickview" href="javascript:void(0);" data-id="<?php echo $valPost['id']?>"  ><i class="fa fa-eye"></i><span></span></a>

										</div>
										<!--end quickview-->
									</div>
									<div class="right-block">
										<div class="button-group so-quickview cartinfo--left">
											<button type="button" class="addToCart" title="Add to cart" onclick="cartadd(<?php echo $valPost['id']?>);"><span>Thêm giỏ hàng </span></button>

											<button type="button" class="wishlist btn-button" title="Add to Wish List">
												<i class="fa fa-heart-o"></i><span>Add to Wish List</span>
											</button>

										</div>
										<div class="caption hide-cont">
											<div class="ratings">
												<div class="rating-box">
													<?php for ($i = 1; $i <= $prd_rate; $i++) { ?>
														<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
													<?php } ?>

												</div>
												<?php if ($comment['statisticalRating']['totalComment'] > 0) { ?>
													<span
														class="rating-num">( <?php echo $comment['statisticalRating']['totalComment'] ?>
														)</span>
												<?php } ?>
											</div>
											<h4><a href="<?php echo $href; ?>" title="Pastrami bacon"
												   target="_self"><?php echo $title ?></a></h4>

										</div>
										<p class="price">
											<span class="price-new"><?php echo $getPrice['price_final'] ?></span>
											<span class="price-old"><?php echo $getPrice['price_old'] ?></span>

										</p>

										<div class="description item-desc">
											<p><?php echo $description ?></p>
										</div>

									</div>

								</div>
							</div>
						<?php } ?>





					<?php } ?>
				</div>
				<div id="pagination">
					<?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

				</div>
				<!--// End Changed listings-->


			</div>

		</div>





	</div>
	<!--Middle Part End-->
</div>