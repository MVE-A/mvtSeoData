<?php

class mvtSeoData
{

    public $modx;
	
	public $limit = 1;
	public $version = '1.0.6';
	
	public $pdo;
	protected $pdo_config = [
		'products' => [
			'class' => 'msProduct',
    		'where' => [
    			'class_key' => 'msProduct'
    		],
    		'parents' => 0,
    		'depth' => 10,
    		'return' => 'ids',
    		'limit' => 0
		],
		'category_member' => [
			'class' => 'msCategoryMember',
			'select' => ['msCategoryMember' => 'product_id'],
			'return' => 'data',
			'limit' => 0
		]
	];
	

    function __construct(modX &$modx, array $config = array())
    {
        $this->modx =& $modx;

        $corePath = $this->modx->getOption('mvtseodata_core_path', $config,
            $this->modx->getOption('core_path') . 'components/mvtseodata/'
        );
        $assetsUrl = $this->modx->getOption('mvtseodata_assets_url', $config,
            $this->modx->getOption('assets_url') . 'components/mvtseodata/'
        );
        $connectorUrl = $assetsUrl . 'connector.php';

        $this->config = array_merge(array(
            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',
            'imagesUrl' => $assetsUrl . 'images/',
            'connectorUrl' => $connectorUrl,

            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'chunksPath' => $corePath . 'elements/chunks/',
            'templatesPath' => $corePath . 'elements/templates/',
            'chunkSuffix' => '.chunk.tpl',
            'snippetsPath' => $corePath . 'elements/snippets/',
            'processorsPath' => $corePath . 'processors/',
        ), $config);

        $this->modx->addPackage('mvtseodata', $this->config['modelPath']);
        $this->modx->lexicon->load('mvtseodata:default');
    }
	
	
	
	
	public function Run($resource)
	{
		$out = [
			'longtitle' => '',
			'pagetitle' => '',
			'description' => '',
			'content' => '',
			'image' => ''
		];
		
		$resource = $resource->toArray();
		
		# ищем индивидуальный
		if(!$obj = $this->modx->getObject('mvtSeoDataTemplates',[
				'resource_id' => $resource['id'],
				'active' => 1
		])) {
			
			$pids = $this->modx->getParentIds($resource['id'], 10, ['context' => 'web']);
					
			# ищем общий
			$q = $this->modx->newQuery('mvtSeoDataTemplates', [
            	'resource_parent_id:IN' => $pids,
            	'resource_class_key' => $resource['class_key'],
            	'common' => 1,
            	'active' => 1
            ]);
            $q->sortby('priority','DESC');
                        
            $obj = $this->modx->getObject('mvtSeoDataTemplates',$q);		
		}
				

		if($obj) {
		    
		    $template = $obj->toArray();
					
			$s = ['{pagetitle}', '{menutitle}', '{longtitle}'];
			$r = [$resource['pagetitle'], $resource['menutitle'], $resource['longtitle']];
			
			$s[] = '{price}';
			$r[] = $resource['price'] ?? '';
			

			$get_page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 0;
			$page_template = ($get_page != 0) ? str_replace('{page}', $get_page, $template['get_page_template']) : '';
			
			
			if(!empty($resource['thumb'])) {
		        $out['image'] = $resource['thumb'];
		    }
			
			if($resource['class_key'] == 'msCategory') {
			    
			    if($category_data = $this->modx->getObject('mvtSeoDataCatogories', [
        			'resource_id' => $resource['id'],
        			'active' => 1
        		])) {
        		    
        		    $category_data = $category_data->toArray();
			    
    			    foreach(['min_price','max_price','average_price','count_products'] as $item) {
    			        $s[] = '{'.$item.'}';
    			        $r[] = $category_data[$item] ?? '';
    			    }
    			    
    			    $s[] = '{main_product_pagetitle}';
    			    $r[] = $category_data['main_product']['pagetitle'] ?? '';
    			    
    			    $s[] = '{main_product_thumb}';
    			    if(!empty($category_data['main_product']['thumb'])) {
    			        $out['image'] = $category_data['main_product']['thumb'];
    			        $r[] = $category_data['main_product']['thumb'];
    			    }
    			    else {
    			        $r[] = '';
    			    }
    			    
    			    
    			    $s[] = '{min_price_product_pagetitle}';
    			    $r[] = $category_data['min_price_product']['pagetitle'] ?? '';
    			    
    			    $s[] = '{max_price_product_pagetitle}';
    			    $r[] = $category_data['max_price_product']['pagetitle'] ?? '';
    			    
    			    
    				$s[] = '{page}';
    				$r[] = $page_template;
    				
        		}

			}
			
			$s[] = '{parent_pagetitle}';
			if($parent = $this->modx->getObject('modResource',$resource['parent'])) {
				$r[] = $parent->get('pagetitle');
			}
			else {
			    $r[] = '';
			}
			
			
			$replacement = $this->addModifiers([
				's' => $s,
				'r' => $r
			]);
			
			#$this->modx->log(1, print_r($replacement,1));
			
			$out['longtitle'] = $this->cleanse(str_replace($replacement['s'], $replacement['r'], $template['title_template']));
    		$out['pagetitle'] = $this->cleanse(str_replace($replacement['s'], $replacement['r'], $template['pagetitle_template']));
    		$out['description'] = $this->cleanse(str_replace($replacement['s'], $replacement['r'], $template['description_template']));
    		$out['content'] = $this->cleanse(str_replace($replacement['s'], $replacement['r'], $template['content_template']));
			
		}
        
		return $this->applyReplacementPriority($template['replacement_priority'], $template['replacement_priority_content'], $resource, $out);
		
	}
	
	
	
	
	

