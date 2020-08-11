<main class="">
    <section id="slide-main" style="position: relative">
        <img src="<?php echo $productDetail['image']; ?>" alt="<?php echo $productDetail['title']; ?>">
        <div class="poab container hidden-xs" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%);margin: 0px auto;">
            <div class="tt-1 cl-purple" style="color: #6731ad;text-align: left;font-size: 34px;font-family: 'BalooPaaji-Regular';line-height: 1.2;text-transform: uppercase;">
                <?php echo $productDetail['title_image']; ?><br><?php echo $productDetail['description_image']; ?>
            </div>
        </div>
    </section>
    <section id="section_inner" style="background: #f6f6f6">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12">

                    <h2 style="color: #8bc800 !important"><?php echo $productDetail['title']; ?> CÓ GÌ KHÁC BIỆT</h2>
                </div>
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div class="dsc" style="text-align: justify; color: #000;"><?php echo $productDetail['description']; ?>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="clearfix-40 visible-xs"></div>
                <div class="list_section_inner">
                    <?php $content_tab = json_decode($productDetail['content_tab'],TRUE)?>
                    <?php $content_tab_1 = json_decode($productDetail['content_tab_1'],TRUE)?>
                    <?php $content_tab_2 = json_decode($productDetail['content_tab_2'],TRUE)?>
                    <ul>
                        <?php if(!empty($content_tab)){?>
                        <li class="active"><a data-toggle="tab" href="#home"><?php echo $content_tab['1']?></a></li>
                        <?php }?>
                        <?php if(!empty($content_tab_1)){?>
                        <li><a data-toggle="tab" href="#menu1"><?php echo $content_tab_1['1']?></a></li>
                        <?php }?>
                        <?php if(!empty($content_tab_2)){?>
                        <li><a data-toggle="tab" href="#menu2"><?php echo $content_tab_2['1']?></a></li>
                        <?php }?>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="tab-content">
                        <?php if(!empty($content_tab)){?>
                        <div id="home" class="tab-pane fade in active">
                            <div class="col-md-6 col-xs-12 col-sm-6">
                                <div class="text-box">
                                    <?php echo $content_tab['2']?>
                                </div>
                            </div>
                            <div class="visible-xs clearfix-40"></div>
                            <div class="col-md-6 col-xs-12 col-sm-6">
                                <img src="<?php echo $content_tab['0']?>" alt="<?php echo $content_tab['1']?>" class="w100">

                            </div>
                        </div>
                        <?php }?>
                        <?php if(!empty($content_tab_1)){?>
                        <div id="menu1" class="tab-pane fade">
                            <div class="col-md-6 col-xs-12 col-sm-6">
                                <div class="text-box">
                                    <?php echo $content_tab_1['2']?>
                                </div>
                            </div>
                            <div class="visible-xs clearfix-40"></div>
                            <div class="col-md-6 col-xs-12 col-sm-6">
                                <img src="<?php echo $content_tab_1['0']?>" alt="<?php echo $content_tab_1['1']?>" class="w100">
                            </div>
                        </div>
                        <?php }?>
                        <?php if(!empty($content_tab_2)){?>
                        <div id="menu2" class="tab-pane fade">
                            <div class="col-md-6 col-xs-12 col-sm-6">
                                <div class="text-box">
                                    <?php echo $content_tab_2['2']?>
                                </div>
                            </div>
                            <div class="visible-xs clearfix-40"></div>
                            <div class="col-md-6 col-xs-12 col-sm-6">
                                <img src="<?php echo $content_tab_2['0']?>" alt="<?php echo $content_tab_2['1']?>" class="w100">
                            </div>
                        </div>
                        <?php }?>

                    </div>

                </div>


            </div>

        </div>
        <div style="padding: 60px 0 0;">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="tt-2">
                            <h3>LỘ TRÌNH ĐÀO TẠO <?php echo $productDetail['title']; ?></h3>
                            <p class=""><a class="js-show-register" href="#">Đăng kí khoá học</a></p>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <div class="dsc" style="display: flex; flex-direction: column;">
                            <?php echo $productDetail['content']; ?>
                        </div>

                    </div>

                </div>

            </div>

        </div>


    </section>
    <section style="padding: 35px 0">
        <div class="container">
            <img src="<?php echo $productDetail['icon_hot']; ?>" alt="<?php echo $productDetail['title']; ?>" class="w100">
        </div>
    </section>
    <?php $content_info = json_decode($productDetail['content_info'],TRUE)?>
    <?php  if (isset($content_info['title']) && is_array($content_info['title']) && count($content_info['title'])){ ?>
    <section id="thongtinC">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <div class="tt-2">
                        <h3>Thông tin về <?php echo $productDetail['title']; ?></h3>
                    </div>

                </div>
                <div class="clearfix-40 visible-xs"></div>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <div class="align-items-center">

                        <?php foreach($content_info['title'] as $key => $val){ ?>
                        <div class="blog-icon"><span class="number <?php if($key==0){?>bg-red<?php }else if($key==1){?>bg-purple<?php }else if($key==2){?>bg-green<?php }else{?>bg-orange<?php }?>" ><?php echo $val; ?></span><br>  <?php echo $content_info['description'][$key]; ?></div>

                        <?php }?>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <?php }?>

</main>
