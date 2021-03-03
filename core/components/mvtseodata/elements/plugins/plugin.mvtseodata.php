<?php
if ($mvtSeoData = $modx->getService('mvtseodata', 'mvtSeoData', $modx->getOption('mvtseodata_core_path', null,
        $modx->getOption('core_path') . 'components/mvtseodata/') . 'model/mvtseodata/', array())
    ) {
                      
    switch ($modx->event->name) {
    	    
		# вы можете подменять штатные или добавлять нужные плейсхолдеры  "на лету"	
    	case 'OnLoadWebDocument': 
    	    
			$seoData = $mvtSeoData->Run($modx->resource);
			
			if(is_array($seoData)) {
				foreach($seoData as $k => $v) {
					
					if($k == 'content') {
					    $modx->resource->set($k, $v);
					}
					else {
					    if(!empty($v)) {
						    $modx->resource->set($k, $v); 
					    }
					}
				}
			}
			
			break;
		
			

		# получает данные товара при индексировании; можно внести корректировку в цену
		case 'mvtSeoDataIndexOnReceivingProductData':
			/*
			if(!empty($product)) {
				$price = 10;
			}
			
			if(!empty($price)) {
				$modx->event->output($price);
			}
			*/
			break;
    }
    
}