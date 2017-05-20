<?php
session_start();
@include("config.php");
@include('common.php');
error_reporting(E_ALL ^ E_NOTICE);
@include("user_sessioncheck.php");
date_default_timezone_set('Asia/Kolkata');
$todaydate=date("Y-m-d");
$uname = $_SESSION['uname'];
$doctor_id = $_SESSION['doctor_id'];
$email = $_SESSION['email'];
$viewemail=$_SESSION['pstemail'];
$userid = $_SESSION['userid'];
  if($userid!=1){
$fetch_doctor = mysql_fetch_array(mysql_query("SELECT * FROM `tbl_doctors` WHERE `fld_id` ='".$doctor_id."'"));
  
  $fld_name = $fetch_doctor['fld_name'];
  $fld_gender = $fetch_doctor['fld_gender'];
  $fld_speciality = $fetch_doctor['fld_speciality'];
  $fld_languages = $fetch_doctor['fld_languages'];
  $fld_image = $fetch_doctor['fld_image'];
  $fld_experience = $fetch_doctor['fld_experience'];
  $fld_createdon = $fetch_doctor['fld_createdon'];
  $fld_delstatus = $fetch_doctor['fld_delstatus'];
  $permission  =  $_SESSION['permission']; //if permission 1 super admin  // if permission 0 doctor )
  
$imagepath = 'doctors_images/';
}
else{
    $fetch_admin = mysql_fetch_array(mysql_query("SELECT * FROM `tbl_admin` WHERE `fld_id` ='".$userid."'"));
    $fld_names = $fetch_admin['fld_username'];
    $fld_names = ucfirst($fld_names); 
}

