<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->fc_lang = $this->config->item('fc_lang');
        $this->fcDevice = $this->config->item('fcDevice');
        $this->load->library('session');
    }

    public function index()
    {
        $this->cache->clean();
        $publish_time = gmdate('Y-m-d H:i:s', time() + 7*3600);

        if (!$slide = $this->cache->get('slide')) {
            $slide = slide(array('keyword' => 'main-banner'), $this->fc_lang);
            $data['slide'] = $slide;
            $this->cache->save('slide', $slide, 200);
        } else {
            $data['slide'] = $slide;
        }

        if (!$ykienkhachhang = $this->cache->get('ykienkhachhang')) {
            $ykienkhachhang = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title',
                'table' => 'page_catalogue',
                'where' => array('ishome' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
            if (isset($ykienkhachhang) && is_array($ykienkhachhang) && count($ykienkhachhang)) {
                foreach ($ykienkhachhang as $key => $val) {
                    $ykienkhachhang[$key]['post'] = $this->Autoload_Model->_condition(array(
                        'module' => 'page',
                        'select' => '`object`.`id`, `object`.`title`, `object`.`image`, `object`.`description`, `object`.`content`',
                        'where' => '`object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\' ',
                        'catalogueid' => $val['id'],
                        'limit' => 20,
                        'order_by' => '`object`.`order` asc, `object`.`id` asc',
                    ));
                }
            }
            $data['ykienkhachhang'] = $ykienkhachhang;
            $this->cache->save('ykienkhachhang', $ykienkhachhang, 200);
        } else {
            $data['ykienkhachhang'] = $ykienkhachhang;
        }
        if (!$apax = $this->cache->get('apax')) {
            $apax = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title',
                'table' => 'page_catalogue',
                'where' => array('highlight' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
            if (isset($apax) && is_array($apax) && count($apax)) {
                foreach ($apax as $key => $val) {
                    $apax[$key]['post'] = $this->Autoload_Model->_condition(array(
                        'module' => 'page',
                        'select' => '`object`.`id`, `object`.`title`, `object`.`image`, `object`.`description`, `object`.`content`',
                        'where' => '`object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\' ',
                        'catalogueid' => $val['id'],
                        'limit' => 20,
                        'order_by' => '`object`.`order` asc, `object`.`id` asc',
                    ));
                }
            }
            $data['apax'] = $apax;
            $this->cache->save('apax', $apax, 200);
        } else {
            $data['apax'] = $apax;
        }
        if (!$bannerhome = $this->cache->get('bannerhome')) {
            $bannerhome = slide(array('keyword' => 'tamlong'), $this->fc_lang);
            $data['bannerhome'] = $bannerhome;
            $this->cache->save('bannerhome', $bannerhome, 200);
        } else {
            $data['bannerhome'] = $bannerhome;
        }
        /*





        if (!$tour = $this->cache->get('tour')) {
            $tour = $this->Autoload_Model->_get_where(array(
                'select' => 'id,image,title,catalogueid,description,canonical,price,price_sale,price_contact,duration',
                'table' => 'tour',
                'limit' => '20',
                'order_by' => 'order asc,id desc',
                'where' => array('publish_time <=' =>  $publish_time,'ishome' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)),true);

            $data['tour'] = $tour;
            $this->cache->save('tour', $tour, 200);
        } else {
            $data['tour'] = $tour;
        }
        */


        if (!$tintuc = $this->cache->get('tintuc')) {
            $tintuc = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title,canonical,description',
                'table' => 'article_catalogue',
                'where' => array('ishome' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
            if (isset($tintuc) && is_array($tintuc) && count($tintuc)) {
                foreach ($tintuc as $key => $val) {
                    $tintuc[$key]['post'] = $this->Autoload_Model->_condition(array(
                        'module' => 'article',
                        'select' => '`object`.`id`, `object`.`title`, `object`.`image`, `object`.`canonical`, `object`.`description`, `object`.`created`, `object`.`viewed`',
                        'where' => '`object`.`publish_time` <= \'' . $publish_time . '\' AND `object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\' ',
                        'catalogueid' => $val['id'],
                        'limit' => 4,
                        'order_by' => '`object`.`order` asc, `object`.`id` desc',
                    ));
                }
            }
            $data['tintuc'] = $tintuc;
            $this->cache->save('tintuc', $tintuc, 200);
        } else {
            $data['tintuc'] = $tintuc;
        }
        if (!$cogidangdienra = $this->cache->get('cogidangdienra')) {
            $cogidangdienra = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title,canonical,description',
                'table' => 'article_catalogue',
                'where' => array('highlight' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
            if (isset($cogidangdienra) && is_array($cogidangdienra) && count($cogidangdienra)) {
                foreach ($cogidangdienra as $key => $val) {
                    $cogidangdienra[$key]['post'] = $this->Autoload_Model->_condition(array(
                        'module' => 'article',
                        'select' => '`object`.`id`, `object`.`title`, `object`.`image`, `object`.`canonical`, `object`.`description`, `object`.`created`, `object`.`viewed`',
                        'where' => '`object`.`publish_time` <= \'' . $publish_time . '\' AND `object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\' ',
                        'catalogueid' => $val['id'],
                        'limit' => 20,
                        'order_by' => '`object`.`order` asc, `object`.`id` desc',
                    ));
                }
            }
            $data['cogidangdienra'] = $cogidangdienra;
            $this->cache->save('cogidangdienra', $cogidangdienra, 200);
        } else {
            $data['cogidangdienra'] = $cogidangdienra;
        }
        //danh mục sản phẩm
        if (!$product_catalog_ishome = $this->cache->get('product_catalog_ishome')) {
            $product_catalog_ishome = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title, canonical',
                'table' => 'product_catalogue',
                'limit' => 1,
                'where' => array('ishome' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);
            if (isset($product_catalog_ishome) && is_array($product_catalog_ishome) && count($product_catalog_ishome)) {
                foreach ($product_catalog_ishome as $key => $val) {
                    /*// Danh mục con
                     $product_catalog_ishome[$key]['child'] = $this->Autoload_Model->_get_where(array(
                         'select' => 'id, title, slug, canonical, lft, rgt',
                         'table' => 'product_catalogue',
                         'limit' => 5,
                         'where' => array('publish' => 0, 'parentid' => $val['id'])), true);*/

                    // Sản phẩm thuộc danh mục lớn
                    $product_catalog_ishome[$key]['post'] = $this->Autoload_Model->_condition(array(
                        'module' => 'product',
                        'select' => '`object`.`id`, `object`.`catalogueid`, `object`.`title`, `object`.`slug`, `object`.`canonical`, `object`.`image`, `object`.`created`',
                        'where' => '`object`.`publish_time` <= \'' . $publish_time . '\' AND `object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\'',
                        'catalogueid' => $val['id'],
                        'limit' => 5,
                        'order_by' => '`object`.`order` asc, `object`.`id` asc',
                    ));
                }
            }

            $data['product_catalog_ishome'] = $product_catalog_ishome;
            $this->cache->save('product_catalog_ishome', $product_catalog_ishome, 200);
        } else {
            $data['product_catalog_ishome'] = $product_catalog_ishome;
        }



        if (!$product_catalog_highlight = $this->cache->get('product_catalog_highlight')) {
            $product_catalog_highlight = $this->Autoload_Model->_get_where(array(
                'select' => 'id, title, slug, canonical, lft, rgt',
                'table' => 'product_catalogue',
                'limit' => 10,
                'where' => array('highlight' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)), true);

            if (isset($product_catalog_highlight) && is_array($product_catalog_highlight) && count($product_catalog_highlight)) {
                foreach ($product_catalog_highlight as $key => $val) {
                    /*// Danh mục con
                    $product_catalog_highlight[$key]['child'] = $this->Autoload_Model->_get_where(array(
                        'select' => 'id, title, slug, canonical, lft, rgt',
                        'table' => 'product_catalogue',
                        'limit' => 5,
                        'where' => array('publish' => 0, 'parentid' => $val['id'])), true);*/

                    // Sản phẩm thuộc danh mục lớn
                    $product_catalog_highlight[$key]['post'] = $this->Autoload_Model->_condition(array(
                        'module' => 'product',
                        'select' => '`object`.`id`, `object`.`title`, `object`.`slug`, `object`.`canonical`, `object`.`image`, `object`.`description`',
                        'where' => '`object`.`publish_time` <= \'' . $publish_time . '\' AND `object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\'',
                        'catalogueid' => $val['id'],
                        'limit' => 4,
                        'order_by' => '`object`.`order` asc, `object`.`id` asc',
                    ));
                }
            }

            $data['product_catalog_highlight'] = $product_catalog_highlight;
            $this->cache->save('product_catalog_highlight', $product_catalog_highlight, 200);
        } else {
            $data['product_catalog_highlight'] = $product_catalog_highlight;
        }

        $data['canonical'] = base_url();
        $data['meta_title'] = $this->fcSystem['seo_meta_title'];
        $data['meta_description'] = $this->fcSystem['seo_meta_description'];
        $data['meta_image'] = $this->fcSystem['seo_meta_images'];
        $data['og_type'] = 'product';
        $data['template'] = 'homepage/frontend/home/index';
        $this->load->view('homepage/frontend/layout/home', isset($data) ? $data : NULL);
    }


}

