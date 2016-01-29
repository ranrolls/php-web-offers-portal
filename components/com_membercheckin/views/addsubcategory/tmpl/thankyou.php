<?php
defined('_JEXEC') or die;
?>
<style>
p {
    font-size: 1.2em !important;
    margin-bottom: 15px;
    margin-top: 10px;
    text-align: center;
}
.title {
    color: #F47320;
    font-size: 25px;
    font-weight: bold;
    height: 13px;
    line-height: 13px;
    margin: 0;
    padding: 20px 0;
    text-align: center;
}
.back {
    background: none repeat scroll 0 0 #333333 !important;
    border: 1px solid #666666 !important;
    color: #CCCCCC !important;
    font-family: arial;
    font-size: 14px;
    font-weight: bold;
    padding: 5px 10px;
    text-transform: uppercase;
}
</style>
<?php
require_once(JPATH_ROOT.DS.'components'.DS.'com_membercheckin'.DS.'views'.DS.'membercheckin'.DS.'tmpl'.DS.'customeheader.php');
?>
<p>
 Company is successfully created.<br/>
  Thanks..!
</p>
<p>&nbsp;</p>
<p><a href="<?php echo JURI::root();?>" class="back">Home</a></p>
	
</div>
