<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.core');
JHtml::_('behavior.polyfill', array('event'), 'lt IE 9');
JHtml::_('script', 'com_content/admin-article-showdiff.min.js', array('version' => 'auto', 'relative' => true));

JHtml::_('script', 'com_contenthistory/show_diff.js', array('version' => 'auto', 'relative' => true));
$temp = JHtml::_('stylesheet', 'com_contenthistory/jquery.pretty-text-diff.css', array('version' => 'auto', 'relative' => true));

$path = JURI::root(true). "/media/com_contenthistory/js/show_diff.js";
$path2 = JURI::root(true). "/media/com_contenthistory/js/diff_match_patch.js";

$document    = JFactory::getDocument();
$this->eName = JFactory::getApplication()->input->getCmd('e_name', '');
$this->eName = preg_replace('#[^A-Z0-9\-\_\[\]]#i', '', $this->eName);

$document->setTitle(JText::_('COM_CONTENT_PAGEBREAK_DOC_TITLE'));



?>
<script type="text/javascript" src="<?=$path2?>"></script>
<div id="diff_area" class="container-popup" style="height: auto">
</div>
<script type="text/javascript" src="<?=$path?>"></script>


