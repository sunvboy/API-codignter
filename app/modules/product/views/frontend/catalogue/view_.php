<div id="main" class="wrapper main-product">
    <div class="breadcrumb">
        <div class="container">

            <div class="row">
                <div class="">
                    <ul>
                        <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>
                        <?php foreach ($breadcrumb as $key => $val) { ?>
                            <?php
                            $title = $val['title'];
                            $href = rewrite_url($val['canonical'], true, true);
                            ?>
                            <li><a href="<?php echo $href ?>"> / <?php echo $title ?></a></li>
                        <?php } ?>
                    </ul>
                </div>

            </div>

        </div>
    </div>


</div>
<section>
    <div class="container">
        <div class="row">
            <style type="text/css">
                .product-home .row > div {

                    padding-left: 2.5px;
                    padding-right: 2.5px;
                }
                .product-home .row  {

                    margin: 0px -2.5px;
                }
            </style>
            <?php if ($this->fcDevice == 'desktop') { ?>
                <?php echo $this->load->view('homepage/frontend/common/aside'); ?>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="content-product">
                        <div class="top-product-page">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <h1 class="title-pri"><?php echo $detailCatalogue['title'] ?> <span>(<span
                                                style="color: #ef0024"><?php echo number_format($total_rows) ?></span> sản phẩm)</span>
                                    </h1>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="top-product-right">
                                        <ul>
                                            <li>
                                                <select name="sort" id="dynamic_select">
                                                    <option value="">Sắp xếp</option>
                                                    <option value="id|desc"
                                                            <?php if (!empty($_GET['sort'])){ ?><?php if ($_GET['sort'] == 'id|desc'){ ?>selected<?php } ?><?php } ?>>
                                                        Sản phẩm mới
                                                    </option>
                                                    <option value="price|asc"
                                                            <?php if (!empty($_GET['sort'])){ ?><?php if ($_GET['sort'] == 'price|asc'){ ?>selected<?php } ?><?php } ?>>
                                                        Giá thấp
                                                    </option>
                                                    <option value="price|desc"
                                                            <?php if (!empty($_GET['sort'])){ ?><?php if ($_GET['sort'] == 'price|desc'){ ?>selected<?php } ?><?php } ?>>
                                                        Giá cao
                                                    </option>
                                                </select>
                                                <?php
                                                $hrefCatalogue = rewrite_url($detailCatalogue['canonical'], true, true);
                                                ?>
                                                <script>
                                                    $(function () {
                                                        $('#dynamic_select').on('change', function () {
                                                            var url = $(this).val();
                                                            if (url) {
                                                                if (url == '') {
                                                                    window.location = '<?php echo $hrefCatalogue?>';

                                                                } else {
                                                                    window.location = '<?php echo $hrefCatalogue?>?sort=' + url;

                                                                }
                                                            }
                                                            return false;
                                                        });
                                                    });
                                                </script>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($productList) && is_array($productList) && count($productList)) { ?>

                            <section class="product-home" >
                                <div class="row">
                                    <?php $j = 0;
                                    foreach ($productList as $key => $val) {
                                        $j++;

                                        $title = $val['title'];
                                        $href = rewrite_url($val['canonical'], TRUE, TRUE);
                                        $getPrice = getPriceFrontend(array('productDetail' => $val));
                                        $averagePoint = 0;
                                        $comment = comment(array('id' => $val['id'], 'module' => 'product'));
                                        if (isset($comment) && is_array($comment) && count($comment)) {
                                            $averagePoint = round($comment['statisticalRating']['averagePoint']);
                                        }
                                        ?>
                                        <div class="col-md-3 col-sm-6 col-xs-6">
                                            <div class="item">
                                                <div class="image">
                                                    <a href="<?php echo $href ?>"><img src="<?php
                                                        if (file_exists(FCPATH . $val['image'])) {
                                                            echo $val['image'];

                                                        } else {
                                                            echo 'template/not-found.png';
                                                        } ?>" alt="<?php echo $title ?>"></a>
                                                </div>
                                                <div class="nav-image">
                                                    <h3 class="title"><a
                                                            href="<?php echo $href ?>"><?php echo $title ?></a>
                                                    </h3>

                                                    <p class="price">
                                                        <?php echo $getPrice['price_final'] ?>
                                                        <?php if ($averagePoint > 0) { ?>
                                                            <span class="start">
                                                            <?php for ($i = 1; $i <= $averagePoint; $i++) { ?>
                                                                <i class="fas fa-star"></i>
                                                            <?php } ?>
                                                                <?php for ($i = 1; $i <= (5 - $averagePoint); $i++) { ?>
                                                                    <i class="far fa-star"></i>
                                                                <?php } ?>

                                                        </span>
                                                        <?php } ?>

                                                    </p>

                                                    <a href="thuong-hieu.html?id=<?php echo $val['customerid'] ?>"><p
                                                            class="shop-vp"><img
                                                                src="template/frontend/images/icon4.png"
                                                                alt=""><?php echo $val['customer_account'] ?>
                                                        </p></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="pagenavi">
                                    <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
                                </div>

                            </section>
                        <?php } ?>
                    </div>


                </div>
            <?php } else { ?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="content-product">
                        <div class="top-product-page">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <h1 class="title-pri"><?php echo $detailCatalogue['title'] ?> <span>(<span
                                                style="color: #ef0024"><?php echo number_format($total_rows) ?></span> sản phẩm)</span>
                                    </h1>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="top-product-right">
                                        <ul>
                                            <li>
                                                <select name="sort" id="dynamic_select">
                                                    <option value="">Sắp xếp</option>
                                                    <option value="id|desc"
                                                            <?php if (!empty($_GET['sort'])){ ?><?php if ($_GET['sort'] == 'id|desc'){ ?>selected<?php } ?><?php } ?>>
                                                        Sản phẩm mới
                                                    </option>
                                                    <option value="price|asc"
                                                            <?php if (!empty($_GET['sort'])){ ?><?php if ($_GET['sort'] == 'price|asc'){ ?>selected<?php } ?><?php } ?>>
                                                        Giá thấp
                                                    </option>
                                                    <option value="price|desc"
                                                            <?php if (!empty($_GET['sort'])){ ?><?php if ($_GET['sort'] == 'price|desc'){ ?>selected<?php } ?><?php } ?>>
                                                        Giá cao
                                                    </option>
                                                </select>
                                                <?php
                                                $hrefCatalogue = rewrite_url($detailCatalogue['canonical'], true, true);
                                                ?>
                                                <script>
                                                    $(function () {
                                                        $('#dynamic_select').on('change', function () {
                                                            var url = $(this).val();
                                                            if (url) {
                                                                if (url == '') {
                                                                    window.location = '<?php echo $hrefCatalogue?>';

                                                                } else {
                                                                    window.location = '<?php echo $hrefCatalogue?>?sort=' + url;

                                                                }
                                                            }
                                                            return false;
                                                        });
                                                    });
                                                </script>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        $childCatalogue = $this->Autoload_Model->_get_where(array(
                            'select' => 'id, title, slug, canonical, lft, rgt',
                            'table' => 'product_catalogue',
                            'where' => array('publish' => 0, 'parentid' => $detailCatalogue['id'])), true);
                        ?>
                        <?php if (isset($childCatalogue) && is_array($childCatalogue) && count($childCatalogue)) { ?>
                            <div class="Categories__StyledCategories-sc-1k2hubq-0 hYyNbw">
                                <div class="inner">
                                    <?php foreach ($childCatalogue as $keyC => $valC) {
                                        $hrefC = rewrite_url($valC['canonical'], TRUE, TRUE);

                                        ?>
                                        <a class="item" href="<?php echo $hrefC ?>">

                                            <div class="name"><?php echo $valC['title'] ?></div>
                                        </a>
                                    <?php }?>
                                </div>
                            </div>
                        <?php }?>

                        <?php if (isset($productList) && is_array($productList) && count($productList)) { ?>

                            <section class="product-home ">
                                <div class="row">
                                    <?php $j = 0;
                                    foreach ($productList as $key => $val) {
                                        $j++;

                                        $title = $val['title'];
                                        $href = rewrite_url($val['canonical'], TRUE, TRUE);
                                        $getPrice = getPriceFrontend(array('productDetail' => $val));
                                        $description = cutnchar(strip_tags($val['description']), 100);
                                        $averagePoint = 0;
                                        $comment = comment(array('id' => $val['id'], 'module' => 'product'));
                                        if (isset($comment) && is_array($comment) && count($comment)) {
                                            $averagePoint = round($comment['statisticalRating']['averagePoint']);
                                        }
                                        ?>
                                        <div class="col-md-3 col-sm-6 col-xs-6">
                                            <div class="item">
                                                <div class="image">
                                                    <a href="<?php echo $href ?>"><img src="<?php
                                                        if (file_exists(FCPATH . $val['image'])) {
                                                            echo $val['image'];

                                                        } else {
                                                            echo 'template/not-found.png';
                                                        } ?>" alt="<?php echo $title ?>"></a>
                                                </div>
                                                <div class="nav-image">
                                                    <h3 class="title"><a
                                                            href="<?php echo $href ?>"><?php echo $title ?></a>
                                                    </h3>

                                                    <p class="price">
                                                        <?php echo $getPrice['price_final'] ?>
                                                        <?php if ($averagePoint > 0) { ?>
                                                            <span class="start">
                                                            <?php for ($i = 1; $i <= $averagePoint; $i++) { ?>
                                                                <i class="fas fa-star"></i>
                                                            <?php } ?>
                                                                <?php for ($i = 1; $i <= (5 - $averagePoint); $i++) { ?>
                                                                    <i class="far fa-star"></i>
                                                                <?php } ?>

                                                        </span>
                                                        <?php } ?>

                                                    </p>

                                                    <a href="thuong-hieu.html?id=<?php echo $val['customerid'] ?>"><p
                                                            class="shop-vp"><img
                                                                src="template/frontend/images/icon4.png"
                                                                alt=""><?php echo $val['customer_account'] ?>
                                                        </p></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="pagenavi">
                                    <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
                                </div>

                            </section>
                        <?php } ?>
                    </div>


                </div>

            <?php } ?>


        </div>
    </div>
</section>
<style>
    .hYyNbw{
        margin-top: 12px;
    }
    .hYyNbw .inner {
        display: flex;
        -webkit-box-pack: justify;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    .hYyNbw .item {
        width: calc(50% - 4px);
        background-color: rgba(36, 36, 36, 0.05);
        display: block;
        padding: 8px;
        border-radius: 8px;
        margin: 0px 0px 8px;
        text-decoration: none;
    }
    .hYyNbw .name {
        font-size: 13px;
        line-height: 20px;
        color: rgb(36, 36, 36);
        text-align: center;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }
</style>