	private function applyReplacementPriority($priority, $priority_content, $resource, $data) 
	{			
		foreach($data as $k => $v) {
			
			if($k == 'image') {
				continue;
			}
			
			if($k == 'content') {
			    $data[$k] = $this->setPriority($priority_content, $data[$k], $resource[$k]);
			}
			else {
			    $data[$k] = $this->setPriority($priority, $data[$k], $resource[$k]);
			}
		}
		
		return $data;
	}
	
	
	
	
	
	private function setPriority($priority, $component_data, $resource_data) 
	{
	    switch($priority) {
			
			case 0:
				return $resource_data;
				/*if(!empty($resource_data)) {
					return $resource_data;
				}
				else {
				    return $component_data;
				}*/
				
			case 1:
				return $component_data;
				/*if(!empty($component_data)) {
					return $component_data;
				}
				else {
				    return $resource_data;
				}*/
			
			case 2:
				return $resource_data.$component_data;

		}
	}
	
	
	
	
	private function addModifiers($replacement) 
	{
		$mods = ['lc','uc'];
		
		foreach ($replacement['s'] as $k => $v) {
				
			foreach($mods as $mod) {
				
				$replacement['s'][] = str_replace("}", ":$mod}", $v);
				
				switch($mod) {

					case 'lc':
						$replacement['r'][] = mb_strtolower($replacement['r'][$k]);
						break;
					
					case 'uc':
						$replacement['r'][] = $this->mbUcfirst($replacement['r'][$k]); //mb_strtoupper($replacement['r'][$k]);
						break;
				}

			}

		}
		
		return $replacement;
	}
		
	
		
	
	
	public function createIndexData($current_category_id = 0)
	{
		$done = false;
		
		if($current_category_id == 0 || empty($_SESSION['msd_process'])) {
			$_SESSION['msd_process'] = [
				'categories' => 0,
				'products' => 0
			];
		}
		
		$total = $this->modx->getCount('modResource',[
			'class_key' => 'msCategory'
		]);
		
		$q = $this->modx->newQuery('modResource');
		$q->where([
			'class_key' => 'msCategory',
			'id:>' => $current_category_id
		]);
		$q->sortby('id', 'ASC');
				
		if($category = $this->modx->getObject('modResource',$q)) {
			
			$current = $category->get('id');
			
			$this->IndexData($current);
			
		}
		else {
			$done = true;
			$this->createIndexFile();
		}
		
		$offset = $cid;

            
		return [
			'total' => $total,
			'offset' => $current,
			'done' => $done,
			'categories' => $_SESSION['msd_process']['categories'] ?? 0,
			'products' => $_SESSION['msd_process']['products'] ?? 0,
		];
	}





