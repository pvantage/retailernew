<?php
if ( !class_exists( 'Users' ) ) {
	class Users
	{
		
		/*
		Function Name: checkUserLogin()
		Function Aim : To check login
		*/
			
		function checkUserLogin($usrname, $passwd, $rememberme=false)
		{
			global $prefix;
			$strSQL ="select * from ".$prefix."users where user_email='$usrname' and user_pass='$passwd' and active='1'";
			$result = mysql_query($strSQL);
			if(!$result)
			{
				return 0;
			}
			else
			{
				$row = mysql_fetch_assoc($result);
				$_SESSION["User_id"] = $row["ID"];
				$_SESSION["User_type"] = $row["user_type"];
				$_SESSION["User_key"] = $row["keyid"];
				$_SESSION["User_token"] = $row["tokenid"];
				
				if (!is_dir('input')) {
					mkdir('input');
				}
				if (!is_dir('input/'.$_SESSION["User_id"])) {
					mkdir('input/'.$_SESSION["User_id"]);
				}
				if (!is_dir('output')) {
					mkdir('output');
				}
				if (!is_dir('output/'.$_SESSION["User_id"])) {
					mkdir('output/'.$_SESSION["User_id"]);
				}
				
				if($rememberme) {
					setcookie("ret_usrname", $usrname, time()+ (3600*24*365) );
					setcookie("ret_password", $_POST['pwd'], time()+ (3600*24*365) );
				} else {
					setcookie("ret_usrname", $usrname, time() - (3600) );
					setcookie("ret_password", $_POST['pwd'], time()-(3600) );
				}
				
				return mysql_num_rows($result);
			}
		}
		/*
		Function Name: updateUser()
		Function Aim : To update user detail
		*/
		function updateUser($id ,$fields=array())
		{
			global $prefix;
			if(!empty($fields))
			{
				foreach($fields as $field=>$value)
				{
					$strSQL="update ".$prefix."users set $field='$value' where ID='$id'";
					$result=mysql_query($strSQL);
				}
				return 1;
			}
			else
			{
				return 0;
			}
		}
		/*
		Function Name: addUser()
		Function Aim : To register new user
		*/
		function addUser($fields='',$values='')
		{
			global $prefix;
			if(!empty($fields) && !empty($values))
			{
				
				$strSQL="INSERT INTO `".$prefix."users` ($fields) VALUES ($values)";
				$result=mysql_query($strSQL);
				return $result;
			}
			else
			{
				return 0;
			}
		}
		/*
		Function Name: addUser()
		Function Aim : To register new user
		*/
		function Deleteuser($cnd='')
		{
			global $prefix;
			$strSQL="DELETE FROM `".$prefix."users` where ID!='' $cnd";
			$result=mysql_query($strSQL);
			if($result==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		/*
		Function Name: Userdetail()
		Function Aim : To get user detail
		*/
		function Userdetail($usrid,$field='*', $act=false)
		{ 
			global $prefix;
			$strSQL = "select $field from ".$prefix."users where ID='$usrid' ";
			//echo $strSQL;
			$result = mysql_query($strSQL);
			if(!$result)
			{
				return 0;
			}
			else
			{
				$data=array();
				$count=1;
				while($row = mysql_fetch_array($result))
				{
					//fetching all the data in the array one by one
					//putting that object in the array
					$data[$count]=$row;
					$count++;
				}
				if($act && $field!='*'){return $data[1][$field];}
				else{return $data;}
			}
		}
		/*
		Function Name: UserList()
		Function Aim : To get all user list
		*/
		function UserList($cnd='')
		{ 
			global $prefix;
			$strSQL = "select * from ".$prefix."users where ID!='' $cnd";
			//echo $strSQL;
			$result = mysql_query($strSQL);
			if(!$result)
			{
				return array();
			}
			else
			{
				$data=array();
				$count=1;
				while($row = mysql_fetch_array($result))
				{
					//fetching all the data in the array one by one
					//putting that object in the array
					$data[$count]=$row;
					$count++;
				}
				return $data;
			}
		}
		/*
		Function Name: Userfield()
		Function Aim : To get user field value
		*/
		function Userfield($field, $value)
		{ 
			global $prefix;
			$strSQL = "select $field, ID from ".$prefix."users where $field='$value' ";
			//echo $strSQL;
			$result = mysql_query($strSQL);
			if(!$result)
			{
				return 0;
			}
			else
			{
				$data=array();
				$count=1;
				while($row = mysql_fetch_array($result))
				{
					//fetching all the data in the array one by one
					//putting that object in the array
					$data[$count]=$row;
					$count++;
				}
				return $data;
			}
		}
		/*
		Function Name: generatePassword()
		Function Aim : To generate random password
		*/
		function generatePassword($length=9, $strength=0) {
			$vowels = 'aeuy';
			$consonants = 'bdghjmnpqrstvz';
			if ($strength & 1) {
				$consonants .= 'BDGHJLMNPQRSTVWXZ';
			}
			if ($strength & 2) {
				$vowels .= "AEUY";
			}
			if ($strength & 4) {
				$consonants .= '23456789';
			}
			if ($strength & 8) {
				$consonants .= '@#$%';
			}
		 
			$password = '';
			$alt = time() % 2;
			for ($i = 0; $i < $length; $i++) {
				if ($alt == 1) {
					$password .= $consonants[(rand() % strlen($consonants))];
					$alt = 0;
				} else {
					$password .= $vowels[(rand() % strlen($vowels))];
					$alt = 1;
				}
			}
			return $password;
		}
		
		/*
		Function Name: addUserFiles()
		Function Aim : To add files
		*/
		function addUserFiles($fields='',$values='')
		{
			global $prefix;
			if(!empty($fields) && !empty($values))
			{
				$strSQL="INSERT INTO `".$prefix."files` ($fields) VALUES ($values)";
				$result=mysql_query($strSQL);
				return $result;
			}
			else
			{
				return 0;
			}
		}
		
		/*
		Function Name: userFilelist()
		Function Aim : To get user files list
		*/
		function userFilelist($usrid, $cnd='')
		{ 
			global $prefix;
			$strSQL = "select * from ".$prefix."files where user_id='$usrid' $cnd";
			//echo $strSQL;
			$result = mysql_query($strSQL);
			if(!$result)
			{
				return array();
			}
			else
			{
				$data=array();
				$count=1;
				while($row = mysql_fetch_array($result))
				{
					//fetching all the data in the array one by one
					//putting that object in the array
					$data[$count]=$row;
					$count++;
				}
				return $data;
			}
		}
		
		/*
		Function Name: pagination()
		Function Aim : To show pagination
		*/
		function pagination($per_page = 10, $page = 1, $url = '', $total)
		{   
		 
			$adjacents = "2";
		
			$page = ($page == 0 ? 1 : $page);
			$start = ($page - 1) * $per_page;                             
			
			$prev = $page - 1;                        
			$next = $page + 1;
			$lastpage = ceil($total/$per_page);
			$lpm1 = $lastpage - 1;
			$nextlink='';
			$pagination = '<div class="clr"></div><div class="pagination_block">';
			$prevpage='';
			//echo $page;
			if ($page>1){
				$prevpage= "<li><a href='{$url}$prev'>Previous</a></li>";
			   // $pagination.= "<li><a href='{$url}$lastpage'>Last</a></li>";
			}
			if($lastpage > 1)
			{ 	
				$pagination .='<div class="pagination"><ul>';
				$pagination .= $prevpage;		
				if ($lastpage < 7 + ($adjacents * 2))
				{ 
					for ($counter = 1; $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<li><span class='active'>$counter</span></li>";
						else
							$pagination.= "<li><a href='{$url}$counter'>$counter</a></li>";                  
					}
				}
				elseif($lastpage > 5 + ($adjacents * 2))
				{
					if($page < 1 + ($adjacents * 2))   
					{
						for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
						{
							if ($counter == $page)
								$pagination.= "<li><span class='active'>$counter</span></li>";
							else
								$pagination.= "<li><a href='{$url}$counter'>$counter</a></li>";                  
						}
						$pagination.= "<li><span>...</span></li>";
						$pagination.= "<li><a href='{$url}$lpm1'>$lpm1</a></li>";
						$pagination.= "<li><a href='{$url}$lastpage'>$lastpage</a></li>";    
					}
					elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
					{
						$pagination.= "<li><a href='{$url}1'>1</a></li>";
						$pagination.= "<li><a href='{$url}2'>2</a></li>";
						$pagination.= "<li><span>...</span><li>";
						for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<li><span class='active'>$counter</span></li>";
							else
								$pagination.= "<li><a href='{$url}$counter'>$counter</a></li>";                  
						}
						$pagination.= "<li><span>...</span></li>";
						$pagination.= "<li><a href='{$url}$lpm1'>$lpm1</a></li>";
						$pagination.= "<li><a href='{$url}$lastpage'>$lastpage</a></li>";    
					}
					else
					{
						$pagination.= "<li><a href='{$url}1'>1</a></li>";
						$pagination.= "<li><a href='{$url}2'>2</a></li>";
						$pagination.= "<li><span>...</span><li>";
						for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<li><span class='active'>$counter</span></li>";
							else
								$pagination.= "<li><a href='{$url}$counter'>$counter</a></li>";                  
						}
					}
					
				}
				
				if ($page < $counter - 1){
					$pagination.= "<li><a href='{$url}$next'>Next</a></li>";
					//$pagination.= "<li><a href='{$url}$lastpage'>Last</a></li>";
				}else{
					//$pagination.= "<li><a class='current'>Next</a></li>";
					//$pagination.= "<li><a class='current'>Last</a></li>";
				}
				$pagination .='</ul></div>';
			} 
				  
			$pagination .= '</div>'; $pagination.='</div>';
			return $pagination;
		}
		
		function dirSize($directory) {
			$size = 0;
			foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){
				$size+=$file->getSize();
			}
			return $size;
		}
	}
	global $user;

	$user = new Users();

}