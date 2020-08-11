<div id="main" class="wrapper main-change-pasword">
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url()?>">Trang chủ  /</a></li>
                <li><a href="create-product.html">Thêm mới sản phẩm</a></li>
            </ul>
        </div>
    </div>

    <div class="main-account">
        <div class="container">
            <div class="conten-account">
                <div class="row">
                    <?php echo $this->load->view('user/frontend/manage/aside') ?>


                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="account-right">
                            <h2 class="title-primary">Thêm sản phẩm</h2>
                            <div style="clear: both;height: 6px"></div>
                            <div id="page-wrapper" class="gray-bg dashbard-1 fix-wrapper ">

                                <form method="post" action="" class="form-horizontal box">


                                    <script type="text/javascript">
                                        var submit = '<?php echo $this->input->post('create'); ?>';
                                        var catalogueid = '<?php echo json_encode($this->input->post('catalogue')); ?>';
                                        var tag = '<?php echo json_encode($this->input->post('tag')); ?>';
                                    </script>
                                    <div class="wrapper wrapper-content animated fadeInRight">
                                        <div class="row">
                                            <div class="box-body">
                                                <?php $error = validation_errors();
                                                echo !empty($error) ? '<div class="alert alert-danger">' . $error . '</div>' : ''; ?>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 clearfix">
                                                <div class="ibox mb20">

                                                    <div class="ibox-content">
                                                        <div class="row mb15">
                                                            <div class="col-lg-12">
                                                                <div class="form-row">
                                                                    <label class="control-label text-left">
                                                                        <span>Tiêu đề sản phẩm<b class="text-danger">(*)</b></span>
                                                                    </label>
                                                                    <input type="hidden" value="" name="catalogue[]">
                                                                    <?php echo form_input('title', htmlspecialchars_decode(html_entity_decode(set_value('title'))), 'class="form-control title" placeholder="" id="title" autocomplete="off"'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb15">
                                                            <div class="col-lg-12">
                                                                <div class="form-row">
                                                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                                        <label class="control-label ">
                                                                            <span>Đường dẫn <b class="text-danger">(*)</b></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="outer">
                                                                        <div class="uk-flex uk-flex-middle">
                                                                            <div class="base-url"><?php echo base_url(); ?></div>
                                                                            <?php echo form_input('canonical', htmlspecialchars_decode(html_entity_decode(set_value('canonical'))), 'class="form-control canonical" placeholder="" autocomplete="off" data-flag="0" '); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="ibox mb20 album">
                                                    <div class="ibox-title">
                                                        <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                            <h5>Album Ảnh </h5>
                                                        </div>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <?php $album = $this->input->post('album'); ?>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class='content'>
                                                                    <div class="dropzone" id="myAwesomeDropzone"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="listalbums"></div>
                                                    </div>
                                                </div>

                                                <div class="ibox mb20 block-detail-product">
                                                    <div class="ibox-title uk-flex uk-flex-middle uk-flex-space-between">
                                                        <h5>THÔNG TIN CHI TIẾT</h5>
                                                    </div>
                                                    <div class="ibox mb20">

                                                        <?php
                                                        $dropdown = $this->Autoload_Model->_get_where(array('table' => 'product_catalogue', 'select' => 'id, title, parentid, lft, rgt, level, order', 'order_by' => 'lft ASC, order ASC', 'where' => array('publish' => 0, 'alanguage' => $this->fc_lang)), true);
                                                        ?>
                                                        <div class="ibox-content">
                                                            <div class="row mb15">
                                                                <div class="col-lg-12">
                                                                    <div class="form-row">
                                                                        <label class="control-label text-left">
                                                                            <span>Danh mục sản phẩm <b class="text-danger">(*)</b></span>
                                                                        </label>
                                                                        <div class="form-row">
                                                                            <select name="catalogueid" style="height: 32px;border: 1px solid #c4cdd5;padding-left: 10px;font-size: 12px;border-radius: 5px;width: 100%;" >
                                                                                <?php if(!empty($dropdown)){ ?>
                                                                                    <?php foreach($dropdown as $key=>$val){?>
                                                                                        <option <?php if($val['id'] == $detailCustomer['product_catalogue_id']){?>selected<?php }?> value="<?php echo $val['id']?>"><?php echo str_repeat('|-----', (($val['level'] > 0) ? ($val['level'] - 1) : 0)) . $val['title']?></option>
                                                                                    <?php }?>
                                                                                <?php }?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ibox mb20">

                                                        <div class="ibox-content">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="form-row">
                                                                        <span class="text-black mb15">Quản lý thiết lập hiển thị.</span>
                                                                        <div style="display: flex">
                                                                            <div class="block clearfix">
                                                                                <div class="i-checks mr30" style="width:100%;"><span
                                                                                        style="color:#000;"> <input <?php echo ($this->input->post('publish') == 0) ? 'checked' : '' ?>
                                                                                            class="popup_gender_1 gender" type="radio" value="0"
                                                                                            name="publish"> <i></i>Hiển thị</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="block clearfix">
                                                                                <div class="i-checks" style="width:100%;"><span style="color:#000;"> <input
                                                                                            type="radio" <?php echo ($this->input->post('publish') == 1) ? 'checked' : '' ?>
                                                                                            class="popup_gender_0 gender" required value="1" name="publish"> <i></i>Ẩn </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php $currentDate = gmdate('d/m/Y', time() + 7*3600); ?>
                                                                    <?php $currentTime = gmdate('H:i', time() + 7*3600); ?>
                                                                    <div class="post-setting hidden">
                                                                        <a href="" title="" class="setting-button mb5" data-flag="0">Thiết lập ngày/giờ hiển thị</a>
                                                                        <div class="setting-group ">
                                                                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                                                <?php echo form_input('post_date', htmlspecialchars_decode(html_entity_decode(set_value('post_date', $currentDate))), 'class="form-control datetimepicker" placeholder=""  autocomplete="off"');?>
                                                                                <span style="margin-right:5px;color:#141414;">lúc</span>
                                                                                <?php echo form_input('post_time', htmlspecialchars_decode(html_entity_decode(set_value('post_time', $currentTime))), 'class="form-control" placeholder="" id="input-clock" autocomplete="off" data-default="20:48"');?>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="ibox-content">
                                                        <div class="row">
                                                            <div class="col-lg-6 m-b">
                                                                <label class="control-label ">
                                                                    <span>Giá<b class="text-danger">(*)</b></span>
                                                                </label>

                                                                <div class="form-row">
                                                                    <?php echo form_input('price', set_value('price', 0), 'class=" m-b-sm form-control " placeholder="đ" autocomplete="off"'); ?>
                                                                    <div class="uk-flex uk-flex-middle">
                                                                        <div class="m-r-sm">
                                                                            <?php if (isset($price_contact) && $price_contact == 1) { ?>
                                                                                <input type="checkbox" checked name="price_contact" value="1"
                                                                                       id="checkbox-item">
                                                                            <?php } else { ?>
                                                                                <input type="checkbox" name="price_contact" value="1"
                                                                                       id="checkbox-item">
                                                                            <?php } ?>
                                                                        </div>
                                                                        <div style="margin-left: 5px">
                                                                            Liên hệ để biết giá
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 m-b">
                                                                <label class="control-label ">
                                                                    <span>Giá khuyến mại</span>
                                                                </label>

                                                                <div class="form-row">
                                                                    <?php echo form_input('price_sale', set_value('price_sale', 0), 'class="form-control " placeholder="đ" autocomplete="off"'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php /*?>
                                                        <div class="row" style="margin-top: 20px">
                                                            <div class="col-lg-6 mb15">
                                                                <label class="control-label ">
                                                                    <span>Mã sản phẩm<b class="text-danger">(*)</b></span>
                                                                </label>

                                                                <div class="form-row">
                                                                    <?php $code = CodeRender('product') ?>
                                                                    <?php echo form_input('code', set_value('code', $code), 'class="form-control" placeholder="SP001" autocomplete="off"'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 mb15">
                                                                <label class="control-label ">
                                                                    <span>Thời gian khuyến mại</span>
                                                                </label>

                                                                <div class="form-row">
                                                                    <?php echo form_input('time_sale', htmlspecialchars_decode(html_entity_decode(set_value('time_sale'))), 'class="form-control datetimepicker" placeholder=""  autocomplete="off"');?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row" style="margin-top: 20px">
                                                            <div class="col-lg-12 mb15">
                                                                <label class="control-label ">
                                                                    <span>Khuyến mại</span>
                                                                </label>
                                                                <div class="form-row">
                                                                    <?php echo form_input('khuyenmai', set_value('khuyenmai'), 'class="form-control" placeholder="Khuyến mại" autocomplete="off"'); ?>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row" style="margin-top: 20px">
                                                            <div class="col-lg-12 mb15">
                                                                <label class="control-label ">
                                                                    <span>Mô tả</span>
                                                                </label>
                                                                <div class="form-row">
                                                                    <?php echo form_textarea('mota',htmlspecialchars_decode(html_entity_decode(set_value('mota'))), 'class="form-control" placeholder="" autocomplete="off"'); ?>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <?php */?>

                                                    </div>
                                                </div>
                                                <div class="row mb15">
                                                    <div class="col-lg-12 m-b">
                                                        <div class="form-row">
                                                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                                <label class="control-label text-left">
                                                                    <span>Nội dung</span>
                                                                </label>

                                                            </div>
                                                            <?php echo form_textarea('description', htmlspecialchars_decode(html_entity_decode(set_value('description'))), 'class="form-control ck-editor" id="ckDescription" placeholder="" autocomplete="off" '); ?>
                                                        </div>
                                                    </div>

                                                </div>
                                                <button type="submit" name="create" value="create" class="btn btn-success block m-b pull-right">Tạo mới
                                                </button>
                                            </div>
                                            <?php /*?>
                                            <div class="col-lg-4">



                                                <div class="ibox mb20">
                                                    <div class="ibox-title uk-flex uk-flex-middle uk-flex-space-between">
                                                        <h5>Phân loại </h5>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <div class="row mb15">
                                                            <div class="col-lg-12">
                                                                <div class="form-row">
                                                                    <label class="control-label text-left">
                                                                        <span>Quốc gia <b class="text-danger">(*)</b></span>
                                                                    </label>
                                                                    <?php $nationalityDropdown = nationalityDropdown();?>
                                                                    <div class="form-row">
                                                                        <select name="nationality" style="height: 32px;border: 1px solid #c4cdd5;padding-left: 10px;font-size: 12px;border-radius: 5px;width: 100%;" >
                                                                            <?php if(!empty($nationalityDropdown)){ ?>

                                                                                <?php foreach($nationalityDropdown as $key=>$val){?>
                                                                                    <option <?php if($val=='Vietnamese'){?>selected<?php }?> value="<?php echo $val?>"><?php echo $val?></option>
                                                                                <?php }?>
                                                                            <?php }?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>


                                            </div>
                                            <?php */?>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<?php echo $this->load->view('user/frontend/product/script')?>
<script>
    $(document).ready(function () {
        Dropzone.autoDiscover = false;
        $("#myAwesomeDropzone").dropzone({
            url: "uploaddropzone.html",
            addRemoveLinks: true,
            removedfile: function(file) {
                var name = file.name;
                var result = file.name.split('.');
                $('#'+result[0]).remove();
                $.ajax({
                    type: 'POST',
                    url: 'uploaddropzone.html',
                    data: {name: name,request: 2},
                    sucess: function(e){
                        alert(e);
                    }
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            },
            success: function (file, response) {
                var imgName = response;
                file.previewElement.classList.add("dz-success");
                //console.log("Successfully uploaded :" + imgName);
                $('#listalbums').append(imgName);
            },
            error: function (file, response) {
                file.previewElement.classList.add("dz-error");
            }
        });
    });
</script>

<script>
    $('.lisanpham .acc__panel').addClass('open');
</script>