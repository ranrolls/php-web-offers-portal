 <?php
/**
* @version		$Id:note.php  1 2015-12-09 05:18:21Z  $
* @package		Pfmobileappws
* @subpackage 	Tables
* @copyright	Copyright (C) 2015, . All rights reserved.
* @license #
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
* Jimtawl TableNote class
*
* @package		Pfmobileappws
* @subpackage	Tables
*/
class TableNote extends JTable
{

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.0
	 */
	public function __construct(& $db) 
	{
		parent::__construct('#__user_notes', 'id', $db);
	}

	/**
	* Overloaded bind function
	*
	* @acces public
	* @param array $hash named array
	* @return null|string	null is operation was satisfactory, otherwise returns an error
	* @see JTable:bind
	* @since 1.5
	*/
	public function bind($array, $ignore = '')
	{ 
		
		return parent::bind($array, $ignore);		
	}

	/**
	 * Overloaded check method to ensure data integrity
	 *
	 * @access public
	 * @return boolean True on success
	 * @since 1.0
	 */
	public function check()
	{		
		if (!$this->created_time) {
			$date = JFactory::getDate();
			$this->created = $date->format("Y-m-d H:i:s");
		}
		/** check for valid name */
		/**
		if (trim($this->subject) == '') {
			$this->setError(JText::_('Your Note must contain a subject.')); 
			return false;
		}
		**/		

		return true;
	}
}
 