<?php
/*
Template Name: api

*/

require_once 'testinput.php';

global $wpdb;
$table_name = "users";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $plain_password = $plain_password_confirm = "";
    $emailErr = $passErr ="";
    
    if(empty($_POST["email"])) {
        $emailErr = "Email is required.";
    }
    else {
        $email = test_input($_POST["email"]); 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    
    if(empty($_POST["password"])) {
        $passErr = "Password is required.";
    }
    else {
        $plain_password = $_POST["password"];
        if(empty($_POST["password_confirm"])) {
            $passErr = "Confirm Password is required.";
        }
        else {
            $plain_password_confirm = $_POST["password_confirm"];
            if($plain_password != $plain_password_confirm)
            {
                $passErr = "Confirm Password is wrong!";
            }
        }
    }

    if($emailErr == "" && $passErr == "") {
        $sql = "SELECT * FROM $table_name WHERE u_email='$email' AND uf_is_delete = '0'";
        $retrieve_data = $wpdb->get_results($sql);
        if (sizeof($retrieve_data) > 0) {
            $res = array(
                'error' => "Already registried user.",
                'success' => 0
            );
            echo json_encode($res);
        }
        else {
            $date = date('Y-m-d H:me:s'); 
            global  $wp_hasher ;
            $wp_hasher = new  PasswordHash ( 16 , FALSE );
            $hash = wp_hash_password($plain_password);
            $sql = "INSERT INTO $table_name(u_email, u_password, update_at, create_at) VALUES('$email', '$hash', '$date', '$date')";
            $wpdb->query($sql);
            $res = array(
                'error' => $emailErr . $passErr,
                'success' => 1
            );
            echo json_encode($res);
        }
    }
    else {
        $res = array(
            'error' => $emailErr . $passErr,
            'success' => 0
        );
        echo json_encode($res);
    }
}          
?>