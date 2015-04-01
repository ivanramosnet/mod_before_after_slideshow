<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_before_after_slideshow
 *
 * @copyright   Copyright (C) 2015 Iván Ramos Jiménez. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$list            = ModBeforeAfterSlideshowHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_before_after_slideshow', $params->get('layout', 'default'));
