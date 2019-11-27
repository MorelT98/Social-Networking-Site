<?php
$dbhost = 'localhost';
$dbuser = 'morel';
$dbpass = 'ashley04';
$appname = 'Fakebook';

$conn = new mysqli($dbhost, $dbuser, $dbpass);
if($conn->connect_error) die($conn->connect_error);
$conn->select_db($appname);

function select_db($dbname){
    global $conn;
    if(!$conn->select_db($dbname)) die($conn->error);
}

/*
*   Creates a table, if it doesn't exist, given:
*    $name: The name of the table
*    $query: The description of the table
*/
function createTable($name, $query){
    global $conn;
    $conn->query("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br/>";
}

/*
*   This function excecutes the given SQL query and retrieves the
*   result from the database
*/
function query($query){
    global $conn;
    $result = $conn->query($query);
    if($conn->error) die($conn->error);
    return $result;
}

/*
*   Ends the current session
*/
function destroySession(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    $_SESSION = array();

    if(session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time() - 2592000, '/');

    session_destroy();
}

/*
* Sanitizes the given string by removing tags, and slashes from the string
*/
function sanitize_string($var){
    global $conn;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return mysqli_real_escape_string($conn, $var);
}

function showProfile($user){
    if(file_exists("$user.jpg"))
        echo "<img src='$user.jpg' align='left' />";
    $result = query("SELECT * FROM profiles WHERE user='$user'");

    if($result->num_rows > 0){
        $row = $result->fetch_row();
        echo stripslashes($row[1]) . "<br clear=left /><br/>";
    }
}