<?php
/**
* @version		$Id:note.php 1 2015-12-09 05:18:21Z  $
* @package		Pfmobileappws
* @subpackage 	Views
* @copyright	Copyright (C) 2015, . All rights reserved.
* @license #
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

 
class PfmobileappwsViewnotes  extends JViewLegacy {


	protected $items;

	protected $pagination;

	protected $state;
	
	
	/**
	 *  Displays the list view
 	 * @param string $tpl   
     */
	public function display($tpl = null)
	{
		
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		PfmobileappwsHelper::addSubmenu('notes');

		$this->addToolbar();
		if(!version_compare(JVERSION,'3','<')){
			$this->sidebar = JHtmlSidebar::render();
		}
		
		if(version_compare(JVERSION,'3','<')){
			$tpl = "25";
		}
		parent::display($tpl);
	}
	
	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 */
	protected function addToolbar()
	{
		
		$canDo = PfmobileappwsHelper::getActions();
		$user = JFactory::getUser();
		JToolBarHelper::title( JText::_( 'Note' ), 'generic.png' );
		if ($canDo->get('core.create')) {
			JToolBarHelper::addNew('note.add');
		}	
		
		if (($canDo->get('core.edit')))
		{
			JToolBarHelper::editList('note.edit');
		}
		
				
		if ($this->state->get('filter.state') != 2)
		{
			JToolbarHelper::publish('notes.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('notes.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		}
				
		if ($canDo->get('core.edit.state'))
		{
			if ($this->state->get('filter.state') != -1)
			{
				if ($this->state->get('filter.state') != 2)
				{
					JToolbarHelper::archiveList('notes.archive');
				}
				elseif ($this->state->get('filter.state') == 2)
				{
					JToolbarHelper::unarchiveList('notes.publish');
				}
			}
			
		}
				
				if ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::checkin('notes.checkin');
		}
				

		if ($this->state->get('filter.state') == -2 && $canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('', 'notes.delete', 'JTOOLBAR_EMPTY_TRASH');
		}
				elseif ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::trash('notes.trash');
		}		
				
		
		JToolBarHelper::preferences('com_pfmobileappws', '550');  
		if(!version_compare(JVERSION,'3','<')){		
			JHtmlSidebar::setAction('index.php?option=com_pfmobileappws&view=notes');
		}
				if(!version_compare(JVERSION,'3','<')){
			JHtmlSidebar::addFilter(
				JText::_('JOPTION_SELECT_PUBLISHED'),
				'filter_state',
				JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true)
			);
		}
				
					
	}	
	

	/**
	 * Returns an array of fields the table can be sorted by
	 *
	 * @return  array  Array containing the field name to sort by as the key and display text as value
	 */
	protected function getSortFields()
	{
		return array(
		 	          'a.subject' => JText::_('Subject'),
	     	          'a.created_time' => JText::_('Created_time'),
	     	          'a.state' => JText::_('JSTATUS'),
	     	          'a.id' => JText::_('JGRID_HEADING_ID'),
	     		);
	}	
}
?>
