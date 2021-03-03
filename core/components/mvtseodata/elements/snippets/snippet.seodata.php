<?php

if ($mvtSeoData = $modx->getService('mvtseodata', 'mvtSeoData', $modx->getOption('msbaskets_core_path', null,
	$modx->getOption('core_path') . 'components/mvtseodata/') . 'model/mvtseodata/', $scriptProperties)
) {
	$pdoTools = $modx->getService('pdoTools');

	return $mvtSeoData->Run([
		'pagetitle' => $modx->resource->get('pagetitle'),
		'menutitle' => $modx->resource->get('pagetitle'),
		//'price' => $modx->resource->get('pagetitle'),
		//'pagetitle' => $modx->resource->get('pagetitle'),
	]);
}
return [];