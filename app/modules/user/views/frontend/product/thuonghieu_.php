<div id="main" class="wrapper">
    <?php
    $list_image = json_decode(base64_decode($detailCustomer['image_json']), TRUE);
    $prd_href = rewrite_url($detailCustomer['canonical_catalogue'], true, true);
    ?>

    <div id="home-wrapper" class="main-product-detail">
        <div class="bread_crumb">
            <div class="bread_crumb_content">
                <div class="container">
                    <span><a href="<?php echo base_url() ?>">Trang Chủ &gt; </a></span>

                    <span class="uk-active"><a  href="<?php echo $prd_href?>" ><?php echo $detailCustomer['catalogue_title']?></a></span>

                </div>
            </div>
        </div>
        <div class="header_text_panel hidden">
            <div class="container">
                <h1 class="title_km font_defaul"><?php echo $detailCustomer['account']; ?></h1>
                <div class="line1 mt1"></div>
            </div>
        </div>
        <div class="top-content-detail">
            <div class="container">
                <div class="row" id="flexxx">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="list-img wow fadeInUp">
                            <div class="slider-large owl-carousel">

                                <?php if (isset($list_image) && is_array($list_image) && count($list_image)) { ?>
                                    <?php foreach ($list_image as $key => $val) { ?>
                                        <div class="item" data-hash="one<?php echo $key ?>">
                                            <img src="<?php echo $val; ?>" alt="<?php echo $detailCustomer['account']; ?>">
                                        </div>
                                    <?php }
                                } ?>
                            </div>
                            <div class="slider-small owl-carousel">

                                <?php if (isset($list_image) && is_array($list_image) && count($list_image)) { ?>
                                    <?php foreach ($list_image as $key => $val) { ?>
                                        <a href="thuong-hieu.html?id=<?php echo  $detailCustomer['id']?>#one<?php echo $key ?>">
                                            <img src="<?php echo $val; ?>" alt="<?php echo $detailCustomer['account']; ?>">
                                        </a>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="sidebar-right">
                            <div class="images">
                                <a href="thuong-hieu.html?id=<?php echo $detailCustomer['id']?>"><img src="<?php
                                    if (file_exists(FCPATH .  $detailCustomer['avatar'] )) {
                                        echo $detailCustomer['avatar'] ;

                                    }else{
                                        echo 'template/not-found.png';
                                    } ?>" alt="<?php echo $detailCustomer['account']?>"></a>
                            </div>
                            <h3 class="title"><?php echo $detailCustomer['account']?></h3>
                            <p class="desc"><?php echo $detailCustomer['catalogue_title']?></p>
                            <div class="item">
                                <div class="icon"><img src="template/frontend/asset/images/placeholder.svg" alt="Địa chỉ áp dụng"></div>
                                <div class="nav-icon">
                                    <h4 class="title2"> Địa chỉ</h4>
                                    <p class="desc2"><?php echo $detailCustomer['address']?></p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?php if(!empty($detailCustomer['time_open']) && $detailCustomer['time_open'] != ''){?>

                            <div class="item">
                                <div class="icon"><img src="template/frontend/asset/images/opened-door-aperture.svg" alt=""></div>
                                <div class="nav-icon">
                                    <h4 class="title2">Thời gian mở cửa</h4>
                                    <p class="desc2"> <?php echo $detailCustomer['time_open']?></p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?php }?>
                            <?php if(!empty($detailCustomer['phone']) && $detailCustomer['phone'] != ''){?>


                            <div class="item">
                                <div class="icon"><img src="template/frontend/asset/images/phone.svg" alt="<?php echo $detailCustomer['phone']?>"></div>
                                <div class="nav-icon">
                                    <a href="tel:<?php echo $detailCustomer['phone']?>">
                                    <h4 class="title2"> Liên hệ </h4>
                                    <p class="desc2"> <?php echo $detailCustomer['phone']?></p>
                                    </a>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <?php }?>


                            <div class="social-sidebar">
                                <h5 class="title-social">Kết nối của hàng</h5>
                                <div class="nav-social">
                                    <ul>
                                        <li>
                                            <?php if(!empty($detailCustomer['shop_link_fanpage']) && $detailCustomer['shop_link_fanpage'] != ''){?>
                                                <a href="<?php echo $detailCustomer['shop_link_fanpage']?>"><i class="fab fa-facebook-f"></i></a>
                                            <?php }else{?>
                                                <a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a>

                                            <?php }?>
                                        </li>
                                        <li>
                                            <?php if(!empty($detailCustomer['shop_link_instagram']) && $detailCustomer['shop_link_instagram'] != ''){?>
                                                <a href="<?php echo $detailCustomer['shop_link_instagram']?>"><i class="fab fa-instagram"></i></a>
                                            <?php }else{?>
                                                <a href="javascript:void(0);"><i class="fab fa-instagram"></i></a>

                                            <?php }?>
                                        </li>
                                        <li>
                                            <a href="http://zalo.me/<?php echo $detailCustomer['phone']?>" style="font-weight: bold" target="_blank">ZALO</a>

                                        </li>
                                        <li>
                                            <?php if(!empty($detailCustomer['shop_link']) && $detailCustomer['shop_link'] != ''){?>
                                                <a href="<?php echo $detailCustomer['shop_link']?>"><i class="fas fa-home"></i></a>
                                            <?php }else{?>
                                                <a href="thuong-hieu.html?id=<?php echo $detailCustomer['id']?>"><i class="fas fa-home"></i></a>
                                            <?php }?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="bottom-product-detail">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="content-left-dt">
                            <div class="item-box item-box1">
                                <h3 style="margin-bottom: 0px">Chi tiết</h3>
                                <?php echo $detailCustomer['description']; ?>
                            </div>
                            <div class="item-box item-box2">
                                <div class="box_top_title ">
                                    <h3 class="title_km">Địa chỉ cửa hàng</h3>
                                    <div class="line1 mt1"></div>
                                </div>
                                <div class="nav-item-box2">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="map-detail">

                                                <div style="position: relative; background-color: rgb(229, 227, 223); overflow: hidden;width: 100%;height: 200px" class="main_mapsmall" id="map_canvas_detail"></div>

                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="map-detail-adress">
                                                <p><i class="fas fa-map-marker-alt"></i><?php echo $detailCustomer['address']?></p>
                                                <p><i class="fas fa-phone"></i><?php echo $detailCustomer['phone']?> </p>
                                                <a href="javascript:void(0)" onclick="chiduong()" style="color: #ffb300"><i class="fas fa-location-arrow"></i>Chỉ đường</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($relaListCustomer) && is_array($relaListCustomer) && count($relaListCustomer)) { ?>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="sidebar-right">
                                <div class="box_top_title ">
                                    <h3 class="title_km">Thương hiệu khác</h3>
                                    <div class="line1 mt1"></div>
                                </div>
                                <?php foreach ($relaListCustomer as $keyPost => $val) {  $hrefC = rewrite_url($val['canonical_catalogue'], TRUE, TRUE);?>
                                    <div class="_list_store home_list">
                                        <div class="thumbnail">
                                            <a class="block-img" href="thuong-hieu.html?id=<?php echo $val['id']?>">
                                                <img src="<?php
                                                if (file_exists(FCPATH .   $val['images'] )) {
                                                    echo  $val['images'] ;

                                                }else{
                                                    echo 'template/not-found.png';
                                                } ?>" alt="<?php echo $val['account']?>">
                                            </a>
                                            <div class="clearfix"></div>
                                            <div class=" box__info_res">
                                                <div class="_info_res">
                                                    <div class="logo_store">
                                                        <a class="u-logo" href="thuong-hieu.html?id=<?php echo $val['id']?>">
                                                            <img src="<?php
                                                            if (file_exists(FCPATH .   $val['avatar'] )) {
                                                                echo  $val['avatar'] ;

                                                            }else{
                                                                echo 'template/not-found.png';
                                                            } ?>" style="display: inline-block;width: 28px;height: 28px;object-fit: cover;border-radius: 100%" alt="<?php echo $val['account'] ?>">
                                                        </a>
                                                    </div>
                                                    <div class="info_store">
                                                        <h3 class="name_store_list">
                                                            <a href="thuong-hieu.html?id=<?php echo $val['id']?>">
                                                                <?php echo $val['account']?>
                                                            </a>
                                                        </h3>
                                                        <div class="font_defaul address">
                                                            <i class=" fa fa-map-marker _location" aria-hidden="true"></i>
                                                            <?php echo $val['address']?>
                                                        </div>
                                                        <div class="font_defaul address">
                                                            <i class="  fa fa-tag _tag" aria-hidden="true"></i>
                                                            <a href="<?php echo $hrefC?>">
                                                                <?php echo $val['catalogue']?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                    <?php }?>

                </div>
            </div>
        </div>
    </div>
</div>


<link type="text/css" href="template/backend/maps/map_css.css" rel="stylesheet">
<link type="text/css" href="template/backend/maps/jqueryui.css" rel="stylesheet">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPglsw89c3aL05-qtpdfIhvbpkvcnCDrE&ver=4.7.3"></script>
<?php
$bien = '(21.0287281, 105.8073548)';
?>
<input type="hidden" value="" id="hdfMap">
<script type="text/javascript">
    function chiduong(){
        var longlat = $('#hdfMap').val();
        var url = 'https://www.google.com/maps/dir/?api=1&&origin=&destination='+longlat+'';
        window.open(url);
    }
    function setDesc(input) {
        //alert(input.value);
        $("#hdfInfo").val(input.value);
    }
    function getDesc() {
        //alert(input.value);
        $("#infoMap").val($("#hdfInfo").val());
    }
    function initialize() {
        geocoder = new google.maps.Geocoder();
        var myOptions = {
            zoom: 16,
            center: new google.maps.LatLng<?=$bien; ?>,
            disableDefaultUI: true,
            panControl: true,
            zoomControl: true,
            mapTypeControl: true,
            overviewMapControl: true,
            overviewMapControlOptions: { opened: true },
            MarkerOptions: { draggable: true },
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map_canvas_detail"),
            myOptions);
        google.maps.event.addListener(map, 'click', function (e) {
            initialize();
            map.setCenter(e.latLng);
            var marker = new google.maps.Marker({
                map: map,
                position: e.latLng,
                draggable: true
            });
            $("#hdfMap").val(marker.position);
            google.maps.event.addListener(marker, "dragstart", function () {
                getDesc();
            });
            google.maps.event.addListener(marker, "dragend", function () {
                getDesc();
                $("#hdfMap").val(marker.position);
            });
            google.maps.event.addListener(marker, "click", function () {
                infowindow.open(map, marker);
                getDesc();
            });
        });
    }
    codeAddress();
    function codeAddress() {
        initialize();
        var address = '<?php echo $detailCustomer['address']?>';
        geocoder.geocode({ 'address': address }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    draggable: true
                });
                $("#hdfMap").val(marker.position);
                google.maps.event.addListener(marker, "dragstart", function () {
                    getDesc();
                });
                google.maps.event.addListener(marker, "dragend", function () {
                    getDesc();
                    $("#hdfMap").val(marker.position);
                });
                google.maps.event.addListener(marker, "click", function () {
                    infowindow.open(map, marker);
                    getDesc();
                });
            } else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        });
    }

    $(document).ready(function () {
        initialize();
    });
</script>
<div id="main" class="wrapper">
    <div id="home-wrapper">
            <div class="category-share">
                <div class="container">
                    <h3 class="title_promotion pull-left wow fadeInUp"> Danh sách sản phẩm <a href="danh-sach-san-pham-thuong-hieu.html?id=<?php echo $detailCustomer['id']?>" class="readmore">Xem thêm ></a> </h3>
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
                                                                <a class="u-logo" href="thuonghieu.php?id=<?php echo $val['customerid']?>">
                                                                    <img src="<?php
                                                                    if (file_exists(FCPATH .   $val['customer_avatar'] )) {
                                                                        echo  $val['customer_avatar'] ;

                                                                    }else{
                                                                        echo 'template/not-found.png';
                                                                    } ?>" style="display: inline-block;width: 28px;height: 28px;object-fit: cover;border-radius: 100%" alt="<?php echo $title ?>">
                                                                </a>
                                                            </div>
                                                            <div class="pull-left info_store ">
                                                                <div class="name_store no_margin" >
                                                                    <a href="thuonghieu.php?id=<?php echo $val['customerid']?>">
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