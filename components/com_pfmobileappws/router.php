<?php
/**
 * @version		$Id:router.php 1 2015-12-09Z  $
 * @package		Pfmobileappws
 * @subpackage 	Router
 * @copyright	Copyright (C) 2015, . All rights reserved.
 * @license #
 */  

require_once(JPATH_ADMINISTRATOR.'/components/com_pfmobileappws/helpers/pfmobileappws.php');

defined('_JEXEC') or die('Restricted access');

  function PfmobileappwsBuildRoute( &$query )
  {
  	$segments = array();
  	  	
  	$catviews = PfmobileappwsHelper::getCategoryViews();
  	
  	$listviews = array_keys($catviews);

	// get a menu item based on Itemid or currently active
	$app = JFactory::getApplication();
	$params = JComponentHelper::getParams('com_pfmobileappws');
	$advanced = $params->get('sef_advanced_link', 0);
	$menu = $app->getMenu();

	if (empty($query['Itemid']))
	{
		$menuItem = $menu->getActive();
	}
	else
	{
		$menuItem = $menu->getItem($query['Itemid']);
	}
	$mView = (empty($menuItem->query['view'])) ? null : $menuItem->query['view'];
	$mId = (empty($menuItem->query['id'])) ? null : $menuItem->query['id'];

	if (isset($query['view']))
	{
		$view = $query['view'];
		if (empty($query['Itemid']) || empty($menuItem) || $menuItem->component != 'com_pfmobileappws')
		{
			$segments[] = $query['view'];
			unset($query['view']);
		}
		
	}

	// are we dealing with a contact that is attached to a menu item?
	if (isset($view) && ($mView == $view) and (!in_array($view, $listviews)) and (isset($query['id'])) and ($mId == (int) $query['id']))
	{
		unset($query['view']);
		unset($query['category']);
		unset($query['id']);
		return $segments;
	}

	// category (list) views
	if (isset($view) && in_array($view, $listviews))
	{
		$segments[] = $query['view'];
		unset($query['view']);		
		
		if ((isset($query['id']) && ($mId != (int) $query['id'])) || $mView != $view)
		{
			if (isset($query['category']))
			{
				$catid = $query['category'];				 
			}
			elseif (isset($query['id']))
			{
				$catid = $query['id'];
			}
			$menuCatid = $mId;
			
			$options = array('extension'=>$catviews[$view]);
			
			$categories = JCategories::getInstance('Pfmobileappws', $options);
			$category = $categories->get((int) $catid);			
			if ($category)
			{
				//TODO Throw error that the category either not exists or is unpublished
				$path = array_reverse($category->getPath());

				$array = array();
				foreach ($path as $id)
				{
					if ((int) $id == (int) $menuCatid)
					{
						break;
					}					
					$array[] = $id;
				}
				$segments = array_merge($segments, array_reverse($array));
			}
		}
		unset($query['id']);
		unset($query['category']);
	} else {
		if(isset($query['view'])) {
			$segments[] = $query['view'];
			unset($query['view']);
		}
		if(isset($query['id'])) {
			$segments[] = $query['id'];
			unset($query['id']);
		}
	}
    
	return $segments;  	
  } // End PfmobileappwsBuildRoute function
  
  function PfmobileappwsParseRoute( $segments )
  {
  	$vars = array();
  
  	$catviews = PfmobileappwsHelper::getCategoryViews();
  	$extensionviews = array_flip($catviews);
  	$listviews = array_keys($catviews);

  	//Get the active menu item.
  	$app = JFactory::getApplication();
  	
  	$params = JComponentHelper::getParams('com_pfmobileappws');
  	$advanced = $params->get('sef_advanced_link', 0);
  	  	
  	$menu = $app->getMenu();
  	
  	$item = $menu->getActive();
  	
  	// Count route segments
  	$count = count($segments);
  	
  	
  	// Standard routing
  	if (!isset($item))
  	{
  		$vars['view'] = $segments[0];
  		$isList = in_array($vars['view'], $listviews);
  		if($isList && $count > 1) {
  			$vars['category'] = $segments[$count - 1];
  		} elseif(!$isList && $count > 1) {
  			$vars['id'] = $segments[$count - 1];
  		}
  	
  		return $vars;
  	}
   	 	
  	if(count($segments > 0)) {
  		$vars['view'] = $segments[0];
  		switch($vars['view']) {
  			case 'note':
      		$id   = explode(':', $segments[1]);      		
      		$vars['id']= (int) $id[0];        
			break;
case 'oauthaccess':
      		$id   = explode(':', $segments[1]);      		
      		$vars['id']= (int) $id[0];        
			break;
case 'oauthaccesslist':
      		$id   = explode(':', $segments[1]);      		
      		$vars['id']= (int) $id[0];        
			break;
case 'productlist':
      		$id   = explode(':', $segments[1]);      		
      		$vars['id']= (int) $id[0];        
			break;
case 'products':
      		$id   = explode(':', $segments[1]);      		
      		$vars['id']= (int) $id[0];        
			break;
case 'tasks':
      		$id   = explode(':', $segments[1]);      		
      		$vars['id']= (int) $id[0];        
			break;

  		}
              
    } else {
      $vars['view'] = $segments[0];
    } // End count(segments) statement

    return $vars;
  } // End PfmobileappwsParseRoute  
?>
