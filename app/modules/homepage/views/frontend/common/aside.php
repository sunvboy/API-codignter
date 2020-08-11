<div class="col-md-3 col-xs-12 col-sm-3">
    <?php

    $dropdown = $this->Autoload_Model->_get_where(array('table' => 'product_catalogue', 'select' => 'id, title,canonical', 'order_by' => 'order ASC,id DESC', 'limit' => 1000, 'where' => array('isaside' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
    ?>
    <?php if (isset($dropdown) && is_array($dropdown) && count($dropdown)) { ?>

    <div class="black-studio-tinymce-6">
        <span class="widget-title ">DANH MỤC THIẾT KẾ</span>
        <div class="textwidget">
            <ul class="right-menu">
                <?php foreach ($dropdown as $key => $val) {
                $href = rewrite_url($val['canonical'], TRUE, TRUE); ?>

                <li><a href="<?php echo $href?>"><?php echo $val['title']?></a></li>
                <?php }?>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php }?>

    <?php
    $publish_time = gmdate('Y-m-d H:i:s', time() + 7 * 3600);

    if (!$product_catalog_ishome_aside = $this->cache->get('product_catalog_ishome_aside')) {
        $product_catalog_ishome_aside = $this->Autoload_Model->_get_where(array(
            'select' => 'id, title, canonical',
            'table' => 'product_catalogue',
            'limit' => 1,
            'where' => array('ishome' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
        if (isset($product_catalog_ishome_aside) && is_array($product_catalog_ishome_aside) && count($product_catalog_ishome_aside)) {
            foreach ($product_catalog_ishome_aside as $key => $val) {

                $product_catalog_ishome_aside[$key]['post'] = $this->Autoload_Model->_condition(array(
                    'module' => 'product',
                    'select' => '`object`.`id`, `object`.`catalogueid`, `object`.`title`, `object`.`slug`, `object`.`canonical`, `object`.`image`, `object`.`created`',
                    'where' => '`object`.`publish_time` <= \'' . $publish_time . '\' AND `object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\'',
                    'catalogueid' => $val['id'],
                    'limit' => 5,
                    'order_by' => '`object`.`order` asc, `object`.`id` asc',
                ));
            }
        }

        $this->cache->save('product_catalog_ishome', $product_catalog_ishome_aside, 200);
    } else {
        $product_catalog_ishome_aside = $product_catalog_ishome_aside;
    }
    ?>
    <?php if (isset($product_catalog_ishome_aside) && is_array($product_catalog_ishome_aside) && count($product_catalog_ishome_aside)) { ?>
        <?php foreach ($product_catalog_ishome_aside as $key => $val) {
            $href = rewrite_url($val['canonical'], TRUE, TRUE); ?>
            <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                <aside class="widget">
                    <span class="widget-title widget-title-right "><?php echo $val['title'] ?></span>
                    <?php foreach ($val['post'] as $keyP => $valP) {
                        $hrefP = rewrite_url($valP['canonical'], TRUE, TRUE);
                        ?>
                        <div class="list-category-news">
                            <div class="category-news-images">
                                <a href="<?php echo $hrefP ?>">
                                    <img class="img-responsive" src="<?php echo $valP['image'] ?>"
                                         alt="<?php echo $valP['title'] ?>">
                                </a>
                            </div>
                            <h5 class="tcnews">
                                <a href="<?php echo $hrefP ?>"><?php echo $valP['title'] ?></a>
                            </h5>
                        </div>
                    <?php } ?>

                </aside>
                <div class="clearfix"></div>
            <?php } ?>
        <?php } ?>
    <?php } ?>

    <?php
    if (!$tintuc_aside = $this->cache->get('tintuc_aside')) {
        $tintuc_aside = $this->Autoload_Model->_get_where(array(
            'select' => 'id, title,canonical,description',
            'table' => 'article_catalogue',
            'where' => array('ishome' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
        if (isset($tintuc_aside) && is_array($tintuc_aside) && count($tintuc_aside)) {
            foreach ($tintuc_aside as $key => $val) {
                $tintuc_aside[$key]['post'] = $this->Autoload_Model->_condition(array(
                    'module' => 'article',
                    'select' => '`object`.`id`, `object`.`title`, `object`.`image`, `object`.`canonical`, `object`.`description`, `object`.`created`, `object`.`viewed`',
                    'where' => '`object`.`publish_time` <= \'' . $publish_time . '\' AND `object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\' ',
                    'catalogueid' => $val['id'],
                    'limit' => 3,
                    'order_by' => '`object`.`order` asc, `object`.`id` desc',
                ));
            }
        }
        $this->cache->save('tintuc', $tintuc_aside, 200);
    } else {
        $tintuc_aside = $tintuc_aside;
    }

    ?>
    <?php if (isset($tintuc_aside) && is_array($tintuc_aside) && count($tintuc_aside)) { ?>
        <?php foreach ($tintuc_aside as $key => $val) {
            $hrefT = rewrite_url($val['canonical'], true, true); ?>
            <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                <aside class="widget">
                    <span class="widget-title widget-title-right "><?php echo $val['title'] ?></span>
                <?php foreach ($val['post'] as $keyP => $valP) {
                    $href = rewrite_url($valP['canonical'], true, true); ?>

                    <div class="list-category-news">
                        <div class="category-news-images">
                            <a href="<?php echo $href ?>">
                                <img class="img-responsive"
                                     src="<?php echo $valP['image'] ?>"
                                     alt="<?php echo $valP['title'] ?>">
                            </a>
                        </div>
                        <h5 class="tcnews">
                            <a href="<?php echo $href ?>"><?php echo $valP['title'] ?></a>
                        </h5>
                    </div>
                <?php } ?>
                </aside>
            <?php } ?>
        <?php } ?>
    <?php } ?>

</div>

