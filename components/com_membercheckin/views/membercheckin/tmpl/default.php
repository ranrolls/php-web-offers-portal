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
	$doc->setTitle('Property Approval List');
	require_once( JPATH_COMPONENT.'/views/membercheckin/tmpl/customeheader.php' );

 //print_r($this->propertyDetail);

	if(count($this->propertyDetail) > 0){
?>
 

		 <script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/membercheckin.js';?>"></script> 


<script type="text/javascript">
		var memberDetailArray = new Array(); 
		var attendeeUserArray = new Array(); 
	</script>
<!--
<div class="searchChekin" style="padding:5px;">
					<span>Name Search</span><input type="text" name="chekinMember" id="chekinMember" value=""/>
				</div>-->


		<div class="MainBox">
			<div class="top AddHead">
				<h1 style="padding:5px 20px;">Property Approval Details</h1>
			</div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="xzz1">
			  <tr>
				 <td class="Name">Agent Name</td>  
                                <td class="Name">Property Name</td>
                                <td class="Name">Property Image</td>
                                <td class="Name">Property Address</td>
                                <td class="Name">Property Price</td>
                                <td class="Name">Creation Date</td>
				 <td class="checkinStatus">
				 <div>Approval Current Status</div>  
				   </td>
                                 <td class="checkinStatus">Action</td>
			  </tr>
			  </table>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="allcheckinMember" class="xzz2">
			  
			  <?php
                                    $i = 0;$j=0;
				foreach($this->propertyDetail as $mValue){
                                  $propertyID=$mValue['propertyID'];
                                     
                                  $imgsrc = JURI::base().'images/productLogo/'.$mValue['productLogo'];
$imgsrc_check = JURI::base().'images/productLogo/check.png';
$imgsrc_uncheck = JURI::base().'images/productLogo/uncheck.jpg';
                                   
			  ?>
				  <tr lang="<?php echo $mValue['propertyID'];?>" id="property_<?php echo $mValue['propertyID'];?>">
					<td class="Name"><div><?php echo $mValue['agentName'];?></div></td>
                                        <td class="Name"><div><?php echo $mValue['propertyName'];?></div></td>
					<td class="usertype"><div><img src="<?php echo $imgsrc;?>" width="120px" height="120px"/></div></td>
<td class="Name"><div><?php echo $mValue['propertyAddress'];?></div></td>
<td class="Name"><div><?php echo $mValue['propertyPrice'];?></div></td>
<td class="Name"><div><?php echo $mValue['creationDate'];?></div></td> 
  
 
<td class="checkinStatus" id="checkinOptID_<?php echo $mValue['propertyID'];?>">
 
 <?php if($mValue['approval_status'] =='0'){ echo "Not Approved"; ?>

<a href="javascript:void(0);" onclick="memberCheckin('<?php echo $mValue['propertyID'];?>',1)" style="float:none !important"><i class="icon-ok-sign icon-2x uncheck"></i><img src="<?php echo $imgsrc_check;?>"/></a>

  
<?php }else{ echo "Approved";?><br/>

<a href="javascript:void(0);" onclick="memberCheckin('<?php echo $mValue['propertyID'];?>',0)" style="float:none !important"><i class="icon-ok-sign icon-2x uncheck"></i><img src="<?php echo $imgsrc_uncheck;?>"/></a>

 
 
<?php } ?> 
</td>

<td width="10%"><a href="index.php?option=com_membercheckin&view=editcheckinproperty&propertyID=<?php echo $mValue['propertyID'];?>" title="Edit <?php echo $mValue['propertyName'];?>">Edit</a>
					</td>
 

  </tr>
                                   
                                   

			  <?php
				       $j++;  
					 $i++;
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