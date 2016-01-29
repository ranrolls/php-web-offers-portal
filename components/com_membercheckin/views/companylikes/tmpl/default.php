<?php 

/**
 * @package		Joomla.Site
 * @subpackage	com_membercheckin/companylikes
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 * @Author		Sudhish Kumar
 */
 if ( $this->user->id > 0 ) {
	$doc	 = &JFactory::getDocument();
	$doc->setTitle('Company Likes');
	require_once(JPATH_ROOT.DS.'components'.DS.'com_membercheckin'.DS.'views'.DS.'membercheckin'.DS.'tmpl'.DS.'customeheader.php');
?>
		<script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/membercheckin.js';?>"></script>
		<div class="MainBox">
			<div class="top AddHead">
				<h1 style="padding:5px 20px;">Company Detail</h1>
				
			</div>
			
			<div id="community-wrap">
			<?php
			  if(count($this->companyDetail) > 0){
				  foreach($this->companyDetail as $comValue){
				  $comLogo = ($comValue['companyLogo'] != '')?$comValue["companyLogo"]:'nologo.png';
			?>
				<!-- End meetup User Detail . -->
				
				<div class="mini-profile jsFriendList">
					<div class="first">
						<div class="mini-profile-avatar">
							<a href="<?php echo $comValue['companyWebsite'];?>" target="_blank">
								<img alt="logo" src="<?php echo JURI::base();?>images/companyLogo/<?php echo $comLogo;?>" class="cAvatar cAvatar-Large">
							</a>
						</div>
						<div class="mini-profile-details">
							<h2 style="margin-bottom:0 !important" class="name">
								<a href="<?php echo $comValue['companyWebsite'];?>"><strong><?php echo $comValue['companyName'];?></strong></a>
							</h2>
							<div class="mini-profile-details-status"><i><?php echo $comValue['userType'];?></i></div>
							<div class="mini-profile-details-status"><?php echo '--';?></div>
							
						</div>
					</div>
					<div class="second">
						<?php echo $comValue['totalLike'];?><span class="icon-like icon-2x"></span><br/>
						<a href="index.php?option=com_membercheckin&view=companylikesdetail&comID=<?php echo $comValue['companyID'];?>">Detail</a>
					</div>	
				<!-- End meetup User Detail . -->
				</div>	
			<?php
				}
			}else{
				echo '<div class="mini-profile jsFriendList">&nbsp;Not found</div>';
			}
			?>	 
		</div>		
			
	<?php
}else{
	$this->app->redirect(JURI::root());
}
?>
