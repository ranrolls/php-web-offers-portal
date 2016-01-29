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


class PfmobileappwsModelCalander  extends JModel 
{ 

  
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
	  
	  
	/* function to Add Event To Calander project 
	 * 
	 * */
	 
	 public function SaveEvent()
	 
	 {

		$data=JRequest::getVar('fields');
		$savedata=get_object_vars(json_decode($data));

		
		$db=&JFactory::getDBO();
	   	$title=mysql_real_escape_string($savedata['title']) ;	   	
	    	$project= $savedata['title'];
	    	$desc= $savedata['content'];
		$s_hour  = $savedata['shour'];
		$s_min   = $savedata['sminute'];
		$s_ampm  = $savedata['sampm'];
		$e_hour  = $savedata['ehour'];
		$e_min   = $savedata['eminute'];
		$e_ampm  = $savedata['eampm'];
		$edate   = $savedata['edate'];
		$sdate   = $savedata['sdate'];
		$author=$savedata['author'];
		$project=$savedata['pid'] ;
		
		$d = date_parse($sdate);
		$ed=date_parse($edate);

		 $ts_sdate = mktime(0,0,0,$d['month'],$d['day'],$d['year']);
		 $ts_edate = mktime(0,0,0,$ed['month'],$ed['day'],$ed['year']);
		
		$ts_edate =mktime(0,0,0,$month,$day,$year);	       
	 	 $query = "INSERT INTO #__pf_events SET title='$title',content='$desc',
		   	  project='$project', sdate='$ts_sdate', edate='$ts_edate',author='$author'";

   	     	$db->setQuery($query);
		$db->query();
		 	
 		$response['output']='Event Created';
		 
		$arr = array('status' => $response['output']);
	  	 echo json_encode($arr);
		//echo json_encode($response['output']);
		exit;
	
	}


		//For Update Events in Calander Section

		public function updateEvent($data)
		{
		  
		  $db=&JFactory::getDBO();

		  // echo "<pre>";
			//print_r($data);
			//die;

		  $title=$data['title'];
		  $eventid=$data['id'];
		  $content=$data['cont'];
		  $author=$data['author'];
		  $project=$data['project'];
		  $cdata=$data['cdata'];
		  $sdate=$data['sdate'];
		  $edate=$data['edate'];

		  $d = date_parse($sdate);
		  $ed=date_parse($edate);
  		  $cd=date_parse($cdata);

		 $ts_sdate = mktime(0,0,0,$d['month'],$d['day'],$d['year']);
		 $ts_edate = mktime(0,0,0,$ed['month'],$ed['day'],$ed['year']);
		 $ts_cdate = mktime(0,0,0,$cd['month'],$cd['day'],$cd['year']);


		  $updatevenq="UPDATE #__pf_events 
		  set title='$title',content='$content',author='$author',
		  cdate='$ts_cdate',sdate='$ts_sdate',edate='$ts_edate' 
		  where id='$eventid'";
		  
		  $db->setQuery($updatevenq);
		  
		  $result=$db->query();
		 if($result==1)
		{
		$response['output']="Event updated successfully";
		}
		//echo "hello";
		 $arr = array('status' => $response['output']);
		echo json_encode($arr);	
		 exit;
		}
	

		//For Delete Events in Calander Section

		public function deleteEvents()
		{
		$db=&JFactory::getDBO();
		$eventid=JRequest::getVar('eid');
		//$cid = implode(',', $cid);
			 
		$query = "DELETE FROM #__pf_events WHERE id IN($eventid)";
				   $db->setQuery($query);
				   $db->query();
 
			// Load prcess event
		 $response['output']='Event deleted successfully';
		 $arr = array('status' => $response['output']);
	  	 echo json_encode($arr);	
	  	 exit;
		}


