jQuery(document).ready(function(){

	 

});

 

function memberCheckin(propertyID, approval_status){
	  
	var cstatus = '';
		  jQuery.ajax({		   
			  type: 'POST',
			  url: "index.php?option=com_membercheckin&view=membercheckin&task=ajaxMeberchekinStatusUpdate",
			  data : { propertyID: propertyID, approval_status: approval_status},
			  success: function(respond){			
	  
                             
				approval_status= "'"+approval_status+"'";

				  if(approval_status== '1'){
					  cstatus = '<a class="" href="javascript:void(0);" onclick="memberCheckin('+propertyID+',0)"><i class="icon-ok-sign icon-2x check"></i></a>';
				  }else{
					  cstatus = '<a class="" href="javascript:void(0);" onclick="memberCheckin('+propertyID+',1)"><i class="icon-ok-sign icon-2x uncheck"></i></a>';
				  }
                                     var url = 'index.php/component/membercheckin/';
                                            jQuery(location).attr('href',url);  
                                    
				 jQuery('#checkinOptID_'+propertyID).html(cstatus);
				 
			  }
	      });
	 
}



function ajaxDeteleProductbyID(propertyID){

   if(propertyID > 0){
    var conf = 	confirm("Are you sure to delete this Product?");
    if(conf){
		 jQuery.ajax({		   
		 type: 'POST',
		 url: "index.php?option=com_membercheckin&view=propertylist&task=ajaxDeteleProduct",
		 data : { propertyID: propertyID},
		 success: function(respond){	
                     alert('Product Deleted');
                  var url = 'index.php/component/membercheckin/?view=propertylist';
                  jQuery(location).attr('href',url);  
                 jQuery('#evntProcess_'+propertyID).remove();
	       }
                
	     });
           }
      }
}
 

 
 
  
