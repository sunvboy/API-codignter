<div id="main" class="wrapper">
    <div class="breadcrumb" style="margin-bottom: 0px">
        <div class="container">

            <ul>
                <li><a href="<?php echo base_url()?>">Trang chủ</a></li>
                <li><a href="danh-sach-san-pham.html"> / Danh sách sản phẩm</a></li>
            </ul>

        </div>

    </div>
    <div style="clear: both;height: 6px"></div>

    <div class="container">
        <div class="top-product-page">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h1 class="title-pri">Danh sách sản phẩm <span>(<span style="color: #ef0024"><?php echo number_format($total_rows) ?></span> sản phẩm)</span>
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($relaListCustomerNB) && is_array($relaListCustomerNB) && count($relaListCustomerNB)) { ?>

        <section class="list-product product-sale ">
            <div class="container">
                <div class="danhsachcuahangNB">
                    <div class="danhsachcuahangNBI">
                        <h2 class="title-primary title-primary-danhsachcuahang">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="#FFF" fill-rule="evenodd" d="M6.408 0l-2.7 8.298h2.794L3 16l8.744-10.587H8.447L11.937 0z"></path></svg>
                            Sản phảm nổi bật
                        </h2>

                    </div>
                    <div class="clearfix"></div>

                    <div class="owl-carousel slider-list-product m0">
                        <?php $j = 0;
                        foreach ($relaListCustomerNB as $key => $val) {
                            $j++;

                            $title = $val['title'];
                            $href = rewrite_url($val['canonical'], TRUE, TRUE);
                            $image = $val['image'];
                            $getPrice = getPriceFrontend(array('productDetail' => $val));

                            ?>
                            <div class="item">
                                <div class="image">
                                    <a href="<?php echo $href ?>"><img src="<?php
                                        if (file_exists(FCPATH . $image)) {
                                            echo $image;

                                        } else {
                                            echo 'template/not-found.png';
                                        } ?>" alt="<?php echo $title ?>"></a>
                                </div>
                                <div class="nav-img">
                                    <h3 class="title"><a href="<?php echo $href ?>"><?php echo $title ?></a></h3>

                                    <p class="price"><span class="price-t"><?php echo $getPrice['price_final'] ?>  </span>
                                        <del> <?php echo $getPrice['price_old'] ?> </del>
                                        <?php if ($getPrice['percent'] > 0) { ?>
                                            <span class="sale">-<?php echo $getPrice['percent'] ?></span>
                                        <?php } ?>
                                    </p>
                                    <div class="avt" style="display: flex;align-items: center">
                                        <div class="icon">
                                            <img src="<?php
                                            if (file_exists(FCPATH . $val['images'])) {
                                                echo $val['images'];

                                            } else {
                                                echo 'template/not-found.png';
                                            } ?>" alt="<?php echo $val['account'] ?>" alt="<?php echo $val['account'] ?>">
                                        </div>
                                        <div class="nav-icon">
                                            <a href="thuong-hieu.html?id=<?php echo $val['customerid'] ?>"><span><?php echo $val['account'] ?></span></a>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        <?php } ?>

                    </div>
                </div>

            </div>


        </section>
    <?php } ?>
    
    <div style="clear: both;"></div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="content-product">

                    <?php if (isset($productList) && is_array($productList) && count($productList)) { ?>

                        <section class="product-home" style="padding-top: 10px">
                            <div class="row list-product" style="padding: 0px;background: transparent;margin-left: -5px;margin-right: -5px;">
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
                                    <div class="col-md-2 col-sm-6 col-xs-6">
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

                                                <p class="price"><?php echo $getPrice['price_final'] ?>
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

                                                <a href="thuong-hieu.html?id=<?php echo $val['customerid'] ?>"><p class="shop-vp"><img src="template/frontend/images/icon4.png"  alt="<?php echo $val['customer_account'] ?>"><?php echo $val['customer_account'] ?></p></a>
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
        </div>
    </div>

</div>

<style>

    .list-product > div{
        padding-left: 5px;
        padding-right: 5px;
    }
</style>