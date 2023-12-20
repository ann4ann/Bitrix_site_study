<?php
$arUrlRewrite=array (
  3 => 
  array (
    'CONDITION' => '#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/video/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1&videoconf',
    'ID' => 'bitrix:im.router',
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  22 => 
  array (
    'CONDITION' => '#^/seller-account/my-ads/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/seller-account/my-ads/index.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/online/(/?)([^/]*)#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  14 => 
  array (
    'CONDITION' => '#^/about/vacancies/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/about/vacancies/index.php',
    'SORT' => 100,
  ),
  21 => 
  array (
    'CONDITION' => '#^/announcement/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/announcement/index.php',
    'SORT' => 100,
  ),
  13 => 
  array (
    'CONDITION' => '#^/references/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/references/index.php',
    'SORT' => 100,
  ),
  19 => 
  array (
    'CONDITION' => '#^/about/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/about/news/index.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^/services/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/services/index.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/products/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/products/index.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
);
