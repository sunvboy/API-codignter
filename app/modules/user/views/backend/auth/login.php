<!DOCTYPE html>
<html>

<head>
    <base href="<?php echo BASE_URL; ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>OVN CRM | Đăng nhập</title>

    <link href="template/backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="template/backend/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="template/backend/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="template/backend/css/animate.css" rel="stylesheet">
    <link href="template/backend/css/style.css" rel="stylesheet">
    <link href="template/backend/css/customize.css" rel="stylesheet">
    <script src="plugin/jquery-3.3.1.min.js"></script>
    <script>
        var BASE_URL = '<?php echo BASE_URL; ?>';
    </script>
</head>

<body class="gray-bg">

<div class="loginColumns animated fadeInDown">
    <div class="row">
        <div class="col-md-3"></div>

        <div class="col-md-6">
            <h1 class="text-center" style="text-transform: uppercase;font-weight: bold">Hệ thống quản trị</h1>

            <div class="ibox-content">
                <?php
                $error = validation_errors();
                echo (!empty($error) && isset($error)) ? '<div class="alert alert-danger">' . $error . '</div>' : '';
                ?>

                <form class="m-t" role="form" method="post" action="">
                    <div class="form-group">
                        <input type="text" class="form-control" name="account" placeholder="Tài khoản">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                    </div>
                    <button type="submit" name="login" value="create" class="btn btn-primary block full-width m-b">Đăng
                        nhập
                    </button>

                    <div class="row">
                        <div class="col-md-6 col-xs-12 col-sm-6">
                            <select name="lang" id="lang" class="form-control">
                                <option value="vietnamese">Vietnamese</option>
                                 <option value="english">English</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-xs-12 col-sm-6">
                            <a href="<?php echo base_url('user/backend/auth/recovery'); ?>" style="text-align: right">
                                <small>Quên mật khẩu?</small>
                            </a>
                        </div>

                    </div>


                </form>

            </div>
        </div>
        <div class="col-md-3"></div>
    </div>


</div>
<?php $this->load->view('dashboard/backend/common/notification'); // Show cái hiển thị thông báo ?>
<script src="template/backend/js/plugins/toastr/toastr.min.js"></script>
</body>

</html>
