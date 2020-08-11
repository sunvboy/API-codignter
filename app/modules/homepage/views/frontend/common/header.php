<header id="header_pc">
    <div class="container">
        <div class="row" id="flexmobile">
            <div class="col-md-3 col-sm-12 col-xs-12 showpro" style="position: relative;">
                <a href="<?php echo base_url()?>" class="logo"><img src="<?php echo $this->fcSystem['homepage_logo']?>" alt="<?php echo $this->fcSystem['homepage_company']?>"></a>

                <?php echo $this->load->view('homepage/frontend/common/menumobile') ?>

            </div>
            <div class="col-md-9 col-sm-9 hidden-xs hidden-sm hiddenpro">
                <nav id="nav">
                    <?php $mobile_nav = navigation(array('keyword' => 'main', 'output' => 'array'), $this->fc_lang); ?>
                    <?php if (isset($mobile_nav) && is_array($mobile_nav) && count($mobile_nav)) { ?>
                        <div class="main-menu">
                            <ul>
                                <?php foreach ($mobile_nav as $key => $val) { ?>
                                    <li >
                                        <a  href="<?php echo $val['link']; ?>"><?php echo $val['title']; ?></a>
                                        <?php if (isset($val['children']) && is_array($val['children']) && count($val['children'])) { ?>

                                            <ul class="cap_2">
                                                <?php foreach ($val['children'] as $keyItem => $valItem) { ?>

                                                    <li>
                                                        <a href="<?php echo $valItem['link'] ?>"><?php echo $valItem['title'] ?></a>

                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php }?>

                </nav>
            </div>
        </div>
    </div>
</header>
<div class="clearfix"></div>