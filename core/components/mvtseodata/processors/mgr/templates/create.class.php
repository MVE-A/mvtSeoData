<?php

class mvtSeoDataTemplateCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'mvtSeoDataTemplates';
    public $classKey = 'mvtSeoDataTemplates';
    public $languageTopics = ['mvtseodata'];
    #public $permission = 'create';

	private $resource_id;


    public function beforeSet()
    {
		$this->resource_id = (int)($this->getProperty('resource_id'));
		$name = trim($this->getProperty('name'));
		
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('mvtseodata_item_err_name'));
        } elseif ($this->modx->getCount($this->classKey, array('name' => $name))) {
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
		else {
			$this->setProperty('common',1);
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

return 'mvtSeoDataTemplateCreateProcessor';