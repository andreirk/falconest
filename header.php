<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 4/7/2016
 * Time: 2:55 PM
 */

session_start();

echo " <!DOCTYPE html><html lang=\"en\"><head>";

require_once 'functions.php';

$userstr = ' (Guest)';

if (isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr = "($user)";
}
else $loggedin = FALSE;

echo "<title>$appname$userstr</title> <link rel='stylesheet'".
    "href='styles.css' type='text/css'>"                    .
    "</head> <body><center><canvas id='logo' width='624' "  .
    "height='96'>$appname</canvas></center>"                .
    "<div class='appname'>$appname$userstr</div>"           .
    "<script src='javascript.js'></script>";

if($loggedin){
    echo "<div><ul>
        <li><a href='members.php?view=$user'>Home</a></li>
        <li><a href='members.php'>Members</a></li>
        <li><a href='3.php'></a>Friends</li>
        <li><a href='4.php'></a>Messages</li>
        <li><a href='5.php'></a>Edit Profile</li>
        <li><a href='5.php'></a>Log out</li>
        </ul> <br>";

}else{
    echo ("<br><ul class='menu'>
            <li><a href='index.php'>Home</a></li>
            <li><a href='signup.php'>Sign up</a></li>
            <li><a href='login.php'>Logi n</a></li>
            <span class='info'>&#8658; You must be logged in to view this page.</span></ul>
           <br>"

    );
}