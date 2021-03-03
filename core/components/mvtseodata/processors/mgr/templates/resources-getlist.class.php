<?php

class mvtSeoDataTemplatesGetListProcessor extends modObjectGetListProcessor
{
    public $objectType = 'mvtSeoDataTemplates';
    public $classKey = 'mvtSeoDataTemplates';
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';
    #public $permission = 'list';

	public $pts;
	
		
	

    public function beforeQuery()
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }
		
		$this->pts = [
			'modDocument' => $this->modx->lexicon('mvtseodata_resource_class_key_document'),
			'msProduct' => $this->modx->lexicon('mvtseodata_resource_class_key_product'),
			'msCategory' => $this->modx->lexicon('mvtseodata_resource_class_key_category')
		];

        return true;
    }



    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $where = [
			'common' => 0,
			'resource_id:<>' => 0
		];
		
		$query = trim($this->getProperty('query'));
        if ($query) {
            $where['name:LIKE'] = '%'.$query.'%';
        }
		
		$c->where($where);

        return $c;
    }



    public function prepareRow(xPDOObject $object)
    {
        $array = $object->toArray();
		
		$bl_list = ['pagetitle_template', 'title_template', 'get_page_template', 'description_template', 'content_template'];
		foreach($bl_list as $item) {
			$array[$item.'_bl'] = (!empty($array[$item])) ? '<i class="icon icon-check"></i>' : '';
		}
		
		if($resource = $this->modx->getObject('modResource',$array['resource_id'])) {
			$array['resource'] = '['.$resource->get('id').'] '.$resource->get('pagetitle');
			$array['classkey'] = (!empty($this->pts[$array['resource_class_key']])) ? $this->pts[$array['resource_class_key']] : '';	
		}
		
        $array['actions'] = [];


        $array['actions'][] = [
            'cls' => '',
            'icon' => 'icon icon-edit',
            'title' => $this->modx->lexicon('mvtseodata_template_update'),
            #'multiple' => $this->modx->lexicon('mvtseodata_items_update'),
            'action' => 'updateItem',
            'button' => true,
            'menu' => true,
        ];

        if (!$array['active']) {
            $array['actions'][] = [
                'cls' => '',
                'icon' => 'icon icon-power-off action-green',
                'title' => $this->modx->lexicon('mvtseodata_item_enable'),
                'multiple' => $this->modx->lexicon('mvtseodata_items_enable'),
                'action' => 'enableItem',
                'button' => true,
                'menu' => true,
            ];
        } 
		else {
            $array['actions'][] = [
                'cls' => '',
                'icon' => 'icon icon-power-off action-gray',
                'title' => $this->modx->lexicon('mvtseodata_item_disable'),
                'multiple' => $this->modx->lexicon('mvtseodata_items_disable'),
                'action' => 'disableItem',
                'button' => true,
                'menu' => true,
            ];
        }

        $array['actions'][] = array(
            'cls' => '',
            'icon' => 'icon icon-copy action-gray',
            'title' => $this->modx->lexicon('mvtseodata_item_dublicate'),
            'action' => 'dublicateItem',
            'button' => true,
            'menu' => true,
        );

        $array['actions'][] = [
            'cls' => '',
            'icon' => 'icon icon-trash-o action-red',
            'title' => $this->modx->lexicon('mvtseodata_item_remove'),
            'multiple' => $this->modx->lexicon('mvtseodata_items_remove'),
            'action' => 'removeItem',
            'button' => true,
            'menu' => true,
        ];

        return $array;
    }

}

return 'mvtSeoDataTemplatesGetListProcessor';