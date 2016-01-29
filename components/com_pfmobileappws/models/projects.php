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


class PfmobileappwsModelProjects  extends JModel { 

  
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
	
	public function getProjectlistsws()
	{
		        $userid=JRequest::getVar('uid');
			$projectlist= projectws::getProjectDetails($userid);
			 echo json_encode($projectlist);
			 exit;
		
	}

		
	/* function to save project 
	 * 
	 * */
	 
	public function saveProject($data)
	{
		
			$savedata=get_object_vars(json_decode($data));
			//echo "<pre>";
			//print_r($savedata);die;
			$db=&JFactory::getDBO();
		
			 $title=mysql_real_escape_string($savedata['title'])	;
			
			// check whether project exists or not 
			$projectexistsqury="select * from #__pf_projects where title='$title'";
			$db->setQuery($projectexistsqury);
			$rows=$db->loadObject();
			$response=array();
			if(count($rows)>0)
			{
				$response['output']='project exist';
			}
			else
			{
			
					$has_deadline=$savedata['has_deadline'];
					if($has_deadline=='yes' || $has_deadline=='')
					{
						$edata=strtotime($savedata['edate']);
					}
					else
					{
							$edata='';
					}
					$description=$savedata['desc'];
					$website=$savedata['website'];
					$email=$savedata['email'];
					$author=$savedata['user_id'];
					$querycreateproj="INSERT INTO #__pf_projects
							   SET title='$title',content='$description',author='$author'
							   ,website='$website',
							   email='$email',cdate='$edata',`approved` = '1' ";
			                
				
				    	$db->setQuery($querycreateproj);
				    	$db->query();
					$project_id = $db->insertid();	
					// add project members 
					//$insertprojmem="INSERT INTO #__pf_project_members SET project_id='".."',user_id='$userid'";
					if(!empty($savedata['member']))
					{
						$members=$savedata['member'];
						foreach($members as $val=>$mem)
						{
							
						   $insertprojmem="INSERT INTO #__pf_project_members SET   project_id='$project_id',user_id='$mem',approved=1,readonly_flag=0";
							$db->setQuery($insertprojmem);
							$db->query();
						
						
						}
					}
					
				
			       $response['output']='project created';
			
		   }
		   
	         $arr = array('status' => $response['output']);
	  	 echo json_encode($arr);
		//echo json_encode($response['output']);
		exit;
			
			
				
	}

	/* load project information


	*/
	public function loadProjectinfo()
	{
	 
	  $project_id=JRequest::getVar('pid');
	  $db=&JFactory::getDBO();
	  $projectinfo="select * from #__pf_projects where id='$project_id'";
	  $db->setQuery($projectinfo);
	  $rows=$db->loadObject();
	  echo json_encode($rows);
	  exit;


	}

	/*
	
		function to updte project
	*/
	
	public function updateproject()
	{
		
	  $updatefields=json_decode(JRequest::getVar('fields'),true);

	 
	  $project_id=$updatefields['id'];
	  
	  $title=$updatefields['title'];
	  $has_deadline=$updatefields['has_deadline'];
	  $desc=$updatefields['content'];
	  $website=$updatefields['website'];
	  $email=$updatefields['email'];
	  $author=$updatefields['author'];
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
	  $projectupdatequery="update #__pf_projects set 
			       title='$title',content='$desc',author='$author',website='$website',email='$email',
			       edate='$projectenddate'
			       where id='$project_id'";
	 $db->setQuery($projectupdatequery);
	 $result=$db->query();
         if($result==1)
	 {
		$response['output']="Project updated successfully";
	 }
	  //echo "hello";
	  $arr = array('status' => $response['output']);
	  echo json_encode($arr);	
	  exit;
          
	  
	}

	/* delete project 
	 * */
	 function DeleteProject()
	 {
		 $db=&JFactory::getDBO();
		 
		 $project_id=JRequest::getVar('pid');
		 $deleteproj="Delete from #__pf_projects where id='$project_id'";
		 $db->setQuery($deleteproj);
		 $delete= $db->query();
		 $deleteprojmem="Delete from #__pf_project_members where project_id='$project_id'";
		 $db->setQuery($deleteprojmem);
		 $memberdeleted=$db->query();
		 $response['output']='project deleted successfully';
		 $arr = array('status' => $response['output']);
	  	 echo json_encode($arr);	
	  	 exit;
		 
	 }
	
	

}  
