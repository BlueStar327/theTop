<?php
/*

Template Name: users price logs get api

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
    $email = $title = $imageurl = $imgname = $content = $aid = "";
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

    if($error == "") {
        $sql = "SELECT * FROM $table_news WHERE up_is_delete = '0'";
        $retrieve_data = $wpdb->get_results($sql);
        $res = array(
            'error' => $error,
            'data' => $retrieve_data,
            'success' => 1
        );
        echo json_encode($res);
    }
    else {
        $res = array(
            'error' => $error,
            'data' => [],
            'success' => 0
        );
        echo json_encode($res);
    }
}
?>