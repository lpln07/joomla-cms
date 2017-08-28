<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Editors-xtd.pagebreak
 *
 * @copyright   Copyright (C)2017 - Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
use \Joomla\CMS\MVC\Model\BaseModel;
//use \Joomla\CMS\Helper\ContentHistoryHelper;
JLoader::register('ContenthistoryHelper', JPATH_ADMINISTRATOR . '/components/com_contenthistory/helpers/contenthistory.php');
/**
 * Editor showdiff button
 *
 * @since  1.5
 */
class PlgButtonShowdiff extends JPlugin
{
	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $autoloadLanguage = true;

	/**
	 * Display the button
	 *
	 * @param   string  $name  The name of the button to add
	 *
	 * @return  JObject  The button options as JObject
	 *
	 * @since   1.5
	 */
	public function onDisplay($name)
	{
		$input = JFactory::getApplication()->input;
		BaseModel::addIncludePath(JPATH_ADMINISTRATOR . '/' . 'components' . '/' . 'com_contenthistory' . '/' . 'models');
		/** @var ContenthistoryModelHistory $contentHistory */
		$contentHistory= BaseModel::getInstance('History', 'ContenthistoryModel');
		$itemId = $contentHistory->getState('item_id', $input->get('id'));
		$typeId = $contentHistory->getState('type_id', 5);
		if($itemId === 0){
			$itemId= $input->get('id');
		}
		if($typeId === 0){
			$typeId = 1;
		}
		$contentHistory->setState('item_id', $itemId);
		$contentHistory->setState('type_id', $typeId);
		$dbobject =$contentHistory->getItems()[1];
		$object = new stdClass;
		$object = ContenthistoryHelper::decodeFields($dbobject->version_data);

		$user = JFactory::getUser();

		if ($user->authorise('core.create', 'com_content')
			|| $user->authorise('core.edit', 'com_content')
			|| $user->authorise('core.edit.own', 'com_content'))
		{
			JFactory::getDocument()->addScriptOptions('xtd-showdiff', array('editor' => $name));

			$link = 'index.php?option=com_content&amp;view=article&amp;layout=showdiff&amp;tmpl=component&amp;e_name=' . $name;

			$button          = new JObject;
			$button->modal   = true;
			$button->class   = 'btn';
			$button->link    = $link;
			$button->text    = JText::_('PLG_EDITORSXTD_SHOWDIFF_BUTTON_SHOWDIFF');
			$button->name    = 'showdiff';
			$button->options = "{handler: 'iframe', size: {x: 500, y: 300}}";

			return $button;
		}
	}

}
