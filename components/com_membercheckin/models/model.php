<?php 
/**
* @version		$Id:Model.php  1 2013-06-13Z  $
* @package		Membercheckin
* @subpackage 	Models
* @copyright	Copyright (C) 2013, . All rights reserved.
* @license #
* @Author 		Sudhish
* Last Modification 14 Aug 2013
*/
// no direct access
defined('_JEXEC') or die('Restricted access');
/**
 * Model
 * @author Michael Liebler
 */
 
jimport( 'joomla.application.component.model' );

class MembercheckinModel  extends JModelLegacy { 

  
	/**
	 * Items data array
	 *
	 * @var array
	 */
	protected $_data = null;

	/**
	 * Items total
	 *
	 * @var integer
	 */
	protected $_total = null;

	/**
	 * ID
	 *
	 * @var integer
	 */
	
	protected $_id = null;

	/**
	 * Default Filter
	 *
	 * @var mixed
	 */
	
	protected $_default_filter = null;

	/**
	 * Default Filter
	 *
	 * @var mixed
	 */
	
	protected $_default_table = null;

		
	/**
	 * @var		string	The URL option for the component.	
	 */
	protected $option = null;
		
	/**
	 * @var		string	context	the context to find session data.	
	 */		
	protected $_context = null;		
	
	/**
 	* Constructor
 	*/
	
	public function __construct()
	{
		parent::__construct();
			$app = &JFactory::getApplication('site');
			// Guess the option from the class name (Option)Model(View).
		if (empty($this->option)) {
			$r = null;
			if (!preg_match('/(.*)Model/i', get_class($this), $r)) {
				JError::raiseError(500, JText::_('No Model Name'));
			}
			$this->option = 'com_'.strtolower($r[1]);
		}		
		
		$this->_query = new JQuery; 
		
		$table = $this->getTable();
		if($table) {
			$this->_default_table = $table->getTableName(); 
			if(isset($table->published))  $this->_state_field = 'published';
		}
		
		if (empty($this->_context)) {
			$this->_context = $this->option.'.'.$this->getName();
		}
		
		$array = JRequest :: getVar('cid', array (
			0
		), '', 'array');
		$edit = JRequest :: getVar('edit', true);
		if ($edit) {
			$this->setId((int) $array[0]);
		}
		// Get the pagination request variables
	
		$limit		= $app ->getUserStateFromRequest( $this->_context .'.limit', 'limit', $app->getCfg('list_limit',0), 'int' );
		$limitstart	= $app ->getUserStateFromRequest( $this->_context .'.limitstart', 'limitstart', 0, 'int' );
	
		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);

	}

}	# End of class  
