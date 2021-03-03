<?php

class mvtSeoDataTemplateRemoveProcessor extends modObjectProcessor
{
    public $objectType = 'mvtSeoDataTemplates';
    public $classKey = 'mvtSeoDataTemplates';
    public $languageTopics = array('mvtseodata');
    #public $permission = 'remove';



    public function process()
    {
        if (!$this->checkPermissions()) {
            return $this->failure($this->modx->lexicon('access_denied'));
        }

        $ids = $this->modx->fromJSON($this->getProperty('ids'));
        if (empty($ids)) {
            return $this->failure($this->modx->lexicon('mvtseodata_item_err_ns'));
        }

        foreach ($ids as $id) {

            if (!$object = $this->modx->getObject($this->classKey, $id)) {
                return $this->failure($this->modx->lexicon('mvtseodata_item_err_nf'));
            }

            $object->remove();
        }

        return $this->success();
    }

}

return 'mvtSeoDataTemplateRemoveProcessor';