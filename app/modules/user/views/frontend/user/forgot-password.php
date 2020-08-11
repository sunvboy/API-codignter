
<section class="login_html">
    <div style="float: left;width: 100%">
        <a href="<?php echo base_url() ?>">
            <div class="llXJ_e">
                <svg viewBox="0 0 22 17" class="_3E62R8">
                    <g stroke="none" stroke-width="1" fill-rule="evenodd" transform="translate(-3, -6)">
                        <path
                            d="M5.78416545,15.2727801 L12.9866648,21.7122915 C13.286114,22.0067577 13.286114,22.4841029 12.9866648,22.7785691 C12.6864297,23.0738103 12.200709,23.0738103 11.9004739,22.7785691 L3.29347136,15.0837018 C3.27067864,15.0651039 3.23845445,15.072853 3.21723364,15.0519304 C3.06240034,14.899273 2.99480814,14.7001208 3.00030983,14.5001937 C2.99480814,14.3002667 3.06240034,14.1003396 3.21723364,13.9476821 C3.23845445,13.9275344 3.2714646,13.9345086 3.29425732,13.9166857 L11.9004739,6.22026848 C12.200709,5.92657717 12.6864297,5.92657717 12.9866648,6.22026848 C13.286114,6.51628453 13.286114,6.99362977 12.9866648,7.288096 L5.78416545,13.7276073 L24.2140442,13.7276073 C24.6478918,13.7276073 25,14.0739926 25,14.5001937 C25,14.9263948 24.6478918,15.2727801 24.2140442,15.2727801 L5.78416545,15.2727801 Z"></path>
                    </g>
                </svg>
                <div class="_1SY8wo _3Dl9cs">
                    <div class="_3Oyd5A">Quên mật khẩu</div>
                </div>
            </div>
        </a>
    </div>
    <div class="clearfix"></div>

    <div class="container">
        <div class="col-xs-12">
            <form action="" method="post" id="contact_form">
                <div class="_1_eJU4">


                    <?php
                    $error = validation_errors();
                    echo (!empty($error) && isset($error)) ? '<div class="alert alert-danger">'.$error.'</div>' : '';
                    ?>
                    <div class="_3Pvd-b">
                        <?php echo form_email('email', set_value('email'), 'class="_1-SA_b _3dI7gM" placeholder="Email" autocomplete="off" required');?>
                    </div>

                    <button class="_1tmt6U _32y4MW" type="submit" name="forgot" value="forgot" id="submitform">Gửi</button>
                    <button class="_1tmt6U _32y4MW" type="button" id="gif"> Dữ liệu đang được xử lý...</button>

                    <div class="_2nvW8X">
                        <a class="_3n0iZ-" href="register.html">Đăng ký</a>
                        <a class="_3n0iZ-" href="login.html">Đăng nhập</a>
                    </div>
                    <?php /*?>
                    <div>
                        <div class="BbPG89">
                            <div class="SHdsU5"></div>
                            <div class="_1cUCzN">HOẶC</div>
                            <div class="SHdsU5"></div>
                        </div>
                        <button class="_38Hrnz _6BP28k _1WykyS">
                            <div class="_1eOOFz">
                                <div class="_fgasD social-white-background social-white-fb-png"></div>
                            </div>
                            <span class="_38JGYO">Tiếp tục với Facebook</span>
                        </button>
                        <button class="_38Hrnz _6BP28k _1WykyS">
                            <div class="_1eOOFz">
                                <div class="_fgasD social-white-background social-white-fb-png" style="background-position: 102.470588% 107.848485%;"></div>
                            </div>
                            <span class="_38JGYO">Tiếp tục với Google</span>
                        </button>
                    </div>
                    <?php */?>
                </div>
            </form>

        </div>

    </div>

</section>
<?php echo $this->load->view('user/frontend/user/script');?>
