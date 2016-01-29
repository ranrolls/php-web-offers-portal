
jQuery(document).ready(function(){
	//jQuery("input").keyup(function() {
	jQuery("#chekinMember").keyup(function() {
		var retVal = '';
		var memberName = jQuery('#chekinMember').val();
		jQuery.ajax({		   
		  type: 'POST',
		  url: "index.php?option=com_membercheckin&view=membercheckin&task=ajaxMeberchekinUpdate",
		  data : { memberName : memberName },
		  success: function(respond){
			  var chekinMemberDetail = jQuery.parseJSON(respond);
			  if(chekinMemberDetail.length > 0){
				for(var i = 0; i < chekinMemberDetail.length; i++){
					var buttonclass = (chekinMemberDetail[i]['memberCheckinStatus'] == 0)?'<a class="editProcEvent" href="javascript:void(0);" onclick="memberCheckin('+chekinMemberDetail[i]['id']+',1)"><i class="icon-ok-sign icon-2x uncheck"></i></a>':'<a class="editProcEvent" href="javascript:void(0);" onclick="memberCheckin('+chekinMemberDetail[i]['id']+',0)"><i class="icon-ok-sign icon-2x check"></i></a>';
					retVal += '<tr>';
					retVal += '<td>'+chekinMemberDetail[i]['name']+'</td>';
					retVal += '<td>'+chekinMemberDetail[i]['usertype']+'</td>';
					retVal += '<td class="checkinStatus" id="checkinOptID_'+chekinMemberDetail[i]['id']+'">'+buttonclass+'</td>';
					retVal += '</tr>';
					
				}
			  }else{
				  retVal = '<tr><td align="center">Member Not Found</td></tr>';
			  }
			  jQuery('#allcheckinMember').html(retVal);
			  
		  }
	  });
	});

});
	
function memberCheckin(userID, checkinStatus){
	if(userID > 0){
		  var cstatus = '';
		  jQuery.ajax({		   
			  type: 'POST',
			  url: "index.php?option=com_membercheckin&view=membercheckin&task=ajaxMeberchekinStatusUpdate",
			  data : { userID : userID, checkinStatus : checkinStatus  },
			  success: function(respond){				  
				  //alert('success'+userID);
				  if(checkinStatus == '1'){
					  cstatus = '<a class="" href="javascript:void(0);" onclick="memberCheckin('+userID+',0)"><i class="icon-ok-sign icon-2x check"></i></a>';
				  }else{
					  cstatus = '<a class="" href="javascript:void(0);" onclick="memberCheckin('+userID+',1)"><i class="icon-ok-sign icon-2x uncheck"></i></a>';
				  }
				  jQuery('#checkinOptID_'+userID).html(cstatus);
			  }
	      });
	}else{
		
	}
}

function presenterDetail(companyID){
	var retVal = '';
	if(companyID > 0){
		 jQuery.ajax({		   
			  type: 'POST',
			  url: "index.php?option=com_membercheckin&view=membercheckin&task=ajaxPresenterDetail",
			  data : { companyID : companyID  },
			  success: function(respond){				  
				  var memberDetail = jQuery.parseJSON(respond);
				  if(memberDetail.length > 0){
					  for(var i = 0; i < memberDetail.length; i++){
						  retVal += '<option value="'+memberDetail[i]['id']+'">'+memberDetail[i]['name']+'</option>';
					  }
					  
				  }else{
					  retVal = '<option value="">Select Presenter</option>';
				  }
				  jQuery('#userID').html(retVal);
			  }
	      });
	}else{
		jQuery('#userID').html('<option value="">Select Presenter</option>');
	}
}
	
