<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 4/7/2016
 * Time: 5:14 PM
 */
require_once 'header.php';

echo "<br><span class='main'> Welcom to $appname,";

if ($loggedin) echo " $user, you are logged in.";
        else  echo " please sign up and/or log in to join in.";
?>

</span><br><br>
</body>
</html>
