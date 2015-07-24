<?php
require_once "function.php";
require_once "core.php";

session_start();

if(!$_SESSION)
{
    header("location:index.php");
}

$UserName=$_SESSION['username'];

if (!empty($_POST['infoSubmit'])) 
{
    if(isset($_POST['first']) || isset($_POST['last']) || !empty($_POST['gender']) || isset($_POST['quote']))
    {
        $firstname = sanitizeString($_POST['first']);
        $lastname = sanitizeString($_POST['last']);
        $gender = sanitizeString($_POST['gender']);
        $quote = $_POST['quote'];
        
        $result = queryMysql("SELECT * FROM profile WHERE username='$UserName'"); //check if the user already exists

        if ($result->num_rows)  //better implementation 
        {
            queryMysql("DELETE FROM profile WHERE username='$UserName'");
        }
        editProfile($connection, $firstname, $lastname, $gender, $UserName, $quote);
    }
}
else if (!empty($_POST['imageSubmit']))
{
    $time = $_SERVER['REQUEST_TIME'];
    $file_name = $time . '.jpg';
    if ($_FILES)
    {
        $tmp_name = $_FILES['upload']['name']; //file on local host
        if ($tmp_name == NULL) $file_name = NULL;
        $dstFolder = 'users';
        move_uploaded_file($_FILES['upload']['tmp_name'], $dstFolder . DIRECTORY_SEPARATOR . $file_name);
    }
    queryMysql("UPDATE users SET FILENAME = '$file_name' WHERE USERNAME='$UserName'");
}
else if (!empty($_POST['postSubmit']))
{
    if (isset($_POST['post']) && $_POST['post'] != " ")
    {       
        $status = $_POST['post'];
        $time = $_SERVER['REQUEST_TIME'];
        $file_name = $time . '.jpg';
        $filter = $_POST['filter'];
        if ($_FILES)
        {
            $tmp_name = $_FILES['upload']['name']; //file on local host
            if ($tmp_name == NULL) $file_name = NULL;
            $dstFolder = 'users';
            move_uploaded_file($_FILES['upload']['tmp_name'], $dstFolder . DIRECTORY_SEPARATOR . $file_name);
        } 
        SaveStatusToDB($connection,$UserName,$status,$file_name,$time,$filter);
        header("location:social.php");
    }
}
else if (isset($_POST['time'])) {
    $time = $_POST['time']; 
    queryMysql("DELETE FROM userposts WHERE TIME_STAMP= '$time'");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="StyleSheet1.css" />
    <link rel="stylesheet" href="StyleSheet2.css" />
    <link href='http://fonts.googleapis.com/css?family=Numans:400,900' rel='stylesheet' type='text/css'>
        <link rel="icon" type="image/png" href="Camera.png">
    <title>PhotoSpace</title>>
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid" id="nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><i class="fa fa-camera-retro"></i> PhotoSpace</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="profile.php">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                <?php 
                                echo '&nbsp'.$_SESSION['username']."'s";
                                ?>
                                Profile Page 
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li>
                            <a href="social.php">
                                <span class="glyphicon glyphicon-cloud" aria-hidden="true"></span>
                                &nbspSocial Page 
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                                &nbspLog Out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container profile">
        <div class="row">
            <ul class="nav nav-tabs">
                <li role="presentation" id="viewProfile" class="active"><a href="#">View Profile</a></li>
                <li role="presentation" id="editProfile"><a href="#">Edit Profile</a></li>
                <li role="presentation" id="WritePost"><a href="#">Post to Social Page</a></li>
            </ul>
        </div>
        <div class="row userPanel">
            <div class="col-md-6">
                <?php
                require_once 'function.php';
                require_once "core.php";
                $currentUser=$_SESSION['username'];
                $result = queryMysql("SELECT * FROM users WHERE USERNAME = '$currentUser' ");
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $icon=$row['FILENAME'];
                if ($icon)
                {
                    echo '<img id="image" src="'.'users/'.$icon.'" \>';
                }
                else
                {
                    echo '<img id="image" src="user.png" \>';
                }
                ?>
                <form method="post" action="profile.php" enctype="multipart/form-data" id="imageChange">
                    <div class="form-group">
                        <label for="password">Change Your Profile Image</label>
                        <br />
                        <label class="btn btn-default btn-lg">
                            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>&nbsp Browse
						    <input type="file" id="upload" name="upload" accept="image/*">
                        </label>
                        <div class="form-group">
                            <input type="submit" name="imageSubmit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <!---------------------------------------Display Profile--------------------------------------->
                <?php            
                $result = queryMysql("SELECT * FROM profile WHERE username = '$UserName' ");
                $row  = $result->fetch_array(MYSQLI_ASSOC);
                echo ($row['LASTNAME'] == NULL)? "<ul class=\"list-group\" id=\"info\"><h1>Hello!"
                : "<ul class=\"list-group\" id=\"info\"><h1>Hello! ".$row['LASTNAME'].', '.$row['FIRSTNAME']."</h1>";
                echo ($row['QUOTES'] == NULL)? "<h3 id=\"quote\">".'<i class="fa fa-flash"></i> ( Your quote here.. ) <i class="fa fa-flash "></i>'."</h3>"
                : "<h3 id=\"quote\">".'<i class="fa fa-flash"></i> '.$row['QUOTES'].' <i class="fa fa-flash"></i>'."</h3>";
                echo ($row['GENDER'] == NULL)? "<li><h3>Gender: ( Not available ) </h3></li>":
                "<li><h3>Gender: ".$row['GENDER']."</h3></li>";
                echo "</ul>";
                ?>
                <!------------------------------------------END------------------------------------------>
                <!---------------------------------------Edit Profile--------------------------------------->
                <form method="post" action="profile.php" enctype="multipart/form-data" id="profileChange">
                    <div class="form-group">
                        <label for="first">First name</label>
                        <input type="text" name="first" class="form-control" placeholder="Joe" />
                    </div>
                    <div class="form-group">
                        <label for="last">Last name</label>
                        <input type="text" name="last" class="form-control" placeholder="Blow" />
                    </div>
                    <div class="form-group text-center">
                        <label class="radio-inline">
                            <input type="radio" name="gender" value="famale" />Female</label>
                        <label class="radio-inline">
                            <input type="radio" name="gender" value="male" checked />Male</label>
                    </div>


                    <div class="form-group">
                        <label>Quote</label>
                        <textarea name="quote" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="infoSubmit" class="btn btn-primary" value="Submit Changes">
                    </div>
                </form>
                <!------------------------------------------END------------------------------------------>
                <!---------------------------------------Write Post--------------------------------------->
                <form method="post" action="profile.php" enctype="multipart/form-data" id="editPost">
                    <div class="form-group">
                        <div class="panel panel-info">
                            <div class="panel-heading">Upload an image if you wish...</div>
                            <div class="panel-body">
                                <label class="btn btn-default">
                                    <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>&nbsp Browse
						            <input type="file" id="uploadImgPost" name="upload" accept="image/*" />
                                </label>
                                <div class="thumbnail" id="showimage">
                                    <img id="imagePost" src="/" />
                                </div>
                                <br />
                                <h5>Choose a filter..</h5>
                                <select class="form-control" name="filter">
                                    <option id="xpro2" value="xpro2">Xpro2</option>
                                    <option id="walden" value="walden">Walden</option>
                                    <option id="valencia" value="valencia">Valencia</option>
                                    <option id="toaster" value="toaster">Toaster</option>
                                    <option id="sierra" value="sierra">Sierra</option>
                                    <option id="mayfair" value="mayfair">Mayfair</option>
                                    <option id="kelvin" value="kelvin">Kelvin</option>
                                    <option id="brannan" value="brannan">Brannan</option>
                                    <option id="grayscale" value="grayscale">Grayscale</option>
                                    <option id="revert" value="revert" selected>Original</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-info">
                        <div class="panel-heading" id="meaningful">Share your thoughts with friends..</div>
                        <div class="panel-body text">
                            <textarea id="status" name="post" class="form-control" required></textarea>
                            <!--<input type="submit" name="postSubmit" class="btn btn-primary" value="Submit">-->
                        </div>
                    </div>
                </form>
                <!------------------------------------------END------------------------------------------>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row userPanel">
            <?php
            $result = queryMysql("SELECT USERNAME, STATUS, IMAGE_NAME, TIME_STAMP, FILTER FROM userposts ORDER BY TIME_STAMP DESC");      
            $output = '';     
            if ($result)
            {
                while($row = $result->fetch_assoc())
                {
                    if ($row['USERNAME'] == $UserName ) 
                    {
                        $time = $row['TIME_STAMP'];
                        echo '<form method="post" action="profile.php" enctype="multipart/form-data" id="delPost">';
                        echo '<div class="form-group">';
                        echo "<div class=\"panel panel-info timeline\">";
                        echo "<div class=\"row text-center\">";   
                        echo "<button class=\"btn btn-danger btn-lg\"><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span><input id=\"deletePost\" value=\"Delete!\" type =\"submit\" name = \"erase\"></button>";
                        echo '<input type="hidden" name="time" value="'.$row['TIME_STAMP'].'"/>';
                        echo ($icon)? '<img id="image" src="'.'users/'.$icon.'" width = "60px" style="display:inline; border:none;"\>'
                        :'<img id="image" src="user.png" width = "60px" style="display:inline; border:none;"\>';
                        echo "<h2 style=\"display:inline;\"> ". $row['USERNAME']."</h2>";
                        echo "</div>";
                        echo "<div class=\"row text-center\">";
                        echo "<h3>".date("m/d/Y H:i:s", $row['TIME_STAMP'])."</h3>";
                        echo "<p>". $row['STATUS']." </p>";                 
                        echo ($row['IMAGE_NAME']) ?'<img id="imagePosting" class="'.$row['FILTER'].'" src="'.'users/'.$row['IMAGE_NAME'].'" \>':"";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</form>";
                    }
                }  
            }     
            ?>
        </div>
    </div>
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.1.2.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="JavaScript1.js"></script>
    <script src="JavaScript2.js"></script>
    <script src="Filters and effect.js"></script>
</body>
</html>
