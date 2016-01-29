<?php 

/**
 * @package		Joomla.Site
 * @subpackage	com_membercheckin
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 * @Author		Sudhish Kumar
 */
 if ( $this->user->id > 0 ) {
		
	$doc	 = &JFactory::getDocument();
	$doc->setTitle('User Visit Detail');
	require_once(JPATH_ROOT.DS.'components'.DS.'com_membercheckin'.DS.'views'.DS.'membercheckin'.DS.'tmpl'.DS.'customeheader.php');
	if(count($this->memberDetail) > 0){
?>
		
		<div class="MainBox">
			<div class="top AddHead">
				<h1 style="padding:5px 20px;">Member Session</h1>
			</div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="xzz1">
			  <tr>
				<td width="45%">Name</td>
				<td width="30%">Type</td>
				<td width="5%">Web</td>
				<td width="5%">IOS</td>
				<td width="5%">Android</td>
				<td width="10%">Total</td>
			  </tr>
			  </table>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="allcheckinMember" class="xzz2">
			  
			  <?php
				foreach($this->memberDetail as $cValue){
					$totalVisit = $cValue['totalTime'] + $cValue['webTotal'];
			  ?>
				  <tr>
					<td width="45%"><?php echo $cValue['name'];?></td>
					<td width="30%"><?php echo $cValue['usertype'];?></td>
					<td width="5%"><?php echo $cValue['webTotal'];?></td>
					<td width="5%"><?php echo $cValue['iosTotal'];?></td>
					<td width="5%"><?php echo $cValue['androidTotal'];?></td>
					<td width="10%"><?php echo $totalVisit;?></td>
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
