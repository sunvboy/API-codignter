<!-- page-title -->
<div class="ttm-page-title-row">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="page-title-heading">
                        <h1 class="title">Đặt mua thành công</h1>
                    </div>
                    <div class="breadcrumb-wrapper">
                        <span class="mr-1"><i class="ti ti-home"></i></span>
                        <a href="<?php echo base_url() ?>">Trang chủ</a>
                        <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                        <span class="ttm-textcolor-skincolor">Đặt mua thành công</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- page-title end-->

<!--site-main start-->
<div class="site-main">

    <!-- checkout-section -->
    <section class="checkout-section clearfix" style="padding-top: 0px">
        <div class="container">
            <!-- row -->
            <div class="row">

                <div class="col-lg-12">
                    <form name="checkout" method="post" class="checkout row" action="">
                        <div class="col-lg-6">

                            <div class="billing-fields">
                                <div class="content-sec-head-style">
                                    <div class="content-area-sec-title">
                                        <h5>Thông tin thanh toán</h5>
                                    </div>
                                </div>
                                <div class="billing-fields-wrapper pt-10">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-row">
                                                <label>Họ và tên: <?php echo $payment['fullname']?></label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-row">
                                                <label>Số điện thoại:<?php echo $payment['phone']?></label>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-row">
                                                <label>Email:<?php echo $payment['email']?></label>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-row">
                                                <label>Địa chỉ: <?php echo $address =  $payment['address_detail']?></label>

                                            </div>
                                        </div>
                                    </div>




                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-row">
                                                <label>Tỉnh/Thành Phố: <?php echo $payment['address_city']?></label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-row">
                                                <label>Quận/Huyện: <?php echo $payment['address_distric']?></label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-row">
                                                <label>Phường/Xã: <?php echo $payment['address_ward']?></label>


                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-row">
                                                <label>Ghi chú: <?php echo $payment['note']?></label>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="additional-fields">
                                <div class="content-sec-head-style">
                                    <div class="content-area-sec-title">
                                        <h5>Đơn hàng</h5>
                                    </div>
                                </div>
                                <div id="order_review" class="checkout-review-order">
                                    <table class="cart_table checkout-review-order-table">
                                        <thead>
                                        <tr>
                                            <th class="product-name">Sản phẩm</th>
                                            <th class="product-total">Thành tiền</th>
                                        </tr>
                                        </thead>
                                        <tbody>
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
                                                <tr class="cart_item">
                                                    <td class="product-name"><?php echo $title ?>
                                                        <strong class="product-quantity">× <?php echo $quantity ?></strong>
                                                    </td>
                                                    <td class="product-total">
                                                            <span class="Price-amount">
                                                                <?php echo $money_row ?>đ
                                                            </span>
                                                    </td>
                                                </tr>

                                            <?php }
                                        } else { ?>
                                            <tr>
                                                <td>Không có sản phẩm trong giỏ hàng</td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                        <tfoot>

                                        <tr class="order-total">
                                            <th>Tổng tiền</th>
                                            <td><strong><span class="woocommerce-Price-amount amount"><?php echo addCommas($data_order['cart']['total_cart']) ?>đ</span></strong>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- checkout-section end -->

</div><!--site-main end-->



































<div style="max-width:600px;margin:0 auto;background:#fff;color:#444;font-size:12px;font-family:Arial;line-height:18px">
    <div>
        <div style="margin:0 0 15px 0;padding:35px 20px 10px 20px;border-bottom:3px solid #00b7f1">
            <table width="100%" cellpadding="0" cellspacing="0">

                </tbody>
            </table>
        </div>
        <div>
            <div>
                <span class="im"><h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0"> Cảm
                        ơn quý khách <?php echo $payment['fullname']?> đã đặt hàng tại <a href="<?php echo base_url()?>">thuymimi.com</a>
                    </h1>
                </span>


            </div>
            <div>
                <div><h3
                        style="font-size:13px;font-weight:bold;color:#02acea;text-transform:uppercase;margin:0px 0 0 0;border-bottom:1px solid #ddd">
                        Thông tin đơn hàng #ORD0023 <span
                            style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(14/05/2020 10:21:57)</span>
                    </h3></div>
                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <thead>
                    <tr>
                        <th align="left" width="50%"
                            style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold">
                            Thông tin thanh toán
                        </th>
                        <th align="left" width="50%"
                            style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold">
                            Thông tin địa chỉ giao hàng
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td valign="top"
                            style="padding:3px 9px 9px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                            <span style="text-transform:capitalize">Tên: <?php echo $payment['fullname']?></span><br>Email: <a
                                href="mailto:<?php echo $payment['email']?>"
                                target="_blank"><?php echo $payment['email']?></a><br>SĐT: <?php echo $payment['phone']?>
                        </td>
                        <td valign="top"
                            style="padding:3px 9px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                            <span class="im"><span style="text-transform:capitalize">Tên: <?php echo $payment['fullname']?></span><br> Email: <a
                                    href="mailto:<?php echo $payment['email']?>" target="_blank"><?php echo $payment['email']?></a><br></span>Địa chỉ:
                            <?php echo $address =  $payment['address_detail'].' - '.$payment['address_distric'].' - '.$payment['address_city']?><br>SĐT: <?php echo $payment['phone']?>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top"
                            style="padding:7px 9px 0px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444"
                            colspan="2"><p
                                style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                                <strong>Phương thức thanh toán: </strong>Thanh toán tiền mặt khi nhận hàng <br><strong>Thời
                                    gian giao hàng dự kiến:</strong> dự kiến giao hàng vào ngày <?php echo 		$giaohang = date('Y-m-d', strtotime($payment['created']. ' + 3 days'));
                                ?> <br><strong>Phí
                                    vận chuyển: </strong> 0&nbsp;₫ <br></p></td>
                    </tr>
                    </tbody>
                </table>
                <span class="im"><p
                        style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                        <i>Lưu ý: Với những đơn hàng thanh toán trả trước, xin vui lòng đảm bảo người nhận hàng đúng
                            thông tin đã đăng ký trong đơn hàng, và chuẩn bị giấy tờ tùy thân để đơn vị giao nhận có thể
                            xác thực thông tin khi giao hàng.</i></p></span></div>
            <div><h2
                    style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#02acea">
                    CHI TIẾT ĐƠN HÀNG</h2>
                <table cellspacing="0" cellpadding="0" border="0" width="100%" style="background:#f5f5f5">
                    <thead>
                    <tr>
                        <th colspan="2" align="left" bgcolor="#02acea"
                            style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                            Sản phẩm
                        </th>
                        <th align="left" bgcolor="#02acea"
                            style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                            Đơn giá
                        </th>
                        <th align="left" bgcolor="#02acea"
                            style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                            Số lượng
                        </th>

                        <th align="right" bgcolor="#02acea"
                            style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                            Thành tiền
                        </th>
                    </tr>
                    </thead>

                    <tbody bgcolor="#eee" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                    <?php echo $productListDes?>
                    </tbody>
                    <tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                    <?php /*?>
                    <tr>
                        <td colspan="4" align="right" style="padding:5px 9px">Tổng giá trị sản phẩm chưa giảm</td>
                        <td align="right" style="padding:5px 9px"><span>2,700,000&nbsp;₫</span></td>
                    </tr>

                    <tr>
                        <td colspan="4" align="right" style="padding:5px 9px">Chi phí vận chuyển</td>
                        <td align="right" style="padding:5px 9px"><span>199,990&nbsp;₫</span></td>
                    </tr>
                    <?php */?>
                    <tr bgcolor="#eee">
                        <td colspan="4" align="right" style="padding:7px 9px"><strong><big>Tổng giá trị đơn hàng</big></strong></td>
                        <td align="right" style="padding:7px 9px">
                            <strong><big><span><?php echo addCommas($payment['total_cart_final'])?>&nbsp;₫</span></big></strong></td>
                    </tr>
                    </tfoot>
                </table>
                <span class="im"><p
                        style="margin:10px 0 0 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                        Bạn cần được hỗ trợ ngay? Chỉ cần email <a href="mailto:thu_thuy2610@yahoo.com"
                                                                   style="color:#099202;text-decoration:none"
                                                                   target="_blank"><strong>thu_thuy2610@yahoo.com</strong></a>,
                        hoặc gọi số điện thoại <strong style="color:#099202"> 0795129777</strong> (8-21h cả T7,CN). Đội
                        ngũ <a href="http://thuymimi.com" target="_blank"
                               data-saferedirecturl="https://www.google.com/url?q=http://thuymimi.com&amp;source=gmail&amp;ust=1589512923781000&amp;usg=AFQjCNErNTPWb9PzvjhP1hc4596Ap4nOeQ">thuymimi.com</a>
                        luôn sẵn sàng hỗ trợ bạn bất kì lúc nào.</p><p
                        style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">
                        Một lần nữa <a href="http://thuymimi.com" target="_blank"
                                       data-saferedirecturl="https://www.google.com/url?q=http://thuymimi.com&amp;source=gmail&amp;ust=1589512923781000&amp;usg=AFQjCNErNTPWb9PzvjhP1hc4596Ap4nOeQ">thuymimi.com</a>
                        cảm ơn quý khách.</p><p
                        style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right">
                        <strong><a
                                style="color:#00a3dd;text-decoration:none;font-size:14px">thuymimi.com</a></strong><br>
                    </p></span></div>
        </div>
    </div>
</div>