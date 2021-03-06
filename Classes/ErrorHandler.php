<?php
namespace Eike\Errbit;
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

use Errbit\Errbit;
use ErrorException;
use TYPO3\CMS\Core\Error\Exception;


class ErrorHandler extends \TYPO3\CMS\Core\Error\ErrorHandler
{


    /**
     * @param int $errorLevel
     * @param string $errorMessage
     * @param string $errorFile
     * @param int $errorLine
     * @throws Exception
     */
    public function handleError($errorLevel, $errorMessage, $errorFile, $errorLine)
    {
        $settings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['errbit'], false);
        if (isset($settings['apiKey'], $settings['host'])) {
            Errbit::instance()
                ->configure([
                    'api_key' => $settings['apiKey'],
                    'host' => $settings['host'],
                    'port' => $settings['port'],
                ])->start();
            Errbit::instance()->notify(new ErrorException($errorMessage, 1492000587, $errorLevel, $errorFile,
                $errorLine));
        }

        parent::handleError($errorLevel, $errorMessage, $errorFile, $errorLine);
    }


}
