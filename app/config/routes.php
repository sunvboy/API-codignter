<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route[BACKEND_DIRECTORY] = 'user/backend/auth/login';
$route['default_controller'] = 'homepage/home/index';
$route['mobile'] = 'homepage/home/index_mobile';
$route['tat-ca-danh-muc'] = 'homepage/home/catalogueAll';
$route['404_override'] = 'dashboard/filenotfound/index';
$route['translate_uri_dashes'] = FALSE;
//user_frotnend
$route['login-google'] = 'user/ajax/user/Login_google';
$route['login-fbcallback'] = 'user/ajax/user/fbcallback';
$route['register'] = 'user/frontend/user/register';
$route['register-modal'] = 'user/frontend/user/registerajax';
$route['login'] = 'user/frontend/user/login';
$route['login-modal'] = 'user/frontend/user/loginajax';
$route['logout'] = 'user/frontend/user/logout';
$route['forgot-password'] = 'user/frontend/user/forgotpassword';
$route['forgot-modal'] = 'user/frontend/user/forgotpasswordajax';
$route['xac-minh'] = 'user/frontend/user/verify';

$route['information'] = 'user/frontend/manage/information';
$route['information-shop'] = 'user/frontend/manage/information_shop';
$route['upload'] = 'user/frontend/manage/upload';
$route['uploadQr'] = 'user/frontend/manage/uploadQr';
$route['uploadVideo'] = 'user/frontend/manage/uploadVideo';
$route['change-pass'] = 'user/frontend/manage/change_pass';
$route['order-history/([0-9]+)'] = 'user/frontend/manage/order_history/$1';
$route['order-history'] = 'user/frontend/manage/order_history';
$route['order-information'] = 'user/frontend/manage/order_information';
$route['list-product/([0-9]+)'] = 'user/frontend/product/view/$1';
$route['list-product'] = 'user/frontend/product/view';
$route['create-product'] = 'user/frontend/product/create';
$route['update-product'] = 'user/frontend/product/update';
$route['uploaddropzone'] = 'user/frontend/product/uploaddropzone';



$route['wish-list/([0-9]+)'] = 'user/frontend/manage/wishlist/$1';
$route['wish-list'] = 'user/frontend/manage/wishlist';
$route['quickview'] = 'product/ajax/frontend/quickview';


$route['chinh-sach-ban-hang'] = 'homepage/policy/index';
$route['video'] = 'homepage/video/index';	
$route['mat-bang'] = 'homepage/matbang/index';	


$route['gio-hang'] = 'cart/frontend/cart/cart';
$route['thanh-toan'] = 'cart/frontend/cart/payment';
$route['dat-mua-thanh-cong'] = 'cart/frontend/cart/success';
$route['book-tour'] = 'tour/frontend/tour/book_tour';
$route['submit-book-tour'] = 'tour/frontend/tour/submit_book_tour';


$route['lien-he'] = 'contact/frontend/contact/view';
$route['mailsubricre'] = 'contact/frontend/contact/create';
$route['tim-kiem/trang-([0-9]+)'] = 'search/frontend/search/view/$1';
$route['tim-kiem'] = 'search/frontend/search/view';
$route['([a-zA-Z0-9-]+)/trang-([0-9]+)'] = 'homepage/router/index/$1/$2';
$route['([a-zA-Z0-9-]+)'] = 'homepage/router/index/$1';
$route['filenotfound'] = 'homepage/filenotfound/index';