function eventProcessLive(status,eventID){
	if(eventID > 0){
		jQuery.ajax({		   
		  type: 'POST',
		  url: "index.php?option=com_membercheckin&view=membercheckin&task=ajaxUpdateEventProcess",
		  data : { status : status , eventID : eventID },
		  success: function(respond){	
			  if(status == '1'){
				if(respond == '0'){
					alert('Other event already Live');
				}else{
					jQuery('#companyEditDiv_'+eventID).hide();
					jQuery('#companyShowDiv_'+eventID).show();
					jQuery('#startStatus_'+eventID).html('<div class="startStatus"><input class="eventaction" type="button" onclick="eventProcessLive(3,'+eventID+');" value="Stop"></div>');
				}
			  }
			  if(status == '2'){
				if(respond == '0'){
					alert('Other event already Next Up');
				}
			  }
			  if(status == '3'){
				jQuery('#startStatus_'+eventID).html('<div class="startStatus">Finish</div>');
			  }
		  }
		});
	}
}


function eventProcessLiveAdd(status,eventID){
	jQuery.ajax({		   
	  type: 'POST',
	  url: "index.php?option=com_membercheckin&view=membercheckin&task=ajaxCheckUpdateEventProcess",
	  data : { status : status },
	  success: function(respond){	
		  
		  if(status == '2'){
			if(respond == '0'){
				alert('Other event already Next Up');
				if(eventID > 0){
					jQuery('#eventStatus_'+eventID).val(0);
				}
			}
		  }else if(status == '1'){
			if(respond == '0'){
				alert('Other event already Live');
				if(eventID > 0){
					jQuery('#eventStatus_'+eventID).val(0);
				}
			}  
		  }
		  
	  }
	});
}

function deleteEvent(eventID){
	if(eventID > 0){
		var conf = 	confirm("Are you sure to delete this event?");
		if(conf){
			jQuery.ajax({		   
			  type: 'POST',
			  url: "index.php?option=com_membercheckin&view=membercheckin&task=ajaxDeteleEventProcess",
			  data : { eventID : eventID },
			  success: function(respond){				  
					jQuery('#evntProcess_'+eventID).remove();
			  }
			});
		}
	}
}

function checkEventTime(){
	var startHour = jQuery('#startHour').val();
	var startMin  = jQuery('#startMin').val();
	var startLfix = jQuery('#startLfix').val();
	jQuery('#startTimeErrorDiv').html('');
	if(startHour != "" && startMin != "" && startLfix != ""){
		jQuery('#startTimeErrorDiv').hide();
		var eventTime  = startHour+':'+startMin+' '+startLfix;
		var eventID   = jQuery('#eventID').val();
		if(eventTime != ""){
			jQuery.ajax({		   
			  type: 'POST',
			  url: "index.php?option=com_membercheckin&view=membercheckin&task=ajaxCheckEventTime",
			  data : { eventTime : eventTime, eventID : eventID },
			  success: function(respond){				  
				  if(respond == '1'){				  
					return true;
				  }else{
					jQuery('#startTimeErrorDiv').html('Start time entered already exist');
					jQuery('#startTimeErrorDiv').show();
					jQuery('#startTime').focus();
					return false;
				  }
			  }
			});
		}
	}
}

function checkEventTimeAdd(){
	var startHour = jQuery('#startHour').val();
	var startMin  = jQuery('#startMin').val();
	var startLfix = jQuery('#startLfix').val();
	jQuery('#startTimeErrorDiv').html('');
	if(startHour != "" && startMin != "" && startLfix != ""){
		jQuery('#startTimeErrorDiv').hide();
		var eventTime  = startHour+':'+startMin+' '+startLfix;
		var eventID   = jQuery('#eventID').val();
		if(eventTime != ""){
			jQuery.ajax({		   
			  type: 'POST',
			  url: "index.php?option=com_membercheckin&view=membercheckin&task=ajaxCheckEventTime",
			  data : { eventTime : eventTime, eventID : eventID },
			  success: function(respond){				  
				  if(respond == '1'){				  
					return true;
				  }else{
					jQuery('#startTimeErrorDiv').html('Start time entered already exist');
					jQuery('#startTimeErrorDiv').show();
					jQuery('#startTime').focus();
					return false;
				  }
			  }
			});
		}
	}
}


