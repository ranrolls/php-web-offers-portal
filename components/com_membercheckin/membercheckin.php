<?php
//--No direct access
defined('_JEXEC') or die('=;)');
//error_reporting(E_ALL);ini_set('display_errors',1);



jimport('joomla.application.controller.php');

//require_once( JPATH_COMPONENT.DS.'controller.php' );

jimport('joomla.application.component.model');

//require_once( JPATH_COMPONENT.DS.'models'.DS.'model.php' );


 JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

 JHtml::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . '/helpers');
 
 

// Get an instance of the controller prefixed by HelloWorld
$controller = JControllerLegacy::getInstance('membercheckin');
  
 
// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));
 
  
 
// Redirect if set by the controller
$controller->redirect();

?>
 