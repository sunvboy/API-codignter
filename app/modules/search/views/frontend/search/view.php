<div class="ttm-page-title-row">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="page-title-heading">
                        <h1 class="title">Kết quả tìm kiếm</h1>
                    </div>
                    <div class="breadcrumb-wrapper">
                        <span class="mr-1"><i class="ti ti-home"></i></span>
                        <a title="Homepage" href="<?php echo base_url() ?>">Trang chủ</a>

                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">Kết quả tìm kiếm</span>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-main">

    <!--shop-views-section-->
    <section class="shop-views-section clearfix">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="ttm-shop-toolbar-wrapper">
                        <div class="row">
                            <div class="col-md-6 toolbar-left">
                                <div class="nav-tab-wrapper">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#grid" role="tab" aria-selected="true"><i class="ti ti-layout-grid2-alt"></i></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#list" role="tab" aria-selected="false"><i class="ti ti-menu-alt"></i></a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php if (isset($productList) && is_array($productList) && count($productList)) { ?>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="grid" role="tabpanel">
                                <div class="row">
                                    <?php $j = 0;
                                    foreach ($productList as $key => $val) {
                                        $j++;

                                        $title = $val['title'];
                                        $href = rewrite_url($val['canonical'], TRUE, TRUE);
                                        $getPrice = getPriceFrontend(array('productDetail' => $val));
                                        $averagePoint = 0;
                                        $comment = comment(array('id' => $val['id'], 'module' => 'product'));
                                        if (isset($comment) && is_array($comment) && count($comment)) {
                                            $averagePoint = round($comment['statisticalRating']['averagePoint']);
                                        }
                                        ?>
                                        <!-- product -->
                                        <div class="product col-md-3 col-sm-6 col-xs-12">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <a href="<?php echo $href ?>">
                                                            <img class="img-fluid pro-image-front" src="<?php echo $val['image']?>" alt="<?php echo $title ?>">
                                                            <img class="img-fluid pro-image-back" src="<?php echo $val['image']?>" alt="<?php echo $title ?>">
                                                        </a>
                                                    </div>
                                                    <?php /*?>
                                            <div class="product-btn-links-wrapper">
                                                <div class="product-btn"><a href="#" class="add-to-cart-btn tooltip-top" data-tooltip="Add To Cart"><i class="ti ti-shopping-cart"></i></a>
                                                </div>
                                                <div class="product-btn"><a href="#" class="quick-view-btn js-show-modal1 tooltip-top" data-tooltip="Quick View"><i class="ti ti-search"></i></a>
                                                </div>
                                                <div class="product-btn"><a href="#" class="wishlist-btn tooltip-top" data-tooltip="Add To Wishlist"><i class="ti ti-heart"></i></a>
                                                </div>
                                            </div>
                                            <?php */?>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="<?php echo $href ?>">
                                                        <h2><?php echo $title ?></h2>
                                                    </a>
                                                    <?php if ($averagePoint > 0) { ?>
                                                        <div class="star-ratings">
                                                            <ul class="rating">

                                                                <?php for ($i = 1; $i <= $averagePoint; $i++) { ?>
                                                                    <li><i class="fa fa-star"></i></li>

                                                                <?php } ?>
                                                                <?php for ($i = 1; $i <= (5 - $averagePoint); $i++) { ?>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                    <?php }?>
                                                    <span class="price">
                                                            <ins><span class="product-Price-amount">
                                                                    <?php echo $getPrice['price_final'] ?>
                                                                </span>
                                                            </ins>
                                                            <del><span class="product-Price-amount">
                                                                    <?php echo $getPrice['price_old'] ?>
                                                                </span>
                                                            </del>
                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product end -->
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="list" role="tabpanel">
                                <div class="product-list product res-991-pt-0">
                                    <?php $j = 0;
                                    foreach ($productList as $key => $val) {
                                        $j++;

                                        $title = $val['title'];
                                        $href = rewrite_url($val['canonical'], TRUE, TRUE);
                                        $getPrice = getPriceFrontend(array('productDetail' => $val));
                                        $averagePoint = 0;
                                        $description = cutnchar(strip_tags($val['description']),300);
                                        $comment = comment(array('id' => $val['id'], 'module' => 'product'));
                                        if (isset($comment) && is_array($comment) && count($comment)) {
                                            $averagePoint = round($comment['statisticalRating']['averagePoint']);
                                        }
                                        ?>
                                        <div class="product-box">
                                            <div class="row">
                                                <div class="col-lg-3 col-sm-4">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <a href="<?php echo $href ?>">
                                                                <img class="img-fluid pro-image-front" src="<?php echo $val['image']?>" alt="<?php echo $title ?>">
                                                                <img class="img-fluid pro-image-back" src="<?php echo $val['image']?>" alt="<?php echo $title ?>">
                                                            </a>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                </div>
                                                <div class="col-lg-9 col-md-8 col-sm-7">
                                                    <div class="product-description">
                                                        <div class="product-content-box">
                                                            <a class="product-title" href="<?php echo $href ?>">
                                                                <h2><?php echo $title ?></h2>
                                                            </a>
                                                            <?php if ($averagePoint > 0) { ?>
                                                                <div class="star-ratings">
                                                                    <ul class="rating">
                                                                        <?php for ($i = 1; $i <= $averagePoint; $i++) { ?>
                                                                            <li><i class="fa fa-star"></i></li>

                                                                        <?php } ?>
                                                                        <?php for ($i = 1; $i <= (5 - $averagePoint); $i++) { ?>
                                                                            <li><i class="fa fa-star-o"></i></li>
                                                                        <?php } ?>
                                                                    </ul>
                                                                </div>
                                                            <?php } ?>
                                                            <span class="price">
                                                            <ins><span class="product-Price-amount">
                                                                    <?php echo $getPrice['price_final'] ?>
                                                                </span>
                                                            </ins>
                                                            <del><span class="product-Price-amount">
                                                                    <?php echo $getPrice['price_old'] ?>
                                                                </span>
                                                            </del>
                                                        </span>
                                                            <p>
                                                                <?php echo $description?>

                                                            </p>
                                                            <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-icon-btn-right ttm-btn-color-skincolor mt-15" href="<?php echo $href ?>">Xem chi tiết<i class="themifyicon ti-shopping-cart-full"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>
                        <div class="pagination-block res-991-mt-0">
                            <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

                        </div>
                    <?php }?>
                </div>
            </div><!-- row end -->
        </div>
    </section>
    <!--team-section end-->


</div>