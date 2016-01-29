<?php

global $alt_libdir;
JLoader::import('joomla.application.component.modellist', $alt_libdir);
jimport('joomla.application.component.helper');
 
class MembercheckinModelAddorganization extends JModelList
{
	public function __construct($config = array())
	{		
	
		parent::__construct($config);		
	}
	
	  
             /*Add Sub category with category id*/

        public function saveOrganizationData($post){
                //print_r($post); die; 
	      $db		       = JFactory::getDBO();  
              $creationDate            = date('Y-m-d H:i:s');

               $query = $db->getQuery(true);
               $columns = array('catid','subcatid','organizationName','creationDate');      
             
              $values = array($db->quote($post['category']),$db->quote($post['subcatid']),$db->quote($post['organizationName']),$db->quote($creationDate));

             $query
                ->insert($db->quoteName('onm_offer_organisation'))
                ->columns($db->quoteName($columns))
                ->values(implode(',', $values));
     
 
            $db->setQuery($query);
 
            $result = $db->execute();
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                  window.alert('Organization Added')
                  window.location.href='index.php?option=com_membercheckin&view=addorganization';
                 </SCRIPT>");
                 die();
             }







	/*
	 *
	 *  This function use to validate Company detail
	 * 
	 * */
	public function validate($post)
	{
		$errorMsg = array();
		$db		  = JFactory::getDBO();
		 
                if(empty($post['organizationName'])){
			$errorMsg['organizationName'] = "Organization name is a required field.";
		}
		 
		 
		return $errorMsg;
	}
	
	 
 


	
}
