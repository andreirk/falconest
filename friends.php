<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 4/12/2016
 * Time: 5:01 PM
 */
require_once 'header.php';

if(!$loggedin) die();

if(isset($_GET['view'])){
    $view = sanitizeString($_GET['view']);
}else {
    $view = $user;
}

if($view = $user){
    $name1 = $name2 = "Your";
    $name3 = "You are";
}else{
    $name1 = "<a href='members.php?view=$view'>$view</a>'s";
    $name2 = "$view's";
    $name3 = "$view is";
}

echo "<div class='main'>";

// Uncoment this

showProfile($view);

$followers = array();
$following = array();

$result = queryMysql("SELECT * FROM friends WHERE user='$view'");
$num = $result->num_rows;

for($j = 0; $j < $num; ++$j){
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $followers[$j] = $row['friend'];
}

$result = queryMysql("SELECT * FROM friends WHERE friend='$view'");
$num = $result->num_rows;

for ($j=0; $j< $num; ++$j){
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $following[$j] = $row['user'];
}

$mutal = array_intersect($followers,$following);
$followers = array_diff($followers,$mutal);
$following = array_diff($following,$mutal);

$friends = FALSE;

if(sizeof($mutal)){
    echo "<span class='subhead'>$name2 mutal friends</span><ul>";
    foreach ($mutal as $friend){
        echo "<li><a href='members.php?view=$friend'>$friend</a>";
    }
    echo "</ul>";
    $friends = TRUE;
}

if (sizeof($followers)){
    echo "<span class='subhead'> $name3 folloing </span><ul>";
    foreach ($following as $friend){
        echo "<li><a href='members.php?view=$friend'>$friend</a>";
    }
    echo "</ul>";
    $friends = TRUE;
}

if(!$friends){
    echo "<br> You don't have any friends yet. <br><br>";
}

echo "<a class='button' href='messages.php?view=$view'>".
    "View $name2 messages </a>";

?>

</div><br>
</body>
</html>
