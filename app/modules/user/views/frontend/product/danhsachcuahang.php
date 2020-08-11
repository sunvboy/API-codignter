<div id="main" class="wrapper">
    <div class="breadcrumb" style="margin-bottom: 0px">
        <div class="container">

            <ul>
                <li><a href="<?php echo base_url()?>">Trang chủ</a></li>
                <li><a href="danh-sach-cua-hang.html"> / Danh sách cửa hàng</a></li>
            </ul>

        </div>
    </div>


    <div style="clear: both;height: 12px"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="content-product">
                    <div class="top-product-page">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h1 class="title-pri">Danh sách cửa hàng <span>(<span style="color: #ef0024"><?php echo $total_rows?></span> cửa hàng)</span></h1>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($relaListCustomerNB) && is_array($relaListCustomerNB) && count($relaListCustomerNB)) { ?>

                        <section class="list-product ">
                            <div class="" style="padding: 0px">
                                <div class="danhsachcuahangNB">
                                    <div class="danhsachcuahangNBI">
                                        <h2 class="title-primary title-primary-danhsachcuahang">
                                            Cửa hàng nổi bật

                                        </h2>

                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="owl-carousel slider-list-product m0">
                                        <?php foreach ($relaListCustomerNB as $keyPost => $val) {
                                            $hrefC = rewrite_url($val['canonical_catalogue'], TRUE, TRUE); ?>
                                            <div class="item">
                                                <div class="image">
                                                    <a href="thuong-hieu.html?id=<?php echo $val['id'] ?>"><img src="<?php echo $val['images']?>" alt="<?php echo $val['account'] ?>"></a>
                                                </div>
                                                <a class="avt" href="thuong-hieu.html?id=<?php echo $val['id'] ?>">
                                                    <img src="<?php echo $val['images']?>" alt="<?php echo $val['account'] ?>"><span><?php echo $val['account'] ?></span>
                                                </a>

                                                <div class="nav-adress">
                                                    <?php /*?>
                                                    <p><img src="template/frontend/images/i6.png"
                                                            alt="Địa chỉ"><?php echo $val['address'] ?></p><?php */?>

                                                    <a href="<?php echo $hrefC ?>"><p><img src="template/frontend/images/i7.png"
                                                                                           alt="Danh mục"><?php echo $val['catalogue'] ?>
                                                        </p></a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>

                                </div>

                            </div>


                        </section>
                    <?php } ?>
                    <section class="product-home " style="padding-top: 10px">
                        <div class="row list-product list-product-danhsachcuahang" style="padding: 0px;background: transparent;margin-left: -5px;margin-right: -5px;">
                            <?php $i=0; foreach ($relaListCustomer as $keyPost => $val) { $i++;
                                $hrefC = rewrite_url($val['canonical_catalogue'], TRUE, TRUE); ?>
                                <div class="col-md-2 col-xs-6 col-sm-4">
                                    <div class="item">
                                        <div class="image">
                                            <a href="thuong-hieu.html?id=<?php echo $val['id'] ?>"><img src="<?php echo $val['images'] ?>" alt="<?php echo $val['account'] ?>"></a>
                                        </div>
                                        <a class="avt" href="thuong-hieu.html?id=<?php echo $val['id'] ?>">
                                            <img src="<?php echo $val['images'] ?>" alt="<?php echo $val['account'] ?>"><span><?php echo $val['account'] ?></span>
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
                                <?php if($i%5==0){?><div style="clear: both"></div><?php }?>
                            <?php } ?>

                        </div>
                        <div class="pagenavi">
                            <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

                        </div>

                    </section>
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

    .product-home .item .image img {
        height: 186.66px;
        object-fit: contain;
    }
    @media (min-width: 1200px) {
        .list-product-danhsachcuahang >div{
            width: 20%;
        }
        .product-home .item .image img {
            width: 100%;
            height: 186.66px;
        }
    }
</style>
