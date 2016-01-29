jQuery(document).ready(function(){
  jQuery('#Main').validate();
  jQuery('#quickFrm').validate();
});


jQuery(function() { 
    jQuery("#companyID").change(function(){ 
        var element = jQuery(this).find('option:selected'); 
        var lang 	= element.attr("lang"); 
	var val	 	= element.val(); 
	jQuery('#otherCompanyName').hide();
	jQuery('#otherCompanyName').val('');
	if(val == ''){
	        jQuery('#userTypeDivid').html('&nbsp;&nbsp;Please select company for user type');
	}else if(val == '-1'){

		jQuery('#userTypeDivid').html('<select id="user_type" name="user_type" class="required"><option value="">Select user type</option><option value="Attendees">Attendees</option><option value="Press">Press</option><option value="Investor">Investor</option><option value="VIP Investor">VIP Investor</option></select>');
		jQuery('#user_type option[value='+lang+']').attr("selected", "selected");
		jQuery('#otherCompanyName').show();
	}else{
		jQuery('#userTypeDivid').html('<input type="text" readonly="readonly" class="required" id="user_type" name="user_type" value="'+lang+'">');
	}
		
    }); 
});


function changeRegForm(str){
	if(str == '2'){
		jQuery('#formchange1').attr('class','radioform');
		jQuery('#formchange2').attr('class','radioformselect');
		jQuery('#Main').hide();
		jQuery('#quickFrm').show();
	}else{
		jQuery('#formchange2').attr('class','radioform');
		jQuery('#formchange1').attr('class','radioformselect');		
		jQuery('#quickFrm').hide();
		jQuery('#Main').show();
	}
}
