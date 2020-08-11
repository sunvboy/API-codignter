<div class="container-fluid col-bg">
    <div class="row" style="height: 100vh; overflow: hidden">
        <div class="col-12 col-md-8 col-xl-9 d-none d-md-flex"></div>
        <div class="col-12 col-md-3 col-xl-3 col-auth d-flex justify-content-center pt-5">
            <div class="logo"><a href="<?php echo base_url()?>"><img src="<?php echo $this->fcSystem['homepage_logo'] ?>" alt="<?php echo $this->fcSystem['homepage_company'] ?>"></a></div>
            <div class="col-wrapper w-100">
                <form method="POST" action="">

                    <div class="form-group">
                        <?php
                        if(null !== show_flashdata()){
                            $flash = show_flashdata();
                        }
                        ?>
                        <?php if(isset($flash) && is_array($flash) && count($flash) && $flash['message'] != ''){ ?>
                            <div class="alert alert-success"><?php echo $flash['message']?></div>
                        <?php }?>


                        <?php
                        $error = validation_errors();
                        echo (!empty($error) && isset($error)) ? '<div class="alert alert-danger">'.$error.'</div>' : '';
                        ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_input('email', set_value('email'), 'class="field__input form-control" placeholder="Email(Tài khoản đăng nhập)" autocomplete="off"');?>
                    </div>
                    <div class="form-group">
                        <?php echo form_password('password', set_value('password'), 'class="field__input form-control" placeholder="Mật khẩu" autocomplete="off"');?>
                    </div>
                    <div class="form-group" style="text-align: right">
                        <a href="forgot-password.html" style="color: #fff">Quên mật khẩu</a> | <a href="register.html" style="color: #fff">Đăng ký</a>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="login" class="form-control " value="Đăng nhập">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<style>
    header,footer{
        display: none;
    }
    .col-bg {
        background: url(template/frontend/asset/images/bg2.jpg);
        background-size: cover;
        background-position: center center;
        position: relative;
    }
</style>
<?php /*?>

<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url()?>"><i class="fa fa-home"></i></a></li>
        <li><a href="login.html">Đăng nhập</a></li>
    </ul>
    <div class="row">
        <div id="content" class="col-sm-12">
            <div class="page-login">
                <div class="account-border">
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="col-sm-6 customer-login">
                                <div class="well">
                                    <h2><i class="fa fa-file-text-o" aria-hidden="true"></i> Đăng nhập</h2>
                                    <div class="form-group">
                                        <?php
                                        if(null !== show_flashdata()){
                                            $flash = show_flashdata();
                                        }
                                        ?>
                                        <?php if(isset($flash) && is_array($flash) && count($flash) && $flash['message'] != ''){ ?>
                                            <div class="alert alert-success"><?php echo $flash['message']?></div>
                                        <?php }?>


                                        <?php
                                        $error = validation_errors();
                                        echo (!empty($error) && isset($error)) ? '<div class="alert alert-danger">'.$error.'</div>' : '';
                                        ?>
                                        <label class="control-label " for="input-email">Tài khoản</label>
                                        <input type="text" name="email" value="" id="input-email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label " for="input-password">Mật khẩu</label>
                                        <input type="password" name="password" value="" id="input-password" class="form-control">
                                        Bạn chưa có tài khoản? đăng ký <a href="register.html" style="text-transform: uppercase;text-decoration: underline;">tại đây</a>
                                    </div>
                                    <div class="login-left">
                                        <?php $google_login_url = $this->google->get_login_url(); ?>
                                        <?php $facebook_login_url = $this->facebook->get_loginfb_url(); ?>
                                        <a class="login-social lg-facebook" href="<?php echo $facebook_login_url?>" id="myvne_facebook_login"></a>
                                        <a class="login-social lg-google" href="<?php echo $google_login_url?>" id="myvne_google_login"></a>
                                    </div>
                                </div>
                                <div class="bottom-form">
                                    <a href="forgot-password.html" class="forgot">Quên mật khẩu</a>
                                    <input type="submit" name="login" value="Đăng nhập" class="btn btn-default pull-right">
                                </div>
                            </div>
                        </form>
                        <div class="col-sm-3"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<style>
    .login-social {
        background: url(template/icon_social_f_g_t.png) no-repeat;
        width: 110px;
        height: 30px;
        display: inline-block;
        font-size: 100%;
        vertical-align: top;
    }
    .login-social {
        margin-top: 5px;
        margin-right: 10px;
    }
    .login-social.lg-google {
        background-position: 0 -30px;
    }
</style>
<?php */?>