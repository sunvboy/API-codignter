<div id="main" class="wrapper main-product">
    <div class="breadcrumb">
        <div class="container">

            <div class="row">
                <div class="">
                    <ul>
                        <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>
                        <li><a href="javascipt:void(0)"> / Kết quả tìm kiếm</a></li>
                    </ul>
                </div>

            </div>

        </div>
    </div>

</div>
<section>
    <div class="container">
        <div class="row">
            <?php if ($this->fcDevice == 'desktop') { ?>
                <?php echo $this->load->view('homepage/frontend/common/aside'); ?>

                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="content-product">
                        <div class="top-product-page">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h1 class="title-pri">Kết quả tìm kiếm <span>(<span style="color: #ef0024"><?php echo number_format($total_rows) ?></span> cửa hàng)</span>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($relaListCustomer) && is_array($relaListCustomer) && count($relaListCustomer)) { ?>

                            <section class="product-home " style="padding-top: 10px">
                                <div class="row list-product list-product-danhsachcuahang" style="padding: 0px;background: transparent;margin-left: -5px;margin-right: -5px;">
                                    <?php foreach ($relaListCustomer as $keyPost => $val) {
                                        $hrefC = rewrite_url($val['canonical_catalogue'], TRUE, TRUE); ?>
                                        <div class="col-md-3 col-xs-6 col-sm-4">
                                            <div class="item">
                                                <div class="image">
                                                    <a href="thuong-hieu.html?id=<?php echo $val['id'] ?>"><img src="<?php
                                                        if (file_exists(FCPATH . $val['images'])) {
                                                            echo $val['images'];

                                                        } else {
                                                            echo 'template/not-found.png';
                                                        } ?>" alt="<?php echo $val['account'] ?>"></a>
                                                </div>
                                                <a class="avt" href="thuong-hieu.html?id=<?php echo $val['id'] ?>">
                                                    <img src="<?php
                                                    if (file_exists(FCPATH . $val['images'])) {
                                                        echo $val['images'];

                                                    } else {
                                                        echo 'template/not-found.png';
                                                    } ?>" alt="<?php echo $val['account'] ?>"><span><?php echo $val['account'] ?></span>
                                                </a>
                                                <div class="nav-adress">
                                                    <?php /*?>
                                                    <p><img src="template/frontend/images/i6.png"  alt="Địa chỉ"><?php echo $val['address'] ?></p>
 <?php */?>
                                                    <a href="<?php echo $hrefC ?>">
                                                        <p><img src="template/frontend/images/i7.png" alt="Danh mục"><?php echo $val['catalogue'] ?>
                                                        </p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>
                                <div class="pagenavi">
                                    <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

                                </div>

                            </section>
                        <?php } ?>

                    </div>


                </div>

            <?php }else{?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="content-product">
                        <div class="top-product-page">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h1 class="title-pri">Kết quả tìm kiếm <span>(<span
                                                style="color: #ef0024"><?php echo number_format($total_rows) ?></span> sản phẩm)</span>
                                    </h1>
                                </div>

                            </div>
                        </div>
                        <?php if (isset($productList) && is_array($productList) && count($productList)) { ?>

                            <section class="product-home wow fadeInUp">
                                <div class="row">
                                    <?php $j = 0;
                                    foreach ($productList as $key => $val) {
                                        $j++;

                                        $title = $val['title'];
                                        $href = rewrite_url($val['canonical'], TRUE, TRUE);
                                        $getPrice = getPriceFrontend(array('productDetail' => $val));
                                        $description = cutnchar(strip_tags($val['description']), 100);
                                        $averagePoint = 0;
                                        $comment = comment(array('id' => $val['id'], 'module' => 'product'));
                                        if (isset($comment) && is_array($comment) && count($comment)) {
                                            $averagePoint = round($comment['statisticalRating']['averagePoint']);
                                        }
                                        ?>
                                        <div class="col-md-3 col-sm-6 col-xs-6">
                                            <div class="item">
                                                <div class="image">
                                                    <a href="<?php echo $href ?>"><img src="<?php
                                                        if (file_exists(FCPATH . $val['image'])) {
                                                            echo $val['image'];

                                                        } else {
                                                            echo 'template/not-found.png';
                                                        } ?>" alt="<?php echo $title ?>"></a>
                                                </div>
                                                <div class="nav-image">
                                                    <h3 class="title"><a href="<?php echo $href ?>"><?php echo $title ?></a>
                                                    </h3>

                                                    <p class="price">
                                                        <?php echo $getPrice['price_final'] ?>
                                                        <?php if($averagePoint>0){?>
                                                            <span class="start">
                                                            <?php for($i=1;$i<=$averagePoint;$i++){?>
                                                                <i class="fas fa-star"></i>
                                                            <?php }?>
                                                                <?php for($i=1;$i<=(5-$averagePoint);$i++){?>
                                                                    <i class="far fa-star"></i>
                                                                <?php }?>

                                                        </span>
                                                        <?php }?>

                                                    </p>

                                                    <a href="thuong-hieu.html?id=<?php echo $val['customerid'] ?>"><p
                                                            class="shop-vp"><img src="template/frontend/images/icon4.png"
                                                                                 alt=""><?php echo $val['customer_account'] ?>
                                                        </p></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="pagenavi">
                                    <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
                                </div>

                            </section>
                        <?php } ?>
                    </div>


                </div>


            <?php }?>

        </div>
    </div>
</section>


