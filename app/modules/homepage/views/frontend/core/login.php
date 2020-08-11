<!-- Modal -->
<div id="dangky" class="modal fade dangky-dangnhap" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Đăng ký</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="dangky_form" method="post" class="validate ">
                    <div class="dangky-error"></div>
                    <?php
                    $configbieCataloguID = array(
                        '' => 'Chọn tài khoản*',
                        '1' => 'Cửa hàng',
                        '2' => 'Khách hàng',
                    );
                    ?>
                    <?php echo form_dropdown('catalogueid', $configbieCataloguID, set_value('catalogueid'), 'id="input_catalogueid_reg" autocomplete="off" required');?>
                    <?php echo form_input('fullname', set_value('fullname'), 'id="input_fullname_reg" required placeholder="Họ và tên"');?>
                    <?php echo form_email('email', set_value('email'), 'id="input_email_reg" required placeholder="Email(Tên đăng nhập)"');?>
                    <?php echo form_password('password', set_value('password'), 'id="input_password_reg" required placeholder="Mật khẩu"');?>
                    <?php echo form_input('phone', set_value('phone'), 'id="input_phone_reg" placeholder="Số điện thoại" required');?>
                    <?php echo form_input('address', set_value('address'), 'id="input_address_reg" placeholder="Địa chỉ" required');?>
                    <?php echo form_input('account', set_value('account'), 'id="input_account_reg" placeholder="Tên shop" ');?>
                   

                    <?php /*?>
                    <div class="mabaomat">
                        <input type="text" placeholder="Mã bảo mật" name="captcha" id="input_captcha_reg" required>
                        <span id="captImg">
                        </span>
                        <span>
                            <a href="javascript:void(0);" class="refreshCaptcha"><img src="template/frontend/images/icon7.png" alt="refreshCaptcha"></a>
                        </span>
                    </div>
                    <?php */?>


                    <div class="creat-admin">
                        <input type="submit" value="Tạo tài khoản"> <span>  Bạn đã có tài khoản? <a id="dangnhap_click" href="javascript:void(0)">Đăng nhập</a> ngay</span>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
<!-- Modal -->
<div id="dangnhap" class="modal fade dangky-dangnhap" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Đăng nhập</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="login_form" method="post">
                    <div class="login-error alert"></div>
                    <?php echo form_input('email', set_value('email'), 'id="input_email" placeholder="Email"');?>
                    <?php echo form_password('password', set_value('password'), 'id="input_password" placeholder="Mật khẩu"');?>

                    <div class="creat-admin">
                        <input type="submit" value="Đăng nhập" id="btn-submit"> <a id="forgot_click" href="javascript:void(0)" style="text-decoration: underline;">Quên mật khẩu</a>
                    </div>
                    <div class="creat-admin" style="margin-top: 10px">
                        <span>  Bạn chưa có tài khoản? <a id="dangky_click" href="javascript:void(0)">Đăng ký</a> ngay</span>

                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
<!-- Modal -->
<div id="quenmatkhau" class="modal fade dangky-dangnhap" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Quên mật khẩu</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="quenmatkhau_form" method="post">
                    <div class="quenmatkhau-error alert">
                    </div>
                    <?php echo form_input('email', set_value('email'), 'id="quenmatkhau_input_email" placeholder="Nhập email của bạn"');?>
                    <div class="creat-admin">
                        <input type="submit" value="Gửi" id="btn-submit-quenmatkhau">
                        <input type="button" value="Loading..." id="loadingDiv">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    $("#input_catalogueid_reg").change(function(){
        if(parseFloat($(this).val()) == 2){
            $('#input_address_reg').hide();
            $('#input_account_reg').hide();
        }else{
            $('#input_address_reg').show();
            $('#input_account_reg').show();
        }
    });
    $(document).ready(function(){
        $('.quenmatkhau-error').hide();
        $('#loadingDiv').hide();
        $('#quenmatkhau_form').on('submit',function(){
            var $loading = $('#loadingDiv').hide();
            $(document)
                .ajaxStart(function () {
                    $loading.show();
                    $('#btn-submit-quenmatkhau').hide();
                })
                .ajaxStop(function () {
                    $loading.hide();
                    $('#btn-submit-quenmatkhau').show();

                });

            var _this = $(this);
            var email = _this.find('#quenmatkhau_input_email').val();
            var formURL = 'forgot-modal.html';
            var url = window.location.href;
            $.post(formURL, {email: email},
                function(data){
                    $('.quenmatkhau-error').show();
                    var json = JSON.parse(data);
                    if(json.flag == false){
                        $('.quenmatkhau-error').removeClass('alert alert-success').addClass('alert alert-danger');
                        $('.quenmatkhau-error').html(json.message);
                    }else{
                        $('#btn-submit-quenmatkhau').val('Loading....');
                        $('.quenmatkhau-error').removeClass('alert alert-danger').addClass('alert alert-success');
                        $('.quenmatkhau-error').html(json.message);
                        setTimeout(function(){ window.location.href = url; }, 1200);
                    }
                });
            return false;
        });
    });
</script>


