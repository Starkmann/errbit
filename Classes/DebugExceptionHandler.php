<?php

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Eike Starkmann <eike.starkmann@posteo.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
namespace Eike\Errbit;

 use Eike\Errbit\Phar\DependencyUtility;
 use TYPO3\CMS\Extbase\Utility\DebuggerUtility;


 class DebugExceptionHandler extends \TYPO3\CMS\Core\Error\DebugExceptionHandler{

     public function __construct()
     {
         DependencyUtility::includePharDependencies();
         parent::__construct();
     }

     /**
     * @param \Exception $exception
     *
     **/
     public function echoExceptionWeb($exception)
     {
         $settings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['errbit']);

         $notifier = new \Airbrake\Notifier([
             'projectId' => $settings['projectId'],
             'projectKey' => $settings['projectKey'],
             'host' => $settings['host'],
             'environment' => 'development'
         ]);

         \Airbrake\Instance::set($notifier);

         $handler = new \Airbrake\ErrorHandler($notifier);
         $handler->register();

         \Airbrake\Instance::notify($exception);

         parent::echoExceptionWeb($exception);
     }


 }
