<?php require_once('header-withoutlogin.php');
$errors=array();
if(isset($_POST['email']))
{
	
	$email=$_POST['email'];
	if(trim($email)=='')
	{
		array_push($errors,'Please enter email address.');
	}
	$pwd=$_POST['pwd'];
	if(trim($email)=='')
	{
		array_push($errors,'Please enter password.');
	}
	$check=$user->Userfield('user_email', $email);
	$active=false;
	if(!empty($check))
	{
		$uid=$check[1]['ID'];
		$checkactive=$user->Userdetail($uid, 'active', true);
		if($checkactive==1){
			$active=true;
		}
	}
	if($active)
	{
		$cdate=$user->Userdetail($uid, 'cdate', true);
		$password=sha1($pwd.$cdate);
		if(isset($_POST['rememberme'])){$rememberme=true;}
		else{$rememberme=false;}
		$check=$user->checkUserLogin($email, $password, $rememberme);
		if($check>0)
		{
			@header('Location: '.$siteurl.'/dashboard');
		}
		else
		{
			$check=array();
		}
	}
	if(empty($check) && $active)
	{
		array_push($errors,'Login detail is incorrect.');
	}
	if(!$active)
	{
		array_push($errors,'Your account is not active.');
	}
}

 ?>
<!-- Header -->
<!-- Portfolio Grid Section -->
<div class="container innerpage">
  <div class="row">
    <div class="login_form col-sm-7 col-xs-12 col-md-5">
      <div class="form-header"> <i class="fa fa-user"></i> </div>
      <form class="form-signin" id="loginuser" name="loginuser" action="" method="post">
        <h2 class="form-signin-heading">Login Form</h2>
		<?php if(!empty($errors)){foreach($errors as $error){echo '<span class="error">'.$error.'</span><br />';}} ?>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="text" name="email" id="email" class="form-control required email" placeholder="Email address" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="pwd" name="pwd" class="form-control required" placeholder="Password" required="" />
        <div class="checkbox">
          <label>
          <input type="checkbox" name="rememberme" />
          Remember me </label>
        </div>
        <div class="col-xs-7 forgot"> <i class="fa fa-unlock-alt"></i> <a href="<?php echo $siteurl; ?>/forgot-password" id="forgot_from_1">Forgot password?</a> </div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div>
  </div>
</div>
<!-- Footer -->
<?php require_once('footer-withoutlogin.php'); ?>