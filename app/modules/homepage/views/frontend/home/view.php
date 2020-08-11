<header class="header-pc">
    <div class="logo-menu">
        <div class="container">
            <div class="row flex">
                <div class="col-md-3 col-sm-12 col-xs-12 center">
                    <a href="<?php echo base_url()?>" class="logo"><img src="<?php echo $this->fcSystem['homepage_logo']?>" alt="<?php echo $this->fcSystem['homepage_company']?>"></a>
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12 hidden-xs">
                    <?php $mobile_nav = navigation(array('keyword' => 'main', 'output' => 'array'), $this->fc_lang); ?>
                    <?php if (isset($mobile_nav) && is_array($mobile_nav) && count($mobile_nav)) { ?>
                        <div class="main-menu">
                            <ul>
                                <?php foreach ($mobile_nav as $key => $val) { ?>
                                    <li >
                                        <a  href="<?php echo $val['link']; ?>"><?php echo $val['title']; ?></a>
                                        <?php if (isset($val['children']) && is_array($val['children']) && count($val['children'])) { ?>

                                            <ul class="row">
                                                <?php foreach ($val['children'] as $keyItem => $valItem) { ?>

                                                    <li class="col-md-4">
                                                        <a href="<?php echo $valItem['link'] ?>"><?php echo $valItem['title'] ?></a>

                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>

    <?php echo $this->load->view('homepage/frontend/common/menumobile') ?>

</header>
<main>
    <?php if (isset($slide) && is_array($slide) && count($slide)) { ?>

        <div id="slider-home" class="owl-carousel">

            <?php foreach ($slide as $key => $val) { ?>
                <div class="item">
                    <a href="<?php echo $val['link'] ?>"> <img src="<?php echo $val['src'] ?>"
                                                               alt="<?php echo $val['title'] ?>"></a>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    <section id="about-us">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-xs-12 col-sm-4">
                    <div class="fb-page" data-href="<?php echo $this->fcSystem['social_facebook'] ?>"
                         data-tabs="timeline" data-width="" data-height="328" data-small-header="false"
                         data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                        <blockquote cite="<?php echo $this->fcSystem['social_facebook'] ?>"
                                    class="fb-xfbml-parse-ignore"><a
                                    href="<?php echo $this->fcSystem['social_facebook'] ?>">Facebook</a></blockquote>
                    </div>

                </div>
                <div class="col-md-8 col-xs-12 col-sm-8">
                    <div class="text">
                        <h1><?php echo $this->fcSystem['aboutus_title'] ?></h1>
                        <div class="text-description"><?php echo $this->fcSystem['aboutus_description'] ?></div>
                    </div>

                </div>

            </div>

        </div>

    </section>
    <?php if (isset($product_catalog_ishome) && is_array($product_catalog_ishome) && count($product_catalog_ishome)) { ?>
        <?php foreach ($product_catalog_ishome as $key => $val) {
            $href = rewrite_url($val['canonical'], TRUE, TRUE); ?>
            <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>

                <section id="hot-project">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="main-header"><a href="<?php echo $href ?>"><?php echo $val['title'] ?></a>
                                </h2>

                            </div>
                            <div class="clearfix"></div>


                        </div>
                        <div class="nonemobile">
                            <?php foreach ($val['post'] as $keyP => $valP) {
                                $hrefP = rewrite_url($valP['canonical'], TRUE, TRUE);
                                if ($keyP == 0) { ?>
                                    <div class="col-md-6 col-xs-12 col-sm-12 p0">

                                        <article>
                                            <div class="cat-box-image">
                                                <a href="<?php echo $hrefP ?>">
                                                    <img src="<?php echo $valP['image'] ?>"
                                                         alt="<?php echo $valP['title'] ?>" class="w100">
                                                </a>
                                            </div>
                                            <div class="cat-box-text ">
                                                <?php /*<a href="" class="category_tag">Thiết kế quán cafe</a>*/ ?>
                                                <h3 class="entry-title"><a
                                                            href="<?php echo $hrefP ?>"><?php echo $valP['title'] ?></a>
                                                </h3>
                                                <div class="entry-meta"><span class="posted-on"><i
                                                                class="fa fa-calendar"></i><?php echo $valP['created'] ?></span>
                                                </div>
                                            </div>
                                        </article>

                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <div class="col-md-6 col-xs-12 col-sm-12 p0">
                                <div>
                                    <?php foreach ($val['post'] as $keyP => $valP) {
                                        $hrefP = rewrite_url($valP['canonical'], TRUE, TRUE);
                                        if ($keyP > 0) { ?>
                                            <article class="col-md-6 col-xs-12 col-sm-6 p0">
                                                <div class="cat-box-image">
                                                    <a href="<?php echo $hrefP ?>">
                                                        <img src="<?php echo $valP['image'] ?>"
                                                             alt="<?php echo $valP['title'] ?>" class="w100"
                                                             style="height: 201px;object-fit: cover">
                                                    </a>
                                                </div>
                                                <div class="cat-box-text ">
                                                    <?php /*<a href="" class="category_tag">Thiết kế quán cafe</a>*/ ?>
                                                    <h3 class="entry-title"><a
                                                                href="<?php echo $hrefP ?>"><?php echo $valP['title'] ?></a>
                                                    </h3>
                                                    <div class="entry-meta"><span class="posted-on"><i
                                                                    class="fa fa-calendar"></i><?php echo $valP['created'] ?></span>
                                                    </div>
                                                </div>
                                            </article>
                                        <?php } ?>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>

                    </div>

                </section>
            <?php } ?>
        <?php } ?>
    <?php } ?>

    <?php if (isset($product_catalog_highlight) && is_array($product_catalog_highlight) && count($product_catalog_highlight)) { ?>
        <?php foreach ($product_catalog_highlight as $key => $val) {
            $href = rewrite_url($val['canonical'], TRUE, TRUE); ?>
            <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>

                <section class="listProduct">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="main-header"><a href="<?php echo $href ?>"><?php echo $val['title'] ?></a>
                                </h2>

                            </div>
                            <div class="clearfix"></div>
                            <?php foreach ($val['post'] as $keyP => $valP) {
                                $hrefP = rewrite_url($valP['canonical'], TRUE, TRUE);
                                $description = cutnchar(strip_tags($valP['description']), 200); ?>
                                <div class="col-md-3 col-xs-12 col-sm-3 p2">
                                    <div class="box_listProduct">
                                        <div class="box-image">
                                            <a href="<?php echo $hrefP ?>"><img src="<?php echo $valP['image'] ?>"
                                                                                alt="<?php echo $valP['title'] ?>"
                                                                                style="height: 210px;object-fit: cover"></a>

                                        </div>
                                        <div class="box_text_listProduct">
                                            <?php /*<a href="" class="category_tag_listProduct">Thiết kế shop thời trang</a>*/ ?>
                                            <h3><a href="<?php echo $hrefP ?>"><?php echo $valP['title'] ?></a></h3>
                                            <div class="is-divider"></div>
                                            <div class="desc">&nbsp;<?php echo $description ?>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            <?php } ?>
                        </div>

                    </div>

                </section>
            <?php } ?>
        <?php } ?>
    <?php } ?>


    <section id="about" style="background: url(<?php echo $this->fcSystem['aboutushome_image'] ?>)">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="main-header"><?php echo $this->fcSystem['aboutushome_title'] ?></h2>
                    <div class="desc">
                        <div style="text-align: justify; color: #fff;"><?php echo $this->fcSystem['aboutushome_description'] ?></div>

                    </div>

                </div>

            </div>

        </div>


    </section>
    <?php if (isset($tintuc) && is_array($tintuc) && count($tintuc)) { ?>
        <?php foreach ($tintuc as $key => $val) {
            $hrefT = rewrite_url($val['canonical'], true, true); ?>
            <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                <section id="blogs">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="main-header"><a href="<?php echo $hrefT ?>"><?php echo $val['title'] ?></a>
                                </h2>

                            </div>
                            <div class="clearfix"></div>


                        </div>
                        <?php foreach ($val['post'] as $keyP => $valP) {
                            $href = rewrite_url($valP['canonical'], true, true); ?>

                            <article class="col-md-4 col-xs-12 col-sm-4 " >
                                <div style="position: relative">
                                    <div class="cat-box-image">
                                        <a href="<?php echo $href ?>">
                                            <img src="<?php echo $valP['image'] ?>" alt="<?php echo $valP['title'] ?>"
                                                 class="w100" style="height: 250px;object-fit: cover">
                                        </a>
                                    </div>
                                    <div class="cat-box-text ">
                                        <?php /*<a href="" class="category_tag">Thiết kế quán cafe</a>*/ ?>
                                        <h3 class="entry-title"><a href="<?php echo $href ?>"><?php echo $valP['title'] ?></a></h3>
                                        <div class="entry-meta"><span class="posted-on"> <i class="fa fa-calendar"></i> <?php echo $valP['created'] ?></span></div>
                                    </div>
                                </div>

                            </article>
                        <?php } ?>


                    </div>

                </section>
            <?php } ?>
        <?php } ?>
    <?php } ?>
</main>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-12 col-sm-12">
                <div class="box_footer">
                    <span class="widget-title "><?php echo $this->fcSystem['homepage_company']?></span>
                    <div class="textwidget"><p><i class="fa fa-map-marker"></i> Địa chỉ: <?php echo $this->fcSystem['contact_address']?></p>
                        <p><i class="fa fa-map-marker"></i> Xưởng: <?php echo $this->fcSystem['contact_xuong']?></p>
                        <p><i class="fa fa-phone"></i> Hotline: <?php echo $this->fcSystem['contact_hotline']?> - <?php echo $this->fcSystem['contact_phone']?></p>
                        <p><i class="fa fa-envelope"></i> <?php echo $this->fcSystem['contact_email']?></p>
                        <p><i class="fa fa-chrome" aria-hidden="true"></i> <?php echo base_url()?></p>
                    </div>
                </div>

            </div>
            <?php echo $this->load->view('homepage/frontend/common/menufooter') ?>

            <div class="col-md-3 col-xs-12 col-sm-6">
                <div class="box_footer">
                    <span class="widget-title ">KẾT NỐI VỚI CHÚNG TÔI</span>
                    <div class="textwidget">
                        <div class="widget-social-icons">
                            <a class="facebook" href="<?php echo $this->fcSystem['social_facebook']?>" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a class="twitter" href="<?php echo $this->fcSystem['social_twitter']?>" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a class="gplus" href="<?php echo $this->fcSystem['social_google_plus']?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                            <a class="pinterest" href="<?php echo $this->fcSystem['social_pinterest']?>" target="_blank"><i class="fa fa-pinterest"></i></a>
                            <a class="linkedin" href="<?php echo $this->fcSystem['social_linkedin']?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <?php echo $this->load->view('homepage/frontend/common/mailsubricre') ?>

            </div>
        </div>

    </div>
</footer>
<script type="text/javascript" src="template/frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="template/frontend/js/wow.min.js"></script>
<script type="text/javascript" src="template/frontend/js/owl.carousel.min.js"></script>
<script src="template/frontend/js/hc-offcanvas-nav.js"></script>
<script type="text/javascript" src="template/frontend/js/main.js"></script>
<script>
    //hieu ung wow------------------------------------------
    wow = new WOW(
        {
            animateClass: 'animated',
            offset: 100,
            callback: function (box) {
                console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
            }
        }
    );
    wow.init();


</script>
<div id="ft_hotline"> <a href="tel:<?php echo $this->fcSystem['contact_hotline']?>"><?php echo $this->fcSystem['contact_hotline']?><i class="fa fa-phone" aria-hidden="true"></i></a></div>
<style>
    #ft_hotline {
        background-color: #c10;
        position: fixed;
        top: 75px;
        height: 40px;
        line-height: 37px;
        padding: 0;
        border-radius: 40px;
        color: #fff;
        right: 0px;
        z-index: 99999;
    }
    #ft_hotline a {
        display: block;
        color: #fff;
        font-size: 17px;
        text-decoration: none;
        padding-left: 18px;
    }
    #ft_hotline i {
        font-size: 20px;
        line-height: 32px;
        background: #fff;
        border-radius: 100%;
        width: 36px;
        height: 36px;
        text-align: center;
        float: right;
        border: 3px solid #c90303;
        margin-left: 12px;
        color: #c90303;
        -webkit-animation-name: opacity;
        -webkit-animation-duration: 3s;
        -webkit-animation-iteration-count: infinite;
        animation-name: opacity;
        animation-duration: 2s;
        animation-iteration-count: infinite;
    }
</style>


<link rel="stylesheet" type="text/css" href="template/frontend/asset/css/fonts/font.css">
<link rel="stylesheet" type="text/css" href="template/frontend/asset/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="template/frontend/asset/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="template/frontend/asset/css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="template/frontend/asset/css/owl.theme.default.css">
<link rel="stylesheet" href="template/frontend/asset/css/demo.css?ver=3.3.0">
<link rel="stylesheet" type="text/css" href="template/frontend/asset/css/animate.css">
<!-- <link rel="stylesheet" href="template/frontend/asset/css/swiper.min.css"> -->
<link rel="stylesheet" type="text/css" href="template/frontend/asset/css/style.css">
<link rel="stylesheet" type="text/css" href="template/frontend/asset/css/responsive.css">
<!-- link mobile  -->
<!-- end link mobile -->
<script type="text/javascript" src="template/frontend/asset/js/jquery.min.js"></script>
<style>
    .item-hover-show-text-info{
        display: none;
    }
</style>
<header id="header-site">


    <style>
        @media (min-width: 1023px) {
            #rrrr {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .btn_dowload, .logo-search .item.item2, .logo-search .item.item1 {
                margin-top: 0px;
            }
        }

    </style>
    <?php

    $dropdown = $this->Autoload_Model->_get_where(array('table' => 'product_catalogue', 'select' => 'id, title,canonical', 'order_by' => 'order ASC,id DESC', 'limit' => 11, 'where' => array('publish' => 0, 'parentid' => 0, 'alanguage' => $this->fc_lang)), true);
    if (isset($dropdown) && is_array($dropdown) && count($dropdown)) {
        foreach ($dropdown as $key => $val) {
            $dropdown[$key]['child'] = $this->Autoload_Model->_get_where(array('table' => 'product_catalogue', 'select' => 'id, title,canonical', 'order_by' => 'order ASC,id DESC', 'limit' => 11, 'where' => array('publish' => 0, 'parentid' => $val['id'], 'alanguage' => $this->fc_lang)), true);
        }
    }

    ?>
    <div class="logo-search">
        <div class="container">
            <div class="row" id="rrrr">
                <div class="col-md-2 col-sm-12 col-xs-12">

                    <?php
                    if (!$menumobile = $this->cache->get('menumobile')) {
                        $menumobile = slide(array('keyword' => 'menu-mobile'), $this->fc_lang);
                        $data['menumobile'] = $menumobile;
                        $this->cache->save('menumobile', $menumobile, 300);
                    } else {
                        $data['menumobile'] = $menumobile;
                    }
                    ?>
                    <?php if (isset($menumobile) && is_array($menumobile) && count($menumobile)) { ?>
                        <div id="mySidenav" class="sidenav hidden-md hidden-lg">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                            <div class="image">
                                <img src="<?php echo $this->fcSystem['taimienphi_images'] ?>"
                                     alt="<?php echo $this->fcSystem['taimienphi_title'] ?>">
                                <div class="overlay-img">
                                    <h3 class="title"><?php echo $this->fcSystem['taimienphi_des'] ?></h3>
                                    <a class="btn btn_dowload"
                                       href="<?php echo $this->fcSystem['taimienphi_link'] ?>"><i
                                            class="fas fa-cloud-download-alt"></i><?php echo $this->fcSystem['taimienphi_title'] ?>
                                    </a>
                                </div>
                            </div>
                            <nav class="menu-mobile">
                                <ul>
                                    <?php foreach ($menumobile as $keyP => $valP) { ?>

                                        <li>
                                            <a href="<?php echo $valP['link'] ?>"><img src="<?php echo $valP['src'] ?>"
                                                                                       alt="<?php echo $valP['title'] ?>"><?php echo $valP['title'] ?>
                                            </a>
                                        </li>
                                    <?php } ?>


                                </ul>
                            </nav>
                        </div>
                    <?php } ?>
                    <span onclick="openNav()" class="click-menu hidden-md hidden-lg">&#9776;</span>


                    <!-- begin mobile -->
                    <style>
                        #main-nav {
                            display: none;
                        }
                    </style>

                    <?php /*?>
                     <div class="wrapper cf">
                        <nav id="main-nav">

                            <ul class="second-nav">
                                <?php if (isset($main_nav) && is_array($main_nav) && count($main_nav)) { ?>
                                    <?php foreach ($main_nav as $key => $val) { ?>
                                        <li class="devices">
                                            <a href="<?php echo $val['link']; ?>"><?php echo $val['title']; ?></a>
                                            <?php if (isset($val['children']) && is_array($val['children']) && count($val['children'])) { ?>
                                                <ul>
                                                    <?php foreach ($val['children'] as $keyItem => $valItem) { ?>
                                                        <li class="mobile">
                                                            <a href="<?php echo $valItem['link'] ?>"
                                                               title="<?php echo $valItem['title'] ?>"><?php echo $valItem['title'] ?></a>
                                                            <?php if (isset($valItem['children']) && is_array($valItem['children']) && count($valItem['children'])) { ?>
                                                                <ul>
                                                                    <?php foreach ($val['children'] as $keyItemC => $valItemC) { ?>
                                                                        <li>
                                                                            <a href="<?php echo $valItemC['link'] ?>"><?php echo $valItemC['title'] ?></a>
                                                                        </li>
                                                                    <?php } ?>
                                                                </ul>
                                                            <?php } ?>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                <?php } ?>

                            </ul>
                        </nav>
                        <a class="toggle">
                            <span></span>
                        </a>
                    </div>

                    <!-- end mobile -->
                    <?php */ ?>
                    <a href="<?php echo base_url() ?>" class="logo"><img
                            src="<?php echo $this->fcSystem['homepage_logo'] ?>"
                            alt="<?php echo $this->fcSystem['homepage_company'] ?>"></a>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-12" id="listobject">
                    <form action="tim-kiem.html" method="GET" id="listobjectm">
                        <?php /*?>


                       <!--  <div class="item item1">
                            <?php
                            $dropdown = $this->Autoload_Model->_get_where(array('table' => 'product_catalogue', 'select' => 'id, title, parentid, lft, rgt, level, order', 'order_by' => 'lft ASC, order ASC', 'where' => array('publish' => 0, 'alanguage' => $this->fc_lang)), true);
                            ?>
                            <select class="selInfor select-cate" name="catalogueid" style="background-color: white">
                                <option value="">Danh mục</option>
                                <?php if (isset($dropdown) && is_array($dropdown)) {
                                    foreach ($dropdown as $key => $val) { ?>
                                        <option
                                            <?php if (!empty($_GET['catalogueid'])){ ?><?php if ($val['id'] == $_GET['catalogueid']){ ?>selected<?php } ?><?php } ?>
                                            value="<?php echo $val['id'] ?>"><?php echo str_repeat('|-----', (($val['level'] > 0) ? ($val['level'] - 1) : 0)) . $val['title'] ?></option>
                                    <?php }
                                } ?>
                            </select>

                        </div> -->
                        <?php */ ?>
                        <?php $nationalityDropdown = nationalityDropdown(); ?>

                        <div class="row">
                            <div class="item col-md-3 col-xs-3 col-sm-3 hidden-xs" style="padding-right: 0px">
                                <select name="nationality" style="height: 40px;">
                                    <option value="">Quốc gia</option>

                                    <?php if (!empty($nationalityDropdown)) { ?>

                                        <?php foreach ($nationalityDropdown as $key => $val) { ?>
                                            <option
                                                <?php if (!empty($_GET['product_catalogue_id'])){ ?><?php if ($val['id'] == $_GET['product_catalogue_id']){ ?>selected<?php } ?><?php } ?>
                                                value="<?php echo $val ?>"><?php echo $val ?></option>
                                        <?php } ?>
                                    <?php } ?>

                                </select>
                            </div>
                            <div class="item item2 col-md-9 col-xs-12 col-sm-9 ">

                                <input type="text" name="keyword" placeholder="Tìm cửa hàng, mã giảm giá"
                                       value="<?php echo !empty($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
                                <button type="submit" class="click-search" style="border: 0px;background: transparent"><i class="fas fa-search"></i></button>
                                <span onclick="openNav1()" class="click-search1 hidden-md hidden-lg"><i class="fas fa-sliders-h"></i></span>


                            </div>

                        </div>
                    </form>

                    <div id="mySidenav1" class="sidenav hidden-md hidden-lg">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav1()">&times;</a>
                        <h3 class="title1"><i class="fas fa-sliders-h"></i>Tìm kiếm nâng cao</h3>
                        <ul>
                            <?php if (isset($dropdown) && is_array($dropdown) && count($dropdown)) { ?>
                                <?php foreach ($dropdown as $key => $val) {
                                    $href = rewrite_url($val['canonical'], TRUE, TRUE); ?>
                                    <li>
                                        <a href="<?php echo $href ?>"><?php echo $val['title'] ?></a>
                                    </li>
                                <?php } ?>
                            <?php } ?>

                        </ul>

                    </div>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-12 hidden-xs hidden-sm">
                    <div style="text-align: right;">
                        <div style="display: inline-block;">
                            <?php if (!isset($this->FT_auth['id'])) { ?>
                                <a href="register.html" class="item-app-shop" target="_blank">Đăng ký</a>
                                <a href="login.html" class="item-app-shop" target="_blank">Cửa hàng đăng nhập</a>
                            <?php } else { ?>
                                <a href="information.html" class="item-app-shop"><?php echo $this->FT_auth['account'] ?>
                                    - <?php echo $this->FT_auth['fullname'] ?></a>

                            <?php } ?>

                            <a class="btn btn_dowload" href="<?php echo $this->fcSystem['taimienphi_link'] ?>"><i
                                    class="fas fa-cloud-download-alt"></i><?php echo $this->fcSystem['taimienphi_title'] ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="menu-second hidden-xs hidden-sm">
        <div class="container">
            <div class="row">

                <?php if (isset($dropdown) && is_array($dropdown) && count($dropdown)) { ?>
                    <div class="col-md-2 col-sm-2 col-xs-12" style="width: 20%;padding-right: 0px">
                        <div class="left-secon-menu">
                            <h3 class="title title-header">Danh mục sản phẩm <i class="fas fa-chevron-down"></i></h3>
                            <ul class="sub-sub">
                                <?php foreach ($dropdown as $key => $val) {
                                    $href = rewrite_url($val['canonical'], TRUE, TRUE); ?>
                                    <li>
                                        <a href="<?php echo $href ?>"><?php echo $val['title'] ?>

                                            <?php if (isset($val['child']) && is_array($val['child']) && count($val['child'])) { ?>
                                                <i class="fas fa-angle-double-right"></i>
                                            <?php } ?>

                                        </a>
                                        <?php if (isset($val['child']) && is_array($val['child']) && count($val['child'])) { ?>
                                            <ul class="sub-second-category">
                                                <?php foreach ($val['child'] as $keyue => $value) {
                                                    $hrefvalue = rewrite_url($value['canonical'], TRUE, TRUE); ?>


                                                    <li>
                                                        <a href="<?php echo $hrefvalue ?>"
                                                           class="name-shop">
                                                            <?php echo $value['title'] ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>

                                            </ul>
                                        <?php } ?>
                                    </li>
                                <?php } ?>


                            </ul>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-md-10 col-sm-10 col-xs-12" style="width: 80%">
                    <?php $main_nav = navigation(array('keyword' => 'main', 'output' => 'array'), $this->fc_lang); ?>
                    <?php if (isset($main_nav) && is_array($main_nav) && count($main_nav)) { ?>
                        <div class="menu_top hidden-xs hidden-sm">
                            <nav class="collapse navbar-collapse no_pd" id="bs-navbar">
                                <ul class="nav navbar-nav m-menu-top">
                                    <?php foreach ($main_nav as $key => $val) { ?>
                                        <li><a href="<?php echo $val['link']; ?>"><?php echo $val['title']; ?></a></li>
                                    <?php } ?>
                                </ul>

                            </nav>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</header>
<style>
    #cuahnagnoibatcuahnagnoibat .owl-nav {
        display: none;
    }
</style>
<h1 class="hidden"><?php echo $meta_title?></h1>
<script>
    $('.sub-sub').show();
</script>
<div id="main" class="wrapper">
    <?php if (isset($slide) && is_array($slide) && count($slide)) { ?>

        <div id="slider-home" class="owl-carousel">
            <?php foreach ($slide as $key => $val) { ?>
                <div class="item">
                    <a href="<?php echo $val['link'] ?>"> <img src="<?php echo $val['src'] ?>"  alt="<?php echo $val['title'] ?>"></a>
                </div>
            <?php } ?>
        </div>
        <div class="wapper_slider slider_home hidden-sm hidden-xs">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-12" style="width: 20%"></div>
                    <div class="col-md-8 col-sm-8 col-xs-12" style="width: 62%">
                        <div class="owl-carousel slider-cuahnagnoibat max1023" id="cuahnagnoibatcuahnagnoibat">
                            <?php foreach ($slide as $key => $val) { ?>
                                <div class="item">
                                    <a href="<?php echo $val['link'] ?>">
                                        <img  src="<?php echo $val['src'] ?>"
                                              alt="<?php echo $val['title'] ?>" style="width: 100%;">
                                    </a>

                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <?php
                    if (!$partner_home = $this->cache->get('partner_home')) {
                        $partner_home = slide(array('keyword' => 'partner'), $this->fc_lang);
                        $data['partner_home'] = $partner_home;
                        $this->cache->save('partner_home', $partner_home, 300);
                    } else {
                        $data['partner_home'] = $partner_home;
                    }
                    ?>

                    <div class="col-md-2 col-sm-2 col-xs-12" style="width: 18%;padding-left: 0px">
                        <div class="top-logo">
                            <?php if (isset($partner_home) && is_array($partner_home) && count($partner_home)) { ?>
                                <?php foreach ($partner_home as $keyP => $valP) {
                                    if ($keyP <= 4) { ?>
                                        <div class="item">
                                            <a href="<?php echo $valP['link'] ?>"><img src="<?php echo $valP['src'] ?>"
                                                                                       alt="<?php echo $valP['title'] ?>"></a>
                                        </div>
                                    <?php }
                                }
                            } ?>


                        </div>
                    </div>


                </div>


                <?php /*?>
            <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:460px;overflow:hidden;visibility:hidden;">
                <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">
                    <?php foreach ($slide as $key => $val) { ?>
                    <div>
                        <a href="<?php echo $val['link'] ?>">
                            <img  src="<?php echo $val['src'] ?>">
                        </a>
                        <img data-u="thumb" class="img-responsive" src="<?php echo $val['src'] ?>">
                    </div>
                    <?php }?>
                </div>
                <div data-u="thumbnavigator" class="jssort101" style="position:absolute;left:0px;bottom:7px;width:980px;height:68px;" data-autocenter="1" data-scale-bottom="0.75">
                    <div data-u="slides">
                        <div data-u="prototype" class="p" style="width:190px;height:90px;">
                            <div data-u="thumbnailtemplate" class="t"></div>
                        </div>
                    </div>
                </div>
                <div data-u="navigator" id="navigator_web" class=" jssorb052" style="position:absolute;bottom:100px !important;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                    <div data-u="prototype" class="i" style="width:16px;height:16px;">
                        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                            <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                        </svg>
                    </div>
                </div>
                <div data-u="arrowleft" class="jssora106" style="width:39px;height:39px;top:162px;left:72px;" data-scale="0.75">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div data-u="arrowright" class="jssora106" style="width:39px;height:39px;top:162px;right:72px;" data-scale="0.75">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
            <?php */ ?>
            </div>

        </div>
    <?php } ?>
    <div id="home-wrapper">
        <?php if (isset($mainicon) && is_array($mainicon) && count($mainicon)) { ?>

            <div class="wapper">
                <div class="text-center ">
                    <div class="container ">
                        <div class="row">
                            <ul class="list_extensions list_icon_top">
                                <?php foreach ($mainicon as $key => $val) { ?>
                                    <li class="wow fadeInUp">
                                        <a href="<?php echo $val['link'] ?>">
                                            <figure><img src="<?php echo $val['src'] ?>"
                                                         alt="<?php echo $val['title'] ?>"></figure>
                                            <span class="title"><?php echo $val['title'] ?></span>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>


        <?php if (isset($sanpham) && is_array($sanpham) && count($sanpham)) { ?>
            <div class="category-share">
                <div class="container">
                    <h3 class="title_promotion pull-left wow fadeInUp"> Danh sách sản phẩm <a
                            href="danh-sach-san-pham.html" class="readmore">Xem thêm ></a></h3>
                    <div class="clearfix"></div>
                    <div class="nav-category-sale">
                        <div class="">
                            <div class="slider-sanpham owl-carousel">
                                <?php $j = 0;
                                foreach ($sanpham as $key => $val) {
                                    $j++;

                                    $title = $val['title'];
                                    $href = rewrite_url($val['canonical'], TRUE, TRUE);
                                    $image = getthumb($val['image']);
                                    $getPrice = getPriceFrontend(array('productDetail' => $val));
                                    $description = cutnchar(strip_tags($val['description']), 100);

                                    ?>
                                    <div class="item">
                                        <div class="_list_store  _list_store_detail">
                                            <div class="relatic">
                                                <div class=" item_box">
                                                    <div class="box_pr">
                                                        <?php if (!empty($val['khuyenmai']) && $val['khuyenmai'] != '') { ?>
                                                            <div class="gift"> <?php echo $val['khuyenmai'] ?></div>
                                                        <?php } ?>
                                                        <?php if (!empty($val['time_sale']) && $val['time_sale'] != '') { ?>
                                                            <div class="time_gift">
                                                                <i class="fas fa-clock"></i>
                                                                <span><?php echo countdown($val['time_sale']) ?> ngày</span>
                                                            </div>
                                                        <?php } ?>
                                                        <a class="block-img im_detail" href="<?php echo $href ?>">
                                                            <img src="<?php
                                                            if (file_exists(FCPATH .   $image )) {
                                                                echo  $image ;

                                                            }else{
                                                                echo 'template/not-found.png';
                                                            } ?>" alt="<?php echo $title ?>">
                                                        </a>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                <div class="item_box item-hover-show-text-info campain">
                                                    <a href="<?php echo $href ?>">
                                                        <?php if (!empty($val['mota']) && $val['mota'] != '') { ?>
                                                            <?php echo cutnchar(strip_tags($val['mota']), 300) ?>
                                                        <?php } else { ?>
                                                            <?php echo $title ?>
                                                        <?php } ?>

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
                                                <?php if (!empty($val['customerid'])) { ?>
                                                    <div class=" box_info_res ">
                                                        <div class="info_res row">
                                                            <div class="col-md-10 col-xs-10 col-sm-10 pd8">
                                                                <div class="use-info pull-left">
                                                                    <a class="u-logo"
                                                                       href="thuong-hieu.html?id=<?php echo $val['customerid'] ?>">
                                                                        <img src="<?php
                                                                        if (file_exists(FCPATH .   $val['customer_avatar'] )) {
                                                                            echo  $val['customer_avatar'] ;

                                                                        }else{
                                                                            echo 'template/not-found.png';
                                                                        } ?>"
                                                                             style="display: inline-block;width: 28px;height: 28px;object-fit: cover;border-radius: 100%"
                                                                             alt="<?php echo $title ?>">
                                                                    </a>
                                                                </div>
                                                                <div class="pull-left info_store ">
                                                                    <div class="name_store no_margin">
                                                                        <a href="thuong-hieu.html?id=<?php echo $val['customerid'] ?>">
                                                                            <?php echo $val['customer_account'] ?>
                                                                        </a>
                                                                    </div>
                                                                    <p class="font_defaul address">
                                                                        <?php echo $val['customer_address'] ?>
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
                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>


        <?php
        if (!$dangkycuahang = $this->cache->get('dangkycuahang')) {
            $dangkycuahang = $this->Autoload_Model->_get_where(array(
                'table' => 'page',
                'select' => '`title`,`image`,`description`',
                'where' => array('id' => 27, 'publish' => 0)));

            $this->cache->save('dangkycuahang', $dangkycuahang, 300);
        } else {
            $dangkycuahang = $dangkycuahang;
        }
        ?>
        <?php if ($this->fcDevice == 'desktop') { ?>
            <?php if (!empty($dangkycuahang)) { ?>
                <div class="container dangkydoitac">
                    <h3 class="title_promotion pull-left wow fadeInUp">Đăng ký trở thành đối tác</h3>
                    <div class="clearfix"></div>
                    <div class="box_oper_point wow fadeInUp">
                        <div class="row">
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <div class="box_oper_point-left">
                                    <img src="<?php echo $dangkycuahang['image'] ?>"
                                         alt="<?php echo $dangkycuahang['title'] ?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="box_conten_reg">
                                    <div class="row">
                                        <div class="oper_point_right">
                                            <div class="conten_right">

                                                <div class="box_conten">
                                                    <?php echo $dangkycuahang['description'] ?>
                                                </div>
                                                <div class="btn_reg">
                                                    <a href="register.html">
                                                        Đăng ký trở thành đối tác
                                                    </a>
                                                </div>
                                                <div class="point_bt">hoặc tải ứng dụng cho cửa hàng</div>
                                                <div class="text-center _btn_ud">
                                                    <div class=" pull-left"><a
                                                            href="<?php echo $this->fcSystem['homepage_androi'] ?>"
                                                            target="_blank">
                                                            <img src="template/frontend/asset/images/google.png"
                                                                 alt="google"></a>
                                                    </div>
                                                    <div class="pull-right"><a
                                                            href="<?php echo $this->fcSystem['homepage_ios'] ?>"
                                                            target="_blank">
                                                            <img src="template/frontend/asset/images/app.png" alt="app"></a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if (isset($relaListCustomer) && is_array($relaListCustomer) && count($relaListCustomer)) { ?>

                <div class="list-shop">
                    <div class="container">
                        <h3 class="title_promotion pull-left wow fadeInUp"> Danh sách cửa hàng <a
                                href="danh-sach-cua-hang.html" class="readmore">Xem thêm &gt;</a></h3>
                        <div class="clearfix"></div>
                        <div class="slider-sanpham owl-carousel">
                            <?php foreach ($relaListCustomer as $keyPost => $val) {
                                $hrefC = rewrite_url($val['canonical_catalogue'], TRUE, TRUE); ?>
                                <div class="item">
                                    <div class="_list_store home_list">
                                        <div class="thumbnail">
                                            <a class="block-img" href="thuong-hieu.html?id=<?php echo $val['id'] ?>">
                                                <img src="<?php
                                                if (file_exists(FCPATH .   $val['images'] )) {
                                                    echo  $val['images'] ;

                                                }else{
                                                    echo 'template/not-found.png';
                                                } ?>"
                                                     alt="<?php echo $val['account'] ?>">
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
                                                            <i class=" fa fa-map-marker _location"
                                                               aria-hidden="true"></i>
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
                    </div>
                </div>
            <?php } ?>

        <?php } else { ?>
            <?php if (isset($relaListCustomer) && is_array($relaListCustomer) && count($relaListCustomer)) { ?>

                <div class="list-shop">
                    <div class="container">
                        <h3 class="title_promotion pull-left wow fadeInUp"> Danh sách cửa hàng <a
                                href="danh-sach-cua-hang.html" class="readmore">Xem thêm &gt;</a></h3>
                        <div class="clearfix"></div>
                        <div class="slider-sanpham owl-carousel">
                            <?php foreach ($relaListCustomer as $keyPost => $val) {
                                $hrefC = rewrite_url($val['canonical_catalogue'], TRUE, TRUE); ?>
                                <div class="item">
                                    <div class="_list_store home_list">
                                        <div class="thumbnail">
                                            <a class="block-img" href="thuong-hieu.html?id=<?php echo $val['id'] ?>">
                                                <img src="<?php echo((!empty($val['images'])) ? $val['images'] : 'template/not-found.png'); ?>"
                                                     alt="<?php echo $val['account'] ?>">
                                            </a>
                                            <div class="clearfix"></div>
                                            <div class=" box__info_res">
                                                <div class="_info_res">
                                                    <div class="logo_store">
                                                        <a class="u-logo"
                                                           href="thuong-hieu.html?id=<?php echo $val['id'] ?>">
                                                            <img src="<?php echo $val['avatar'] ?>"
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
                                                            <i class=" fa fa-map-marker _location"
                                                               aria-hidden="true"></i>
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
                    </div>
                </div>
            <?php } ?>

            <?php if (!empty($dangkycuahang)) { ?>
                <div class="container">
                    <h3 class="title_promotion pull-left wow fadeInUp">Đăng ký trở thành đối tác</h3>
                    <div class="clearfix"></div>
                    <div class="box_oper_point wow fadeInUp">
                        <div class="row">
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <div class="box_oper_point-left">
                                    <img src="<?php echo $dangkycuahang['image'] ?>"
                                         alt="<?php echo $dangkycuahang['title'] ?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="box_conten_reg">
                                    <div class="row">
                                        <div class="oper_point_right">
                                            <div class="conten_right">

                                                <div class="box_conten">
                                                    <?php echo $dangkycuahang['description'] ?>
                                                </div>
                                                <div class="btn_reg">
                                                    <a href="register.html">
                                                        Đăng ký trở thành đối tác
                                                    </a>
                                                </div>
                                                <div class="point_bt">hoặc tải ứng dụng cho cửa hàng</div>
                                                <div class="text-center _btn_ud">
                                                    <div class=" pull-left"><a
                                                            href="<?php echo $this->fcSystem['homepage_androi'] ?>"
                                                            target="_blank">
                                                            <img src="template/frontend/asset/images/google.png"
                                                                 alt="google"></a>
                                                    </div>
                                                    <div class="pull-right"><a
                                                            href="<?php echo $this->fcSystem['homepage_ios'] ?>"
                                                            target="_blank">
                                                            <img src="template/frontend/asset/images/app.png" alt="app"></a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>




        <?php  if (isset($ykienkhachhang) && is_array($ykienkhachhang) && count($ykienkhachhang)) { ?>
            <?php foreach ($ykienkhachhang as $key => $val) { ?>
                <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>

                <div class="customer-reviews wow fadeInUp">
                    <div class="container">
                        <h3 class="title_promotion pull-left"><?php echo $val['title']?></h3>
                        <div class="clearfix"></div>
                        <div class="nav-customer-reviews-reviews">
                            <div class="slider-customer owl-carousel">
                            <?php foreach ($val['post'] as $keyP => $valP) { ?>
                                <div class="item">
                                            <div class="item-review">
                                                <div class="info_review">
                                                    <h3 class="title"><?php echo $valP['title']?></h3>
                                                    <p class="desc font_defaul"><?php echo strip_tags($valP['description'])?></p>
                                                </div>
                                                <div class="im_user_review">
                                                    <img src="<?php echo $valP['image']?>">
                                                </div>
                                            </div>
                                            <div class=" item-hover-note-review">
                                                <div class="note_review">

                                                    <h3 class="title"><?php echo $valP['title']?></h3>
                                                    <p class="desc font_defaul"><?php echo strip_tags($valP['description'])?></p>
                                                    <p class="font_defaul conten_review">
                                                        <?php echo $valP['content']?>
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                            <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
            <?php }?>
        <?php } */ ?>
        <?php if (isset($tintuc) && is_array($tintuc) && count($tintuc)) { ?>
            <?php foreach ($tintuc as $key => $val) {
                $hrefT = rewrite_url($val['canonical'], true, true); ?>
                <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                    <div class="new-home home_list ">
                        <div class="container">
                            <h3 class="title_promotion pull-left wow fadeInUp"> <?php echo $val['title'] ?> <a
                                    href="<?php echo $hrefT ?>" class="readmore">Xem thêm &gt;</a></h3>
                            <div class="clearfix"></div>
                            <div class="slider-new owl-carousel">
                                <?php foreach ($val['post'] as $keyP => $valP) {
                                    $href = rewrite_url($valP['canonical'], true, true); ?>
                                    <div class="item">
                                        <div class="item-new">
                                            <div class="image block-img ">
                                                <a href="<?php echo $href ?>"><img src="<?php echo $valP['image'] ?>"
                                                                                   alt="<?php echo $valP['title'] ?>"></a>
                                            </div>
                                            <div class="nav-image">
                                                <p class="font_defaul date"><?php echo $valP['created'] ?></p>
                                                <h3 class="title"><a
                                                        href="<?php echo $href ?>"><?php echo $valP['title'] ?></a>
                                                </h3>
                                            </div>

                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>

    </div>
</div>
<style>
    .left-secon-menu ul.sub-sub {
        display: block;
    }

    @media only screen and (max-width: 812px) {
        .left-secon-menu ul.sub-sub {

            display: none;
        }
    }
</style>
<?php
$this->fcDevice = $this->config->item('fcDevice');

if (!$partner = $this->cache->get('partner')) {
    $partner = slide(array('keyword' => 'partner'), $this->fc_lang);
    $data['partner'] = $partner;
    $this->cache->save('partner', $partner, 300);
} else {
    $data['partner'] = $partner;
}
?>
<?php if (isset($partner) && is_array($partner) && count($partner)) { ?>

    <div class="customer-reviews wow fadeInUp">
        <div class="container">
            <h3 class="title_promotion pull-left">Đối tác</h3>
            <div class="clearfix"></div>
            <div class="nav-customer-reviews-reviews">
                <div class="slider-customer owl-carousel">
                    <?php foreach ($partner as $keyP => $valP) { ?>
                        <div class="item">
                            <img src="<?php echo $valP['src'] ?>" style="height: 82px;object-fit: contain">


                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<footer id="footer-site" class="wow fadeInUp">
    <?php
    if (!$hethongtichdiem = $this->cache->get('hethongtichdiem')) {
        $hethongtichdiem = $this->Autoload_Model->_get_where(array(
            'table' => 'page',
            'select' => '`title`,`image`,`description`',
            'where' => array('id' => 26, 'publish' => 0)));

        $this->cache->save('hethongtichdiem', $hethongtichdiem, 300);
    } else {
        $hethongtichdiem = $hethongtichdiem;
    }
    ?>
    <?php if (!empty($hethongtichdiem)) { ?>
        <?php if (!empty($hethongtichdiem['image'])) { ?>
            <style>
                .top-footer {
                    background-image: url(<?php echo $hethongtichdiem['image']?>);
                    background-repeat: no-repeat;
                    background-size: 100%;
                    padding: 70px 0;
                }
            </style>
        <?php } ?>
        <div class="top-footer">
            <div class="container">
                <h4 class="title"><?php echo $hethongtichdiem['title'] ?></h4>
                <?php echo $hethongtichdiem['description'] ?>
                <ul>
                    <li><a href="<?php echo $this->fcSystem['homepage_androi'] ?>" target="_blank"><img
                                src="template/frontend/asset/images/google.png" alt="google"></a></li>
                    <li><a href="<?php echo $this->fcSystem['homepage_ios'] ?>" target="_blank"><img
                                src="template/frontend/asset/images/app.png" alt="app"></a></li>
                </ul>

            </div>
        </div>
    <?php } ?>


    <div class="footer-bottom">
        <div class="container">
            <div class="contact-info">
                <div class="row">
                    <?php
                    if (!$hotrotructuyen = $this->cache->get('hotrotructuyen')) {
                        $hotrotructuyen = $this->Autoload_Model->_get_where(array(
                            'table' => 'support',
                            'select' => '`fullname`,`phone`',
                            'order_by' => '`id` desc',
                            'where' => array('publish' => 0, 'alanguage' => $this->fc_lang)), true);

                        $this->cache->save('hotrotructuyen', $hotrotructuyen, 300);
                    } else {
                        $hotrotructuyen = $hotrotructuyen;
                    }
                    ?>
                    <?php if (isset($hotrotructuyen) && is_array($hotrotructuyen) && count($hotrotructuyen)) { ?>
                        <?php foreach ($hotrotructuyen as $key => $val) { ?>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="item">
                                    <div class="icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="navicon">
                                        <span class="title"><?php echo $val['fullname'] ?></span>
                                        <a href="" class="phone-footer"><?php echo $val['phone'] ?></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                            </div>
                        <?php } ?>
                    <?php } ?>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="item">
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="navicon">
                                <span class="title">Email</span>
                                <a href="mailto:<?php echo $this->fcSystem['contact_email'] ?>"
                                   class="phone-footer"><?php echo $this->fcSystem['contact_email'] ?></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="content-footer">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item-footer">
                            <a href="<?php echo base_url() ?>" class="logo-footer"><img
                                    src="<?php echo $this->fcSystem['homepage_logo_footer'] ?>"
                                    alt="<?php echo $this->fcSystem['homepage_company'] ?>"></a>
                            <div class="nav-item">
                                <?php echo $this->fcSystem['homepage_info'] ?>
                            </div>
                            <ul class="list-inline">
                                <li><a href="<?php echo $this->fcSystem['social_facebook'] ?>"><i
                                            class="fab fa-facebook-f"></i></a></li>
                                <li><a href="<?php echo $this->fcSystem['social_facebook2'] ?>"><i
                                            class="fab fa-facebook-f"></i></a></li>
                                <li><a href="<?php echo $this->fcSystem['social_google_plus'] ?>"><i
                                            class="fab fa-google-plus-g"></i></a></li>
                                <li><a href=<?php echo $this->fcSystem['social_youtube'] ?>""><i
                                            class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <?php echo $this->load->view('homepage/frontend/common/menufooter') ?>
                </div>
            </div>
        </div>

    </div>


</footer>
<script type="text/javascript" src="template/frontend/asset/js/bootstrap.min.js"></script>
<script type="text/javascript" src="template/frontend/asset/js/wow.min.js"></script>
<script type="text/javascript" src="template/frontend/asset/js/owl.carousel.min.js"></script>
<script src="template/frontend/asset/js/all.js"></script>
<script src="template/frontend/asset/js/hc-offcanvas-nav.js"></script>
<script type="text/javascript" src="template/frontend/asset/js/main.js"></script>
<script>
    //hieu ung wow------------------------------------------
    wow = new WOW(
        {
            animateClass: 'animated',
            offset: 100,
            callback: function (box) {
                console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
            }
        }
    );
    wow.init();


</script>
<style>

    .list-inline a {
        background: #fff;
        border-radius: 100%;
        width: 30px;
        height: 30px;
        float: left;
        text-align: center;
        line-height: 30px;
    }
</style>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function () {
        FB.init({
            xfbml: true,
            version: 'v6.0'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
     attribution=setup_tool
     page_id="104553421187753"
     logged_in_greeting="Xin chào! Tôi có thể giúp gì được cho bạn!"
     logged_out_greeting="Xin chào! Tôi có thể giúp gì được cho bạn!" data-width="44px">
</div>
<div class="call-btn">

    <div class="tada">
        <a href="tel:<?php echo $this->fcSystem['contact_hotline'] ?>">

        </a>
    </div>
</div>
<div class="fixed_custom_contact">
    <ul>
        <li class="call_zalo"><a href="http://zalo.me/<?php echo $this->fcSystem['social_zalo']?>" target="_blank"></a></li>
    </ul>
</div>