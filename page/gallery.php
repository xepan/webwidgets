<?php

namespace xepan\webwidgets;
class page_gallery extends \xepan\base\Page{
	public $title = "Gallery"; 

	function init(){
		parent::init();

		$tabs = $this->add('Tabs');
        $images = $tabs->addTab('Gallery Images');
        $category = $tabs->addTab('Gallery Category');
	
		$category_m = $this->add('xepan\webwidgets\Model_GalleryCategory');
		$images_m = $this->add('xepan\webwidgets\Model_GalleryImage'); 
		
		$category_g = $category->add('xepan\hr\CRUD',null,null,['grid\gallerycategory']);
		$category_g->setModel($category_m,['name'],['name','status']);        

		$image_g = $images->add('xepan\hr\CRUD',null,null,['grid\galleryimage']);
		$image_g->setModel($images_m,['gallery_category_id','title','description','file_id'],['gallery_category','title','description','file','status']);
	}
}