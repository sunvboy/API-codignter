<div id="main" class="wrapper main-change-pasword">
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url() ?>">Trang chủ /</a></li>
                <li><a href="javascript:void(0)">Cập nhập sản phẩm</a></li>
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
                            <h2 class="title-primary">Cập nhập sản phẩm</h2>

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
                                                <div class="ibox mb10">

                                                    <div class="ibox-content">
                                                        <div class="row mb15">
                                                            <div class="col-lg-12">
                                                                <div class="form-row">
                                                                    <label class="control-label text-left">
                                                                        <span>Tiêu đề sản phẩm<b
                                                                                class="text-danger">(*)</b></span>
                                                                    </label>
                                                                    <input type="hidden" value="" name="catalogue[]">
                                                                    <?php echo form_input('title', htmlspecialchars_decode(html_entity_decode(set_value('title', $product['title']))), 'class="form-control title" placeholder="" id="title" autocomplete="off"'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb15">
                                                            <div class="col-lg-12">
                                                                <div class="form-row">
                                                                    <div
                                                                        class="uk-flex uk-flex-middle uk-flex-space-between">
                                                                        <label class="control-label ">
                                                                            <span>Đường dẫn <b
                                                                                    class="text-danger">(*)</b></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="outer">
                                                                        <div class="uk-flex uk-flex-middle">
                                                                            <div
                                                                                class="base-url"><?php echo base_url(); ?></div>
                                                                            <?php echo form_input('canonical', htmlspecialchars_decode(html_entity_decode(set_value('canonical', $product['canonical']))), 'class="form-control canonical" placeholder="" autocomplete="off" data-flag="0" '); ?>

                                                                            <?php echo form_input('original_canonical', htmlspecialchars_decode(html_entity_decode(set_value('canonical', $product['canonical']))), 'class="form-control" placeholder="" style="display:none;" autocomplete="off"'); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="ibox mb10 album">
                                                    <div class="ibox-title">
                                                        <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                            <h5>Album Ảnh </h5>


                                                        </div>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <?php
                                                        $album = $this->input->post('album');
                                                        if (!empty($album) && is_array($album) && count($album)) {
                                                            $album = $album;
                                                        } else {
                                                            $album = json_decode(base64_decode($product['image_json']), true);
                                                        }
                                                        ?>
                                                        <div class="row">
                                                            <div class="col-lg-12">

                                                                <div class="content content_update">
                                                                    <div class="dropzone dz-clickable dz-started " id="myAwesomeDropzone">
                                                                        <?php if (isset($album) && is_array($album) && count($album)) { ?>
                                                                            <?php foreach ($album as $key => $val) {  $ex_tmp0 = explode('/', $val);
                                                                                $ex_tmp1 = explode('.', $ex_tmp0[3])?>
                                                                                <div class="dz-preview dz-processing dz-image-preview dz-success dz-complete <?php echo $ex_tmp1[0]?>">
                                                                                    <input type="hidden" class="dz-image">
                                                                                    <div class="dz-image">
                                                                                        <img data-dz-thumbnail="" alt="<?php echo $ex_tmp0[3]?>" src="<?php echo 'data: '.mime_content_type($val).';base64,'. base64_encode(file_get_contents($val))?>">
                                                                                    </div>
                                                                                    <div class="dz-details">

                                                                                        <div class="dz-filename"><span data-dz-name=""><?php echo $ex_tmp0[3]?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="dz-progress">
                                                                                        <span class="dz-upload" data-dz-uploadprogress="" style="width: 100%;"></span>
                                                                                    </div>
                                                                                    <div class="dz-error-message">
                                                                                        <span data-dz-errormessage=""></span>
                                                                                    </div>
                                                                                    <div class="dz-success-mark">
                                                                                        <svg width="54px" height="54px"
                                                                                             viewBox="0 0 54 54"
                                                                                             version="1.1"
                                                                                             xmlns="http://www.w3.org/2000/svg"
                                                                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                             xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                                                                            <title>Check</title>
                                                                                            <defs></defs>
                                                                                            <g id="Page-1" stroke="none"
                                                                                               stroke-width="1"
                                                                                               fill="none"
                                                                                               fill-rule="evenodd"
                                                                                               sketch:type="MSPage">
                                                                                                <path
                                                                                                    d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"
                                                                                                    id="Oval-2"
                                                                                                    stroke-opacity="0.198794158"
                                                                                                    stroke="#747474"
                                                                                                    fill-opacity="0.816519475"
                                                                                                    fill="#FFFFFF"
                                                                                                    sketch:type="MSShapeGroup"></path>
                                                                                            </g>
                                                                                        </svg>
                                                                                    </div>
                                                                                    <div class="dz-error-mark">
                                                                                        <svg width="54px" height="54px"
                                                                                             viewBox="0 0 54 54"
                                                                                             version="1.1"
                                                                                             xmlns="http://www.w3.org/2000/svg"
                                                                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                             xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                                                                            <title>Error</title>
                                                                                            <defs></defs>
                                                                                            <g id="Page-1" stroke="none"
                                                                                               stroke-width="1"
                                                                                               fill="none"
                                                                                               fill-rule="evenodd"
                                                                                               sketch:type="MSPage">
                                                                                                <g id="Check-+-Oval-2"
                                                                                                   sketch:type="MSLayerGroup"
                                                                                                   stroke="#747474"
                                                                                                   stroke-opacity="0.198794158"
                                                                                                   fill="#FFFFFF"
                                                                                                   fill-opacity="0.816519475">
                                                                                                    <path
                                                                                                        d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"
                                                                                                        id="Oval-2"
                                                                                                        sketch:type="MSShapeGroup"></path>
                                                                                                </g>
                                                                                            </g>
                                                                                        </svg>
                                                                                    </div>
                                                                                    <a class="dz-remove delete_update" data-image="<?php echo $ex_tmp0[3]?>" data-id="<?php echo $ex_tmp1[0]?>" href="javascript:undefined;">Remove file</a>
                                                                                </div>
                                                                            <?php } ?>
                                                                        <?php } ?>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div id="listalbums">
                                                            <?php if (isset($album) && is_array($album) && count($album)) { ?>
                                                                <?php foreach ($album as $key => $val) {
                                                                    $ex_tmp0 = explode('/', $val);
                                                                    $ex_tmp1 = explode('.', $ex_tmp0[3]) ?>
                                                                    <input type="hidden" class="form-control"  value="<?php echo $val ?>" name="album[]"  id="<?php echo $ex_tmp1[0] ?>"/>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ibox mb10">
                                                    <div class="ibox-title">
                                                        <h5>Thông tin chi tiết</h5>
                                                    </div>
                                                    <div class="ibox mb10">

                                                        <?php
                                                        $dropdown = $this->Autoload_Model->_get_where(array('table' => 'product_catalogue', 'select' => 'id, title, parentid, lft, rgt, level, order', 'order_by' => 'lft ASC, order ASC', 'where' => array('publish' => 0, 'alanguage' => $this->fc_lang)), true);
                                                        ?>
                                                        <div class="ibox-content">
                                                            <div class="row mb15">
                                                                <div class="col-lg-12">
                                                                    <div class="form-row">
                                                                        <label class="control-label text-left">
                                                                            <span>Danh mục sản phẩm <b
                                                                                    class="text-danger">(*)</b></span>
                                                                        </label>

                                                                        <div class="form-row">
                                                                            <select name="catalogueid"
                                                                                    style="height: 32px;border: 1px solid #c4cdd5;padding-left: 10px;font-size: 12px;border-radius: 5px;width: 100%;">
                                                                                <?php if (!empty($dropdown)) { ?>
                                                                                    <?php foreach ($dropdown as $key => $val) { ?>
                                                                                        <option
                                                                                            <?php if ($val['id'] == $product['catalogueid']){ ?>selected<?php } ?>
                                                                                            value="<?php echo $val['id'] ?>"><?php echo str_repeat('|-----', (($val['level'] > 0) ? ($val['level'] - 1) : 0)) . $val['title'] ?></option>
                                                                                    <?php } ?>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ibox mb10">

                                                        <div class="ibox-content">
                                                            <div class="row mb15">
                                                                <div class="col-lg-12">
                                                                    <div class="form-row">
                                                                        <label class="control-label text-left">
                                                                            <span>Quốc gia</span>
                                                                        </label>
                                                                        <?php $nationalityDropdown = nationalityDropdown();?>
                                                                        <div class="form-row">
                                                                            <select name="nationality" style="height: 32px;border: 1px solid #c4cdd5;padding-left: 10px;font-size: 12px;border-radius: 5px;width: 100%;" >
                                                                                <?php if(!empty($nationalityDropdown)){ ?>

                                                                                    <?php foreach($nationalityDropdown as $key=>$val){?>
                                                                                        <option <?php if($val==$product['nationality']){?>selected<?php }?> value="<?php echo $val?>"><?php echo $val?></option>
                                                                                    <?php }?>
                                                                                <?php }?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-row">
                                                                    <span class="text-black mb15">Quản lý thiết lập hiển thị.</span>

                                                                    <div style="display: flex">
                                                                        <div class="block clearfix">
                                                                            <div class="i-checks mr30" style="width:100%;">
                                                                            <span
                                                                                style="color:#000;"> <input <?php echo ($this->input->post('publish') == 0) ? 'checked' : (($product['publish'] == 0) ? 'checked' : '') ?>
                                                                                    class="popup_gender_1 gender"
                                                                                    type="radio" value="0"
                                                                                    name="publish"> <i></i>Hiển thị</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="block clearfix">
                                                                            <div class="i-checks" style="width:100%;"><span
                                                                                    style="color:#000;"> <input
                                                                                        type="radio" <?php echo ($this->input->post('publish') == 1) ? 'checked' : (($product['publish'] == 1) ? 'checked' : '') ?>
                                                                                        class="popup_gender_0 gender"
                                                                                        required value="1"
                                                                                        name="publish"> <i></i> Ẩn</span>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <?php
                                                                $publish_time = gettime($product['publish_time'], 'd/m/Y H:i');
                                                                $publish_time = explode(' ', $publish_time);
                                                                ?>
                                                                <div class="post-setting hidden">
                                                                    <a href="" title="" class="setting-button mb5"
                                                                       data-flag="1">Xóa thiết lập</a>

                                                                    <div class="setting-group">
                                                                        <div
                                                                            class="uk-flex uk-flex-middle uk-flex-space-between">
                                                                            <?php echo form_input('post_date', htmlspecialchars_decode(html_entity_decode(set_value('post_date', $publish_time[0]))), 'class="form-control datetimepicker" placeholder=""  autocomplete="off"'); ?>
                                                                            <span
                                                                                style="margin-right:5px;color:#141414;">lúc</span>
                                                                            <?php echo form_input('post_time', htmlspecialchars_decode(html_entity_decode(set_value('post_time', $publish_time[1]))), 'class="form-control" placeholder="" id="input-clock" autocomplete="off" data-default="20:48"'); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ibox mb10 block-detail-product">
                                                        <div class="ibox-content">
                                                            <div class="row mb15">
                                                                <div class="col-lg-6 m-b">
                                                                    <label class="control-label ">
                                                                        <span>Giá<b class="text-danger">(*)</b></span>
                                                                    </label>

                                                                    <div class="form-row">
                                                                        <?php echo form_input('price', set_value('price', $product['price']), 'class=" m-b-sm form-control " placeholder="đ" autocomplete="off"'); ?>
                                                                        <div class="uk-flex uk-flex-middle">
                                                                            <div class="m-r-sm">
                                                                                <?php if (isset($price_contact) && $price_contact == 1) { ?>
                                                                                    <input type="checkbox" checked
                                                                                           name="price_contact"
                                                                                           value="1"
                                                                                           id="checkbox-item">
                                                                                <?php } else { ?>
                                                                                    <input type="checkbox"
                                                                                           name="price_contact"
                                                                                           value="1"
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
                                                                        <?php echo form_input('price_sale', set_value('price_sale', $product['price_sale']), 'class="form-control " placeholder="đ" autocomplete="off"'); ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row ">
                                                                <div class="col-lg-12 m-b">
                                                                    <div class="form-row">
                                                                        <div
                                                                            class="uk-flex uk-flex-middle uk-flex-space-between">
                                                                            <label class="control-label text-left">
                                                                                <span>Nội dung</span>
                                                                            </label>

                                                                        </div>
                                                                        <?php echo form_textarea('description', htmlspecialchars_decode(html_entity_decode(set_value('description', $product['description']))), 'class="form-control ck-editor" id="ckDescription" placeholder="" autocomplete="off" '); ?>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="clear: both"></div>
                                                    <button type="submit" name="update" value="update"
                                                            class="btn btn-success block m-b pull-right">Cập nhập
                                                    </button>
                                                </div>
                                                <div class="clearfix"></div>




                                                <?php $this->load->view('user/frontend/product/comment', array('module' => 'product','moduleid' => $product['id'])); ?>


                                            </div>

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
<?php echo $this->load->view('user/frontend/product/script') ?>

<script>
    $(document).ready(function () {
        Dropzone.autoDiscover = false;
        $("#myAwesomeDropzone").dropzone({
            url: "uploaddropzone.html",
            addRemoveLinks: true,
            removedfile: function (file) {
                var name = file.name;
                var result = file.name.split('.');
                $('#' + result[0]).remove();
                $.ajax({
                    type: 'POST',
                    url: 'uploaddropzone.html',
                    data: {name: name, request: 2},
                    sucess: function (e) {
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
    $('.delete_update').change(function(){

    });
    $(document).on('click' ,'.delete_update' ,function(){
        let _this = $(this);
        let id =  _this.attr('data-id');
        let name =  _this.attr('data-image');
        $('#' + id).remove();
        $('.' + id).remove();
//        $.ajax({
//            type: 'POST',
//            url: 'uploaddropzone.html',
//            data: {name: name, request: 2},
//            sucess: function (e) {
//            }
//        });
    });
    $('.lisanpham .acc__panel').addClass('open');
</script>
<style>
    .content_update .dz-default.dz-message{
        display: block;
        position: absolute;
        top: 0px;
        width: 100%;
        float: left;
    }
    .content {
        margin: 0 auto;
        position: relative;
    }
</style>
<script src="plugin\rating\SimpleStarRating.js" type="text/javascript"></script>
<link rel="stylesheet" href="plugin\rating\SimpleStarRating.css">
<script src="plugin\jquery.timeago.js"  type="text/javascript"></script>
<script>
    var module = '<?php echo $module ?>';
    var moduleid = '<?php echo $product['id']?>';
    listComment(module, moduleid, $('.js_list_comment').attr('data-page'));
    function listComment(module, moduleid, page){
        var uri = '<?php echo site_url('comment/frontend/comment/listCommentUser'); ?>';
        $.post(uri, { module: module, moduleid: moduleid, page:page},
            function(data){
                var json = JSON.parse(data);
                $('.js_list_comment').html(json.listComment);
                $('.js_list_pagination').html(json.paginationList);
            });
    }
    $(document).on('click','.ajax-pagination  a',function(){
        var page = $(this).attr('data-ci-pagination-page');
        listComment(module, moduleid, page);
        return false;
    });
    $(document).on('click','.js_btn_reply', function(e){

        let _this = $(this);
        let param = {
            'id' : _this.attr('data-id'),
            'title' : _this.attr('data-title'),
            'module' : module,
            'detailid' : moduleid,
        };
        let reply = get_comment_html(param);
        let replyName = _this.parent().parent().siblings().find('._cmt-name').text();
        let commentAttr = _this.attr('data-comment');
        $('.show-reply').html('');
        $('.js_btn_reply').html('Trả lời');
        $('.js_btn_reply').attr('data-comment', 1);

        if(commentAttr == 1){
            _this.parent().siblings('.show-reply').html(reply);
            let replyTo = _this.parent().siblings('.show-reply').find('.text-reply').text('@'+ replyName + ' : ');
            replyTo.focus();
            textLength = $.trim(_this.parent().siblings('.show-reply').find('.text-reply').val()).length;
            //ban đầu ta ẩn nút gửi cmt
//            _this.parent().siblings('.show-reply').find('.btn-submit').attr('disabled' , '');
            _this.attr('data-comment', 0);
            _this.html('Bỏ comment');
        }else{
            _this.parent().siblings('.show-reply').html('');
            _this.attr('data-comment', 1);
            _this.html('Trả lời');
        }
        e.preventDefault();
    });
    function get_comment_html(param = ''){
        let comment = '';
        comment += '<div class="boxRatingCmt">';
        comment += '<form action="" method="post" class="form uk-form" >';
        comment += '<h2 id="review-title" style="font-size: 20px;font-weight: bold">Trả lời - '+param.title+'</h2>';
        comment += '<div class="col-md-12">';
        comment += '<div class="error_comm ">';
        comment += '</div>';
        comment += '</div>';
        comment += '<div class="clr"></div>';
        comment += '<div class="ipt row">';
        comment += '<div class="ct col-md-12 col-xs-12 col-sm-12">';
        comment += '<textarea name="comment_note" cols="40" rows="5"  placeholder="Nội dung bình luận" class="form-control" id="cmtreply-content" autocomplete="off"></textarea>';
        comment += '</div>';
        comment += '<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top: 10px">';
        comment += '<div class="btn-cmt sent-cmt"><button type="button" name="sent_comment" value="sent_comment" class="btn btn-success btn-submit js_sent_comment" data-parentid = '+param.id+'  >Gửi</button></div>';
        comment += '</div>';
        comment += '</div>';
        comment += '</div>';
        comment += '</div>';
        comment += '</form>';
        comment += '</div>';
        return comment;
    }
    $(document).on('click','.js_sent_comment',function(){
        var parentid = $(this).attr('data-parentid');
        let cmtContent = $('#cmtreply-content').val();
        let param = {
            'parentid': parentid,
            'comment': cmtContent,
            'rate': 0,
            'module': module,
            'detailid': moduleid,
        };
        let uri = "comment/frontend/comment/sent_commentuser";
        $.post(uri, {param: param, cmtContent: cmtContent},
            function(data){
                var json = JSON.parse(data);
                if(json.error != ''){
                    $('.error_comm').removeClass('alert alert-success').addClass('alert alert-danger');
                    $('.error_comm').html('').html(json.message);
                }else{
                    $('.error_comm').removeClass('alert alert-danger').addClass('alert alert-success');
                    $('.error_comm').html('').html(json.message);
                    setTimeout(function(){ window.location.href=window.location.href; }, 1500);
                }
            });
        return false;
    });
</script>
<style>
    #danhgia .contant-danhgia {
        border: 1px dashed #ddd;
        padding: 30px;
        float: left;
        width: 100%;
    }
    .rating{
        font-size: 25px;
    }
    .rsStar {
        display: inline-block;
        margin-left: 10px;
        position: relative;
        background: #52b858;
        color: #fff;
        padding: 2px 8px;
        box-sizing: border-box;
        font-size: 12px;
        border-radius: 2px;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }
    .rsStar:after {
        right: 100%;
        top: 50%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-color: rgba(82,184,88,0);
        border-right-color: #52b858;
        border-width: 6px;
        margin-top: -6px;
    }
    .ips{
        position: relative;
        width: 100%;
        float: left;
    }
</style>
