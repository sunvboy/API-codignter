<?php
$dropdown = dropdown(array(
    'select' => 'id,keyword',
    'query' => array('publish' => 1,'trash' => 0),
    'table' => 'functions',
    'order_by' => 'id asc',
    'text' => '',
    'field' => 'id',
    'value' => 'keyword'
));
?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header text-center" >
                <div class="dropdown profile-element">
                    <img alt="image" class="img-circle" style="height:50px;" src="<?php echo (!empty($this->auth['avatar'])) ? $this->auth['avatar'] : 'template/not-found.png' ?>"/>				</span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs"><strong class="font-bold" style="color:#fff;font-weight:500;"><?php echo $this->auth['fullname']; ?></strong></span>
                            <span class="text-muted text-xs block"><?php echo $this->auth['catalogue']; ?> <b style="color:#8095a8;" class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="<?php echo site_url('user/backend/account/profile'); ?>">Hồ sõ cá nhân</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('user/backend/auth/logout'); ?>">Ðăng xuất</a></li>
                    </ul>
                </div>
                <div class="logo-element"> OVN+</div>
            </li>
            <li class="landing_link">
                <a href="<?php echo base_url('sadmin'); ?>">
                    <i class="fa fa-star"></i> <span class="nav-label">Dashboard</span>
                    <span class="label label-warning pull-right">NEW</span>
                </a>
            </li>

            <?php if(in_array('bill/backend/bill/view', json_decode($this->auth['permission'],TRUE)) && in_array('bill', $dropdown)){ ?>

             <li class="<?php echo ($this->router->module == 'bill') ? 'active' : '' ?>">
                 <a href="<?php echo site_url('bill/backend/bill/view'); ?>"><i class="fa fa-truck"></i> <span class="nav-label"> Quản lý hóa đơn</span></a>
             </li>
            <?php } ?>

            <?php if(in_array('customer/backend/customer/view', json_decode($this->auth['permission'],TRUE)) && in_array('customer', $dropdown)){ ?>
            <li class="<?php echo ($this->router->module == 'customer') ? 'active' : '' ?>">
                <a href="<?php echo site_url('customer/backend/customer/view'); ?>"><i class="fa fa-users"></i><span class="nav-label"> Quản lý khách hàng</span><span class="fa arrow"></span></span></a>

                <ul class="nav nav-second-level">
                   <li> <a href="<?php echo site_url('customer/backend/catalogue/view'); ?>">Quản lý nhóm khách hàng</a></li>
                   <li> <a href="<?php echo site_url('customer/backend/customer/view'); ?>">Quản lý khách hàng</a></li>
                    <?php if(in_array('customer/backend/customer/config', json_decode($this->auth['permission'],TRUE))){ ?>
                        <li> <a href="<?php echo site_url('customer/backend/customer/config'); ?>">Cấu hình</a></li>
                    <?php }?>

                </ul>
            </li>
            <?php } ?>


            <?php if(in_array('order/backend/order/view', json_decode($this->auth['permission'],TRUE)) && in_array('order', $dropdown)){ ?>

             <li class="<?php echo ($this->router->module == 'ship' || $this->router->module == 'supplier' || $this->router->module == 'customer' || $this->router->module == 'order' || $this->router->module == 'import') ? 'active' : '' ?>">
                 <a href="<?php echo site_url('supplier/backend/supplier/view'); ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i><span class="nav-label">Quản lý Bán hàng</span>
                     <span class="fa arrow"></span>
                 </a>
                 <ul class="nav nav-second-level">
                     <li><a href="<?php echo site_url('order/backend/order/view') ?>">QL Đơn hàng</a></li>
                     <?php if(in_array('ship/backend/ship/view', json_decode($this->auth['permission'],TRUE)) && in_array('ship', $dropdown)){ ?>
                         <li class="<?php echo ($this->router->module == 'ship' ) ? 'active' : '' ?>">
                             <a href="<?php echo site_url('ship/backend/ship/view'); ?>"><span class="nav-label"> QL phí ship</span></a>
                         </li>
                     <?php } ?>
                 </ul>
             </li>
            <?php } ?>
            <?php if(in_array('attribute/backend/attribute/view', json_decode($this->auth['permission'],TRUE)) && in_array('attribute', $dropdown)){ ?>
                <li class="<?php echo ($this->router->module == 'attribute') ? 'active' : '' ?>">
                    <a href="#"><i class="fa fa-diamond" aria-hidden="true"></i> <span class="nav-label"> Quản lý Thuộc tính</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="<?php echo site_url('attribute/backend/catalogue/view'); ?>">QL Loại thuộc tính </a></li>
                        <li><a href="<?php echo site_url('attribute/backend/attribute/view'); ?>">QL Thuộc tính</a></li>
                    </ul>
                </li>
            <?php } ?>
            <?php if(in_array('product/backend/product/view', json_decode($this->auth['permission'],TRUE)) && in_array('product', $dropdown)){ ?>
            <li class="<?php echo ($this->router->module == 'product' || $this->router->module == 'promotional') ? 'active' : '' ?>">
                 <a href="#"><i class="fa fa-diamond" aria-hidden="true"></i> <span class="nav-label"> Quản lý sản phẩm</span><span class="fa arrow"></span></a>
                 <ul class="nav nav-second-level collapse">
                     <li><a href="<?php echo site_url('product/backend/catalogue/view'); ?>">QL Loại sản phẩm</a></li>
                     <li><a href="<?php echo site_url('product/backend/product/view'); ?>">QL Sản phẩm</a></li>
                     <?php if(in_array('product/backend/brand/view', json_decode($this->auth['permission'],TRUE)) && in_array('brand', $dropdown)){ ?>

                     <li><a href="<?php echo site_url('product/backend/brand/view'); ?>">QL Thương hiệu</a></li>
                     <?php }?>


                     <?php if(in_array('promotional/backend/promotional/view', json_decode($this->auth['permission'],TRUE)) && in_array('promotional', $dropdown)){ ?>
                     <li><a href="<?php echo site_url('promotional/backend/promotional/view'); ?>">QL Khuyến mại</a></li>
                     <?php }?>
                 </ul>
             </li>
            <?php } ?>
            <?php if(in_array('tour/backend/tour/view', json_decode($this->auth['permission'],TRUE)) && in_array('tour', $dropdown)){ ?>

                <li class="<?php echo ($this->router->module == 'tour') ? 'active' : '' ?>">
                    <a href="#"><i class="fa fa-diamond" aria-hidden="true"></i> <span class="nav-label"> Quản lý tour</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="<?php echo site_url('tour/backend/catalogue/view'); ?>">QL Loại tour</a></li>
                        <li><a href="<?php echo site_url('tour/backend/tour/view'); ?>">QL tour</a></li>
                        <li><a href="<?php echo site_url('tour/backend/acatalogue/view'); ?>">Loại thuộc tính tour</a></li>
                        <li><a href="<?php echo site_url('tour/backend/attribute/view'); ?>">Thuộc tính tour</a></li>
                        <li><a href="<?php echo site_url('tour/backend/tour/order'); ?>">Order tour</a></li>

                    </ul>
                </li>
            <?php } ?>



            <?php if(in_array('article/backend/article/view', json_decode($this->auth['permission'],TRUE)) && in_array('article', $dropdown)){ ?>

            <li class="<?php echo ($this->router->module == 'article') ? 'active' : '' ?>">
                <a href="#"><i class="fa fa-edit"></i> <span class="nav-label"> Quản lý bài viết</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo site_url('article/backend/catalogue/view'); ?>">Nhóm bài viết</a></li>
                    <li><a href="<?php echo site_url('article/backend/article/view'); ?>">Bài viết</a></li>
                </ul>
            </li>
            <?php } ?>
            <?php if(in_array('page/backend/page/view', json_decode($this->auth['permission'],TRUE)) && in_array('page', $dropdown)){ ?>

                <li class="<?php echo ($this->router->module == 'page') ? 'active' : '' ?>">
                 <a href="#"><i class="fa fa-edit"></i> <span class="nav-label"> Quản lý nội dung</span><span class="fa arrow"></span></a>
                 <ul class="nav nav-second-level collapse">
                     <li><a href="<?php echo site_url('page/backend/catalogue/view'); ?>">Nhóm Nội dung</a></li>
                     <li><a href="<?php echo site_url('page/backend/page/view'); ?>">Chi tiết</a></li>
                 </ul>
             </li>
            <?php } ?>
            <?php if(in_array('media/backend/media/view', json_decode($this->auth['permission'],TRUE)) && in_array('media', $dropdown)){ ?>

            <li class="<?php echo ($this->router->module == 'media') ? 'active' : '' ?>">
                 <a href="#"><i class="fa fa-camera-retro"></i> <span class="nav-label"> Quản lý thư viện</span><span class="fa arrow"></span></a>
                 <ul class="nav nav-second-level collapse">
                     <li><a href="<?php echo site_url('media/backend/catalogue/view'); ?>">Nhóm thư viện</a></li>
                     <li><a href="<?php echo site_url('media/backend/media/view'); ?>">Thư viện</a></li>
                 </ul>
             </li>
            <?php } ?>
            <?php if(in_array('support/backend/support/view', json_decode($this->auth['permission'],TRUE)) && in_array('support', $dropdown)){ ?>

            <li class="<?php echo ($this->router->module == 'support') ? 'active' : '' ?>">
                 <a href="#"><i class="fa fa-users"></i><span class="nav-label">Hỗ trợ trực tuyến</span><span class="fa arrow"></span></a>
                 <ul class="nav nav-second-level collapse">
                     <li><a href="<?php echo site_url('support/backend/catalogue/view'); ?>">Nhóm hỗ trợ</a></li>
                     <li><a href="<?php echo site_url('support/backend/support/view'); ?>">Chi tiết hỗ trợ</a></li>
                 </ul>
             </li>
            <?php } ?>
            <?php if(in_array('comment/backend/comment/view', json_decode($this->auth['permission'],TRUE)) && in_array('comment', $dropdown)){ ?>

                <li class="<?php echo ($this->router->module == 'comment') ? 'active' : '' ?>">
                 <a href="<?php echo site_url('comment/backend/comment/view'); ?>"><i class="fa fa-comments"></i> <span class="nav-label"> Quản lý comment</span></a>
             </li>
            <?php } ?>
            <?php if(in_array('contact/backend/contact/view', json_decode($this->auth['permission'],TRUE)) && in_array('contact', $dropdown)){ ?>

                <li class="<?php echo ($this->router->module == 'contact') ? 'active' : '' ?>">
                 <a href="#"><i class="fa fa-envelope"></i><span class="nav-label">Liên Hệ</span><span class="fa arrow"></span></a>
                 <ul class="nav nav-second-level collapse">
                     <li><a href="<?php echo site_url('contact/backend/catalogue/view'); ?>">Nhóm liên hệ</a></li>
                     <li><a href="<?php echo site_url('contact/backend/contact/view'); ?>">Danh sách liên hệ</a></li>
                     <li class=""><a href="<?php echo site_url('contact/backend/contact/mailsubricre'); ?>">Danh sách đăng ký tư vấn</a></li>
                 </ul>
             </li>
            <?php } ?>

            <li class="<?php echo ($this->router->module == 'general' || $this->router->module == 'tag') ? 'active' : '' ?> <?php echo ($this->router->module == 'navigation') ? 'active' : '' ?> <?php echo ($this->router->module == 'layout') ? 'active' : '' ?>">
                <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">Cấu hình chung</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                     <li><a href="<?php echo site_url('layout/backend/layout/refreshSidemap'); ?>">Cập nhật SiteMap</a></li>
                    <li class="hidden"><a href="<?php echo site_url('layout/backend/layout/view'); ?>">Quản lý giao diện</a></li>
                    <?php if(in_array('general/backend/slide/view', json_decode($this->auth['permission'],TRUE)) && in_array('slide', $dropdown)){ ?>

                    <li><a href="<?php echo site_url('general/backend/slide/view'); ?>">Banner & Slide</a></li>
                    <?php }?>
                    <?php if(in_array('general/backend/general/view', json_decode($this->auth['permission'],TRUE)) && in_array('general', $dropdown)){ ?>

                    <li><a href="<?php echo site_url('general/backend/general/view'); ?>">Cấu hình chung</a></li>
                    <li><a href="<?php echo site_url('general/backend/maps/view'); ?>">Bản đồ</a></li>
                    <?php }?>
                    <?php if(in_array('navigation/backend/navigation/view', json_decode($this->auth['permission'],TRUE)) && in_array('navigation', $dropdown)){ ?>

                    <li><a href="<?php echo site_url('navigation/backend/navigation/view'); ?>">Cài đặt Menu</a></li>
                    <?php }?>
                    <?php if(in_array('tag/backend/tag/view', json_decode($this->auth['permission'],TRUE)) && in_array('tag', $dropdown)){ ?>

                        <li><a href="<?php echo site_url('tag/backend/tag/view'); ?>">Quản lý Tag</a></li>
                    <?php }?>

                    <?php  if(in_array('functions/backend/functions/view', json_decode($this->auth['permission'],TRUE)) && in_array('functions', $dropdown) && $this->auth['id']==4){ ?>

                    <li class=""><a href="<?php echo site_url('functions/backend/functions/view');?>">Modules</a></li>
                    <?php }?>
                </ul>
            </li>
            <?php if(in_array('user/backend/user/view', json_decode($this->auth['permission'],TRUE)) && in_array('user', $dropdown)){ ?>

            <li class="<?php echo ($this->router->module == 'user') ? 'active' : '' ?>">
                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Thành viên</span><span  class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo site_url('user/backend/catalogue/view'); ?>">Nhóm thành viên</a></li>
                    <li><a href="<?php echo site_url('user/backend/user/view'); ?>">Thành viên</a></li>
                </ul>
            </li>
            <?php }?>
             <li class="landing_link">
                 <a target="_blank" href="<?php echo BASE_URL; ?>"><i class="fa fa-star"></i> <span class="nav-label">Xem Website</span> <span class="label label-warning pull-right">NEW</span></a>
             </li>
    </div>
</nav>