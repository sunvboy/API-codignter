<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
        <li><a href="javascript:void(0);">Thông tin đơn hàng</a></li>
    </ul>
    <?php $extend = json_decode(base64_decode($detailorder['extend_json']), true) ?>

    <?php
    $list_promotional_detail = json_decode($detailorder['promotional_detail'], true);
    ?>
    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">

            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <td colspan="2" class="text-left">Thông tin đơn hàng</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="width: 50%;" class="text-left"><b>Ngày đặt:</b> <?php echo $detailorder['created'] ?><br>
                        <b>Trạng thái:</b> <?php echo $this->configbie->data('state_order', $detailorder['status']) ?>
                    </td>

                </tr>
                </tbody>
            </table>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <td style="width: 50%; vertical-align: top;" class="text-left">THÔNG TIN KHÁCH HÀNG</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-left">
                        <?php echo $detailorder['fullname'] ?>
                        <br><?php echo $detailorder['email'] ?>
                        <br><?php echo $detailorder['phone'] ?>
                        <br><?php echo $detailorder['address_detail'] ?>
                        <br>Tỉnh/Thành phố: <?php echo $detailorder['address_city'] ?>
                        <br>Quận/Huyện: <?php echo $detailorder['address_distric'] ?>
                        <br>Phường/Xã: <?php echo $detailorder['address_ward'] ?>
                        <br><?php echo $detailorder['note'] ?>

                </tr>
                </tbody>
            </table>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <td class="text-left">Hình ảnh</td>
                        <td class="text-left">Sản phẩm</td>
                        <td class="text-right">Số lượng</td>
                        <td class="text-right">Giá</td>
                        <td class="text-right">Thành tiền</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($detail_list_prd) && is_array($detail_list_prd) && count($detail_list_prd)) { ?>
                        <?php foreach ($detail_list_prd as $key => $val) { ?>
                            <tr>
                                <td class="text-left"><img src="<?php echo getthumb($val['image']) ?>" style="width: 30px"></td>
                                <td class="text-left"><?php echo $val['title'] ?> </td>
                                <td class="text-right"><?php echo $val['quantity'] ?></td>
                                <td class="text-right"> <?php echo addCommas($val['price_final']) . 'đ'?></td>
                                <td class="text-right"> <?php echo addCommas($val['price_final'] * $val['quantity']) . 'đ' ?></td>

                            </tr>
                        <?php }
                    } ?>

                    </tbody>
                    <tfoot>
                    <?php
                    $total_cart = (isset($data_order['cart']['total_cart'])) ? $data_order['cart']['total_cart'] : 0;
                    $total_cart_promo = (isset($data_order['cart']['total_cart_promo'])) ? $data_order['cart']['total_cart_promo'] : $total_cart;
                    $total_cart_coupon = (isset($data_order['cart']['total_cart_coupon'])) ? $data_order['cart']['total_cart_coupon'] : $total_cart_promo;
                    $discount_promo = $total_cart_promo - $total_cart;
                    $discount_coupon = $total_cart_coupon - $total_cart_promo;

                    $total_cart = addCommas($total_cart);
                    $total_cart_promo = addCommas($total_cart_promo);
                    $total_cart_coupon = addCommas($total_cart_coupon);

                    $discount_promo = addCommas($discount_promo);
                    $discount_coupon = addCommas($discount_coupon);
                    $discount_other = (isset($data_order['cart']['discount_other'])) ? $data_order['cart']['discount_other'] : 0;

                    ?>
                    <tr>
                        <td colspan="3"></td>
                        <td class="text-right"><b>Tổng giá trị sản phẩm</b>
                        </td>
                        <td class="text-right"><?php echo $total_cart.'đ' ?></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td class="text-right"><b>Giảm giá khuyến mại</b>
                        </td>
                        <td class="text-right"><?php echo $discount_promo.'đ' ?></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td class="text-right"><b>Giảm giá coupon</b>
                        </td>
                        <td class="text-right"><?php echo addCommas($discount_coupon).'đ' ?></td>
                    </tr>

                    <tr>
                        <td colspan="3"></td>
                        <td class="text-right"><b>Số tiền phải thanh toán</b>
                        </td>
                        <td class="text-right"><?php echo $total_cart_coupon.'đ' ?></td>
                    </tr>
                    </tfoot>
                </table>
            </div>


        </div>
        <!--Middle Part End-->
        <!--Right Part Start -->
        <?php echo $this->load->view('user/frontend/manage/aside')?>
        <!--Right Part End -->
    </div>
</div>