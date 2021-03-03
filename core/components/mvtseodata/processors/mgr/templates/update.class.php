<?php

class mvtSeoDataTemplateUpdateProcessor extends modObjectUpdateProcessor
{
    public $objectType = 'mvtSeoDataTemplates';
    public $classKey = 'mvtSeoDataTemplates';
    public $languageTopics = array('mvtseodata');
    #public $permission = 'save';

	private $resource_id;


    public function beforeSave()
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }

		$this->resource_id = (int)($this->getProperty('resource_id'));
		
        return true;
    }



    public function beforeSet()
    {
        $id = (int)$this->getProperty('id');
        $name = trim($this->getProperty('name'));
		$parent_id = (int)($this->getProperty('resource_parent_id'));
		
        if (empty($id)) {
            return $this->modx->lexicon('mvtseodata_item_err_ns');
        }

        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('mvtseodata_item_err_name'));
        } elseif ($this->modx->getCount($this->classKey, array('name' => $name, 'id:!=' => $id))) {
            $this->modx->error->addField('name', $this->modx->lexicon('mvtseodata_item_err_ae'));
        }
		
		if(!empty($this->resource_id)) {
			if($resource = $this->modx->getObject('modResource',$this->resource_id)) {
				$this->setProperty('resource_class_key',$resource->get('class_key'));
			}
			else {
				$this->modx->error->addField('resource_id', $this->modx->lexicon('mvtseodata_resource_id_err_ae'));
			}
		}
				
        return parent::beforeSet();
    }
	
	
	
	
	public function afterSave()   
	{
		#$sD = $this->modx->getService('mvtSeoData');
        #$sD->cacheRefresh($this->resource_id);
		
		return parent::afterSave();
    }
}

return 'mvtSeoDataTemplateUpdateProcessor';
