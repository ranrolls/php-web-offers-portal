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


 $doc	 = JFactory::getDocument();
 $doc->setTitle('Edit Approval Property Details');

require_once( JPATH_COMPONENT.'/views/membercheckin/tmpl/customeheader.php' );

		
$db = JFactory::getDbo(); 
               
$query = $db->getQuery(true);

 $query->select('*') 
->from($db->quoteName('onm_property')) 
->where($db->quoteName('propertyID')." = ".$db->quote($_GET['propertyID']));

$db->setQuery($query); 

$propertyDetail =  $db->loadAssocList();
 
//print_r($propertyDetail);


    

?>
	<script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/jquery.validate.min.js';?>"></script>
	<script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/membercheckin.js';?>"></script>
	<script>
	/*form validate*/
		
	jQuery(document).ready(function(){
		jQuery("#editCompanyfrm").validate(); 
	});
	
	
	</script>
        
	<div class="AddHead">
	<h1 style="padding:5px 20px;">Edit Approval Product Details</h1>
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
					Admin Name<span></span>
				</div> 
<div class="fieldinput">
	 <input type="text" name="agentName"  id="agentName" readonly="true" value="<?php echo $cValue['agentName'];?>" class="required" title="Property Name is a required field."/>
				</div>
				
 
<div class="maintb">
				<div class="fieldLabel">
					Product Name<span>*</span>
				</div> 
				<div class="fieldinput">
					<input type="text" name="propertyName" id="propertyName" value="<?php echo $cValue['propertyName'];?>" class="required" title="Property Name is a required field."/>
				</div>
				<?php
				if(!empty($this->$saveRespons['propertyName'])){
					echo '<div class="errorMsg">'.$this->$saveRespons["propertyName"].'</div>';
				}
				?>
			</div>
			
			<div class="maintb">
				<div class="fieldLabel">
					Product Price<span>*</span>
				</div>
				<div class="fieldinput">
					 <input type="text" name="propertyPrice" id="propertyPrice" value="<?php echo $cValue['propertyPrice'];?>" />
			</div>
			
			<div class="maintb">
				<div class="fieldLabel">Product Address</div>
				<div class="fieldinput">
	 <input type="text" name="propertyAddress" id="propertyAddress" value="<?php echo $cValue['propertyAddress'];?>" />
				</div>				
			</div>			
						
			<div class="maintb">
				<div class="fieldLabel">About Product</div>
				<div class="fieldinput">
					<textarea name="propertyDesc" id="propertyDesc"><?php echo $cValue['propertyDesc'];?></textarea>
				</div>				
			</div>			
				
			<div class="maintb">
				<div class="fieldLabel">Product Logo</div>
				<div class="fieldinput">
					<input type="file" name="productLogo" id="productLogo" class="" accept="png,jpeg,jpg,gif" title="Please upload valid product logo." />
				</div>				
			</div>
			<?php 
			if($cValue['productLogo']!= ""){
				 $imgsrc = JURI::base().'images/productLogo/'.$cValue['productLogo'];
			?>	
			<div class="maintb">
				<div class="fieldLabel">&nbsp;</div>
				<div class="fieldinput">
					<img src="<?php echo $imgsrc;?>" width="120px" height="120px"/>
				</div>				
			</div>	
			<?php
			}
                            
			?>
                     
                       
		
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
