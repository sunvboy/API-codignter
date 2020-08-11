<?php $main_nav = navigation(array('keyword' => 'footer', 'output' => 'array'), $this->fc_lang); ?>
<?php if (isset($main_nav) && is_array($main_nav) && count($main_nav)) { ?>
    <?php foreach ($main_nav as $key => $val) { ?>
        <?php if (isset($val['children']) && is_array($val['children']) && count($val['children'])) { if($key==0){?>
            <div class="col-md-3 col-xs-12 col-sm-6 footer_top">
                <h4 class="mkdf-widget-title"><?php echo $val['title']; ?></h4>

                <div class="clearfix"></div>

                <div class="textwidget">
                    <ul>

                        <?php foreach ($val['children'] as $keyItem => $valItem) { ?>
                            <li><a href="<?php echo $valItem['link'] ?>"><?php echo $valItem['title'] ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="clearfix"></div>
                <div class="block-icon mt20">
                    <a href="<?php echo $this->fcSystem['banner_banner1_link']?>"><img src="<?php echo $this->fcSystem['banner_banner1']?>" alt="ios"></a>&nbsp;&nbsp;
                    <a href="<?php echo base_url()?>"><img alt="<?php echo $this->fcSystem['homepage_company']?>" src="<?php echo $this->fcSystem['homepage_logofooter']?>" width="171"/></a>

                </div>
            </div>




        <?php } ?>
        <?php } ?>

    <?php } ?>
<?php } ?>

