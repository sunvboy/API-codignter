<div class="container-fluid col-bg">
    <div class="row" style="height: 100vh; overflow: hidden">
        <div class="col-12 col-md-8 col-xl-9 d-none d-md-flex"></div>
        <div class="col-12 col-md-3 col-xl-3 col-auth d-flex justify-content-center pt-5">
            <div class="logo"><a href="<?php echo base_url()?>"><img src="<?php echo $this->fcSystem['homepage_logo'] ?>" alt="<?php echo $this->fcSystem['homepage_company'] ?>"></a></div>
            <div class="col-wrapper w-100">
                <form method="POST" action="" id="contact_form">

                    <div class="form-group">

                        <?php
                        $error = validation_errors();
                        echo (!empty($error) && isset($error)) ? '<div class="alert alert-danger">'.$error.'</div>' : '';
                        ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_input('email', set_value('email'), 'class="field__input form-control" placeholder="Email(Tài khoản đăng nhập)" autocomplete="off"');?>
                    </div>

                    <div class="form-group" style="text-align: right">
                        <a href="login.html" style="color: #fff">Đăng nhập</a> | <a href="register.html" style="color: #fff">Đăng ký</a>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="forgot" class="form-control " id="submitform" value="Gửi">
                        <input type="button" class="form-control" value="Dữ liệu đang được xử lý..." id="gif">

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
<script type="text/javascript">
    $('#gif').hide();
    $('#contact_form').submit(function() {
        $('#submitform').hide();
        $('#gif').show();
        return true;
    });
</script>
