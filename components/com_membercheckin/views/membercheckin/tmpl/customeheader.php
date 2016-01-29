<?php  
 
 
 $document   = JFactory::getDocument();
 $document->addStyleSheet(JURI::root()."components/com_membercheckin/assets/css/topnav.css");
 $user = JFactory::getUser();
 
?>
<div id="jsMenu">
	<div class="jsMenuLft">
		<div class="jsMenuBar">
			<ul class="cResetList clrfix">
			 
			  
			<!---------Form Tab Added by vishal--------->
				<?php
				 
				$reportClass = '';	
				?>

	 <li class="dropdown <?php echo $reportClass;?> "><a <?php echo $reportClass;?> href="javascript:void(0)">Add Category</a>

<ul class="dropdown-menu">
<li>
	 <a <?php echo $reportClass;?> href="/index.php/component/membercheckin/?view=addcategory">Add Category</a>
	 </li>

<li>
	 <a <?php echo $reportClass;?> href="/index.php/component/membercheckin/?view=listcategory">All Category</a>
	 </li>


</ul>

</li>


</ul>

<li class="dropdown <?php echo $reportClass;?> ">
 <a <?php echo $reportClass;?> href="javascript:void(0)">Add Sub Category</a>

<ul class="dropdown-menu">
<li>
	 <a <?php echo $reportClass;?> href="/index.php/component/membercheckin/?view=addsubcategory">Add Sub Category</a>
	 </li>

<li>
	 <a <?php echo $reportClass;?> href="/index.php/component/membercheckin/?view=listsubcategory">All Sub Category</a>
	 </li>


</ul>

</li>

<li class="dropdown <?php echo $reportClass;?> "> 
<a <?php echo $reportClass;?> href="javascript:void(0)">Add Organization</a>
<ul class="dropdown-menu">
<li>
	 <a <?php echo $reportClass;?> href="/index.php/component/membercheckin/?view=addorganization">Add Organization</a>
	 </li>

<li>
	 <a <?php echo $reportClass;?> href="/index.php/component/membercheckin/?view=listorganization">All Organization</a>
	 </li>


</ul>


</li>

 
<li class="dropdown <?php echo $reportClass;?> "> 
 <a <?php echo $reportClass;?> href="javascript:void(0)">Add Location</a>
 
<ul class="dropdown-menu">
<li>
	 <a <?php echo $reportClass;?> href="/index.php/component/membercheckin/?view=addlocation">Add Location</a>
	 </li>

<li>
	 <a <?php echo $reportClass;?> href="/index.php/component/membercheckin/?view=listlocation">All Location</a>
	 </li>


</ul>


</li>
<li class="dropdown <?php echo $reportClass;?> "> 
 <a <?php echo $reportClass;?> href="javascript:void(0)">Add Offers</a>


<ul class="dropdown-menu">
<li>
	 <a <?php echo $reportClass;?> href="/index.php/component/membercheckin/?view=addproperty">Add Offer</a>
	 </li>

<li>
	 <a <?php echo $reportClass;?> href="index.php/component/membercheckin/?view=propertylist">All Offer</a>
	 </li>


</ul>

 
</li>
 
				 
<li class="dropdown <?php echo $reportClass;?> "> 
 <a <?php echo $reportClass;?> href="javascript:void(0)">Offer Approve By Admin</a>

<ul class="dropdown-menu">
<li>
	 <a <?php echo $reportClass;?> href="index.php?option=com_membercheckin">Offer Approve By Admin</a>
	 </li>
</ul>

</li> 
				   
			  
			<!---------Form Tab Added by vishal--------->
			</ul>
		</div>
	</div>

 

		<div class="jsMenuRgt">
		<div class="jsLogOff">
			<?php
                              $user = JFactory::getUser(); 
 
                            $userToken = JSession::getFormToken();
                echo '<a href="index.php?option=com_users&task=user.logout&' . $userToken . '=1"> Logout '  . $user->username . '</a>.';
  
   
?>
 

		</div>
	</div>
</div>




						
						
						
