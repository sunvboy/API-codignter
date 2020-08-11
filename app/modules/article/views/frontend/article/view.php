<main>

    <?php
    $prd_title = $detailArticle['title'];

    $prd_href = rewrite_url($detailArticle['canonical']);
    $prd_href_Catalogue = rewrite_url($detailCatalogue['canonical']);

    ?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-xs-12 col-sm-9">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>
                        <?php foreach ($breadcrumb as $key => $val) { ?>
                            <?php
                            $title = $val['title'];
                            $href = rewrite_url($val['canonical'], true, true);
                            ?>
                            <li><a href="<?php echo $href ?>"> <?php echo $title ?></a></li>
                        <?php } ?>
                    </ul>
                    <div class="clearfix" style="height: 30px"></div>
                    <section class="listProduct">
                        <div class="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="catalogue-title" style="width: 100%;text-align: center">
                                        <a href="<?php echo $prd_href_Catalogue ?>"
                                           style="color: #08c;text-transform: uppercase;font-weight: bold"><?php echo $detailCatalogue['title'] ?></a>
                                    </div>
                                    <div class="clearfix" style="height: 10px"></div>

                                    <div class="time-date">
                                        <?php echo $detailArticle['created'] ?>
                                    </div>
                                    <h1 class="main-header"><a href="<?php echo $prd_href ?>"
                                                               style="color: #ff8c19!important;    font-size: 22px;"><?php echo $prd_title ?></a>
                                    </h1>
                                    <style>
                                        .main-header {
                                            margin-top: 0px !important;
                                        }

                                        .main-header:after {
                                            background: #ff8c19;
                                        }

                                        .time-date {
                                            font-size: 12px;
                                            width: 100%;
                                            text-align: center;
                                        }

                                        .meta-related {
                                            border: 1px dashed #b1b1b180;
                                            padding-top: 10px;
                                            padding-left: 20px;
                                        }

                                        .meta-related li {
                                            margin-bottom: 10px;
                                        }

                                        .meta-related a {
                                            color: #08c;
                                        }

                                        .lienhe-single {
                                            padding: 15px;
                                            border: 1px dashed #ccc;
                                            border-radius: 20px;
                                            background: #f9f9f9;
                                        }
                                    </style>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12">
                                    <div class="cat_decription">
                                        <?php echo $detailArticle['description'] ?>
                                    </div>
                                    <?php /*<div class="clearfix" style="height: 10px"></div>

                                    <div class="meta-related">
                                        <div class="rpbt_shortcode">
                                            <ul>

                                                <li>
                                                    <a href="https://mauthietkecuahang.com/mau-thiet-ke-noi-that-van-phong-ban-ve-may-bay-dep-20m2.html">Mẫu
                                                        thiết kế nội thất văn phòng bán vé máy bay đẹp 20m2</a></li>
                                            </ul>
                                        </div>
                                    </div>*/?>
                                    <div style="clear: both;height: 20px;"></div>
                                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                        <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                        <a class="a2a_button_facebook"></a>
                                        <a class="a2a_button_twitter"></a>
                                        <a class="a2a_button_google_plus"></a>
                                        <a class="a2a_button_skype"></a>
                                    </div>
                                    <script async src="https://static.addtoany.com/menu/page.js"></script>
                                    <div style="clear: both;height: 20px;"></div>

                                    <div style="margin: 0px -8px">
                                        <div class="fb-comments" data-href="<?php echo $canonical?>" data-numposts="20" data-width="1140"></div>
                                    </div>
                                    <style>
                                        .content-new-detail img {
                                            max-width: 100% !important;
                                            height: auto !important;
                                        }
                                    </style>
                                    <div class="clearfix" style="height: 10px"></div>




                                    <div class="lienhe-single">
                                        <div class="box-hotline">
                                            <?php echo $this->fcSystem['homepage_aboutus'] ?>
                                            <h4 style="font-weight: bold"><?php echo $this->fcSystem['homepage_company'] ?></h4>
                                            <p><span>Email:</span> <a
                                                        href="mailto:<?php echo $this->fcSystem['contact_email'] ?> "
                                                        style="color: #08c"><?php echo $this->fcSystem['contact_email'] ?> </a>
                                            </p>
                                            <p class="phone"><span>Hotline:</span> <a
                                                        href="tel:<?php echo $this->fcSystem['contact_hotline'] ?>"
                                                        style="color: #08c"><?php echo $this->fcSystem['contact_hotline'] ?></a>
                                            </p>
                                            <p class="phone"><span>Số điện thoại:</span> <a
                                                        href="tel:<?php echo $this->fcSystem['contact_phone'] ?>"
                                                        style="color: #08c"><?php echo $this->fcSystem['contact_phone'] ?></a>
                                            </p>
                                        </div>
                                        <div class="dangkythietke"></div>
                                    </div>
                                    <div class="clearfix" style="height: 10px"></div>

                                    <?php if (isset($articles_same) && is_array($articles_same) && count($articles_same)) { ?>


                                        <h3 class="title_bailienquan">BÀI VIẾT CÙNG CHUYÊN MỤC</h3>
                                        <section class="listProduct">
                                            <?php $j = 0;
                                            foreach ($articles_same as $key => $val) {
                                                $j++;

                                                $title = $val['title'];
                                                $href = rewrite_url($val['canonical'], TRUE, TRUE);
                                                $description = cutnchar(strip_tags($val['description']), 200);
                                                ?>
                                                <div class="col-md-4 col-xs-12 col-sm-3 p2">
                                                    <div class="box_listProduct">
                                                        <div class="box-image">
                                                            <a href="<?php echo $href ?>"><img
                                                                        src="<?php echo $val['image'] ?>"
                                                                        alt="<?php echo $title ?>"
                                                                        style="height: 210px;object-fit: cover"></a>

                                                        </div>
                                                        <div class="box_text_listProduct">
                                                            <?php /*<a href="" class="category_tag_listProduct">Thiết kế shop thời trang</a>*/ ?>
                                                            <h3><a href="<?php echo $href ?>"><?php echo $title ?></a>
                                                            </h3>
                                                            <div class="is-divider"></div>
                                                            <div class="desc">&nbsp;<?php echo $description ?>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            <?php } ?>
                                        </section>

                                    <?php } ?>

                                </div>

                            </div>

                        </div>

                    </section>


                </div>
                <?php echo $this->load->view('homepage/frontend/common/aside') ?>

            </div>

        </div>
    </div>


</main>
