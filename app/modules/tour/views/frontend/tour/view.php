<?php
$prd_info = getPriceFrontend(array('productDetail' => $tourDetail));
$prd_href = rewrite_url($tourDetail['canonical']);
$list_image = json_decode(base64_decode($tourDetail['image_json']), TRUE);
?>
<div id="main" class="wrapper main-car-detail main-cars-list">
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url()?>"><?php echo $this->lang->line('home')?> </a></li>
                <?php foreach ($breadcrumb as $key => $val) { ?>
                    <?php
                    $title = $val['title'];
                    $href = rewrite_url($val['canonical'], true, true);
                    ?>
                    <li><a href="<?php echo $href ?>"> / <?php echo $title ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <section class="content-services-detail">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="services-detail-left">
                        <h1 class="title-pr"><?php echo $tourDetail['title']; ?></h1>
                        <p class="price">$ <?php echo $prd_info['price_final'] ?></p>
                        <?php if (isset($list_image) && is_array($list_image) && count($list_image)) { ?>

                        <div class="slider-services-detail owl-carousel">

                            <?php foreach ($list_image as $key => $val) { ?>
                            <div class="item">
                                <img src="<?php echo $val; ?>" alt="<?php echo $tourDetail['title']; ?>">
                            </div>
                            <?php }?>
                        </div>
                        <?php }?>
                    </div>
                </div>

                <?php
                $attribute_catalogues = $this->Autoload_Model->_get_where(array(
                    'select' => 'id, title,image',
                    'table' => 'attribute_catalogue',
                    'where' => array('tour' => 1,'ishome' => 1, 'publish' => 0,  'alanguage' => $this->fclang)), TRUE);
                if (isset($attribute_catalogues) && is_array($attribute_catalogues) && count($attribute_catalogues)) {
                    foreach ($attribute_catalogues as $key => $val) {
                        $attribute_catalogues[$key]['post'] = $this->Autoload_Model->_get_where(array(
                            'select' => 'id, title',
                            'table' => 'attribute',
                            'order_by' => 'order asc,id desc',
                            'where' => array('publish' => 0, 'catalogueid' => $val['id'], 'alanguage' => $this->fclang)), TRUE);
                    }
                }


                $attribute_catalogues_noneishome = $this->Autoload_Model->_get_where(array(
                    'select' => 'id, title,image',
                    'table' => 'attribute_catalogue',
                    'where' => array('tour' => 1,'ishome' => 0, 'publish' => 0,  'alanguage' => $this->fclang)), TRUE);
                if (isset($attribute_catalogues_noneishome) && is_array($attribute_catalogues_noneishome) && count($attribute_catalogues_noneishome)) {
                    foreach ($attribute_catalogues_noneishome as $key => $val) {
                        $attribute_catalogues_noneishome[$key]['post'] = $this->Autoload_Model->_get_where(array(
                            'select' => 'id, title',
                            'table' => 'attribute',
                            'order_by' => 'order asc,id desc',
                            'where' => array('publish' => 0, 'catalogueid' => $val['id'], 'alanguage' => $this->fclang)), TRUE);
                    }
                }

                $attribute_checked = $this->Autoload_Model->_get_where(array(
                    'select' => 'moduleid,attrid',
                    'table' => 'attribute_relationship',
                    'where' => array('module' => 'tour', 'moduleid' => $tourDetail['id'])), TRUE);
                $temp = [];
                if(isset($attribute_checked) && is_array($attribute_checked) && count($attribute_checked)){
                    foreach($attribute_checked as $key => $val){
                        $temp[] = $val['attrid'];
                    }
                }
                ?>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="sidebar-right">
                        <?php if(!empty($temp)){?>
                        <?php if (isset($attribute_catalogues) && is_array($attribute_catalogues) && count($attribute_catalogues)) { ?>
                            <div class="information-sidebar1">
                                <div class="nav-infomation-sb1">
                                    <?php foreach ($attribute_catalogues as $key => $val) { ?>
                                    <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                                        <div class="item">
                                            <div class="icon">
                                                <img src="<?php echo $val['image']; ?>" alt="<?php echo $val['title']; ?>">
                                            </div>
                                            <div class="nav-icon">
                                                <h3 class="title1"><?php echo $val['title']; ?></h3>
                                                <?php foreach ($val['post'] as $keyP => $valP) { ?>
                                                    <?php if(in_array($valP['id'], $temp) == true){?>
                                                        <p class="desc"> <?php echo $valP['title']; ?> </p>
                                                    <?php }?>
                                                <?php }?>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <?php }?>

                                    <?php }?>
                                </div>
                            </div>
                        <?php }?>
                        <?php }?>
                        <?php if(!empty($temp)){?>

                        <?php if (isset($attribute_catalogues_noneishome) && is_array($attribute_catalogues_noneishome) && count($attribute_catalogues_noneishome)) { ?>
                            <?php foreach ($attribute_catalogues_noneishome as $key => $val) { ?>
                                <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                                <div class="list-infomation-sb">
                                    <h3 class="title"><?php echo $val['title']; ?></h3>
                                    <ul>
                                        <?php foreach ($val['post'] as $keyP => $valP) { ?>
                                            <?php if(in_array($valP['id'], $temp) == true){?>
                                                <li>
                                                    <?php echo $valP['title']; ?>
                                                </li>
                                            <?php }?>
                                        <?php }?>
                                    </ul>
                                </div>
                                <?php }?>
                            <?php }?>
                        <?php }?>
                        <?php }?>


                        <div class="holine-sb">
                            <a href="book-tour.html?id=<?php echo $tourDetail['id']?>"><span class="icon"><i class="fas fa-shopping-cart"></i></span><?php echo $this->lang->line('Book_tour')?></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="content-accor">
        <div class="container">
            <div id="accordion" class="accordion-container">


                <?php if (isset($prdExtendDesc) && is_array($prdExtendDesc) && count($prdExtendDesc)) { ?>
                    <?php foreach ($prdExtendDesc as $key => $val) { ?>
                        <article class="content-entry <?php if ($key == 0) { ?>open<?php } ?>">
                            <h4 class="article-title"><i></i><?php echo $val['title'] ?></h4>
                            <div class="accordion-content" <?php if ($key == 0){ ?>style="display: block;"<?php } ?>>
                                <?php echo $val['desc'] ?>
                            </div>
                        </article>
                    <?php } ?>
                <?php } ?>


            </div>
            <!--/#accordion-->
        </div>


    </div>
    <?php if (isset($relaList) && is_array($relaList) && count($relaList)) { ?>
    <section class="category-home last-rental tour-other">
        <div class="container">
            <h2 class="title-primary"><?php echo $this->lang->line('Other_tours')?></h2>

            <div class="nav-category-home ">
                <div class="slider-car owl-carousel">
                    <?php foreach ($relaList as $key => $val) {
                        $href = rewrite_url($val['canonical'], true, true);
                        $getPrice = getPriceFrontend(array('productDetail' => $val));
                        $description = cutnchar(strip_tags($val['description']), 200);
                        $detailDuration = $this->Autoload_Model->_get_where(array(
                            'select' => 'title',
                            'table' => 'attribute',
                            'where' => array('id' =>  $val['duration'])
                        ));
                        ?>

                    <div class="item">
                        <div class="image">
                            <a href="<?php echo $href?>"><img src="<?php echo $val['image']?>" alt=""></a>
                        </div>
                        <div class="nav-image">
                            <h3 class="title"><a href="<?php echo $href?>"><?php echo $val['title']?> </a>
                            </h3>
                            <div class="price-adress">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <span class="price">$ <?php echo $getPrice['price_final'] ?></span>
                                    </div>
                                    <?php if(!empty($detailDuration)){?>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <span class="adress-item"><img src="template/frontend/images/icon4.png" alt="<?php echo $detailDuration['title']?>"><?php echo $detailDuration['title']?></span>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                            <p class="desc"><?php echo $description?></p>
                            <div class="avt-add-to-cart">
                                <div class="add-to-cary">
                                    <button onclick="location.href='<?php echo $href?>';"><?php echo $this->lang->line('view_more')?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>

                </div>
            </div>
        </div>
    </section>
    <?php }?>

</div>