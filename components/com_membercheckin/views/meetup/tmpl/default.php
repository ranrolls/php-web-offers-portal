<?php 

/**
 * @package		Joomla.Site
 * @subpackage	com_membercheckin/Meetup
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 * @Author		Sudhish Kumar
 */

if ( $this->user->id > 0 ) {

	require_once(JPATH_ROOT.DS.'components'.DS.'com_membercheckin'.DS.'views'.DS.'membercheckin'.DS.'tmpl'.DS.'customeheader.php');
?>
	<div class="AddHead">
		<h1 style="padding:5px 20px;"> Meet Up Requests</h1>
	</div>
	<div id="community-wrap">
	<!-- Start meetup User Detail . -->
	<?php 
	if(count($this->meetupDetail) > 0){
		foreach($this->meetupDetail as $meetVal){
			//echo $meetVal['thumb'];
			$userImage = ($meetVal['thumb'] == '')?'http://startx.onsumaye.com/components/com_community/assets/user_thumb.png':$meetVal['thumb'];
	?>
			<div class="mini-profile jsFriendList">
			 <div class="first">
				<div class="mini-profile-avatar">
					<a href="index.php/<?php echo str_replace(':','-',$meetVal['userLink']);?>/profile">
						<img class="cAvatar cAvatar-Large" src="<?php echo $userImage;?>" alt="<?php echo $meetVal['name'];?>">
					</a>
				</div>
				<div class="mini-profile-details">
					<h2 class="name" style="margin-bottom:0 !important">
						<a href="index.php/<?php echo str_replace(':','-',$meetVal['userLink']);?>/profile"><strong><?php echo $meetVal['name'];?></strong></a>
					</h2>
					<div class="mini-profile-details-status"><i><?php echo $meetVal['usertype'];?></i></div>
					<div class="mini-profile-details-status"><?php echo $meetVal['jobTitle'].' at '.$meetVal['companyName'];?></div>
					
				</div>
				</div>
				<div  class="second">
				<!--h4 class="name">
						Meetup Request - <?php echo $meetVal['timeslot'];?>
					</h4>
				<div class="jsAbs jsFriendRespond">
					<input type="submit" class="button" style="margin:0" value="YES">
					<input type="submit" class="button" style="margin:0" value="NO">
					<input type="submit" class="button" style="margin:0" value="LATER">
				</div-->
				</div>
			</div>
	<!-- End meetup User Detail . -->
	<?php 
		}
	}else{
		echo '<div class="mini-profile jsFriendList">No-data</div>';
	}
	?>				
<?php 

}else{
	 $this->app->redirect(JURI::root());
}
?>
</div>
