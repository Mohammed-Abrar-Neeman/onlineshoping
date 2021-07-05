<?php require_once('header.php'); ?>

<?php

/*if(isset($_POST['form1'])) {

    $valid = 1;

    /*if(empty($_POST['country_id'])) {
        $valid = 0;
        $error_message .= 'You must have to select a country.<br>';
    }*/

    /*if($_POST['pgp'] == '') {
        $valid = 0;
        $error_message .= 'PGP can not be empty.<br>';
    } /*else {
        if(!is_numeric($_POST['pgp'])) {
            $valid = 0;
            $error_message .= 'You must have to enter a valid PGP.<br>';
        }
    }*/

    /*if($valid == 1) {
        $statement = $pdo->prepare("INSERT INTO tbl_store_pgp (pgp) VALUES (?)");
        $statement->execute(array($_POST['pgp']));

        $success_message = 'PGP Address is added successfully.';
    }

}*/


if(isset($_POST['form1'])) {
    $valid = 1;

    if($_POST['pgp'] == '') {
        $valid = 0;
        $error_message .= 'PGP can not be empty.<br>';
    } /*else {
        if(!is_numeric($_POST['pgp'])) {
            $valid = 0;
            $error_message .= 'You must have to enter a valid PGP.<br>';
        }
    }*/

    if($valid == 1) {

        $statement = $pdo->prepare("UPDATE tbl_store_pgp SET pgp=? WHERE store_id=1");
        $statement->execute(array($_POST['pgp']));

        $success_message = 'PGP Address is updated successfully.';

    }
}
?>


<section class="content-header">
    <div class="content-header-left">
        <h1>Add PGP Address</h1>
    </div>
</section>

<?php
    $statement = $pdo->prepare("SELECT * FROM tbl_store_pgp WHERE store_id=1");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
    foreach ($result as $row) {
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


                                        $statement = $pdo->prepare("SELECT * FROM tbl_shipping_cost WHERE country_id=?");
                                        $statement->execute(array($row['country_id']));
                                        $total = $statement->rowCount();
                                        if($total) {
                                            continue;
                                        }

                                        ?>
                                        <option value="<?php echo $row['country_id']; ?>"><?php echo $row['country_name']; ?></option>
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




<section class="content-header">
	<div class="content-header-left">
		<h1>View PGP Address</h1>
	</div>
</section>


<section class="content">

  <div class="row">
    <div class="col-md-12">


      <div class="box box-info">
        
        <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped">
			<thead>
			    <tr>
			        <th>SL</th>
			        <!--<th>Country Name</th>-->
                    <th>PGP Address</th>
			        <!--<th>Action</th>-->
			    </tr>
			</thead>
            <tbody>
            	<?php
            	$i=0;
            	$statement = $pdo->prepare("SELECT * 
                                        FROM tbl_store_pgp");
            	$statement->execute();
            	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
            	foreach ($result as $row) {
            		$i++;
            		?>
					<tr>
	                    <td><?php echo $i; ?></td>
	                    <!--<td><?php echo $row['country_name']; ?></td>-->
                        <td><?php echo $row['pgp']; ?></td>
	                    <!--<td>
	                        <a href="pgp-address-edit.php?id=<?php echo $row['store_id']; ?>" class="btn btn-primary btn-xs">Edit</a>
	                        <a href="#" class="btn btn-danger btn-xs" data-href="pgp-address-delete.php?id=<?php echo $row['store_id']; ?>" data-toggle="modal" data-target="#confirm-delete">Delete</a>
	                    </td>-->
	                </tr>
            		<?php
            	}
            	?>
            </tbody>
          </table>
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