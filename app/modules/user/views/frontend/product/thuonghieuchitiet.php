<div id="main" class="wrapper">

    <div id="home-wrapper">



            <div class="category-share">
                <div class="container">
                    <h3 class="title_promotion pull-left wow fadeInUp"> Danh sách sản phẩm - <?php echo $detailCustomer['account']?> </h3>
                    <div class="clearfix"></div>
                    <div class="nav-category-sale">
                        <div class="row">
                            <?php if (isset($productList) && is_array($productList) && count($productList)) { ?>

                            <?php $j=0; foreach ($productList as $key => $val) { $j++;

                                $title = $val['title'];
                                $href = rewrite_url($val['canonical'], TRUE, TRUE);
                                $image = getthumb($val['image']);
                                $getPrice = getPriceFrontend(array('productDetail' => $val));
                                $description = cutnchar(strip_tags($val['description']),100);

                                ?>
                                <div class="col-md-3 col-sm-6 col-xs-6 wow fadeInUp">
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
                                                        <img src="<?php echo $image ?>" alt="<?php echo $title ?>">
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
                                                                    <img src="<?php echo $val['customer_avatar']?>" style="display: inline-block;width: 28px;height: 28px;object-fit: cover;border-radius: 100%" alt="<?php echo $title ?>">
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
                            <?php }else{?>
                                <div class="col-md-12">
                                    Nội dung đang được cập nhập...

                                </div>
                            <?php }?>
                        </div>
                    </div>
                    <div class="pull-right">
                        <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

                    </div>
                </div>
            </div>


    </div>
</div>