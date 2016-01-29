<?php 
/**
* @version		$Id:Model.php  1 2013-04-17Z  $
* @package		Pfmobileappws
* @subpackage 	Models
* @copyright	Copyright (C) 2013, . All rights reserved.
* @license #
*/
// no direct access
defined('_JEXEC') or die('Restricted access');
/**
 * Model
 * @author Michael Liebler
 */
 
jimport( 'joomla.application.component.model' );
jimport('onsumaye.webservice.projectsws');


class PfmobileappwsModeltimeloadlist  extends JModel { 

  
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
	  
	
	public function gettimeloadList()
	{
		  $project_id=JRequest::getVar('pid');
		  $projectusers= projectws::timeloadlist($project_id);//call function from library Webservices/projectws
		  
		   echo json_encode($projectusers);
		   exit;
		 
	}
	
	
	
	
	

}  
