<!DOCTYPE html>
<html>
    <head>
        <title>
            Test
        </title>
<?php
$conn= new mysqli('localhost','root','','onlineexam');
$resultset= $conn->query("SELECT Question, optiona, optionb, optionc, optiond, answer FROM Questions");
if($resultset -> num_rows != 0)
{
    $rows= $resultset-> fetch_assoc();
}
$i=0;
$j=0;
while($rows= $resultset-> fetch_assoc())
{    
$question= $rows['Question'];
$optiona= $rows['optiona'];
$optionb= $rows['optionb'];
$optionc= $rows['optionc'];
$optiond= $rows['optiond'];
$answer= $rows['answer'];
$row[$i][$j] = array(array($question, $optiona, $optionb, $optionc, $optiond, $answer));
$i++;
$j++;    
}
$numrows= mysqli_num_rows($resultset);
?>
    <style>
    div.page{
            width: 100%;
            
                }
    div.questionlinks{
            float:left;
            width:30%;
            background-color: aliceblue;
            height: 200px;
            
                     }
    div.question  {
    float: right;        
    width: 70%;
    background-color: darkblue;   
    height: 200px;    
                  }
    nav {
    float: left;
    max-width: 160px;
    margin: 0;
    padding: 1em;
        }
        a{
            color: blue;
            
        }
    a:hover
        {
        color: red;
        }    
     
    nav ol  {
    list-style-type: none;
    
            }    
    header, footer  {
    padding: 1em;
    color: white;
    background-color: black;
    clear: left;
    text-align: center;
                    }

            
    </style>
    <script type="text/javascript" language="javascript">
        var score=0;
        var question= <?php echo $row[$i][$j]; ?>;
        function displaydata()
        {
            document.getElementById('Question').innerHTML= "$row[][]"
        }
        
    </script>
    </head>
    
        
    <body>
       <center><header><h1>GRE Sample test</h1></header></center>
        <div class="page">
        <div class="questionlinks">
            <nav>
                <br>
            <script type="text/javascript" language="javascript">
            var k=1;
            while(k<=4)
                {
                document.write("<a href='#' onclick='display();'>Question</a></br></br>"); 
                k++;    
                }
            </script>     
            </nav>
        </div>
        <div class="question">
            <form method="post" id="questionoptions" action="TestJS.php">
                <br><br>
        <label id="Question"></label>
        <input type='radio' name='answer' value='Option A' id='answer' onclick='scorecalc()'><label id="option A"></label><br/><br/> 
        <input type='radio' name='answer' value='Option B' id='answer' onclick='scorecalc()'><label id="option B"></label><br/><br/>
        <input type='radio' name='answer' value='Option C' id='answer' onclick='scorecalc()'><label id="option C"></label><br/><br/>
        <input type='radio' name='answer' value='Option D' id='answer' onclick='scorecalc()'><label id="option D"></label><br/><br/>
            </form>
        </div>
        </div>    
       
        <center><footer>Copyrights © examshub.com</footer></center>
    </body>
</html>