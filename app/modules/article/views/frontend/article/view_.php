<div id="main" class="wrapper">

    <div class="banner-child">
        <img style="height: 200px;object-fit: cover;" src="<?php echo $detailArticle['image']; ?>" alt="<?php echo $detailArticle['title']; ?>">
    </div>

    <div class="main-new-detail">
        <div class="container">
            <h1><?php echo $detailArticle['title']; ?></h1>
            <p class="date">Ngày đăng: <?php echo $detailArticle['created']; ?></p>
            <div class="content-new-detail">
                <?php echo $detailArticle['description']; ?>
                <div style="clear: both;height: 20px;"></div>
                <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                    <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                    <a class="a2a_button_facebook"></a>
                    <a class="a2a_button_twitter"></a>
                    <a class="a2a_button_google_plus"></a>
                    <a class="a2a_button_skype"></a>
                </div>
                <script async src="https://static.addtoany.com/menu/page.js"></script>
                <div style="clear: both;height: 20px;"></div>
                <div style="margin: 0px -8px">
                    <div class="fb-comments" data-href="<?php echo $canonical?>" data-numposts="20" data-width="1140"></div>
                </div>
                <style>
                    .content-new-detail img {
                        max-width: 100% !important;
                        height: auto !important;
                    }
                </style>
                <div class="clearfix"></div>
                <h2 style="font-family: 'Roboto-Bold';font-size: 22px;">Bài viết cùng chuyên mục</h2>
                <ul class="ttm-list">
                    <?php foreach ($articles_same as $keyP => $valP) {
                        $href = rewrite_url($valP['canonical'], true, true); ?>
                        <li><a href="<?php echo $href ?>"><i class="fa fa-check"></i><span class="ttm-list-li-content"><?php echo $valP['title'] ?></span></a></li>
                    <?php } ?>

                </ul>
            </div>

        </div>
    </div>


</div>
<style>
    .ttm-list{
        list-style: none;
        padding: 0px;
        margin: 0px;
    }
    .ttm-list-li-content{
        padding-left: 5px;
    }
</style>