date_default_timezone_set('Asia/Calcutta');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>View Payment Transaction | Dashboard</title>
		
		<style>
			.table tbody tr.rowlink:hover td {background-color: #efefef}
			
		</style>
    </head>
    <body>
        <div id="loading_layer" style="display:none"><img src="img/ajax_loader.gif" alt="" /></div>       
        
        <div id="maincontainer" class="clearfix">
		
            <!-- header -->
				<?php 
			include("header.php");
			?>
			<!-- header -->
			
          <div id="contentwrapper">
                <div class="main_content">
                    <div class="row-fluid">
                        <div class="span12">
						  <div id="response"style="margin-left:60%"></div>
							<h3 class="heading">Verification Request Process</h3>
<?php 

if(isset($_GET['pd_id']) && !empty($_GET['pd_id']))
{
	$root_url  	 = 'http://drthajskin-haironlineexpert.in/login/';
	$pd_id = $_GET['pd_id'];
	$_SESSION['plog_id'] = $pd_id;
	$get_pd = "SELECT * from `tbl_patientlist` where fld_id = '$pd_id'";
	$query_pd = mysql_query($get_pd);
	$row=mysql_fetch_array($query_pd,MYSQL_ASSOC);											
	$fld_id = $row['fld_id'];
	$fld_name = $row['fld_name'];
	$fld_gender = $row['fld_gender'];
	$fld_email = $row['fld_email'];
	$fld_phone = $row['fld_phone'];
	$fld_address = $row['fld_address'];
	$fld_pincode = $row['fld_pincode'];
	$fld_country = $row['fld_country'];
	$fld_state = $row['fld_state'];
	$fld_city = $row['fld_city'];
	$fld_dcname = $row['fld_dcname'];
	$fld_specility = $row['fld_specility'];
	$fld_datetime = $row['fld_datetime'];
	$fld_enddatetime = $row['fld_enddatetime'];
	$fld_modeofconsult = $row['fld_modeofconsult'];
	$fld_createdon = $row['fld_createdon'];
	$fld_updatedon = $row['fld_updatedon'];
	$fld_delstatus = $row['fld_delstatus'];
	$consultant_date = $row['consultant_date'];
	$profile = $row['profile'];
	$user = $row['user'];
	$details = $row['details'];
	$image = $row['image'];
	$othersname = $row['othersname'];
	$fld_video_url = $row['fld_video_url'];
	$payment_status = $row['payment_status'];
	$fld_payment_transaction_id = $row['fld_payment_transaction_id'];
	$othersage = $row['othersage'];
	$othersgender = $row['othersgender'];
	$age = $row['age'];
	$payment_request = $row['payment_request'];
	$payment_request = (isset($payment_request) && !empty($payment_request)) ? json_decode($payment_request) : '';
	$payment_response = $row['payment_response'];
	if(isset($payment_response) && !empty($payment_response))
	{
		$presponse_array = explode("|",$payment_response);
	}
	$payment_s_response = $row['payment_s_response'];
	if(isset($payment_s_response) && !empty($payment_s_response))
	{
		$psresponse_array = explode("|",$payment_s_response);
	}
	$payment_o_response = $row['payment_o_response'];
	if(isset($payment_o_response) && !empty($payment_o_response))
	{
		$poresponse_array = explode("|",$payment_o_response);
	}
	$payment_refund_response = $row['payment_refund_response'];
	if(isset($payment_refund_response) && !empty($payment_refund_response))
	{
		$prresponse_array = explode("|",$payment_refund_response);
	}
?>
<table class="table table-striped table-bordered">
	<input type="hidden" name="pd_id" id="pd_id" value="<?php echo (isset($pd_id) && !empty($pd_id)) ? $pd_id : ''; ?>"/>
    <tr>
    	<td><label>Merchant Code</label></td>
        <td><label><?php echo (isset($payment_request->mrctCode) && !empty($payment_request->mrctCode)) ? $payment_request->mrctCode : ''; ?></label></td>
    </tr>
	<tr>
    	<td><label>Merchant Transaction ID</label></td>
        <td><label><?php echo (isset($payment_request->mrctTxtID) && !empty($payment_request->mrctTxtID)) ? $payment_request->mrctTxtID : ''; ?></label></td>
    </tr>
     <tr>
    	<td><label>Currency Code</label></td>
        <td><label><?php echo (isset($payment_request->currencyType) && !empty($payment_request->currencyType)) ? $payment_request->currencyType : ''; ?></label></td>
    </tr>
    <tr>
    	<td><label>Amount</label></td>
        <td><label><?php echo (isset($payment_request->amount) && !empty($payment_request->amount)) ? $payment_request->amount : ''; ?></label></td>
    </tr>
    <tr>
    	<td><label>Client Meta Data</label></td>
        <td><label><?php echo (isset($payment_request->itc) && !empty($payment_request->itc)) ? $payment_request->itc : ''; ?></label></td>
    </tr>
    <tr>
    	<td><label>Request Detail</label></td>
        <td><label><?php echo (isset($payment_request->reqDetail) && !empty($payment_request->reqDetail)) ? $payment_request->reqDetail : ''; ?></label></td>
    </tr>
     <tr>
    	<td><label>Transaction Date</label></td>
        <td><label><?php echo (strtotime($payment_request->txnDate) > 0) ? date('d-m-Y',strtotime($payment_request->txnDate)) : NULL; ?></label></td>
    </tr>
    <tr>
    	<td><label>Bank Code</label></td>
        <td><label><?php echo (isset($payment_request->bankCode) && !empty($payment_request->bankCode)) ? $payment_request->bankCode : ''; ?></label></td>
    </tr>
    <tr>
    	<td><label>TPSL Transaction ID</label></td>
        <td><label><?php echo (isset($tpsl_txn_id) && !empty($tpsl_txn_id)) ? $tpsl_txn_id : ''; ?></label></td>
    </tr>
    <tr>
    	<td><label>Customer ID</label></td>
        <td><label><?php echo (isset($payment_request->custID) && !empty($payment_request->custID)) ? $payment_request->custID : ''; ?></label></td>
    </tr>
    <tr>
    	<td><label>Customer Name</label></td>
        <td><label><?php echo (isset($payment_request->custname) && !empty($payment_request->custname)) ? $payment_request->custname : ''; ?></label></td>
    </tr>
	<tr>
    	<td><label>Mobile Number</label></td>
        <td><label><?php echo (isset($payment_request->mobile) && !empty($payment_request->mobile)) ? $payment_request->mobile : ''; ?></label></td>
    </tr>
	<tr>
    	<td><label>Payment Request</label></td>
        <td><label><?php if(isset($payment_request) && !empty($payment_request)) { foreach($payment_request as $key=> $value) { echo $key." = ".$value."<br>"; }  } ?></label></td>
    </tr>
	<tr>
    	<td><label>Payment Transaction Response</label></td>
        <td><label><?php if(isset($presponse_array) && !empty($presponse_array)) { foreach($presponse_array as $key=> $value) { echo $value."<br>"; }  } ?></label></td>
    </tr>
	<tr>
    	<td><label>Payment Realtime Verification Response</label></td>
        <td><label><?php if(isset($psresponse_array) && !empty($psresponse_array)) { foreach($psresponse_array as $key=> $value) { echo $value."<br>"; }  } ?></label></td>
    </tr>
	<tr>
    	<td><label>Payment Offline Verification Response</label></td>
        <td><label><?php if(isset($poresponse_array) && !empty($poresponse_array)) { foreach($poresponse_array as $key=> $value) { echo $value."<br>"; }  } ?></label></td>
    </tr>
	<tr>
    	<td><label>Payment Refund Transaction Response</label></td>
        <td><label><?php if(isset($prresponse_array) && !empty($prresponse_array)) { foreach($prresponse_array as $key=> $value) { echo $value."<br>"; }  } ?></label></td>
    </tr>
</table>
<?php } ?>
                    </div>                   
                </div>
            </div>            
			<?php
			 @include("leftpanel.php");
			 ?>
     <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	

 <script type="text/javascript" language="javascript">
	$(document).ready(function (e) {

});
 </script>
 	
   
	<script type="text/javascript" src="js/jquery.form.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	
<script>
function fn_error()
{
	alert('Size is too large. Choose another one');
	document.getElementById('divmsgbox').innerHTML='';
	window.location="aadmin.php";

}
function fn_errorimgaa()
{
	alert('Invalid Image Extension');
	document.getElementById('divmsgbox').innerHTML='';
	window.location="aadmin.php";
	
}
</script>



</div>

    </body>
</html>