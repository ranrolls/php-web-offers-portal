<?php 

/**
 * @package		Joomla.Site
 * @subpackage	com_membercheckin
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 * @Author		Vishal Kumar
 */
 if ( $this->user->id > 0 ) {
		 
	$doc	 = JFactory::getDocument();
	$doc->setTitle('Property List');
	require_once( JPATH_COMPONENT.'/views/membercheckin/tmpl/customeheader.php' );


	if(count($this->allproperty) > 0){
?>
		 <script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/membercheckin.js';?>"></script> 

		<div class="MainBox">
			<div class="top AddHead">
				<h1 style="padding:5px 20px;">Product Details</h1>
			</div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="xzz1">
			  <tr>
				<td width="30%">Product Name</td>
                                 <td width="45%">Product Image</td>
				<td width="45%">Product Price</td>
				<td width="15%">Product Address</td>
                                
				<td width="10%">Action</td>
			  </tr>
			  </table>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="allcheckinMember" class="xzz2">
			  
			  <?php
				foreach($this->allproperty as $cValue){
                                    

                                  $imgsrc = JURI::base().'images/productLogo/'.$cValue['productLogo'];
			  ?>
				  <tr>
					<td width="20%"><?php echo $cValue['propertyName'];?></td>
                                         <td width="30%"> <img src="<?php echo $imgsrc;?>" width="120px" height="120px"/></td>
 

					<td width="20%"><?php echo $cValue['propertyPrice'];?></td>
					<td width="20%"><?php echo $cValue['propertyAddress'];?></td>
 
<td width="20%" id="evntProcess_<?php echo $cValue['propertyID'];?>">
<a href="javascript:void(0);" onclick="ajaxDeteleProductbyID('<?php echo $cValue['propertyID'];?>')" style="float:none !important">Delete</a>
</td>
                    
                      

<td width="20%"><a href="index.php?option=com_membercheckin&view=editproperty&productID=<?php echo $cValue['propertyID'];?>" title="Edit <?php echo $cValue['propertyName'];?>">Edit<!--<img src="http://myhouse.mytechnocrates.com/images/propertyLogo/document_edit.png"/>--></a>
					</td>
				  </tr>
			  <?php
				}
			  ?>
			</table>
		</div>	
	<?php
	}else{
		echo '<div class="noresult">&nbsp; Not found</div>';
	}
}else{
	$this->app->redirect(JURI::root());
}
?>
