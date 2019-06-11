<?php
/* REST API to Get the latest Currency Rates */
function getRates(){
$link = 'https://api.exchangeratesapi.io/latest';
		$currency = curl_init( $link );
		curl_setopt( $currency, CURLOPT_RETURNTRANSFER, true );
		$money = curl_exec( $currency );
		if ( isset( $money ) && $money != '' ) {
			$someObject = json_decode( $money, true );
			$rates = $someObject[ 'rates' ];
			return ($rates);
			}else {
			print '<div class="alert alert-danger" role="alert">Error in pulling from the exchangeratesapi.io</div>';
		}
} 
/* Check to see if the submit request (Currency Rate) does not already exist then Insert into the db */
if ( isset( $_POST[ 'currency1' ] ) && $_POST[ 'currency1' ] != '' && isset( $_POST[ 'currency2' ] ) && $_POST[ 'currency2' ] != '' ) {
	include( 'db_config.php' );
	$currency1 = $_POST[ "currency1" ];
	$currency2 = $_POST[ "currency2" ];
	$sqlinsert = "SELECT currency1, currency2 FROM countries WHERE currency1 = '$currency1' AND currency2 = '$currency2'";
	$result = $con->query( $sqlinsert );
	if ( $result->num_rows > 0 ) {
		print '<div class="alert alert-danger" role="alert">Error! ' . $currency1 . ' and ' . $currency2 . ' has been already entered.</div>';
		mysqli_close( $con );
		unset( $_POST );
	} else {
		mysqli_query( $con, "INSERT INTO countries (currency1,currency2) VALUES ('$currency1', '$currency2')" );

		// Commit transaction
		mysqli_commit( $con );

		mysqli_close( $con );
		unset( $_POST );
	}
} 
/* Delete Currency Rate from the db */
if(isset($_POST['id']))
{
	include( 'db_config.php' );
     $sql = "DELETE FROM countries WHERE id=".$_POST['id'];
     $result = $con->query( $sql );
	 mysqli_close( $con );
}
/* On the display page show all rows (Currency Rates) */
function showRows() {
	include( 'db_config.php' );
	$sql = "SELECT id, currency1, currency2 FROM countries ORDER BY id";
	$result = $con->query( $sql );
	mysqli_close( $con );
	return ($result);

}
/* On the edit page show all rows except top 3(Currency Rates) */
function deleteRows() {
	include( 'db_config.php' );
	$sql = "SELECT id, currency1, currency2 FROM countries ORDER BY id LIMIT 35 OFFSET 3";
	$result = $con->query( $sql );
	
	mysqli_close( $con );
	return ($result);

}
?>