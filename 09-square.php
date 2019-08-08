<?php
	if(isset($_GET['number'])){
		$number = $_GET['number'];
		echo (string)$number.'<sup>'.(string)$number.'</sup> = '.$number*$number;
	}
?>