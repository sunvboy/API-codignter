<div id="js_prd_info" data-info="<?php echo $data_info ?>"
     data-price="<?php echo $productDetail['price'] ?>"
     data-price_sale="<?php echo $productDetail['price_sale'] ?>"
     data-price_contact="<?php echo $productDetail['price_contact'] ?>"
     data-id="<?php echo $productDetail['id'] ?>"
     data-name="<?php echo $productDetail['title'] ?>"
     data-redirect="false">

</div>
<div id="quantity" data-quantity="1"></div>
<?php
$prd_title = $productDetail['title'];
$prd_code = $productDetail['code'];
$prd_info = getPriceFrontend(array('productDetail' => $productDetail));

$prd_href = rewrite_url($productDetail['canonical']);
$comment = comment(array('id' => $productDetail['id'], 'module' => 'product'));
$prd_rate = '';
if (isset($comment) && is_array($comment) && count($comment)) {
    $prd_rate = round($comment['statisticalRating']['averagePoint']);
}

$list_image = json_decode(base64_decode($productDetail['image_json']), TRUE);
?>

<!-- Main Container  -->
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>

        <?php foreach ($breadcrumb as $key => $val) { ?>
            <?php
            $title = $val['title'];
            $href = rewrite_url($val['canonical'], true, true);
            ?>
            <li class="<?php if ($key == count($breadcrumb) - 1) echo 'uk-active'; ?>"><a href="<?php echo $href; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
            </li>
        <?php } ?>

    </ul>

    <div class="row">


        <!--Middle Part Start-->
        <div id="content" class="col-md-12 col-sm-12">
            <div class="product-view row">
                <div class="left-content-product">

                    <div class="content-product-left class-honizol col-md-5 col-sm-12 col-xs-12">
                        <div class="large-image  ">
                            <img itemprop="image" class="product-image-zoom"
                                 src="<?php echo $productDetail['image']; ?>"
                                 title="<?php echo $productDetail['title']; ?>"
                                 alt="<?php echo $productDetail['title']; ?>">
                        </div>

                        <div id="thumb-slider" class="yt-content-slider full_slider owl-drag" data-rtl="yes"
                             data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="10"
                             data-items_column00="4" data-items_column0="4" data-items_column1="3"
                             data-items_column2="4" data-items_column3="1" data-items_column4="1" data-arrows="yes"
                             data-pagination="no" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                            <a data-index="0" class="img thumbnail " data-image="<?php echo $productDetail['image']; ?>"
                               title="<?php echo $productDetail['title']; ?>">
                                <img src="<?php echo $productDetail['image']; ?>"
                                     title="<?php echo $productDetail['title']; ?>"
                                     alt="<?php echo $productDetail['title']; ?>">
                            </a>
                            <?php if (isset($list_image) && is_array($list_image) && count($list_image)) { ?>
                                <?php foreach ($list_image as $key => $val) { ?>
                                    <a data-index="<?php echo $key + 1 ?>" class="img thumbnail "
                                       data-image="<?php echo $val; ?>" title="<?php echo $productDetail['title']; ?>">
                                        <img src="<?php echo $val; ?>" title="<?php echo $productDetail['title']; ?>"
                                             alt="<?php echo $productDetail['title']; ?>">
                                    </a>
                                <?php }
                            } ?>
                        </div>
                    </div>
                    <div class="content-product-right col-md-7 col-sm-12 col-xs-12">
                        <div class="title-product">
                            <h1><?php echo $productDetail['title']; ?></h1>
                        </div>
                        <!-- Review ---->
                        <div class="box-review form-group">
                            <div class="ratings">
                                <div class="rating-box">

                                    <span style="font-size: 20px" class="rating order-1 rt-cmt" data-stars="5" data-default-rating="<?php echo $prd_rate;?>" disabled ></span>
                                    <style>
                                        .rating-box .rating .star::before {

                                            width: auto;
                                            height: auto;
                                        }
                                    </style>

                                </div>
                            </div>
                            <a class="reviews_button" href="#"
                               onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><?php echo $comment['statisticalRating']['totalComment'] ?> đánh giá</a> |
                            <a class="write_review_button" href="#"
                               onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Viết đánh giá</a>
                        </div>
                        <div class="product-label form-group">
                            <?php if ($prd_info['flag'] == 0) { ?>
                                <div class="product_page_price price" itemprop="offerDetails" itemscope=""
                                     itemtype="http://data-vocabulary.org/Offer">
                                    <span class="price-new"
                                          itemprop="price">Giá: <?php echo $prd_info['price_final'] ?></span>
                                    <span class="price-old"><?php echo $prd_info['price_old']; ?></span>
                                </div>
                            <?php } else { ?>
                                <?php if ($prd_info['price_old'] == 0 && $prd_info['price_final'] == 0) { ?>
                                    <div class="product_page_price price" itemprop="offerDetails" itemscope=""
                                         itemtype="http://data-vocabulary.org/Offer">
                                        <span class="price-new" itemprop="price">Giá: Liên hệ</span>
                                    </div>
                                <?php } else { ?>
                                    <div class="product_page_price price" itemprop="offerDetails" itemscope=""
                                         itemtype="http://data-vocabulary.org/Offer">
                                        <span class="price-new"
                                              itemprop="price">Giá: <?php echo $prd_info['price_final'] ?></span>
                                    </div>
                                <?php } ?>
                            <?php } ?>

                        </div>
                        <div class="description">
                            <?php echo $productDetail['description']; ?>
                        </div>
                        <div id="product">
                            <div class="form-group box-info-product">
                                <div class="option quantity">
                                    <div class="input-group quantity-control" unselectable="on"
                                         style="-webkit-user-select: none;">
                                        <label>Số lượng</label>
                                        <input class="form-control js_quantity" type="text" name="quantity" value="1">
                                        <span class="input-group-addon product_quantity_down js_quantity_minus">−</span>
                                        <span class="input-group-addon product_quantity_up js_quantity_plus">+</span>
                                    </div>
                                </div>
                                <div class="cart">
                                    <input type="button" data-toggle="tooltip" title="" value="Add to Cart"
                                           id="button-cart" class="btn btn-mega btn-lg js_buy">
                                </div>


                            </div>

                        </div>
                        <!-- end box info product -->

                    </div>

                </div>
            </div>
            <!-- Product Tabs -->
            <div class="producttab ">
                <div class="tabsslider  vertical-tabs col-xs-12">
                    <ul class="nav nav-tabs col-lg-2 col-sm-3">
                        <?php if (isset($extend_description['title']) && is_array($extend_description['title']) && count($extend_description['title'])) { ?>
                            <?php foreach ($extend_description['title'] as $keyT => $valT) { ?>

                                <li class="<?php echo ($keyT == count($extend_description['title']) - 1) ? '' : ''; ?>">
                                    <a data-toggle="tab" href="#tab-<?php echo $keyT + 1 ?>"><?php echo $valT; ?></a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                        <li class="item_nonactive active"><a data-toggle="tab" href="#tab-review">Đánh giá (<?php echo $comment['statisticalRating']['totalComment'] ?>)</a></li>
                    </ul>
                    <div class="tab-content col-lg-10 col-sm-9 col-xs-12">
                        <?php if (isset($extend_description['description']) && is_array($extend_description['description']) && count($extend_description['description'])) { ?>
                            <?php foreach ($extend_description['description'] as $keyD => $valD) { ?>
                                <div id="tab-<?php echo $keyD+1?>" class="tab-pane fade <?php echo ($keyD == count($extend_description['description']) - 1) ? '' : ''; ?>">

                                    <?php echo $valD; ?>

                                </div>
                            <?php } ?>
                        <?php } ?>
                        <div id="tab-review" class="tab-pane fade active in">
                            <?php $this->load->view('homepage/frontend/core/comment_form', array('module' => $module,'moduleid' => $productDetail['id'])); ?>

                        </div>

                    </div>
                </div>
            </div>
            <!-- //Product Tabs -->

            <?php if (isset($relaList) && is_array($relaList) && count($relaList)) { ?>

                <!-- Related Products -->
                <div class="related titleLine products-list grid module ">
                    <h3 class="modtitle">Sản phẩm khác</h3>

                    <div class="releate-products yt-content-slider products-list" data-rtl="no" data-loop="yes"
                         data-autoplay="no" data-autoheight="no" data-autowidth="no" data-delay="4" data-speed="0.6"
                         data-margin="30" data-items_column00="5" data-items_column0="5" data-items_column1="3"
                         data-items_column2="3" data-items_column3="2" data-items_column4="1" data-arrows="yes"
                         data-pagination="no" data-lazyload="yes" data-hoverpause="yes">

                        <?php foreach ($relaList as $keyPost => $valPost) { ?>
                            <?php
                            $title = $valPost['title'];
                            $href = rewrite_url($valPost['canonical'], TRUE, TRUE);
                            $image = getthumb($valPost['image']);
                            $getPrice = getPriceFrontend(array('productDetail' => $valPost));
                            $code = $valPost['code'];
                            $comment = comment(array('module' => 'product', 'id' => $valPost['id']));
                            if (isset($comment) && is_array($comment) && count($comment)) {
                                $prd_rate = (float)$comment['statisticalRating']['averagePoint'];
                            }
                            ?>
                            <div class="item">
                                <div class="item-inner product-layout transition product-grid">
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


                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            <?php }?>

            <!-- end Related  Products-->
        </div>


    </div>


</div>
<!--Middle Part End-->
</div>
<!-- //Main Container -->
<div id="js_prd_info" data-info="<?php echo $data_info ?>"
	data-price="<?php echo $productDetail['price'] ?>"
	data-price_sale="<?php echo $productDetail['price_sale'] ?>"
	data-price_contact="<?php echo $productDetail['price_contact'] ?>"
	data-id="<?php echo $productDetail['id'] ?>"
	 data-name= "<?php echo $productDetail['title'] ?>"
	 data-redirect = "true">

</div>
<div id="quantity" data-quantity="1"></div>
<?php
	$prd_title = $productDetail['title'];
	$prd_code = $productDetail['code'];
	$prd_info = $productDetail['info'];
	$list_image = json_decode(base64_decode($productDetail['image_json']), true);
	$prd_href = rewrite_url($productDetail['canonical']);
    $prd_description = $productDetail['description'];
    // $prd_extend_des = json_decode($productDetail['extend_description'], true);

    $prd_description_litter = $productDetail['description'];
    $commnet = comment(array('id' => $productDetail['id'], 'module' => 'product'));
    $prd_rate = '';
	if(isset($commnet) && is_array($commnet) && count($commnet)){
		$prd_rate = round($commnet['statisticalRating']['averagePoint']);
	}

	// print_r($prd_description);die;
?>
<div id="prdcatalog" class="page-body">
	<?php
	/*
		$banner = slide(array('keyword' => 'banner-parent'));
		$banner = $banner[0];
	*/
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
	<?php
		$list_image = json_decode(base64_decode($productDetail['image_json']), TRUE);
		// print_r($gallery);die;
	?>
	<div class="uk-container uk-container-center">
		<section class="prd-detail"><!-- CHI TIẾT SẢN PHẨM -->
			<header class="panel-head">
				<div class="uk-grid uk-grid-medium">
					<div class="uk-width-medium-1-2">
						<div class="prd-gallerys">
							<div id="slider" class="flexslider">
								<ul class="slides">
									<?php if(isset($list_image) && is_array($list_image) && count($list_image)){ ?>
									<?php foreach($list_image as $key => $val) { ?>
									<li>
										<div class="thumb">
											<a class="image img-scaledown" href="<?php echo $val; ?>" title="Ảnh chi tiết dự án" data-uk-lightbox="{group:'prdGallerys'}"><img src="<?php echo $val; ?>" alt="<?php echo $val; ?>" /></a>
										</div>
									</li>
									<?php }} ?>
								</ul>
							</div>
							<div id="carousel" class="flexslider">
								<ul class="slides">
									<?php if(isset($list_image) && is_array($list_image) && count($list_image)){ ?>
									<?php foreach($list_image as $key => $val) { ?>
									<li>
										<div class="thumb">
											<span class="image img-scaledown"><img src="<?php echo $val;?>" alt="<?php echo $val;?>" /></span>
										</div>
									</li>
									<?php }} ?>
								</ul>
							</div>
							<!-- Không có slide ảnh
							<div class="cover"><a class="image img-cover" href="" title=""></a></div>
							-->
						</div> <!-- end of product-gallery -->
					</div>
					<div class="uk-width-medium-1-2">
						<div class="prd-infor">
							<h1 class="prd-title"><?php echo $productDetail['title']; ?></h1>
							<ul class="uk-list uk-clearfix prd-icon">
								<li>
									<i class="fa fa-gg"></i>
									<a href="<?php echo rewrite_url($detailCatalogue['canonical'], true, true); ?>"><b>Danh mục : </b><?php echo $detailCatalogue['title']; ?></a>
								</li>
								<li>
									<i class="fa fa-tags"></i>
									<span><b>Mã sản phẩm : </b><?php echo $productDetail['code']; ?></span>
								</li>
								<li>
									<i class="fa fa fa-codepen"></i>
									<span><b>Tình trạng : </b>Còn hàng</span>
								</li>
							</ul>
							<div class="detail-info">
								<div class="prd-excerpt">
									<?php echo $prd_description; ?>
								</div>

								<div class="left">
									<?php
										// print_r($prd_info);die;
									?>
									<?php if($prd_info['flag'] == 0){ ?>
										<p class="uk-flex uk-flex-middle mb20">
											<span class="main-price mr20">Giá KM: <?php echo $prd_info['price_final'] ?></span>
											<span class="value"><s>Giá gốc: <?php echo $prd_info['price_old']; ?></s></span>
										</p>
									<?php }else{ ?>
										<?php if($prd_info['price_old'] == 0 && $prd_info['price_final'] == 0){ ?>
											<p>
												<span class="price-contact">Giá: Liên hệ</span>
											</p>
										<?php }else{ ?>
											<p>
												<span class="main-price">Giá: <?php echo $prd_info['price_final'] ?></span>
											</p>
										<?php }?>
									<?php } ?>

									<ul class="uk-list btn-groups uk-clearfix uk-flex uk-flex-middle">
										<?php if($prd_info['flag'] == 1 && $prd_info['price_old'] == 0 && $prd_info['price_final'] == 0){ ?>
										<li><a class="btn btn-buy isDisabled" href="" title="Đặt mua" onclick="return false;">Đặt mua</a></li>
										<?php }else{ ?>
										<li><a class="btn btn-buy js_buy" href="" title="Đặt mua">Đặt mua</a></li>
										<?php } ?>
										<li><a class="btn btn-contact" href="#order-form" data-uk-modal title="Liên hệ">Liên hệ</a></li>
									</ul>
								</div>
							</div>
						</div><!-- .prd-infor -->
					</div>
				</div><!-- .uk-grid -->
			</header><!-- .panel-head -->

			<section class="panel-body">
				<div class="prd-content uk-visible-large">
					<?php
						// print_r($extend_description);die;
					 ?>
					<?php if(isset($extend_description['title']) && is_array($extend_description['title']) && count($extend_description['title'])){ ?>
					<ul class="uk-list uk-clearfix nav-tabs" data-uk-switcher="{connect:'#tabContent'}">
							<?php foreach ($extend_description['title'] as $keyT => $valT) {?>
								<li class="<?php echo ($keyT == count($extend_description['title']) - 1)? 'uk-active' : '';?>"><?php echo $valT; ?></li>
							<?php } ?>
					</ul>
					<?php } ?>
					<?php if(isset($extend_description['description']) && is_array($extend_description['description']) && count($extend_description['description'])){ ?>
					<ul id="tabContent" class="uk-switcher tab-content">
							<?php foreach ($extend_description['description'] as $keyD => $valD) {?>
								<li>
									<article class="article detail-content">
										<?php echo $valD; ?>
									</article><!-- .article -->
								</li>
							<?php } ?>
				   </ul>
					<?php } ?>
				</div><!-- .prd-content -->
				<div class="prd-content-mobile uk-hidden-large">
					<?php if(isset($prdExtendDesc) && is_array($prdExtendDesc) && count($prdExtendDesc)){ ?>
					<ul class="uk-list uk-accordion" data-uk-accordion="{showfirst: true}">
						<?php foreach($prdExtendDesc as $keyEx => $valEx){?>
							<li>
								<a class="uk-accordion-title accordion-label"><?php echo $valEx['title']; ?></a>
								<div class="uk-accordion-content accordion-content">
									<article class="article detail-content">
										<?php echo $valEx['desc']; ?>
									</article><!-- .article -->
								</div>
							</li>
						<?php } ?>
					</ul>
					<?php } ?>
				</div><!-- .mobile-prd-content -->
			</section><!-- .panel-body-->
		</section><!-- .prd-detail -->

	</div>


		<section class="document-panel">
			<div class="uk-container uk-container-center">
				<div class="uk-grid uk-grid-medium uk-grid-width-large-1-2 uk-flex uk-flex-middle">
					<div class="uk-flex uk-flex-left">
						<div class="dct-left">
							<p class="title">TÀI LIỆU VỀ <?php echo $productDetail['title']; ?></p>
							<div class="subtitle">Tải file thông tin chi tiết về <?php echo $productDetail['title']; ?></div>
						</div>
					</div>
					<div class="uk-flex uk-flex-right">
						<div class="dct-right">
							<div class="uk-flex uk-flex-middle">
								<div class="hd-download order-1"><a href="<?php echo $productDetail['file_price'];?>" title="Tải file báo giá" class="btn-download" download>Tải file báo giá</a></div>

								<div class="hd-download order-2"><a href="lien-he.html" title="" class="btn-download">Liên hệ ngay</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php if(isset($relaList) && is_array($relaList)  && count($relaList)){ ?>
		<section class="catalog-panel homepage-product rela-panel mb-common">
			<div class="uk-container uk-container-center">
				<header class="panel-head">
					<h2 class="heading-1"><span>Sản phẩm liên quan</span></h2>
				</header>
				<section class="panel-body">
					<ul class="uk-list uk-clearfix uk-grid uk-grid-small uk-grid-width-1-2 uk-grid-width-medium-1-4 uk-grid-width-large-1-4 list-product">
						<?php foreach ($relaList as $keyPost => $valPost) { ?>
							<?php
								$title = $valPost['title'];
								$href = rewrite_url($valPost['canonical'], TRUE, TRUE);
								$image = getthumb($valPost['image']);
								$description = cutnchar(strip_tags($valPost['description']), 250);
								// $getPrice = getPriceFrontend(array('productDetail' => $valPost));
								$code = $valPost['code'];

							?>

						<li>
							<div class="product">
								<div class="thumb"><a class="image img-scaledown" href="<?php echo $href; ?>" title="<?php echo $title; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" /></a></div>
								<div class="info">
									<h2 class="title"><a href="<?php echo $href; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h2>
									<div class="subtitle">Mã SP: <?php echo $code; ?></div>

									<div class="reamore"><a href="" title="" class="btn-readmore">Liên hệ</a></div>
								</div>
							</div>
						</li>
						<?php } ?>
				</section>
			</div>
		</section>
		<?php } ?>
		<!-- homepage-product -->
		<div class="uk-container uk-container-center">
			<?php $this->load->view('homepage/frontend/core/comment', array('module' => $module,'moduleid' => $productDetail['id'])); ?>
		</div>

</div><!-- .page-body -->

<!-- This is the modal -->
<div id="order-form" class="uk-modal">
	<form action="" method="" class="form uk-form" id="form-baogia">
		<div class="uk-modal-dialog" style="padding: 0;">
			<a class="uk-modal-close uk-close"></a>
			<div class="uk-modal-header">
				<h2 class="md-heading"><span>Liên hệ báo giá</span></h2>
				<div class="md-desc">( Hãy để lại thông tin cho chúng tôi. Chúng tôi sẽ liên lạc ngay với bạn )</div>
			</div>
			<div class="modal-content loading">
				<div class="uk-flex uk-flex-middle uk-flex-space-between mb20">
					<label class="md-label">Sản phẩm</label>
					<div class="form-row title"><?php echo $productDetail['title']; ?></div>
					<input type="hidden" name="order_prd_name" value="<?php echo $productDetail['title']; ?>" class="form-control order_prd_name" placeholder="" autocomplete="off">
				</div>
				<div class="bg-loader"></div>
				<div class="error hidden">
					<div class="alert alert-danger"></div>
				</div><!-- /.error -->

				<div class="uk-flex uk-flex-middle uk-flex-space-between mb10">
					<label class="md-label">Họ tên</label>
					<div class="form-row">
						<?php echo form_input('order_fullname', htmlspecialchars_decode(html_entity_decode(set_value('order_fullname'))), 'placeholder="Nhập họ tên" class="input-text order order-fullname" autocomplete="off"');?>
					</div>
				</div>
				<div class="uk-flex uk-flex-middle uk-flex-space-between mb10">
					<label class="md-label">Số điện thoại</label>
					<div class="form-row">
						<?php echo form_input('order_phone', htmlspecialchars_decode(html_entity_decode(set_value('order_phone'))), 'placeholder="Nhập số điện thoại" class="input-text order order-phone" autocomplete="off"');?>
					</div>
				</div>
				<div class="uk-flex uk-flex-middle uk-flex-space-between mb10">
					<label class="md-label">Email</label>
					<div class="form-row">
						<?php echo form_input('order_mail', htmlspecialchars_decode(html_entity_decode(set_value('order_mail'))), 'placeholder="Nhập địa chỉ email" class="input-text order order-email" autocomplete="off"');?>
					</div>
				</div>
				<div class="uk-flex uk-flex-middle uk-flex-space-between mb10">
					<label class="md-label">Nhu cầu cụ thể</label>
					<div class="form-row">
						<?php echo form_input('order_message', htmlspecialchars_decode(html_entity_decode(set_value('order_message'))), 'placeholder="Ví dụ: Gửi báo giá, catalog ..." class="input-text order order-message" autocomplete="off"');?>
					</div>
				</div>
				<div class="uk-text-center">
					<button type="submit" value="submit" class="btn order order-1">Gửi thông tin</button>
				</div>

			</div>
		</div>
	</form>
</div>

<script>
	$(window).load(function() {
		var wd_width = $(window).width();
		if(wd_width > 768){
			// $(".zoom_image").elevateZoom({
			// 	'responsive':true,
			// 	'zoomWindowWidth': 300,
			// 	'zoomWindowHeight': 300,
			// 	'borderSize': 2,
			// 	'borderColour': '#ccc',
			// 	'lensColour': 'transparent',
			// 	'lensSize': 10,
			// 	'scrollZoom': true,

			// });
			// $(".zoom_image").ezPlus();
		}

	});
</script>
<script type="text/javascript">
	$(window).load(function() {
	  $('#carousel').flexslider({
		animation: "slide",
		controlNav: false,
		directionNav: false,
		animationLoop: false,
		slideshow: false,
		itemWidth: 100,
		itemMargin: 5,
		prevText: '',
		nextText: '',
		asNavFor: '#slider'
	  });
	  $('#slider').flexslider({
		animation: "slide",
		directionNav: true,
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		prevText: '',
		nextText: '',
		sync: "#carousel"
	  });
	});
</script>
