<?php
/**
 * @version		$Id:controller.php 1 2015-12-09Z  $
 * @author	   	
 * @package    Pfmobileappws
 * @subpackage Controllers
 * @copyright  	Copyright (C) 2015, . All rights reserved.
 * @license 
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

/**
 * Pfmobileappws Standard Controller
 *
 * @package Pfmobileappws   
 * @subpackage Controllers
 */
class PfmobileappwsController extends JControllerLegacy
{
	/**
	 * @var		string	The default view.
	 * @since   1.6
	 */
	protected $default_view = 'notes';
	
	/**
	 * Method to display a view.
	 *
	 * @param   boolean			If true, the view output will be cached
	 * @param   array  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JController		This object to support chaining.
	 * @since   1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
        $input = JFactory::getApplication()->input;
		$view   = $input->get('view', 'notes');
		$layout = $input->get('layout', 'default');
		$id     = $input->get('id');

		parent::display();
	
		return $this;
	}

}// class
  
?>