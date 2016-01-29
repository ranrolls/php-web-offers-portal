<?php 

/**
 * @package		Joomla.Site
 * @subpackage	com_membercheckin/editcompany
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 * @Author		Vishal Kumar
 */

 if ( $this->user->id > 0 ) {


 $doc	 = &JFactory::getDocument();
 $doc->setTitle('Edit Product Details');

require_once( JPATH_COMPONENT.'/views/membercheckin/tmpl/customeheader.php' );

		
$db = JFactory::getDbo(); 
               
$query = $db->getQuery(true);

 $query->select('*') 
->from($db->quoteName('onm_property')) 
->where($db->quoteName('propertyID')." = ".$db->quote($_GET['productID']));

$db->setQuery($query); 

$propertyDetail =  $db->loadAssocList();
 
    

?>

<link rel="stylesheet" href="<?php echo JURI::root().'components/com_membercheckin/assets/js/assets/css/csdform.css';?>" 
	<script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/jquery.validate.min.js';?>"></script>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
 

	<script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/assets/js/jquery.validate.min.js';?>"></script>
       <script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/assets/js/membercheckin.js';?>"></script>
	<script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/assets/js/attendeeregistration.js';?>"></script>
	<script>
	/*form validate*/
		
	jQuery(document).ready(function(){
		jQuery("#editCompanyfrm").validate(); 
	});
	
	
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

        
	<div class="AddHead">
	<h1 style="padding:5px 20px;">Edit Product Details</h1>
	</div>
	<br/>

	<div class="eventForm">
		<form name="editCompanyfrm" id="editCompanyfrm" method="post" enctype="multipart/form-data">
			<input type="hidden" name="propertyID" id="propertyID" value="<?php echo $_GET['propertyID'];?>" />
			<input type="hidden" name="optMode" value="edit" />
			
                   <?php
				foreach($this->propertyDetail as $cValue){  ?>     

			<div class="maintb">
				<div class="fieldLabel">
					Offer Name<span>*</span>
				</div>
				<div class="fieldinput">
					<input type="text" name="propertyName" id="propertyName" value="<?php echo $cValue['propertyName'];?>" class="required" title="Offer Name is a required field."/>
				</div>
				<?php
				if(!empty($this->$saveRespons['propertyName'])){
					echo '<div class="errorMsg">'.$this->$saveRespons["propertyName"].'</div>';
				}
				?>
			</div>
			
			<div class="maintb">
				<div class="fieldLabel">
					Offer Price<span>*</span>
				</div>
				<div class="fieldinput">
					 <input type="text" name="propertyPrice" id="propertyPrice" value="<?php echo $cValue['propertyPrice'];?>" />
			</div>
			
			<div class="maintb">
				<div class="fieldLabel">Offer Address</div>
				<div class="fieldinput">
	 <input type="text" name="propertyAddress" id="propertyAddress" value="<?php echo $cValue['propertyAddress'];?>" />
				</div>				
			</div>			
						
			<div class="maintb">
				<div class="fieldLabel">About Offer</div>
				<div class="fieldinput">
					<textarea name="propertyDesc" id="propertyDesc"><?php echo $cValue['propertyDesc'];?></textarea>
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




  
  <div class="clear"></div>
 </div>		
			 
                     
                       
		
			<input type="hidden" name="option" value="com_membercheckin" />
			<input type="hidden" name="task" value="editproperty" />
			<div class="maintb">
				<div class="fieldLabel" style="text-indent: -9999em;">&nbsp;</div>
				<div class="fieldinput">
					<input type="submit" value="Save">
				</div>
			</div>
			
		</form>

               <?php
				}
			  ?>
            
	</div>
<?php 

}else{
	 $this->app->redirect(JURI::root());
}
?>
