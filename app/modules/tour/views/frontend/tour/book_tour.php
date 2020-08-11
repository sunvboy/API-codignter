<?php
$prd_info = getPriceFrontend(array('productDetail' => $tourDetail));
$prd_href = rewrite_url($tourDetail['canonical']);
$list_image = json_decode(base64_decode($tourDetail['image_json']), TRUE);
?>
<div id="main" class="wrapper main-car-detail main-cars-list">
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url()?>"><?php echo $this->lang->line('home')?> </a></li>

                <li><a href="javascript:void(0);"> / <?php echo $this->lang->line('Book_tour')?></a></li>
            </ul>
        </div>
    </div>
    <section class="content-services-detail">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="services-detail-left">

                        <?php if (isset($list_image) && is_array($list_image) && count($list_image)) { ?>

                            <div class="slider-services-detail owl-carousel">

                                <?php foreach ($list_image as $key => $val) { ?>
                                    <div class="item">
                                        <img src="<?php echo $val; ?>" alt="<?php echo $tourDetail['title']; ?>">
                                    </div>
                                <?php }?>
                            </div>
                        <?php }?>
                    </div>
                </div>

                <?php
                $attribute_catalogues = $this->Autoload_Model->_get_where(array(
                    'select' => 'id, title,image',
                    'table' => 'attribute_catalogue',
                    'where' => array('tour' => 1,'ishome' => 1, 'publish' => 0,  'alanguage' => $this->fclang)), TRUE);
                if (isset($attribute_catalogues) && is_array($attribute_catalogues) && count($attribute_catalogues)) {
                    foreach ($attribute_catalogues as $key => $val) {
                        $attribute_catalogues[$key]['post'] = $this->Autoload_Model->_get_where(array(
                            'select' => 'id, title',
                            'table' => 'attribute',
                            'order_by' => 'order asc,id desc',
                            'where' => array('publish' => 0, 'catalogueid' => $val['id'], 'alanguage' => $this->fclang)), TRUE);
                    }
                }


                $attribute_catalogues_noneishome = $this->Autoload_Model->_get_where(array(
                    'select' => 'id, title,image',
                    'table' => 'attribute_catalogue',
                    'where' => array('tour' => 1,'ishome' => 0, 'publish' => 0,  'alanguage' => $this->fclang)), TRUE);
                if (isset($attribute_catalogues_noneishome) && is_array($attribute_catalogues_noneishome) && count($attribute_catalogues_noneishome)) {
                    foreach ($attribute_catalogues_noneishome as $key => $val) {
                        $attribute_catalogues_noneishome[$key]['post'] = $this->Autoload_Model->_get_where(array(
                            'select' => 'id, title',
                            'table' => 'attribute',
                            'order_by' => 'order asc,id desc',
                            'where' => array('publish' => 0, 'catalogueid' => $val['id'], 'alanguage' => $this->fclang)), TRUE);
                    }
                }

                $attribute_checked = $this->Autoload_Model->_get_where(array(
                    'select' => 'moduleid,attrid',
                    'table' => 'attribute_relationship',
                    'where' => array('module' => 'tour', 'moduleid' => $tourDetail['id'])), TRUE);
                $temp = [];
                if(isset($attribute_checked) && is_array($attribute_checked) && count($attribute_checked)){
                    foreach($attribute_checked as $key => $val){
                        $temp[] = $val['attrid'];
                    }
                }
                ?>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="services-detail-left">
                        <h1 class="title-pr"><?php echo $tourDetail['title']; ?></h1>
                        <p class="price">$ <?php echo $prd_info['price_final'] ?></p>

                    </div>
                    <div class="sidebar-right">
                        <?php if(!empty($temp)){?>
                            <?php if (isset($attribute_catalogues) && is_array($attribute_catalogues) && count($attribute_catalogues)) { ?>
                                <div class="information-sidebar1">
                                    <div class="nav-infomation-sb1">
                                        <?php foreach ($attribute_catalogues as $key => $val) { ?>
                                            <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                                                <?php foreach ($val['post'] as $keyP => $valP) { ?>
                                                    <?php if(in_array($valP['id'], $temp) == true){?>
                                                        <p class="desc"><label><?php echo $val['title']; ?>: </label> <?php echo $valP['title']; ?> </p>
                                                    <?php }?>
                                                <?php }?>
                                            <?php }?>

                                        <?php }?>
                                    </div>
                                </div>
                            <?php }?>
                        <?php }?>
                        <?php if(!empty($temp)){?>

                            <?php if (isset($attribute_catalogues_noneishome) && is_array($attribute_catalogues_noneishome) && count($attribute_catalogues_noneishome)) { ?>
                                <?php foreach ($attribute_catalogues_noneishome as $key => $val) { ?>
                                    <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                                        <div class="list-infomation-sb" style="padding-top: 0px">
                                            <h3 class="title"><?php echo $val['title']; ?></h3>
                                            <ul>
                                                <?php foreach ($val['post'] as $keyP => $valP) { ?>
                                                    <?php if(in_array($valP['id'], $temp) == true){?>
                                                        <li>
                                                            <?php echo $valP['title']; ?>
                                                        </li>
                                                    <?php }?>
                                                <?php }?>
                                            </ul>
                                        </div>
                                    <?php }?>
                                <?php }?>
                            <?php }?>
                        <?php }?>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="category-home last-rental tour-other">
        <form method="post" action="submit-book-tour.html" class="container" id="bookTour">
            <h3 class="h3-form"><span><?php echo $this->lang->line('Contact_Info')?></span></h3>
            <div class="error col-md-12 form-group">

            </div>
            <div class="row" >

                <div class="form-group col-md-4">
                    <label><?php echo $this->lang->line('Fullname')?>*:</label>
                    <input type="text" name="fullname" id="fullname" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                    <label>Email*:</label>
                    <input type="email" name="email" id="email" class="form-control " required>
                </div>
                <div class="form-group col-md-4">
                    <label><?php echo $this->lang->line('Phone')?>*:</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                    <label><?php echo $this->lang->line('Address')?>*:</label>
                    <textarea name="address" id="address" class="form-control " required></textarea>
                </div>
                <div class="form-group col-md-8">
                    <label><?php echo $this->lang->line('Note')?>:</label>
                    <textarea name="message" id="message" class="form-control"></textarea>
                </div>
            </div>
            <h3 class="h1-title">
                <?php echo $this->lang->line('Terms_of_payment')?>
            </h3>
            <div class="term-condition">
                <?php echo $this->fcSystem['aboutus_tour']?>
            </div>
            <div class="clearfix">
                <div class=" pull-right">
                    <input class="btn btn-success" id="btn-submit" type="submit" value="<?php echo $this->lang->line('Submit_order')?>" style="background: #e7be66;border: 1px solid #e7be66">
                    <input class="btn btn-success" id="loadgif" value="<?php echo $this->lang->line('Loading')?>" style="background: #e7be66;border: 1px solid #e7be66">
                </div>
            </div>
        </form>
    </section>
