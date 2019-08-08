<?php

	class factorial{
		private $inputNumber;
		function __construct($number){
			$this->inputNumber = $number;
		}
		
		function calculateFactorial(){
			$factorialResult = 1;
			if($this->inputNumber>0){
				for($i=$this->inputNumber;$i>0;$i--){
					$factorialResult = $i * $factorialResult; 
				}
			}
			else{
				$factorialResult = 0;
			}
			return $factorialResult;
		}
		
		function showOutputString(){
			if($this->inputNumber>0){
				$outputString = $this->inputNumber;
				for($i=$this->inputNumber-1;$i>0;$i--){
					$outputString = $outputString.'*'.(string)$i; 
				}
			}
			else{
				$outputString = 'NULL';
			}
			return $outputString;
		}
	}

	if(isset($_POST['number'])){
		$number = $_POST['number'];
		$factorialObject = new factorial($number);
		$result = $factorialObject->calculateFactorial();
		$output = $factorialObject->showOutputString();
	}

?>
<html>
<head>
	<title>Factorial with PHP class</title>
</head>
	<body style="text-align:center">
		<form method="post" action="">
			Input number: <input type="number" name='number' autofocus></input>
			<button type="submit">Calculate Factorial</button>
		</form>
		
		<!--style to prevent text overflow when $output string is too long-->
		<div style="word-wrap: break-word">
			<?php
			if(isset($result) && isset($output)){
				echo '<h3>Factorial of '.$number.' is,</h3><h3>'.$output.' = '.$result.'</h3>';
			}
			?>
		</div>

	</body>
</html>