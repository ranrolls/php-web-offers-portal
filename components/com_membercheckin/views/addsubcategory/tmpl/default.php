<?php
defined('_JEXEC') or die;
$session = JFactory::getSession();
$access	 = $session->get( 'Agent');
$app	 = JFactory::getApplication();
$doc	 = JFactory::getDocument();
$doc->setTitle('Add Sub Category');



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
<div  class="AddHead"><h1>Add Sub Category</h1></div> 
<div id="eventForm" class="Register_as">


	<script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/assets/js/jquery.validate.min.js';?>"></script>
	<script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/assets/js/attendeeregistration.js';?>"></script>
	
	<table cellspacing="0" cellpadding="0" border="0" id="crm-content" class="aLt">
		<tr>
			<td valign="top">
			
 
 
<form enctype="multipart/form-data" class="cmxform" id="Main" name="Main" method="post" action="" enctype="multipart/form-data" autocomplete="off">		
<fieldset style="border: medium none; margin: 0px; padding: 0px; float: left; width: 100%;">
<div  class="AddHead"><h1>Add Sub Category</h1></div> 
<div id="crm-container">		
<div class="row">
<label>Select Category:</label><br/>
<select name="category" id="category-list" class="demoInputBox">
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
 <div class="maintb" id="editrow-company">
							
							
								<div>
								 <label for="company" class="FieldName"> Sub Category Name
							  <span title="Category Name is required field." class="crm-marker">*</span>
									</label>
								</div>
								
								
								<div class="edit-value content">
									<input type="text" class="required" id="subcategoryName" title="Sub Category name is required field" name="subcategoryName" value="<?php echo JRequest::getVar('subcategoryName');?>">
									<?php 

									if(!empty($error['subcategoryName']))	{
										echo '<span class="error_msg">'.$error['subcategoryName'].'</span>';
									}
									?>
								</div>
								
							</div>
</div>  
 
<div class="row2"><br/>
<input type="submit" id="subcategory" value="Add Sub Category" name="subcategory" class="form-submit default"><br/><br/>
</div>
<div class="clear"></div>

 </fieldset>

 <input type="hidden" name="task" value="addsubcategory" />
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