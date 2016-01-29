<?php
/* 
 * Author Onsumaye (Vishal Kumar)
 * @subpackage	com_membercheckin
 * No direct access to this file  
* */
 

defined( '_JEXEC' ) or die( 'Restricted access' );
 

jimport('joomla.application.component.controller');


class MembercheckinController extends JControllerLegacy{
	
   
	 
	/*
	 * Requirement: This function is used to update the user checkin status for ajax based
	 * Updated By: Vishal Kumar
	 * Updated On: 21 March 2013
	 * */
	 
            

            public function get_subcategory(){
		$db		       = JFactory::getDBO(); 
		$data			= JRequest::get('post');
                 $query = $db->getQuery(true); 
                
                  $query->select('*') 
                        ->from($db->quoteName('onm_product_subcategory'))
                        ->where($db->quoteName('catid')." = ".$db->quote($data['category']));

                  $db->setQuery($query);  
                    $results =  $db->loadAssocList(); 
                      echo '<option value="">Select Sub Category</option>'; 
	          foreach($results as $subcategory) { 
                     echo '<option value="'.$subcategory['subcatid'].'">'.$subcategory['subcategoryName'].'</option>';
                 
	           }
                
                       die;
              }


           
            public function get_sub_category_organisation(){
		$db		       = JFactory::getDBO(); 
		$data			= JRequest::get('post');
                 $query = $db->getQuery(true); 
                
                  $query->select('*') 
                        ->from($db->quoteName('onm_product_subcategory'))
                        ->where($db->quoteName('catid')." = ".$db->quote($data['category']));

                  $db->setQuery($query);  
                    $results =  $db->loadAssocList(); 
                      echo '<option value="">Select Sub Category</option>'; 
	          foreach($results as $subcategory) { 
                     echo '<option value="'.$subcategory['subcatid'].'">'.$subcategory['subcategoryName'].'</option>';
                 
	           }
                
                       die;
              }

            
              public function get_sub_category_location(){
		$db		       = JFactory::getDBO(); 
		$data			= JRequest::get('post');
                 $query = $db->getQuery(true); 
                
                  $query->select('*') 
                        ->from($db->quoteName('onm_offer_organisation'))
                        ->where($db->quoteName('subcatid')." = ".$db->quote($data['subcatid']));

                  $db->setQuery($query);  
                    $results =  $db->loadAssocList(); 
                      echo '<option value="">Select Organization</option>'; 
	          foreach($results as $organization) { 
                     echo '<option value="'.$organization['organization_id'].'">'.$organization['organizationName'].'</option>';
                 
	           }
                
                       die;
              }



             public function get_location_org_id(){
		$db		       = JFactory::getDBO(); 
		$data			= JRequest::get('post');
                 $query = $db->getQuery(true); 
                
                  $query->select('*') 
                        ->from($db->quoteName('onm_offer_location'))
                        ->where($db->quoteName('org_id')." = ".$db->quote($data['orgid']));

                  $db->setQuery($query);  
                    $results =  $db->loadAssocList(); 
                      echo '<option value="">Select Location</option>'; 
	          foreach($results as $location) { 
                     echo '<option value="'.$location['location_id'].'">'.$location['locationName'].'</option>';
                 
	           }
                
                       die;
              }


            
            public function ajaxMeberchekinStatusUpdate(){
		$db		       = JFactory::getDBO(); 
		$data			= JRequest::get('post'); 
		$updatedByStartx       = date('Y-m-d h:i:s');

		$approval_Status 	= ($data['approval_status'] == 1)?'1':'0';
		$query = $db->getQuery(true);

		$fields = array(
		$db->quoteName('approval_status') . ' = ' . $db->quote($approval_Status),
		);  

		$conditions = array( 
		$db->quoteName('propertyID') . ' = ' . $db->quote($data['propertyID'])
		);


		$query->update($db->quoteName('onm_property'))->set($fields)->where($conditions);

		$db->setQuery($query);
		$result = $db->execute();
		echo '1';
		die();
            }


                  
               /*
	 * 
	 *This function use to delete the event process 
	 * 
	 */
	 
	public function ajaxDeteleProduct(){
		$db		= JFactory::getDBO();
		$data	        = JRequest::get('post');
		///$data['propertyID'] 
                
		 $query  = "DELETE FROM #__property WHERE propertyID= '".$data['propertyID']."'";
		 $db->setQuery($query);
		 $db->query();
		
 		echo '1';
		die();
	    }

                 
  
	 
} 


?>
