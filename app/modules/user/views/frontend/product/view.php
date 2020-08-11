<div id="main" class="wrapper main-change-pasword">
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
                <li><a href="javascript:void(0);">Tất cả sản phẩm</a></li>
            </ul>
        </div>
    </div>

    <div class="main-account main-all-product">
        <div class="container">
            <div class="conten-account">
                <div class="row">

                    <?php echo $this->load->view('user/frontend/manage/aside') ?>

                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="account-right account-right-all product-home ">
                            <h2 class="title-primary">Tất cả sản phẩm</h2>

                            <div class="nav-product-home">
                                <div class="row">

                                    <?php if (isset($listData) && is_array($listData) && count($listData)) { ?>
                                        <?php foreach ($listData as $key => $val) { ?>
                                            <?php
                                            $href = rewrite_url($val['canonical'], true, true);
                                            $image = $val['image'];
                                            $getPrice = getPriceFrontend(array('productDetail' => $val));
                                            $averagePoint = 0;
                                            $comment = comment(array('id' => $val['id'], 'module' => 'product'));
                                            if (isset($comment) && is_array($comment) && count($comment)) {
                                                $averagePoint = round($comment['statisticalRating']['averagePoint']);
                                            }
                                            $_catalogue_list = '';
                                            $catalogue = json_decode($val['catalogue'], TRUE);
                                            if (isset($catalogue) && is_array($catalogue) && count($catalogue)) {
                                                $_catalogue_list = $this->Autoload_Model->_get_where(array(
                                                    'select' => 'id, title, slug, canonical',
                                                    'table' => 'product_catalogue',
                                                    'where_in' => json_decode($val['catalogue'], TRUE),
                                                    'where_in_field' => 'id',
                                                ), TRUE);
                                            }
                                            ?>
                                            <div class="col-md-3 col-sm-6 col-xs-6">
                                                <div class="item">
                                                    <div class="image">
                                                        <a href="<?php echo $href; ?>" target="_blank"><img src="<?php echo $image; ?>"
                                                                                            alt="<?php echo $val['title']; ?>"></a>
                                                    </div>
                                                    <div class="nav-image">
                                                        <h3 class="title"><a target="_blank" href="<?php echo $href; ?>"><?php echo $val['title']; ?></a>
                                                        </h3>

                                                        <p class="price"><?php echo $getPrice['price_final'] ?>
                                                            <?php if ($averagePoint > 0) { ?>
                                                                <span class="start">
                                                            <?php for ($i = 1; $i <= $averagePoint; $i++) { ?>
                                                                <i class="fas fa-star"></i>
                                                            <?php } ?>
                                                                    <?php for ($i = 1; $i <= (5 - $averagePoint); $i++) { ?>
                                                                        <i class="far fa-star"></i>
                                                                    <?php } ?>

                                                        </span>
                                                            <?php } ?>
                                                        </p>

                                                        <div class="sua-xoa">
                                                            <div class="row">
                                                                <div class="col-md-6 col-sm-6 col-xs-6" style="padding: 0px 8px">
                                                                    <div class="sua">
                                                                        <a href="update-product.html?id=<?php echo $val['id'] ?>"><img
                                                                                src="template/frontend/images/sua.png"
                                                                                alt="SỬA">SỬA</a>

                                                                    </div>

                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-xs-6" style="padding: 0px 8px">
                                                                    <div class="xoa">
                                                                        <a href="javascript:void(0)"
                                                                           class=" ajax_delete_product"
                                                                           data-title="Lưu ý: Dữ liệu sẽ không thể khôi phục. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!"
                                                                           data-router="<?php echo $val['canonical']; ?>"
                                                                           data-id="<?php echo $val['id'] ?>"
                                                                           data-catalogueid="<?php echo $val['catalogueid'] ?>"
                                                                           data-module="product"><img
                                                                                src="template/frontend/images/xoa.png"
                                                                                alt="XÓA">XÓA</a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php } ?>
                                    <?php } else { ?>
                                        <div class="col-md-12" >Không có dữ liệu...</div>
                                    <?php } ?>

                                </div>

                                <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
