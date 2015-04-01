<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_before_after_slideshow
 *
 * @copyright   Copyright (C) 2015 Iván Ramos Jiménez. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::stylesheet('mod_before_after_slideshow/style.min.css', array(), true);
JHtml::script('mod_before_after_slideshow/script.min.js', false, true);

$accessibility = $params->get("accessibility", 1)?"true":"false";
$setGallerySize = $params->get("setGallerySize", 1)?"true":"false";
$resize = $params->get("resize", 1)?"true":"false";
$contain = $params->get("contain", 0)?"true":"false";
$imagesLoaded = $params->get("imagesLoaded", 1)?"true":"false";
$percentPosition = $params->get("imagesLoaded", 0)?"true":"false";
$rightToLeft = $params->get("rightToLeft", 0)?"true":"false";
$draggable = $params->get("draggable", 0)?"true":"false";
$freeScroll = $params->get("freeScroll", 1)?"true":"false";
$wrapAround = $params->get("wrapAround", 1)?"true":"false";
$prevNextButtons = $params->get("prevNextButtons", 1)?"true":"false";
$pageDots = $params->get("pageDots", 1)?"true":"false";

$document = JFactory::getDocument();
$document->addScriptDeclaration('
	jQuery(document).ready(function(){
		jQuery(".main-gallery").flickity({
			cellSelector: "' . $params->get("cellSelector") . '",
			initialIndex: ' . $params->get("initialIndex") . ',
			accessibility: ' . $accessibility . ',
			setGallerySize: ' . $setGallerySize . ',
			resize: ' . $resize . ',
			cellAlign: "' . $params->get("cellAlign") . '",
			contain: ' . $contain . ',
			imagesLoaded: ' . $imagesLoaded . ',
			percentPosition: ' . $percentPosition . ',
			rightToLeft: ' . $rightToLeft . ',
			draggable: ' . $draggable . ',
			freeScroll: ' . $freeScroll . ',
			wrapAround: ' . $wrapAround . ',
			autoPlay: ' . $params->get("autoPlay") . ',
			watchCSS: ' . $params->get("watchCSS") . ',
			asNavFor: "' . $params->get("asNavFor") . '",
			prevNextButtons: ' . $prevNextButtons . ',
			pageDots: ' . $pageDots . '
		});
	});
');
 
$document->addStyleDeclaration('
	.gallery-cell {
	  width: 100%; /* full width */
	  height: '.$params->get("height").'; /* height of gallery */
	}
');

?>
<div class="main-gallery <?php echo $moduleclass_sfx; ?>">
<?php foreach ($list as $item) :  ?>
	<div class="gallery-cell">
		<div class="ba-slider">
			<img src="<?php echo $item[0]; ?>">
			<div class=" resize">
				<img src="<?php echo $item[1]; ?>">
			</div>
			<span class="handle"></span>
		</div>
	</div>
<?php endforeach; ?>
</div>
