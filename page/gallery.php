<?php
# TODO
//  Category associated but not shown on grid 
//  Categories not shown on field while editing
//  Improve and category grid image grid
//  Implement options
//  

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
		
		$category_c = $category->add('xepan\hr\CRUD',null,null,['grid\gallerycategory']);
		$category_c->setModel($category_m,['name'],['name','status']);        

		$image_c = $images->add('xepan\hr\CRUD',null,null,['grid\galleryimage']);
		$image_c->setModel($images_m,['gallery_category_id','title','description','file_id'],['gallery_category','title','description','file','status','comma_seperated_categories']);
	
		if($image_c->isEditing()){
			$image_c->form->getElement('gallery_category_id')->setAttr(['multiple'=>'multiple']);
		}
	}
}