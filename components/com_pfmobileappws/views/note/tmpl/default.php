<?php
/**
* @version		$Id:default.php 1 2015-12-09 05:18:21Z  $
* @copyright	Copyright (C) 2015, . All rights reserved.
* @license 		
*/
// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>"><h2><?php echo $this->params->get('page_title');  ?></h2></div>
<h3><?php echo $this->item->subject; ?></h3>
<div class="contentpane">
	<div><h4>Some interesting informations</h4></div>
		<div>
		Id: <?php echo $this->item->id; ?>
	</div>
		
		<div>
		Subject: <?php echo $this->item->subject; ?>
	</div>
		
		<div>
		Catid: <?php echo $this->item->catid; ?>
	</div>
		
		<div>
		State: <?php echo $this->item->state; ?>
	</div>
		
		<div>
		Created_time: <?php echo $this->item->created_time; ?>
	</div>
		
		<div>
		Checked_out_time: <?php echo $this->item->checked_out_time; ?>
	</div>
		
		<div>
		Checked_out: <?php echo $this->item->checked_out; ?>
	</div>
		
		<div>
		Publish_up: <?php echo $this->item->publish_up; ?>
	</div>
		
		<div>
		Publish_down: <?php echo $this->item->publish_down; ?>
	</div>
		
		<div>
		User_id: <?php echo $this->item->user_id; ?>
	</div>
		
		<div>
		Subject: <?php echo $this->item->subject; ?>
	</div>
		
		<div>
		Body: <?php echo $this->item->body; ?>
	</div>
		
		<div>
		Created_user_id: <?php echo $this->item->created_user_id; ?>
	</div>
		
		<div>
		Modified_user_id: <?php echo $this->item->modified_user_id; ?>
	</div>
		
		<div>
		Modified_time: <?php echo $this->item->modified_time; ?>
	</div>
		
		<div>
		Review_time: <?php echo $this->item->review_time; ?>
	</div>
		
		<div>
		Id: <?php echo $this->item->id; ?>
	</div>
		
	</div>
 