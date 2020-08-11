
<div id="main" class="wrapper main-services main-tour-list">
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
    <section class="last-rental wow fadeInUp">
        <div class="container">
            <div class="center">
                <h2 class="title-primary"><?php echo $detailCatalogue['title']?></h2>
            </div>
            <div class="row">
                <?php if (isset($tourList) && is_array($tourList) && count($tourList)) { ?>
                <?php foreach ($tourList as $key => $val) {
                    $href = rewrite_url($val['canonical'], true, true);
                    $getPrice = getPriceFrontend(array('productDetail' => $val));
                    $description = cutnchar(strip_tags($val['description']), 200);
                    $detailDuration = $this->Autoload_Model->_get_where(array(
                        'select' => 'title',
                        'table' => 'attribute',
                        'where' => array('id' =>  $val['duration'])
                    ));
                    ?>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <div class="item">
                                <div class="image">
                                    <a href="<?php echo $href?>"><img src="<?php echo $val['image']?>" alt="<?php echo $val['title']?>"></a>
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
                        </div>

                    <?php }?>
                <?php }?>

            </div>
            <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

        </div>
    </section>

</div>
