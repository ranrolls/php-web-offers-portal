<?php


$con = mysql_connect('localhost','sociacir_onm','S*_@h3H15VJp') or die("unable to connect database"); 
mysql_set_charset('utf8', $con);
$db  = mysql_select_db("sociacir_onm",$con) or die("unable to select db");


if (isset($_POST["deletebuton"]))  {
   
$result="TRUNCATE TABLE onm_other_mobile_device_tokens";

$rs_username  = mysql_query($result);
if($rs_username)
{
 echo 'Data Deleted.';
}
else
{
 echo 'Data Not Deleted.';
}
 

}



/*if (isset($_POST["send_btn"]))  {

  $message=$_POST['message'];
   //echo "UPDATE ".$prefix."onm_other_mobile_device_tokens set message= '$message'  where 1";

 $result= mysql_query("UPDATE onm_other_mobile_device_tokens set message= '$message'  where 1 ") ;

 $rs_username  = mysql_query($result);
 if($rs_username)
 {
   echo 'Message Not Updated.';
 }
   else
 {
    echo 'Message Updated.';
   }
 

}*/






?>

<form id="deleteform" name="deleteform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
   
 <!--<input type="submit" class="send_btn" id="deletebuton" name="deletebuton" value="Delete Records"/>-->
 </form>

 
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Message by Push Notification</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
     <script type="text/javascript">
            $(document).ready(function(){
               
            });
            function sendPushNotification(id){
                var data = $('form#'+id).serialize();
                $('form#'+id).unbind('submit');                
                $.ajax({
                    url: "send_message.php?mode=sendmessage",
                    type: 'GET',
                    data: data,
                    beforeSend: function() {
                        
                    },
                    success: function(data, textStatus, xhr) {
                          $('.txt_message').val("Send sucuessfully.");
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        
                    }
                });
                return false;
            }
        </script> 

        <style type="text/css">
		body{ margin:0px; padding:0px;}
            .container{width: 950px;margin: 0 auto;padding: 0;     margin-top:60px;        }
            h1{font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 24px;color: #777;}
            div.clear{
                clear: both;
            }
            ul.devices{
                margin: 0;
                padding: 0;
            }
            ul.devices li{
                float: left;
                list-style: none;
                border: 1px solid #dedede;
                padding: 10px;
                margin: 0 15px 25px 0;
                border-radius: 3px;
                -webkit-box-shadow: 0 1px 5px rgba(0, 0, 0, 0.35);
                -moz-box-shadow: 0 1px 5px rgba(0, 0, 0, 0.35);
                box-shadow: 0 1px 5px rgba(0, 0, 0, 0.35);
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                color: #555; width:100%;
            }
            ul.devices li label, ul.devices li span{
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                font-size: 12px;
                font-style: normal;
                font-variant: normal;
                font-weight: bold;
                color: #393939;
                display: block; width:100%;
                float: left;
            }
            ul.devices li label{
                height: 25px;width:100%;
                        
            }
            ul.devices li textarea{
                float: left;width:100%;
                resize: none;
            }
            ul.devices li .send_btn{
                background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#0096FF), to(#005DFF));
                background: -webkit-linear-gradient(0% 0%, 0% 100%, from(#0096FF), to(#005DFF));
                background: -moz-linear-gradient(center top, #0096FF, #005DFF);
                background: linear-gradient(#0096FF, #005DFF);
                text-shadow: 0 1px 0 rgba(0, 0, 0, 0.3);
                border-radius: 3px; width:130px; height:40px;
                color: #fff;
            }
			header{ background:#1a3867; padding-bottom:5px; position:absolute; top:0px; width:100%;}
			footer{ background:#ededed; border-top:1px solid #dddddd; padding:10px;}
        </style>
    </head>
    <body>
    <header>
    <div class="clear"></div>Offer Near Me Push Notification Message to All Devices</header>
        <?php
        include_once 'db_functions.php';
        $db = new DB_Functions();
        $users = $db->getAllUsers();
        if ($users != false)
            $no_of_users = mysql_num_rows($users);
        else
            $no_of_users = 0;
        ?>
        <div class="container">
            <h1> No of Devices Registered: <?php echo $no_of_users; ?></h1>
            <hr/>
             <ul class="devices">
                <?php
                if ($no_of_users > 0) {
                    ?>
                        
                     
                <?php } ?>
            </ul>

  <form id="sendnotify" name="" method="post" action="send_messageTest.php?mode=sendmessage">
                                <label>Device Plateform: </label> <span>Android</span>
                                <div class="clear"></div> 
                                <div class="send_container">                                
                                    <textarea rows="3" name="message" cols="25" class="txt_message" placeholder="Offer Near me"></textarea> 
                                    <input type="submit" class="send_btn" value="Send" onclick=""/>

                                </div>
                                
                            </form> 


        </div>
        <div class="clear"></div>
        <footer>.</footer>
    </body>
</html>