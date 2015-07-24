<?php
session_start();
require_once 'function.php';
require_once 'core.php';

$error='';
$success='';

if(isset($_POST['action']))
{   
    if($_POST['action']=="SIGNUP")
    {      
        $username=sanitizeString($_POST['username']);
        $password=sanitizeString($_POST['password']);
        
        if ($username=="" || $password=="")
            $error="Please enter both username and password.";
        else
        {
            
            $time = $_SERVER['REQUEST_TIME'];
            $file_name = $time . '.jpg';
            
            $result = queryMysql("SELECT * FROM users WHERE USERNAME='$username'");

            if ($result->num_rows)
                $error = "The username you have entered already exists.";
            else
            {
                if ($_FILES)
                {
                    $tmp_name = $_FILES['upload']['name']; //file on local host
                    if ($tmp_name == NULL) $file_name = NULL;
                    $dstFolder = 'users';
                    move_uploaded_file($_FILES['upload']['tmp_name'], $dstFolder . DIRECTORY_SEPARATOR . $file_name);
                }
                SavePostToDB($connection,$username,$password,$file_name);
                $success = 'Your account has been created successfully! Please sign in.';
            }
        }
    }
    else //($_POST['action']=="LOGIN")
    {
        $username=sanitizeString($_POST['username']);
        $password=sanitizeString($_POST['password']);
        
        if ($username=="" || $password=="")
            $error = "Please enter both username and password.";
        else
        {
            $result=queryMysql("SELECT USERNAME, PASSWORD FROM users WHERE USERNAME = '$username'
            AND PASSWORD = '$password'");

            if ($result->num_rows)
            {
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;                
                $success = "You have now logged in";
                header("location:profile.php");
            }
            else
            {
                $error = "Invalid username or password";
            }
        }
    }
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
    <link href='http://fonts.googleapis.com/css?family=Numans:400,900' rel='stylesheet' type='text/css'>
    <link rel="icon" type="image/png" href="Camera.png">
    <title>PhotoSpace</title>
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
                            <a href="index.php">
                                <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                                &nbspHome Page 
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container-fluid coverImg">
        <div class="jumbotron">
            <h1>Welcome to PhotoSpace!</h1>
            <h3>PhotoSpace is place to share your photos with family and friends! Don't have an account? Sigh up below! 
            </h3>
        </div>
    </div>
    <div class="container-fluid userActivity">
        <div class="row">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
             
                        <div class="col-xs-6 text-center">
                            <ul class="nav nav-tabs">
                            <li role="presentation" class="active" id="in">
                                <a>
                                    <i class="fa fa-key"></i>&nbspLogin
                                </a>
                            </li>
                            </ul>
                        </div>
                        <div class="col-xs-6 text-center">
                            <ul class="nav nav-tabs">
                            <li role="presentation"  class="active" id="up">
                                <a>
                                    <i class="fa fa-leaf"></i>&nbspSign Up 
                                </a>
                            </li>
                            </ul>
                        </div>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6  text-center">
                    <form method="post" action="index.php" enctype="multipart/form-data" id="usersign-in">
                        <?php
                        if($error!="")
                        {
                            echo "<div class=\"alert alert-danger\" role=\"alert\"> <h4> <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\">
                                    </span> $error</h4> </div>";
                        }
                        if ($success!='')
                        {
                            echo "<div class=\"alert alert-success\" role=\"alert\"> <h4> <span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\">
                                    </span> $success</h4> </div>"; 
                        }
                        ?>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username"
                                required="required">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password"
                                required="required">
                        </div>
                        <div class="form-group text-center">
                            <div>
                                <input name="action" type="hidden" value="LOGIN" />
                                <input type="submit" class="btn btn-primary btn-lg" value="Sign In">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-6  text-center">
                    <form method="post" action="index.php" enctype="multipart/form-data" id="usersign-up">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" 
                                pattern="^[a-zA-Z0-9_-]{4,16}$" title="Your username should only contain letters, numbers, underscores, or hyphens, and at least 4 or more characters"
                                required="required" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
                                class="form-control" onchange="form.Password2.pattern = this.value;"
                                title="Your password must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters"
                                required="required" />
                        </div>
                        <div class="form-group">
                            
                            <br />
                            <label class="btn btn-default">
                                <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>&nbsp Find Profile Image
                            <input type="file" id="upload" name="upload" accept="image/*" />
                            </label>
                            <div class="thumbnail" id="showimage">
                                <img id="image" src="/" />
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div>
                                <input name="action" type="hidden" value="SIGNUP" />
                                <input type="submit" class="btn btn-primary btn-lg" value="Sign Up">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container text-center">
            <span class="copyright">Copyright <span class="glyphicon glyphicon-copyright-mark"
                aria-hidden="true"></span>
                Jozef, Maryam, Esteban 2015</span>
        </div>
    </footer>
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.1.2.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="JavaScript1.js"></script>
</body>
</html>

<?php $connection->close(); ?>