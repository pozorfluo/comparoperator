<?php
declare(strict_types=1);
namespace Helpers;
/**
 * 
 */
class Config
{
    /**
     * @var array 
     */
    const db = array (
  'comparoperator' => 
  array (
    'DB_DRIVER' => 'mysql',
    'DB_HOST' => '127.0.0.1',
    'DB_PORT' => '3306',
    'DB_NAME' => 'tp_comparoperator',
    'DB_CHARSET' => 'utf8mb4',
    'DB_USER' => 'root',
    'DB_PASSWORD' => '!dummypass!',
  ),
);
    
    /**
     * @var array 
     */
    const components = array (
  'Templates' => 
  array (
    'InlinedCss' => 1,
    'Nav' => 1,
    'Footer' => 1,
    'Fonts' => 1,
    'Table' => 1,
    'Image' => 1,
    'Console' => 1,
    'InlinedJs' => 1,
    'GlobalsDump' => 1,
    'LocationCard' => 1,
  ),
  'Controllers' => 
  array (
    'ComparOperatorAPI' => 1,
    'Dashboard' => 1,
    'Home' => 1,
  ),
  'Views' => 
  array (
    'OfferingList' => 1,
    'AdminDashboard' => 1,
    'Error404' => 1,
    'OperatorDashboard' => 1,
    'Home' => 1,
  ),
  'Models' => 
  array (
    'DBPDO' => 1,
    'ComparOperatorAPI' => 1,
  ),
  'Endpoints' => 
  array (
    'UserEndpoint' => 1,
    'DestinationEndpoint' => 1,
    'OperatorEndpoint' => 1,
  ),
  'Helpers' => 
  array (
    'Utilities' => 1,
    'Config' => 1,
    'PseudoCron' => 1,
    'DB' => 1,
    'Dispatcher' => 1,
    'Cache' => 1,
    'AutoLoader' => 1,
    'CacheItem' => 1,
    'AutoConfig' => 1,
    'DebugInfo' => 1,
    'GlobalsDump' => 1,
    'SerializeConfig' => 1,
    'QueryString' => 1,
  ),
  'Entities' => 
  array (
    'Location' => 1,
    'Generic' => 1,
    'Operator' => 1,
    'User' => 1,
    'Offering' => 1,
    'Review' => 1,
  ),
  'Layouts' => 
  array (
    'Minimal' => 1,
    'Dashboard' => 1,
    'Home' => 1,
  ),
);
}