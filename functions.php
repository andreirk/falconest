<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 4/6/2016
 * Time: 5:33 PM
 */

$dbhost = 'localhost';
$dbuser = 'falconest';
$dbname = 'falconest';
$dbpass = '123';
$appname = "Falcon's Nest";

$connection = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
if($connection->connect_error) die($connection->connect_error);

function createTable($name,$query)
{
    queryMysql("Create table if not exists $name($query)");
    echo "Table '$name' created or already exists.<br>";
}

function queryMysql($query)
{
    global $connection;
    console_log("Query is ".$query);
    $result = $connection->query($query);
    if(!$result) die($connection->error);
    return $result;
}

function destroySession(){
    $_SESSION=array();
    if(session_id()!= "" || isset($_COOKIE[session_name()]))
    {
        setcookie(session_name(),'',time()-2592000,'/');
    }
    session_destroy();
}

function sanitizeString($var)
{
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripcslashes($var);
    return $connection->real_escape_string($var);
}

function showProfile($user)
{
    if(file_exists("$user.jpg")) {
        echo "<img src='$user.jpg' style='float:left;'>";
    }
    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

    if($result->num_rows) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo stripcslashes($row['text'])."<br style='clear:left;'><br>";
    }
}

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}


