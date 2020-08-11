<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
        <li><a href="javascript:void(0)">Sản phẩm yêu thích</a></li>
    </ul>

    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
            <h2 class="title">Sản phẩm yêu thích</h2>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <td class="text-center">Ảnh</td>
                        <td class="text-left">Sản phẩm</td>
                        <td class="text-right">Giá sản phẩm</td>
                        <td class="text-right">#</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($listwishlist) && is_array($listwishlist) && count($listwishlist)) { ?>
                        <?php $i = 0;
                        foreach ($listwishlist as $keyPost => $valPost) {
                            $i++; ?>
                            <?php
                            $title = $valPost['title'];
                            $href = rewrite_url($valPost['canonical'], TRUE, TRUE);
                            $image = getthumb($valPost['image']);
                            $getPrice = getPriceFrontend(array('productDetail' => $valPost));
                            $comment = comment(array('module' => 'product', 'id' => $valPost['id']));
                            if (isset($comment) && is_array($comment) && count($comment)) {
                                $prd_rate = (float)$comment['statisticalRating']['averagePoint'];
                            }
                            ?>


                            <tr>
                                <td class="text-center">
                                    <a target="_blank" href="<?php echo $href ?>"><img width="70px"
                                                                                       style="width: 70px;object-fit: contain;height: 70px"
                                                                                       src="<?php echo $image ?>"
                                                                                       alt="<?php echo $title ?>"
                                                                                       title="<?php echo $title ?>"></a>
                                </td>
                                <td class="text-left"><a target="_blank" href="<?php echo $href ?>"><?php echo $title ?></a>
                                </td>
                                <td class="text-right">
                                    <div class="price"><span
                                            class="price-new"><?php echo $getPrice['price_final'] ?></span> <span
                                            class="price-old"><?php echo $getPrice['price_old'] ?></span></div>
                                </td>
                                <td class="text-right">
                                    <a class="btn btn-danger" onclick="delele_wishlistadd(<?php echo $valPost['id']?>,<?php echo $this->FT_auth['id']?>)"  href="javascript:void(0);"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>

                        <?php }
                    } ?>



                    </tbody>
                </table>
                <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

            </div>
        </div>

        <!--Middle Part End-->
        <?php echo $this->load->view('user/frontend/manage/aside') ?>

    </div>
</div>