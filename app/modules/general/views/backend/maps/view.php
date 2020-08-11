<link type="text/css" href="template/backend/maps/map_css.css" rel="stylesheet">
<link type="text/css" href="template/backend/maps/jqueryui.css" rel="stylesheet">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPglsw89c3aL05-qtpdfIhvbpkvcnCDrE&ver=4.7.3"></script>
<div id="page-wrapper" class="gray-bg dashbard-1 fix-wrapper">
    <div class="row border-bottom">
        <?php $this->load->view('dashboard/backend/common/navbar'); ?>
    </div>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Tìm kiếm địa chỉ</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo site_url('admin'); ?>">Home</a>
                </li>
                <li class="active"><strong>Tìm kiếm địa chỉ</strong></li>
            </ol>
        </div>
    </div>

    <form method="post" action="" class="form-horizontal box">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="box-body">
                </div><!-- /.box-body -->
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="panel-head">
                        <h2 class="panel-title">Tìm kiếm</h2>

                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="ibox m0">
                        <div class="ibox-content">
                            <div class="row mb15">
                                <div class="col-lg-12" style="margin-bottom: 20px">
                                    <div class="form-row">
                                        <label class="control-label text-left">
                                            <span>Nhập địa chỉ tìm <b class="text-danger">(*)</b></span>
                                        </label>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input id="address" type="text" size="50" onfocus="if (this.value == 'Vui lòng nhập địa chỉ để tìm kiếm trên bản đồ!') {this.value = '';} " onblur="if(this.value == ''){this.value = 'Vui lòng nhập địa chỉ để tìm kiếm trên bản đồ!';}" class="form-control input-sm" name="map_search_address" value="<?php echo $row['map_search_address'];?>">

                                            </div>
                                            <div class="col-md-2">
                                                <input value="Tìm địa chỉ" onclick="codeAddress()" class="btn btn-success btn-xs" type="button" style="height: 32px;width: 100%">

                                            </div>
                                            <div style="clear: both;height: 20px"></div>
                                            <div class="col-md-12">

                                                <div style="position: relative; background-color: rgb(229, 227, 223); overflow: hidden;width: 100%" class="main_mapsmall" id="map_canvas_detail"></div>
                                                <input name="hdfInfo" id="hdfInfo" type="hidden">
                                                <input name="hdfMap" id="hdfMap" type="hidden"  value="<?php echo $row['map_hdfMap'];?>" >
                                            </div>

                                        </div>


                                    </div>
                                </div>

                            </div>
                            <div class="toolbox action clearfix">
                                <div class="uk-flex uk-flex-middle uk-button pull-right">
                                    <button class="btn btn-primary btn-sm" name="update" value="create" type="submit">Cập nhập</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <hr>

        </div>
    </form>
    <?php
    if($row['map_hdfMap'] == ''){
        $bien = '(21.0287281, 105.8073548)';
    }else{
        $bien = $row['map_hdfMap'];
    }
    ?>

    <script type="text/javascript">

        function setDesc(input) {
            //alert(input.value);
            $("#hdfInfo").val(input.value);
        }
        function getDesc() {
            //alert(input.value);
            $("#infoMap").val($("#hdfInfo").val());
        }
        function initialize() {
            geocoder = new google.maps.Geocoder();
            var myOptions = {
                zoom: 16,
                center: new google.maps.LatLng<?=$bien; ?>,
                disableDefaultUI: true,
                panControl: true,
                zoomControl: true,
                mapTypeControl: true,
                overviewMapControl: true,
                overviewMapControlOptions: { opened: true },
                MarkerOptions: { draggable: true },
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map_canvas_detail"),
                myOptions);
            google.maps.event.addListener(map, 'click', function (e) {
                initialize();
                map.setCenter(e.latLng);
                var marker = new google.maps.Marker({
                    map: map,
                    position: e.latLng,
                    draggable: true
                });
                $("#hdfMap").val(marker.position);
                google.maps.event.addListener(marker, "dragstart", function () {
                    getDesc();
                });
                google.maps.event.addListener(marker, "dragend", function () {
                    getDesc();
                    $("#hdfMap").val(marker.position);
                });
                google.maps.event.addListener(marker, "click", function () {
                    infowindow.open(map, marker);
                    getDesc();
                });
            });
        }

        function codeAddress() {
            initialize();
            var address = document.getElementById("address").value;
            geocoder.geocode({ 'address': address }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location,
                        draggable: true
                    });
                    $("#hdfMap").val(marker.position);
                    google.maps.event.addListener(marker, "dragstart", function () {
                        getDesc();
                    });
                    google.maps.event.addListener(marker, "dragend", function () {
                        getDesc();
                        $("#hdfMap").val(marker.position);
                    });
                    google.maps.event.addListener(marker, "click", function () {
                        infowindow.open(map, marker);
                        getDesc();
                    });
                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            });
        }

        $(document).ready(function () {
            initialize();
        });
    </script>



    <?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>