</div>
<link href="template/backend/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<script src="template/backend/js/plugins/sweetalert/sweetalert.min.js"></script>
<style>
    .main-all-product .product-home .nav-product-home .row{
        display: flex;
        align-items: center;
    }
</style>
<style>
    .main-account .account-right{
        background: transparent;
    }
    /* SWITCHES */
    .onoffswitch {
        position: relative;
        width: 54px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }
    .onoffswitch-checkbox {
        display: none;
    }
    .onoffswitch-label {
        display: block;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid #3a88be;
        border-radius: 3px;
    }
    .onoffswitch-inner {
        display: block;
        width: 200%;
        margin-left: -100%;
        -moz-transition: margin 0.3s ease-in 0s;
        -webkit-transition: margin 0.3s ease-in 0s;
        -o-transition: margin 0.3s ease-in 0s;
        transition: margin 0.3s ease-in 0s;
    }
    .onoffswitch-inner:before,
    .onoffswitch-inner:after {
        display: block;
        float: left;
        width: 50%;
        height: 16px;
        padding: 0;
        line-height: 16px;
        font-size: 10px;
        color: white;
        font-family: Trebuchet, Arial, sans-serif;
        font-weight: bold;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }
    .onoffswitch-inner:before {
        content: "ON";
        padding-left: 7px;
        background-color: #3a88be;
        color: #FFFFFF;
    }
    .onoffswitch-inner:after {
        content: "OFF";
        padding-right: 7px;
        background-color: #FFFFFF;
        color: #919191;
        text-align: right;
    }
    .onoffswitch-switch {
        display: block;
        width: 18px;
        margin: 0;
        background: #FFFFFF;
        border: 2px solid #3a88be;
        border-radius: 3px;
        position: absolute;
        top: 0;
        bottom: 0;
        right: 36px;
        -moz-transition: all 0.3s ease-in 0s;
        -webkit-transition: all 0.3s ease-in 0s;
        -o-transition: all 0.3s ease-in 0s;
        transition: all 0.3s ease-in 0s;
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
        margin-left: 0;
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
        right: 0;
    }
</style>
<script>
    $('.lisanpham .acc__panel').addClass('open');
</script>
<script>
    $(document).on('change','.publish',function(){
        let _this = $(this);
        let objectid = _this.attr('data-id');
        let formURL = 'user/frontend/product/status';
        $.post(formURL, {
                objectid: objectid},
            function(data){

            });
    });
    $(document).on('click','.ajax_delete_product',function(){
        let _this = $(this);
        let param = {
            'title' : _this.attr('data-title'),
            'id'    : _this.attr('data-id'),
            'router' : _this.attr('data-router'),
        }
        swal({
                title: "Hãy chắc chắn rằng bạn muốn thực hiện thao tác này?",
                text: param.title,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Thực hiện!",
                cancelButtonText: "Hủy bỏ!",
                closeOnConfirm: false,
                closeOnCancel: false },
            function (isConfirm) {
                if (isConfirm) {
                    let ajax_url = 'user/frontend/product/ajax_delete_product';
                    $.post(ajax_url, {
                            id: param.id, router: param.router, },
                        function(data){
                            if(data == 0){
                                sweet_error_alert('Có vấn đề xảy ra','Vui lòng thử lại')
                            }else{
                                _this.parents('tr').hide().remove();
                                swal("Xóa thành công!", "Hạng mục đã được xóa khỏi danh sách.", "success");
                                setTimeout(function(){ window.location.href = window.location.href; }, 1500);
                            }
                        });

                } else {
                    swal("Hủy bỏ", "Thao tác bị hủy bỏ", "error");
                }
            });
    });
</script>