<?php
/**
 * @package: FreeValuatorApi
 * @link: https://github.com/FreeValuator/FreeValuatorAPI
 * @developer: Free Valuator
 * @email: info@feltkamp.tv
 * @tel: +31 (0) 20 785 4487
 * @website: http://www.freevaluator.com
 * @author: Pim Feltkamp
 * @copyright 2016 Pim Feltkamp
 * @license: http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note: This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
**/

include('../src/freevaluator.class.php');

// Fill in your username
$username = '';

// Fill in your api key
$api_key = '';

// Fill in the Facebook page name or page id where you want to check the worth of
$facebook = '';

$freevaluator = new FreeValuator($username, $api_key);
$page_worth = $freevaluator->facebookPageWorth($facebook);

print_r($page_worth);
