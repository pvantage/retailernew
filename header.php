<?php require_once('includes/head.php');
if(!$login_active)
{
	$_SESSION['message']='Please login first.';
	@header('Location: '.$siteurl);
	exit();
}
$uid=$_SESSION["User_id"];
$username=$user->Userdetail($uid, 'fname', true).' '.$user->Userdetail($uid, 'lname', true);
$currentpagesss=explode('?',$currentpage);
if(count($currentpagesss)>1){$currentpage=$currentpagesss[0].'.php';}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo $sitname; ?>- Dashboard</title>
<!-- Bootstrap Core CSS -->
<link href="css/formcss.css" rel="stylesheet" />
<link href="css/dashboardcss.css" rel="stylesheet" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/sb-admin.css" rel="stylesheet">
<!-- Morris Charts CSS -->
<link href="css/plugins/morris.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="wrapper" class="admindashboard">
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    <a class="navbar-brand userlogo" href="<?php echo $siteurl; ?>"><img class="" src="img/RA.png"/>Welcome User</a> </div>
  <!-- Top Menu Items -->
  <ul class="nav navbar-right top-nav admin_herder">
    <li> </a> <a class="contact" href="<?php echo $siteurl; ?>/contactus"> <span class="glyphicon glyphicon-comment headericonbox"></span> Contact </a> </li>
    <li>
      <div class="phonno pull-right"><span class="glyphicon glyphicon-phone-alt headericonbox"></span> 855-867-4473</div>
    </li>
    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
      <ul class="dropdown-menu message-dropdown">
        <li class="message-preview"> <a href="#">
          <div class="media"> <span class="pull-left"> <img class="media-object" src="http://placehold.it/50x50" alt=""> </span>
            <div class="media-body">
              <h5 class="media-heading"><strong>John Smith</strong> </h5>
              <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
              <p>Lorem ipsum dolor sit amet, consectetur...</p>
            </div>
          </div>
          </a> </li>
        <li class="message-preview"> <a href="#">
          <div class="media"> <span class="pull-left"> <img class="media-object" src="http://placehold.it/50x50" alt=""> </span>
            <div class="media-body">
              <h5 class="media-heading"><strong>John Smith</strong> </h5>
              <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
              <p>Lorem ipsum dolor sit amet, consectetur...</p>
            </div>
          </div>
          </a> </li>
        <li class="message-preview"> <a href="#">
          <div class="media"> <span class="pull-left"> <img class="media-object" src="http://placehold.it/50x50" alt=""> </span>
            <div class="media-body">
              <h5 class="media-heading"><strong>John Smith</strong> </h5>
              <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
              <p>Lorem ipsum dolor sit amet, consectetur...</p>
            </div>
          </div>
          </a> </li>
        <li class="message-footer"> <a href="#">Read All New Messages</a> </li>
      </ul>
    </li>
    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
      <ul class="dropdown-menu alert-dropdown">
        <li> <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a> </li>
        <li> <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a> </li>
        <li> <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a> </li>
        <li> <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a> </li>
        <li> <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a> </li>
        <li> <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a> </li>
        <li class="divider"></li>
        <li> <a href="#">View All</a> </li>
      </ul>
    </li>
    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $username; ?> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li> <a href="<?php echo $siteurl; ?>/profile"><i class="fa fa-fw fa-user"></i> Profile</a> </li>
        <li> <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a> </li>
        <li> <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a> </li>
        <li class="divider"></li>
        <li> <a href="<?php echo $siteurl; ?>/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a> </li>
      </ul>
    </li>
  </ul>
  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
      <li<?php if($currentpage=='dashboard.php'){ ?> class="active"<?php } ?>> <a href="<?php echo $siteurl; ?>/dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> </li>
      <li<?php if($currentpage=='profile.php'){ ?> class="active"<?php } ?>> <a href="<?php echo $siteurl; ?>/profile"><i class="fa fa-fw fa-user"></i> Profile</a> </li>
      <?php /*?><li<?php if($currentpage=='manage-passwords.php'){ ?> class="active"<?php } ?>>
                        <a href="<?php echo $siteurl; ?>/manage-passwords"><i class="fa fa-fw fa-table"></i> Manage Password</a>
                    </li><?php */?>
      <li<?php if($currentpage=='viewtokenkey.php'){ ?> class="active"<?php } ?>> <a href="<?php echo $siteurl; ?>/viewtokenkey"><i class="fa fa-key"></i> View Token/Key</a> </li>
      <li<?php if($currentpage=='uploadfiles.php'){ ?> class="active"<?php } ?>> <a href="<?php echo $siteurl; ?>/uploadfiles"><i class="fa fa-upload"></i> Upload Files</a> </li>
      <li<?php if($currentpage=='viewfiles.php'){ ?> class="active"<?php } ?>> <a href="<?php echo $siteurl; ?>/viewfiles"><i class="fa fa-users"></i> View files</a> </li>
      <?php if($user_type=='admin'){ ?>
      <li<?php if($currentpage=='manageusers.php' || $currentpage=='edit-user.php'){ ?> class="active"<?php } ?>> <a href="<?php echo $siteurl; ?>/manageusers"><i class="fa fa-users"></i> Manage Users</a> </li>
      <?php } ?>
    </ul>
  </div>
  <!-- /.navbar-collapse -->
</nav>
<?php if(isset($_SESSION['message']) && trim($_SESSION['message'])!=''){ ?>
<div class="success"><?php echo $_SESSION['message']; $_SESSION['message']=''; ?></div>
<?php } ?>
