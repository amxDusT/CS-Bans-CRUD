<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['bid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Edit Ban</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="edit.php">
				<input type="hidden" class="form-control" name="id" value="<?php echo $row['bid']; ?>">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Nick*:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="player_nick" value="<?php echo $row['player_nick']; ?>" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">SteamID:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="player_id" value="<?php echo $row['player_id']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">IP:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="player_ip" value="<?php echo $row['player_ip']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Reason*:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="ban_reason" value="<?php echo $row['ban_reason']; ?>" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Length*:</label>
					</div>
					<div class="col-sm-10">
						<input type="number" class="form-control" name="ban_length" value="<?php echo $row['ban_length']; ?>" required>
					</div>
				</div>
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</a>
			</form>
            </div>

        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['bid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Delete Ban</h4></center>
            </div>
            <div class="modal-body">	
            	<p class="text-center">Are you sure you want to delete?</p>
				<h3 class="text-center"><?php echo 'Player: <b>'.$row['player_nick'].'</b>'; ?></h3>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="delete.php?id=<?php echo $row['bid']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>