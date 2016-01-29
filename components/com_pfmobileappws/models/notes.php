 <?php
/**
* @version		$Id$ $Revision$ $Date$ $Author$ $
* @package		Pfmobileappws
* @subpackage 	Models
* @copyright	Copyright (C) 2015, .
* @license #
*/

// 

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');
/**
 * Methods supporting a list of contact records.
 *
 * @package     Joomla.Site
 * @subpackage  Pfmobileappws
 */
class PfmobileappwsModelnotes extends JModelList
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see     JController
	 * @since   1.6
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
	          	          'id', 'a.id',
	          	          'subject', 'a.subject',
	          	          'catid', 'a.catid',
	          	          'state', 'a.state',
	          	          'created_time', 'a.created_time',
	          	          'checked_out_time', 'a.checked_out_time',
	          	          'checked_out', 'a.checked_out',
	          	          'publish_up', 'a.publish_up',
	          	          'publish_down', 'a.publish_down',
	          	          'user_id', 'a.user_id',
	          	          'subject', 'a.subject',
	          	          'body', 'a.body',
	          	          'created_user_id', 'a.created_user_id',
	          	          'modified_user_id', 'a.modified_user_id',
	          	          'modified_time', 'a.modified_time',
	          	          'review_time', 'a.review_time',
	          	          'id', 'a.id',
	          			);

			$app = JFactory::getApplication();

		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication();

		// Adjust the context to support modal layouts.
		if ($layout = $app->input->get('layout'))
		{
			$this->context .= '.' . $layout;
		}
		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
	
		$published = $this->getUserStateFromRequest($this->context . '.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		// List state information.
		parent::populateState('a.subject', 'asc');
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id    A prefix for the store id.
	 *
	 * @return  string  A store id.
	 * @since   1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
		
		$id .= ':' . $this->getState('filter.published');

		return parent::getStoreId($id);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return  JDatabaseQuery
	 * @since   1.6
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$user = JFactory::getUser();
		$app = JFactory::getApplication();

		$select_fields = $this->getState('list.select', 'a.*'); 
		
		// Select the required fields from the table.
		$query->select( $select_fields);
		
		$query->from('#__user_notes AS a');

	
		// Filter by published state
		$published = $this->getState('filter.published');
		if (is_numeric($published))
		{
			$query->where('a.state = ' . (int) $published);
		}
		elseif ($published === '')
		{
			$query->where('(a.state = 0 OR a.state = 1)');
		}
	
   
		// Filter by search in name.
		$search = $this->getState('filter.search');
		if (!empty($search))
		{
			$query->where('LOWER(a.name) LIKE ' . $this->_db->Quote('%' . $search . '%'));		
		}


		// Add the list ordering clause.
		$orderCol = $this->state->get('list.ordering', 'a.subject');
		$orderDirn = $this->state->get('list.direction', 'asc');
		
		$query->order($db->escape($orderCol . ' ' . $orderDirn));

		return $query;
	}
}
 