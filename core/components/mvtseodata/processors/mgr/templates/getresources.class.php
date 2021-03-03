<?php
class mvtSeoDataAssortmentResourceGetListProcessor extends modObjectGetListProcessor {

	public $objectType = 'modResource';
    public $classKey = 'modResource';
    public $defaultSortField = 'pagetitle';
    public $defaultSortDirection = 'ASC';
    #public $permission = '';


    public function beforeQuery()   
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }

        return true;
    }
	
	
	
	public function prepareQueryBeforeCount(xPDOQuery $c) 
	{
        
        $query = trim($this->getProperty('query'));
        
        $resource_id = (int)$this->getProperty('id');
        
		if (!empty($query)) {
			
			$ms2_path = $this->modx->getOption('core_path').'components/minishop2/model/minishop2/';
			
			if(is_dir($ms2_path)) {
				$miniShop2 = $this->modx->getService('miniShop2');
				if ($miniShop2 instanceof miniShop2) {
					$c->leftJoin('msProductData', 'Data', 'Data.id = modResource.id');
					#$c->where($where);
					$c->where([
						['modResource.pagetitle:LIKE' => "%{$query}%"], 
						['modResource.id' => "{$query}"], 
						['Data.article:LIKE' => "%{$query}%"]
					],xPDOQuery::SQL_OR); 
				}
			}
			else {
				#$c->where($where);
				$c->where([
					['modResource.pagetitle:LIKE' => "%{$query}%"], 
					['modResource.id' => "{$query}"]
				],xPDOQuery::SQL_OR);
			}
        }
        else {
            //if(!empty($resource_id)) {
                $c->where(['id' => $resource_id]);
           // }
        }
		            
        return $c;
    }
	
	
	public function prepareRow(xPDOObject $object) 
	{
        $array = $object->toArray();

		$parents_ = [];
		$parents = $this->modx->getParentIds($array['id'], 2, ['context' => $array['context_key']]);
        if (empty($parents[count($parents) - 1])) {
            unset($parents[count($parents) - 1]);
        }
        if (!empty($parents) && is_array($parents)) {
            $q = $this->modx->newQuery('modResource', array('id:IN' => $parents));
            $q->select('id,pagetitle');
            if ($q->prepare() && $q->stmt->execute()) {
                while ($row = $q->stmt->fetch(PDO::FETCH_ASSOC)) {
                    $key = array_search($row['id'], $parents);
                    if ($key !== false) {
                        $parents[$key] = $row;
                    }
                }
            }
            $parents_ = array_reverse($parents);
        }
		
		if(empty($array['article'])) {
			$array['article'] = '';
		}
		
		$array_ = [
			'id' => $array['id'],
			'article' => $array['article'],
			'parents' => $parents_,
			'pagetitle' => $array['pagetitle'].' ['.$array['id'].']'
		];
		
		//$this->modx->log(1,print_r($array_,1));
		
        return $array_;
    }

}
return 'mvtSeoDataAssortmentResourceGetListProcessor';
?>