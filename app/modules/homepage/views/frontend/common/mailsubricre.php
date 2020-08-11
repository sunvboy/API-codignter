<section id="form-ykien">
    <div class="container">
        <h2><?php echo $this->fcSystem['title_title3']?></h2>
        <div class="desc"><?php echo $this->fcSystem['title_title4']?>
        </div>
        <div class="clearfix">

        </div>
        <div class="form-inputttt">
            <form id="mailsubricre" class="newsletter-form row" method="post" action="mailsubricre.html" data-mailchimp="true">
                <div class="clearfix"></div>
                <div class="form-group col-md-12">
                    <div class="error"></div>

                </div>
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control fullname" placeholder="Họ và tên *" name="fullname" required>

                </div>
                <?php $exchinhanh = explode(',',  $this->fcSystem['title_chinhanh'])?>
                <?php if(!empty($exchinhanh)){?>
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control chinhanh" name="chinhanh" required>
                        <option>Lựa chọn chi nhánh*</option>
                        <?php foreach ($exchinhanh as $key=>$val){?>

                        <option value="<?php echo $val?>"><?php echo $val?></option>

                        <?php }?>


                    </select>

                </div>
                <?php }?>
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control namsinh" placeholder="Năm sinh *" name="namsinh" required>

                </div>
                <div class="form-group col-md-6 col-sm-6 col-xs-12">

                    <input class="form-control address" placeholder="Địa chỉ *" name="address" required>

                </div>
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control phone" placeholder="Số điện thoại liên hệ *" name="phone" required>

                </div>
                <?php

                $khoahoc = $this->Autoload_Model->_get_where(array(
                    'select' => 'title',
                    'table' => 'product',
                    'where' => array( 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
                ?>
                <?php  if (isset($khoahoc) && is_array($khoahoc) && count($khoahoc)) {?>
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control productID" name="productID" required>
                        <option>Khóa học quan tâm*</option>
                        <?php foreach ($khoahoc as $key => $val) {?>
                            <option value="<?php echo $val['title']?>"><?php echo $val['title']?></option>

                        <?php }?>
                    </select>
                </div>
                <?php }?>

                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <input type="email" class="form-control email" placeholder="Email *" name="email" required>

                </div>
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <i style="height: 42px;line-height: 42px">* Thông tin bắt buộc</i>

                </div>
                <div class="form-group" style="text-align: center">
                    <button type="submit" class="btn  buttonC">ĐĂNG KÝ</button>

                </div>
            </form>

        </div>

    </div>
</section>

