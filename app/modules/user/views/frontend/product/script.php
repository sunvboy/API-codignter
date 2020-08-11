<link href="template/backend/css/customize.css" rel="stylesheet">
<script src="template/backend/js/plugins/iCheck/icheck.min.js"></script>
<link href="template/backend/css/plugins/iCheck/custom.css" rel="stylesheet">
<link href="template/backend/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

<script src="plugin/jquery-ui.js"></script>
<script src="template/backend/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="plugin/ckeditor-frontend/ckeditor.js" charset="utf-8"></script>
<script src="template/backend/library/editor-frontend.js"></script>
<script src="template/backend/library/product-frontend.js"></script>

<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
    $('.datetimepicker').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        minDate: 'today',
        dateFormat: "dd/mm/yy"
    });
</script>
<!--dropzone-->
<link href="template/dropzone/dropzone.css" rel="stylesheet" type="text/css">
<script src="template/dropzone/dropzone.js" type="text/javascript"></script>
<style>
    .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
        position: relative;
        min-height: 1px;
        padding-left: 6px !important;
        padding-right: 6px !important;
    }
    .row {
        margin-left: -6px !important;
        margin-right: -6px !important;
    }
    .dropzone.dz-clickable .dz-message, .dropzone.dz-clickable .dz-message *{
        color: #dddddd;
    }
    .fix-wrapper .wrapper-content {
        padding: 0px;
        margin: 0 auto;
        max-width: 100% !important;
    }

    .box .ibox {
        box-shadow: none;
    }

    .ibox-title h5 {
        font-weight: bold;
    }




    .m-b-sm {
        margin-bottom: 10px;
    }
    input.canonical{
        border-radius: 0px !important;
    }
    .form-control{
        height: auto !important;
        padding: 6px 12px !important;
    }
    .content{
        margin: 0 auto;
    }
    .content span{
        width: 250px;
    }

    .dz-message{
        text-align: center;
        font-size: 28px;
    }
    .dropzone.dz-clickable{
        padding: 0px;
    }
</style>