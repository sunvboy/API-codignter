<div id="js_prd_info" data-info="<?php echo $data_info ?>"
     data-price="<?php echo $productDetail['price'] ?>"
     data-price_sale="<?php echo $productDetail['price_sale'] ?>"
     data-price_contact="<?php echo $productDetail['price_contact'] ?>"
     data-id="<?php echo $productDetail['id'] ?>"
     data-name="<?php echo $productDetail['title'] ?>"
     data-redirect="false">

</div>
<div id="quantity" data-quantity="1"></div>
<?php
$prd_title = $productDetail['title'];
$prd_code = $productDetail['code'];
$prd_info = getPriceFrontend(array('productDetail' => $productDetail));

$prd_href = rewrite_url($productDetail['canonical']);
$comment = comment(array('id' => $productDetail['id'], 'module' => 'product'));
$prd_rate = '';
if (isset($comment) && is_array($comment) && count($comment)) {
    $prd_rate = round($comment['statisticalRating']['averagePoint']);
}
$list_image = json_decode(base64_decode($productDetail['image_json']), TRUE);
?>
<div id="main" class="wrapper">
    <div class="main-product-detail">
        <div class="container-fluid">
            <div class="row">
                <?php if (isset($list_image) && is_array($list_image) && count($list_image)) { ?>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="product-detail-left">

                            <nav class="fixed-detail">


                                <div class="collapse navbar-collapse" id="navbarNav">

                                    <ul class="navbar-nav">
                                        <?php foreach ($list_image as $key => $val) { ?>

                                            <li class="nav-item <?php if($key==0){?>active<?php }?>">
                                                <a class="nav-link scroll" href="#top<?php echo $key?>"></a>
                                            </li>

                                        <?php }?>

                                    </ul>

                                </div>

                            </nav>
                            <div class="content-detail-left">
                                <?php foreach ($list_image as $key => $val) { ?>

                                    <div id="top<?php echo $key?>">
                                        <img src="<?php echo $val; ?>" alt="<?php echo $productDetail['title']; ?>">
                                    </div>

                                <?php }?>

                            </div>


                        </div>
                    </div>
                <?php }?>

                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="product-detail-right">
                        <h3 class="title"><?php echo $productDetail['title']; ?></h3>
                        <p class="price"><?php echo $prd_info['price_final'] ?></p>
                        <p class="desc-short">
                            <?php echo $productDetail['description']; ?>
                        </p>
                        <?php
                        $version_json = json_decode(base64_decode($productDetail['version_json']), true);
                        $attribute_catalogue= $version_json[1];
                        if(isset($attribute_catalogue) && is_array($attribute_catalogue) && count($attribute_catalogue)){
                            foreach ($attribute_catalogue as $key => $value) {
                                if($value == 5){
                                    if(isset($version_json[2][$key]) && is_array($version_json[2][$key]) && count($version_json[2][$key])){
                                        $color= $this->Autoload_Model->_get_where(array(
                                            'select' => 'id, title, color',
                                            'table' => 'attribute',
                                            'where_in' => $version_json[2][$key],
                                            'where_in_field' => 'id',
                                        ),true);
                                        foreach ($color as $keyC => $valueC) {
                                            $colorArr[$valueC['id']]['title'] = $valueC['title'];
                                            $colorArr[$valueC['id']]['color'] = $valueC['color'];
                                        }
                                    }
                                }elseif ($value = 9){
                                    if(isset($version_json[2][$key]) && is_array($version_json[2][$key]) && count($version_json[2][$key])){
                                        $size= $this->Autoload_Model->_get_where(array(
                                            'select' => 'id, title',
                                            'table' => 'attribute',
                                            'where_in' => $version_json[2][$key],
                                            'where_in_field' => 'id',
                                        ),true);
                                        foreach ($size as $keyS => $valueS) {
                                            $sizeArr[$valueS['id']]['title'] = $valueS['title'];
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                        <?php if(isset($colorArr) && is_array($colorArr) && count($colorArr)){?>
                            <div class="chose-color">
                                <h4 class="title1">Màu sắc (<?php echo count($colorArr)?>)</h4>
                                <ul class="chose-image">
                                    <?php $i=0; foreach ($colorArr as $keyC=>$valC){ $i++;?>
                                        <li>
                                            <a data-title="<?php echo $valC['title']?>" data-type="color" class="chose_attr_advanced <?php if($i==1){?>active<?php }?>" href="javascript:void(0);" style="background: <?php echo $valC['color']?>"></a>
                                        </li>
                                    <?php }?>

                                </ul>
                            </div>
                        <?php }?>

                        <?php if(isset($sizeArr) && is_array($sizeArr) && count($sizeArr)){?>
                            <div class="chose-color">
                                <h4 class="title1">Size (<?php echo count($sizeArr)?>)</h4>
                                <ul class="chose-image">
                                    <?php $i=0; foreach ($sizeArr as $keyS=>$valS){ $i++;?>
                                        <li>
                                            <a data-title="<?php echo $valS['title']?>" data-type="size" class="chose_attr_advanced size <?php if($i==1){?>active<?php }?>" href="javascript:void(0);"><?php echo $valS['title']?></a>
                                        </li>
                                    <?php }?>

                                </ul>
                            </div>
                        <?php }?>

                        <?php /*?>
                        <div class="select-chip">
                            <select>
                                <option>Select Clip</option>
                                <option>SILVER&nbsp;&nbsp;+ USD 60.00</option>
                                <option>GOLD&nbsp;&nbsp;+ USD 60.00</option>
                            </select>
                        </div>
                        <?php */?>


                        <div class="add-to-cart">
                            <button class="ajax_addtocart js_buy" data-color="" data-size=""> Đặt mua</button>
                        </div>
                        <div class="content-detai-right">
                            <?php if (isset($extend_description['description']) && is_array($extend_description['description']) && count($extend_description['description'])) { ?>
                                <?php foreach ($extend_description['description'] as $keyD => $valD) { ?>

                                    <?php echo $valD; ?>

                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($relaList) && is_array($relaList) && count($relaList)) { ?>

        <div class="main-product product-other">
            <div class="container-fluid">
                <div class="title-title">
                    <div class="container-fluid">
                        <h2 class="title-primary"><?php echo $detailCatalogue['title'] ?></h2>
                        <p class="desc"><?php echo $detailCatalogue['description'] ?></p>
                    </div>
                </div>

                <div class="row">

                    <?php foreach ($relaList as $keyPost => $valP) { ?>
                        <?php
                        $title = $valP['title'];
                        $href = rewrite_url($valP['canonical'], TRUE, TRUE);
                        $getPrice = getPriceFrontend(array('productDetail' => $valP));
                        $listColor = $this->Autoload_Model->_get_where(array(
                            'table' => 'attribute_relationship',
                            'select' => 'attribute.color',
                            'join' => array(
                                array('attribute', 'attribute.id = attribute_relationship.attrid', 'inner'),
                            ),
                            'where' => array(
                                'module' => 'product',
                                'moduleid' => $valP['id'],
                            ),

                        ), TRUE);
                        ?>
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="item">
                                <div class="image">
                                    <a href="<?php echo $href ?>"><img src="<?php echo $valP['image'] ?>"
                                                                       alt="<?php echo $title ?>"></a>
                                </div>
                                <div class="nav-image">
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <h3 class="title"><a href="<?php echo $href ?>"><?php echo $title ?></a>
                                            </h3>
                                            <p class="price"><?php echo $getPrice['price_final'] ?></p>
                                        </div>
                                        <?php if(!empty($listColor)) { ?>

                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <ul>
                                                    <?php foreach ($listColor as $keyColor => $valColor) {?>
                                                        <li>
                                                            <a href="javascript:void(0);" style="background: <?php echo $valColor['color']?>"></a>
                                                        </li>
                                                    <?php }?>
                                                </ul>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>


                </div>
            </div>
        </div>
    <?php } ?>
</div>
<script>


    $(document).on('click', '.chose_attr_advanced', function () {
        var title = $(this).data('title');
        var type = $(this).data('type');
        if(type =='color'){
            $('.ajax_addtocart').attr('data-color',title);
        }else if(type =='size'){
            $('.ajax_addtocart').attr('data-size',title);
        }
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).parent().parent().find('.chose_attr_advanced').removeClass('active');
            $(this).addClass('active');
        }
    });
    $('.chose_attr_advanced.active').each(function () {
        var title = $(this).data('title');
        var type = $(this).data('type');
        if(type =='color'){
            $('.ajax_addtocart').attr('data-color',title);
        }else if(type =='size'){
            $('.ajax_addtocart').attr('data-size',title);
        }
    });

</script>
