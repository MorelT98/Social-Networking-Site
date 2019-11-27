<!DOCTYPE html>
<html>
    <head>
        <script src="OSC.js"></script>
        <?php
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            include_once 'functions.php';
            $userstr = ' (Guest)';

            if(isset($_SESSION['username'])){
                $user = $_SESSION['username'];
                $loggedin = TRUE;
                $userstr = " ($user)";
            } else $loggedin = FALSE;
            $_SESSION['loggedin'] = $loggedin;
        ?>
        <title><?php echo $appname.$userstr; ?></title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <ul class='menu'>
            <?php
                if($loggedin) {
                    echo "<li><a href='members.php?view=$user'>Home</a></li>". 
                         "<li><a href='members.php'>Members</a></li>" .
                         "<li><a href='friends.php'>Friends</a></li>" .
                         "<li><a href='messages.php'>Messages</a></li>" .
                         "<li><a href='profile.php'>Edit Profile</a></li>" .
                         "<li><a href='logout.php'>Log out</a></li>" .
                         "</ul><br/>";
                } else {
                    echo 
                         "<li><a href='header.php'>Home</a></li>" . 
                         "<li><a href='Signup/signup.php'>Sign up</a></li>" .
                         "<li><a href='Login/login.php'>Log in</a></li>
                         </ul><br/>" . 
                         "<span class='info'>&#8658; You must be logged in to " . 
                         " view this page.</span><br/><br/>";
                }
            ?>