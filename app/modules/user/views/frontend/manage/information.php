<div id="main" class="wrapper main-view-shop">
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url()?>">Trang chủ  /</a></li>
                <li><a href="information.html">Thông tin tài khoản</a></li>
            </ul>
        </div>
    </div>

    <div class="main-account">
        <div class="container">
            <div class="conten-account">
                <div class="row">
                    <?php echo $this->load->view('user/frontend/manage/aside')?>

                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <form class="account-right" action="" method="post" enctype="multipart/form-data">
                            <h2 class="title-primary">Tài khoản của tôi</h2>
                            <div class="input-file">

                                <input type="file" name="profile_pic">
                            </div>
                            <div class="nav-account-right">
                                <div class="item">
                                    <?php
                                    $error = validation_errors();
                                    echo (!empty($error) && isset($error)) ? '<div class="alert alert-danger">'.$error.'</div>' : '';
                                    ?>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item">
                                    <div class="left"><label for="">Tên tài khoản</label></div>
                                    <div class="right">
                                        <p><?php echo $detailCustomer['email']?></p>

                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item">
                                    <div class="left"><label for="">Họ và tên</label></div>
                                    <div class="right">
                                        <?php echo form_input('fullname', set_value('fullname',$detailCustomer['fullname']), 'class="field__input" placeholder="Họ và tên" autocomplete="off"');?>

                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item">
                                    <div class="left"><label for="">Số điện thoại</label></div>
                                    <div class="right">
                                        <?php echo form_input('phone', set_value('phone',$detailCustomer['phone']), 'class="field__input" placeholder="Số điện thoại" autocomplete="off"');?>

                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item">
                                    <div class="left"><label for="">Địa chỉ</label></div>
                                    <div class="right">
                                        <?php echo form_input('address', set_value('address',$detailCustomer['address']), 'class="field__input" placeholder="Địa chỉ" autocomplete="off"');?>

                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="item">
                                    <div class="left"><label for="">Ngày sinh</label></div>
                                    <div class="right">
                                        <?php echo form_input('birthday', set_value('birthday',$detailCustomer['birthday']), 'class="field__input" placeholder="Ngày sinh" autocomplete="off"');?>


                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item">
                                    <div class="left"><label for="">Zalo</label></div>
                                    <div class="right">
                                        <?php echo form_input('zalo', set_value('zalo',$detailCustomer['zalo']), 'class="field__input" placeholder="Zalo" autocomplete="off"');?>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item">
                                    <div class="left"><label for="">Giới tính</label></div>
                                    <div class="right">
                                        <?php echo form_dropdown('gender', $this->configbie->data('gender'), set_value('gender',$detailCustomer['gender']), 'class="field__input" placeholder="" autocomplete="off"');?>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>


                            </div>
                            <?php
                                if($detailCustomer['catalogueid'] == 1){
                            ?>
                            <h2 class="title-primary">Thông tin shop</h2>

                            <div class="nav-account-right">

                                <div class="item">
                                    <div class="left"><label for="">Mã QR</label></div>
                                    <div class="right">
                                        <input type="file" name="profile_pic_qr">
                                        <?php echo form_input('images_qr', set_value('images_qr',$detailCustomer['images_qr']), 'class="field__input" autocomplete="off"');?>


                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item">
                                    <div class="left"><label for="">Tên shop<span style="color: red">*</span></label></div>
                                    <div class="right">
                                        <?php echo form_input('account', set_value('account',$detailCustomer['account']), 'class="field__input" placeholder="Tên shop" autocomplete="off"');?>

                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item">
                                    <div class="left"><label for="">Tỉnh thành<span style="color: red">*</span></label></div>
                                    <div class="right">
                                        <?php
                                        $listCity = getLocation(array(
                                            'select' => 'name, provinceid',
                                            'table' => 'vn_province',
                                            'field' => 'provinceid',
                                            'text' => 'Chọn Tỉnh/Thành Phố'
                                        ));
                                        ?>
                                        <?php echo form_dropdown('cityid', $listCity,  set_value('cityid',$detailCustomer['cityid']), 'class="field__input"  id="city" placeholder="" autocomplete="off"');?>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item">
                                    <div class="left"><label for="">Loại cửa hàng<span style="color: red">*</span></label></div>
                                    <div class="right">
                                        <?php
                                        $dropdown = $this->Autoload_Model->_get_where(array('table' => 'product_catalogue', 'select' => 'id, title, parentid, lft, rgt, level, order', 'order_by' => 'lft ASC, order ASC', 'where' => array('publish' => 0, 'alanguage' => $this->fc_lang)), true);
                                        ?>
                                        <select class="field__input " name="product_catalogue_id" style="background-color: white">
                                            <option value="">Loại hình</option>
                                            <?php if (isset($dropdown) && is_array($dropdown)) { foreach ($dropdown as $key => $val) {?>
                                                <option <?php if(!empty($detailCustomer['product_catalogue_id'])){?><?php if($val['id'] == $detailCustomer['product_catalogue_id']){?>selected<?php }?><?php }?> value="<?php echo $val['id']?>"><?php echo str_repeat('|-----', (($val['level'] > 0) ? ($val['level'] - 1) : 0)) . $val['title']?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item">
                                    <div class="left"><label for="">Link website</label></div>
                                    <div class="right">
                                        <?php echo form_input('shop_link', set_value('shop_link',$detailCustomer['shop_link']), 'class="field__input " placeholder="Link website" autocomplete="off"');?>

                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="item">
                                    <div class="left"><label for="">Link fanpage facebook</label></div>
                                    <div class="right">
                                        <?php echo form_input('shop_link_fanpage', set_value('shop_link_fanpage',$detailCustomer['shop_link_fanpage']), 'class="field__input " placeholder="Link fanpage facebook" autocomplete="off"');?>

                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item">
                                    <div class="left"><label for="">Mô tả</label></div>
                                    <div class="right">
                                        <?php echo form_textarea('description', htmlspecialchars_decode(html_entity_decode(set_value('description', $detailCustomer['description']))), 'class="form-control ck-editor" id="ckDescription" placeholder="" autocomplete="off" '); ?>

                                    </div>
                                    <div class="clearfix"></div>
                                </div>



                            </div>
                            <?php }?>
                            <div class="nav-account-right">


                                <div class="item">
                                    <div class="left"></div>
                                    <div class="right" style="border: 0px">
                                        <input type="submit" name="update" class="btn btn-md btn-danger" value="Cập nhập">

                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<style>
    .field__input{
        border: 0px;
        width: 100%;
    }
</style>
<script>
    $('.litaikhoan .acc__panel').addClass('open');
</script>
<?php echo $this->load->view('user/frontend/product/script')?>
<script type="text/javascript">
    function openKCFinderAlbum(field, type, result) {
        window.KCFinder = {
            callBack: function (url) {
                field.attr('src', url);
                field.parent().next().val(url);
                window.KCFinder = null;
            }
        };
        if (typeof(type) == 'undefined') {
            type = 'images';
        }
        window.open('<?php echo BASE_URL;?>plugin/kcfinder-3.12-frontend/browse.php?type=' + type + '&dir=images/public', 'kcfinder_image',
            'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
            'resizable=1, scrollbars=0, width=1080, height=800'
        );
        return false;
    }

    $(document).on('click', '.img-thumbnail-1', function () {
        openKCFinderAlbum($(this));
    });
    $(document).on('click', '.img-thumbnail-2', function () {
        openKCFinderAlbum($(this));
    });
</script>
