<?php require_once('header.php');
$newlink='';
if(isset($_REQUEST['user_id']) && trim($_REQUEST['user_id'])>0)
{
	$uid=$_REQUEST['user_id'];
	$skey=$user->Userdetail($uid,'keyid', true);
	$newlink='user_id='.$uid.'&amp;';
	if($user_type=='user')
	{
		$_SESSION['message']='You do not have access this page.';
		echo"<script type='text/javascript'>window.location='".$siteurl."/dashboard';</script>";
		exit();
	}
}
$totalrec=15;
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
$filelist=$user->userFilelist($uid, " and keyid='$skey' limit $limitstart, $totalrec");
$totalrecords=$user->userFilelist($uid, " and keyid='$skey'");
 
//echo $user->dirSize('input/'.$uid);
?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            View Files
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $siteurl; ?>/dashboard">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i>View Files
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<div class="row">
								<div class="col-lg-12">
                      
                        <div class="table-responsive">
						<?php if(!empty($filelist)){ ?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>File Id</th>
                                        <th>Name</th>
                                        <th>Upload Date</th>
                                       <th>Generate Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php foreach($filelist as $file){ 
								$inputfile='javascript:;';
								if(file_exists('input/'.$uid.'/'.$file['filename']))
								{
									$inputfile=$siteurl.'/viewfiles?fileid=input/'.$uid.'/'.$file['filename'];
								}
								$ourputfile='javascript:;';
								if(file_exists('output/'.$uid.'/'.$file['filename']))
								{
									$ourputfile=$siteurl.'/viewfiles?fileid=output/'.$uid.'/'.$file['filename'];
								}
								?>
                                    <tr>
                                        <td><?php echo $file['ID']; ?></td>
                                        <td><?php echo $file['title']; ?></td>
										 <td><?php echo date('d M Y',strtotime($file['udate'])); ?></td>
                                        <td><?php if(trim($file['gdate'])!=''){echo date('d M Y',strtotime($file['gdate']));} ?></td>
                                     <td><nav>
                            <ul class="pager adc">
                              <li><a href="<?php echo $inputfile; ?>">Input File</a></li>
                              <li><a href="<?php echo $ourputfile; ?>">Output File</a></li>
                              <li><a href="#">Download</a></li>
                            </ul>
                          </nav></td>
                                   
                                    </tr>
                                 <?php } ?>
                           
                                </tbody>
                            </table>
							<?php 
							if(count($totalrecords)>count($filelist))
							{
								$url=$siteurl.'/viewfiles?'.$newlink.'pagedid=';
								echo $user->pagination($totalrec,$pageid,$url,count($totalrecords));
							}
							}else{ $filelist=$user->userFilelist($uid);
								if(!empty($filelist)){echo'Please upload files again.';}
								else{echo'There is no file.';}
							?>
							
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
