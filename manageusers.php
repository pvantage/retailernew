<?php require_once('header.php');
$totalrec=15;
if($user_type=='user')
{
	$_SESSION['message']='You do not have access this page.';
	echo"<script type='text/javascript'>window.location='".$siteurl."/dashboard';</script>";
	exit();
}
if(isset($_REQUEST['pagedid']) && $_REQUEST['pagedid']>1)
{
	$pageid=$_REQUEST['pagedid'];
	$limitstart=$totalrec*($pageid-1);
}
else
{
	$pageid=1;
	$limitstart=0;
	$limitsend=$totalrec;
}
$userlist=$user->UserList(" and user_type='user' order by ID desc limit $limitstart, $totalrec");
$totalrecords=$user->UserList(" and user_type='user' order by ID desc");
?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Manage Users
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $siteurl; ?>/dashboard">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-wrench"></i> Manage Users
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
				<div class="col-lg-11">
                      
                        <div class="table-responsive">
							<?php if(!empty($userlist)){ ?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Generate Key</th>
                                        <th>Status</th>
                                       <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php foreach($userlist as $user1){ ?>
                                    <tr>
                                        <td><?php echo $user1['fname']; ?> <?php echo $user1['lname']; ?></td>
                                        <td><?php echo $user1['keyid']; ?></td>
										<td><?php if($user1['active']==1){echo 'Active';}else{echo 'Pending';} ?></td>
                                     <td><nav>
                            <ul class="pager adc">
                              <li><a href="<?php echo $siteurl; ?>/viewfiles?user_id=<?php echo $user1['ID']; ?>">View Files</a></li>
                              <li><a href="<?php echo $siteurl; ?>/edit-user?user_id=<?php echo $user1['ID']; ?>">Edit</a></li>
                              <li><a href="<?php echo $siteurl; ?>/deleteuser?user_id=<?php echo $user1['ID']; ?>&key=<?php echo $user1['keyid']; ?>">Delete</a></li>
                            </ul>
                          </nav></td>
                                   
                                    </tr>
									<?php } ?>
                                    
                                </tbody>
                            </table>
							<?php 
							if(count($totalrecords)>count($userlist))
							{
								$url=$siteurl.'/manageusers?pagedid=';
								echo $user->pagination($totalrec,$pageid,$url,count($totalrecords));
							}
							}else{ ?>
							<p>There is no user</p>
							<?php } ?>
                        </div>
                    </div>
                    
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