function checkEventTimeEdit(eventID){
	var startHour = jQuery('#startHour').val();
	var startMin  = jQuery('#startMin').val();
	var startLfix = jQuery('#startLfix').val();
	jQuery('#startTimeErrorDiv').html('');
	if(startHour != "" && startMin != "" && startLfix != ""){
		jQuery('#startTimeErrorDiv').hide();
		var eventTime  = startHour+':'+startMin+' '+startLfix;
		if(eventTime != ""){
			jQuery.ajax({		   
			  type: 'POST',
			  url: "index.php?option=com_membercheckin&view=membercheckin&task=ajaxCheckEventTime",
			  data : { eventTime : eventTime, eventID : eventID },
			  success: function(respond){				  
				  if(respond == '1'){
					jQuery('.stm1').text('Start Time');  
					jQuery('.stm1').attr('style','');			  
					return true;
				  }else{
					jQuery('#startTimeErrorDiv').html('Start time entered already exist');
					//jQuery('#startTimeErrorDiv').show();
					jQuery('.stm1').attr('style','color:red;');
					jQuery('.stm1').text('Start time entered already exist');
					jQuery('#startTime').focus();
					return false;
				  }
			  }
			});
		}
	}
}

function checkEventStopTime(){
	var stopHour  = jQuery('#stopHour').val();
	var stopMin   = jQuery('#stopMin').val();
	var stopLfix  = jQuery('#stopLfix').val();
	jQuery('#stopTimeErrorDiv').html('');
	if(stopHour != "" && stopMin != "" && stopLfix != ""){
	  jQuery('#stopTimeErrorDiv').hide();
	  var eventStopTime =  stopHour+':'+stopMin+' '+stopLfix;
	  var startHour = jQuery('#startHour').val();
	  var startMin  = jQuery('#startMin').val();
	  var startLfix = jQuery('#startLfix').val();	
	  var eventStartTime = startHour+':'+startMin+' '+startLfix;
	  if(eventStopTime != ""){
		eventStartTime = eventStartTime.replace(/pm/gi, "");
		eventStartTime = eventStartTime.replace(":",""); 
		eventStartTime = eventStartTime.replace(" ",""); 
		eventStopTime  = eventStopTime.replace(/pm/gi, "");
		eventStopTime  = eventStopTime.replace(":",""); 
		eventStopTime  = eventStopTime.replace(" ",""); 
		if(eventStopTime <= eventStartTime){
			//jQuery('#stopTimeErrorDiv').html('Must be greater than start time');
			jQuery('.stp1').text('Must be greater than start time');
			jQuery('.stp1').attr('style','color:red;');
			jQuery('#stopTimeErrorDiv').show();
			jQuery('#stopTime').focus();
			return false;
		}else{
			jQuery('.stp1').text('Stop Time');
			jQuery('.stp1').attr('style','');
		}
	  }
	}
}

function checkEventStopTimeAdd(){
	var stopHour  = jQuery('#stopHour').val();
	var stopMin   = jQuery('#stopMin').val();
	var stopLfix  = jQuery('#stopLfix').val();
	jQuery('#stopTimeErrorDiv').html('');
	if(stopHour != "" && stopMin != "" && stopLfix != ""){
	  jQuery('#stopTimeErrorDiv').hide();
	  var eventStopTime =  stopHour+':'+stopMin+' '+stopLfix;
	  var startHour = jQuery('#startHour').val();
	  var startMin  = jQuery('#startMin').val();
	  var startLfix = jQuery('#startLfix').val();	
	  var eventStartTime = startHour+':'+startMin+' '+startLfix;
	  if(eventStopTime != ""){
		eventStartTime = eventStartTime.replace(/pm/gi, "");
		eventStartTime = eventStartTime.replace(":",""); 
		eventStartTime = eventStartTime.replace(" ",""); 
		eventStopTime  = eventStopTime.replace(/pm/gi, "");
		eventStopTime  = eventStopTime.replace(":",""); 
		eventStopTime  = eventStopTime.replace(" ",""); 
		if(eventStopTime <= eventStartTime){
			jQuery('#stopTimeErrorDiv').html('Must be greater than start time');
			jQuery('#stopTimeErrorDiv').show();
			jQuery('#stopTime').focus();
			return false;
		}
	  }
	}
}