	public function displayCalendar($data)
	{
		    $db=&JFactory::getDBO();
		    $project=$data['pid'];
		    $month=$data['month'];
                    $nextmonth=$month+1;
		    $year=$data['year'];
		    ## check event exists for the date 
		    $date=JRequest::getVar('day');
		   


		    // echo "hello";
		    //die;
		    $days_of_month=$num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		    $start_date = mktime(0,0,0,$month,1,$year);
		    
		    $end_date   = mktime(23,59,0,$month,$days_of_month,$year);
		    $rows       = array();
			$events     = array();
			$tasks      = array();
			$milestones = array();
			$projects   = array();
			$syntax="project='$project'";
			//load event
			if($project)
			{
				 $query1 = "SELECT *
						FROM #__pf_events
						WHERE sdate
						BETWEEN '$start_date'
						AND '$end_date'
						AND project = '$project'
						GROUP BY id";
                   $db->setQuery($query1);
                   $events = $db->loadObjectList();
				
				
			}
			if(!is_array($events)) $events = array();
			//echo "<pre>";
			//print_r($events);
			//echo "<pre>";
			//echo "loadmilestone<br>";
			//load milestone
			 $querymilestone = "SELECT * FROM #__pf_milestones"
                   . "\n WHERE edate BETWEEN '$start_date' AND '$end_date'"
		           . "\n AND $syntax"
		           . "\n GROUP BY id";
		           $db->setQuery($querymilestone);
		           $milestones = $db->loadObjectList();
			
			  // print_r($milestones);
			   //load tasks
			  // echo "<pre>";
			//echo "tasks<br>";
			//load milestone
			 $querytasks = "SELECT * FROM #__pf_tasks"
                   . "\n WHERE edate BETWEEN '$start_date' AND '$end_date'"
		           . "\n AND $syntax"
		           . "\n GROUP BY id";
		           $db->setQuery($querytasks);
		           $tasks = $db->loadObjectList();
			
			  // print_r($tasks);
			  //load projects 
                         
			  $query = "SELECT * FROM #__pf_projects"
                   . "\n WHERE edate BETWEEN '$start_date' AND '$end_date'"
		           . "\n AND $syntax"
		           . "\n GROUP BY id";
		           $db->setQuery($query);
		           $projects = $db->loadObjectList();
		           
		           
		           
		           
		           $day        = 1;
		           while ($day <= $days_of_month) 
					{
						$start_date = mktime(0,0,0,$month,$day,$year);
						$end_date   = mktime(23,59,59,$month,$day,$year);
						$rows[$day] = array();
						$rows[$day]['events']     = array();
						$rows[$day]['milestones'] = array();
						$rows[$day]['tasks']      = array();
						$rows[$day]['projects']   = array();
						
						
						// Add events
						foreach ($events AS $r)
						{

							if(count($events)>0)
							{
							if($r->sdate >= $start_date && $r->sdate <= $end_date) $rows[$day]['events'][] = 1;

}
						

						}
						// Add milestones
						foreach ($milestones AS $r)
						{
							if(count($milestones)>0)
							{
							if($r->edate >= $start_date && $r->edate <= $end_date) $rows[$day]['milestones'][] = 1;

}
			
						
						}
						// Add tasks
						foreach ($tasks AS $r)
						{

							if(count($tasks))
							{
							if($r->edate >= $start_date && $r->edate <= $end_date) $rows[$day]['tasks'][] = 1;
							}
							



						}
						// Add projects
						if(count($projects)>0)
						{
						foreach ($projects AS $r)
						{
							if(count($projects)>0)
							{
							
							if($r->edate >= $start_date && $r->edate <= $end_date) $rows[$day]['projects'][] =1;
						        }






						}
						}
						$day++;
						
						
						
					}
			
					//echo  "<pre>";
					//print_r($rows);
					//$object = $this->arrayToObject($rows);
					//print_r($object);
					echo json_encode($rows);
					exit;


		
	}


// function to conver array into object

	public  function arrayToObject($d) {
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return (object) array_map(__FUNCTION__, $d);
		}
		else {
			// Return object
			return $d;
		}
	}
	



}
