<div id="main" class="wrapper main-view-shop">
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url()?>">Trang chủ  /</a></li>
                <li><a href="<?php echo $canonical?>"><?php echo $detailCustomer['account']?></a></li>
            </ul>
        </div>
    </div>
    <div class="content-view-shop">
        <div class="top-view-shop" style="background: #fff">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <div class="left-top-view">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="item1">
                                        <div class="avt">
                                            <img src="<?php
                                            if (file_exists(FCPATH . $detailCustomer['images'])) {
                                                echo $detailCustomer['images'];

                                            } else {
                                                echo 'template/not-found.png';
                                            } ?>" alt="<?php echo $detailCustomer['images']?>">
                                        </div>
                                        <div class="nav-avt">
                                            <h3 class="title"><?php echo $detailCustomer['account']?></h3>
                                            <p class="adress"><img src="template/frontend/images/i6.png" alt="Địa chỉ"><?php echo $detailCustomer['address']?></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="item2" style="padding-top: 10px">
                                        <p> Điện thoại: <span><?php echo $detailCustomer['phone']?></span></p>
                                        <p>Email: <span><?php echo $detailCustomer['email']?></span></p>
                                        <p>Tỉnh thành:<span> Hà Nội</span></p>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="item2 item2a" style="padding-top: 10px">
                                        <p>Loại cửa hàng: <span><a href="<?php echo rewrite_url($detailCustomer['canonical_catalogue'], TRUE, TRUE);?>" target="_blank"> <?php echo $detailCustomer['catalogue_title']?></a></span></p>
                                        <p>Link website:<span><a href="<?php echo $detailCustomer['shop_link']?>" target="_blank"><?php echo $detailCustomer['shop_link']?></a> </span></p>
                                        <p>Facebook: <span><a href="<?php echo $detailCustomer['shop_link_fanpage']?>" target="_blank"><?php echo $detailCustomer['shop_link_fanpage']?></a> </span></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="right-top-view">
                            <?php if (file_exists(FCPATH . $detailCustomer['images_qr']) && $detailCustomer['images_qr']!='') {?>
                            <img src="<?php echo $detailCustomer['images_qr']?>" alt="mã qr" style="height: 101px;">
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .item2 p{
                margin-bottom: 5px;
            }
            .nav-image p{
                margin: 0px;
            }
        </style>
        <div class="info-view-shop">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="image">
                            <?php if($detailCustomer['urlvideo']!=''){?>

                                <a href="https://www.youtube.com/watch?v=<?php echo $detailCustomer['urlvideo']?>" target="_blank"><img src="https://i.ytimg.com/vi/<?php echo $detailCustomer['urlvideo']?>/maxresdefault.jpg" alt="video Youtube"></a>

                            <?php }else{?>
                                <img src="template/frontend/images/img9.png" alt="video youtube">

                            <?php }?>

                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="nav-image">
                            <h3 class="title">Thông tin shop</h3>
                            <?php echo $detailCustomer['description']?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="product-home wow fadeInUp">
            <div class="container">
                <div class="title-title">
                    <h2 class="title-primary1">Tất cả các sản phẩm</h2>
                    <div class="nav-product-home" id="listCuahang">
                    </div>
                </div>
                <div id="pagenavi">
                </div>
        </section>

    </div>

</div>
<script>
    listCuahang($('#listCuahang').attr('data-page'),<?php echo $_GET['id']?>);
    $(document).on('click', '.ajax-pagination a', function () {
        var page = $(this).attr('data-ci-pagination-page');
        listCuahang(page,<?php echo $_GET['id']?>);
        return false;
    });
    function listCuahang(page,id) {
        var uri = '<?php echo site_url('homepage/ajax/home/ajax_listCuahang'); ?>';
        $.post(uri, {page: page,id:id},
            function (data) {
                var json = JSON.parse(data);
                $('#listCuahang').html(json.html);
                $('#pagenavi').html(json.pagination);
            });
    }

</script>
<style>
    .info-view-shop .nav-image::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    .info-view-shop .nav-image::-webkit-scrollbar
    {
        width: 5px;
        background-color: #F5F5F5;
    }

    .info-view-shop .nav-image::-webkit-scrollbar-thumb
    {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #D62929;
    }

</style>