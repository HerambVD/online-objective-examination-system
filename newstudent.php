<?php
if(isset($_POST['submit']))
{
	
//database connection credentials
$dbhost="localhost";
$dbuser="root";
$dbpassword="";
$db="OnlineExam";

			
//connection to the database
try
{
	$dbh = new PDO("mysql:host = $dbhost ;dbname = $db", $dbuser, $dbpassword);
	
	//set the PDO error mode to exception
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	echo "Connected to the Database";
}
catch(PDO exception $e)
{
	echo "ERROR".$e->getMessage();
}
    //To avoid MySQL injection
	//user entered information	
		$id=NULL;
        $fname=$_POST['fname'];
        $mname=$_POST['mname'];
        $lname=$_POST['lname'];
        $gender=$_POST['gender'];
        $email=$_POST['email'];
        $monumber=$_POST['mobile'];
        $rollno=$_POST['enroll'];
		$username=$_POST['username'];
		$password= $_POST['password'];
        $passwordd = 'hash(sha256,$password)';
	
	//prepare sql and bind parameters
	$stmt=$dbh->prepare("INSERT INTO StudentDetails( id, fname, mname, lname, rollno, monumber, email, username, password, gender) VALUES(:id, :fname, :mname, :lname, :rollno, :monumber, :email, :username, :password, :gender)");
    
    $array= array(
':id' => $id,
':fname'=>$fname,
':mname'=>$mname,
':lname'=>$lname,
':gender'=>$gender,
':email'=>$email,
':monumber'=>$monumber,
':rollno'=>$rollno,
':username'=>$username,
':password' =>$passwordd);

$stmt->execute($array);
		
		
echo "New record created successfully";
$dbh=null;
}
?>

<!--- HTML PAGE BELOW --->

<html>
	<head>
		<title>
		New Student
		</title>
	</head>
	<body>
		<center>
            NEW STUDENT PLEASE REGISTER BY FILLING THE FORM BELOW
			<form action="newstudent.php" method="post">
			<fieldset>
				<legend>Registration Form :</legend>
					<input type="text" placeholder="First name" name="fname">
                    <input type="text" placeholder="Middle name" name="mname">
					<input type="text" placeholder="Last name" name="lname"><br /><br />
					<input type="text" placeholder="E-mail" name="email"><br /><br />
					<input type="text" placeholder="Mobile number" name="mobile"><br /><br />
                    <input type="text" placeholder="Enter your enrollment number" name="enroll"><br /><br />
					<input type="text" placeholder="Enter a new username" name="username"><br /><br />
					<input type="password" placeholder="Enter new password" name="password"><br /><br />
					<input type="password" placeholder="Confirm your new password" name="confirm_password"><br /><br />
					Gender:<label> Male :</label><input type="radio" name="gender" value="male"><label>Female :</label><input type="radio" name="gender" value="female"><br><br>
					<input type="submit" name="submit" value="Submit">
					<input type="submit" name="reset" value="Reset"><br /><br />
            </fieldset>
		</form>
        </center>
	</body>
</html>