	protected function createIndexFile() 
	{
		$file = $this->config['corePath'].'index.json';					
		$fp = fopen($file, 'w');
		fwrite($fp, json_encode(array_merge(['date' => date('d.m.Y H:i')], $_SESSION['msd_process'])));
		fclose($fp);
	}	



	
	public function IndexData($category_id=0, $cron=false)
	{
		$count = 0;
		$this->pdo = $this->modx->getService('pdoFetch');
		
		$where = ['class_key' => 'msCategory'];
		
		if(!empty($category_id)) {
			$where['id'] = $category_id;
		}
		
		$q = $this->modx->newQuery('modResource', $where);
		
		$categories = $this->modx->getIterator('modResource',$q);

		foreach($categories as $category) {
			
			$_SESSION['msd_process']['categories']++;
			
			$category_id = $category->get('id');

			$p1 = $this->getProductsCategory($category_id);
			$p2 = $this->getProductsCategoryMember($category_id);
			$products = array_merge($p1,$p2);
						
			$data = $this->getProductsData($products);
			
			if(!empty($data['count_products'])) {
				
				$_SESSION['msd_process']['products'] += $data['count_products'];
				
				$data['updatedon'] = date('Y-m-d H:i:s');
				
				if(!$data_catogories = $this->modx->getObject('mvtSeoDataCatogories', [
					'resource_id' => $category_id
				])) {
					$data['createdon'] = date('Y-m-d H:i:s');
					$data['resource_id'] = $category_id;
					$data_catogories = $this->modx->newObject('mvtSeoDataCatogories');
				}
				
				$data_catogories->fromArray($data);
				$data_catogories->save();
				$count++;
			}
		}
		
		if($cron) {
			$this->createIndexFile();
		}
		
		return $count;
	}
	
	
	
	
	
	
	protected function getProductsData($products)
	{
		$data = [
			'min_price' => 0,
			'max_price' => 0,
			'average_price' => 0,
			'count_products' => 0,
			'main_product' => [],
			'min_price_product' => [],
			'max_price_product' => []
		];
		
		$p_sum = 0;
		
		foreach($products as $product_id) {
			
			$q = $this->modx->newQuery('msProduct', [
				'class_key' => 'msProduct', 
				'id' => $product_id,
				'published' => 1,
				'deleted' => 0
			]);
			
			if($product = $this->modx->getObject('msProduct',$q)) {
				
				$price = $product->get('price');
				
				if($price > 0) {
					
					$data['count_products']++;

					$price = $product->get('price');
					$pagetitle = $product->get('pagetitle');
					$article = $product->get('article');
					$thumb = $product->get('thumb');
					$image = $product->get('image');

					$nfd = $this->modx->invokeEvent('mvtSeoDataIndexOnReceivingProductData', [
						'product' => $product
					]);

					if(!empty($nfd[0])) {
						$price = $nfd[0];
					}

					$p_sum += $price;

					if(empty($data['main_product'])) {
						$data['main_product'] = json_encode([
							'pagetitle' => $product->get('pagetitle'),
							'article' => $product->get('article'),
							'price' => $price,
							'thumb' => $product->get('thumb'),
							'image' => $product->get('image')
						]);
					}

					if($data['min_price'] == 0 || $price < $data['min_price']) {
						$data['min_price'] = $price;
						$data['min_price_product'] = json_encode([
							'pagetitle' => $pagetitle,
							'article' => $article,
							'price' => $price,
							'thumb' => $thumb,
							'image' => $image
						]);					
					}

					if($data['max_price'] == 0 || $price > $data['max_price']) {
						$data['max_price'] = $price;
						$data['max_price_product'] = json_encode([
							'pagetitle' => $pagetitle,
							'article' => $article,
							'price' => $price,
							'thumb' => $thumb,
							'image' => $image
						]);
					}
				}
			}
		}
		
		if($data['count_products'] > 0) {
			$data['average_price'] = round(($p_sum / $data['count_products']),0);
		}
		
		return $data;
	}
	
	
	
	
	
	
	protected function getProductsCategory($category_id)
	{
		$this->pdo_config['products']['parents'] = $category_id;
		
		$this->pdo->setConfig($this->pdo_config['products'], false);
		
		$out = $this->pdo->run();
		
		return explode(',', $out);
	}
	
	
	
	
	
	
	protected function getProductsCategoryMember($category_id)
	{
		$out = [];
		
		$this->pdo_config['category_member']['where'] = [
			'category_id' => $category_id
		];
		
		$this->pdo->setConfig($this->pdo_config['category_member'], false);
		
		$list = $this->pdo->run();
		
		foreach($list as $item) {
			$out[] = $item['product_id'];
		}
		
		return $out;
	}
	
	
	
	
	protected function cleanse($text)
	{
		$text = preg_replace('/\{[^$].*?\}/','',$text);
		$text = preg_replace('/(?:"([^>]*)")(?!>)/', '«$1»', $text);
        $text = str_replace('"', '', $text);

		return $text;
	}
	
	
	
	
	
	public function cacheRefresh($resource_id = 0)
	{
		if(!empty($resource_id)) {
			if($resource = $this->modx->getObject('modResource',$resource_id)) {
				$cache = $this->modx->cacheManager->getCacheProvider($this->modx->getOption('cache_resource_key', null, 'resource'));
				$resource->_contextKey = $resource->context_key;
				$key = $resource->getCacheKey();
				$cache->delete($key, array('deleteTop' => true));
				$cache->delete($key);
			}
		}
		else {
			$this->modx->cacheManager->refresh();
		}
	}
	
	
	private function mbUcfirst($string)
	{
		return mb_strtoupper(mb_substr($string, 0, 1)).mb_strtolower(mb_substr($string, 1));
	}
	
}