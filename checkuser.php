<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 4/8/2016
 * Time: 4:56 PM
 */
require_once 'functions.php';

if(isset($_POST['user'])){
    $user = sanitizeString($_POST['user']);
    $result = queryMysql("SLECT * FROM members WHERE user='$user");

    if($result->num_rows){
        echo "<span class='taken'>&#x2718; " ."This username is taken</span>";
    }
    else
    {
        echo "<span class='available'>&nbsp;&#x2714; ".
            "This username is available</span>";
    }
}
?>