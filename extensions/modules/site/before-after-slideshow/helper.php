<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_before_after_slideshow
 *
 * @copyright   Copyright (C) 2015 Iván Ramos Jiménez. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Helper for mod_before_after_slideshow
 *
 * @package     Joomla.Site
 * @subpackage  mod_before_after_slideshow
 * @since       1.6
 */
abstract class ModBeforeAfterSlideshowHelper
{
	/**
	 * Retrieve a list of article
	 *
	 * @param   \Joomla\Registry\Registry  &$params  module parameters
	 *
	 * @return  mixed
	 *
	 * @since   1.6
	 */
	public static function getList(&$params)
	{
		$list = array();
		
		for ($i=1;$i<=10;$i++)
		{
		
			if (strlen($params->get('image'.$i.'_before')) > 0 && strlen($params->get('image'.$i.'_after')) > 0)
			{
				$item[0] = $params->get('image'.$i.'_before');
				$item[1] = $params->get('image'.$i.'_after');
				$list[] = $item;
			}
		}
		
		return $list;
	}
}
