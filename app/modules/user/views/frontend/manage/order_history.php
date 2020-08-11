<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url()?>"><i class="fa fa-home"></i></a></li>
        <li><a href="javascript:void(0)">Lịch sử mua hàng</a></li>
    </ul>

    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
            <h2 class="title">Lịch sử mua hàng</h2>
            <?php if(isset($listorder) && is_array($listorder) && count($listorder)){ ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <td class="text-center">STT</td>
                        <td class="text-center">Số lượng</td>
                        <td class="text-center">Trạng thái</td>
                        <td class="text-center">Ngày đặt</td>
                        <td class="text-right">Tổng tiền</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($listorder as $key => $val){ ?>

                    <tr>

                        <td class="text-center"><?php echo $key+1?></td>
                        <td class="text-center"><?php echo $val['quantity']?></td>
                        <td class="text-center"><?php echo $this->configbie->data('state_order', $val['status']) ?></td>
                        <td class="text-center"><?php echo gettime($val['created'],'d-m-Y H:s:i')  ?></td>
                        <td class="text-right"><?php echo addCommas($val['total_cart_final'])  ?> đ</td>
                        <td class="text-center"><a class="btn btn-info js_open_windown" title="" data-toggle="tooltip" href="order-information.html?id=<?php echo $val['id']?>" data-original-title="View"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    <?php }?>

                    </tbody>
                </table>
            </div>
                <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
            <?php }?>
        </div>
        <!--Middle Part End-->
        <!--Right Part Start -->
        <?php echo $this->load->view('user/frontend/manage/aside')?>
    </div>
</div>
<?php /*?>
<script>
    $('.js_open_windown').click(function(){
        let h = screen.availHeight;
        let w = screen.availWidth;
        window.open(this.href, 'chorme', 'top='+h*10/100+', left='+w*10/100+', width='+w*80/100+',height='+h*80/100);
        return false;
    });
</script>
 <?php */?>