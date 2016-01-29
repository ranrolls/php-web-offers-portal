<?php
defined('_JEXEC') or die;
$session = JFactory::getSession();
$access	 = $session->get( 'Agent');
$app	 = JFactory::getApplication();
$doc	 = JFactory::getDocument();
$doc->setTitle('Add Location');



$db = JFactory::getDbo(); 
               
$query = $db->getQuery(true);

 $query->select('*') 
->from($db->quoteName('onm_product_category'));

$db->setQuery($query); 

$results =  $db->loadAssocList();




$user =JFactory::getUser();
//if(!empty($access))
if ( $user->id > 0 ) {

 $username=$user->name;

 $error = $this->error;  
 
require_once( JPATH_COMPONENT.'/views/membercheckin/tmpl/customeheader.php' );
 
?>
<link rel="stylesheet" href="<?php echo JURI::root().'components/com_membercheckin/assets/js/assets/css/csdform.css';?>" type="text/css">
<div  class="AddHead"><h1>Add Location</h1></div> 
<div id="eventForm" class="Register_as">
 
 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
 <script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/assets/js/jquery.validate.min.js';?>"></script>
 <script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/assets/js/membercheckin.js';?>"></script>
 <script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/assets/js/attendeeregistration.js';?>"></script>

<script>
   
function getSubcat(dt) {
    
	 $.ajax({ 
         
	 type: "POST",
	 url: "index.php?option=com_membercheckin&task=get_subcategory", 
	    data:'category='+dt,
	    success: function(data){ 
                  console.log(data);
                   //alert(data);
             $("#subcat-list").html(data);
	   }
      });

 }

function getOrganization(dt) {

 $.ajax({ 
         
	 type: "POST",
	 url: "index.php?option=com_membercheckin&task=get_sub_category_location", 
	    data:'subcatid='+dt,
	    success: function(data){ 
                  console.log(data);
                  //alert(data);
             $("#org-list").html(data);
	   }
      });


}



 </script>
	 
	 <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
    <script type="text/javascript">
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('txtPlaces'));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                var mesg = "Address: " + address;
                mesg += "\nLatitude: " + latitude;
                mesg += "\nLongitude: " + longitude;
                //console.log(mesg);
            


        //var url='get_location.php?address='+address+'&latitude='+latitude+'&longitude='+longitude;
       //window.location.href = url;
     document.getElementById('locationLat').value = latitude;
      document.getElementById('locationLong').value = longitude;


            });
        });
    </script>


	<table cellspacing="0" cellpadding="0" border="0" id="crm-content" class="aLt">
		<tr>
			<td valign="top">
			
 
 
<form enctype="multipart/form-data" class="cmxform" id="Main" name="Main" method="post" action="" enctype="multipart/form-data" autocomplete="off">		
<fieldset style="border: medium none; margin: 0px; padding: 0px; float: left; width: 100%;">
<div  class="AddHead"><h1>Add Location</h1></div> 
<div id="crm-container">		
 
 
<div class="row">
<label>Select Category:</label><br/>
<select name="category" id="category-list" class="demoInputBox" onChange="getSubcat(this.value)">
<option value="">Select Category</option>
<?php
foreach($results as $category) {
?>
<option value="<?php echo $category["catid"]; ?>"><?php echo $category["categoryName"]; ?></option>
<?php
}
?>
</select>
</div>

<div class="row">
<label>Sub Category:</label><br/>
<select name="subcatid" id="subcat-list" class="demoInputBox" onChange="getOrganization(this.value)">
<option value="">Select Sub category</option>
</select>
</div>

 <div class="row">
<label>Organization:</label><br/>
<select name="orgid" id="org-list" class="demoInputBox">
<option value="">Select Organization</option>
</select>
</div>



<div class="maintb" id="editrow-company">
							
<div>
 <label for="company" class="FieldName">Location Name
<span title="Location Name is required field." class="crm-marker">*</span>
</label>
</div>
								
								
<div class="edit-value content">
<!--<input type="text" class="required" id="locationName" title="Location name is required field" name="locationName" value="<?php echo JRequest::getVar('locationName');?>">-->

 <span>Location:</span>
    <input type="text" name="locationName" id="txtPlaces" style="width: 250px" />


<?php 
if(!empty($error['locationName']))	{
echo '<span class="error_msg">'.$error['locationName'].'</span>';
}
?>
</div>

	<div>
 <label for="company" class="FieldName">Location Latitude
<span title="Location Latitude is required field." class="crm-marker">*</span>
</label>
</div>					
<div class="edit-value content">
<input type="text" class="required" id="locationLat" title="Location latitude is required field" name="locationLat" value="<?php echo JRequest::getVar('locationLat');?>">
<?php 
if(!empty($error['locationLat']))	{
echo '<span class="error_msg">'.$error['locationLat'].'</span>';
}
?>
</div>

	<div>
 <label for="company" class="FieldName">Location Longitude
<span title="Location Longitude is required field." class="crm-marker">*</span>
</label>
</div>								
<div class="edit-value content">
<input type="text" class="required" id="locationLong" title="Location longitude is required field" name="locationLong" value="<?php echo JRequest::getVar('locationLong');?>">
<?php 
if(!empty($error['locationLong']))	{
echo '<span class="error_msg">'.$error['locationLong'].'</span>';
}
?>
</div>


	
								
</div>
</div>  
 
<div class="row2"><br/>
<input type="submit" id="addlocation" value="Add Location" name="addlocation" class="form-submit default"><br/><br/>
</div>
<div class="clear"></div>

 </fieldset>

 <input type="hidden" name="task" value="addlocation" />
 <input type="hidden" name="option" value="com_membercheckin" />
 <div class="clear"></div>
 <div class="maintb">
 <div class="fieldLabel" style="text-indent: -9999em;">&nbsp;</div>
 </div>


 </form>






			</td>
		</tr>
	</table>
</div>

<?php
}

else
{
  $app->redirect(JURI::root()); 
}
?>