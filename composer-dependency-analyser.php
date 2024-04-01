<?php

/**
 * Dependency analyzer configuration
 * @link https://github.com/shipmonk-rnd/composer-dependency-analyser
 */

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;
use ShipMonk\ComposerDependencyAnalyser\Config\ErrorType;

$config = new Configuration();

return $config
    // ignore errors on specific packages and paths
    ->ignoreErrorsOnPackageAndPath('alex-kalanis/kw_mapper', __DIR__ . '/php-src/search', [ErrorType::DEV_DEPENDENCY_IN_PROD])
    ->ignoreErrorsOnPackageAndPath('alex-kalanis/kw_mapper', __DIR__ . '/php-src/records', [ErrorType::DEV_DEPENDENCY_IN_PROD])
    ->ignoreErrorsOnPackageAndPath('dibi/dibi', __DIR__ . '/php-src/dibi', [ErrorType::DEV_DEPENDENCY_IN_PROD])
    ->ignoreErrorsOnPackageAndPath('doctrine/dbal', __DIR__ . '/php-src/doctrine_dbal', [ErrorType::DEV_DEPENDENCY_IN_PROD])
    ->ignoreErrorsOnPackageAndPath('nette/database', __DIR__ . '/php-src/nette', [ErrorType::DEV_DEPENDENCY_IN_PROD])
    ->ignoreErrorsOnPackageAndPath('illuminate/database', __DIR__ . '/php-src/eloquent', [ErrorType::DEV_DEPENDENCY_IN_PROD])
//    ->ignoreErrorsOnPackageAndPath('yiisoft/db', __DIR__ . '/php-src/yii3', [ErrorType::DEV_DEPENDENCY_IN_PROD])
    ->addPathToExclude(__DIR__ . '/php-src/yii3')
;
