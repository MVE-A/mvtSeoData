<?php

if ($mvtSeoData = $modx->getService('mvtseodata', 'mvtSeoData', $modx->getOption('msbaskets_core_path', null,
	$modx->getOption('core_path') . 'components/mvtseodata/') . 'model/mvtseodata/', $scriptProperties)
) {

	return $mvtSeoData->Run($modx->resource);
}
return [];