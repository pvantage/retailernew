<?php require_once('header.php');
require_once('includes/class/encryptclass.php');

if(isset($_POST['upfile']))
{
	if(!empty($_FILES))
	{
		$i=0;
		$totalfile=0;
		foreach($_FILES['uploadfiles']['name'] as $i=>$vale)
		{
			$exts=explode('.',$_FILES['uploadfiles']['name'][$i]);
			$totalstrlen=(strlen($_FILES['uploadfiles']['name'][$i])-strlen($exts[count($exts)-1]))-1;
			$alias2=substr($_FILES['uploadfiles']['name'][$i],0,$totalstrlen).'-'.$uid;
			
			//$order   = array("&","$","%","!","~","'","`","_","(",")","{","}","[","]",":",";","<",">",",",".","/","|","=","+","*","#"," ","  ","   ","°");
			//$replace = '';
			//$alias=strtolower(str_replace($order, $replace, $_POST['filename'][$i].'-'.$alias2));
			$alias=$alias2;
			//print_r($_FILES['uploadfiles']);
			if(isset($_FILES['uploadfiles']['name'][$i]))
			{
				if($_FILES['uploadfiles']['name'][$i]!='')
				{
					
					if ($_FILES['uploadfiles']["error"][$i] > 0)
					{
						 echo "Error: " . $_FILES['uploadfiles']["error"][$i] . "<br />";
					}
					else
					{
						if (!is_dir('input')) {
							mkdir('input');
						}
						if (!is_dir('input/'.$uid)) {
							mkdir('input/'.$uid);
						}
						if (!is_dir('output')) {
							mkdir('output');
						}
						if (!is_dir('output/'.$uid)) {
							mkdir('output/'.$uid);
						}
						
						$exts=explode('.',$_FILES['uploadfiles']["name"][$i]);
						$exten='.'.$exts[count($exts)-1];
						$altername=$alias.$exten;
						move_uploaded_file($_FILES['uploadfiles']["tmp_name"][$i],"input/".$uid."/" . $_FILES['uploadfiles']["name"][$i]);
						rename("input/".$uid."/".$_FILES['uploadfiles']["name"][$i], "input/".$uid."/".$altername);
						$mainfile="input/".$uid."/".$altername;
						$str = file_get_contents($mainfile);
						$converter = new Encryption;
						$encoded = $converter->encode($str, $skey);
						$fp = fopen($mainfile, 'wb');
						fwrite($fp, $encoded);
						fclose($fp);
						$post['udate']=date('Y-m-d H:i:s');
						$post['keyid']=$skey;
						$post['user_id']=$uid;
						$post['filename']=$altername;
						$post['title']=$_POST['filename'][$i];
						$fieldnames='';
						$fieldvalues='';
						$cnt=1;
						foreach($post as $key=>$value)
						{
							if($cnt==1)
							{
								$fieldnames.="`$key`";
								$fieldvalues.="'$value'";
							}
							else
							{
								$fieldnames.=", `$key`";
								$fieldvalues.=", '$value'";
							}
							$cnt++;
						}
						$res=$user->addUserFiles($fieldnames,$fieldvalues);
						$totalfile++;
					}
				}
			}
		}
		if($totalfile>1){$sumessage=$totalfile.' files uploaded successfully.';}else{$sumessage=$totalfile.' file uploaded successfully.';}
		$_SESSION['message']=$sumessage;
		echo"<script type='text/javascript'>window.location='".$siteurl."/viewfiles';</script>";
		exit();
	}
}
?>

<div id="page-wrapper">
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header"> Upload Files </h1>
        <ol class="breadcrumb">
          <li> <i class="fa fa-dashboard"></i> <a href="<?php echo $siteurl; ?>/dashboard">Dashboard</a> </li>
          <li class="active"> <i class="fa fa-upload"></i> Upload Files </li>
        </ol>
      </div>
    </div>
    <!-- /.row -->
    <!-- Main jumbotron for a primary marketing message or call to action -->
	<form name="upfiles" id="upfiles" action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="upfile">
	<div class="uploading_files">
    <div class="upload_box"> <span class="btn btn-default btn-file"><i class="fa fa-folder-open"></i> Choose Files
      <input type="file" class="upfile" name="uploadfiles[]" />
      </span>
      <input type="text" class="form-control filename" name="filename[]" value="">
    </div>
	</div>
    <a class="add_more" href="javascript:;">Add More Files</a>
    <p class="up_subp">
      <input class="upload_submit btn btn-lg btn-primary btn-block" type="submit" value="Submit">
    </p>
	</form>
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="js/jquery.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.add_more').live('click', function(){
		jQuery('.uploading_files').append('<div class="upload_box"> <span class="btn btn-default btn-file"><i class="fa fa-folder-open"></i> Choose Files<input type="file" name="uploadfiles[]" class="upfile" /></span><input type="text" class="form-control filename" name="filename[]" value=""></div>');
	});
	jQuery('.upfile').live('change',function(){
		var file = this.files[0];  
   		var ff = file.name;
		//var ff=jQuery(this).val();
		jQuery(this).parents('.upload_box').find('.filename').val(ff);
	});
});
</script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.appear.js"></script>

</body></html>