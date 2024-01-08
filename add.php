<?php
	session_start();
	include_once('utilities/connection.php');

	if(isset($_POST['add'])){
		$nick = $_POST['player_nick'];
		$steamid = $_POST['player_id'];
		$ip = $_POST['player_ip'];
		$reason = $_POST['ban_reason'];
		$length = $_POST['ban_length'];
		$ban_type = "";
		if(empty($nick))
		{
			$_SESSION['error'] = "* Nick cannot be empty<br>";
		}
		if(empty($steamid))
		{
			if(empty($ip))
				$_SESSION['error'] .="* IP and SteamID cannot be both empty.<br>";
		}
		else
		{
			$ban_type = "S";
			if( strcmp("STEAM_", substr($steamid, 0, 6 ) ) != 0 )
				$_SESSION['error'] .="* SteamID is invalid.<br>";
		}
		if( !empty($ip) )
		{
			$ban_type .= "I";
			if( filter_var( $ip, FILTER_VALIDATE_IP ) == false )
				$_SESSION['error'] .= "* IP is invalid.<br>";
		}
		if( empty($reason) )
			$_SESSION['error'] .= "* Reason cannot be empty.<br>";
		if( $length !== '0' && empty($length) )
			$_SESSION['error'] .= "* Length cannot be empty.<br>";
		else
		{
			if( $length < 0 )
			//if( filter_var( $length, FILTER_VALIDATE_INT, array('min_range'=>0) ) == false )
				$_SESSION['error'] .= "* Ban length is invalid.<br>";
		}

		if( empty($_SESSION['error']))
		{
			$sql = "INSERT INTO amx_bans (player_ip, player_id, player_nick, admin_ip, admin_nick, admin_id, 
					ban_type, ban_reason, ban_created, ban_length, ban_kicks, expired, imported ) 
					VALUES ('".$conn->real_escape_string($ip)."', '".$conn->real_escape_string($steamid)."', '".$conn->real_escape_string($nick)."',
					'IP_WEBSITE', 'WEBSITE', 'STEAM_WEBSITE', '$ban_type', '".$conn->real_escape_string($reason)."', UNIX_TIMESTAMP(), $length, 0, 0, 0);";

			if($conn->query($sql)){
				$_SESSION['success'] = 'Record added successfully';
			}		
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
		else
		{
			$_SESSION['error'] = substr( $_SESSION['error'], 0, -4 );
		}
		
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: index.php');
?>