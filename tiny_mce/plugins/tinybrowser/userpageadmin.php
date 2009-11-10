<?
require_once("../../functions/fns_lunarcms.php");

session_start();

if(!session_is_registered("valid_user"))
	{
	Header("Location: ./../admin.php");
	}
else
	{
	db_connect();
	$accesslevel = has_access_rights(basename($GLOBALS["SCRIPT_NAME"], '.php'));
	$pagename=adminpage_header();

	if ($usersubmitted)
		{
//		display_array($_POST);

		$fullname = convert_to_safetext($fullname,0);
		$username = convert_to_safetext($username,0);
		if(!valid_email($email)) $email='';
		if(confirm_input($pass1,$pass2)) $password = $pass1; else $password ='';

		//* if Delete User Checked
		if ($deleteuser)
			{
			$success = delete_user($seluserid);
			optimizemysqltable('users');
			if ($success) action_success('User Delete Success!');	else action_failure('User Delete Failure!');
			unset($seluserid);
			}
		//* if Existing User
		elseif ($seluserid && $username && $fullname && $localityid)
			{
			$success = update_user($seluserid,$username,$password,$fullname,$email,$localityid);
         if($success)
            {
				optimizemysqltable('users');
				action_success('User Update Success!'); 
				}	
			else
				{
				action_failure('User Update Failure!');
				}		
			}
		//* if New User
		elseif ($username && $password && $fullname && $localityid)
			{
			$nextid = nextautoid('users');
			$success = insert_user($seluserid,$username,$password,$fullname,$email,$localityid);
			if ($success) 
				{
				action_success('User Insert Success!');
				$seluserid = $nextid;
				optimizemysqltable('adminusers');
				}
			else 
				{
				action_failure('User Insert Failure!');
				}
			}
		else
			{
			action_failure('User Action Failure!');
			}
		}
	directoryuser_form($seluserid);
	}
adminpage_footer('../../');

?>