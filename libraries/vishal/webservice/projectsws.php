<?php
/**
 * @package     Joomla.Platform
 * @subpackage  User
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */
defined('_JEXEC') or die('Restricted access');

/**
 * ProjectWs class.  Handles all request for a project 
 *
 * @package     Joomla.Platform
 * @subpackage  User
 * @since       11.1
 */

   class projectws
	{

		/**
		 * Declaration instance
		 * @var string
		 */
		private static $_instance = null;
		
		
		
   
	  /**
	   * Create the singlton instance of same class
	   * @param void
	   * @return object instance of this class
	   * @access public
	   */
	  public static function getInstance(){
		if(null === self::$_instance)
		{
		  self::$_instance = new self();
		}
		return self::$_instance;
	  }
	  /**
	   * @param userid
	   * return json object or array 
	   * 
	   */
	  public static function getProjectDetails($userid)
	  {
		  
		  $db=JFactory::getDBO();
		 // $projectlisting="SELECT PRO.id as project_id,PRO.title, PRO.content,DATE_FORMAT(FROM_UNIXTIME(PRO.cdate), '%m-%d-%Y') as //date,PRO.edate,PRO.email,PDU.name
				//FROM `#__pf_project_members` AS PRM
				//INNER JOIN `#__pf_projects` AS PRO ON PRO.`id` = PRM.`project_id`
				//INNER JOIN  #__users as PDU on PRO.author=PDU.id
				//WHERE PRO.author ='$userid'
				//AND PRO.`approved` =1
				//GROUP BY PRO.title";
//exit;
//exit;

	$projectlisting="SELECT PRO.id as project_id,PRO.title, PRO.content,DATE_FORMAT(FROM_UNIXTIME(PRO.cdate), '%m-%d-%Y') as date,DATE_FORMAT(FROM_UNIXTIME(PRO.edate), '%m-%d-%Y') as edate  , PRO.email,PDU.name
						FROM `#__pf_project_members` AS PRM
						INNER JOIN `#__pf_projects` AS PRO ON PRO.`id` = PRM.`project_id`
						INNER JOIN  #__users as PDU on PRO.author=PDU.id
						WHERE PRO.author ='$userid'
						AND PRO.`approved` =1
						GROUP BY PRO.title";

			$db->setQuery($projectlisting);
			return $projectlist=$db->loadObjectList();

	  }
	   /**
	   * @param projectid
	   * return project members users  json object or array 
	   * 
	   */
	  public function getProjectmem($projectid)
	  {
		  
		  $db=JFactory::getDBO();
		  $projectmembers="SELECT PDM.`project_id`,PDM.`user_id`,PDU.name,PDU.username,PDU.email FROM `#__pf_project_members` AS PDM inner join #__users AS PDU on PDM.`user_id`=PDU.id WHERE `project_id` ='$projectid' AND `readonly_flag` =0 AND `approved` =1 GROUP BY `user_id";
		  $db->setQuery($projectmembers);
			
		  return $projectpeople=$db->loadObjectList();
		  
		  
		  
	  }


	  /* load tasks list of project
	   * @param pid
	   * 
	   * */
	  public function getTasksofProject($project_id)
	  {
		  $db=JFactory::getDBO();
		  $recent=JRequest::getVar('recent');
		  $orderbydeadline=JRequest::getvar('deadline');
		  $priority=JRequest::getVar('priority');
	          
		  if(!empty($recent))

		  {

		    $orderby="t.cdate DESC";
		  }
                   if(!empty($orderbydeadline))
		  {
		     $orderby="t.edate DESC";
		   
		  }
		   if(!empty($priority))
		  {
		     $orderby="t.priority DESC";
		   
		  }	
		  if(empty($recent) && $recent=='' && empty($orderbydeadline) && empty($priority))
		  {
			
  			$orderby="ms.title, t.title DESC";
		  }

          
          $query = "SELECT t. * , DATE_FORMAT( FROM_UNIXTIME( t.edate ) ,  '%m %d, %Y' ) AS deadline,u.name, p.title AS project_title, COUNT( DISTINCT (
			c.id
			) ) AS comments
			FROM pdb_pf_tasks AS t
			LEFT JOIN pdb_pf_milestones AS ms ON ms.id = t.milestone
			LEFT JOIN pdb_pf_projects AS p ON p.id = t.project
			LEFT JOIN pdb_pf_comments AS c ON c.item_id = t.id
			AND c.scope =  'tasks'
			LEFT JOIN pdb_pf_task_users AS tu ON tu.task_id = t.id
			LEFT JOIN pdb_users AS u ON u.id = tu.user_id
			WHERE (
			t.project =  '$project_id'
			) 
			GROUP BY t.id
			ORDER BY ".$orderby ;
		   
		    $db->setQuery($query);
		    return $alltaskslist=$db->loadObjectList();
		  
		  
		  
	  }
		  
		  /* load tasks list of project
		   * @param pid
		   * ti.project_id='$project_id'
		   * */
		  public function timeloadlist($project_id)
		  {
		   $db=JFactory::getDBO();
			  
	     $query = "SELECT ti.*,u.name, t.title, p.title AS project_title, DATE_FORMAT( FROM_UNIXTIME('cdate') , '%d-%m-%Y' ) AS cdate  FROM 
						pdb_pf_time_tracking as ti"
		       . "\n RIGHT JOIN pdb_pf_tasks AS t ON t.id = ti.task_id"
		       . "\n RIGHT JOIN pdb_users AS u ON u.id = ti.user_id"
		       . "\n RIGHT JOIN pdb_pf_projects AS p ON p.id = ti.project_id where ti.project_id ='$project_id' "
		       . "\n GROUP BY ti.id"
		       . "\n ORDER BY ti.cdate ASC " ;
	    	       
		       $db->setQuery($query);
		        return $rows = $db->loadObjectlist();

		  }
		  
    	       /* Assign member tp project
		* @param pid
		*  by vishal
		* */
				   
		public function assignProjectMember()
		{
					
		$db=JFactory::getDBO();
		$project_id =JRequest::getVar('pid'); 
				 
	      $query = "SELECT ti.*  FROM pdb_pf_project_members as ti"
			          . "\n RIGHT JOIN pdb_users AS t ON t.id = ti.user_id "
			          . "\n where ti.project_id ='$project_id' and ti.approved=1";
    	       			$db->setQuery($query);
  				return $rows = $db->loadObjectlist(); 	 
	        }
 
	    /*
	   * function to list file and folders of a project
	   * @param project_id
	   * @param dir
	   * @param ob
	   * @param od
	   * @param keyword
	   * @return dirlist
	   * */
	  public static function fileManager($projectid,$directory, $ob = 'id', $od = 'ASC', $keyword = '')
	  {
		  
		  $db=JFactory::getDBO();
		 //  $filter = " \n AND t.parent_id = ".$db->quote($dir);
		  $filter = " \n  f.project =".$db->quote($projectid)." AND t.parent_id = ".$db->quote($directory);

			if($keyword) {
				$filter .= "\n AND (f.title LIKE ".$db->quote("%$keyword%")." OR f.description LIKE ".$db->quote("%$keyword%").")";
			}

			$query = "SELECT f.*, u.name, u.id AS uid FROM #__pf_folders AS f"
				   . "\n RIGHT JOIN #__pf_folder_tree AS t ON t.folder_id = f.id"
				   . "\n LEFT JOIN #__users AS u ON u.id = f.author WHERE"
				   . $filter
				   . "\n GROUP BY f.id"
				   . "\n ORDER BY f.$ob $od";
				
				   $db->setQuery($query);
				   $rows = $db->loadObjectList();

		
			return $rows;
		  
		  
		  
		  
	  }


	 /*
	   * display all registered members for adding or inviting in a project 
	   * @return as json object containing all registered users 
	   * i.e to be added into a project
	   * 
	   * */
	  public function addProjectmemberList()
	  {
		 
		  $db=JFactory::getDBO();
		  $addprojectmember = "SELECT u.id, u.name, u.username,u.email FROM #__users AS
				 	u where u.block=0 AND u.usertype
 					NOT IN ('Administrator','Super Administrator','Super Users','Adopter')"
		          		 . "\n GROUP BY u.id"
		           		. "\n ORDER by u.name,u.username ASC";
		  
		  $db->setQuery($addprojectmember);
		  return $projectmembers=$db->loadObjectList();
 
	  }
	  
	  
	 /* get project information 
	   * @param project_id
	   * */
	  public function getProjectinfo($project_id)
	  {
		  
		  $db=JFactory::getDBO();
		  $projectinfoquery="select * from #__pf_projects where id='$project_id'";
		  $db->setQuery($projectinfoquery);
		   return $rows=$db->loadObjectList();

		  
		  
		  
	  }	  




  }
		
		
		
		
		
		









































?>