function editEventInline(eventID,eventStatus){
	var divValue = jQuery('#evntProcess_'+eventID).html();
	jQuery('.editProcEvent').hide();
	jQuery('.deleteProcEvent').hide();
	jQuery('#dplecateDivValue').html(divValue);
	jQuery.ajax({		   
	  type: 'POST',
	  url: "index.php?option=com_membercheckin&view=membercheckin&task=ajaxGetEventDetailOnID",
	  data : { eventID : eventID },
	  success: function(respond){				  
		  if(respond){
			  var resdata = jQuery.parseJSON(respond);			  
			  if(eventStatus == '1'){
				  var stopTimeSelect = hourMinut(resdata.stop,'stop','1',eventID);
				  var stValHour   = resdata.start.substring(0,2);
				  var stValMin    = resdata.start.substring(3,6);
				  var startTimeSelectDiv = '<input type="hidden" name="startHour" id="startHour" value="'+stValHour+'" />';
				  startTimeSelectDiv += '<input type="hidden" name="startMin" id="startMin" value="'+stValMin+'" />';
				  startTimeSelectDiv += '<input type="hidden" name="" id="" value="PM" />';
				  jQuery('#startTimeDiv_'+eventID).append(startTimeSelectDiv);
				  var stopTimeSelectDiv = stopTimeSelect;
				  stopTimeSelectDiv += '<br /><label for="" class="error" id="stopTimeErrorDiv" style="display:none;"></label><label  class="noteme stp1">Stop Time</label>';
				  jQuery('#stopTimeDiv_'+eventID).html(stopTimeSelectDiv);
				  jQuery('#dplcstatus').html(jQuery('#startStatus_'+eventID).html());
				  jQuery('#startStatus_'+eventID).html('<a class="editProcEvent" href="javascript:void(0);" title="Save" onclick="saveEditedAgendaValue('+eventID+',\'live\');"><span class="icon-save icon-2x"></span></a><a class="editProcEvent" title="Cancel" href="javascript:void(0);" onclick="cancleAgendaEdit('+eventID+');"><span class="icon-remove-sign icon-2x"></span></a>');
				  
			  }else{
				  var startTimeSelect = hourMinut(resdata.start,'start','1', eventID);
				  var stopTimeSelect  = hourMinut(resdata.stop,'stop','1', eventID);
				  var startTimeSelectDiv = startTimeSelect;
				  startTimeSelectDiv += '<br/><label for="" class="error" id="startTimeErrorDiv" style="display:none;"></label><label class="noteme stm1">Start Time</label>';
				  jQuery('#startTimeDiv_'+eventID).html(startTimeSelectDiv);
				  
				  var stopTimeSelectDiv = stopTimeSelect;
				  stopTimeSelectDiv += '<br /><label for="" class="error" id="stopTimeErrorDiv" style="display:none;"></label><label class="noteme stp1">Stop Time</label>';
				  jQuery('#stopTimeDiv_'+eventID).html(stopTimeSelectDiv);
				  jQuery('#dplcstatus').html(jQuery('#startStatus_'+eventID).html());
				  if(eventStatus == '2'){
					jQuery('#evntProcess_'+eventID+' div[class="comclass"] select').attr('onchange','');
					jQuery('#startStatus_'+eventID).html('<a class="editProcEvent" href="javascript:void(0);" title="Save" onclick="saveEditedAgendaValue('+eventID+',\'nextUp\');"><span class="icon-save icon-2x"></span></a><a class="editProcEvent" title="Cancel" href="javascript:void(0);" onclick="cancleAgendaEdit('+eventID+');" ><span class="icon-remove-sign icon-2x"></span></a>');
				  }else{ 
					jQuery('#companyShowDiv_'+eventID).hide();
					jQuery('#companyEditDiv_'+eventID).show();
					jQuery('#eventStatus_'+eventID).show();
					jQuery('#evntProcess_'+eventID+' div[class="comclass"] select').attr('onchange','');  
					jQuery('#startStatus_'+eventID).html('<a class="editProcEvent" href="javascript:void(0);" title="Save" onclick="saveEditedAgendaValue('+eventID+',\'other\');"><span class="icon-save icon-2x"></span></a><a class="editProcEvent" title="Cancel" href="javascript:void(0);" onclick="cancleAgendaEdit('+eventID+');"><span class="icon-remove-sign icon-2x"></span></a>');
				  }
				  
				  
				  
			  }			  
		  }
	  }
	});

}


