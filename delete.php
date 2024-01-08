<?php
	session_start();
	include_once('utilities/connection.php');

	if(isset($_GET['id'])){
		$sql = "DELETE FROM amx_bans WHERE bid = '".$conn->real_escape_string($_GET['id'])."'";

		if($conn->query($sql) && $conn->affected_rows != 0){

			$_SESSION['success'] = 'Ban deleted successfully.';
		}
		else{
			$_SESSION['error'] = 'Something went wrong in deleting the ban.';
		}
	}
	else{
		$_SESSION['error'] = 'Select ban to delete first.';
	}

	header('location: index.php');
?>