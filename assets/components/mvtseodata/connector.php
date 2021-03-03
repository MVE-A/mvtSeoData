<?php
if (file_exists(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php')) {
    /** @noinspection PhpIncludeInspection */
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
}
else {
    require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.core.php';
}
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var mvtSeoData $mvtSeoData */
$mvtSeoData = $modx->getService('mvtseodata', 'mvtSeoData', $modx->getOption('mvtseodata_core_path', null,
        $modx->getOption('core_path') . 'components/mvtseodata/') . 'model/mvtseodata/'
);
$modx->lexicon->load('mvtseodata:default');

// handle request
$corePath = $modx->getOption('mvtseodata_core_path', null, $modx->getOption('core_path') . 'components/mvtseodata/');
$path = $modx->getOption('processorsPath', $mvtSeoData->config, $corePath . 'processors/');
$modx->getRequest();

/** @var modConnectorRequest $request */
$request = $modx->request;
$request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));