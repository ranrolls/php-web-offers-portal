<?php 

/**
 * @package		Joomla.Site
 * @subpackage	com_membercheckin
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 * @Author		Sudhish Kumar
 */

 if ( $this->user->id > 0 ) {
	 $doc	 = &JFactory::getDocument();
	 $doc->setTitle('Agenda Details');
	 require_once(JPATH_ROOT.DS.'components'.DS.'com_membercheckin'.DS.'views'.DS.'membercheckin'.DS.'tmpl'.DS.'customeheader.php');

	 //$checkinStatusArray = array('0'=>'Today','1'=>'Live','2'=>'Next Up','3'=>'Finish',);		# This array use for checkin status
		
	?>
		<script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/membercheckin.js';?>"></script>
		
		<div class="MainBox">
			<div class="top AddHead" style="width:102.8%">
				<h1 style="padding:5px 20px;">Event Start/Stop</h1>
				<div class="AddEvent">
					<a href="index.php?option=com_membercheckin&view=addevent" style="color:#fff"><i class="icon-plus-sign icon-2x" style="color:#fff"></i>Add Event </a>
				</div>
			</div>
	<?php
		if(count($this->eventsDetail) > 0){
	?>		
			
			  <div id="dplcstatus" style="display:none;"></div>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="allcheckinMember" class="xyz2">
			  <tr>
				<td class="actiontd forcetd">Actions</td>
				<td class="Time forcetd">Start Time</td>
				<td class="Time forcetd">Stop Time</td>  
				<td class="Name forcetd">Company Name</td>
				<td class="checkinStatus forcetd">
					<div>Status</div>
				</td>
			  </tr>
				<?php
				foreach($this->eventsDetail as $eValue){
					$actionDiv = '';
					$editActionDiv = '';
					if($eValue['status'] == '3'){
						$eventRuningStatus = 'finishpp';
						$actionDiv .=  'Finished Presentation';
					}else{
						if($eValue['status'] == '0' || $eValue['status'] == '2'){
						   $editActionDiv .= '<a class="deleteProcEvent" href="javascript:void(0);" style="color:#DC4B33;" onclick="deleteEvent('.$eValue['eventID'].')" Title="Delete"><span class="icon-remove-sign icon-2x"></span></a>';
						}
						if($eValue['status'] != '3'){
							$editActionDiv .= '<a class="editProcEvent" href="javascript:void(0);" onclick="editEventInline('.$eValue['eventID'].','.$eValue['status'].');" Title="Edit"><span class="icon-edit icon-2x"></span></a>';
						}	
						
						if($eValue['status'] == '2'){
							$eventRuningStatus = 'nextpp';
							$buttonValue = 'Go Next';
							$actionDiv .= '<input class="eventaction button" type="button" onclick="eventProcessLive(1,'.$eValue['eventID'].');" value="'.$buttonValue.'"><br/><br/><span class="noteme">Next Presentation /  Edit to change company</span>';
						}elseif($eValue['status'] == '1'){
							$eventRuningStatus = 'livepp';
							$buttonValue = 'Stop';
							$actionDiv .= '<input class="eventaction button" type="button" onclick="eventProcessLive(3,'.$eValue['eventID'].');" value="'.$buttonValue.'"><br/><br/><span class="noteme">Live Presentation / Edit to increase time</span>';
						}else{
							$eventRuningStatus = 'otherpp';
							$buttonValue = 'Next Up';
						}
						
					}
				  ?>
				  <tr id="evntProcess_<?php echo $eValue['eventID'];?>" class="<?php echo $eventRuningStatus;?>">
					<td class="actiontd" id="startStatus_<?php echo $eValue['eventID'];?>">
						<?php echo $editActionDiv; ?>
					</td>
					<td class="Time">
						<div class="fieldvalue3" id="startTimeDiv_<?php echo $eValue['eventID'];?>">
							<span><?php echo date_format(date_create($eValue['start']), 'g:ia');?></span>
						</div>
					</td>
					<td class="Time">
						<div class="fieldvalue3" id="stopTimeDiv_<?php echo $eValue['eventID'];?>">
							<span><?php echo date_format(date_create($eValue['stop']), 'g:ia');?></span>
						</div>
					</td>
					
					<td class="Name" id="companySelectDiv_<?php echo $eValue['eventID'];?>">
						<?php 
						
						$showStyle = ($eValue['status'] == '2' )?' style="display:none"':'';
						echo '<div id="companyShowDiv_'.$eValue['eventID'].'" '.$showStyle.'>'.$eValue['companyName'].'</div><div class="seletcomp">';
						if($eValue['status'] != '1' || $eValue['status'] != '3' ){
							$editShowStyle = ($eValue['status'] != '2' )?' style="display:none"':'';
							echo '<div class="comclass" id="companyEditDiv_'.$eValue['eventID'].'" '.$editShowStyle.'>';
							echo '<select name="companyID" id="companyID" onchange="updateCompanyEventComing(this.value,'.$eValue['eventID'].');" style="padding-right:5px !important;">';
							echo '<option value="">Select Company</option>';
							
								$companyDetail = $this->model->getCompanyList($eValue['companyID']);
								foreach($companyDetail as $comval){
								   $selectComp = ($comval['companyID'] == $eValue['companyID'])?' selected="selected"':'';
								   echo '<option value="'.$comval['companyID'].'" '.$selectComp.'>'.$comval['companyName'].'</option>';
								}
							 echo '</select><br/> <span class="noteme">Option to change Next Up company.</span> ';
						     echo '</div>';
						}
						if($eValue['status'] == '0'){ 
						?>
						  <input style="display:none;" type="hidden" value="0" name="eventStatus_<?php echo $eValue['eventID'];?>" id="eventStatus_<?php echo $eValue['eventID'];?>" />
						  <!--select style="display:none; width:25% !important;" name="eventStatus_<?php echo $eValue['eventID'];?>" id="eventStatus_<?php echo $eValue['eventID'];?>" onchange="eventProcessLiveAdd(this.value,<?php echo $eValue['eventID'];?>);">
							<option value="0" selected="selected">Today</option>
							<option value="1">Live</option>
							<option value="2">Next-Up</option>
						  </select--></div>
						<?php
						}
						?>
					</td>
										
					<td class="checkinStatus" id="checkinStatus_<?php echo $eValue['eventID'];?>">
						<div class="startStatus">
													
							<?php echo $actionDiv; ?>
							
						</div>
					</td>
					
				  </tr>
			  <?php
				}
			  ?>
			  
			</table>
		</div>		
	    <div id="dplecateDivValue" style="display:none;"></div>
	<?php
	}else{
		echo '<div class="noresult">Event not found</div>';
	}
}else{
	$this->app->redirect(JURI::root());
}
?>
