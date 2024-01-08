<?php
	session_start();
	include_once('utilities/connection.php');

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$nick = $_POST['player_nick'];
		$steamid = $_POST['player_id'];
		$ip = $_POST['player_ip'];
		$reason = $_POST['ban_reason'];
		$length = $_POST['ban_length'];
		$sql = "UPDATE amx_bans SET player_nick = '".$conn->real_escape_string($nick)."', 
			player_id = '".$conn->real_escape_string($steamid)."', player_ip = '".$conn->real_escape_string($ip)."',
			ban_reason = '".$conn->real_escape_string($reason)."', ban_length = $length
			WHERE bid = '$id'";
		
		if($conn->query($sql)){
			$_SESSION['success'] = 'Ban updated successfully';
		}
		else{
			$_SESSION['error'] = 'Something went wrong in updating the ban';
		}
	}
	else{
		$_SESSION['error'] = 'Select ban to edit first';
	}

	header('location: index.php');

?>