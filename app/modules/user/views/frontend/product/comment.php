<?php
$comment_view = comment(array('id' => $product['id'], 'module' => 'product'));
$averagePoint = 0;
$totalComment = 0;
$arrayRate5 = $arrayRate4 = $arrayRate3 = $arrayRate2 = $arrayRate1 = 0;
$arrayRate5PT = $arrayRate4PT = $arrayRate3PT = $arrayRate2PT = $arrayRate1PT = 0;
if (isset($comment_view) && is_array($comment_view) && count($comment_view)) {
    $averagePoint = round($comment_view['statisticalRating']['averagePoint']);
    $totalComment = $comment_view['statisticalRating']['totalComment'];
    $arrayRate5 = $comment_view['statisticalRating']['arrayRate'][5];
    if($arrayRate5>0){
        $arrayRate5PT = ($arrayRate5/$totalComment)*100;
    }
    $arrayRate4 = $comment_view['statisticalRating']['arrayRate'][4];
    if($arrayRate4>0){
        $arrayRate4PT = ($arrayRate4/$totalComment)*100;
    }
    $arrayRate3 = $comment_view['statisticalRating']['arrayRate'][3];
    if($arrayRate3>0){
        $arrayRate3PT = ($arrayRate3/$totalComment)*100;
    }
    $arrayRate2 = $comment_view['statisticalRating']['arrayRate'][2];
    if($arrayRate2>0){
        $arrayRate2PT = ($arrayRate2/$totalComment)*100;
    }
    $arrayRate1 = $comment_view['statisticalRating']['arrayRate'][1];
    if($arrayRate1>0){
        $arrayRate1PT = ($arrayRate1/$totalComment)*100;
    }
}
?>

<div class="danhgia content-detail-course" id="danhgia">
    <div class="">
        <h2 class="title-primary1">Đánh giá</h2>
        <div class="contant-danhgia">
            <div class="star-box">
                <aside class="rating-left">
                    <div class="item1">
                        <div class="star-average">
                            <h3 class="title1">Đánh giá trung bình</h3>
                            <p class="so-danhgia"><?php echo $averagePoint?>/5</p>
                            <p class="start" style="margin: 0px">

                                <span class="rating lStar" disabled data-stars="5"  data-default-rating="<?php echo $averagePoint?>" data-rating="<?php echo $averagePoint?>"></span>

                            </p>
                            <p class="nhanxet">(<?php echo $totalComment?> nhận xét)</p>
                        </div>
                    </div>
                    <div class="item2">
                        <div class="star-line ">
                            <span class="star-type left">5 <i class="fas fa-star"></i></span>

                            <div class="star-bar" data-percent="0%">
                                <div class="star-barsub" style="width: <?php echo $arrayRate5PT?>%; "></div>
                            </div>
                            <span class="star-type right "><b> <?php echo $arrayRate5PT?>%</b> | <?php echo $arrayRate5?> đánh giá</span>
                        </div>
                        <div class="star-line ">
                            <span class="star-type left">4 <i class="fas fa-star"></i></span>

                            <div class="star-bar" data-percent="8%">
                                <div class="star-barsub" style="width: <?php echo $arrayRate4PT?>%;"></div>
                            </div>
                            <span class="star-type right "><b><?php echo $arrayRate4PT?>%</b> | <?php echo $arrayRate4?> đánh giá</span>
                        </div>
                        <div class="star-line ">
                            <span class="star-type left">3 <i class="fas fa-star"></i></span>

                            <div class="star-bar" data-percent="0%">
                                <div class="star-barsub" style="width: <?php echo $arrayRate3PT?>%; "></div>
                            </div>
                            <span class="star-type right "><b><?php echo $arrayRate3PT?>%</b> | <?php echo $arrayRate3?> đánh giá</span>
                        </div>
                        <div class="star-line ">
                            <span class="star-type left">2 <i class="fas fa-star"></i></span>

                            <div class="star-bar" data-percent="0%">
                                <div class="star-barsub" style="width: <?php echo $arrayRate2PT?>%; "></div>
                            </div>
                            <span class="star-type right "><b><?php echo $arrayRate2PT?>%</b> | <?php echo $arrayRate2?> đánh giá</span>
                        </div>
                        <div class="star-line ">
                            <span class="star-type left">1 <i class="fas fa-star"></i></span>

                            <div class="star-bar" data-percent="0%">
                                <div class="star-barsub" style="width: <?php echo $arrayRate1PT?>%;"></div>
                            </div>
                            <span class="star-type right "><b><?php echo $arrayRate1PT?>%</b> | <?php echo $arrayRate1?> đánh giá</span>
                        </div>
                    </div>

                </aside>
            </div>

        </div>
        <div class="clearfix"></div>
        <div class="comment-list js_list_comment">
        </div>
        <div class="js_list_pagination">
        </div>
    </div>

</div>




