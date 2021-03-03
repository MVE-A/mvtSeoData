<?php

$events = [];

$tmp = [
    'mvtSeoDataIndexOnReceivingProductData',
	//'mvtSeoDataResourceOnReceivingData'
];

foreach ($tmp as $k => $v) {
    /** @var modEvent $event */
    $event = $modx->newObject('modEvent');
    $event->fromArray(array(
        'name' => $v,
        'service' => 1,
        'groupname' => PKG_NAME,
    ), '', true, true);
    $events[] = $event;
}

return $events;