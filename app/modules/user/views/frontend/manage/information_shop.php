<div id="main" class="wrapper main-view-shop">
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url()?>">Trang chủ  /</a></li>
                <li><a href="information-shop.html">HỒ SƠ SHOP</a></li>
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
                            <h2 class="title-primary">Hồ sơ shop</h2>
                            <div class="hososhop">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <input id="uploadBtn" type="file" class="upload hidden" name="upload"/>
                                        <label class="item" for="uploadBtn" style="width: 100%" id="msg">
                                            <?php if (file_exists(FCPATH . $detailCustomer['images'])) {?>
                                                <img src="<?php echo $detailCustomer['images']?>" alt="<?php echo $detailCustomer['account']?>" style="height: 75px;width: 100%;"/>
                                                <h4 class="title1" style="color: #012196;position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);">Tải lên ảnh shop</h4>
                                            <?php } else {?>
                                                <div class="icon">
                                                    <img src="template/frontend/images/hs1.png" alt="<?php echo $detailCustomer['images']?>" style="width: 35px;height: 30px">
                                                </div>
                                                <h4 class="title1" style="color: #012196">Tải lên ảnh shop</h4>
                                            <?php } ?>



                                        </label>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12" style="margin-bottom: 4px">
                                        <?php if($detailCustomer['urlvideo']!=''){?>

                                                <div class="item" style="background: url(https://i.ytimg.com/vi/<?php echo $detailCustomer['urlvideo']?>/mqdefault.jpg)">
                                                    <div class="icon">
                                                        <a href="https://www.youtube.com/watch?v=<?php echo $detailCustomer['urlvideo']?>" target="_blank"><img src="template/frontend/images/hs2.png" alt="Tải lên video Youtube"></a>
                                                    </div>
                                                    <h4 class="title1"><a href="javascript:void(0)" data-toggle="modal" data-target="#taivideo">Tải lên video Youtube </a></h4>
                                                </div>


                                        <?php }else{?>
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#taivideo">
                                                <div class="item">
                                                    <div class="icon">
                                                        <img src="template/frontend/images/hs2.png" alt="Tải lên video Youtube">
                                                    </div>
                                                    <h4 class="title1">Tải lên video Youtube</h4>
                                                </div>
                                            </a>
                                        <?php }?>

                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">

                                        <input id="uploadBtnQr" type="file" class="upload hidden" name="upload"/>
                                        <label class="item" for="uploadBtnQr" style="width: 100%;height: 118px;" id="msgQr">
                                            <?php if (file_exists(FCPATH . $detailCustomer['images_qr']) && $detailCustomer['images_qr']!='') {?>
                                                <img src="<?php echo $detailCustomer['images_qr']?>" alt="<?php echo $detailCustomer['account']?>" style="max-height: 100%;"/>
                                                <h4 class="title1" style="color: #012196;position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);">Tải lên ảnh shop</h4>
                                            <?php } else {?>
                                                <div class="icon">
                                                    <img src="template/frontend/images/hs3.png" alt="<?php echo $detailCustomer['images_qr']?>" style="width: 35px;height: 30px">
                                                </div>
                                                <h4 class="title1" style="color: #012196">Tải lên ảnh shop</h4>
                                            <?php } ?>

                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <?php
                                $error = validation_errors();
                                echo (!empty($error) && isset($error)) ? '<div class="alert alert-danger">'.$error.'</div>' : '';
                                ?>
                                <div class="clearfix"></div>
                            </div>
                            <div class="nav-account-right">
                                <div class="item">
                                    <div class="left"><label for="">Tên shop<span style="color: red">*</span></label></div>
                                    <div class="right">
                                        <?php echo form_input('account', set_value('account',$detailCustomer['account']), 'class="field__input" placeholder="Tên shop" autocomplete="off"');?>

                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item">
                                    <div class="left"><label for="">Điện thoại shop<span style="color: red">*</span></label></div>
                                    <div class="right">
                                        <?php echo form_input('phone', set_value('phone',$detailCustomer['phone']), 'class="field__input" placeholder="Điện thoại shop" autocomplete="off"');?>


                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="item">
                                    <div class="left"><label for="">Địa chỉ shop<span style="color: red">*</span></label></div>
                                    <div class="right">
                                        <?php echo form_input('address', set_value('address',$detailCustomer['address']), 'class="field__input" placeholder="Địa chỉ shop" autocomplete="off"');?>

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
    $(document).ready(function(){
        $(document).on('change','#uploadBtn',function(){
            var property = document.getElementById('uploadBtn').files[0];
            var image_name = property.name;
            var image_extension = image_name.split('.').pop().toLowerCase();

            if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png']) == -1){
                alert("Hình ảnh không hợp lệ");
            }
            var form_data = new FormData();
            form_data.append("file",property);
            $.ajax({
                url:'upload.html',
                method:'POST',
                data:form_data,
                contentType:false,
                cache:false,
                processData:false,
                success:function(data){
                    $('#msg').html(data);
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','#uploadBtnQr',function(){
            var property = document.getElementById('uploadBtnQr').files[0];
            var image_name = property.name;
            var image_extension = image_name.split('.').pop().toLowerCase();

            if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png']) == -1){
                alert("Hình ảnh không hợp lệ");
            }
            var form_data = new FormData();
            form_data.append("file",property);
            $.ajax({
                url:'uploadQr.html',
                method:'POST',
                data:form_data,
                contentType:false,
                cache:false,
                processData:false,
                success:function(data){
                    $('#msgQr').html(data);
                }
            });
        });
    });
</script>

<div id="taivideo" class="modal fade dangky-dangnhap" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <h2 style="font-size: 14px;margin-top: 0px">Thêm URL video Youtube</h2>
                <p>Nhúng video Youtube vào hồ sơ Shop bằng cách dán URL bên dưới. Ví dụ:   <span style="color: #e84f20;">https://www.youtube.com/watch?v=hJbRpHZr_d0</span></p>
                <form role="form" method="post" action="uploadVideo.html" id="uploadVideo">
                    <div class="error alert"></div>
                    <?php echo form_input('urlvideo', set_value('urlvideo'), 'id="input_urlvideo" placeholder="URL video Youtube"');?>
                    <div class="creat-admin">
                        <button type="submit" class="btn btn-success" >Lưu</button>
                        <button type="button" class="btn" data-dismiss="modal">Hủy</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#uploadVideo .error').hide();
        var uri = $('#uploadVideo').attr('action');
        $('#uploadVideo').on('submit', function () {
            var postData = $(this).serializeArray();
            $.post(uri, {post: postData, urlvideo: $('#input_urlvideo').val()}, function (data) {
                var json = JSON.parse(data);
                $('#uploadVideo .error').show();
                if (json.error.length) {
                    $('#uploadVideo .error').removeClass('alert alert-success').addClass('alert alert-danger');
                    $('#uploadVideo .error').html('').html(json.error);
                } else {
                    $('#uploadVideo .error').removeClass('alert alert-danger').addClass('alert alert-success');
                    $('#uploadVideo .error').html('').html('Cập nhập video thành công');
                    $('#uploadVideo').trigger("reset");
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                }
            });
            return false;
        });
    });
</script>