<?php
	$stid = $_POST['stid'];
	$stname = $_POST['stname'];
	$stdept = $_POST['stdept'];
	$stsem =  $_POST['stsem'];
	$stsubcode =  $_POST['stsubcode'];
	$stsection = $_POST['stsection'];
	$conn = new mysqli("localhost","root","","feedback");
	if (mysqli_connect_error()) {
		die("Connection failed in addstaff.");
	}
	$ins = "INSERT INTO staffdetails(staffID,staffName,dept,semester,subcode,section) VALUES('$stid','$stname','$stdept','$stsem','$stsubcode','$stsection');";
	if($conn->query($ins)){
		header('Location: admin.html');
	}
	$conn->close();
?>