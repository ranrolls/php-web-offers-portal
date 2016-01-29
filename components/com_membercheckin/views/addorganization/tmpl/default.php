<?php
defined('_JEXEC') or die;
$session = JFactory::getSession();
$access	 = $session->get( 'Agent');
$app	 = JFactory::getApplication();
$doc	 = JFactory::getDocument();
$doc->setTitle('Add Organization');



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
<div  class="AddHead"><h1>Add Organization</h1></div> 
<div id="eventForm" class="Register_as">
 
 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
 <script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/assets/js/jquery.validate.min.js';?>"></script>
 <script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/assets/js/membercheckin.js';?>"></script>
 <script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/assets/js/attendeeregistration.js';?>"></script>

<script>
   
function getSubcat(dt) {
    
	 $.ajax({ 
         
	 type: "POST",
	 url: "index.php?option=com_membercheckin&task=get_sub_category_organisation", 
	    data:'category='+dt,
	    success: function(data){ 
                  console.log(data);
                  //alert(data);
             $("#subcat-list").html(data);
	   }
      });

 }


 </script>
	 
	
	<table cellspacing="0" cellpadding="0" border="0" id="crm-content" class="aLt">
		<tr>
			<td valign="top">
			
 
 
<form enctype="multipart/form-data" class="cmxform" id="Main" name="Main" method="post" action="" enctype="multipart/form-data" autocomplete="off">		
<fieldset style="border: medium none; margin: 0px; padding: 0px; float: left; width: 100%;">
<div  class="AddHead"><h1>Add Organization</h1></div> 
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
<select name="subcatid" id="subcat-list" class="demoInputBox">
<option value="">Select Sub category</option>
</select>
</div>


 <div class="maintb" id="editrow-company">
							
							
								<div>
								 <label for="company" class="FieldName">Organization Name
							  <span title="Category Name is required field." class="crm-marker">*</span>
									</label>
								</div>
								
								
<div class="edit-value content">
<input type="text" class="required" id="organizationName" title="Organization name is required field" name="organizationName" value="<?php echo JRequest::getVar('organizationName');?>">
									<?php 

									if(!empty($error['organizationName']))	{
										echo '<span class="error_msg">'.$error['organizationName'].'</span>';
									}
									?>
								</div>
								
							</div>
</div>  
 
<div class="row2"><br/>
<input type="submit" id="addorganization" value="Add Organization" name="addorganization" class="form-submit default"><br/><br/>
</div>
<div class="clear"></div>

 </fieldset>

 <input type="hidden" name="task" value="addorganization" />
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