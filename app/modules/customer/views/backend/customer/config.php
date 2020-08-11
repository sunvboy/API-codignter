<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="row border-bottom">
        <?php $this->load->view('dashboard/backend/common/navbar'); ?>
    </div>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Cấu hình đăng nhập</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo site_url('admin'); ?>">Home</a>
                </li>
                <li class="active"><strong>Cấu hình đăng nhập</strong></li>
            </ol>
        </div>
    </div>
    <form method="post" action="" class="form-horizontal box" >
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="box-body">
                    <?php $error = validation_errors(); echo !empty($error)?'<div class="alert alert-danger">'.$error.'</div>':'';?>
                </div><!-- /.box-body -->
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="panel-head">
                        <h2 class="panel-title">Facebook</h2>

                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="ibox m0">
                        <div class="ibox-content">
                            <div class="row mb15">
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <label class="control-label text-left">
                                            <span>AppId <b class="text-danger">(*)</b></span>
                                        </label>
                                        <?php echo form_input('appId', set_value('appId',$detailConfig['appId']), 'class="form-control " placeholder="" autocomplete="off"');?>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <label class="control-label text-left">
                                            <span>Secret <b class="text-danger">(*)</b></span>
                                        </label>
                                        <?php echo form_input('secret', set_value('secret',$detailConfig['secret']), 'class="form-control" placeholder="" autocomplete="off"');?>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-5">
                    <div class="panel-head">
                        <h2 class="panel-title">Google</h2>

                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="ibox m0">
                        <div class="ibox-content">
                            <div class="row mb15">
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <label class="control-label text-left">
                                            <span>Google client id <b class="text-danger">(*)</b></span>
                                        </label>
                                        <?php echo form_input('google_client_id', set_value('google_client_id',$detailConfig['google_client_id']), 'class="form-control " placeholder="" autocomplete="off"');?>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <label class="control-label text-left">
                                            <span>Google client secret <b class="text-danger">(*)</b></span>
                                        </label>
                                        <?php echo form_input('google_client_secret', set_value('google_client_secret',$detailConfig['google_client_secret']), 'class="form-control " placeholder="" autocomplete="off"');?>
                                    </div>
                                </div>
                            </div>


                            <div class="toolbox action clearfix">
                                <div class="uk-flex uk-flex-middle uk-button pull-right">
                                    <button class="btn btn-primary btn-sm" name="update" value="create" type="submit">Cập nhập</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
    <?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>
