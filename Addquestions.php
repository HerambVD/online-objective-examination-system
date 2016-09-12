<!DOCTYPE HTML>
<html>
    <head>
        <title>
            Add Questions
        </title>
    </head>
    <body>
        <br><br>
        <br><br>
        <br><br>
        <br><br>
        <br><br>
        <center>
        <form method="post" action="Addquestions.php">
            <fieldset>
                <legend>New Question</legend>
            
              <label>Subject :</label> <input type="text"  name="subject" alt="Enter a valid subject">
              <br><br>
              <label>Question :</label> <input type="text" name="question" alt="Enter a Question">
              <br><br>
              <label>Option A :</label><input type="radio" name="answer" value="Option A"> <input type="text" name="optiona" alt="Enter optiona">
              <br><br>
              <label>Option B :</label><input type="radio" name="answer" value="Option B"> <input type="text" name="optionb" alt="Enter optionb">
              <br><br>
              <label>Option C :</label><input type="radio" name="answer" value="Option C"> <input type="text" name="optionc" alt="Enter optionc">
              <br><br>
              <label>Option D :</label><input type="radio" name="answer" value="Option D"> <input type="text" name="optiond" alt="Enter optiond">
              <br><br>
              <input type="submit" value="ADD" alt="Click To add question" name="submit">
            </fieldset>
        </form>    
        </center>
    </body>
</html>

<?php
if(isset($_POST['submit'])){
	
//database connection credentials
$dbhost="localhost";
$dbuser="root";
$dbpassword="";
$db="OnlineExam";

			
//connection to the database
try
{
	$dbh = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser, $dbpassword);
	
	//set the PDO error mode to exception
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	echo "Connected to the Database";
}
catch(PDOException $e)
{
	echo "ERROR".$e->getMessage();
}

	//user entered information	
		$id = NULL;
        $subject = $_POST["subject"];
        $question = $_POST["question"];
        $optiona = $_POST["optiona"];
        $optionb = $_POST["optionb"];
        $optionc = $_POST["optionc"];
        $optiond = $_POST["optiond"];
        $answer = $_POST["answer"];
	
	//prepare sql and bind parameters
	$stmt=$dbh->prepare("INSERT INTO Questions (id, subject, question, optiona, optionb, optionc, optiond, answer) VALUES (:id, :subject, :question, :optiona, :optionb, :optionc, :optiond, :answer)");
    //Preparing Bind Parameters

    $stmt-> bindParam(':id',$id);
    $stmt-> bindParam(':Subject',$Subject);
    $stmt-> bindParam(':Question',$Question);
    $stmt-> bindParam(':optiona',$optiona);
    $stmt-> bindParam(':optionb',$optionb);
    $stmt-> bindParam(':optionc',$optionc);
    $stmt-> bindParam(':optiond',$optiond);
    $stmt-> bindParam(':answer',$answer);
    
$stmt->execute(array(
":id" => $id,    
":subject" => $subject,
":question" => $question,    
":optiona" => $optiona,
":optionb" => $optionb,
":optionc" => $optionc,
":optiond" => $optiond,
":answer" => $answer
));
		
		
echo "New Question Added Successfully";
$dbh=null;
}
?> 