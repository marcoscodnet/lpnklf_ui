<?php

namespace Lpnklf\UI\layouts;

use Rasty\Layout\layout\Rasty\Layout;

use Rasty\utils\XTemplate;


class LpnklfLoginMetroLayout extends LpnklfMetroLayout{

	public function getXTemplate($file_template=null){
		return parent::getXTemplate( dirname(__DIR__) . "/layouts/LpnklfLoginMetroLayout.htm" );
	}

	public function getType(){
		
		return "LpnklfLoginMetroLayout";
		
	}	

}
?>