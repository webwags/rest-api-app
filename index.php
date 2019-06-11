<!DOCTYPE html>
<html>
<head>
	<title>Daily Exchange Rate Converter | rest-api.uncommoncode.com</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
	<div>
		<?php include( 'admin/handle-data.php' );
		/* Included the REST API (Countries & Rates) */
		$rates = getRates();
	?>
		<div class="container">
			<h1 class="text-center">The Daily Exchange Rate Currency Converter</h1>
			<table class="table table-bordered">
				<tr>
					<th>First Currency</th>
					<th>Second Currency</th>
					<th width="100px">Rate</th>
				</tr>


				<?php
				/* Loop thru Countries from the db */
				$showrows = showRows();
				if ( $showrows->num_rows > 0 ) {
					while ( $row = $showrows->fetch_assoc() ) {
						?>
				<tr>
					<td>
						<?php foreach ( $rates as $key => $value ) {
						if ( $key === $row[ 'currency1']){print $key;}	
			} ?>
					</td>
					<td>
						<?php foreach ( $rates as $key => $value ) {
						if ( $key === $row[ 'currency2']){print $key;}	
			} ?>
					</td>
					<td>
						<?php foreach ( $rates as $key => $value ) {
						if ( $key === $row[ 'currency1']){$currency1 = $value;}	
			}  foreach ( $rates as $key => $value ) {
						if ( $key === $row[ 'currency2']){$currency2 = $value;}	
			} 
						/* Currency 2 Rate divided by Currency 1 Rate rounded even showing 3 decimal places ) */
						print(round( $currency2 /= $currency1, 3, PHP_ROUND_HALF_ODD )); ?>
					</td>
				</tr>


				<?php } } ?>
			</table>
			<div class="alert alert-info text-center">
  <strong><a href="admin/edit.php">Edit Exchange Rate Conversion table</a></strong><br/> REST API Example pulling from <a target="_blank" href="https://api.exchangeratesapi.io/latest">https://api.exchangeratesapi.io/latest</a>.
</div>
		</div>
		<!-- container / end -->
</body>
</html>