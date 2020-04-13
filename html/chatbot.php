<?php
ob_start();
session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
// select logged in users detail
$res = $conn->query("SELECT * FROM users WHERE id=" . $_SESSION['user']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Hello,<?php echo $userRow['email']; ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/index.css" type="text/css"/>
</head>
<body>

<!-- Navigation Bar-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Covid-19 Helpdesk</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            <li class="active"><a href="gps-tracker-master/admin.php">Map View</a></li>
                <li><a href="chatbot.php">Risk Scan</a></li>
                <li><a href="doctor.php">Doctor Portal</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <span
                            class="glyphicon glyphicon-user"></span>&nbsp;Logged
                        in: <?php echo $userRow['email']; ?>
                        &nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <!-- Jumbotron-->
    <div class="jumbotron">
        <h1>Hello, <?php echo $userRow['fullname']; ?></h1>
        <p>Hi! Our coronavirus disease self assessment scan has been developed on the basis of guidelines from the WHO and MHFW, Government of India. This interaction should not be taken as expert medical advice. Any information you share with us will be kept strictly confidential.</p>
        <p><b>Please take the below assessment</b></p>
    </div>
    <div class="questions">
        <style>
        #rcorners2 
        {
            border-radius: 25px;
            background: #286086;
            color: white;
            size: 10px;
            padding: 20px; 
            width: 500px;
            height: 80px;  
        }
        </style>
        <div align="center">
        <p id="rcorners2">Please enter your age in years.</p>
        <form action="chatbot.php" method="post">
        <input type="number" id="age" name="age" min="1" max="100" required>
        <p id="rcorners2">Please select your gender.</p>
        <input type="radio" id="male" name="gender" value="Male" required>
        <label for="male">Male</label><br>
        <input type="radio" id="female" name="gender" value="Female" required>
        <label for="female">Female</label><br>
        <input type="radio" id="other" name="gender" value="Other" required>
        <label for="other">Other</label><br>
        <p id="rcorners2">Please let us know your current body temperature in degree Fahrenheit (Normal body temperature is 98.6°F):</p>
        <input type="radio" id="normal" name="temp" value="normal" required>
        <label for="normal">Normal (96°F-98.6°F)</label><br>
        <input type="radio" id="fever" name="temp" value="fever" required>
        <label for="fever">Fever (98.6°F-102°F)</label><br>
        <input type="radio" id="high fever" name="temp" value="high fever" required>
        <label for="high fever">High Fever (>102°F)</label><br>
        <p id="rcorners2">Are you experiencing any of the symptoms below (mark all those applicable)</p>
        <input type="checkbox" id="s1" name="s1" value="Dry Cough">
        <label for="Dry Cough">Dry Cough</label><br>
        <input type="checkbox" id="s2" name="s2" value="Loss or diminished sense of smell">
        <label for="Loss or diminished sense of smell">Loss or diminished sense of smell</label><br>
        <input type="checkbox" id="s3" name="s3" value="Sore Throat">
        <label for="Sore Throat">Sore Throat</label><br>
        <input type="checkbox" id="s4" name="s4" value="Weakness">
        <label for="Weakness">Weakness</label><br>
        <input type="checkbox" id="s5" name="s5" value="Change in appetite">
        <label for="Change in appetite">Change in appetite</label><br>
        <input type="checkbox" id="s6" name="s6" value="None">
        <label for="None">None of these</label><br>
        <p id="rcorners2">Additionally, please verify if you are experiencing any of the symptoms below (mark all those applicable)</p>
        <input type="checkbox" id="s7" name="s7" value="Moderate to severe cough">
        <label for="Moderate to severe cough">Moderate to severe cough</label><br>
        <input type="checkbox" id="s8" name="s8" value="Feeling breathless">
        <label for="Feeling breathless">Feeling breathless</label><br>
        <input type="checkbox" id="s9" name="s9" value="Difficulty in breathing">
        <label for="Difficulty in breathing">Difficulty in breathing</label><br>
        <input type="checkbox" id="s10" name="s10" value="Drowsiness">
        <label for="Drowsiness">Drowsiness</label><br>
        <input type="checkbox" id="s11" name="s11" value="Persistent pain and pressure in chest">
        <label for="Persistent pain and pressure in chest">Persistent pain and pressure in chest</label><br>
        <input type="checkbox" id="s12" name="s12" value="Severe Weakness">
        <label for="Severe Weakness">Severe Weakness</label><br>
        <input type="checkbox" id="s13" name="s13" value="None">
        <label for="None">None of these</label><br>
        <p id="rcorners2">Please select your travel and exposure details.</p>
        <input type="radio" id="no" name="travel" value="no" required>
        <label for="no">No Travel History</label><br>
        <input type="radio" id="nocont" name="travel" value="nocont" required>
        <label for="nocont">No contact with anyone with symptoms above</label><br>
        <input type="radio" id="cont" name="travel" value="cont" required>
        <label for="cont">History of travel or meeting in affected geographical area in last 14 days</label><br>
        <input type="radio" id="clcont" name="travel" value="clcont" required>
        <label for="clcont">Close contact with confirmed Covid-19 patient recently</label><br>
        <p id="rcorners2">Do you have a history of any of these conditions (mark all those applicable)</p>
        <input type="checkbox" id="h1" name="med_his" value="diabetes">
        <label for="diabetes">Diabetes</label><br>
        <input type="checkbox" id="h2" name="med_his" value="high blood pressure">
        <label for="high blood pressure">High Blood Pressure</label><br>
        <input type="checkbox" id="h3" name="med_his" value="heart disease">
        <label for="heart disease">Heart Disease</label><br>
        <input type="checkbox" id="h4" name="med_his" value="kidney disease">
        <label for="kidney disease">Kidney Disease</label><br>
        <input type="checkbox" id="h5" name="med_his" value="lung disease">
        <label for="lung disease">Lung Disease</label><br>
        <input type="checkbox" id="h6" name="med_his" value="stroke">
        <label for="stroke">Stroke</label><br>
        <input type="checkbox" id="h7" name="med_his" value="reduced immunity">
        <label for="reduced immunity">Reduced Immunity</label><br>
        <input type="checkbox" id="h8" name="med_his" value="None of these">
        <label for="None of these">None of these</label><br>
        <p id="rcorners2">How have your symptoms progressed over the last 48 hrs?</p>
        <input type="radio" id="imp" name="cur_cond" value="imp" required>
        <label for="imp">Improved</label><br>
        <input type="radio" id="no" name="cur_cond" value="no" required>
        <label for="no">No change</label><br>
        <input type="radio" id="wor" name="cur_cond" value="wor" required>
        <label for="wor">Worsened</label><br>
        <input type="radio" id="worcl" name="cur_cond" value="worcl" required>
        <label for="worcl">Worsened Considerably</label>
        <br>
        <input class="submit" name="submit" type="submit" style="background-color:black;color:white;width:150px;height:40px;" value="Submit Test">
        </form>
        </div>
        

        <?php
        if(isset($_POST['submit']))
        { // Fetching variables of the form which travels in URL
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $temp = $_POST['temp'];
            if(isset($_POST['s1']) && !empty($_POST['s1']))
                $s1 = $_POST['s1'];
            else
                $s1 = '';
            if(isset($_POST['s2']) && !empty($_POST['s2']))
                $s2 = $_POST['s2'];
            else
                $s2 = '';
            if(isset($_POST['s3']) && !empty($_POST['s3']))
                $s3 = $_POST['s3'];
            else
                $s3 = '';
            if(isset($_POST['s4']) && !empty($_POST['s4']))
                $s4 = $_POST['s4'];
            else
                $s4 = '';
            if(isset($_POST['s5']) && !empty($_POST['s5']))
                $s5 = $_POST['s5'];
                else
                $s5 = '';
            if(isset($_POST['s6']) && !empty($_POST['s6']))
                $s6 = $_POST['s6'];
                else
                $s6 = '';
            if(isset($_POST['s7']) && !empty($_POST['s7']))
                $s7 = $_POST['s7'];
                else
                $s7 = '';
            if(isset($_POST['s8']) && !empty($_POST['s8']))
                $s8 = $_POST['s8'];
                else
                $s8 = '';
            if(isset($_POST['s9']) && !empty($_POST['s9']))
                $s9 = $_POST['s9'];
                else
                $s9 = '';
            if(isset($_POST['s10']) && !empty($_POST['s10']))
                $s10 = $_POST['s10'];
                else
                $s10 = '';
            if(isset($_POST['s11']) && !empty($_POST['s11']))
                $s11 = $_POST['s11'];
                else
                $s11 = '';
            if(isset($_POST['s12']) && !empty($_POST['s12']))
                $s12 = $_POST['s12'];
                else
                $s12= '';
            if(isset($_POST['s13']) && !empty($_POST['s13']))
                $s13 = $_POST['s13'];
                else
                $s13 = '';
            $travel = $_POST['travel'];
            $med_his = $_POST['med_his'];
            $cur_cond = $_POST['cur_cond'];
            if(isset($_POST['s6']) && isset($_POST['s13']))
            {
                $result = "low";
            }
            else if(isset($_POST['s2']) || isset($_POST['s4']) || isset($_POST['s10']) || isset($_POST['s5']))
            {
                $result = "moderate";
            }
            else if(isset($_POST['s1']) || isset($_POST['s3']) || isset($POST_['s7']) || isset($_POST['s8']) || isset($_POST['s9']) || isset($_POST['s11']) || isset($_POST['s12']))
            {
                $result = "high";
            }
            if($age !=''||$gender !='')
            {
                //Insert Query of SQL
                $sql = "INSERT INTO patient(age, gender, temp, s1, s2, s3, s4, s5, s6, s7, s8, s9, s10, s11, s12, s13, travel, med_his, cur_cond, result) VALUES ('$age', '$gender', '$temp', '$s1', '$s2', '$s3', '$s4', '$s5', '$s6', '$s7', '$s8', '$s9', '$s10', '$s11', '$s12', '$s13', '$travel', '$med_his', '$cur_cond', '$result')";
                $query = mysqli_query($conn, $sql);
                if($query)
                {
                    echo "Your entry is successfully added to our database!";
                    echo "<BR>";?>
                    <h2> <?php echo " Your level of risk is $result."; ?> <a href="doctor.php">Click here to know more!</a></h2>
                    
                    <?php
                    if($result == 'moderate'|| $result == 'high')
                    {
                        header("Location: gps-tracker-master/3-track.html");              
                    }
                }
                else 
                {
                    echo "ERROR";
                }
            }
        }
        ?>
                
        <?php
        // close connection
        mysqli_close($conn);
        ?>
            
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</body>
</html>