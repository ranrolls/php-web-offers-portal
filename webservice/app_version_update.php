<?php


$con = mysql_connect('localhost','sociacir_onm','S*_@h3H15VJp') or die("unable to connect database");
mysql_set_charset('utf8', $con);
$db  = mysql_select_db("sociacir_onm",$con) or die("unable to select db");


   
if (isset($_POST['appupdate'])) {
	  
$package_name			= $_POST['package_name']; 
$version                        = $_POST['version'];
$details                        = $_POST['details'];

###############Insert App Update Version############
  

 //mysql_query("INSERT into onm_app_version(package_name,deviceid,version,old_version,details) 
            // values ('','".$deviceid."','".$deviceversion."','','') ");

mysql_query("UPDATE onm_app_version set package_name= '".$package_name."',
            old_version='".$version."',details='".$details."' where 1 ");


if($result1 = mysql_query($query2))
{ 	 
$last_restorant_id=mysql_insert_id();

echo "ONM Updated APP Details ";

}


}

  

?> 


<html>

<body>

<strong>ONM App Version Update Entry Form</strong>:-
<br/><br/>
<form name="form1" id="mainForm" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']?>">
  <label>APP Package Name:</label><input type="text" name="package_name" placeholder="APP Package Name..." class="txtInput" required="" /> <br />
   <br />
 
 <label>Vesrion:</label> <input type="text" name="version" placeholder="Version..." class="txtInput" required="" /><br />
<label>App Details:</label> <input type="text" name="details" placeholder="Details..." class="txtInput" required="" /><br /><br />


  <input type="submit" name="appupdate" id="appupdate" value="Add ONM APP UPDATE"/>

  </form>
 
  </body>
</html>