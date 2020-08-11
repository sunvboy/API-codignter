<main>


    <div class="content">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>
            <?php foreach ($breadcrumb as $key => $val) { ?>
                <?php
                $title = $val['title'];
                $href = rewrite_url($val['canonical'], true, true);
                ?>
                <li><a href="<?php echo $href ?>"> <?php echo $title ?></a></li>
            <?php } ?>
        </ul>
        <div class="clearfix"></div>
        <section class="listProduct">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="main-header"><a href="javascript:void(0)"><?php echo $detailCatalogue['title'] ?></a>
                        </h2>

                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <div class="cat_decription">

                            <?php echo $detailCatalogue['description'] ?>

                        </div>

                    </div>
                    <div class="clearfix"></div>

                    <?php if (isset($productList) && is_array($productList) && count($productList)) { ?>

                        <?php $j = 0;
                        foreach ($productList as $key => $val) {
                            $j++;

                            $title = $val['title'];
                            $href = rewrite_url($val['canonical'], TRUE, TRUE);
                            $description = cutnchar(strip_tags($val['description']), 200);
                            ?>
                            <div class="col-md-3 col-xs-12 col-sm-3 p2">
                                <div class="box_listProduct">
                                    <div class="box-image">
                                        <a href="<?php echo $href ?>"><img src="<?php echo $val['image'] ?>"
                                                                           alt="<?php echo $title ?>"
                                                                           style="height: 210px;object-fit: cover"></a>

                                    </div>
                                    <div class="box_text_listProduct">
                                        <?php /*<a href="" class="category_tag_listProduct">Thiết kế shop thời trang</a>*/ ?>
                                        <h3><a href="<?php echo $href ?>"><?php echo $title ?></a></h3>
                                        <div class="is-divider"></div>
                                        <div class="desc">&nbsp;<?php echo $description ?>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        <?php } ?>
                    <?php } ?>

                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>


                    </div>
                    <?php
                    $page = $this->Autoload_Model->_get_where(array(
                        'select' => 'title,description,content',
                        'table' => 'page',
                        'where' => array('id' => 27)));

                    ?>
                    <div class="clearfix" style="height: 20px"></div>
                    <div class="col-md-6 col-xs-12 col-sm-6">
                        <div class="small-7 modleftcat bottomcategoryleft ">
                            <h3><?php echo $page['title']?></h3>
                            <?php echo $page['description']?>
                        </div>

                    </div>
                    <div class="col-md-6 col-xs-12 col-sm-6">
                        <div class="small-5 modrightcat">
                            <div class="foot-cat">
                                <div class="black-studio-tinymce-8">
                                    <div class="textwidget">
                                        <?php echo $page['content']?>
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

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </section>

    </div>


</main>
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