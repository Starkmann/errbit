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
    
class DebugExceptionHandler extends \TYPO3\CMS\Core\Error\DebugExceptionHandler{
     
     public function __construct()
     {
         DependencyUtility::includePharDependencies();
         parent::__construct();
     }
     
     /**
     * Formats and echoes the exception as XHTML.
     *
     * @param \Exception|\Throwable $exception The exception object
     * @return void
     * @TODO #72293 This will change to \Throwable only if we are >= PHP7.0 only
     */
     public function echoExceptionWeb($exception) {
        die("Hallo");
     }

     
     
     
 }