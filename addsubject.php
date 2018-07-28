<?php
	$subcode = $_POST['subcode'];
	$subname = $_POST['subname'];
	$subdept = $_POST['subdept'];
	$subyear = $_POST['subyear'];
	$subsem = $_POST['subsem'];
	$subtype = $_POST['subtype'];
	$subelective = $_POST['subelective'];
	$conn = mysqli_connect("localhost","root","","feedback");
	if(mysqli_connect_error()){
		die("Connection failed in addsubject.");
	}
	$ins = "INSERT INTO subjectdetails(subCode,subTitle,subDept,year,sem,type,elective) VALUES('$subcode','$subname','$subdept','$subyear','$subsem','$subtype','$subelective')";
	if($conn->query($ins)){
		header('Location: admin.html');
	}
	$conn->close();
?>