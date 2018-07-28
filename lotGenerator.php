<?php
	 if($_POST){
	 	$year = $_POST['year']; 
	 	$dept = $_POST['dept']; 
	 	$class = $_POST['class']; 
	 	$sem =  $_POST['sem']; 
	 	$nostu = $_POST['nostu']; 
	 	if (isset($year)&&isset($dept)&&isset($class)&&isset($sem)&&isset($nostu)) {
	 		$year = (int) $year; 
	 		$dept = (int) $dept; 
	 		$class = (int) $class; 
	 		$sem =  (int) $sem; 
	 		$nostu = (int) $nostu; 
	 		$startlot = ($year*1000000)+($dept*10000)+($class*1000)+($sem*100)+1;
	 		$num = ($year*1000000)+($dept*10000)+($class*1000)+($sem*100)+($nostu);
	 		echo "Last number: ".$num."<br><br>";
	 		for ($i=1; $i<=$nostu ; $i++) { 
	 				$num = ($year*1000000)+($dept*10000)+($class*1000)+($sem*100)+($i);
	 				echo $num."<br>";
	 		}
	 		$host = "localhost";
			$user = "root";
			$password = "";
			$db = "feedback";
			$conn = mysqli_connect($host,$user,$password,$db);
			if(mysqli_connect_error()){
				die("Connection - ".mysqli_connect_errno()." and ".mysqli_connect_error().". Failure in formone.");
			}
	 		$sql = "INSERT INTO lotdetails(year,dept,class,sem,strength,startlot,count) VALUES('".$year."','".$dept."','".$class."','".$sem."','".$nostu."','".$startlot."','0')";
	 		if ($conn->query($sql)) {
	 			header('Location: admin.html');		
	 		}
	 	}
	 }
?>