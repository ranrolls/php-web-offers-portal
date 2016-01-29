<?php 

/**
 * @package		Joomla.Site
 * @subpackage	com_membercheckin/companylikes
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 * @Author		Vishal Kumar
 */
 if ( $this->user->id > 0 ) {

      

 $doc	 = JFactory::getDocument();
 $doc->setTitle('Agent Detail');

require_once(JPATH_ROOT.DS.'components'.DS.'com_membercheckin'.DS.'views'.DS.'membercheckin'.DS.'tmpl'.DS.'customeheader.php');

		
$db = JFactory::getDbo(); 
               
$query = $db->getQuery(true); //->join('INNER','#__categories as cat ON cat.id = c.catid')

  $query->select('*') 
->from($db->quoteName('h_users'))  
->where($db->quoteName('id')." = ".$db->quote($_GET['agentid']));

 $db->setQuery($query); 

 $agentDetail=  $db->loadAssocList();
 
//print_r($agentDetail);



	$doc	 = &JFactory::getDocument();
	$doc->setTitle('Agent Detail');
	require_once(JPATH_ROOT.DS.'components'.DS.'com_membercheckin'.DS.'views'.DS.'membercheckin'.DS.'tmpl'.DS.'customeheader.php');
?>
		<script src="<?php echo JURI::root().'components/com_membercheckin/assets/js/membercheckin.js';?>"></script>
		<div class="MainBox">
			<div class="top AddHead">
				<h1 style="padding:5px 20px;">Agent Detail</h1>
			</div>
			
			<div id="community-wrap">
			<?php
			  if(count($agentDetail) > 0){
				  foreach($agentDetail as $mValue){

                                      
 $memberPic = ($mValue['avatar'] != '')?$mValue["avatar"]:'components/com_membercheckin/assets/images/user@2x.png.jpg';
                              
				   
			?>
				<!-- End meetup User Detail . -->
				
				<div class="mini-profile jsFriendList">
					<div class="first">
						<div class="mini-profile-avatar">
							
<img alt="member" src="<?php echo JURI::base().$memberPic;?>" class="cAvatar cAvatar-Large" style="width:55px !important;">
  		</div>
						<div class="mini-profile-details">
							 
								<?php echo $mValue['name'];?>
							 
	 <div class="mini-profile-details"><?php echo $mValue['username'];?></div>
							
						</div>
					</div>
					<div class="mini-profile-details">
						<?php echo $mValue['email'];?>
					</div>
<div class="mini-profile-details">
 <?php echo $mValue['registerDate'];?>
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
