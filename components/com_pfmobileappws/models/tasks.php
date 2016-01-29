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
 * @author Vishal Kumar
 */
 
jimport( 'joomla.application.component.model' );
jimport('vishal.webservice.projectsws');


class PfmobileappwsModelTasks  extends JModel { 

  
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
	

          public function getProductDetails()
	   { 
		 $product_id=JRequest::getVar('product_id'); 
		 $productlist= projectws::getTasksofProject($product_id);
		 echo json_encode($productlist);
		 exit;
		
	     }




	public function getTasks()
	{
		

		$projectid=JRequest::getVar('pid');
		$tasklist= projectws::getTasksofProject($projectid);
		echo json_encode($tasklist);
		exit;
		
	}

	/* load Task information
			*/
	public function loadTaskinfo()
	 {
	 		
	  $task_id=JRequest::getVar('tid');
	  $db=&JFactory::getDBO();
	  $taskinfo="select id,title,content,author,project,DATE_FORMAT(FROM_UNIXTIME(cdate), '%m %d, %Y') as cdate,
	  DATE_FORMAT(FROM_UNIXTIME(sdate), '%m %d, %Y') as sdate ,
	  DATE_FORMAT(FROM_UNIXTIME(mdate), '%m %d, %Y') as mdate ,
	   DATE_FORMAT(FROM_UNIXTIME(edate), '%m %d, %Y') as edate ,progress,priority,milestone,ordering
	  from #__pf_tasks where id='$task_id'";
	  $db->setQuery($taskinfo);
	  $rows=$db->loadObject();
	 $arr=array($rows);
	 echo json_encode($arr);
	 exit;
	 
          
	}	


		
	
       public function getTaskdelete() //as task delete
	{		  
		 $db=&JFactory::getDBO();
		 $taskid=JRequest::getVar('tid');
		  $deletetask="Delete from #__pf_tasks where id='$taskid'";
 		$db->setQuery($deletetask);
		 $delete= $db->query();
		 //echo  $query = "DELETE FROM pdb_pf_tasks WHERE id ='$taskid' ";
 		  $deletetaskmem="Delete from #__pf_task_users where task_id='$taskid'";
		 $db->setQuery($deletetaskmem);
		 $memberdeleted=$db->query();
		 $response['output']='task deleted successfully';
		 $arr = array('status' => $response['output']);
	  	 echo json_encode($arr);	
	  	 exit;
	   
	}

  

	/*
	 function to create new task in a project 
	*/
	public function savenewTasks($data)
	{
		 
		 $db=&JFactory::getDBO();
		 // create new tasks
		 //echo "<pre>";
		// print_r($data);
		 $title=$data['title'];
		 $desc=$data['desc'];
		 $author=$data['author'];
		 $project=$data['pid'];
		 $cdate=$data['cdate'];
		 $mdate=$data['mdate'];
		 $sdate=$data['sdate'];
		 $edate=$data['edate'];
		 $progress=$data['progress'];
		 $priority=$data['priority'];
		 $milestone=$data['milestone'];
		 $ordering=$data['ordering'];
		 $assigneduser=$data['assingmem'];

		  $taskaddquery="INSERT INTO #__pf_tasks set title='$title',content='$desc',author='$author',project='$project',
		 cdate='$cdate',mdate='$mdate',sdate='$sdate',edate='$edate',progress='$progress',priority='$priority',milestone='$milestone',
		 ordering='$ordering'";
		 $db->setQuery($taskaddquery);
		 $db->query();
		 $task_id = $db->insertid();
		 if(!empty($assigneduser))
		 {
			 for($i=0;$i<count($assigneduser);$i++)
			 {
				 $users=$assigneduser[$i];
				 $taskassign="INSERT INTO #__pf_task_users set task_id='$task_id',user_id='$users',sdate='$sdate',edate='$edate'";
				 $db->setQuery($taskassign);
				 $db->query();
				 
			 }
		}
		  $response['output']='task added successfully';
		 $arr = array('status' => $response['output']);
	  	 echo json_encode($arr);	
		 
		exit;
		
		
	}

	
		/*
		function to Update  task in a project 
		*/	
		public function getUpdateTask() //as task Update
		{
			 $updatefields=json_decode(JRequest::getVar('fields'),true);
			  //echo "<pre>";
			 // print_r($updatefields);
			  
			  $taskid=$updatefields['tid'];
			  $title=$updatefields['title'];
			  $has_deadline=$updatefields['has_deadline'];
			  $desc=$updatefields['content'];
			  //$project=$updatefields['project'];
			  $priority=$updatefields['priority'];
			  $milestone=$updatefields['milestone'];
			  $progress=$updatefields['progress'];
			  
			  if($has_deadline===1)
			  {
			    $edate=$updatefields['edate'];
			    $hour=$updatefields['hour'];
			    $minute=$updatefields['minute'];
			    $projectenddate=$updatefields['edata'];
			//echo date('m/d/Y h:i:s',$projectenddate);
			  }
			  else
			  {
			    $edate=0;
			  }
			  $cdate=$updatefields['cdate'];	
			   
			  $db=&JFactory::getDBO();
		 	       
					       	// Update the task
			  $projectupdatequery = "UPDATE #__pf_tasks SET title = '$title', content = '$desc',"
				       . "\n edate = '$projectenddate',"
				       . "\n progress = '$progress', milestone = '$milestone',"
				       . "\n priority = '$priority'"
				       . "\n WHERE id = '$taskid' " ;
				       
			 $db->setQuery($projectupdatequery);
			 $result=$db->query();
			 if($result==1)
			 {
				$response['output']="Task updated successfully";
			 }
			  //echo "hello";
			  $arr = array('status' => $response['output']);
			  echo json_encode($arr);	
			  exit;
			  		
		 
	        }
				

	public function getMilestone($project_id)
	{
	
	  if(!empty($project_id))	
	  {
	   $db=&JFactory::getDBO();
	    $query="select id,title from #__pf_milestones where project='$project_id'";
	   $db->setQuery($query);
	   $rows=$db->loadObjectList();
	   echo json_encode($rows);
	   }
	   exit;
	}

}  
