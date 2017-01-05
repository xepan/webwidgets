<?php

namespace xepan\webwidgets;

class Tool_Gallery extends \xepan\cms\View_Tool{
	public $lister;
	function init(){
		parent::init();

		$gallery_image_m = $this->add('xepan\webwidgets\Model_GalleryImage');
		
		$this->lister = $image_lister = $this->add('CompleteLister',null,'image_lister',['tool\gallery\image']);
		
		if($category_id = $_GET['cat_id']){
			$gallery_image_m->addCondition('gallery_category_id',$category_id);
		}
		
		$image_lister->setModel($gallery_image_m,['file','gallery_category']);		
		
		$category_m = $this->add('xepan\webwidgets\Model_GalleryCategory');
		$cat_lister = $this->add('CompleteLister',null,'category_lister',['tool\gallery\category']);
		

		$cat_lister->setModel($category_m);
		
		$url = $this->app->url(null,['cut_object'=>$image_lister->name]);

		
		$cat_lister->on('click','.seprate-li-content',function($js,$data)use($url,$image_lister){
			return $image_lister->js()->reload(['cat_id'=>$data['id']],null,$url);
		});

	}

	function render(){
		$this->lister->js(true)->_load($this->app->url()->absolute()->getBaseURL().'vendor/xepan/webwidgets/templates/js/jquery.fancybox.js')
							->_css("jquery.fancybox-buttons")
							->_css("jquery.fancybox");

		$this->js(true)->_selector('#'.$this->name.' .fancybox')->fancybox();
		return parent::render();
	}

	function defaultTemplate(){
		return ['tool\gallery\gallery'];
	}
}