<div id="main" class="wrapper" style="padding: 20px 0px">
    <div class="main-product-detail">
        <div class="container">
            <div class="row">
                <div class="contentswrap center_wrap col-md-12">
                    <div class="contentswrap_top center_wrap ">
                        <div class="center width_100 text_l">

                            <p class="text_l color_0 size14 padding_b30">
                                Đặt mua thành công
                            </p>


                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xs-12 col-sm-6">
                    <?php $error = validation_errors();
                    echo !empty($error) ? '<div class="alert alert-danger">' . $error . '</div>' : ''; ?>

                    <div class="form-group">
                        <b>Họ và tên: </b><?php echo $payment['fullname'] ?>
                    </div>
                    <div class="form-group">
                        <b>Họ và tên: </b><?php echo $payment['phone'] ?>

                    </div>
                    <div class="form-group">
                        <b>Email: </b><?php echo $payment['email'] ?>
                    </div>
                    <div class="form-group">
                        <b>Địa chỉ: </b><?php echo $address = $payment['address_detail'] ?>
                    </div>


                    <div class="form-group">
                        <b>Tỉnh/Thành Phố: </b><?php echo $payment['address_city'] ?>
                    </div>
                    <div class="form-group">
                        <b>Quận/Huyện: </b><?php echo $payment['address_distric']?>

                    </div>
                    <div class="form-group">
                        <b>Phường/Xã: </b><?php echo $payment['address_ward']?>

                    </div>
                    <div class="form-group">
                        <b>Ghi chú: </b><?php echo $payment['note']?>
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
                                <div class="col-sm-10 col-xs-9 padding_l0 padding_r5">
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

                    <div class="row">
                        <div class="col-xs-2 "><b>Tổng tiền</b></div>
                        <div class="col-xs-10 "
                             style="color: red;font-weight: bold"><?php echo addCommas($data_order['cart']['total_cart']) ?>đ
                        </div>
                    </div>
                    <div style="clear: both;"></div>

                </div>

            </div>
        </div>
    </div>
</div>





