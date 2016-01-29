<?php

global $alt_libdir;
JLoader::import('joomla.application.component.modellist', $alt_libdir);
jimport('joomla.application.component.helper');
 
class MembercheckinModelAddCategory extends JModelList
{
	public function __construct($config = array())
	{		
	
		parent::__construct($config);		
	}
	
	 

	 	/*
	 *
	 *  This function use to save Company detail
	 * 
	 * */
	public function saveCategoryData($post){
                 //print_r($post);  die;
                 
		$db = JFactory::getDbo(); 
		  
                $creationDate=date('Y-m-d H:i:s');
               
                $query = $db->getQuery(true);

                
                $allawExtation       = array('jpg','jpeg','png','gif'); # These extantion allowed for upload logo file 		
		$file  		     = JRequest::getVar('categoryLogo', null, 'files', 'array');

		$filename		= JFile::makeSafe($file['name']);	
                $filextantion	        = strtolower(JFile::getExt($filename) );
                $fileScr		= $file['tmp_name'];
                   
		$error = $this->validate($post, $filename, $filextantion, $allawExtation, $fileScr);

		  if(count($error)==0){
			 // Logo update start there

		 if($filename != ''){
		  $tempFname	        = time().'.'.$filextantion ;
		  $logoName	        = str_replace(' ','',$post['categoryName']).'_'.$tempFname; # File name to store into database
	           $src  		= $fileScr;
		   $dest		= JPATH_BASE ."/images/productLogo/". $logoName;
				
		if ( JFile::upload($src, $dest) ) { 
		      $conditional = $logoName;
		     }
	        }
           
 
 $columns = array('categoryName','categoryImage','creationDate');      

 $values = array($db->quote($post['categoryName']),$db->quote($conditional),$db->quote($creationDate));
 

      $query
            ->insert($db->quoteName('onm_product_category'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));
     
 
$db->setQuery($query);
 
$result = $db->execute();

echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Category Added')
    window.location.href='index.php?option=com_membercheckin&view=addcategory';
    </SCRIPT>");
 
} 
else{
			return $error;	
		}

	}
	 
 
	  
	 public function validate($post, $filename, $filextantion, $allawExtation, $fileSource)
	{
		$errorMsg = array();
		$db		  = JFactory::getDBO();
		 
		if(empty($post['categoryName'])){
			$errorMsg['categoryName'] = "Category name is a required field";
		}
		
		if($filename != ''){
		 if(!in_array($filextantion, $allawExtation)){
	  $errorMsg['categoryLogoError'] = "Please upload category logo with ".implode(', ',$allawExtation)." extension"; 	
             # Error massage for propertyLogo name
		 }
			 
		}
		return $errorMsg;
	}
 

 
}
