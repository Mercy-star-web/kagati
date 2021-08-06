<?php
//DB Connectivity
$server_name = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'kagati';
$display_msg = '';
$conn = new mysqli($server_name,$db_user,$db_password,$db_name);
if($conn->connect_error) {
	die('Connection Failed: '.$conn->connect_error);
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$currency = $_POST['order_currency'];
	$amount = $order_amount = $_POST['order_amount'];  
	if($currency != 'USD') {
		$amount = $order_amount = convertCurrency($currency,'USD',$amount);
	}
	$points_to_pay = $conn->query("select * from order_points_tbl where expiry_date>=CURDATE() and points_remaining > 0"); 
	$reduced_amount = 0;
	if($points_to_pay) {
		if($points_to_pay->num_rows > 0) {
			while($row = $points_to_pay->fetch_assoc()) {
				if($order_amount > 0) { 
					$reducable_amount = ((float)$row['points_remaining'] * (float)0.01); 
					if($reducable_amount > $order_amount) {
						$reduced_amount += $order_amount;
						$reducable_amount -= $order_amount;	
						$order_amount = 0;				
					}
					else {
						$reduced_amount += $reducable_amount;
						$reducable_amount = 0;
						$order_amount -= $reducable_amount;
					}					
					$update_remaining_point = $conn->query('update order_points_tbl set points_remaining='.($reducable_amount*100).' where id='.$row['id']);
				}
			}
		}
	}
	$sql = 'insert into order_tbl(order_amount, order_date, amount_by_points) values('.$amount.',"'.date('Y-m-d').'",'.$reduced_amount.')';
	if(($conn->query($sql) === TRUE) && ($order_amount > 0)) { 		
		$sql2 = $conn->query('insert into order_points_tbl(order_id, points_received, points_remaining, expiry_date) values('.$conn->insert_id.','.floor($order_amount).','.floor($order_amount).',DATE_ADD("'.date('Y-m-d').'",INTERVAL 1 YEAR))');
	}
}

function convertCurrency($from, $to, $amount)    
{ 
	//We can use this api if we have the key
    /*$url = file_get_contents('https://free.currencyconverterapi.com/api/v5/convert?q=' . $from . '_' . $to . '&compact=ultra');
    $json = json_decode($url, true);
    $rate = implode(" ",$json);*/
    $rate = $amount; 
    if($from == 'EUR') { 
    	$rate = 1.18;
    }
    if($from == 'GBP') {
    	$rate = 1.39;
    }   
    $total = $rate * $amount;
    //$rounded = round($total);
    return $total;
}

$conn->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<!-- <script>
			$(document).ready(function() {
				$('#submitBtn').click(function() {
					var submittedData = $(this).serialize();
					$.ajax({
						url: 'task1.php',

					});
				});
			});
		</script> -->
	</head>
	<body>
		<form id="orderForm border mt-5 pt-3 pb-3" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<div class="row">
				<div class="col-md-12">
					<label class="col-md-3">Currency</label>
					<select name="order_currency" id="orderCurrency" class="col-md-3">
						<option value="USD" selected="selected">United States Dollars</option>
						<option value="EUR">Euro</option>
						<option value="GBP">United Kingdom Pounds</option>
					</select>
				</div>
				<div class="col-md-12">
					<label class="col-md-3">Order Amount</label>
					<input type="number" name="order_amount" id="orderAmount" class="col-md-3" />
				</div>
				<div class="col-md-6 float-right">				
					<button type="submit" name="submit_btn" id="submitBtn" class="col-md-3  float-right">Complete Order</button>
				</div>
			</div>
		</form>
	</body>
</html>