<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 4/8/2016
 * Time: 3:40 PM
 */
require_once 'header.php';

echo  <<<_END
<script>
function checkUser(user){
    if(user.value ==''){
        O('info').innerHTML = '';
        return;
    }

    params = "user=" + user.value;
    request = new ajaxRequest();
    request.open("POST", "checkuser.php",true);
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");


    request.onreadystatechange = function(){
        if(this.readyState == 4){
            if(this.status == 200){
                if(this.responseText != null){
                    O('info').innerHTML = this.responseText;
                }
            }
        }
        request.send(params);
    }
    function ajaxRequest(){

        try{ var request = new XMLHttpRequest()}
        catch (e1){
            try {request = new ActiveXObject("Msxml2.XMLHTTP")}
            catch (e2){
                try {request = new ActiveXObject("Microsoft.XMLHTTP")}
                catch (e3){
                    request = false;
                }
            }
        }
        return request;
    }

}

</script>
<div class='main'><h3>Please enter your details to sign up </h3>
_END;

$error = $user = $pass = "";
console_log('Error on line 56:'.$error);
if(isset($_SESSION['user'])) {
    destroySession();
    console_log('Error on line 59:'.$error);
    console_log('user:'.$_SESSION['user']);
}
console_log("Line 62");
if (isset($_POST['user'])){
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    console_log("User is".$user);
    console_log("Pass is ".$pass);
    if($user == "" || $pass == ""){
        $error = "Not all fields were entered <br>";
        console_log('Error on line 69:'.$error);
    }
    else{
        $result = queryMysql("SELECT * FROM members WHERE user='$user'");
     //   console_log('Result is ;'.$result);

        if($result->num_rows){
            $error = "That username already exists <br>";
            console_log('Error on line 77:'.$error);
        }
        else{
            queryMysql("INSERT INTO members VALUES('$user','$pass')");
            die("<h4>Account created</h4>Please Log in. <br>");
            console_log('Done!');
        }
    }
}
if (!isset($_POST['user']) ){
    console_log('User unset');
}

echo <<<_END
    <form  method="post">
    <span class="fieldname">Username</span>
    <input type="text" maxlength="16"  name="user" value='$user' onBlur="checkUser(this)">
    <span id="info"></span>
    <br>
    <span class="fieldname">Password</span>
    <input type="password" maxlength="16" name="pass" placeholder="pass"><br>
_END;
?>
<span class="fieldname">&nbsp</span><input type="submit" value="Sign up">
</form>
</div>
<br>
</body>
</html>





