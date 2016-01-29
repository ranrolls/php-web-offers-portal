<?php
/**
* @version		$Id:default.php 1 2015-12-09 05:18:21Z  $
* @package		Pfmobileappws
* @subpackage 	Controllers
* @copyright	Copyright (C) 2015, . All rights reserved.
* @license 		
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controlleradmin');
jimport('joomla.application.component.controllerform');

/**
 * PfmobileappwsNote Controller
 *
 * @package    Pfmobileappws
 * @subpackage Controllers
 */
class PfmobileappwsControllerNote extends JControllerForm
{
	public function __construct($config = array())
	{
	
		$this->view_item = 'note';
		$this->view_list = 'notes';
		parent::__construct($config);
	}	
	
	/**
	 * Proxy for getModel.
	 *
	 * @param   string	$name	The name of the model.
	 * @param   string	$prefix	The prefix for the PHP class name.
	 *
	 * @return  JModel
	 * @since   1.6
	 */
	public function getModel($name = 'Note', $prefix = 'PfmobileappwsModel', $config = array('ignore_request' => false))
	{
		$model = parent::getModel($name, $prefix, $config);
	
		return $model;
	}	
}// class
?>