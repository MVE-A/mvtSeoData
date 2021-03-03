<?php

class mvtSeoDataTemplateEnableProcessor extends modObjectProcessor
{
    public $objectType = 'mvtSeoDataTemplates';
    public $classKey = 'mvtSeoDataTemplates';
    public $languageTopics = array('mvtseodata');
    #public $permission = 'save';


   
    public function process()
    {
        if (!$this->checkPermissions()) {
            return $this->failure($this->modx->lexicon('access_denied'));
        }

        $ids = $this->modx->fromJSON($this->getProperty('ids'));
        if (empty($ids)) {
            return $this->failure($this->modx->lexicon('mvtseodata_item_err_ns'));
        }
		
		$sD = $this->modx->getService('mvtSeoData');
        
		$c = 0;
        foreach ($ids as $id) {
			$c++;
            if (!$object = $this->modx->getObject($this->classKey, $id)) {
                return $this->failure($this->modx->lexicon('mvtseodata_item_err_nf'));
            }

			/*$resource_id = $object->get('resource_id');
			if(!empty($resource_id)) {
				$sD->cacheRefresh($resource_id);
			}
			else {
				if($c == count($ids)) {
					$sD->cacheRefresh();
				}
			}*/
			
            $object->set('active', true);
            $object->save();
        }

		
        return $this->success();
    }

}

return 'mvtSeoDataTemplateEnableProcessor';
