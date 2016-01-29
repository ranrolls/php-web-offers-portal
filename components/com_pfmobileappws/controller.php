<?php
/**
* @version		$Id:controller.php  1 2015-12-09 05:18:21Z  $
* @package		Pfmobileappws
* @subpackage 	Controllers
* @copyright	Copyright (C) 2015, . All rights reserved.
* @license 		
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.helper');

define( 'DS', DIRECTORY_SEPARATOR );
require_once( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once( JPATH_BASE .DS.'includes'.DS.'framework.php' );


jimport('joomla.application.component.controller');
 
 

/**
 * Pfmobileappws Controller
 *
 * @package    
 * @subpackage Controllers
 */
class PfmobileappwsController extends JControllerLegacy
{

    /**
    * Constructor.
    *
    * @param	array An optional associative array of configuration settings.
    * @see		JController
    */
    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->input = JFactory::getApplication()->input;
    }

	public function display($cachable = false, $urlparams = false)
	{
		$cachable	= true;	
		$vName = $this->input->get('view', 'notess');
		$this->input->set('view', $vName);
		$safeurlparams = array('id' => 'INT');
		 
		return parent::display($cachable, $safeurlparams);

                  //$document =JFactory::getDocument();
                //$viewType	= $document->getType();
		//$view = & $this->getView($this->_viewname,$viewType);
		//$model = & $this->getModel($this->_mainmodel);
	
		//$view->setModel($model,true);		
		//$view->display();



	}	 

              /** User Login Task */
             
            public function getLogin() 
	    {   
               $db = JFactory::getDbo();
             
              
             header("Content-Type: application/json; charset=UTF-8"); 
             
              // ["fields",{"product_id":"10"}] 
              //$data=json_decode(JRequest::getVar('fields'),true);  
              //$product_id= $data['product_id'];  
              
              $result=array();
              $username=JRequest::getVar('username'); 
              $password=JRequest::getVar('password');
              
              $query = $db->getQuery(true); 



         $query->select('*') 
                 ->from($db->quoteName('#__users')) 
                ->where($db->quoteName('username')." = ".$db->quote($username));

                  $db->setQuery($query);  
                  $data= $db->loadAssocList(); 
                  foreach($data as $results) 
			{
                                   
				 $dbpassword = $results['password'];
                                 $dbuserid = $results['id'];
			} 
                       
                  if(JUserHelper::verifyPassword($password,$dbpassword,$dbuserid )){
                      $datelogged = date('Y-m-d H:i:s');
                      $dat = array('status'=>'1','result'=>$results);
                    echo json_encode($dat); 
                    exit;  
                  }  
                       else{ 
			  $dat = array('status'=>'0','result'=>'');
		          echo json_encode($dat); exit; } 
                
	    } // close function

                /**Register User*/


             
                 /** Get Product Listing Based on Product ID */

           public function getProductlist() 
	    {   
              header("Content-Type: application/json; charset=UTF-8");

              $db = JFactory::getDbo();  
              // ["fields",{"product_id":"10"}] 
              //$data=json_decode(JRequest::getVar('fields'),true);

              //$product_id= $data['product_id'];  
              $product_id=JRequest::getVar('product_id'); 
              
              $query = $db->getQuery(true);

          $query->select('*') 
                ->from($db->quoteName('onm_property')) 
                ->where($db->quoteName('propertyID')." = ".$db->quote($product_id));

                 $db->setQuery($query);  
                 $productDetails =  $db->loadAssocList(); 
                 echo json_encode($productDetails);
		 exit; 
	    }
           


 
	

}// class
?>