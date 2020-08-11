<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="row border-bottom">
        <?php $this->load->view('dashboard/backend/common/navbar'); ?>
    </div>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý tour</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo site_url('admin'); ?>">Home</a>
                </li>
                <li class="active"><strong>Quản lý tour</strong></li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Danh sách tour</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-cog"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-tour">
                                <li><a type="button" class="ajax_delete_tour_all"
                                       data-title="Lưu ý: Khi bạn thực hiện thao tác này, toàn bộ dữ liệu sẽ không thể khôi phục được. Hãy chắc chắn rằng bạn muốn thực hiện chức năng này!"
                                       data-module="tour">Xóa </a>
                                </li>

                                <?php /*<li>
									<a data-toggle="modal" data-target="#update_catalogue"> Thêm danh mục phụ cho SP</a>
								</li>
								<li>
									<a data-toggle="modal" data-target="#update_attr"> Tạo thuộc tính cho SP</a>
								</li>*/ ?>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="position:relative;">
                        <div>
                            <div class="block_filter">
                                <div class="ibox" style="border: none !important; margin-bottom: 0px">
                                    <div class="ibox-title">
                                        <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                            <div class="uk-flex uk-flex-middle mb10">
                                                <?php echo form_dropdown('perpage', $this->configbie->data('perpage'), set_value('perpage', $this->input->get('perpage')), 'class="form-control input-sm perpage filter m-r"  data-url="' . site_url('tour/backend/tour/view') . '"'); ?>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="uk-flex mb10">
                                        <div class="col-sm-4  p-l-none">

                                            <?php echo form_dropdown('catalogueid', $this->nestedsetbie->dropdown(), set_value('catalogueid', $this->input->get('catalogueid')), 'class="form-control input-sm select3 filter catalogueid" '); ?>
                                        </div>

                                        <div class="col-sm-4  p-r-none">
                                            <form class="uk-form" id="search">
                                                <input type="search" name="keyword"
                                                       class="keyword form-control input-sm filter"
                                                       placeholder="Nhập từ khóa tìm kiếm theo tên..."
                                                       autocomplete="off"
                                                       value="<?php echo $this->input->get('keyword'); ?>">
                                            </form>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="toolbox">
                                                <div class="uk-flex uk-flex-middle uk-flex-space-between">

                                                    <div class="uk-button">
                                                        <a href="<?php echo site_url('tour/backend/tour/create'); ?>"
                                                           class="btn btn-danger btn-sm"><i class="fa fa-plus"></i> Thêm
                                                            tour mới</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                <div class="text-small mb10">Hiển thị từ <?php echo $from; ?> đến <?php echo $to ?> trên
                                    tổng số <?php echo $config['total_rows']; ?> bản ghi
                                </div>
                                <div class="text-small text-danger">*Sắp xếp Vị trí hiển thị theo quy tắc: Số lớn hơn
                                    được ưu tiên hiển thị trước.
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   >
                                <thead>
                                <tr>
                                    <th style="width:30px;">
                                        <input type="checkbox" id="checkbox-all">
                                        <label for="check-all" class="labelCheckAll"></label>
                                    </th>
                                    <th>Tiêu đề</th>
                                    <th style="width:85px;" class="text-center">Giá </th>
                                    <th style="width:67px;" class="text-center">Vị trí</th>
                                    <th style="width:100px;" class="text-center">Người tạo</th>
                                    <th style="width:80px;" class="text-center">Trang chủ</th>
                                    <th style="width:80px;" class="text-center">Trạng thái</th>
                                    <th style="width:136px;" class="text-center">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody id="ajax-content">
                                <?php if (isset($listData) && is_array($listData) && count($listData)) { ?>
                                    <?php foreach ($listData as $key => $val) { ?>
                                        <?php
                                        $href = rewrite_url($val['canonical'], true, true);

                                        $image = $val['image'];
                                        $_catalogue_list = '';
                                        $catalogue = json_decode($val['catalogue'], TRUE);
                                        if (isset($catalogue) && is_array($catalogue) && count($catalogue)) {
                                            $_catalogue_list = $this->Autoload_Model->_get_where(array(
                                                'select' => 'id, title, slug, canonical',
                                                'table' => 'tour_catalogue',
                                                'where_in' => json_decode($val['catalogue'], TRUE),
                                                'where_in_field' => 'id',
                                            ), TRUE);
                                        }
                                        ?>
                                        <tr class="gradeX" id="post-<?php echo $val['id']; ?>">
                                            <td>
                                                <input type="checkbox" name="checkbox[]"
                                                       value="<?php echo $val['id']; ?>"
                                                       data-router="<?php echo $val['canonical']; ?>"
                                                       class="checkbox-item">
                                                <label for="" class="label-checkboxitem"></label>
                                            </td>
                                            <td>
                                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                    <div class="uk-flex uk-flex-middle ">
                                                        <div class="image mr5">
                                                            <span class="image-post img-cover"><img
                                                                        src="<?php echo $image; ?>"
                                                                        alt="<?php echo $val['title']; ?>"/></span>
                                                        </div>
                                                        <div class="main-info">
                                                            <div class="title"><a class="maintitle" href="<?php echo site_url('tour/backend/tour/update/' . $val['id']); ?>"><?php echo $val['title']; ?>
                                                                    (<?php echo $val['viewed'] . ' lượt xem'; ?>) <?php echo ($val['version'] > 0) ? "(có " . $val['version'] . " phiên bản)" : '' ?></a>
                                                                <a href="<?php echo $href ?>" onclick="prompt('Lấy địa chỉ liên kết','<?php echo $val['canonical'] ?>.html'); return false;"><img src="template/backend/img/link.png"></a>
                                                            </div>
                                                            <div class="catalogue" style="font-size:10px">
                                                                <span style="color:#f00000;">Nhóm hiển thị: </span>
                                                                <a class="" style="color:#333;"
                                                                   href="<?php echo site_url('tour/backend/tour/view?catalogueid=' . $val['catalogueid']); ?>"
                                                                   title=""><?php echo $val['catalogue_title']; ?></a><?php echo (isset($_catalogue_list) && is_array($_catalogue_list) && count($_catalogue_list)) ? ' ,' : ''; ?>
                                                                <?php if (isset($_catalogue_list) && is_array($_catalogue_list) && count($_catalogue_list)) {
                                                                    foreach ($_catalogue_list as $keyCat => $valCat) { ?>
                                                                        <a style="color:#333;" class=""
                                                                           href="<?php echo site_url('tour/backend/tour/view?catalogueid=' . $valCat['id']); ?>"
                                                                           title=""><?php echo $valCat['title']; ?></a> <?php echo ($keyCat + 1 < count($_catalogue_list)) ? ', ' : ''; ?>
                                                                    <?php }
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <a target="_blank" href="<?php echo site_url($val['canonical']); ?>"><i class="fa fa-link" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right price">
                                                <?php
                                                if ($val['price_contact'] == 1) {
                                                    echo '<span>Giá liên hệ</span>';
                                                } else {
                                                    $price = (!empty($val['price_sale'])) ? $val['price_sale'] : $val['price'];
                                                    $field = (!empty($val['price_sale'])) ? 'price_sale' : 'price';
                                                    if (!empty($val['price_sale'])) {
                                                        echo '<i class="fa fa-tag m-r-xs" aria-hidden="true"></i>';
                                                    }
                                                    echo '<span>' . addCommas($price) . '</span>';
                                                    echo form_input('price', addCommas($price), 'data-id="' . $val['id'] . '" data-field="' . $field . '"  class="int form-control" style="text-align:right; padding:6px 3px; display:none"');
                                                }

                                                ?>
                                            </td>

                                            <td>
                                                <?php echo form_input('order[' . $val['id'] . ']', $val['order'], 'data-module="tour" data-id="' . $val['id'] . '"  class="form-control sort-order" placeholder="Vị trí" style="width:50px;text-align:right;"'); ?>
                                            </td>
                                            <td class="text-center"><?php echo $val['user_created']; ?>
                                            </td>
                                            <td class="">
                                                <div class="switch">
                                                    <div class="onoffswitch">
                                                        <input type="checkbox" <?php echo ($val['ishome'] == 1) ? 'checked=""' : ''; ?>
                                                               class="onoffswitch-checkbox publish_frontend"
                                                               data-module="tour" data-title="ishome"
                                                               data-id="<?php echo $val['id']; ?>"
                                                               id="publish_frontend-<?php echo $val['id']; ?>">
                                                        <label class="onoffswitch-label"
                                                               for="publish_frontend-<?php echo $val['id']; ?>">
                                                            <span class="onoffswitch-inner"></span>
                                                            <span class="onoffswitch-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="hidden">
                                                <div class="switch">
                                                    <div class="onoffswitch">
                                                        <input type="checkbox" <?php echo ($val['highlight'] == 1) ? 'checked=""' : ''; ?>
                                                               class="onoffswitch-checkbox publish_frontend"
                                                               data-module="tour" data-title="highlight"
                                                               data-id="<?php echo $val['id']; ?>"
                                                               id="publish_frontend_h_<?php echo $val['id']; ?>">
                                                        <label class="onoffswitch-label"
                                                               for="publish_frontend_h_<?php echo $val['id']; ?>">
                                                            <span class="onoffswitch-inner"></span>
                                                            <span class="onoffswitch-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="switch">
                                                    <div class="onoffswitch">
                                                        <input type="checkbox" <?php echo ($val['publish'] == 0) ? 'checked=""' : ''; ?>
                                                               class="onoffswitch-checkbox publish"
                                                               data-id="<?php echo $val['id']; ?>"
                                                               id="publish-<?php echo $val['id']; ?>">
                                                        <label class="onoffswitch-label"
                                                               for="publish-<?php echo $val['id']; ?>">
                                                            <span class="onoffswitch-inner"></span>
                                                            <span class="onoffswitch-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="text-center">
                                                <a type="button"
                                                   href="<?php echo site_url('tour/backend/tour/update/' . $val['id'] . '?page=1') ?>"
                                                   class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                <a type="button" class="btn btn-danger ajax_delete_tour"
                                                   data-title="Lưu ý: Dữ liệu sẽ không thể khôi phục. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!"
                                                   data-router="<?php echo $val['canonical']; ?>"
                                                   data-id="<?php echo $val['id'] ?>"
                                                   data-catalogueid="<?php echo $val['catalogueid'] ?>"
                                                   data-module="tour"><i class="fa fa-trash"></i></a>

                                                <a type="button"
                                                   href="<?php echo site_url('tour/backend/tour/duplicate/' . $val['id'] . '?page=1') ?>"
                                                   class="btn btn-info"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="100">
                                            <small class="text-danger">Không có dữ liệu phù hợp</small>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="pagination">
                            <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
                        </div>
                        <div class="loader"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>