function updateCompanyEventComing(companyID,eventID){
	jQuery.ajax({		   
	  type: 'POST',
	  url: "index.php?option=com_membercheckin&view=membercheckin&task=ajaxUpdateComingEvent",
	  data : { eventID : eventID, companyID : companyID},
	  success: function(respond){				  
		  if(respond){
			  var resdata  = jQuery.parseJSON(respond);
			  var rEventID = resdata['replaceEventID'];
			  var rCompanyID = resdata['replaceCompanyID'];
			  var rCompanyNm = resdata['replaceCompanyName'];
			  if(rEventID > 0){ //alert(rCompanyID+'ddddd'+rEventID);
				//alert(jQuery('#companySelectDiv_'+rEventID+" select").val());
				jQuery('#companySelectDiv_'+rEventID+" select").val(rCompanyID);
				jQuery('#companyShowDiv_'+rEventID).html(rCompanyNm);
				//alert(jQuery('#companySelectDiv_'+rEventID+" select").val());
			  }
		  }
	  }
	});
}


function hourMinut(timeVal, namePrefix, status, eventID){
	var retVal    = '';
	var tempNum   = '';
	var selectcls = '';
	var valHour   = timeVal.substring(0,2);
	var valMin    = timeVal.substring(3,5);
	var startHour = (status == 1)?parseInt(valHour):1;				// Check for live start hour
	var onchangeFunction = (namePrefix == 'start')?'checkEventTimeEdit('+eventID+');checkEventStopTime();':'checkEventStopTime();';
	//var onchangeFunction = 'checkEventStopTime();';
	//alert(valHour+'||'+valMin);
	retVal = '<select name="'+namePrefix+'Hour" id="'+namePrefix+'Hour" onchange="'+onchangeFunction+'" style="width:33% !important;padding-right:5px;">';
	retVal += '<option value="">HH</option>';
	
	for(var i=startHour; i<=12; i++){
		tempNum = (i<10)?'0'+i:i;
		selectcls = (valHour == tempNum)?' selected="selected"':'';
		retVal += '<option value="'+tempNum+'" '+selectcls+'>'+tempNum+'</option>';
	}
	retVal += '</select>';
	
	retVal += '<select name="'+namePrefix+'Min" id="'+namePrefix+'Min" onchange="'+onchangeFunction+'" style="width:33% !important;padding-right:5px !important;">';
	retVal += '<option value="">MM</option>';
	for(var i=1; i<=60; i++){
		tempNum = (i<10)?'0'+i:i;	
		selectcls = (valMin == tempNum)?' selected="selected"':'';		
		retVal += '<option value="'+tempNum+'" '+selectcls+'>'+tempNum+'</option>';
	}
	retVal += '</select> PM';
	retVal += '<select name="'+namePrefix+'Lfix" id="'+namePrefix+'Lfix"  onchange="'+onchangeFunction+'" style="display:none; width:33% !important">';
	retVal += '<option value="PM">PM</option>';
	retVal += '</select>';
	
	return retVal;
}


