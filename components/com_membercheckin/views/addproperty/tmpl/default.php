<?php
defined('_JEXEC') or die;
$session = JFactory::getSession();
$access	 = $session->get( 'Agent');
$app	 = JFactory::getApplication();
$doc	 = JFactory::getDocument();
$doc->setTitle('Offer Add Panel');
 
	
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
<div  class="AddHead"><h1>Offer Added By Admin</h1></div> 
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

  

function getLocation(dt) {
//alert(dt);exit;
 $.ajax({ 
         
	 type: "POST",
	 url: "index.php?option=com_membercheckin&task=get_location_org_id", 
	    data:'orgid='+dt,
	    success: function(data){ 
                  console.log(data);
                  //alert(data);
             $("#location-list").html(data);
	   }
      });


}


</script>

<style>
#imagePreview {
    width: 180px;
    height: 180px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}

#imagePreview1 {
    width: 180px;
    height: 180px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}

</style>


<script type="text/javascript">
$(function() {
    $("#propertyLogo").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
 
            reader.onloadend = function(){ // set image data as background of div
                $("#imagePreview").css("background-image", "url("+this.result+")");
            }
        }
    });
});
</script>

<script type="text/javascript">
$(function() {
    $("#googlemapLogo").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
 
            reader.onloadend = function(){ // set image data as background of div
                $("#imagePreview1").css("background-image", "url("+this.result+")");
            }
        }
    });
});
</script>


	 
	<table cellspacing="0" cellpadding="0" border="0" id="crm-content" class="aLt">
		<tr>
			<td valign="top">
			
	 <form enctype="multipart/form-data" class="cmxform" id="Main" name="Main" method="post" action="" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="username" id="username" value="<?php echo $username;?>" />

 <fieldset style="border: medium none; margin: 0px; padding: 0px; float: left; width: 100%;">
	 <div id="crm-container">
					               
         
<div>

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
<select name="subcatid" id="subcat-list" class="demoInputBox" onChange="getOrganization(this.value)">>
<option value="">Select Sub category</option>
</select>
</div>


<div class="row">
<label>Select Organization</label><br/>
<select name="orgid" id="org-list" class="demoInputBox" onChange="getLocation(this.value)">
<option value="">Select Organization</option>
</select>
</div>

 <div class="row">
<label>Select Location:</label><br/>
<select name="locationid" id="location-list" class="demoInputBox">
<option value="">Select Location</option>
</select>
</div>




 
</div>                         

 <div class="maintb" id="editrow-company">
 <div>
	 <label for="company" class="FieldName"> Product Name
	 <span title="Property Name is required field." class="crm-marker">*</span>
	 </label>
 </div>
 <div class="edit-value content">
 <input type="text" class="required" id="propertyName" title="Product name is required field" name="propertyName" value="<?php echo JRequest::getVar('propertyName');?>">
 <?php 
 if(!empty($error['propertyName']))	{
 echo '<span class="error_msg">'.$error['propertyName'].'</span>';
 }
 ?>
 </div>
 <div class="clear"></div>

</div>
 </div>




<div id="crm-container">
						 
 <div class="maintb" id="editrow-company">
 <div>
 <label for="propertyprice" class="FieldName"> Product Price
 <span title="Product Price is required field." class="crm-marker">*</span>
 </label>
 </div>
 <div class="edit-value content">
 <input type="text" class="required" id="propertyPrice" title="Product price is required field" name="propertyPrice" value="<?php echo JRequest::getVar('propertyPrice');?>">
									
 </div>
 <div class="clear"></div>
 </div>
							 	 
 </div>



<div id="crm-container">
						 
						
							<div class="maintb" id="editrow-company">
								<div>
 <label for="propertyaddress" class="FieldName"> Product Address
 <span title="Product Address is required field." class="crm-marker">*</span>
 </label>
								</div>
								<div class="edit-value content">
<input type="text" class="required" id="propertyAddress" title="Product Address is required field" name="propertyAddress" value="<?php echo JRequest::getVar('propertyAddress');?>">
									<?php 

 if(!empty($error['propertyAddress']))	{
										echo '<span class="error_msg">'.$error['propertyAddress'].'</span>';
 }
 ?>
 </div>
 <div class="clear"></div>
							</div>
							 	 
 </div>



<div class="maintb" id="editrow-company">
 <div>
 <label for="propertydesc" class="FieldName"> Product Description
 <span title="Property Description is required field." class="crm-marker">*</span>
 </label>
 </div>
 <div class="edit-value content">
 <input type="text" class="required" id="propertyDesc" title="Product Description is required field" name="propertyDesc" value="<?php echo JRequest::getVar('propertyDesc');?>">
 <?php 
 if(!empty($error['propertyDesc']))	{
 echo '<span class="error_msg">'.$error['propertyDesc'].'</span>';
 }
 ?>
 </div>
 <div class="clear"></div>
 </div>
 </div>

 
								
 <div id="crm-container">  
 <div class="maintb">
				 
 <div class="fieldLabel">Offer Logo</div> 
 <div id="imagePreview"></div>
 
 <div>
 <input type="file" name="propertyLogo" id="propertyLogo" class="img" accept="png,jpeg,jpg,gif" title="Please upload valid offer logo." /> 
 </div>	
			
 </div>
	
   
  <div class="clear"></div>
 </div>		



  <div id="crm-container">  
 <div class="maintb">
				 
 <div class="fieldLabel">Google Map Image</div> 
 <div id="imagePreview1"></div>
 
 <div>
 <input type="file" name="googlemapLogo" id="googlemapLogo" class="img" accept="png,jpeg,jpg,gif" title="Please upload valid Google map logo." />
 </div>	
			
 </div>
	
   
  <div class="clear"></div>
 </div>		
		
								
					 
							 
 <div class="row2"><br/>
 <input type="submit" id="_qf_Edit_next" value="Add" name="_qf_Edit_next" class="form-submit default"><br/><br/>
 </div>
 <div class="clear"></div>
 </div>
 <div class="clear"></div>						
 </fieldset>

                                    
 <input type="hidden" name="task" value="addproperty" />
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