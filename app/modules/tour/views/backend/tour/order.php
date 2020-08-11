<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="row border-bottom">
        <?php $this->load->view('dashboard/backend/common/navbar'); ?>
    </div>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý đặt tour</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo site_url('admin'); ?>">Home</a>
                </li>
                <li class="active"><strong>Quản lý đặt tour</strong></li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Danh sách đặt tour</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-cog"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-tour">
                                <li><a type="button" class="ajax-delete-all"
                                       data-title="Lưu ý: Khi bạn thực hiện thao tác này, toàn bộ dữ liệu sẽ không thể khôi phục được. Hãy chắc chắn rằng bạn muốn thực hiện chức năng này!"
                                       data-module="tour_book">Xóa </a>
                                </li>

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
                                            <form class="uk-form" id="search">
                                                <input type="search" name="keyword" class="keyword form-control input-sm filter"  placeholder="Nhập từ khóa tìm kiếm theo tên..."  autocomplete="off" value="<?php echo $this->input->get('keyword'); ?>">
                                            </form>
                                        </div>
                                    </div>



                                </div>
                            </div>

                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th style="width:30px;">
                                        <input type="checkbox" id="checkbox-all">
                                        <label for="check-all" class="labelCheckAll"></label>
                                    </th>
                                    <th>Thông tin</th>
                                    <th  class="text-center">Ghi chú </th>
                                    <th  class="text-center">Tour </th>
                                    <th style="width:100px;" class="text-center">Ngày tạo</th>
                                    <th style="width:136px;" class="text-center">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody id="ajax-content">
                                <?php if (isset($listData) && is_array($listData) && count($listData)) { ?>
                                    <?php foreach ($listData as $key => $val) {
                                        $detailTour = $this->Autoload_Model->_get_where(array(
                                            'select' => 'canonical,title',
                                            'table' => 'tour',
                                            'where' => array('id'=>$val['tourID']),
                                        ));

                                        ?>

                                        <tr class="gradeX" id="post-<?php echo $val['id']; ?>">
                                            <td>
                                                <input type="checkbox" name="checkbox[]" value="<?php echo $val['id']; ?>" data-router=""  class="checkbox-item">
                                                <label for="" class="label-checkboxitem"></label>
                                            </td>
                                            <td>
                                                <b>Họ và tên:</b> <?php echo $val['fullname']; ?><br>
                                                <b>Số điện thoại:</b> <?php echo $val['phone']; ?><br>
                                                <b>Email:</b> <?php echo $val['email']; ?><br>
                                                <b>Địa chỉ:</b> <?php echo $val['address']; ?><br>

                                            </td>
                                            <td>
                                                <?php echo $val['message']; ?>
                                            </td>

                                            <td class="text-center">
                                                <a href="<?php echo $detailTour['canonical']; ?>" target="_blank"><?php echo $detailTour['title']; ?></a>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $val['created']; ?>
                                            </td>

                                            <td class="text-center">
                                                <a type="button" class="btn btn-danger ajax-delete"
                                                   data-title="Lưu ý: Dữ liệu sẽ không thể khôi phục. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!"
                                                   data-router=""
                                                   data-id="<?php echo $val['id'] ?>"
                                                   data-catalogueid=""
                                                   data-module="tour_book"><i class="fa fa-trash"></i></a>
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
