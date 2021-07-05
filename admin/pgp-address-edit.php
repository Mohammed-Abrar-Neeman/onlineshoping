<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;

    /*if(empty($_POST['store_id'])) {
        $valid = 0;
        $error_message .= "You must have to select a store<br>";
    } else {
		// Duplicate Country checking
    	// current Country name that is in the database
    	$statement = $pdo->prepare("SELECT * FROM tbl_store_pgp WHERE store_id=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) {
			$current_store = $row['store_id'];
		}

		$statement = $pdo->prepare("SELECT * FROM tbl_store_pgp WHERE store_id=? and store_id!=?");
    	$statement->execute(array($_POST['store_id'],$current_store));
    	$total = $statement->rowCount();							
    	if($total) {
    		$valid = 0;
        	$error_message .= 'Store already exists<br>';
    	}
    }*/

    if($_POST['pgp'] == '') {
        $valid = 0;
        $error_message .= 'PGP can not be empty.<br>';
    }

    if($valid == 1) {    	
		// updating into the database
		$statement = $pdo->prepare("UPDATE tbl_store_pgp SET pgp=? WHERE store_id=?");
		$statement->execute(array($_POST['pgp'],$_REQUEST['id']));

    	$success_message = 'PGP Address is updated successfully.';
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_store_pgp WHERE store_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit PGP Address</h1>
	</div>
	<div class="content-header-right">
		<a href="pgp-address.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>


<?php
foreach ($result as $row) {
	$store_id = $row['store_id'];
    $pgp = $row['pgp'];
}
?>

<section class="content">

  <div class="row">
    <div class="col-md-12">

		<?php if($error_message): ?>
		<div class="callout callout-danger">
		
		<p>
		<?php echo $error_message; ?>
		</p>
		</div>
		<?php endif; ?>

		<?php if($success_message): ?>
		<div class="callout callout-success">
		
		<p><?php echo $success_message; ?></p>
		</div>
		<?php endif; ?>

        <form class="form-horizontal" action="" method="post">
            <div class="box box-info">
                <div class="box-body">
                    <!--<div class="form-group">
                        <label for="" class="col-sm-2 control-label">Select Country <span>*</span></label>
                        <div class="col-sm-4">
                            <select name="country_id" class="form-control select2">
                                <option value="">Select a country</option>
                                <?php
                                $statement = $pdo->prepare("SELECT * FROM tbl_country ORDER BY country_name ASC");
                                $statement->execute();
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    ?>
                                    <option value="<?php echo $row['country_id']; ?>" <?php if($row['country_id'] == $country_id) {echo 'selected';} ?>><?php echo $row['country_name']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">PGP Address <span>*</span></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="pgp" value="<?php echo $pgp; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                    	<label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                          <button type="submit" class="btn btn-success pull-left" name="form1">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>



    </div>
  </div>

</section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                Are you sure want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>