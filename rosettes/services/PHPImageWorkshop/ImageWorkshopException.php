<?php

require_once("ImageWorkshopBaseException.php");

/**
 * ImageWorkshopException
 *
 * Manage ImageWorkshop exceptions
 *
 * @link http://phpimageworkshop.com
 * @author Sybio (Clément Guillemain  / @Sybio01)
 * @license http://en.wikipedia.org/wiki/MIT_License
 * @copyright Clément Guillemain
 */
class ImageWorkshopException extends ImageWorkshopBaseException
{
    public static function invalidUnitArgument()
    {
        return new self("Invalid unit value: should be ImageWorkshopLayer::UNIT_PIXEL or ImageWorkshopLayer::UNIT_PERCENT");
    }
}
