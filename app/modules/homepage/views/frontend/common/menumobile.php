<?php $mobile_nav = navigation(array('keyword' => 'main', 'output' => 'array'), $this->fc_lang); ?>
<?php if (isset($mobile_nav) && is_array($mobile_nav) && count($mobile_nav)) { ?>
    <div class="wrapper cf">
        <style>
            #main-nav {
                display: none;
            }
        </style>
        <nav id="main-nav">
            <ul class="second-nav">
                <?php foreach ($mobile_nav as $key => $val) { ?>
                    <li>
                        <a href="<?php echo $val['link']; ?>"><?php echo $val['title']; ?></a>
                        <?php if (isset($val['children']) && is_array($val['children']) && count($val['children'])) { ?>

                            <ul>
                                <?php foreach ($val['children'] as $keyItem => $valItem) { ?>

                                    <li>
                                        <a href="<?php echo $valItem['link'] ?>"><?php echo $valItem['title'] ?></a>
                                        <?php if (isset($valItem['children']) && is_array($valItem['children']) && count($valItem['children'])) { ?>

                                            <ul>
                                                <?php foreach ($valItem['children'] as $keyItemC => $valItemC) { ?>
                                                    <li>
                                                        <a href="<?php echo $valItemC['link'] ?>"><?php echo $valItemC['title'] ?></a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <a class="toggle">
            <span></span>
        </a>
    </div>
<?php } ?>
