<main class="">
    <?php if (isset($slide) && is_array($slide) && count($slide)) { ?>

        <section id="slide-main">
            <div id="slider-home" class="owl-carousel">
                <?php foreach ($slide as $key => $val) { ?>
                    <div class="item">
                        <a href="<?php echo $val['link'] ?>"> <img src="<?php echo $val['src'] ?>"
                                                                   alt="<?php echo $val['title'] ?>"></a>
                    </div>
                <?php } ?>
            </div>
        </section>
    <?php } ?>
    <?php if (isset($apax) && is_array($apax) && count($apax)) { ?>
        <?php foreach ($apax as $key => $val) { ?>
            <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                <section id="section_inner">
                    <div class="container">
                        <div class="row">
                            <h2><?php echo $val['title'] ?></h2>
                            <div class="clearfix"></div>
                            <div class="list_section_inner">
                                <ul class="">
                                    <?php foreach ($val['post'] as $keyP => $valP) { ?>

                                        <li class="<?php if ($keyP == 0) { ?>active<?php } ?>"><a data-toggle="tab"
                                                                                                  href="#home<?php echo $keyP ?>"><?php echo $valP['title'] ?></a>
                                        </li>
                                    <?php } ?>

                                </ul>

                                <div class="clearfix"></div>
                                <div class="tab-content">
                                    <?php foreach ($val['post'] as $keyP => $valP) { ?>

                                        <div id="home<?php echo $keyP ?>"
                                             class="tab-pane fade in <?php if ($keyP == 0) { ?>active<?php } ?>">
                                            <div class="col-md-6 col-xs-12 col-sm-6">
                                                <div class="text-box">
                                                    <?php echo $valP['description'] ?>
                                                </div>

                                            </div>
                                            <div class="visible-xs clearfix-40"></div>
                                            <div class="col-md-6 col-xs-12 col-sm-6">
                                                <img src="<?php echo $valP['image'] ?>"
                                                     alt="<?php echo $valP['title'] ?>" class="w100">

                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>

                            </div>


                        </div>

                    </div>

                </section>
            <?php } ?>
        <?php } ?>
    <?php } ?>

    <?php if (isset($cogidangdienra) && is_array($cogidangdienra) && count($cogidangdienra)) { ?>
        <?php foreach ($cogidangdienra as $key => $val) {
            $hrefT = rewrite_url($val['canonical'], true, true); ?>
            <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                <section id="project">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <h2 class="mbr-section-title">
                                    <span><?php echo $val['title'] ?></span>
                                </h2>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                <div class="box_project slider-product-other1 owl-carousel owl-theme">
                                    <?php $i = 0;
                                    foreach ($val['post'] as $keyP => $valP) {
                                        $i++;
                                        $href = rewrite_url($valP['canonical'], true, true); ?>
                                        <div class="item">
                                            <div class="project-box">
                                                <a href="<?php echo $href ?>">
                                                    <img src="<?php echo $valP['image'] ?>"
                                                         alt="<?php echo $valP['title'] ?>"/>
                                                </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>


                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>
        <?php } ?>
    <?php } ?>


    <?php if (isset($bannerhome) && is_array($bannerhome) && count($bannerhome)) { ?>
    <section id="courses_home">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <h2>
                       <?php echo $this->fcSystem['title_title1']?> <br/><span style="font-weight: 300;"> <?php echo $this->fcSystem['title_title2']?>.</span>
                    </h2>
                    <div class="clearfix"></div>
                    <div class="row">

                        <?php foreach ($bannerhome as $keyP => $valP) { ?>
                        <div class="col-md-3 col-xs-12 col-sm-3 courses courses<?php echo $keyP+1?>">
                            <div class="courses-height">
                                <h3>
                                    <a href="<?php echo $valP['link']?>">
                                        <span class="line1 hidden">Tiếng Anh</span>
                                        <span class="line2"><?php echo $valP['title']?></span>
                                    </a>
                                </h3>

                            </div>
                            <div class="courses-p">
                                <p>
                                    <a href="<?php echo $valP['link']?>">Xem thêm
                                        <img src="template/frontend/images/arrow-courses.png"  style="margin: 1px 0px 0px 3px;" alt="arrow"/>

                                    </a>
                                </p>
                                <a href="<?php echo $valP['link']?>">
                                    <img src="<?php echo $valP['src']?>" class="img-responsive" style="height: 384px;object-fit: cover" alt="<?php echo $valP['title']?>"/>
                                </a>
                            </div>

                        </div>
                        <?php } ?>


                    </div>

                </div>
            </div>
        </div>
    </section>
    <?php } ?>

    <?php if (isset($tintuc) && is_array($tintuc) && count($tintuc)) { ?>
        <?php foreach ($tintuc as $key => $val) {
            $hrefT = rewrite_url($val['canonical'], true, true); ?>
            <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                <section id="blog">
                    <div class="container">
                        <div class="row">
                            <h2><?php echo $val['title'] ?></h2>
                            <div class="clearfix mt20"></div>

                            <?php $i = 0;
                            foreach ($val['post'] as $keyP => $valP) {
                                $i++;
                                $href = rewrite_url($valP['canonical'], true, true); ?>
                                <div class="col-md-6 col-xs-12 col-sm-6">
                                    <div class="box_blogs row">
                                        <div class="col-md-6 col-xs-6 col-sm-6">
                                            <a href="<?php echo $href ?>"><img src="<?php echo $valP['image'] ?>"
                                                                               alt="<?php echo $valP['title'] ?>"
                                                                               class="w100"></a>
                                        </div>
                                        <div class="col-md-6 col-xs-6 col-sm-6">

                                            <h3><a href="<?php echo $href ?>"><?php echo $valP['title'] ?></a>
                                            </h3>
                                            <div class="clearfix"></div>
                                            <div class="box_date_blogs" style="width: 100%;text-align: left">

                                                <div class="month"><?php echo $valP['created'] ?></div>

                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <?php if ($i % 2 == 0) { ?>
                                    <div class="clearfix"></div><?php } ?>
                            <?php } ?>
                        </div>

                    </div>

                </section>
            <?php } ?>
        <?php } ?>
    <?php } ?>
    <?php if (isset($ykienkhachhang) && is_array($ykienkhachhang) && count($ykienkhachhang)) { ?>
        <?php foreach ($ykienkhachhang as $key => $val) { ?>
            <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                <section id="ykienkhachhang">
                    <div class="container">
                        <div class="">
                            <h2><?php echo $val['title'] ?></h2>

                            <div class="ykien owl-carousel owl-theme">
                                <?php foreach ($val['post'] as $keyP => $valP) { ?>

                                    <div class="item">
                                        <div class="info_ykienkhachhang">
                                            <div class="img_ykienkhachhang">
                                                <img src="<?php echo $valP['image'] ?>"
                                                     alt="<?php echo $valP['title'] ?>">

                                                <div class="poss">+</div>
                                            </div>
                                            <div class="title_ykienkhachhang">
                                                <b><?php echo $valP['title'] ?></b>

                                                <div class="clearfix"></div>
                                                <p><?php echo strip_tags($valP['description']) ?></p>

                                            </div>
                                        </div>
                                        <div class="clearfix "></div>
                                        <div class="des_ykienkhachhang mt20">
                                            <p> <?php echo strip_tags($valP['content']) ?>
                                            </p>

                                        </div>


                                    </div>
                                <?php } ?>

                            </div>

                        </div>

                    </div>

                </section>
            <?php } ?>
        <?php } ?>
    <?php } ?>
    <?php echo $this->load->view('homepage/frontend/common/mailsubricre') ?>



</main>