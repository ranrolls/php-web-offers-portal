<?php
/**
* @version		$Id: default_modelfrontend.php 96 2011-08-11 06:59:32Z michel $
* @package		Pfmobileappws
* @subpackage 	Models
* @copyright	Copyright (C) 2013, . All rights reserved.
* @license #
*/
 defined('_JEXEC') or die('Restricted access');

global $alt_libdir;
JLoader::import('joomla.application.component.modelitem', $alt_libdir);
jimport('joomla.application.component.helper');

JTable::addIncludePath(JPATH_ROOT.'/administrator/components/com_pfmobileappws/tables');
/**
 * PfmobileappwsModelOauthaccess
 * @author $Author$
 */
 
 
class PfmobileappwsModelOauthaccess  extends JModelItem { 

	
	
	protected $context = 'com_pfmobileappws.oauthaccess';   
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	public function populateState()
	{
		$app = JFactory::getApplication();

		//$params	= $app->getParams();

		// Load the object state.
		$id	= JRequest::getInt('user_id');
		$this->setState('oauthaccess.user_id', $id);

		// Load the parameters.
		//TODO: componenthelper
		//$this->setState('params', $params);
	}

	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id	.= ':'.$this->getState('oauthaccess.user_id');

		return parent::getStoreId($id);
	}
	
	/**
	 * Method to get an ojbect.
	 *
	 * @param	integer	The id of the object to get.
	 *
	 * @return	mixed	Object on success, false on failure.
	 */
	public function &getItem($id = null)
	{
		if ($this->_item === null) {
			
			$this->_item = false;

			if (empty($id)) {
				$id = $this->getState('oauthaccess.user_id');
			}

			// Get a level row instance.
			$table = JTable::getInstance('Oauthaccess', 'Table');


			// Attempt to load the row.
			if ($table->load($id)) {
				
				// Check published state.
				if ($published = $this->getState('filter.published')) {
					
					if ($table->state != $published) {
						return $this->_item;
					}
				}

				// Convert the JTable to a clean JObject.
				$this->_item = JArrayHelper::toObject($table->getProperties(1), 'JObject');
				
			} else if ($error = $table->getError()) {
				
				$this->setError($error);
			}
		}


		return $this->_item;
	}
		
}
?>