</div>
<style>
    .h3-form {
        border-bottom: 1px solid #e7be66;
        margin-bottom: 25px;
        font-size: 18px;
    }
    .h3-form span {
        display: inline-block;
        padding: 8px 20px;
        color: #FFFFFF;
        background: #e7be66;
    }
    .term-condition {
        height: 250px;
        overflow: hidden;
        padding: 20px;
        border: 1px solid #CCCCCC;
        width: auto;
        margin-bottom: 10px;
    }
    .term-condition::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    .term-condition::-webkit-scrollbar
    {
        width: 6px;
        background-color: #F5F5F5;
    }

    .term-condition::-webkit-scrollbar-thumb
    {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #000;
    }
</style>
<script>
    $(document).ready(function () {
        $('#bookTour .error').hide();
        var uri = $('#bookTour').attr('action');
        $('#bookTour').on('submit', function () {
            var postData = $(this).serializeArray();
            $.post(uri, {post: postData, tourID: '<?php echo $tourDetail['id']?>', fullname: $('#fullname').val(), email: $('#email').val(), phone: $('#phone').val(), address: $('#address').val(), message: $('#message').val()}, function (data) {
                var json = JSON.parse(data);
                $('#bookTour .error').show();
                if (json.error.length) {
                    $('#bookTour .error').removeClass('alert alert-success').addClass('alert alert-danger');
                    $('#bookTour .error').html('').html(json.error);
                } else {
                    $('#bookTour .error').removeClass('alert alert-danger').addClass('alert alert-success');
                    $('#bookTour .error').html('').html('Sign up for the tour successfully.');
                    $('#bookTour').trigger("reset");
                    setTimeout(function () {
                        window.location = '<?php echo $prd_href?>';
                    }, 2000);
                }
            });
            return false;
        });
    });
</script>
<script>
    $("#loadgif").hide();
    $(document).ready(function () {
        $(document).ajaxStart(function () {
            $("#btn-submit").hide();
            $("#loadgif").show();
        }).ajaxStop(function () {
            $("#btn-submit").show();
            $("#loadgif").hide();
        });
    });
</script>