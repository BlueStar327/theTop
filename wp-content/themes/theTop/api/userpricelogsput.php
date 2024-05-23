<?php
/*
Template Name:user price logs put api

*/

require_once 'testinput.php';

if(!isset($_SESSION["user_id"])) {
    header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
}

global $wpdb;
$table_name = "users";
$table_news= "user_price_logs";
$table_admins = "admins";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $title = $imageurl = $imgname = $content = $aid = $host_id = "";
    $error = "";
    
    if(empty($_POST["email"])) {
        $emailErr = "Email is required.";
    }
    else {
        $email = test_input($_POST["email"]); 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format";
        }
    }
    
    if(empty($_POST["user_id"])) {
    }
    else {
        $user_id = $_POST["user_id"];
    }

    if(empty($_POST["amount"])) {
        $error = $error ." amount is required.";
    }
    else {
        $amount = $_POST["amount"];
    }

    if(empty($_POST["state"])) {
        $error = $error ." state is required.";
    }
    else {
        $state = $_POST["state"];
    }

    if(empty($_POST["host_id"])) {
    }
    else {
        $host_id = $_POST["host_id"];
    }

    if($error == "") {
        $date = date('Y-m-d H:me:s'); 
        $sql = "INSERT INTO $table_news(up_uid, up_amount, up_state, up_hid, update_at, create_at) 
            VALUES('$user_id', '$amount', '$state', '$host_id', '$date', '$date')";
        $wpdb->query($sql);
        $res = array(
            'error' => $error,
            'success' => 1
        );
        echo json_encode($res);
    }
    else {
        $res = array(
            'error' => $error,
            'success' => 0
        );
        echo json_encode($res);
    }
}
          
?>