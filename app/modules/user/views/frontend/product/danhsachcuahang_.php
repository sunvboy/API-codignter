

<div id="main" class="wrapper">
    <div id="home-wrapper">

        <?php if (isset($relaListCustomerNB) && is_array($relaListCustomerNB) && count($relaListCustomerNB)) { ?>

        <div class="top-content-detail">
            <div class="container">
                <h3 class="title_promotion pull-left wow fadeInUp" style="margin: 20px 0">Cửa hàng nổi bật </h3>
                <div style="clear: both"></div>
                <style>
                    .slider-cuahnagnoibat .owl-prev, .slider-cuahnagnoibat .owl-next {
                        position: absolute;
                        top: 50%;
                        transform: translateY(-50%);
                        background: #00000042;
                        width: 48px;
                        height: 48px;
                        border-radius: 100% !important;
                        line-height: 48px;
                        text-align: center;
                        color: #fff;
                    }
                    .slider-cuahnagnoibat .owl-prev {
                        left: -24px;
                    }
                    .slider-cuahnagnoibat .owl-next {
                        right: -24px;
                    }
                    @media (max-width: 767px) {
                        .imgapc{
                            height: auto !important;
                        }
                    }
                </style>

                <div class="owl-carousel slider-cuahnagnoibat">
                    <?php foreach ($relaListCustomerNB as $keyPost => $val) { ?>
                        <div class="item">
                            <div class="row" id="flexxx">
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <div class="list-img wow fadeInUp">
                                        <img class="imgapc" src="<?php
                                        if (file_exists(FCPATH .   $val['images'] )) {
                                            echo  $val['images'] ;

                                        }else{
                                            echo 'template/not-found.png';
                                        } ?>" alt="<?php echo $val['account'] ?>" style="width: 100%;height: 450px;object-fit: cover">

                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="sidebar-right">
                                        <div class="images">
                                            <a href="thuong-hieu.html?id=<?php echo $val['id'] ?>"><img src="<?php
                                                if (file_exists(FCPATH .   $val['avatar'] )) {
                                                    echo  $val['avatar'] ;

                                                }else{
                                                    echo 'template/not-found.png';
                                                } ?>" alt="<?php echo $val['account'] ?>" style="width: 128px !important;    margin: 0px auto;"></a>
                                        </div>
                                        <h3 class="title"><?php echo $val['account'] ?></h3>
                                        <?php if(!empty($val['address']) && $val['address'] != ''){?>

                                            <div class="item">
                                                <div class="icon"><img src="template/frontend/asset/images/placeholder.svg" alt="Địa chỉ "></div>
                                                <div class="nav-icon">
                                                    <h4 class="title2"> Địa chỉ </h4>
                                                    <p class="desc2"><?php echo $val['address']?></p>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        <?php }?>
                                        <?php if (!empty($val['time_open']) && $val['time_open'] != '') { ?>
                                            <div class="item">
                                                <div class="icon"><img
                                                        src="template/frontend/asset/images/opened-door-aperture.svg"
                                                        alt="<?php echo $val['time_open'] ?>"></div>
                                                <div class="nav-icon">
                                                    <h4 class="title2">Thời gian mở cửa</h4>

                                                    <p class="desc2"> <?php echo $val['time_open'] ?></p>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        <?php } ?>
                                        <?php if (!empty($val['phone']) && $val['phone'] != '') { ?>

                                            <div class="item">
                                                <div class="icon"><img src="template/frontend/asset/images/phone.svg"  alt="<?php echo $val['phone'] ?>"></div>
                                                <div class="nav-icon">
                                                    <a href="tel:<?php echo $val['phone'] ?>" class="title2" style="float: left"> Liên hệ <b  style="font-size: 15px"><?php echo $val['phone'] ?></b></a>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        <?php } ?>


                                        <div class="social-sidebar">
                                            <h5 class="title-social">Kết nối của hàng</h5>

                                            <div class="nav-social">
                                                <ul>
                                                    <li>
                                                        <?php if (!empty($val['shop_link_fanpage']) && $val['shop_link_fanpage'] != '') { ?>
                                                            <a href="<?php echo $val['shop_link_fanpage'] ?>"><i
                                                                    class="fab fa-facebook-f"></i></a>
                                                        <?php } else { ?>
                                                            <a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a>

                                                        <?php } ?>
                                                    </li>
                                                    <li>
                                                        <?php if (!empty($val['shop_link_instagram']) && $val['shop_link_instagram'] != '') { ?>
                                                            <a href="<?php echo $val['shop_link_instagram'] ?>"><i
                                                                    class="fab fa-instagram"></i></a>
                                                        <?php } else { ?>
                                                            <a href="javascript:void(0);"><i
                                                                    class="fab fa-instagram"></i></a>

                                                        <?php } ?>
                                                    </li>
                                                    <li>
                                                        <a href="http://zalo.me/<?php echo $val['phone']?>" style="font-weight: bold" target="_blank">ZALO</a>

                                                    </li>
                                                    <li>
                                                        <?php if (!empty($val['shop_link']) && $val['shop_link'] != '') { ?>
                                                            <a href="<?php echo $val['shop_link'] ?>"><i
                                                                    class="fas fa-home"></i></a>
                                                        <?php } else { ?>
                                                            <a href="thuong-hieu.html?id=<?php echo $val['id'] ?>"><i
                                                                    class="fas fa-home"></i></a>
                                                        <?php } ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>

        </div>
        <?php } ?>
        <style>
            .count_recod {
                font-weight: bold;
                font-display: auto;
                color: #ffb300;
            }
            .result_search {
                padding-bottom: 10px;
                font-size: 16px;
                color: #707070;
            }
        </style>

        <?php if (isset($relaListCustomer) && is_array($relaListCustomer) && count($relaListCustomer)) { ?>

            <div class="list-shop">
                <div class="container">
                    <h3 class="title_promotion pull-left wow fadeInUp" style="margin-bottom: 5px"> Danh sách Cửa hàng </h3>

                    <div style="clear: both"></div>
                    <div class="result_search ">Có <span class="count_recod"><?php echo $total_rows?></span> kết quả phù hợp</div>
                    <div style="clear: both;height: 10px"></div>

                    <div class="clearfix"></div>
                    <div class="row">
                        <?php foreach ($relaListCustomer as $keyPost => $val) {
                            $hrefC = rewrite_url($val['canonical_catalogue'], TRUE, TRUE); ?>
                            <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp">
                                <div class="_list_store home_list">
                                    <div class="thumbnail">
                                        <a class="block-img" href="thuong-hieu.html?id=<?php echo $val['id'] ?>">
                                            <img src="<?php
                                            if (file_exists(FCPATH .   $val['images'] )) {
                                                echo  $val['images'] ;

                                            }else{
                                                echo 'template/not-found.png';
                                            } ?>" alt="<?php echo $val['account'] ?>">
                                        </a>

                                        <div class="clearfix"></div>
                                        <div class=" box__info_res">
                                            <div class="_info_res">
                                                <div class="logo_store">
                                                    <a class="u-logo"
                                                       href="thuong-hieu.html?id=<?php echo $val['id'] ?>">
                                                        <img src="<?php
                                                        if (file_exists(FCPATH .   $val['avatar'] )) {
                                                            echo  $val['avatar'] ;

                                                        }else{
                                                            echo 'template/not-found.png';
                                                        } ?>"
                                                             style="display: inline-block;width: 28px;height: 28px;object-fit: cover;border-radius: 100%"
                                                             alt="<?php echo $val['account'] ?>">
                                                    </a>
                                                </div>
                                                <div class="info_store">
                                                    <h3 class="name_store_list">
                                                        <a href="thuong-hieu.html?id=<?php echo $val['id'] ?>">
                                                            <?php echo $val['account'] ?>
                                                        </a>
                                                    </h3>

                                                    <div class="font_defaul address">
                                                        <i class=" fa fa-map-marker _location" aria-hidden="true"></i>
                                                        <?php echo $val['address'] ?>
                                                    </div>
                                                    <div class="font_defaul address">
                                                        <i class="  fa fa-tag _tag" aria-hidden="true"></i>
                                                        <a href="<?php echo $hrefC ?>">
                                                            <?php echo $val['catalogue'] ?>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="pull-right">
                        <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

                    </div>

                </div>
            </div>
        <?php } ?>


    </div>
</div>