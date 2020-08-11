<div id="page-wrapper" class="gray-bg dashbard-1 fix-wrapper">
    <div class="row border-bottom">
        <?php $this->load->view('dashboard/backend/common/navbar'); ?>
    </div>
    <form method="post" action="" class="form-horizontal box">
        <div class="ibox-tools" id="create_tour">
            <button type="submit" name="update" value="update" class="btn btn-success block full-width m-b">Cập nhật
            </button>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Cập nhật tour</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?php echo site_url('admin'); ?>">Home</a>
                    </li>
                    <li class="active"><strong>Cập nhật tour</strong></li>
                </ol>
            </div>
        </div>
        <script type="text/javascript">
            var submit = '<?php echo $this->input->post('update'); ?>';
            var catalogueid = '<?php echo json_encode($this->input->post('catalogue')); ?>';
            var tag = '<?php echo json_encode($this->input->post('tag')); ?>';
        </script>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="box-body">
                    <?php $error = validation_errors();
                    echo !empty($error) ? '<div class="alert alert-danger">' . $error . '</div>' : ''; ?>
                </div><!-- /.box-body -->
            </div>
            <div class="row">
                <div class="col-lg-8 clearfix">
                    <div class="ibox mb20">
                        <div class="ibox-title" style="padding: 9px 15px 0px;">
                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                <h5>Thông tin cơ bản
                                    <small class="text-danger">Điền đầy đủ các thông tin được mô tả dưới đây</small>
                                </h5>
                                <div class="ibox-tools">
                                    <button type="submit" name="update" value="update"
                                            class="btn btn-success  full-width ">Cập nhật
                                    </button>
                                </div>

                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row mb15">
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <label class="control-label text-left">
                                            <span>Tiêu đề tour <b class="text-danger">(*)</b></span>
                                        </label>
                                        <?php echo form_input('title', htmlspecialchars_decode(html_entity_decode(set_value('title', $tour['title']))), 'class="form-control title" placeholder="" id="title" autocomplete="off"'); ?>
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
                                                <?php echo form_input('canonical', htmlspecialchars_decode(html_entity_decode(set_value('canonical', $tour['canonical']))), 'class="form-control canonical" placeholder="" autocomplete="off" data-flag="0" '); ?>

                                                <?php echo form_input('original_canonical', htmlspecialchars_decode(html_entity_decode(set_value('canonical', $tour['canonical']))), 'class="form-control" placeholder="" style="display:none;" autocomplete="off"'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb15">
                                <div class="col-lg-12 m-b">
                                    <div class="form-row">
                                        <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                            <label class="control-label text-left">
                                                <span>Mô tả</span>
                                            </label>
                                            <a href="" title="" class="uploadMultiImage"
                                               onclick="openKCFinderMulti(this);return false;">Upload hình ảnh</a>
                                        </div>
                                        <?php echo form_textarea('description', htmlspecialchars_decode(html_entity_decode(set_value('description', $tour['description']))), 'class="form-control ck-editor" id="ckDescription" placeholder="" autocomplete="off" '); ?>
                                    </div>
                                </div>

                                <div class="col-lg-12 ">
                                    <div class="uk-flex uk-flex-middle uk-flex-space-between ">
                                        <label class="control-label text-left ">
                                            <span>Nội dung mở rộng</span>
                                        </label>
                                        <a href="" title="" class="add-attr" onclick="return false;">Thêm Nội dung +</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row attr-more">

                                <?php
                                $extend_description = $this->input->post('content');
                                if (isset($extend_description) && is_array($extend_description) && count($extend_description)) {
                                    $content = $extend_description;
                                } else {
                                    $content = json_decode($tour['extend_description'], TRUE);
                                }
                                if (isset($content['title']) && is_array($content['title']) && count($content['title'])) { ?>
                                    <?php foreach ($content['title'] as $key => $val) { ?>
                                        <?php if ($val == '') {
                                            continue;
                                        } ?>
                                        <div class="col-lg-12 desc-more">
                                            <div class="row m-b">
                                                <div class="col-lg-11">
                                                    <input type="text" name="content[title][]"
                                                           value="<?php echo $val ?>" class="form-control"
                                                           placeholder="Tiêu đề">
                                                </div>
                                                <div class="col-lg-1">
                                                    <button class="btn btn-danger delete-attr" type="button"><i
                                                                class="fa fa-trash"></i></button>
                                                </div>
                                            </div>
                                            <div class="row m-b">
                                                <div class="col-lg-12">

                                                    <?php echo form_textarea('content[description][]', htmlspecialchars_decode(html_entity_decode($content['description'][$key])), 'class="form-control ck-editor" id="editor_' . $key . '" placeholder="" autocomplete="off"'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>

                    <div class="ibox mb20 album">
                        <div class="ibox-title">
                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                <h5>Album Ảnh </h5>

                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                    <div class="edit">
                                        <a onclick="openKCFinderImage(this);return false;" href="" title=""
                                           class="upload-picture">Chọn hình</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <?php
                            $album = $this->input->post('album');
                            if (!empty($album) && is_array($album) && count($album)) {
                                $album = $album;
                            } else {
                                $album = json_decode(base64_decode($tour['image_json']), true);
                            }
                            ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="click-to-upload" <?php echo (isset($album)) ? 'style="display:none"' : '' ?>>
                                        <div class="icon">
                                            <a type="button" class="upload-picture"
                                               onclick="openKCFinderImage(this);return false;">
                                                <svg style="width:80px;height:80px;fill: #d3dbe2;margin-bottom: 10px;"
                                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                                                    <path d="M80 57.6l-4-18.7v-23.9c0-1.1-.9-2-2-2h-3.5l-1.1-5.4c-.3-1.1-1.4-1.8-2.4-1.6l-32.6 7h-27.4c-1.1 0-2 .9-2 2v4.3l-3.4.7c-1.1.2-1.8 1.3-1.5 2.4l5 23.4v20.2c0 1.1.9 2 2 2h2.7l.9 4.4c.2.9 1 1.6 2 1.6h.4l27.9-6h33c1.1 0 2-.9 2-2v-5.5l2.4-.5c1.1-.2 1.8-1.3 1.6-2.4zm-75-21.5l-3-14.1 3-.6v14.7zm62.4-28.1l1.1 5h-24.5l23.4-5zm-54.8 64l-.8-4h19.6l-18.8 4zm37.7-6h-43.3v-51h67v51h-23.7zm25.7-7.5v-9.9l2 9.4-2 .5zm-52-21.5c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3zm-13-10v43h59v-43h-59zm57 2v24.1l-12.8-12.8c-3-3-7.9-3-11 0l-13.3 13.2-.1-.1c-1.1-1.1-2.5-1.7-4.1-1.7-1.5 0-3 .6-4.1 1.7l-9.6 9.8v-34.2h55zm-55 39v-2l11.1-11.2c1.4-1.4 3.9-1.4 5.3 0l9.7 9.7c-5.2 1.3-9 2.4-9.4 2.5l-3.7 1h-13zm55 0h-34.2c7.1-2 23.2-5.9 33-5.9l1.2-.1v6zm-1.3-7.9c-7.2 0-17.4 2-25.3 3.9l-9.1-9.1 13.3-13.3c2.2-2.2 5.9-2.2 8.1 0l14.3 14.3v4.1l-1.3.1z"></path>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="small-text">Sử dụng nút <b>Chọn hình</b> để thêm hình.</div>
                                    </div>
                                    <div class="upload-list" <?php echo (isset($album)) ? '' : 'style="display:none"' ?>
                                         style="padding:5px;">
                                        <div class="row">
                                            <ul id="sortable" class="clearfix sortui">
                                                <?php if (isset($album) && is_array($album) && count($album)) { ?>
                                                    <?php foreach ($album as $key => $val) { ?>
                                                        <li class="ui-state-default">
                                                            <div class="thumb">
															<span class="image img-scaledown">
																<img src="<?php echo $val; ?>" alt=""/> <input
                                                                        type="hidden" value="<?php echo $val; ?>"
                                                                        name="album[]"/>
															</span>
                                                                <div class="overlay"></div>
                                                                <div class="delete-image"><i class="fa fa-trash"
                                                                                             aria-hidden="true"></i>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php }
                                                } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ibox mb20 block-detail-tour">
                        <div class="ibox-title uk-flex uk-flex-middle uk-flex-space-between">
                            <h5>Thông tin chi tiết</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-6 m-b">
                                    <label class="control-label ">
                                        <span>Giá<b class="text-danger">(*)</b></span>
                                    </label>
                                    <div class="form-row">
                                        <?php echo form_input('price', set_value('price', number_format($tour['price'], '0', ',', '.'), 0), 'class=" m-b-sm form-control int price" placeholder="đ" autocomplete="off"'); ?>
                                        <div class="uk-flex uk-flex-middle">
                                            <div class="m-r-sm">
                                                <?php if (isset($price_contact) && $price_contact == 1) { ?>
                                                    <input type="checkbox" checked name="price_contact" value="1"
                                                           class="checkbox-item">
                                                    <div for="" class="label-checkboxitem checked"></div>
                                                <?php } else { ?>
                                                    <input type="checkbox" name="price_contact" value="1"
                                                           class="checkbox-item">
                                                    <div for="" class="label-checkboxitem "></div>
                                                <?php } ?>
                                            </div>
                                            <div>
                                                Liên hệ để biết giá
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 m-b">
                                    <label class="control-label ">
                                        <span>Giá khuyến mại</span>
                                    </label>
                                    <div class="form-row">
                                        <?php echo form_input('price_sale', set_value('price_sale', number_format($tour['price_sale'], '0', ',', '.'), 0), 'class="form-control int" placeholder="đ" autocomplete="off"'); ?>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>


                    <div class="ibox mb20">
                        <div class="ibox-title">
                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                <h5>Tối ưu SEO
                                    <small class="text-danger">Thiết lập các thẻ mô tả giúp khách hàng dễ dàng tìm thấy
                                        bạn.
                                    </small>
                                </h5>

                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                    <div class="edit">
                                        <a href="#" class="edit-seo">Chỉnh sửa SEO</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="google">
                                        <div class="g-title"><?php echo ($this->input->post('meta_title')) ? $this->input->post('meta_title') : (($this->input->post('title')) ? $this->input->post('title') : (($tour['meta_title'] != '') ? $tour['meta_title'] : $tour['title'])); ?></div>
                                        <div class="g-link"><?php echo ($this->input->post('canonical')) ? site_url($this->input->post('canonical')) : site_url($tour['canonical']); ?></div>
                                        <div class="g-description" id="metaDescription">
                                            <?php echo cutnchar(($this->input->post('meta_description')) ? $this->input->post('meta_description') : (($this->input->post('description')) ? strip_tags($this->input->post('description')) : ((!empty($tour['meta_description'])) ? strip_tags($tour['meta_description']) : ((!empty($tour['description'])) ? strip_tags($tour['description']) : 'List of all combinations of words containing CKEDT. Words that contain ckedt letters in them. Anagrams made from C K E D T letters.List of all combinations of words containing CKEDT. Words that contain ckedt letters in them. Anagrams made from C K E D T letters.'))), 360); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="seo-group hidden">
                                <hr>
                                <div class="row mb15">
                                    <div class="col-lg-12">
                                        <div class="form-row">
                                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                <label class="control-label ">
                                                    <span>Tiêu đề SEO</span>
                                                </label>
                                                <span style="color:#9fafba;"><span
                                                            id="titleCount"><?php echo strlen($tour['meta_title']) ?></span> trên 70 ký tự</span>
                                            </div>
                                            <?php echo form_input('meta_title', htmlspecialchars_decode(html_entity_decode(set_value('meta_title', $tour['meta_title']))), 'class="form-control meta-title" placeholder="" autocomplete="off"'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb15">
                                    <div class="col-lg-12">
                                        <div class="form-row">
                                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                <label class="control-label ">
                                                    <span>Mô tả SEO</span>
                                                </label>
                                                <span style="color:#9fafba;"><span
                                                            id="descriptionCount"><?php echo strlen($tour['meta_description']) ?></span> trên 320 ký tự</span>
                                            </div>
                                            <?php echo form_textarea('meta_description', htmlspecialchars_decode(html_entity_decode(set_value('meta_description', $tour['meta_description']))), 'class="form-control meta-description" id="seoDescription" placeholder="" autocomplete="off"'); ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <button type="submit" name="update" value="update" class="btn btn-success block m-b pull-right">Cập
                        nhật
                    </button>

                    <?php /*$this->load->view('dashboard/backend/common/comment_dashboard');*/ ?>


                </div>
                <div class="col-lg-4">
                    <div class="ibox mb20">
                        <div class="ibox-title">
                            <h5>Hiển thị </h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <span class="text-black mb15">Quản lý thiết lập hiển thị cho blog này.</span>
                                        <div class="block clearfix">
                                            <div class="i-checks mr30" style="width:100%;"><span
                                                        style="color:#000;"> <input <?php echo ($this->input->post('publish') == 0) ? 'checked' : (($tour['publish'] == 0) ? 'checked' : '') ?>
                                                            class="popup_gender_1 gender" type="radio" value="0"
                                                            name="publish"> <i></i>Cho phép hiển thị trên website</span>
                                            </div>
                                        </div>
                                        <div class="block clearfix">
                                            <div class="i-checks" style="width:100%;"><span style="color:#000;"> <input
                                                            type="radio" <?php echo ($this->input->post('publish') == 1) ? 'checked' : (($tour['publish'] == 1) ? 'checked' : '') ?>
                                                            class="popup_gender_0 gender" required value="1"
                                                            name="publish"> <i></i> Tắt chức năng hiển thị trên website. </span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $publish_time = gettime($tour['publish_time'], 'd/m/Y H:i');
                                    $publish_time = explode(' ', $publish_time);
                                    ?>
                                    <div class="post-setting">
                                        <a href="" title="" class="setting-button mb5" data-flag="1">Xóa thiết lập</a>
                                        <div class="setting-group">
                                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                <?php echo form_input('post_date', htmlspecialchars_decode(html_entity_decode(set_value('post_date', $publish_time[0]))), 'class="form-control datetimepicker" placeholder=""  autocomplete="off"'); ?>
                                                <span style="margin-right:5px;color:#141414;">lúc</span>
                                                <?php echo form_input('post_time', htmlspecialchars_decode(html_entity_decode(set_value('post_time', $publish_time[1]))), 'class="form-control" placeholder="" id="input-clock" autocomplete="off" data-default="20:48"'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ibox mb20">
                        <div class="ibox-title uk-flex uk-flex-middle uk-flex-space-between">
                            <h5>Phân loại </h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row mb15">
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <label class="control-label text-left">
                                            <span>Danh mục chính <b class="text-danger">(*)</b></span>
                                        </label>
                                        <div class="form-row">
                                            <?php echo form_dropdown('catalogueid', $this->nestedsetbie->dropdown(), set_value('catalogueid', $tour['catalogueid']), 'class="form-control m-b select3"'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb15">
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <label class="control-label text-left">
                                            <span>Danh mục phụ</span>
                                        </label>
                                        <div class="form-row">
                                            <select name="catalogue[]"
                                                    data-json="<?php echo base64_encode($tour['catalogue']) ?>"
                                                    data-condition="" class="form-control selectMultipe"
                                                    multiple="multiple" data-title="Nhập 2 kí tự để tìm kiếm.."
                                                    data-module="tour_catalogue" style="width: 100%;">
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="ibox mb20">
                        <div class="ibox-title uk-flex uk-flex-middle uk-flex-space-between">
                            <h5 style="width: 100%">Info <a class="add-attr-info pull-right hidden" onclick="return false;">Thêm info +</a></h5>
                            <input type="hidden" class="form-control" value="<?php echo $this->input->post('duration')?>" id="duration" name="duration">

                        </div>
                        <div class="ibox-content">

                            <?php /*<div class="row mb15">
                                <div class="col-lg-12">
                                    <div class="form-row">

                                        <div class="attr-more-info">


                                            <?php

                                            $content_info  = $this->input->post('content_info') ;
                                            if(!empty($content_info) && is_array($content_info) && count($content_info)){

                                                $content_info = $content_info;
                                            }else{
                                                $content_info = json_decode($tour['content_info'], true);
                                            }
                                            if (isset($content_info['title']) && is_array($content_info['title']) && count($content_info['title'])){ ?>
                                                <?php foreach($content_info['title'] as $key => $val){ ?>
                                                    <div class="form-group desc-more-info">
                                                        <div class="col-lg-12">
                                                            <input type="text" name="content_info[title][]" value="<?php echo $val; ?>" class="form-control" placeholder="Tiêu đề">
                                                            <textarea name="content_info[description][]" class="form-control" placeholder="Mô tả"><?php echo $content_info['description'][$key]; ?></textarea>
                                                            <button class="delete-attr-info" type="button">X</button>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>*/ ?>

                            <?php
                            $attribute_catalogues = $this->Autoload_Model->_get_where(array(
                                'select' => 'id, title,ishome,highlight',
                                'table' => 'attribute_catalogue',
                                'where' => array('tour' => 1, 'publish' => 0, 'parentid' => 0, 'alanguage' => $this->fclang)), TRUE);
                            if (isset($attribute_catalogues) && is_array($attribute_catalogues) && count($attribute_catalogues)) {
                                foreach ($attribute_catalogues as $key => $val) {
                                    $attribute_catalogues[$key]['post'] = $this->Autoload_Model->_get_where(array(
                                        'select' => 'id, title',
                                        'table' => 'attribute',
                                        'order_by' => 'order asc,id desc',
                                        'where' => array('publish' => 0, 'catalogueid' => $val['id'], 'alanguage' => $this->fclang)), TRUE);
                                }
                            }

                            $temp = [];
                            if(!empty($_POST['attr'])){
                                $temp = $_POST['attr'];
                            }else{
                                if(isset($attribute_checked) && is_array($attribute_checked) && count($attribute_checked)){
                                    foreach($attribute_checked as $key => $val){
                                        $temp[] = $val['attrid'];
                                    }
                                }
                            }


                            ?>
                            <?php if (isset($attribute_catalogues) && is_array($attribute_catalogues) && count($attribute_catalogues)) { ?>
                                <?php foreach ($attribute_catalogues as $key => $val) { ?>
                                    <div class="form-group">
                                        <label class="col-sm-12"><?php echo $val['title']; ?></label>
                                        <div class="col-sm-12">
                                            <div class="checkbox">
                                                <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                                                    <?php foreach ($val['post'] as $keyP => $valP) { ?>
                                                        <label class="tpInputLabel" style="width: 100%">
                                                            <input <?php echo((in_array($valP['id'], $temp)) ? 'checked' : ''); ?> name="attr[<?php echo $valP['id'] ?>]" type="checkbox" class="tpInputCheckbox <?php if($val['ishome'] == 1){  ?>onlyCheckbox<?php }?> <?php if($val['highlight'] == 1){  ?>onlyDuration<?php }?>" value="<?php echo $valP['id'] ?>"/>
                                                            <span><?php echo $valP['title']; ?></span>
                                                        </label>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>


                        </div>
                    </div>


                    <?php /*<div class="ibox mb20">
                        <div class="ibox-title uk-flex uk-flex-middle uk-flex-space-between">
                            <h5 style="width: 100%">HIGHLIGHTS <a href="" title="" class="add-attr-highlight pull-right"
                                                                  onclick="return false;">Thêm highlight +</a></h5>
                        </div>
                        <div class="ibox-content">

                            <div class="row mb15">
                                <div class="col-lg-12">
                                    <div class="form-row">

                                        <div class="attr-more-highlight">
                                            <?php $content_highlight = $this->input->post('content_highlight');

                                            if (!empty($content_highlight) && is_array($content_highlight) && count($content_highlight)) {
                                                $content_highlight = $content_highlight;
                                            } else {
                                                $content_highlight = json_decode($tour['content_highlight'], true);
                                            }

                                            if (isset($content_highlight) && is_array($content_highlight) && count($content_highlight)) { ?>
                                                <?php foreach ($content_highlight as $key => $val) { ?>
                                                    <div class="form-group desc-more-highlight">
                                                        <div class="col-lg-12">
                                                            <textarea name="content_highlight[]" class="form-control"
                                                                      placeholder="Mô tả"><?php echo $val; ?></textarea>

                                                            <button class="delete-attr-highlight" type="button">X
                                                            </button>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>*/?>


                </div>
            </div>
        </div>
    </form>
    <?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>
<style>
    .attr-more-highlight .form-group, .attr-more-info .form-group {
        position: relative;
    }

    .attr-more-highlight .form-group .delete-attr-highlight, .attr-more-info .form-group .delete-attr-info {
        position: absolute;
        top: 0px;
        right: 11px;
        background: transparent;
        color: red;
        border: 0px;
    }

    #create_tour button {
        position: fixed;
        top: 0px;
        right: 0px;
        z-index: 99999;
        width: auto !important;
    }
</style>
<script>
    $('.onlyCheckbox').on('change', function() {
        $(this).parent().parent().find('.onlyCheckbox').not(this).prop('checked', false);
    });
</script>
<script>
    $('.onlyDuration').on('change', function() {
        $('#duration').val($(this).val());
    });
    $('.onlyDuration:checked').each(function() {
        $('#duration').val($(this).val());
    });
</script>