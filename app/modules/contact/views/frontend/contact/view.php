
<?php
$page = $this->Autoload_Model->_get_where(array(
    'select' => 'description,content',
    'table' => 'page',
    'where' => array('id' => 26)));

?>
<main>


    <div class="content">

        <div class="clearfix"></div>
        <section class="listProduct">
            <div class="container">
                <div class="">
                    <div class="col-md-9 col-xs-12 col-sm-9">
                        <ul class="breadcrumb">
                            <li><a href="<?php echo base_url()?>">Trang chủ</a></li>

                            <li>Liên hệ</li>
                        </ul>
                        <div class="col-md-12">
                            <h2 class="main-header"><a href="javascript:void(0)">Liên hệ</a></h2>

                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12">
                            <div class="cat_decription">

                                <?php if(!empty($page)){?><?php echo $page['description']?><?php }?>

                            </div>

                        </div>

                        <div class="clearfix" style="height: 20px"></div>
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="small-5 modrightcat">
                                <div class="foot-cat">
                                    <div class="black-studio-tinymce-8">
                                        <div class="textwidget">
                                            <?php if(!empty($page)){?><?php echo $page['content']?><?php }?>

                                            <p></p>

                                            <div class="contact-form">
                                                <footer style="background: transparent">
                                                    <div class="textwidget">
                                                        <form action="contact/frontend/contact/ajaxSendcontact.html" method="post" id="formAdmission">
                                                            <div class="form-group">
                                                                <div class="error" ></div>


                                                            </div>
                                                            <div class="form-group">
                                                                <input class="form-control fullname" name="fullname" placeholder="Tên của bạn...">

                                                            </div>
                                                            <div class="form-group">
                                                                <input class="form-control phone" name="phone" placeholder="Số điện thoại của bạn...">

                                                            </div>
                                                            <div class="form-group">
                                                                <textarea class="form-control message" name="message" placeholder="Nội dung..."></textarea>

                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="button">ĐĂNG KÝ NGAY!</button>

                                                            </div>
                                                        </form>

                                                    </div>
                                                </footer>

                                            </div>


                                            <?php echo $this->load->view('contact/frontend/contact/maps'); ?>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <?php echo $this->load->view('homepage/frontend/common/aside'); ?>
                </div>

            </div>

        </section>

    </div>


</main>













<?php /*<div id="main" class="wrapper">


    <div id="main-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="content-contact">
                        <p class="thank-you">Thank you for visiting our website.</p>
                        <h1 class="title-contact"><?php echo $this->fcSystem['homepage_company']; ?></h1>
                        <ul class="adress-contact">
                            <li><span>Địa chỉ: </span><?php echo $this->fcSystem['contact_address']; ?></li>
                            <li><span>Số điện thoại: </span><?php echo $this->fcSystem['contact_hotline']; ?></li>
                            <li><span>Email:</span><?php echo $this->fcSystem['contact_email']; ?></li>
                            <li><span>Website: </span><?php echo base_url()?></li>
                        </ul>
                    </div>
                    <div class="map-contact">
                        <?php echo $this->load->view('contact/frontend/contact/maps'); ?>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="form-contat">
                        <p class="desc">Please fill up the form and send to us. Our consultants will respond to you as soon as possible.<br>
                            Thanks you!
                        </p>
                        <form action="contact/frontend/contact/ajaxSendcontact.html" method="post" id="formAdmission">
                            <div class="error" ></div>
                            <input type="text" placeholder="Họ và tên" name="fullname" class="fullname">
                            <input type="text" placeholder="Email" name="email" class="email">
                            <input type="text" placeholder="Số điện thoại" name="phone" class="phone">
                            <input type="text" placeholder="Địa chỉ" name="address" class="address">
                            <textarea name="message" cols="40" rows="10" placeholder="Nội dung" class="message"></textarea>
                            <div class="send-contact">

                                <div class="item">
                                    <input type="submit" value="Gửi đi">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>*/?>

<script>

    $(document).ready(function () {

        $('#formAdmission .error').hide();

        var uri = $('#formAdmission').attr('action');

        $('#formAdmission').on('submit', function () {

            var postData = $(this).serializeArray();

            $.post(uri, {

                post: postData,

                fullname: $('#formAdmission .fullname').val(),
                phone: $('#formAdmission .phone').val(),
                message: $('#formAdmission .message').val(),
            }, function (data) {
                var json = JSON.parse(data);
                $('#formAdmission .error').show();
                if (json.error.length) {
                    $('#formAdmission .error').removeClass('alert alert-success').addClass('alert alert-danger');
                    $('#formAdmission .error').html('').html(json.error);
                } else {
                    $('#formAdmission .error').removeClass('alert alert-danger').addClass('alert alert-success');

                    $('#formAdmission .error').html('').html(json.message);

                    $('#formAdmission').trigger("reset");

                    setTimeout(function () {

                        location.reload();

                    },3000);

                }

            });

            return false;

        });

    });

</script>