<?php
defined('_JEXEC') or die;
$session = JFactory::getSession();
$access	 = $session->get( 'Agent');
$app	 = JFactory::getApplication();
$doc	 = JFactory::getDocument();
$doc->setTitle('Add Category');

 

$user =JFactory::getUser();
//if(!empty($access))
if ( $user->id > 0 ) {

 $username=$user->name;

 $error = $this->error;  
 
require_once( JPATH_COMPONENT.'/views/membercheckin/tmpl/customeheader.php' );
 
?>
<link rel="stylesheet" href="<?php echo JURI::root().'components/com_membercheckin/assets/js/assets/css/csdform.css';?>" type="text/css">
<div  class="AddHead"><h1>Add Category</h1></div> 
<div id="eventForm" class="Register_as">


	<script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/assets/js/jquery.validate.min.js';?>"></script>
	<script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/assets/js/attendeeregistration.js';?>"></script>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
   
<style>
#imagePreview {
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
    $("#categoryLogo").on("change", function()
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


	<table cellspacing="0" cellpadding="0" border="0" id="crm-content" class="aLt">
		<tr>
			<td valign="top">
			
	 <form enctype="multipart/form-data" class="cmxform" id="Main" name="Main" method="post" action="" enctype="multipart/form-data" autocomplete="off">
  
					<fieldset style="border: medium none; margin: 0px; padding: 0px; float: left; width: 100%;">
						<div id="crm-container">
						 
						
							<div class="maintb" id="editrow-company">
							
							
								<div>
								 <label for="company" class="FieldName"> Category Name
							  <span title="Category Name is required field." class="crm-marker">*</span>
									</label>
								</div>
								
								
								<div class="edit-value content">
									<input type="text" class="required" id="categoryName" title="Category name is required field" name="categoryName" value="<?php echo JRequest::getVar('categoryName');?>">
									<?php 

									if(!empty($error['categoryName']))	{
										echo '<span class="error_msg">'.$error['categoryName'].'</span>';
									}
									?>
								</div>
								
							</div>
							
							
 <div id="crm-container">  
 <div class="maintb">
				 
 <div class="fieldLabel">Category Logo</div> 
 <div id="imagePreview"></div>
 
 <div>
 <input type="file" name="categoryLogo" id="categoryLogo" class="img" accept="png,jpeg,jpg,gif" title="Please upload valid category logo." />
 </div>	
			
 </div>
	
   
  <div class="clear"></div>
 </div>		
				


					
							<div class="row2"><br/>
								<input type="submit" id="_qf_Edit_next" value="Add Category" name="_qf_Edit_next" class="form-submit default"><br/><br/>
							</div>
							<div class="clear"></div>
						</div>
						
						<div class="clear"></div>						
					</fieldset>

                                    
			                <input type="hidden" name="task" value="addcategory" />
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