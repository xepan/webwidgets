<?php

namespace xepan\webwidgets;

class Tool_Testimonials extends \xepan\cms\View_Tool{
	public $options = [
				'record_limit'=>null,
				'testimonial_type' =>'crousel',
				'carousel_trigger_time'=>'5',
				'paginator_limit_on_grid'=>'5',
				'record_per_row'=>null,
				'show_created_at'=>null			
			];

	function init(){
		parent::init();

		$testimonial_m = $this->add('xepan\webwidgets\Model_Testimonial');
		
		if($this->options['record_limit'])
			$testimonial_m->setLimit($this->options['record_limit']);
		
		if($this->options['testimonial_type'] == 'grid'){			
			$grid = $this->add('xepan\base\Grid',null,null,['tool\testimonial\grid']);
			$grid->setModel($testimonial_m);
			
			if($this->options['paginator_limit_on_grid'])
				$grid->addPaginator(5);			
		}

		if($this->options['testimonial_type'] == 'list'){			
			$grid = $this->add('xepan\base\Grid',null,null,['tool\testimonial\list']);
			$grid->setModel($testimonial_m);					
		}

		if($this->options['testimonial_type'] == 'crousel'){			
			$grid = $this->add('CompleteLister',null,null,['tool\testimonial\corusel']);
			$grid->setModel($testimonial_m);
		}
	}	
}