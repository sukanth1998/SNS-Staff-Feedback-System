<?php 
	session_start();
	$nu = (int)$_GET['n'];
	$total = $_SESSION['total'];
	$year = $_SESSION['year'];
	$dept = $_SESSION['dept'];
	$class = $_SESSION['class'];
	$sem = $_SESSION['sem'];
	if ($nu<=$total) {
		$lot = $_SESSION['lot'];
		$conn = mysqli_connect("localhost","root","","feedback");
		}else{
			header('Location: final.php');
			session_unset();
			session_destroy();
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SNS Feedback System</title>
	<link rel="stylesheet"  href="css/style3.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	
	<script src="js/qstn.js"></script>
</head>
<body>
	<div class="page-header">
		<img src="Images/sns_group_logo.png" height="80">
	</div>
	<div class="container fill">
		<form action="response.php" method="POST">
			<table align="center" cellpadding="10">
				<?php
		$sq = "SELECT subCode,staffID FROM formtwo WHERE no='$nu' AND lot='$lot';";
		$r = $conn->query($sq);
		$n = mysqli_num_rows($r);
		$i=0;
		if ($n>0) {
			while ($res = mysqli_fetch_assoc($r)) {
					//Data of non elective staff
				if ($res['subCode']!='noneI' && $res['subCode']!='noneII' && $res['staffID']!=0) {
					if($i==0){
						echo "<tr><td>Staff Name</td>";
					$sql = "SELECT DISTINCT staffName FROM staffdetails WHERE staffID='".$res['staffID']."';";
					$resultsql = $conn->query($sql);
					if (mysqli_num_rows($resultsql)>0) {
					 	while ($ressql = mysqli_fetch_assoc($resultsql)) {
					 		echo "<td>".$ressql['staffName']."</td></tr>";
					 	}
					 }
						echo "<tr><td>Subject details</td><td align=\"right\">".$res['subCode'];
						$sqlout = "SELECT subTitle FROM subjectdetails WHERE subCode='".$res['subCode']."'";
						$resultout = $conn->query($sqlout);
						if (mysqli_num_rows($resultout)>0) {
							while ($resout = mysqli_fetch_assoc($resultout)) {
								echo $resout['subTitle']."</td></tr>";	
							}
						}	
						$i=$i+1;
					}else{
						echo "<tr><td colspan=\"2\" align=\"right\">".$res['subCode'];
						$sqlout = "SELECT subTitle FROM subjectdetails WHERE subCode='".$res['subCode']."'";
						$resultout = $conn->query($sqlout);
						if (mysqli_num_rows($resultout)>0) {
							while ($resout = mysqli_fetch_assoc($resultout)) {
								echo $resout['subTitle']."</td></tr>";	
							}
						}
					}	
				//End of non elective staff 
				}else if ($res['subCode']!='noneI' && $res['subCode']!='noneII' && $res['staffID']==0) {
					//Data of Staff Elective
					echo "<tr><td>".$res['subCode']."</td>";
					$sqlout = "SELECT subTitle FROM subjectdetails WHERE subCode='".$res['subCode']."'";
					$resultout = $conn->query($sqlout);
					if (mysqli_num_rows($resultout)>0) {
						while ($resout = mysqli_fetch_assoc($resultout)) {
							echo "<td>".$resout['subTitle']."</td>";
						}
					}
					$sql = "SELECT DISTINCT staffID, staffName FROM staffdetails WHERE subcode='".$res['subCode']."';";
					$resultsql = $conn->query($sql);
					if (mysqli_num_rows($resultsql)>0) {
						echo "<td><select name=\"staffElective\">";
					 	while ($ressql = mysqli_fetch_assoc($resultsql)) {
					 		 echo "<option value=\"".$ressql['staffID']."\">".$ressql['staffName']."</option>";
					 	}
					 	echo "</select></td></tr>";
					 } 
				//End of staff elective
				}else if ($res['subCode']=='noneI' && $res['staffID']==0) {
					//Data of ELective I
					$sql = "SELECT subCode, subTitle FROM subjectdetails WHERE subDept='".$dept."' AND sem='".$sem."' AND elective='Elective I';";
					$resultsql = $conn->query($sql);
					if (mysqli_num_rows($resultsql)>0) {
						while ($res = mysqli_fetch_assoc($resultsql)) {
							echo "<tr><td><input type=\"radio\" name=\"electiveOneSubCode\" value=\"".$res['subCode']."\"></td>";
							echo "<td>".$res['subCode']."</td><td>".$res['subTitle']."</td><td>";
							$sqlin = "SELECT DISTINCT staffName FROM staffdetails WHERE subcode='".$res['subCode']."'";
							$resultin = $conn->query($sqlin);
							if (mysqli_num_rows($resultin)>0) {
								while ($resin = mysqli_fetch_assoc($resultin)) {
									echo $resin['staffName']."</td></tr>";
								}
								//End of staff details of Elective I
							}
						}
						//End of subject details of Elective I
					}
					//End of Elective I
				}else if ($res['subCode']=='noneII' && $res['staffID']==0) {
					//Data of ELective II
					$sql = "SELECT subCode, subTitle FROM subjectdetails WHERE subDept='".$dept."' AND sem='".$sem."' AND elective='Elective II';";
					$resultsql = $conn->query($sql);
					if (mysqli_num_rows($resultsql)>0) {
						while ($res = mysqli_fetch_assoc($resultsql)) {
							echo "<tr><td><input type=\"radio\" name=\"electiveTwoSubCode\" value=\"".$res['subCode']."\"></td>";
							echo "<td>".$res['subCode']."</td><td>".$res['subTitle']."</td><td>";
							$sqlin = "SELECT DISTINCT staffName FROM staffdetails WHERE subcode='".$res['subCode']."'";
							$resultin = $conn->query($sqlin);
							if (mysqli_num_rows($resultin)>0) {
								while ($resin = mysqli_fetch_assoc($resultin)) {
									echo $resin['staffName']."</td></tr>";
								}
								//End of staff details of Elective II
							}
						}
						//End of subject details of Elective II
					}
					//End of Elective II
				}else{
					echo "Error in selective staffId and subCode from formtwo";
				}
			}
		}
			$conn->close();	
?>
			</table>
			<table cellpadding="10">
			
			</tr>
			<tr><td>Select All</td>
						<td align="center">	<input type="radio" id="four" name="q4" value="4" onchange="valueChanged()" /></td>
						<td align="center">  <input type="radio" id="three" name="q3" value="3" onchange="valueChanged()" /></td>
						<td align="center">  <input type="radio" id="two" name="q2" value="2" onchange="valueChanged()" /></td>
						<td align="center">  <input type="radio" id="one" name="q1" value="1" onchange="valueChanged()" /></td>

			</tr>
			<tr><td></td>
			<td>Unsatisfactory</td>
			<td>Satisfactory</td>
			<td>Good</td>
			<td>Very Good</td>
	
			
			<tr>
					<td>1.Technical Skills</td>
					<td align="center"><input type="radio" id="q14" name="q1" value="4"></td>
					<td align="center"><input type="radio" id="q13" name="q1" value="3"></td>
					<td align="center"><input type="radio" id="q12" name="q1" value="2"></td>
					<td align="center"><input type="radio" id="q11" name="q1" value="1"></td>
				</tr>
				<tr>
					<td>2.Sincerity, Commitment, Regularity, and Punctuality</td>
					<td align="center"><input type="radio" id="q24" name="q2" value="4"></td>
					<td align="center"><input type="radio" id="q23" name="q2" value="3"></td>
					<td align="center"><input type="radio" id="q22" name="q2" value="2"></td>
					<td align="center"><input type="radio" id="q21" name="q2" value="1"></td>
				</tr>
				<tr>
					<td>3.Ability to clarify doubts, and teaching with relevant examples</td>
					<td align="center"><input type="radio" id="q34" name="q3" value="4"></td>
					<td align="center"><input type="radio" id="q33" name="q3" value="3"></td>
					<td align="center"><input type="radio" id="q32"name="q3" value="2"></td>
					<td align="center"> <input type="radio" id="q31" name="q3" value="1"></td>
				</tr>
				<tr>
					<td>4.Accessibility of teachers for doubts and clarifications outside the class</td>
					<td align="center"><input type="radio" id="q44" name="q4" value="4"></td>
					<td align="center"><input type="radio" id="q43" name="q4" value="3"></td>
					<td align="center"><input type="radio" id="q42" name="q4" value="2"></td>
					<td align="center"><input type="radio" id="q41" name="q4" value="1"></td>
				</tr>
				<tr>
					<td >5.Ability to command and control the class including evaluation / examination</td>
					<td align="center"><input type="radio" id="q54" name="q5" value="4"></td>
					<td align="center"><input type="radio" id="q53" name="q5" value="3"></td>
					<td align="center"><input type="radio" id="q52" name="q5" value="2"></td>
					<td align="center"><input type="radio" id="q51" name="q5" value="1"></td>
				</tr>
				<tr>
					<td align="center" colspan="5"><input type="submit" name="submit" value="Submit" class="btn btn-primary"></td>
					<?php echo "<input type=\"hidden\" name=\"currnum\" value=\"".$nu."\">"?>
				</tr>
			</table>
		</form>
	</div>
	<div class="footer">
			<p>Developed by SNSCT CSE</p>
	</div>
</body>
</html>