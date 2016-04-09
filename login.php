<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 4/9/2016
 * Time: 8:59 PM
 */
require_once 'header.php';
echo "<div class='main'><h3>Plese enter your details to log in</h3>";

$error = $user = $pass = '';

if (isset($_POST['user'])){
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if($user == "" || $pass == ""){
        $error = "Not all fields were entered <br>";
    }
    else{
        $result = queryMysql("SELECT user,pass FROM members WHERE user='$user' AND pass='$pass'");
    }

    if($result->num_rows == 0){
        $error = "<span class='error>'Username/Password invalid</span><br><br>";
    }
    else{
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        die("You are now logged in. Please <a href='members.php?view=$user'>").
            "click here</a> to continue. <br> ";
    }
}

echo <<<_END

    <form action="login.php" method="post">$error
    <span class="fieldname">Username</span>
    <input type="text" maxlength="16"  name="user" value="$user" >
    
    <span class="fieldname">Password</span>
    <input type="text" maxlength="16" name="pass" value="$pass"><br>
_END;
?>
<span class="fieldname">&nbsp</span><input type="submit" value="Log in">

</form>
<br>
</div>
</body>
</html>

