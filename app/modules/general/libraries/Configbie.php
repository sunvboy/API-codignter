<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class ConfigBie{



    function __construct($params = NULL){

        $this->params = $params;

    }



    // meta_title là 1 row -> seo_meta_title

    // contact_address

    // chưa có thì insert

    // có thì update
    public function system(){
        $data['homepage'] =  array(
            'label' => 'Thông tin chung',
            'description' => 'Cài đặt đầy đủ thông tin chung của website. Tên thương hiệu website. Logo của website và icon website trên tab trình duyệt',
            'value' => array(
                'brandname' => array('type' => 'text', 'label' => 'Tên thương hiệu'),
                'company' => array('type' => 'text', 'label' => 'Tên công ty'),
                'logo' => array('type' => 'images', 'label' => 'Logo'),
                'logofooter' => array('type' => 'images', 'label' => 'Logo footer'),
                'favicon' => array('type' => 'images', 'label' => 'Favicon'),
//                'aboutus' => array('type' => 'editor', 'label' => 'Giới thiệu'),
                'copyright' => array('type' => 'text', 'label' => 'Copyright'),


            ),

        );

        $data['contact'] =  array(
            'label' => 'Thông tin liên lạc',
            'description' => 'Cấu hình đầy đủ thông tin liên hệ giúp khách hàng dễ dàng tiếp cận với dịch vụ của bạn',
            'value' => array(
                'address' => array('type' => 'text', 'label' => 'Địa chỉ'),
                'hotline' => array('type' => 'text', 'label' => 'Hotline'),
//                'phone' => array('type' => 'text', 'label' => 'Phone'),
                'email' => array('type' => 'text', 'label' => 'Email'),
                'website' => array('type' => 'text', 'label' => 'Website'),
                'map' => array('type' => 'textarea', 'label' => 'Bản đồ'),
            ),
        );
        $data['seo'] =  array(

            'label' => 'Cấu hình thẻ tiêu đề',

            'description' => 'Cài đặt đầy đủ Thẻ tiêu đề và thẻ mô tả giúp xác định cửa hàng của bạn xuất hiện trên công cụ tìm kiếm.',

            'value' => array(

                'meta_title' => array('type' => 'text', 'label' => 'Tiêu đề trang','extend' => ' trên 70 kí tự', 'class' => 'meta-title', 'id' => 'titleCount'),

                'meta_description' => array('type' => 'textarea', 'label' => 'Mô tả trang','extend' => ' trên 320 kí tự', 'class' => 'meta-description', 'id' => 'descriptionCount'),
//                'meta_images' => array('type' => 'images', 'label' => 'Ảnh'),

            ),

        );

        $data['social'] =  array(
            'label' => 'Cấu hình mạng xã hội',
            'description' => 'Cài đặt đầy đủ Thẻ tiêu đề và thẻ mô tả giúp xác định cửa hàng của bạn xuất hiện trên công cụ tìm kiếm.',
            'value' => array(
                'facebook' => array('type' => 'text', 'label' => 'Facebook'),
                'instagram' => array('type' => 'text', 'label' => 'Instagram'),
//                'twitter' => array('type' => 'text', 'label' => 'Twitter'),
//                'google_plus' => array('type' => 'text', 'label' => 'Google plus'),
//                'pinterest' => array('type' => 'text', 'label' => 'Pinterest'),
                'youtube' => array('type' => 'text', 'label' => 'Youtube'),
//                'linkedin' => array('type' => 'text', 'label' => 'Linkedin'),
//                'skype' => array('type' => 'text', 'label' => 'Skype'),
//                'zalo' => array('type' => 'text', 'label' => 'Số zalo'),
            ),
        );

        $data['title'] =  array(

            'label' => 'Tiêu đề',

            'description' => '',

            'value' => array(

                'chinhanh' => array('type' => 'text', 'label' => 'Chi nhánh'),
                'title1' => array('type' => 'text', 'label' => 'Học ở đây.'),
                'title2' => array('type' => 'text', 'label' => 'Graduate anywhere.'),
                'title3' => array('type' => 'text', 'label' => 'Bạn quan tâm?'),
                'title4' => array('type' => 'textarea', 'label' => 'Description Bạn quan tâm?'),


            ),

        );
         $data['banner'] =  array(

            'label' => 'Banner',

            'description' => '',

            'value' => array(

                'banner1' => array('type' => 'images', 'label' => 'LOgo chân trang'),
                'banner1_link' => array('type' => 'text', 'label' => 'LInk logo chân trang'),
                'banner2' => array('type' => 'images', 'label' => 'HỆ THỐNG TRUNG TÂM'),
                //'banner2_link' => array('type' => 'text', 'label' => 'LInk logo chân trang'),


            ),

        );


        return $data;

    }

}

