<?php
$xpdo_meta_map['mvtSeoDataCatogories']= array (
  'package' => 'mvtseodata',
  'version' => '1.1',
  'table' => 'mvtseodata_catogories',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'MyISAM',
  ),
  'fields' => 
  array (
    'resource_id' => 0,
    'min_price' => 0.0,
    'max_price' => 0.0,
    'average_price' => 0.0,
    'count_products' => 0,
    'count_products_sale' => 0,
    'main_product' => NULL,
    'min_price_product' => NULL,
    'max_price_product' => NULL,
    'createdon' => NULL,
    'updatedon' => NULL,
    'active' => 1,
  ),
  'fieldMeta' => 
  array (
    'resource_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => true,
      'default' => 0,
    ),
    'min_price' => 
    array (
      'dbtype' => 'decimal',
      'precision' => '12,2',
      'phptype' => 'float',
      'null' => true,
      'default' => 0.0,
    ),
    'max_price' => 
    array (
      'dbtype' => 'decimal',
      'precision' => '12,2',
      'phptype' => 'float',
      'null' => true,
      'default' => 0.0,
    ),
    'average_price' => 
    array (
      'dbtype' => 'decimal',
      'precision' => '12,2',
      'phptype' => 'float',
      'null' => true,
      'default' => 0.0,
    ),
    'count_products' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => 'integer',
      'null' => true,
      'default' => 0,
    ),
    'count_products_sale' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => 'integer',
      'null' => true,
      'default' => 0,
    ),
    'main_product' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'json',
      'null' => true,
    ),
    'min_price_product' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'json',
      'null' => true,
    ),
    'max_price_product' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'json',
      'null' => true,
    ),
    'createdon' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => true,
    ),
    'updatedon' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => true,
    ),
    'active' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'phptype' => 'boolean',
      'null' => true,
      'default' => 1,
    ),
  ),
  'indexes' => 
  array (
    'active' => 
    array (
      'alias' => 'active',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'active' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
);
