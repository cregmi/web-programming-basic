<?php
	session_start();
	
	function calculateOrders($a){
		$c = $m = $ca = 0;
		foreach($a as $index=>$value){
			$value = (int)$value;
			switch ($index){
				case 'coffee':
					$c = $c + $value*1;
					break;
				case 'milk':
					$m = $m + $value*2;
					break;
				case 'cake':
					$ca = $ca + $value*3.5;
					break;				
			}
		}
		$t = $c + $m + $ca;
		$str = (string)$c.','.(string)$m.','.(string)$ca.','.(string)$t;
		return $str;
	}
	
	
	//if 'order' button is pressed
	if (isset($_POST['orderButton'])){
		
		$coffeeCount = (int)$_POST['coffee'];
		$milkCount = (int)$_POST['milk'];
		$cakeCount = (int)$_POST['cake'];
		
		//if some order exist in session, update the session
		if(count($_SESSION)>0){ 
			$_SESSION['coffee'] = $_SESSION['coffee'] + $coffeeCount;
			$_SESSION['milk'] = $_SESSION['milk'] + $milkCount;
			$_SESSION['cake'] = $_SESSION['cake'] + $cakeCount;
			
		//if no order exist in session, create the session
		}else{   
			$_SESSION['coffee'] = $coffeeCount;
			$_SESSION['milk'] = $milkCount;
			$_SESSION['cake'] = $cakeCount;			
			
		}		
		
		$result = explode(',',calculateOrders($_SESSION));
		$coffeeOrderTotal = $result[0];
		$milkOrderTotal = $result[1];
		$cakeOrderTotal = $result[2];
		$orderTotal = $result[3];
		
	//if 'Cancel Order' button is pressed, button is only visible if order exist in session 	
	}elseif (isset($_POST['cancelOrder'])){
		
		$_SESSION=array();
		$message = "Order Canceled";
	
	//if 'Confirm order' button is pressed, button is only visible if order exist in session	
	}elseif (isset($_POST['confirmOrder'])){
	
		$orderDetailsToProcess = $_SESSION; 
		$_SESSION=array();
		
		$result = explode(',',calculateOrders($orderDetailsToProcess));
		$coffeeOrderTotal = $result[0];
		$milkOrderTotal = $result[1];
		$cakeOrderTotal = $result[2];
		$orderTotal = $result[3];
		
		$message = 'Order Sent for '.$orderTotal.' euros';
		
	//At the first page load, if some order exist in session  
	}elseif (count($_SESSION)>0){
		
		$result = explode(',',calculateOrders($_SESSION));
		$coffeeOrderTotal = $result[0];
		$milkOrderTotal = $result[1];
		$cakeOrderTotal = $result[2];
		$orderTotal = $result[3];	
	}
	
	//At the first page load, if no order exist in session 
?>
<html>
	<head>
		<title>Simple order form with session in PHP</title>
		<style>
			input{
				text-align:right;
			}
		</style>
		
	</head>
	<body>
		<form method="post" action="">
			Coffee, 1 euro <input name="coffee" type="number" autofocus></input>
			Milk, 2 euro <input name="milk" type="number"></input>
			Cake, 3.5 euro <input name="cake" type="number"></input>
			<button type="submit" name="orderButton">Order</button>
		</form>
		
		<?php if (count($_SESSION)>0){ ?>
		
			<p><u>Coffee:</u> <?=$_SESSION['coffee']?> units, <?=$coffeeOrderTotal?> euros</p>
			<p><u>Milk:</u> <?=$_SESSION['milk']?> units, <?=$milkOrderTotal?> euros</p>
			<p><u>Cake:</u> <?=$_SESSION['cake']?> units, <?=$cakeOrderTotal?> euros</p>
			<h4>Total order: <?=$orderTotal?> euros</h4>
			
			<form method="post" action="">
				<button type="submit" name="cancelOrder">Cancel Order</button>
				<button type="submit" name="confirmOrder">Confirm Order</button>
			</form>
			
		<?php } ?>
		
		<?php if (isset($message)){ ?>	
		
				<h2><?=$message?></h2>
				
		<?php } ?>
	</body>
</html>