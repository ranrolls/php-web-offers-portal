<?php

global $alt_libdir;
JLoader::import('joomla.application.component.modellist', $alt_libdir);
jimport('joomla.application.component.helper');
 
class MembercheckinModelAddSubCategory extends JModelList
{
	public function __construct($config = array())
	{		
	
		parent::__construct($config);		
	}
	
	  
             /*Add Sub category with category id*/

        public function saveSubCategoryData($post){
                    
	      $db		       = JFactory::getDBO();  
              $creationDate            = date('Y-m-d H:i:s');

               $query = $db->getQuery(true);
               $columns = array('catid','subcategoryName','creationDate');      

              $values = array($db->quote($post['category']),$db->quote($post['subcategoryName']),$db->quote($creationDate));

             $query
                ->insert($db->quoteName('onm_product_subcategory'))
                ->columns($db->quoteName($columns))
                ->values(implode(',', $values));
     
 
            $db->setQuery($query);
 
            $result = $db->execute();
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                  window.alert('Sub Category Added')
                  window.location.href='index.php?option=com_membercheckin&view=addsubcategory';
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
		 
                if(empty($post['subcategoryName'])){
			$errorMsg['subcategoryName'] = "Sub category name is a required field.";
		}
		 
		 
		return $errorMsg;
	}
	
	 
 


	
}
