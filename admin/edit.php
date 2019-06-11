<!DOCTYPE html>
<html>
<head>
	<title>Edit Daily Exchange Rate Converter |  rest-api.uncommoncode.com</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
	<script type="text/javascript">
		// Validate to check the insert is not the same Country
		function validate() {
			if ( document.form.currency1.selectedIndex == document.form.currency2.selectedIndex ) {
				alert( "Please select two unique currencies" );
				return false;
			} else {
				alert( "Record inserted successfully" );
				return true;
			}

		}
</script>
		<?php include( 'handle-data.php' );
	/* Included the REST API (Countries) */
		$rates = getRates();
	?>
			<div class="container">
			<h1 class="text-center">Edit Daily Exchange Rate Currency Converter</h1>
			<h2 class="text-center">Add Another Exchange Rate Conversion</h2>
	<form name="form" method="post" class="form-group" onSubmit="return validate()" action="edit.php">
			<table class="table table-bordered">
				<tr>
					<th>First Currency</th>
					<th>Second Currency</th>
				</tr>

	<tr>
					<td><select class="form-control" required name="currency1" id="currency1">
			<option value="">None</option>
				<?php 
				/* Loop thru Countries from the REST API */
					foreach ( $rates as $key => $value ) {
				print '<option value="' . $key . '">' . $key . '</option>';
			} ?>
						</select></td>
					<td><select class="form-control" required name="currency2" id="currency2">
			<option value="">None</option>
				<?php
				/* Loop thru Countries from the REST API */
					foreach ( $rates as $key => $value ) {
				print '<option value="' . $key . '">' . $key . '</option>';
			} ?>
						</select></td>
				</tr>
			<tr>	<td colspan="2" ><button type="submit" name="Submit" value="Submit" class="btn btn-primary btn-sm ">Submit</button></td></tr>
	
			</table>
			</form>

			<h2 class="text-center">Delete a Current Exchange Rate Conversion</h2>
			<table class="table table-bordered">
				<tr>
					<th>First Currency</th>
					<th>Second Currency</th>
					<th width="100px">Action</th>
				</tr>


				<?php
				/* Loop thru Countries from db */
				$deleteRows = deleteRows();
				if ( $deleteRows->num_rows > 0 ) {
					while ( $row = $deleteRows->fetch_assoc() ) {
						?>

				<tr id="<?php print $row[ 'id'] ?>">
					<td>
						<?php print $row[ 'currency1'] ?>
					</td>
					<td>
						<?php print $row[ 'currency2' ] ?>
					</td>
					<td><button class="btn btn-danger btn-sm remove">Delete</button>
					</td>
				</tr>


				<?php } } ?>
			</table>
				
				<div class="alert alert-info text-center">
  <strong><a href="../index.php">Return to Exchange Rate Conversion table</a></strong><br/>  REST API Example pulling from <a target="_blank" href="https://api.exchangeratesapi.io/latest">https://api.exchangeratesapi.io/latest</a>.
</div>
		</div>
		<!-- container / end -->
</body>
<script type="text/javascript">
	/* Delete Country from db and remove the row from display */
	$( '.remove' ).click( function () {
		var id = $( this ).parents( 'tr' ).attr( 'id' );

		if ( confirm( 'Are you sure to remove this Exchange Rate Conversion?' ) ) {
			$.ajax( {
				url: 'edit.php',
				type: 'POST',
				data: {
					id: id
				},
				
				error: function () {
					alert( 'Error! did not remove record!' );
				},
				success: function ( data ) {
					$( "#" + id ).remove();
					alert( "Record removed successfully!" );
				}
			} );
		}
	} );
</script>

</html>