<?php
	session_start();
	$lot = $_POST['lotno'];
	$_SESSION['lot'] = $lot;

	//Database Connection attributes
	$host = "localhost";
	$user = "root";
	$password = "";
	$db = "feedback";
	//Database Connection
	$conn = mysqli_connect($host,$user,$password,$db);
	if(mysqli_connect_error()){
		die("Connection - ".mysqli_connect_errno()." and ".mysqli_connect_error().". Failure in formone.");
	}

	$year = 4;
	$dept = 'CSE';
	$class = 'C';
	$sem = 7;
	
	$_SESSION['year'] = $year;
	$_SESSION['dept'] = $dept;
	$_SESSION['class'] = $class;
	$_SESSION['sem'] = $sem;

	$checkQuery = $conn->query("SELECT lot FROM formone WHERE lot='$lot'");
	if (mysqli_num_rows($checkQuery)>0) {
	 		echo "Already submitted.";
	}else{
		// Inserting the staff of particular section, non elective - both theory and lab
		$co = "SELECT DISTINCT staffID, staffName from staffdetails WHERE dept='".$dept."' AND semester='".$sem."' AND section='".$class."' ORDER BY staffID;";
		$result = $conn->query($co);
		if (mysqli_num_rows($result)>0) {
			$i = 1;
			while ($res = mysqli_fetch_assoc($result)) {
			//echo "Subject details: ".$res['staffID']." and ".$res['staffName']."<br>";
				$cot = "SELECT subcode FROM staffdetails WHERE staffID='".$res['staffID']."' AND semester='".$sem."' AND section='".$class."'";
				$resultin = $conn->query($cot);
				if (mysqli_num_rows($resultin)>0) {
					while ($resin = mysqli_fetch_assoc($resultin)) {
						//echo "i: ".$i." Subcode: ".$resin['subcode']." Staff ID: ".$res['staffID']."<br>";
						$instwo =  "INSERT INTO formtwo(no,lot,subCode,staffID,q1,q2,q3,q4,q5,total) VALUES(".$i.",'".$lot."','".$resin['subcode']."','".$res['staffID']."',0,0,0,0,0,0);";
						$conn->query($instwo);
					}
					$i = $i + 1;
				}
			}
		}

		//Inserting the staff elective
		$co = "SELECT subCode from subjectdetails WHERE subDept='".$dept."' AND sem='".$sem."' AND elective='Staff Elective';";
		$result = $conn->query($co);
		if (mysqli_num_rows($result)>0) {
			while ($resin = mysqli_fetch_assoc($result)) {
				$instwo = "INSERT INTO formtwo(no,lot,subCode,staffID,q1,q2,q3,q4,q5,total) VALUES(".$i.",'".$lot."','".$resin['subCode']."','0',0,0,0,0,0,0);";
				$conn->query($instwo);
				$i = $i + 1;
			}
		}

		//Inserting Elective I
		$co = "SELECT subCode from subjectdetails WHERE subDept='".$dept."' AND sem='".$sem."' AND elective='Elective I';";
		$result = $conn->query($co);
		if (mysqli_num_rows($result)>0) {
				$instwo = "INSERT INTO formtwo(no,lot,subCode,staffID,q1,q2,q3,q4,q5,total) VALUES(".$i.",'".$lot."','noneI','0',0,0,0,0,0,0);";
				$conn->query($instwo);
				$i = $i + 1;
		}

		//Inserting Elective II
		$co = "SELECT subCode from subjectdetails WHERE subDept='".$dept."' AND sem='".$sem."' AND elective='Elective II';";
		$result = $conn->query($co);
		if (mysqli_num_rows($result)>0) {
				$instwo = "INSERT INTO formtwo(no,lot,subCode,staffID,q1,q2,q3,q4,q5,total) VALUES(".$i.",'".$lot."','noneII','0',0,0,0,0,0,0);";
				$conn->query($instwo);
		}

		//End of inserting into formtwo table
		$_SESSION['total'] = $i;
		header('Location: formtwo.php?n=1');
	}	 
	$conn->close();
?>
