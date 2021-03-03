<?php


$settings = array();

$tmp = array(
    'product_indexing_where' => array(
        'value' => '',
        'xtype' => 'textfield',
        'area' => 'mvtseodata_main',
    ),
	'mng_rt' => array(
        'value' => false,
        'xtype' => 'combo-boolean',
        'area' => 'mvtseodata_main',
    )
);

foreach ($tmp as $k => $v) {
    $setting = $modx->newObject('modSystemSetting');
    $setting->fromArray(array_merge(
        array(
            'key' => 'mvtseodata_' . $k,
            'namespace' => PKG_NAME_LOWER,
        ), $v
    ), '', true, true);

    $settings[] = $setting;
}
unset($tmp);

return $settings;
