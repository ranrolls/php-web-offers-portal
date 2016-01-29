<?php
/**
 * @version 1.0
 * @package    joomla
 * @subpackage Pfmobileappws
 * @author	   	
 *  @copyright  	Copyright (C) 2015, . All rights reserved.
 *  @license 
 */

//--No direct access
defined('_JEXEC') or die('Resrtricted Access');

require_once JPATH_COMPONENT.'/helpers/route.php';

$controller = JControllerLegacy::getInstance('pfmobileappws');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();