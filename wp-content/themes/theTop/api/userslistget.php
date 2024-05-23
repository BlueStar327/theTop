<?php
/*

Template Name: users list get api

*/

require_once 'testinput.php';

if(!isset($_SESSION["user_id"])) {
    header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
}

global $wpdb;
$table_name = "users";
$table_hosts = "hosts";
$table_admins = "admins";
$table_name_profile = "user_profile";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $firstname = $lastname = $contactnumber = $age = $tall = $weight = $bodytype = $state = $imageurl = "";
    $error = "";

    if(empty($_POST["user_id"])) {
        $error = "User is required.";
    }
    else {
        $user_id = $_POST["user_id"]; 
    }
    
    if($error == "") {
        $sql = "SELECT * FROM $table_admins LEFT JOIN $table_name_profile ON $table_admins.a_uid = $table_name_profile.uf_uid WHERE a_is_delete = '0'";
        $retrieve_data1 = $wpdb->get_results($sql);
        $sql = "SELECT * FROM $table_hosts LEFT JOIN $table_name_profile ON $table_hosts.h_uid = $table_name_profile.uf_uid WHERE h_is_delete = '0'";
        $retrieve_data2 = $wpdb->get_results($sql);
        if (sizeof($retrieve_data1) > 0 || sizeof($retrieve_data2) > 0) {
            $res = array(
                'error' => $error,
                'data1' => sizeof($retrieve_data1) > 0 ? $retrieve_data1 : [],
                'data2' => sizeof($retrieve_data2) > 0 ? $retrieve_data2 : [],
                'success' => 1
            );
            echo json_encode($res);
        }
        else {
            $error = "No data";
            $res = array(
                'error' => $error,
                'data1' => [],
                'data2' => [],
                'success' => 0
            );
            echo json_encode($res);
        }
    }
    else {
        $error = "Error";
        $res = array(
            'error' => $error,
            'success' => 0
        );
        echo json_encode($res);
    }
}
          
?>