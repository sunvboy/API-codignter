

<?php

$row = $this->Autoload_Model->_get_where(array(
    'select' => 'map_hdfMap',
    'table' => 'customer_config',
    'where' => array('id' => 1)
));

if ($this->fcSystem['homepage_company'] != '') {
    $map_title = '<div class="map_title"><b>' . $this->fcSystem['homepage_company'] . '</b></div>';
}else{
    $map_title = '';
}
if ($this->fcSystem['contact_address'] != '') {
    $map_adrdress = '<div><b>Địa chỉ: </b>' . $this->fcSystem['contact_address'] . '</div>';
}else{
    $map_adrdress = '';
}

if ($this->fcSystem['contact_phone'] != '') {
    $map_phone = '<div><b>Điện thoại: </b>' . $this->fcSystem['contact_phone'] . '</div>';
}else{
    $map_phone = '';
}
$hien_map = "'" . $map_title . '' . $map_adrdress . '' . $map_phone . "'";
?>
<div class="box_map">
    <div class="map_site">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPglsw89c3aL05-qtpdfIhvbpkvcnCDrE&ver=4.7.3"></script>
        <script type="text/javascript">
            var map;
            var infowindow;
            var marker = new Array();
            var old_id = 0;
            var infoWindowArray = new Array();
            var infowindow_array = new Array();

            function initialize() {
                var defaultLatLng = new google.maps.LatLng<?php echo $row['map_hdfMap'];?>;
                var myOptions = {
                    zoom: 15,
                    center: defaultLatLng,
                    scrollwheel: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                map.setCenter(defaultLatLng);
                var arrLatLng = new google.maps.LatLng<?php echo $row['map_hdfMap'];?>;
                infoWindowArray[10349] =<?php echo $hien_map;?>;
                loadMarker(arrLatLng, infoWindowArray[10349], 10349);
                moveToMaker(10349);
            }
            function loadMarker(myLocation, myInfoWindow, id) {
                marker[id] = new google.maps.Marker({position: myLocation, map: map, visible: true});
                var popup = myInfoWindow;
                infowindow_array[id] = new google.maps.InfoWindow({content: popup});
                google.maps.event.addListener(marker[id], 'mouseover', function () {
                    if (id == old_id) return;
                    if (old_id > 0) infowindow_array[old_id].close();
                    infowindow_array[id].open(map, marker[id]);
                    old_id = id;
                });
                google.maps.event.addListener(infowindow_array[id], 'closeclick', function () {
                    old_id = 0;
                });
            }

            function moveToMaker(id) {
                var location = marker[id].position;
                map.setCenter(location);
                if (old_id > 0) infowindow_array[old_id].close();
                infowindow_array[id].open(map, marker[id]);
                old_id = id;
            }
        </script>
        <style type="text/css">
            body {
                margin: 0;
                padding: 0;
            }
        </style>
        <body onLoad="initialize()" onUnload="GUnload()">
        <div id="map_canvas" style="width:100%; height: 470px;"></div>
    </div>

</div>