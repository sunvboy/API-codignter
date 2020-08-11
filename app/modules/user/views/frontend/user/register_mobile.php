<div class="page-body-buong page-register">
    <div class="wapper">
        <div class="container">
            <a href="" class="logo"><img src="<?php echo $this->fcSystem['homepage_logo'] ?>" alt="<?php echo $this->fcSystem['homepage_company'] ?>"></a>
            <div class="row">
                <div class="box_reg">
                    <div class="box_reg_left pull-left">

                        <div class="m_banner_reg">
                            <div class="title_reg_left">
                                <a href="javascript:void(0)">Đăng ký trở thành đối tác</a>
                                <div class="text-center font_defaul text_bt">
                                    Tham gia hệ thống cùng hơn 150 cửa hàng
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box_reg_right pull-right">
                        <form action="" method="post"  id="contact_form">

                            <div class="frm_register">
                                <div class="frm_reg_right">
                                    <?php
                                    $error = validation_errors();
                                    echo (!empty($error) && isset($error)) ? '<div class="alert alert-danger">'.$error.'</div>' : '';
                                    ?>
                                </div>
                                <div class="frm_reg_right">
                                    <span class="number_reg">1.</span><span class="_title_frm font_defaul">Thông tin đăng nhập</span>
                                    <?php echo form_input('email', set_value('email'), 'class="field__input form-control" placeholder="Email(Tài khoản đăng nhập)" autocomplete="off" required');?>
                                    <?php echo form_password('password', set_value('password'), 'class="field__input form-control" placeholder="Mật khẩu" autocomplete="off" required');?>
                                    <?php echo form_password('reg_password', set_value('reg_password'), 'class="field__input form-control" placeholder="Nhập lại mật khẩu" autocomplete="off" required');?>
                                </div>
                                <div class="frm_reg_right">
                                    <span class="number_reg">2.</span><span class="_title_frm font_defaul">Thông tin cá nhân</span>
                                    <?php echo form_input('fullname', set_value('fullname'), 'class="field__input form-control" placeholder="Họ và tên*" autocomplete="off" required');?>
                                    <?php echo form_input('phone', set_value('phone'), 'class="field__input form-control" placeholder="Số điện thoại*" autocomplete="off" required');?>
                                </div>
                                <div class="frm_reg_right pdtop20">
                                    <span class="number_reg">3.</span><span class="_title_frm font_defaul">Thông tin cửa hàng</span>
                                    <?php echo form_input('account', set_value('account'), 'class="field__input form-control" placeholder="Tên cửa hàng*" autocomplete="off" required');?>
                                    <?php
                                    $dropdown = $this->Autoload_Model->_get_where(array('table' => 'product_catalogue', 'select' => 'id, title, parentid, lft, rgt, level, order', 'order_by' => 'lft ASC, order ASC', 'where' => array('publish' => 0, 'alanguage' => $this->fc_lang)), true);
                                    ?>
                                    <select class="selInfor select-cate" name="product_catalogue_id" style="background-color: white" required>
                                        <option value="" >Loại hình</option>
                                        <?php if (isset($dropdown) && is_array($dropdown)) { foreach ($dropdown as $key => $val) {?>
                                            <option <?php if(!empty($_POST['product_catalogue_id'])){?><?php if($val['id'] == $_POST['product_catalogue_id']){?>selected<?php }?><?php }?> value="<?php echo $val['id']?>"><?php echo str_repeat('|-----', (($val['level'] > 0) ? ($val['level'] - 1) : 0)) . $val['title']?></option>
                                        <?php }}?>
                                    </select>
                                    <?php echo form_input('address', set_value('address'), 'class="field__input form-control" placeholder="Địa chỉ*" autocomplete="off" required');?>

                                    <?php
                                    $listCity = getLocation(array(
                                        'select' => 'name, provinceid',
                                        'table' => 'vn_province',
                                        'field' => 'provinceid',
                                        'text' => 'Chọn Tỉnh/Thành Phố'
                                    ));
                                    ?>
                                    <?php echo form_dropdown('cityid', $listCity, '', 'class="selInfor select-cate"  id="city" placeholder="" autocomplete="off"');?>
                                    <?php echo form_input('shop_link', set_value('shop_link'), 'class="field__input form-control" placeholder="Link website" autocomplete="off"');?>
                                    <?php echo form_input('shop_link_fanpage', set_value('shop_link_fanpage'), 'class="field__input form-control" placeholder="Link fanpage facebook" autocomplete="off"');?>
                                    <div class="clearfix"></div>
                                    <div class="btn_submit">
                                        <button class="button" type="submit" name="register" value="register" id="submitform">
                                            ĐĂNG KÝ
                                        </button>
                                        <button class="button" type="button" id="gif">
                                            Dữ liệu đang được xử lý...
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

</div>
<style>
    header,footer{
        display: none;
    }
</style>
<script>
    var cityid = '<?php echo $this->input->post('cityid'); ?>';
    var districtid = '<?php echo $this->input->post('districtid') ?>';
    var wardid = '<?php echo $this->input->post('wardid') ?>';
</script>
<script type="text/javascript">
    $('#gif').hide();
    $('#contact_form').submit(function() {
        $('#submitform').hide();
        $('#gif').show();
        return true;
    });
</script>