function saveEditedAgendaValue(eventID,eventStatus){
	
	if(eventStatus == 'live'){
		
		var stopHour = jQuery("#stopHour").val();
		var stopMin  = jQuery("#stopMin").val();
		var stopLfix = jQuery("#stopLfix").val();
		var errorLength = jQuery('#stopTimeErrorDiv').html();
		var errorOnform = errorLength.length;
		var stopTime = stopHour+':'+stopMin+' '+stopLfix;
		
		jQuery.ajax({		   
		  type: 'POST',
		  url: "index.php?option=com_membercheckin&view=membercheckin&task=ajaxUpdateEvents",
		  data : { eventID : eventID, stopTime : stopTime, status : 'live', errorOnform : errorOnform},
		  success: function(respond){	
			if(respond != 0){			  
				jQuery("input[type='hidden']").remove();
				jQuery('#stopTimeDiv_'+eventID).html(stopTime);
				jQuery('#startStatus_'+eventID).html(jQuery('#dplcstatus').html());
				jQuery('#dplecateDivValue').html('');
				jQuery('#dplcstatus').html('');
				location.reload();
			}else{
				alert('Some wrong entry for save data');
			}
		  }
		});
		
	}else if(eventStatus == 'nextUp'){
		
		var startHour = jQuery("#startHour").val();
		var startMin  = jQuery("#startMin").val();
		var startLfix = jQuery("#startLfix").val();
		var stopHour  = jQuery("#stopHour").val();
		var stopMin   = jQuery("#stopMin").val();
		var stopLfix  = jQuery("#stopLfix").val();
		var companyID = jQuery('#evntProcess_'+eventID+' div[class="comclass"] select').val();
		var errorStartLength = jQuery('#startTimeErrorDiv').html();
		var errorStopLength = jQuery('#stopTimeErrorDiv').html();
		var errorOnform = parseInt(errorStartLength.length) + parseInt(errorStopLength.length);
		var startTime = startHour+':'+startMin+' '+startLfix;
		var stopTime  = stopHour+':'+stopMin+' '+stopLfix;
		
		jQuery.ajax({		   
		  type: 'POST',
		  url: "index.php?option=com_membercheckin&view=membercheckin&task=ajaxUpdateEvents",
		  data : { eventID : eventID, startTime : startTime, stopTime : stopTime, companyID : companyID,  status : 'nextUp', errorOnform : errorOnform},
		  success: function(respond){	
			if(respond != 0){		
				//return false;	  
				location.reload();
			}else{
				alert('Some wrong entry for save data');
			}
		  }
		});
		
	}else{
		
		var startHour = jQuery("#startHour").val();
		var startMin  = jQuery("#startMin").val();
		var startLfix = jQuery("#startLfix").val();
		var stopHour  = jQuery("#stopHour").val();
		var stopMin   = jQuery("#stopMin").val();
		var stopLfix  = jQuery("#stopLfix").val();
		var companyID = jQuery('#evntProcess_'+eventID+' div[class="comclass"] select').val();
		var eventStatus = jQuery('#eventStatus_'+eventID).val();
		var errorStartLength = jQuery('#startTimeErrorDiv').html();
		var errorStopLength = jQuery('#stopTimeErrorDiv').html();
		var errorOnform = parseInt(errorStartLength.length) + parseInt(errorStopLength.length);
		var startTime = startHour+':'+startMin+' '+startLfix;
		var stopTime  = stopHour+':'+stopMin+' '+stopLfix;
		
		jQuery.ajax({		   
		  type: 'POST',
		  url: "index.php?option=com_membercheckin&view=membercheckin&task=ajaxUpdateEvents",
		  data : { eventID : eventID, startTime : startTime, stopTime : stopTime, companyID : companyID, eventStatus : eventStatus, status : 'other', errorOnform : errorOnform},
		  success: function(respond){	
			if(respond != 0){		
				//return false;	  
				location.reload();
			}else{
				alert('Some wrong entry for save data');
			}
		  }
		});
	}
}


function cancleAgendaEdit(eventID){
	jQuery('#evntProcess_'+eventID).html(jQuery('#dplecateDivValue').html());
	jQuery('#dplecateDivValue').html('');
	jQuery('#dplcstatus').html('');
	jQuery('.editProcEvent').show();
	jQuery('.deleteProcEvent').show();
}
