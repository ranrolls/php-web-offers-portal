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
		
	$doc	 = &JFactory::getDocument();
	$doc->setTitle('Agent List');
	require_once(JPATH_ROOT.DS.'components'.DS.'com_membercheckin'.DS.'views'.DS.'membercheckin'.DS.'tmpl'.DS.'customeheader.php');
	if(count($this->AgentDetail) > 0){
?>
		<script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/membercheckin.js';?>"></script>
		<div class="MainBox">
			<div class="top AddHead">
				<h1 style="padding:5px 20px;">Agent List</h1>
			</div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="xzz1">
			  <tr>
				<td width="30%">Name</td>
				<td width="45%">Email</td>
				<td width="15%">Registered Date</td>
				<td width="10%">Action</td>
			  </tr>
			  </table>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="allcheckinMember" class="xzz2">
			  
			  <?php
				foreach($this->AgentDetail as $cValue){
			  ?>
				  <tr>
					<td width="30%"><?php echo $cValue['name'];?></td>
					<td width="45%"><?php echo $cValue['email'];?></td>
					<td width="15%"><?php echo $cValue['registerDate'];?></td>
					<td width="10%"><a href="index.php?option=com_membercheckin&view=agentdetails&agentid=<?php echo $cValue['id'];?>" title="Edit <?php echo $cValue['name'];?>">Details</a>
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
