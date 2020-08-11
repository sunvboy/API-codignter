<?php   if (!$icon = $this->cache->get('icon')) {
    $icon = slide(array('keyword' => 'partner'), $this->fc_lang);
    $data['icon'] = $icon;
    $this->cache->save('icon', $icon, 200);
} else {
    $data['icon'] = $icon;
} if (isset($icon) && is_array($icon) && count($icon)) { ?>

    <section id="partner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mbr-section-title">
                        <span>Đối tác</span>
                    </h2>

                    <div class="mt20 clearfix"></div>
                    <div class="slider-product-other owl-carousel">


                        <?php foreach ($icon as $key => $val) { ?>
                            <div class="item">
                                <a href="<?php echo $val['link'] ?>" target="_blank"> <img
                                            src="<?php echo $val['src'] ?>" alt="<?php echo $val['title'] ?>"></a>
                            </div>
                        <?php } ?>
                    </div>

                </div>

            </div>

        </div>

    </section>
<?php } ?>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-12 col-sm-6 footer_logo">
                <p>
                    <a href="<?php echo base_url()?>"><img alt="<?php echo $this->fcSystem['homepage_company']?>" src="<?php echo $this->fcSystem['homepage_logofooter']?>"/></a>
                </p>

                <div class="clearfix"></div>
                <p>
                    <br/><strong>VĂN PHÒNG:</strong><br/>
                    <br/>
                    <regular><?php echo $this->fcSystem['contact_address']?><br/>
                    </regular>
                </p>

                <p>
                    <strong>Hotline:</strong> <?php echo $this->fcSystem['contact_hotline']?><br/>
                    <strong>Email:</strong>
                    <a href="mailto:<?php echo $this->fcSystem['contact_email']?>"
                    ><?php echo $this->fcSystem['contact_email']?></a
                    >
                </p>

                <p><?php echo $this->fcSystem['homepage_copyright']?><br></p>

            </div>
            <?php echo $this->load->view('homepage/frontend/common/menufooter') ?>


            <div class="clearfix visible-sm visible-xs"></div>
            <div class="col-md-3 col-xs-12 col-sm-6 footer_logo">
                <h4 class="mkdf-widget-title">THEO DÕI CHÚNG TÔI</h4>

                <div class="clearfix"></div>

                <div class="textwidget">
                    <p>
                        <a href="<?php echo $this->fcSystem['social_facebook']?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook-official"></i></a>&nbsp;&nbsp;
                        <a href="<?php echo $this->fcSystem['social_youtube']?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-youtube-play"></i></a>&nbsp;&nbsp;
                        <a href="<?php echo $this->fcSystem['social_instagram']?>" target="_blank" rel="noopener noreferrer"><i  class="fa fa-instagram"></i></a>
                    </p>
                </div>

            </div>
            <div class="col-md-3 col-xs-12 col-sm-6">
                <h4 class="mkdf-widget-title">HỆ THỐNG TRUNG TÂM</h4>

                <div class="clearfix"></div>

                <div class="textwidget">
                    <img src="<?php echo $this->fcSystem['banner_banner2']?>" alt="HỆ THỐNG TRUNG TÂM">
                </div>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript" src="template/frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="template/frontend/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="template/frontend/js/wow.min.js"></script>
<script type="text/javascript" src="template/frontend/js/hc-offcanvas-nav.js?ver=3.3.0"></script>
<script type="text/javascript" src="template/frontend/js/main.js?ver=3.3.0"></script>
<script>
    if (window.innerWidth > 768) {
        $(window).scroll(function () {
            if ($(window).scrollTop() >= 100) {
                $('header').addClass('fixed');
            } else {
                $('header').removeClass('fixed');
            }
        });
    }
    if (window.innerWidth > 320) {
        $(window).scroll(function () {
            if ($(window).scrollTop() >= 100) {
                $('header').addClass('clearfix');
            } else {
                $('header').removeClass('clearfix');
            }
        });
    }
</script>
<style>
    header.fixed{
        position: fixed;
        width: 100%;
        left: 50%;
        transform: translateX(-50%);
        top: 0px;
        z-index: 999;
        background: #fff;
    }
    .call-btn {
        position: fixed;
        margin: 0;
        padding: 0;
        left: 0px;
        bottom: 0px;
        background: #fff;
        background-color: transparent;
        cursor: pointer;
        font-size: 0;
        width: 80px;
        height: 80px;
        z-index: 1000;
    }

    .call-btn .zoomIn {
        width: 80px;
        height: 80px;
        border: 2px solid #DA251D;
        border-radius: 100px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -40px;
        margin-left: -40px;
        animation-name: zoomIn;
        animation-duration: 1s;
        animation-iteration-count: infinite;
        animation-timing-function: ease-out;
        opacity: .2;
    }

    .call-btn .pulse {
        width: 50px;
        height: 50px;
        background: #DA251D;
        border-radius: 100px;
        position: absolute;
        opacity: .3;
        top: 44%;
        left: 44%;
        margin-top: -20px;
        margin-left: -20px;
        animation-name: pulse;
        animation-duration: .5s;
        animation-iteration-count: infinite;
        animation-direction: alternate;
        animation-timing-function: ease-in-out;
    }

    .call-btn .tada {
        background: #fff;
        border-radius: 100px;
        width: 40px;
        height: 40px;
        position: absolute;
        left: 50%;
        top: 50%;
        margin-top: -20px;
        margin-left: -20px;
        animation-name: tadaa;
        animation-duration: .5s;
        animation-iteration-count: infinite;
        animation-direction: alternate;
    }

    .call-btn .tel {
        position: absolute;
        top: 50%;
        left: 25px;
        color: #fff;
        font-size: 17px;
        width: 150px;
        text-align: center;
        padding-left: 30px;
        -webkit-transform: translate(0, -50%);
        -ms-transform: translate(0, -50%);
        -o-transform: translate(0, -50%);
        transform: translate(0, -50%);
        line-height: 25px;
        border: 1px solid #DA251D;
        border-radius: 20px;
        background: #DA251D;
        z-index: -1;
        font-weight: 700;
        font-family: Arial;
        text-shadow: 1px 1px 2px #5f5f5f;
    }

    .call-btn .tada a:before {
        content: "";
        font-size: 25px;
        background: #DA251D url(template/frontend/images/icon_page.png) -2px -110px no-repeat;
        text-decoration: none;
        color: #1b7fc5;
        margin-left: -2px;
        position: absolute;
        top: 50%;
        margin-top: -22px;
        width: 44px;
        height: 44px;
        border-radius: 100%;
    }

</style>
<div class="call-btn">
    <div class="zoomIn"></div>
    <div class="pulse"></div>
    <div class="tada"><a href="tel:<?php echo $this->fcSystem['contact_hotline']?>"></a></div>
</div>