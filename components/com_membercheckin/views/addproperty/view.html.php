<?php
/**
* @version		$Id: default_viewfrontend.php 96 2011-08-11 06:59:32Z michel $
* @package		Attendeeregistration
* @subpackage 	Views
* @copyright	Copyright (C) 2013, . All rights reserved.
* @license #
* @Author 		Vishal Kumar
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.filesystem.file');
jimport('joomla.application.component.view');
jimport('joomla.application.component.model' );
 
class MembercheckinViewAddProperty extends JViewLegacy   
{
	public function display($tpl = null)
	{
                 JFactory::getApplication()->set('jquery',true);
		
		$this->user = JFactory::getUser();	
		$this->app  = JFactory::getApplication('site');
		$document   = JFactory::getDocument();
		$document->addStyleSheet(JURI::root()."components/com_membercheckin/assets/css/memberchk.css");
	 
		$model 	             = $this->getModel();
                $postData           = JRequest::get('post'); 
              
		  
	 if(!empty($postData))
	 {
               //print_r($postData); //subcat-list           
	   $saveRespons 	  = $model->savePropertyData($postData);
                       
$catid             = (isset($postData['catid']) && $postData['catid'] != "")?$postData['catid']:'';
$subcatid          = (isset($postData['subcatid']) && $postData['subcatid'] != "")?$postData['subcatid']:'';
$propertyName      = (isset($postData['propertyName']) && $postData['propertyName'] != "")?$postData['propertyName']:'';
$propertyAddress   = (isset($postData['propertyAddress']) && $postData['propertyAddress'] != "")?$postData['propertyAddress']:'';
$propertyDesc      = (isset($postData['propertyDesc']) && $postData['propertyDesc'] != "")?$postData['propertyDesc']:'';
$propertyPrice     = (isset($postData['propertyPrice']) && $postData['propertyPrice'] != "")?$postData['propertyPrice']:''; 
$propertyLogo      = (isset($postData['productLogo']) && $postData['productLogo'] != "")?$postData['productLogo']:''; 
$organizationName  = (isset($postData['organizationName']) && $postData['organizationName'] != "")?$postData['organizationName']:''; 
$locationName      = (isset($postData['locationName']) && $postData['locationName'] != "")?$postData['locationName']:''; 
$location_lat      = (isset($postData['location_lat']) && $postData['location_lat'] != "")?$postData['location_lat']:''; 
$location_long     = (isset($postData['location_long']) && $postData['location_long'] != "")?$postData['location_long']:''; 
$subcategoryName   = (isset($postData['subcategoryName']) && $postData['subcategoryName'] != "")?$postData['subcategoryName']:''; 

	 }
 
		
		//$this->assignRef('error',$error);
		parent::display($tpl);
	}
	
	/*
	 * This function use to validate the property add form data
	 * 
	 * */
	public function validate($data, $filename, $filextantion, $allawExtation, $fileSource)
	{
		$db	= JFactory::getDBO();

$catid           = $data['catid']; 
$subcatid        = $data['subcatid'];
		$propertyName    = $data['propertyName'];
		$propertyPrice   = $data['propertyPrice'];
		$propertyAddress = $data['propertyAddress'];
		$propertyDesc    = $data['propertyDesc'];
                $subcategoryName= $data['subcategoryName'];
                $location_long    = $data['location_long'];
                $location_lat     = $data['location_lat'];
                $organizationName = $data['organizationName'];

		$propertyLogo    = $data['productLogo'];
		 
		$msg				= array();
				
		 if(empty($catid)){
			$msg['catid']="Select Category name";
		}
                   if(empty($subcatid)){
			$msg['subcatid']="Select Sub Category name";
		}

		if(empty($propertyName)){
			$msg['propertyName']="Property name is required field";
		}
   
		if(empty($propertyPrice)){
			$msg['propertyPrice']="Property Price is required field";
		}
		
		if(empty($propertyAddress)){
			$msg['propertyAddress']="Property Address is required field";
		} 
 
		
		if(empty($propertyDesc)){
			$msg['propertyDesc']="Property Description is required field";
		}
		
		 
		  
// Checking/validating organization name 
if($filename ==''){		 														$msg['propertyLogoError'] = "Please upload product logo"; # Error massage for propertylogo name
}else{
if(!in_array($filextantion, $allawExtation)){
$msg['propertyLogoError'] = "Please upload offer logo with ".implode(', ',$allawExtation)." extension"; 	
# Error massage for productLogo name
}
			
			//list($imgWidth, $imgHeight) = getimagesize($fileSource);
			//if($imgWidth > 150 || $imgHeight > 40){
				
				//$msg['companyLogoSizeError'] = "Please upload logo with 150X40 or less";
				
			//}
			
		}
		
		return $msg;
	}
	
	
	 
	
	/*

		Welcome mailer function 
	*/
	public function sendwelcomeMailer($username='',$email='',$userid='')
	{
		$db=&JFactory::getDBO();
		$mailalreadysend="select * from #__temp_mailerlist where userid='".$userid."' AND status = '2'";
		$db->setQuery($mailalreadysend);
		$mailalreadysendresult=$db->loadObject();
		if(count($mailalreadysendresult)==0){
			$mailer=& JFactory::getMailer();
			
			$mailfrom="do-not-reply@start.onsumaye.com";
			$fromname="Onsumaye";
			
			$sender = array( $mailfrom, $fromname );
			
			// set the sender
			$mailer->setSender($sender);
			$recipient = $email;

			//$mailer->addBCC("sudhish.kumar@onsumaye.com");
			$mailer->addRecipient($email);
			$messageBody = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
							<html xmlns='http://www.w3.org/1999/xhtml'>
							<head>
							<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
							</head><body>
							<table>
								<tbody>
									<tr>
										<td width='744' align='left'>
										<img src='".JURI::root()."images/logo.png' >
										</td>
									</tr>
									<tr>
										<td>
											<p style='margin-left:10px;font-family:verdana; font-size:12px;'>
											<br>

											Hi,</p>
											<p style='margin-left:10px;font-family:verdana; font-size:12px;'>Thank you for registering to StartX Events application.</p>
											<p style='margin-left:10px;font-family:verdana; font-size:12px;'>You can now download StartX Event mobile application for your iOS or Android smartphone. Please find below link to download mobile application:</p>
											<p style='margin-left:10px;font-family:verdana; font-size:12px;'>iPhone</p>               
											<p style='margin-left:10px;font-family:verdana; font-size:12px;'>https://itunes.apple.com/us/app/startx-events/id690379026?ls=1&mt=8#</p>               
											<p style='margin-left:10px;font-family:verdana; font-size:12px;'>Android phone</p>               
											<p style='margin-left:10px;font-family:verdana; font-size:12px;'>https://play.google.com/store/apps/details?id=com.Startxevent&hl=en</p>               
											<br/>
											<p style='margin-left:10px;font-family:verdana; font-size:12px;'>Your username is: ".$username."</p>
											<p style='margin-left:10px;font-family:verdana; font-size:12px;'>You can also reset your password at: <a href='".JURI::root()."index.php/component/users/?view=reset' style='color:#fb722f;background:none; text-decoration:none' onmouseover='this.style.color=&#39;#077bbe&#39;' onmouseout='this.style.color=&#39;#fb722f&#39;' target='_blank'>".JURI::root()."/index.php/component/users/?view=reset</p>
											<p style='margin-left:10px;font-family:verdana; font-size:12px;'>Regards,<br>
											Event Team
											<br>
											<br>
											<br>
											</p>
										</td>
									</tr>
								</tbody>
							</table></body></html>";
				
			$mailer->isHTML(true);
			$mailer->Encoding = 'base64';
			$mailer->setSubject('Thank you for registering');
			$mailer->setBody($messageBody);
			//echo "<pre>";
			//print_r($mailer);
			
			$send =& $mailer->Send();
			if($send==true){
				$insert	="INSERT INTO #__temp_mailerlist set 			
				userid='$userid',username='$username',email='$email',status=2";
				$db->setQuery($insert);
				$db->query();
			}	
			

		}
	}
	
} #End of class
?>