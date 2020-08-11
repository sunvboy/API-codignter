<div id="main" class="wrapper">

    <div id="home-wrapper">


        <?php if (isset($relaListCustomerNB) && is_array($relaListCustomerNB) && count($relaListCustomerNB)) { ?>

            <div class="top-content-detail">
                <div class="container">
                    <h3 class="title_promotion pull-left wow fadeInUp" style="margin: 20px 0">Sản phẩm nổi bật</h3>
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
                        <?php foreach ($relaListCustomerNB as $keyPost => $val) {  $href = rewrite_url($val['canonical'], TRUE, TRUE);?>
                            <div class="item">
                                <div class="row" id="flexxx">
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="list-img wow fadeInUp">
                                            <a href="<?php echo $href?>"> <img class="imgapc" src="<?php
                                                if (file_exists(FCPATH .   $val['image'] )) {
                                                    echo  $val['image'] ;

                                                }else{
                                                    echo 'template/not-found.png';
                                                } ?>" alt="<?php echo $val['account'] ?>" style="width: 100%;height: 450px;object-fit: cover">
                                            </a>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="sidebar-right">
                                            <div class="images">
                                                <a href="thuong-hieu.html?id=<?php echo $val['customerid'] ?>"><img src="<?php
                                                    if (file_exists(FCPATH .   $val['avatar'] )) {
                                                        echo  $val['avatar'] ;

                                                    }else{
                                                        echo 'template/not-found.png';
                                                    } ?>" alt="<?php echo $val['account'] ?>" style="width: 128px !important;    margin: 0px auto;"></a>
                                            </div>
                                            <h3 class="title"><a href="<?php echo $href?>"> <?php echo $val['account'] ?></a></h3>
                                            <p class="desc"><a href="<?php echo $href?>" style="    color: red;
    text-decoration: underline;
">Xem chi tiết</a></p>

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
                                                                <a href="thuong-hieu.html?id=<?php echo $val['customerid'] ?>"><i
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


        <?php if (isset($productList) && is_array($productList) && count($productList)) { ?>
            <div class="category-share">
                <div class="container">
                    <h3 class="title_promotion pull-left wow fadeInUp" style="margin-bottom: 5px"> Danh sách sản phẩm </h3>
                    <div style="clear: both"></div>
                    <div class="result_search ">Có <span class="count_recod"><?php echo $total_rows?></span> kết quả phù hợp</div>
                    <div style="clear: both;height: 10px"></div>

                    <div class="clearfix"></div>
                    <div class="nav-category-sale" style="margin-top: 0px">
                        <div class="row">
                            <?php $j=0; foreach ($productList as $key => $val) { $j++;

                                $title = $val['title'];
                                $href = rewrite_url($val['canonical'], TRUE, TRUE);
                                $image = $val['image'];
                                $getPrice = getPriceFrontend(array('productDetail' => $val));
                                $description = cutnchar(strip_tags($val['description']),100);

                                ?>
                                <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp">
                                    <div class="_list_store  _list_store_detail">
                                        <div class="relatic">
                                            <div class=" item_box">
                                                <div class="box_pr">
                                                    <?php if(!empty($val['khuyenmai']) && $val['khuyenmai'] != ''){?>
                                                        <div class="gift"> <?php echo $val['khuyenmai']?></div>
                                                    <?php }?>
                                                    <?php if(!empty($val['time_sale']) && $val['time_sale'] != ''){?>
                                                        <div class="time_gift">
                                                            <i class="fas fa-clock"></i>
                                                            <span><?php echo countdown($val['time_sale'])?> ngày</span>
                                                        </div>
                                                    <?php }?>
                                                    <a class="block-img im_detail" href="<?php echo $href ?>">
                                                        <img src="<?php
                                                        if (file_exists(FCPATH .  $image)) {
                                                            echo $image;

                                                        }else{
                                                            echo 'template/not-found.png';
                                                        } ?>" alt="<?php echo $title ?>">
                                                    </a>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div class="item_box item-hover-show-text-info campain">
                                                <a href="<?php echo $href ?>">
                                                    <?php if(!empty($val['mota']) && $val['mota'] != ''){?>
                                                        <?php echo $val['mota'] ?>
                                                    <?php }else{?>
                                                        <?php echo $title ?>
                                                    <?php }?>

                                                </a>
                                            </div>
                                        </div>
                                        <div class="deal_footer">
                                            <div class="caption ">
                                                <a href="<?php echo $href ?>" title="<?php echo $title ?>">
                                                    <span class="title_caption ">Độc quyền</span>
                                                    <span class="_title_caption"><?php echo $title ?></span>
                                                </a>
                                            </div>
                                            <p class="price">Giá: <?php echo $getPrice['price_final'] ?></p>
                                            <?php if(!empty($val['customerid'])){?>
                                                <div class=" box_info_res ">
                                                    <div class="info_res row">
                                                        <div class="col-md-10 col-xs-10 col-sm-10 pd8">
                                                            <div class="use-info pull-left">
                                                                <a class="u-logo" href="thuong-hieu.html?id=<?php echo $val['customerid']?>">
                                                                    <img src="
                                                                    <?php
                                                                    if (file_exists(FCPATH .  $val['customer_avatar'])) {
                                                                        echo $val['customer_avatar'];

                                                                    }else{
                                                                        echo 'template/not-found.png';
                                                                    }

                                                                    ?>" style="display: inline-block;width: 28px;height: 28px;object-fit: cover;border-radius: 100%" alt="<?php echo $title ?>">
                                                                </a>
                                                            </div>
                                                            <div class="pull-left info_store ">
                                                                <div class="name_store no_margin" >
                                                                    <a href="thuong-hieu.html?id=<?php echo $val['customerid']?>">
                                                                        <?php echo $val['customer_account']?>
                                                                    </a>
                                                                </div>
                                                                <p class="font_defaul address" >
                                                                    <?php echo $val['customer_address']?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2  col-xs-2 col-sm-2 pd10 text-center point ">
                                                            <i class="fas fa-heart"></i>
                                                            <span class="number_count"></span>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            <?php }?>

                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                    <div class="pull-right">
                        <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

                    </div>
                </div>
            </div>
        <?php }?>


    </div>
</div>
