<div id="main" class="wrapper" style="padding: 20px 0px">
    <div class="main-product-detail">
        <div class="container">
            <form action="" method="post" class="row" id="RegForm">
                <div class="contentswrap center_wrap col-md-12">
                    <div class="contentswrap_top center_wrap ">
                        <div class="center width_100 text_l">

                            <p class="text_l color_0 size14 padding_b30">
                                Tiến hàng thanh toán
                            </p>


                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xs-12 col-sm-6">
                    <?php $error = validation_errors(); echo !empty($error)?'<div class="alert alert-danger">'.$error.'</div>':'';?>

                    <div class="form-group">
                        <?php echo form_input('fullname', set_value('fullname'), 'class="form-control" autocomplete="off" placeholder="Họ và tên"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_input('phone', set_value('phone'), 'class="form-control" autocomplete="off" placeholder="Số điện thoại"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_input('email', set_value('email'), 'class="form-control" placeholder="Nhập địa chỉ Email, không bắt buộc" autocomplete="off"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_input('address_detail', set_value('address_detail'), 'class="form-control" placeholder="Nhập địa chỉ đầy đủ: Số nhà, tên đường" autocomplete="off"'); ?>
                    </div>
                    <?php
                    $listCity = getLocation(array(
                        'select' => 'name, provinceid',
                        'table' => 'vn_province',
                        'field' => 'provinceid',
                        'text' => 'Chọn Tỉnh/Thành Phố'
                    ));
                    ?>
                    <div class="form-group">
                        <?php echo form_dropdown('cityid', $listCity, '', 'class="form-control"  id="city" placeholder="" autocomplete="off"');?>
                    </div>
                    <div class="form-group">
                        <select name="districtid" id="district" class="location form-control">
                            <option value="">Chọn Quận/Huyện</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="wardid" id="ward" class="location form-control">
                            <option value="">Chọn Phường/Xã</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <?php echo form_textarea('note', set_value('note'), 'class="form-control" placeholder="Hãy để lại lời nhắn" autocomplete="off"');?>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger pull-right" type="submit" style="border-radius: 0px" name="create" value="create" id="place_order">
                            Tiến hàng thanh toán
                        </button>
                        <button class="btn btn-success pull-right" type="button" style="border-radius: 0px" name="create" value="create" id="loadingDiv">
                            Dữ liệu đang được xử lý...
                        </button>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 col-sm-6" style="border: 1px solid #dddddd;
    background-color: #fff;
    -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.09);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.09);padding-bottom: 10px">
                    <?php if (isset($list_product) && is_array($list_product) && count($list_product)) { ?>
                    <?php foreach ($list_product as $key => $val) { ?>
                    <?php
                    $info = getPriceFrontend(array('productDetail' => $val['detail']));
                    $quantity = $val['qty'];
                    if (isset($val['version']['image']) && $val['version']['image'] != '') {
                        $versionImage = json_decode(base64_decode($val['version']['image']), true);
                        if (isset($versionImage) && check_array($versionImage)) {
                            foreach ($versionImage as $key => $value) {
                                if ($value != '' && $value != 'template/not-found.png') {
                                    $versionImage = $value;
                                    break;
                                } else {
                                    $versionImage = '';
                                }
                            }
                        }
                    } else {
                        $versionImage = '';
                    }

                    $image = getthumb(
                        ($versionImage != '')
                            ? $versionImage
                            : $val['detail']['image']
                    );

                    // $title =  $val['detail']['title'].' '.((isset($val['version']['title'])) ? $val['version']['title'] : '');
                    $title = $val['detail']['title'];

                    $href = rewrite_url($val['detail']['canonical']);
                    $content = $val['content'];
                    $description_litter = cutnchar(strip_tags($val['detail']['description']), 400);
                    $price_final = getPriceFinal($val['detail'], true);
                    $money_row = $price_final * $quantity;
                    $money_row = addCommas($money_row);
                    ?>
                    <div class="items row">
                        <div class="col-sm-2 col-xs-3 padding_l5 padding_r10 ">
                            <img class="width_100" src="<?php echo $image ?>" alt="<?php echo $title ?>">
                        </div>
                        <div class="col-sm-10 col-xs-9 padding_l0 padding_r5 ">
                            <div class="color_3">
                                <span style="text-transform: uppercase"><?php echo $title ?></span><br>
                                <?php echo $val['options']['color'] ?><br>
                                <?php echo $val['options']['size'] ?>


                            </div>
                            <div class="color_3">
                                <b>Số lượng:</b> <?php echo $quantity ?><br>
                                <b>Thành tiền:</b> <?php echo $money_row ?>đ<br>


                            </div>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                    <hr>
                    <?php } ?>
                    <?php } ?>
                    <?php
                    $total_cart = (isset($cart['total_cart'])) ? $cart['total_cart'] : 0;
                    $total_cart_promo = (isset($cart['total_cart_promo'])) ? $cart['total_cart_promo'] : $total_cart;
                    $total_cart_coupon = (isset($cart['total_cart_coupon'])) ? $cart['total_cart_coupon'] : $total_cart_promo;

                    $discount_promo = $total_cart_promo - $total_cart;
                    $discount_coupon = $total_cart_coupon - $total_cart_promo;
                    $total_cart = addCommas($total_cart);
                    $total_cart_promo = addCommas($total_cart_promo);
                    $total_cart_coupon = addCommas($total_cart_coupon);
                    $discount_promo = addCommas($discount_promo);
                    $discount_coupon = addCommas($discount_coupon);

                    ?>
                    <div class="row">
                        <div class="col-xs-2 "> <b>Tổng tiền</b></div>
                        <div class="col-xs-10 " style="color: red;font-weight: bold"><?php echo $total_cart_coupon ?>đ</div>
                    </div>
                    <div style="clear: both;"></div>

                </div>

            </form>
        </div>
    </div>
</div>
<script>
    var cityid = '<?php echo $this->input->post('cityid'); ?>';
    var districtid = '<?php echo $this->input->post('districtid') ?>';
    var wardid = '<?php echo $this->input->post('wardid') ?>';
</script>
<style>
    .form-control{
        border-radius: 0px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $("#loadingDiv").hide();

        $('#RegForm').on('submit',function(){
            $("#place_order").hide();
            $("#loadingDiv").show();
        });
    });
</script>