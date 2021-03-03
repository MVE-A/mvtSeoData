<?php

class mvtSeoDataTemplateGetProcessor extends modObjectGetProcessor
{
    public $objectType = 'mvtSeoDataTemplates';
    public $classKey = 'mvtSeoDataTemplates';
    public $languageTopics = array('mvtseodata:default');
    #public $permission = 'view';



    public function process()
    {
        if (!$this->checkPermissions()) {
            return $this->failure($this->modx->lexicon('access_denied'));
        }

        return parent::process();
    }
    
    
    
    /*
    public function beforeOutput() 
    {
        $this->object->set('classkey', $this->tp[$classkey]);
    }
    */
    
}

return 'mvtSeoDataTemplateGetProcessor';