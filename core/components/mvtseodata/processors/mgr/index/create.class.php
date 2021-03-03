<?php
class mvtSeoDataIndexCreateProcessor extends modObjectProcessor {
	
    public function process() 
	{
		$sD = $this->modx->getService('mvtSeoData');
        $result = $sD->createIndexData(trim($this->getProperty('offset')));
		
		return $this->success('',$result);
    }
}

return 'mvtSeoDataIndexCreateProcessor';