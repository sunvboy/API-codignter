
<div class="col-md-3 col-sm-3 col-xs-12">
    <div class="sidebar-left">
        <div class="avarta">
            <img src="<?php echo $this->FT_auth['images']?>" alt="<?php echo $this->FT_auth['fullname']?>">
        </div>
        <h3 class="title"><?php echo $this->FT_auth['fullname']?></h3>
        <p class="date">Ngày tham gia: <?php echo $this->FT_auth['created']?></p>

        <div class="list-link ">
            <ul class="acc__card">
                <li class="litaikhoan">
                    <a class="acc__title">TÀI KHOẢN CỦA TÔI</a>
                    <ul class="acc__panel">
                        <li>
                            <a href="<?php echo site_url('information'); ?>">Thông tin tài khoản</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('change-pass'); ?>">Đổi mật khẩu</a>
                        </li>
                        <?php /* if($this->FT_auth['catalogueid']==1){?>
                        <li>
                            <a href="<?php echo site_url('information-shop'); ?>">Hồ sơ shop</a>
                        </li>
                        <?php }*/?>
                    </ul>
                </li>
                <?php if($this->FT_auth['catalogueid']==1){?>
                <li class="lisanpham">
                    <a class="acc__title">QUẢN LÝ SẢN PHẨM</a>
                    <ul class="acc__panel">
                        <li>
                            <a href="<?php echo site_url('list-product'); ?>">Tất cả sản phẩm</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('create-product'); ?>">Thêm sản phẩm</a>
                        </li>

                    </ul>
                </li>
                <?php }?>

            </ul>

        </div>
    </div>
    <div class="dangxuat">
        <a href="logout.html">Đăng xuất <img src="template/frontend/images/icon8.png" alt=""></a>
    </div>
</div>

