<?php
/*
Template Name: login api
*/

session_start();

require_once 'testinput.php';

global $wpdb;
$table_name = "users";
$table_user_logs = "user_logs";
$table_admins = "admins";
$table_host = "hosts";
$table_name_profile = "user_profile";
$host_id = "";
$admin_id = "";

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
    }

    $sql = "SELECT * FROM $table_name WHERE u_email='$email' AND u_is_delete = '0'";
    $retrieve_data = $wpdb->get_results($sql);

    if (sizeof($retrieve_data) > 0) {
        $wp_hasher = new PasswordHash(8, TRUE);
        if($wp_hasher->CheckPassword($plain_password, $retrieve_data[0]->u_password)) {
            $u_id = $retrieve_data[0]->u_id;

            $user_job = 0;
            $sql = "SELECT * FROM $table_admins WHERE a_uid='$u_id' AND a_is_delete = '0'";
            $retrieve_data1 = $wpdb->get_results($sql);
            if (sizeof($retrieve_data1) > 0) {
                $user_job = 2;
                $admin_id = $retrieve_data1[0] -> a_id;
                $_SESSION["admin_id"] = $admin_id;
            }

            $sql = "SELECT * FROM $table_host WHERE h_uid='$u_id' AND h_is_delete = '0'";
            $retrieve_data1 = $wpdb->get_results($sql);
            if (sizeof($retrieve_data1) > 0) {
                $user_job = 1;
                $host_id = $retrieve_data1[0] -> h_id;
                $_SESSION["host_id"] = $host_id;
            }
            
            $date = date('Y-m-d H:me:s'); 
            $sql = "INSERT INTO $table_user_logs(ul_uid, ul_enter, update_at, create_at) VALUES('$u_id', '$date', '$date', '$date')";
            $wpdb->query($sql);

            $sql = "SELECT * FROM $table_name_profile WHERE uf_uid='$u_id' AND uf_is_delete = '0'";
            $retrieve_data1 = $wpdb->get_results($sql);
            if (sizeof($retrieve_data1) > 0) {
                $_SESSION['user_image'] = $retrieve_data1[0] -> uf_image;
                $res = array(
                    'error' => '',
                    'result' => $retrieve_data[0],
                    'profile' => $retrieve_data1[0],
                    'user_job' => $user_job,
                    'success' => 1
                );
            } else {
                $res = array(
                    'error' => '',
                    'result' => $retrieve_data[0],
                    'profile' => '',
                    'user_job' => $user_job,
                    'success' => 1
                );
            }

            $_SESSION["user_id"] = $u_id;
            $_SESSION["user_email"] = $retrieve_data[0]->u_email;
            $_SESSION["user_job"] = $user_job;
            
            echo json_encode($res);
        } else {
            $res = array(
                'error' => 'No, Wrong Password',
                'result' => '',
                'success' => 0
            );
            echo json_encode($res);
        }
    }
    else {
        $res = array(
            'error' => 'No users',
            'result' => '',
            'success' => 0
        );
        echo json_encode($res);
    }
}
          
?>