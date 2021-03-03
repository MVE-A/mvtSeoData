<?php
/**
 * запускает сбор данных по категориям MS2 по crontab. 
 * формат запуска: php file_directory_path/run.php
 * 
 * например: 0 2 * * * php ~/core/components/mvtseodata/run.php - запускать каждый день в 2 часа ночи
*/

$config = require dirname(dirname(dirname(dirname(__FILE__)))).'/config/config.inc.php';
define('MODX_API_MODE', true);
require MODX_BASE_PATH.'/index.php';
    
if ($mvtSeoData = $modx->getService('mvtseodata', 'mvtSeoData', $modx->getOption('msbaskets_core_path', null,
	$modx->getOption('core_path') . 'components/mvtseodata/') . 'model/mvtseodata/')
) {

    run(0);
}

function run($offset) {
    
    global $modx, $mvtSeoData;
    
     $response = $modx->runProcessor('mgr/index/create', [
        'offset' => $offset
        ], [
            'processors_path' => $mvtSeoData->config['processorsPath']
        ]);
        
    
    if($response->response['success'] == 1){
        if($response->response['object']['done']) {
            return true;
        }
    }
    else {
        return false;
    }
    
    run($response->response['object']['offset']);  
}