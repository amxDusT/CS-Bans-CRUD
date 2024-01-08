<?php
	session_start();
	require_once('utilities/config.php');
	function num_to_string( $length )
	{
		$to_show = '';
		if( $length == 0 )
			return 'Permanent';
		if( $length < 0 )
			return 'Unbanned';

		$days = intval($length / (60*24));
		$length -= ($days*60*24);
		$hours = intval($length / 60);
		$length -= $hours*60;

		if( $days > 0 )
			$to_show = $days . " day(s) ";
		if( $hours > 0 )
			$to_show .= $hours . " hour(s) ";
		if( $length > 0 )
			$to_show .= $length . " min ";

		return substr( $to_show, 0, -1 );
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo PAGE_TITLE; ?></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="datatable/dataTable.bootstrap.min.css">
	<style>
		.height10{
			height:10px;
		}
		.mtop10{
			margin-top:10px;
		}
		.modal-label{
			position:relative;
			top:7px
		}

	</style>
</head>
<body>
<div class="container">
	<h1 class="page-header text-center"><?php echo PAGE_TITLE; ?></h1>
	<div class="row">
		<div class="col-sm-13 col-sm-offset-0">
			<div class="row">
			<?php
				if(isset($_SESSION['error'])){
					echo
					"
					<div class='alert alert-danger text-center'>
						<button class='close'>&times;</button>
						".$_SESSION['error']."
					</div>
					";
					unset($_SESSION['error']);
				}
				if(isset($_SESSION['success'])){
					echo
					"
					<div class='alert alert-success text-center'>
						<button class='close'>&times;</button>
						".$_SESSION['success']."
					</div>
					";
					unset($_SESSION['success']);
				}
			?>
			</div>
			<div class="row">
				<a href="#addnew" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> New</a>
			</div>
			<div class="height10">
			</div>
			<div class="row">
				<table id="myTable" class="table table-bordered table-striped">
					<thead>
						<th>ID</th>
						<th>Time</th>
						<th>Nick</th>
						<th>SteamID</th>
						<th>IP</th>
						<th>Admin</th>
						<th>Reason</th>
						<th>Length</th>
						<th>Manage</th>
					</thead>
					<tbody>
						<?php
							include_once('utilities/connection.php');
							$sql = "SELECT * FROM amx_bans;";

							$query = $conn->query($sql);
							while($row = $query->fetch_assoc()){
								echo "<tr>";
								echo "<td>".$row['bid']."</td>";
								echo	"<td>". date("d.m.Y, H:i", $row['ban_created'])."</td>";
								echo	"<td>".htmlspecialchars($row['player_nick'])."</td>";
							
								echo	"<td>".htmlspecialchars($row['player_id'])."</td>";
								echo	"<td>".htmlspecialchars($row['player_ip'])."</td>";
								
								echo	"<td>".htmlspecialchars($row['admin_nick'])."</td>";
								echo	"<td>".htmlspecialchars($row['ban_reason'])."</td>";
								echo	"<td>".num_to_string($row['ban_length'])."</td>";
				
								echo "<td>
										<a href='#edit_".$row['bid']."' class='btn btn-success btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> Edit</a>
										<a href='#delete_".$row['bid']."' class='btn btn-danger btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Delete</a>
									</td>";
								echo "</tr>";
								
								include('utilities/edit_delete_modal.php');
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row panel-footer">
            <footer class="text-center">
                <?php echo '© DusT | Version: 0.1';?>
            </footer>
        </div> 
	</div>
</div>
<?php include('utilities/add_modal.php'); ?>

<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="datatable/jquery.dataTables.min.js"></script>
<script src="datatable/dataTable.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	//inialize datatable
    $('#myTable').DataTable({
		"order": [[0, "desc"]],
		"autoWidth":false,
		"columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
        ],
	});

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});
</script>
</body>
</html>