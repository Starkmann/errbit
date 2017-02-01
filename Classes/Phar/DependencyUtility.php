<?php

/**
 * This file is part of the TYPO3 CMS project.
*
* ©2017 Felix Althaus <felix.althaus@undkonsorten.com>
*
* It is free software; you can redistribute it and/or modify it under
* the terms of the GNU General Public License, either version 2
* of the License, or any later version.
*
* For the full copyright and license information, please read the
* LICENSE.txt file that was distributed with this source code.
*
* The TYPO3 project - inspiring people to share!
*/
 
 
namespace Eike\Errbit\Phar;
 
 
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
 
class DependencyUtility
{
     
    final private function __construct()
    {
        throw new \Exception(sprintf('Class %s is not meant to be instantiated', __CLASS__), 1485456893);
    }
     
    static public function includePharDependencies()
    {
        /** @noinspection PhpIncludeInspection */
        @include_once 'phar://' . ExtensionManagementUtility::extPath('errbit') . 'Libraries/errbit-php.phar/vendor/autoload.php';
    }
}

