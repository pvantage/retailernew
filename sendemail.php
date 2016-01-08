<?php require_once('includes/head.php'); 
$errors=array();

if(isset($_POST['requestdemo']))
{
	$redirect='';
	if($_POST['redirect']!='index.php'){
		$redirects=explode('.',$_POST['redirect']);
		$redirect='/'.$redirects[0];
	}
	$first_name=$_POST['first_name'];
	$last_name=$_POST['last_name'];
	$email=$_POST['email'];
	if(trim($email)=='')
	{
		array_push($errors,'Please enter email.');
	}
	$website=$_POST['website'];
	$company=$_POST['company'];
	$title=$_POST['title'];
	$phoneno=$_POST['phoneno'];
	$comments=$_POST['comments'];
	if(empty($errors))
	{
		
		$to      = 	'sales@sigmaways.com';
		$subject = $sitname.' : Request Demo';	
		$from = $email;
		$fromname=$sitname;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= "Content-type: text/html; charset=utf-8" . "\r\nFrom: $fromname <$from>\r\nReply-To: $from";
		
		$message="Dear Admin,<br /><br />
		Following user has been contact you for demo. The user detail is given below<br /><br />
		First Name: ".$first_name."<br />
		Last Name: ".$last_name."<br />
		Email: ".$email."<br />
		Website: ".$website."<br />
		Company: ".$company."<br />
		Phone Number: ".$phoneno."<br />
		Comments: ".$comments."<br /><br />";
		$message.=$email_signature;
		@mail($to, $subject, $message, $headers);
		
		$_SESSION['message']='Thanks for sending message.';
		@header('Location: '.$siteurl.$redirect);
	}
	@header('Location: '.$siteurl.$redirect);
}
if(isset($_POST['requestsupport']))
{
	$redirect='';
	if($_POST['redirect']!='index.php'){
		$redirects=explode('.',$_POST['redirect']);
		$redirect='/'.$redirects[0];
	}
	$name=$_POST['name'];
	$email=$_POST['email'];
	if(trim($email)=='')
	{
		array_push($errors,'Please enter email.');
	}
	$website=$_POST['website'];
	$message1=$_POST['message'];
	
	if(empty($errors))
	{
		
		$to      = 	'support@sigmaways.com';
		$subject = $sitname.' : Request Demo';	
		$from = $email;
		$fromname=$sitname;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= "Content-type: text/html; charset=utf-8" . "\r\nFrom: $fromname <$from>\r\nReply-To: $from";
		
		$message="Dear Admin,<br /><br />
		Following user has been contact you for support. The user detail is given below<br /><br />
		Name: ".$name."<br />
		Email: ".$email."<br />
		Website: ".$website."<br />
		Message: ".$message1."<br /><br />";
		$message.=$email_signature;
		@mail($to, $subject, $message, $headers);
		
		$_SESSION['message']='Thanks for sending message.';
		@header('Location: '.$siteurl.$redirect);
	}
	@header('Location: '.$siteurl.$redirect);
}