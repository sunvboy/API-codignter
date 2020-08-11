<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url()?>"><i class="fa fa-home"></i></a></li>
        <li><a href="javascript:void(0);">Thông tin tài khoản</a></li>
    </ul>

    <div class="row">
        <!--Middle Part Start-->
        <div class="col-sm-9" id="content">
            <h2 class="subtitle">Thông tin tài khoản</h2>
            <p class="lead" style="margin-bottom: 0px">Xin chào, <strong><?php echo $detailCustomer['fullname']?></strong> - Để cập nhật thông tin tài khoản của bạn.</p>
            <p style="color: red"><i>*Vui lòng điền đầy đủ thông tin bên dưới</i></p>
            <form method="post" action="">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $error = validation_errors();
                        echo (!empty($error) && isset($error)) ? '<div class="alert alert-danger">'.$error.'</div>' : '';
                        ?>

                    </div>
                    <div class="col-sm-6">

                        <fieldset id="personal-details">
                            <legend>Hình ảnh công ty</legend>

                            <div class="form-group">
                                <div id='img_contain' >
                                    <div class="upload-btn-wrapper">
                                        <div class="avatar" style="margin-bottom: 10px;cursor: pointer;"><img src="<?php echo (isset( $detailCustomer['avatar']) && !empty( $detailCustomer['avatar']))? $detailCustomer['avatar']: 'templates/not-found.png'; ?>" class="img-thumbnail img-thumbnail-1" alt="" style="width: 113px;border-radius: 100%;object-fit: cover;height: 113px !important;" />
                                        </div>
                                        <?php echo form_input('avatar', set_value('avatar',$detailCustomer['avatar']), 'class="form-control"  placeholder="Icon"  '); ?>
                                    </div>
                                </div>
                                <div id='img_contain-images' >
                                    <div class="upload-btn-wrapper">
                                        <div class="avatar" style="margin-bottom: 10px;cursor: pointer;"><img src="<?php echo (isset( $detailCustomer['images']) && !empty( $detailCustomer['images']))? $detailCustomer['images']: 'templates/not-found.png'; ?>" class="img-thumbnail img-thumbnail-2" alt="" style="width: 113px;border-radius: 100%;object-fit: cover;height: 113px !important;" />
                                        </div>
                                        <?php echo form_input('images', set_value('images',$detailCustomer['images']), 'class="form-control"  placeholder="Ảnh đại diện"  '); ?>
                                    </div>
                                    <p class="desc">Dụng lượng file tối đa 1 MB<br> Định dạng:.JPEG, .PNG</p>
                                </div>

                            </div>

                            <div class="form-group required">
                                <label for="input-firstname" class="control-label">Email(Tên tài khoản)</label>
                                <input type="text" class="form-control" value="<?php echo $detailCustomer['email']?>" readonly>
                            </div>
                            <div class="form-group required">
                                <label for="input-lastname" class="control-label">Họ và tên*</label>
                                <?php echo form_input('fullname', set_value('fullname',$detailCustomer['fullname']), 'class="field__input form-control" placeholder="Họ và tên" autocomplete="off"');?>
                            </div>

                            <div class="form-group required">
                                <label for="input-telephone" class="control-label">Số điện thoại*</label>
                                <?php echo form_input('phone', set_value('phone',$detailCustomer['phone']), 'class="field__input form-control" placeholder="Số điện thoại" autocomplete="off"');?>
                            </div>

                        </fieldset>
                        <br>
                    </div>
                    <div class="col-sm-6">
                        <fieldset id="address">
                            <legend>Thông tin cửa hàng</legend>

                            <div class="form-group required">
                                <label for="input-address-1" class="control-label">Tên cửa hàng*</label>
                                <?php echo form_input('account', set_value('account',$detailCustomer['account']), 'class="field__input form-control" placeholder="Tên cửa hàng" autocomplete="off"');?>
                            </div>
                            <div class="form-group ">
                                <label for="input-country" class="control-label">Loại hình</label>
                                <?php
                                $dropdown = $this->Autoload_Model->_get_where(array('table' => 'product_catalogue', 'select' => 'id, title, parentid, lft, rgt, level, order', 'order_by' => 'lft ASC, order ASC', 'where' => array('publish' => 0, 'alanguage' => $this->fc_lang)), true);
                                ?>
                                <select class="field__input form-control" name="product_catalogue_id" style="background-color: white">
                                    <option value="" >Loại hình</option>
                                    <?php if (isset($dropdown) && is_array($dropdown)) { foreach ($dropdown as $key => $val) {?>
                                        <option <?php if(!empty($detailCustomer['product_catalogue_id'])){?><?php if($val['id'] == $detailCustomer['product_catalogue_id']){?>selected<?php }?><?php }?> value="<?php echo $val['id']?>"><?php echo str_repeat('|-----', (($val['level'] > 0) ? ($val['level'] - 1) : 0)) . $val['title']?></option>
                                    <?php }}?>
                                </select>

                            </div>
                            <div class="form-group required">
                                <label for="input-address-1" class="control-label">Địa chỉ*</label>
                                <?php echo form_input('address', set_value('address',$detailCustomer['address']), 'class="field__input form-control" placeholder="Địa chỉ" autocomplete="off"');?>
                            </div>
                            <div class="form-group ">
                                <label for="input-country" class="control-label">Tỉnh/Thành phố</label>
                                <?php
                                $listCity = getLocation(array(
                                    'select' => 'name, provinceid',
                                    'table' => 'vn_province',
                                    'field' => 'provinceid',
                                    'text' => 'Chọn Tỉnh/Thành Phố'
                                ));
                                ?>
                                <?php echo form_dropdown('cityid', $listCity, '', 'class="field__input form-control"  id="city" placeholder="" autocomplete="off"');?>
                            </div>

                            <div class="form-group ">
                                <label for="input-zone" class="control-label">Thời gian mở cửa</label>
                                <?php echo form_input('time_open', set_value('time_open',$detailCustomer['time_open']), 'class="field__input form-control" placeholder="Thời gian mở cửa" autocomplete="off"');?>

                            </div>

                            <script>
                                var cityid = '<?php echo $detailCustomer['cityid']; ?>';
                                var districtid = '<?php echo $detailCustomer['districtid'] ?>';
                                var wardid = '<?php echo $detailCustomer['wardid'] ?>';
                            </script>
                        </fieldset>
                        <fieldset id="address">
                            <legend>Kết nối cửa hàng</legend>



                            <div class="form-group ">
                                <label for="input-zone" class="control-label">Link website</label>
                                <?php echo form_input('shop_link', set_value('shop_link',$detailCustomer['shop_link']), 'class="field__input form-control" placeholder="Link fanpage/ website cửa hàng" autocomplete="off"');?>

                            </div>
                            <div class="form-group ">
                                <label for="input-zone" class="control-label">Link fanpage</label>
                                <?php echo form_input('shop_link_fanpage', set_value('shop_link_fanpage',$detailCustomer['shop_link_fanpage']), 'class="field__input form-control" placeholder="Link fanpage" autocomplete="off"');?>

                            </div>
                            <div class="form-group ">
                                <label for="input-zone" class="control-label">Link instagram</label>
                                <?php echo form_input('shop_link_instagram', set_value('shop_link_instagram',$detailCustomer['shop_link_instagram']), 'class="field__input form-control" placeholder="Link instagram" autocomplete="off"');?>

                            </div>


                        </fieldset>
                    </div>
                    <div class="col-md-12">
                        <fieldset id="address">
                            <div class="ibox-title">
                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                    <h5>Một số hình ảnh khác </h5>

                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                        <div class="edit">
                                            <a onclick="openKCFinderImage(this);return false;" href="" title="" class="upload-picture">Chọn hình</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-content" style="border: 0px;padding: 0px">
                                <?php
                                $album = $this->input->post('album');
                                if(!empty($album) && is_array($album) && count($album)){
                                    $album = $album;
                                }else{
                                    $album = json_decode(base64_decode($detailCustomer['image_json']), true);
                                }
                                ?>
                                <div class="click-to-upload" <?php echo (isset($album))?'style="display:none"':'' ?>>
                                    <div class="icon">
                                        <a type="button" class="upload-picture" onclick="openKCFinderImage(this);return false;">
                                            <svg style="width:80px;height:80px;fill: #d3dbe2;margin-bottom: 10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80"><path d="M80 57.6l-4-18.7v-23.9c0-1.1-.9-2-2-2h-3.5l-1.1-5.4c-.3-1.1-1.4-1.8-2.4-1.6l-32.6 7h-27.4c-1.1 0-2 .9-2 2v4.3l-3.4.7c-1.1.2-1.8 1.3-1.5 2.4l5 23.4v20.2c0 1.1.9 2 2 2h2.7l.9 4.4c.2.9 1 1.6 2 1.6h.4l27.9-6h33c1.1 0 2-.9 2-2v-5.5l2.4-.5c1.1-.2 1.8-1.3 1.6-2.4zm-75-21.5l-3-14.1 3-.6v14.7zm62.4-28.1l1.1 5h-24.5l23.4-5zm-54.8 64l-.8-4h19.6l-18.8 4zm37.7-6h-43.3v-51h67v51h-23.7zm25.7-7.5v-9.9l2 9.4-2 .5zm-52-21.5c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3zm-13-10v43h59v-43h-59zm57 2v24.1l-12.8-12.8c-3-3-7.9-3-11 0l-13.3 13.2-.1-.1c-1.1-1.1-2.5-1.7-4.1-1.7-1.5 0-3 .6-4.1 1.7l-9.6 9.8v-34.2h55zm-55 39v-2l11.1-11.2c1.4-1.4 3.9-1.4 5.3 0l9.7 9.7c-5.2 1.3-9 2.4-9.4 2.5l-3.7 1h-13zm55 0h-34.2c7.1-2 23.2-5.9 33-5.9l1.2-.1v6zm-1.3-7.9c-7.2 0-17.4 2-25.3 3.9l-9.1-9.1 13.3-13.3c2.2-2.2 5.9-2.2 8.1 0l14.3 14.3v4.1l-1.3.1z"></path></svg>
                                        </a>
                                    </div>
                                    <div class="small-text">Sử dụng nút <b>Chọn hình</b> để thêm hình.</div>
                                </div>
                                <div class="upload-list" <?php echo (isset($album))?'':'style="display:none"' ?> style="padding:5px;">
                                    <div class="row">
                                        <ul id="sortable" class="clearfix sortui">
                                            <?php if(isset($album) && is_array($album) && count($album)){ ?>
                                                <?php foreach($album as $key => $val){ ?>
                                                    <li class="ui-state-default">
                                                        <div class="thumb">
															<span class="image img-scaledown">
																<img src="<?php echo $val; ?>" alt="" /> <input type="hidden" value="<?php echo $val; ?>" name="album[]" />
															</span>
                                                            <div class="overlay"></div>
                                                            <div class="delete-image"><i class="fa fa-trash" aria-hidden="true"></i></div>
                                                        </div>
                                                    </li>
                                                <?php }} ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </fieldset>

                    </div>
                    <div class="col-md-12">
                        <fieldset id="address">
                            <div class="ibox-title">
                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                    <h5>Thông tin chi tiết</h5>
                                </div>
                            </div>
                            <?php echo form_textarea('description', htmlspecialchars_decode(html_entity_decode(set_value('description', $detailCustomer['description']))), 'class="form-control ck-editor" id="ckDescription" placeholder="" autocomplete="off" '); ?>
                        </fieldset>

                    </div>

                </div>



                <div class="buttons clearfix" style="margin-top: 20px">
                    <div class="pull-right">
                        <input type="submit" name="update" class="btn btn-md btn-primary" value="Cập nhập">
                    </div>
                </div>
            </form>
        </div>
        <!--Middle Part End-->
        <!--Right Part Start -->
        <?php echo $this->load->view('user/frontend/manage/aside')?>
        <!--Right Part End -->
    </div>
</div>
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
