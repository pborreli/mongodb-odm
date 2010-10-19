<?php

if ( ! isset($_SERVER['DOCTRINE_COMMON'])) {
    echo <<<EOT

Please copy phpunit.xml.dist to phpunit.xml and provide a path to the Doctrine
Common libraries in the phpunit/php/server node:

    <phpunit ...
      <php>
        <server name="DOCTRINE_COMMON" value="/path/to/doctrine-common/lib" />


EOT;
    exit(1);
}

require_once $_SERVER['DOCTRINE_COMMON'] . '/Doctrine/Common/ClassLoader.php';
require_once __DIR__ . '/Doctrine/ODM/MongoDB/Tests/BaseTest.php';

use Doctrine\Common\ClassLoader;

$classLoader = new ClassLoader('Doctrine\\ODM\\MongoDB\\Tests', __DIR__ . '/../tests');
$classLoader->register();

$classLoader = new ClassLoader('Doctrine\\ODM', __DIR__ . '/../lib');
$classLoader->register();

$classLoader = new ClassLoader('Doctrine\\Common', $_SERVER['DOCTRINE_COMMON']);
$classLoader->register();

$classLoader = new ClassLoader('Symfony\\Component\\Yaml', __DIR__ . '/../lib/vendor');
$classLoader->register();

$classLoader = new ClassLoader('Documents', __DIR__);
$classLoader->register();

$classLoader = new ClassLoader('Stubs', __DIR__);
$classLoader->register();