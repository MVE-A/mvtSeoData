<?php

class mvtSeoDataIndexGetProcessor extends modObjectProcessor {
    	
	public function process() 
	{
		$corePath = $this->modx->getOption('core_path').'components/mvtseodata/';

		$date = '';
		$cc = $cp = 0;

		if (file_exists($corePath.'index.json')) {
			$index = file_get_contents($corePath.'index.json');
			$data =  json_decode($index,1);
			$cc = $data['categories'] ?? 0;
			$cp = $data['products'] ?? 0;
			$date = $data['date'] ?? '';
		}
		else {
			$q = $this->modx->newQuery('mvtSeoDataCatogories');
			$categories = $this->modx->getIterator('mvtSeoDataCatogories',$q);
		
			$cc = $cp = 0;
			foreach($categories as $category) {
				$cc++;
				$cp += $category->get('count_products');
			}
		}
		
		return $this->success('', [
			'date' => '<span>'.$this->modx->lexicon('mvtseodata_index_date').':</span> '.$date,
			'categories' => '<span>'.$this->modx->lexicon('mvtseodata_index_categories').':</span> '.$cc,
			'products' => '<span>'.$this->modx->lexicon('mvtseodata_index_products').':</span> '.$cp,
		]);
	}

}

return 'mvtSeoDataIndexGetProcessor';
