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

JHtml::_('script', 'media/com_contenthistory/js/show_diff.js', array('version' => 'auto', 'relative' => true));

$path = JURI::root(true). "/media/com_contenthistory/js/show_diff.js";
$path2 = JURI::root(true). "/media/com_contenthistory/js/diff_match_patch.js";

$document    = JFactory::getDocument();
$this->eName = JFactory::getApplication()->input->getCmd('e_name', '');
$this->eName = preg_replace('#[^A-Z0-9\-\_\[\]]#i', '', $this->eName);

$document->setTitle(JText::_('COM_CONTENT_PAGEBREAK_DOC_TITLE'));

//$version2 = $this->items[0];
//$version1 = $this->items[1];
$object1 = ['Hallo','Welt'];//$version1->data;
$object2 = ['Hallo', 'Welt', 'das', 'ist', 'neu'];//$version2->data;
$temp = JHtml::addIncludePath(JUri::root(true) . '/administrator/components/com_contenthistory/helpers/html');
//foreach($temp as $item){
//    echo($item . '<br>');
//}
//JHtml::_('textdiff', 'diff');

require_once ('C:\xampp\htdocs\joomla-cms\administrator\components\com_contenthistory\helpers\html\textdiff.php');

JFactory::getDocument()->addScriptDeclaration("
	(function ($){
		$(document).ready(function (){
            jQuery('.diffhtml, .diffhtml-header').hide();
        });
	})(jQuery);
"
);
?>
<!--<script type="text/javascript" src="--><?//=$path2?><!--"></script>-->
<div id="diff_area" class="container-popup" style="height: auto">
<?php
    foreach ($object1 as $name => $value) : ?>
        <?php $rowClass = ($value->value == $object2->$name->value) ? 'items-equal' : 'items-not-equal'; ?>
        <ul>
            <li><strong><?php echo $value->label; ?></strong></li>
            <li class="originalhtml" style="display:none" ><?php echo htmlspecialchars($value->value); ?></li>
            <?php $object2->$name->value = is_object($object2->$name->value) ? json_encode($object2->$name->value) : $object2->$name->value; ?>
            <li class="changedhtml" style="display:none" ><?php echo htmlspecialchars($object2->$name->value, ENT_COMPAT, 'UTF-8'); ?></li>
            <li class="original"><?php echo $value->value; ?></li>
            <li class="changed"><?php echo $object2->$name->value; ?></li>
        </ul>
    <?php endforeach; ?>

</div>
<!--<script type="text/javascript" src="--><?php ?><!--"></script>-->


