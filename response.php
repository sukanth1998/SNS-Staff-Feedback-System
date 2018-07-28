<?php
	session_start();
	$lt = $_SESSION['lot']; 
	$q1 = $_POST['q1'];
	$q2 = $_POST['q2'];
	$q3 = $_POST['q3'];
	$q4 = $_POST['q4'];
	$q5 = $_POST['q5'];
	$n = (int)$_POST['currnum'];	
	$total = $q1 + $q2 + $q3 + $q4 + $q5;
	$conn = new mysqli("localhost","root","","feedback");
	if (mysqli_connect_error()) {
		die("Connection failed in formtwo.");
	}
	if (isset($_POST['staffElective'])) {
		$query = "UPDATE formtwo SET staffID='".$_POST['staffElective']."', q1='$q1', q2='$q2', q3='$q3', q4='$q4', q5='$q5', total='$total' WHERE lot='".$lt."' AND no='".$n."';";
		if ($conn->query($query)) {
			$n=$n+1;
			header('Location: formtwo.php?n='.$n);
		}
	}elseif (isset($_POST['electiveOneSubCode'])) {
		$sql = "SELECT DISTINCT staffID FROM staffdetails WHERE subcode='".$_POST['electiveOneSubCode']."'";
		$resultsql = $conn->query($sql);
		if (mysqli_num_rows($resultsql)>0) {
			while ($res=mysqli_fetch_assoc($resultsql)) {
				$query = "UPDATE formtwo SET subCode='".$_POST['electiveOneSubCode']."', staffID='".$res['staffID']."', q1='$q1', q2='$q2', q3='$q3', q4='$q4', q5='$q5', total='$total' WHERE lot='".$lt."' AND no='".$n."';";
			if ($conn->query($query)) {
					$n=$n+1;
					header('Location: formtwo.php?n='.$n);
				}else{
				echo "Error in Insert";
			}		
			}
		}else{
			echo "No rows found";
		}
	}elseif (isset($_POST['electiveTwoSubCode'])) {
		$sql = "SELECT DISTINCT staffID FROM staffdetails WHERE subcode='".$_POST['electiveTwoSubCode']."';";
		$resultsql = $conn->query($sql);
		if (mysqli_num_rows($resultsql)>0) {
			while ($res=mysqli_fetch_assoc($resultsql)) {
				$query = "UPDATE formtwo SET subCode='".$_POST['electiveTwoSubCode']."', staffID='".$res['staffID']."', q1='$q1', q2='$q2', q3='$q3', q4='$q4', q5='$q5', total='$total' WHERE lot='".$lt."' AND no='".$n."';";
			if ($conn->query($query)) {
					$n=$n+1;
					header('Location: formtwo.php?n='.$n);
				}else{
					echo "Error in insert";
				}
			}
		}else{
			echo "Errro in number of rows";
		}
	}else {
		$query = "UPDATE formtwo SET q1='$q1', q2='$q2', q3='$q3', q4='$q4', q5='$q5', total='$total' WHERE lot='".$lt."' AND no='".$n."';";
		if ($conn->query($query)) {
			$n=$n+1;
			header('Location: formtwo.php?n='.$n);
		}
	}
	$conn->close();
?>
