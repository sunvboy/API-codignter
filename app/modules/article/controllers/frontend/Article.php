<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends MY_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		$this->load->library('nestedsetbie', array('table' => 'article_catalogue'));
		$this->module = 'article';
		$this->fc_lang = $this->config->item('fc_lang');
	}
	
	public function view($id = 0){
        redirect(BASE_URL);

        $id = (int)$id;
        $publish_time = gmdate('Y-m-d H:i:s', time() + 7*3600);

        $detailArticle = $this->Autoload_Model->_get_where(array(
			'select' => 'id, title, slug, canonical, catalogueid, description, image, viewed, (SELECT fullname FROM user WHERE user.id = article.userid_created) as fullname, created',
			'table' => 'article',
			'where' => array('publish_time <=' => $publish_time,'id' => $id,'publish' => 0,'alanguage' => $this->fc_lang),
		));
		if(!isset($detailArticle) || is_array($detailArticle) == false || count($detailArticle) == 0){
			$this->session->set_flashdata('message-danger', 'Bài viết không tồn tại');
			redirect(BASE_URL);
		}
		$data = comment(array('id' => $id, 'module' => $this->module));
		$detailCatalogue = $this->Autoload_Model->_get_where(array(
			'select' => 'id, title, canonical, image, lft, rgt',
			'table' => 'article_catalogue',
			'where' => array('id' => $detailArticle['catalogueid'],'alanguage' => $this->fc_lang),
		));
		$data['breadcrumb'] = $this->Autoload_Model->_get_where(array(
			'select' => 'id, title, slug, canonical, lft, rgt',
			'table' => 'article_catalogue',
			'where' => array('lft <=' => $detailCatalogue['lft'],'rgt >=' => $detailCatalogue['lft'],'alanguage' => $this->fc_lang),
			'order_by' => 'lft ASC, order ASC'
		), TRUE);
		
		/* CẬP NHẬT LƯỢT XEM TỰ NHIÊN */
		$this->Autoload_Model->_update(array(
			'table' => 'article',
			'where' => array('id' => $id),
			'data' => array('viewed'=>$detailArticle['viewed'] + 1),
		));
		
		/* OBJECT đã xem */
		$objectSee = isset($_COOKIE[CODE.'articleCookie'])?$_COOKIE[CODE.'articleCookie']:NULL;
		$objectid = json_decode($objectSee, TRUE);
		if (!isset($objectSee) || empty($objectSee)) {
			setcookie(CODE.'articleCookie', json_encode(array(
				0 => $id
			)), time() + (86400 * 30), '/');
		}else{
			foreach ($objectid as $key) {
				$objectid[] = $id;
			}
			$objectid = array_values(array_unique($objectid));
			setcookie(CODE.'articleCookie', json_encode($objectid), time() + (86400 * 30), '/');
		}
		
		$data['articles_same'] = $this->Autoload_Model->_get_where(array(
			'select' => 'id, title, slug, canonical, image, description, created',
			'table' => 'article',
			'where' => array('id!= ' => $detailArticle['id'], 'catalogueid' => $detailCatalogue['id'],'alanguage' => $this->fc_lang),
			'order_by' => 'order desc, id desc',
			'limit' => 4,
		), TRUE);
		
		$data['tag'] = $this->Autoload_Model->_get_where(array(
			'select' => 'tb1.id , tb1.title, tb1.canonical',
			'table' => 'tag as tb1',
			'join' => array(
				array('tag_relationship as tb2' , 'tb2.tagid = tb1.id', 'inner'),
			),
			'where' => array(
				'publish' => 0,
				'tb2.module' => 'article',
				'tb2.moduleid' => $id,'tb1.alanguage' => $this->fc_lang
			),
		), true);
		$data['module'] = 'article';
		$data['moduleid'] = $detailArticle['id'];
		$data['meta_title'] = !empty($detailArticle['meta_title'])?$detailArticle['meta_title']:$detailArticle['title'];
		$data['meta_description'] = html_entity_decode(htmlspecialchars_decode(!empty($detailArticle['meta_description'])?$detailArticle['meta_description']:cutnchar(strip_tags($detailArticle['description']), 300)));
		$data['meta_image'] = !empty($detailArticle['image'])?base_url($detailArticle['image']):'';
		$data['detailArticle'] = $detailArticle;
		$data['detailCatalogue'] = $detailCatalogue;
		$data['canonical'] = rewrite_url($detailArticle['canonical'], TRUE, TRUE);
		$data['og_type'] = 'article';
		/*
		if($data['detailArticle']['id']==6){
			$data['template'] = 'article/frontend/article/huongdantichdiem';
		}else if($data['detailArticle']['id']==8 ){
			$data['template'] = 'article/frontend/article/gioithieu';

		}else if( $data['detailArticle']['id']==7){
			$data['template'] = 'article/frontend/article/loiich';

		}else if( $data['detailArticle']['id']==9){
			$data['template'] = 'article/frontend/article/gem1';

		}else if( $data['detailArticle']['id']==10){
			$data['template'] = 'article/frontend/article/gem2';

		}else{

		}*/
		$data['template'] = 'article/frontend/article/view';

		$this->load->view('homepage/frontend/layout/home', isset($data)?$data:NULL);
	}
	
	
}
