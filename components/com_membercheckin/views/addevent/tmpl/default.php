<?php 

/**
 * @package		Joomla.Site
 * @subpackage	com_membercheckin/Addevent
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 * @Author		Sudhish Kumar
 */

 if ( $this->user->id > 0 ) {

require_once(JPATH_ROOT.DS.'components'.DS.'com_membercheckin'.DS.'views'.DS.'membercheckin'.DS.'tmpl'.DS.'customeheader.php');
?>
	<script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/jquery.validate.min.js';?>"></script>
	<script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/membercheckin.js';?>"></script>
	<script>
	/*Custom Jquery function to form validate*/
	jQuery(function() {

		jQuery.validator.addMethod("costomTime", function(value, element) {
			return this.optional(element) || /^(0?[1-9]|1[012])(:[0-5]\d) [Pp][mM]$/.test(value);
		}, "Please enter valid time like hh:mm pm.");
		
	});
	
	jQuery(document).ready(function(){
		jQuery("#addEventfrm").validate(); 
	});
	
	
	</script>

	<div class="AddHead">
	<h1 style="padding:5px 20px;"><?php echo ucfirst($this->optMode);?> Event</h1>
	</div>
	<br/>

	<div class="eventForm">
		<form name="addEventfrm" id="addEventfrm" method="post" action="" onsubmit="">
			<input type="hidden" name="eventID" id="eventID" value="<?php echo $this->eventID;?>" />
			<input type="hidden" name="optMode" value="<?php echo $this->optMode;?>" />
			<!--div class="maintb">
				<div class="fieldLabel">
					Session (Title)<span>*</span>
				</div>
				<div class="fieldinput">
					<input type="text" name="title" id="title" class="required" value="<?php echo $this->title;?>" title="Please enter valid session title"/>
				</div>
				<?php
				if(!empty($this->saveRespons['title'])){
					echo '<div class="errorMsg">'.$this->saveRespons["title"].'</div>';
				}
				?>
			</div-->
			
			<div class="maintb">
				<div class="fieldLabel">
					Company Name<span>*</span>
				</div>
				<div class="fieldinput">
					<select name="companyID" id="companyID" class="required" title="Please select valid company">
						<option value="">Select company</option>
						<?php
						foreach($this->companyDetail as $cValue){
							$cselectClass = ($cValue['companyID'] == $this->companyID)?'selected="selected"':'';
							echo '<option value="'.$cValue['companyID'].'" '.$cselectClass.'>'.$cValue['companyName'].'</option>';
						}
						?>
					</select>
				</div>
				<?php
				if(!empty($this->saveRespons['companyName'])){
					echo '<div class="errorMsg">'.$this->saveRespons["companyName"].'</div>';
				}
				?>
			</div>
			
			<!--div class="maintb">
				<div class="fieldLabel">
					Presenter Name<span>*</span>
				</div>
				<div class="fieldinput">
					<select name="userID" id="userID" class="required" title="Please select valid presenter">
						<option value="">Select Presenter</option>
						<?php
						foreach($this->presenterDetail as $pVal){
							$pselectClass = ($pVal["id"] == $this->userID)?'selected="selected"':'';
							echo '<option value="'.$pVal["id"].'" '.$pselectClass.'>'.$pVal["name"].'</option>';
						}
						?>
					</select>
				</div>
				<?php
				if(!empty($this->saveRespons['presenter'])){
					echo '<div class="errorMsg">'.$this->saveRespons["presenter"].'</div>';
				}
				?>
			</div-->
			
			<div class="maintb">
				<div class="fieldLabel">
					Start Time<span>*</span>
				</div>
				<div class="fieldinput">
					<!--span class="examp">[Example: hh:mm pm]</span-->
					<!--input type="text" name="startTime" id="startTime" value="<?php echo $this->startTime;?>" class="required costomTime" title="Please enter valid event start time like hh:mm pm" onblur="checkEventTime();" /-->
					<select name="startHour" id="startHour" onchange="checkEventTimeAdd();" style="width:24% !important;padding-right:5px;">
						<option value="">HH</option>
						<?php
						for($i=1; $i<=12; $i++){
							$hVal = sprintf("%02s", $i);
							$selectHcls = ($this->startHour == $hVal)?' selected="selected"':'';
							echo '<option value="'.$hVal.'" '.$selectHcls.'>'.$hVal.'</option>';
						}
						?>
					</select>
					<select name="startMin" id="startMin" onchange="checkEventTimeAdd();" style="width:24% !important;padding-right:5px !important;">
						<option value="">MM</option>
						<?php
						for($i=0; $i<=59; $i++){
							$hVal = sprintf("%02s", $i);
							$selectMcls = ($this->startMin == $hVal)?' selected="selected"':'';
							echo '<option value="'.$hVal.'" '.$selectMcls.'>'.$hVal.'</option>';
						}
						?>
					</select>
					
					<select name="startLfix" id="startLfix" onchange="checkEventTimeAdd();" class="required" style="width:23% !important">
						<option value="PM">PM</option>
					</select>
					
					<?php
					if(!empty($this->saveRespons['startTime'])){
						echo '<div class="errorMsg">'.$this->saveRespons["startTime"].'</div>';
					}
					?>
					<label for="" class="error" id="startTimeErrorDiv" style="display:none;"></label>
				</div>
			</div>
			
			<div class="maintb">
				<div class="fieldLabel">
					Stop Time<span>*</span>
				</div>
				<div class="fieldinput">
					<!--span class="examp">[Example: hh:mm pm]</span-->
					<!--input type="text" name="stopTime" id="stopTime" value="<?php echo $this->stopTime;?>" class="required costomTime" title="Please enter valid event stop time like hh:mm pm" onblur="checkEventStopTime();" /-->
					<select name="stopHour" id="stopHour" onchange="checkEventStopTimeAdd();" style="width:24% !important">
						<option value="">HH</option>
						<?php
						for($i=1; $i<=12; $i++){
							$hVal = sprintf("%02s", $i);
							$selectHcls = ($this->stopHour == $hVal)?' selected="selected"':'';
							echo '<option value="'.$hVal.'" '.$selectHcls.'>'.$hVal.'</option>';
						}
						?>
					</select>
					<select name="stopMin" id="stopMin" onchange="checkEventStopTimeAdd();" style="width:24% !important">
						<option value="">MM</option>
						<?php
						for($i=0; $i<=59; $i++){
							$hVal = sprintf("%02s", $i);
							$selectMcls = ($this->stopMin == $hVal)?' selected="selected"':'';
							echo '<option value="'.$hVal.'" '.$selectMcls.'>'.$hVal.'</option>';
						}
						?>
					</select>
					<select name="stopLfix" id="stopLfix"  onchange="checkEventStopTimeAdd();" style="width:23% !important">
						<option value="PM">PM</option>
					</select>
					<?php
					if(!empty($this->saveRespons['stopTime'])){
						echo '<div class="errorMsg">'.$this->saveRespons["stopTime"].'</div>';
					}
					?>
					<label for="" class="error" id="stopTimeErrorDiv" style="display:none;"></label>
				</div>
				
			</div>
			<input type="hidden" name="eventStatus" id="eventStatus" value="0">
			<!--div class="maintb">
				<div class="fieldLabel">
					Status<span>*</span>
				</div>
				<div class="fieldinput">
					<select name="eventStatus" id="eventStatus" class="required" onchange="eventProcessLiveAdd(this.value);">
						<option value="0" <?php echo ($this->eventStatus == '0')?'selected="selected"':'';?>>Today</option>
						<?php 
						
						if($this->optMode == 'edit' && $this->eventStatus == '1'){
							$selectClassS = ($this->eventStatus == '1')?'selected="selected"':'';
							echo '<option value="1" '.$selectClassS.'>Live</option>';
						}
						
						?>
						
						<option value="2" <?php echo ($this->eventStatus == '2')?'selected="selected"':'';?>>Next-Up</option>
						
					</select>
				</div>				
			</div-->
			
			<input type="hidden" name="option" value="com_membercheckin" />
			<input type="hidden" name="task" value="" />
			<div class="maintb">
				<div class="fieldLabel" style="text-indent: -9999em;">&nbsp;</div>
				<div class="fieldinput">
					<input type="submit" value="Save">
				</div>
			</div>
			
		</form>
	</div>
<?php 

}else{
	 $this->app->redirect(JURI::root());
}
?>
