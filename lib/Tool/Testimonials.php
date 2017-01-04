<?php

namespace xepan\webwidgets;

class Tool_Testimonials extends \xepan\cms\View_Tool{
	public $options = [
				'record_limit'=>null,
				'template_type' =>'corusel'
			];
	public $count = 1;
	function init(){
		parent::init();

		$template = 'tool\testimonial/'.$this->options['template_type'];
		$testimonial_m = $this->add('xepan\webwidgets\Model_Testimonial');
		$testimonial_cl = $this->add('CompleteLister',null,null,[$template]);
		$testimonial_cl->setModel($testimonial_m);	
		
		if($this->options['template_type'] == 'corusel'){
			$testimonial_cl->addHook('formatRow',function($l){
				if($this->count == 1)
					$l->current_row_html['active'] = "active";
				else
					$l->current_row_html['active'] = "deactive";
				$this->count++;
			});
		}
	}	
}