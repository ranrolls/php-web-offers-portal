<?php
/**
* @version		$Id:edit.php 1 2015-12-09 05:18:21Z  $
* @copyright	Copyright (C) 2015, . All rights reserved.
* @license 		
*/
// no direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

// Set toolbar items for the page
$edit		= JFactory::getApplication()->input->get('edit', true);
$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );
JToolBarHelper::title(   JText::_( 'Note' ).': <small><small>[ ' . $text.' ]</small></small>' );
JToolBarHelper::apply('note.apply');
JToolBarHelper::save('note.save');
if (!$edit) {
	JToolBarHelper::cancel('note.cancel');
} else {
	// for existing items the button is renamed `close`
	JToolBarHelper::cancel( 'note.cancel', 'Close' );
}
?>

<script language="javascript" type="text/javascript">


Joomla.submitbutton = function(task)
{
	if (task == 'note.cancel' || document.formvalidator.isValid(document.id('adminForm'))) {
		Joomla.submitform(task, document.getElementById('adminForm'));
	}
}

</script>

	 	<form method="post" action="<?php echo JRoute::_('index.php?option=com_pfmobileappws&layout=edit&id='.(int) $this->item->id);  ?>" id="adminForm" name="adminForm">
	 	<div class="col <?php if(version_compare(JVERSION,'3.0','lt')):  ?>width-60  <?php endif; ?>span8 form-horizontal fltlft">
		  <fieldset class="adminform">
			<legend><?php echo JText::_( 'Details' ); ?></legend>
		
				<div class="control-group">
					<div class="control-label">					
						<?php echo $this->form->getLabel('catid'); ?>
					</div>
					
					<div class="controls">	
						<?php echo $this->form->getInput('catid');  ?>
					</div>
				</div>		

				<div class="control-group">
					<div class="control-label">					
						<?php echo $this->form->getLabel('user_id'); ?>
					</div>
					
					<div class="controls">	
						<?php echo $this->form->getInput('user_id');  ?>
					</div>
				</div>		

				<div class="control-group">
					<div class="control-label">					
						<?php echo $this->form->getLabel('subject'); ?>
					</div>
					
					<div class="controls">	
						<?php echo $this->form->getInput('subject');  ?>
					</div>
				</div>		

				<div class="control-group">
					<div class="control-label">					
						<?php echo $this->form->getLabel('body'); ?>
					</div>
				<?php if(version_compare(JVERSION,'3.0','lt')): ?>
				<div class="clr"></div>
				<?php  endif; ?>						
					
					<div class="controls">	
						<?php echo $this->form->getInput('body');  ?>
					</div>
				</div>		

				<div class="control-group">
					<div class="control-label">					
						<?php echo $this->form->getLabel('created_user_id'); ?>
					</div>
					
					<div class="controls">	
						<?php echo $this->form->getInput('created_user_id');  ?>
					</div>
				</div>		

				<div class="control-group">
					<div class="control-label">					
						<?php echo $this->form->getLabel('modified_user_id'); ?>
					</div>
					
					<div class="controls">	
						<?php echo $this->form->getInput('modified_user_id');  ?>
					</div>
				</div>		

				<div class="control-group">
					<div class="control-label">					
						<?php echo $this->form->getLabel('modified_time'); ?>
					</div>
					
					<div class="controls">	
						<?php echo $this->form->getInput('modified_time');  ?>
					</div>
				</div>		

				<div class="control-group">
					<div class="control-label">					
						<?php echo $this->form->getLabel('review_time'); ?>
					</div>
					
					<div class="controls">	
						<?php echo $this->form->getInput('review_time');  ?>
					</div>
				</div>		
					
					
		
				<div class="control-group">
					<div class="control-label">					
						<?php echo $this->form->getLabel('state'); ?>
					</div>
					
					<div class="controls">	
						<?php echo $this->form->getInput('state');  ?>
					</div>
				</div>		
			
						
          </fieldset>                      
        </div>
        <div class="col <?php if(version_compare(JVERSION,'3.0','lt')):  ?>width-30  <?php endif; ?>span2 fltrgt">
		        
			<fieldset class="adminform">
				<legend><?php echo JText::_( 'Parameters' ); ?></legend>
		
				<div class="control-group">
					<div class="control-label">					
						<?php echo $this->form->getLabel('publish_down'); ?>
					</div>
					
					<div class="controls">	
						<?php echo $this->form->getInput('publish_down');  ?>
					</div>
				</div>		

				<div class="control-group">
					<div class="control-label">					
						<?php echo $this->form->getLabel('publish_up'); ?>
					</div>
					
					<div class="controls">	
						<?php echo $this->form->getInput('publish_up');  ?>
					</div>
				</div>		

				<div class="control-group">
					<div class="control-label">					
						<?php echo $this->form->getLabel('created_time'); ?>
					</div>
					
					<div class="controls">	
						<?php echo $this->form->getInput('created_time');  ?>
					</div>
				</div>		
								
			</fieldset>
			        

        </div>                   
		<input type="hidden" name="option" value="com_pfmobileappws" />
	    <input type="hidden" name="cid[]" value="<?php echo $this->item->id ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="view" value="note" />
		<?php echo JHTML::_( 'form.token' ); ?>
	</form>