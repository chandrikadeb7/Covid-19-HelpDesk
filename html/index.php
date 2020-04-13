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
        <p>Answer a few questions to know your risk. Click the button below to CHECK NOW!</p>
        <p><a class="btn btn-primary btn-lg" href="chatbot.php" role="button">Risk Scan</a></p>
    </div>

    <div class="row" align="center">
    <div class="col-lg-12">
    <div class="tenor-gif-embed" data-postid="16637932" data-share-method="host" data-width="25%" data-aspect-ratio="1.0"><a href="https://tenor.com/view/do-the-five-help-stop-coronavirus-coronavirus-covid19-do-the5-gif-16637932">Do The Five Help Stop Coronavirus GIF</a> from <a href="https://tenor.com/search/dothefive-gifs">Dothefive GIFs</a></div><script type="text/javascript" async src="https://tenor.com/embed.js"></script>
            <center><h1><font color="red"><marquee behavior="scroll" direction="left">STAY HOME. SAVE LIVES.</marquee></font></h2>
            <center><font size="10" color="black"><marquee behavior="scroll" direction="right">Help stop coronavirus</marquee></font></center><br>
            <div class="tenor-gif-embed" data-postid="16637930" data-share-method="host" data-width="20%" data-aspect-ratio="1.0"><a href="https://tenor.com/view/stay-home-help-stop-coronavirus-coronavirus-covid19-do-the-five-gif-16637930">Stay Home Help Stop Coronavirus GIF</a> from <a href="https://tenor.com/search/stayhome-gifs">Stayhome GIFs</a></div><script type="text/javascript" async src="https://tenor.com/embed.js"></script>
            <div class="tenor-gif-embed" data-postid="16637925" data-share-method="host" data-width="20%" data-aspect-ratio="1.0"><a href="https://tenor.com/view/keep-distance-help-stop-coronavirus-coronavirus-covid19-do-the-five-gif-16637925">Keep Distance Help Stop Coronavirus GIF</a> from <a href="https://tenor.com/search/keepdistance-gifs">Keepdistance GIFs</a></div><script type="text/javascript" async src="https://tenor.com/embed.js"></script>
            <div class="tenor-gif-embed" data-postid="16637928" data-share-method="host" data-width="20%" data-aspect-ratio="1.0"><a href="https://tenor.com/view/wash-hands-help-stop-coronavirus-coronavirus-covid19-do-the-five-gif-16637928">Wash Hands Help Stop Coronavirus GIF</a> from <a href="https://tenor.com/search/washhands-gifs">Washhands GIFs</a></div><script type="text/javascript" async src="https://tenor.com/embed.js"></script>
            <div class="tenor-gif-embed" data-postid="16637931" data-share-method="host" data-width="20%" data-aspect-ratio="1.0"><a href="https://tenor.com/view/cover-cough-help-stop-coronavirus-coronavirus-covid19-do-the-five-gif-16637931">Cover Cough Help Stop Coronavirus GIF</a> from <a href="https://tenor.com/search/covercough-gifs">Covercough GIFs</a></div><script type="text/javascript" async src="https://tenor.com/embed.js"></script>
            <div class="tenor-gif-embed" data-postid="16637926" data-share-method="host" data-width="20%" data-aspect-ratio="1.0"><a href="https://tenor.com/view/dont-touch-help-stop-coronavirus-coronavirus-covid19-do-the-five-gif-16637926">Dont Touch Help Stop Coronavirus GIF</a> from <a href="https://tenor.com/search/donttouch-gifs">Donttouch GIFs</a></div><script type="text/javascript" async src="https://tenor.com/embed.js"></script>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
