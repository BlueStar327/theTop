<?php
/*
Template Name: review get api
*/

require_once 'testinput.php';

global $wpdb;
$table_name = "users";
$table_hosts = "hosts";
$table_messages = "reviews"; 
$table_name_profile = "user_profile";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $user_id = "";
    $error = "";

    if(empty($_POST["user_id"])) {
    }
    else {
        $user_id = $_POST["user_id"];
    }

    $host_id = "";
    if(empty($_POST["host_id"])) {
    }
    else {
        $host_id = $_POST["host_id"];
    }

    if($error == "") {
        if($user_id == "") {
            if($host_id == "") {
                $sql = "SELECT * FROM $table_messages LEFT JOIN $table_hosts ON $table_messages.r_uid = $table_hosts.h_id LEFT JOIN $table_name_profile ON $table_hosts.h_uid = $table_name_profile.uf_uid WHERE r_is_delete = '0' AND r_allow = '1' ORDER BY $table_messages.create_at DESC";
                $retrieve_data = $wpdb->get_results($sql);
                $_SESSION["total"] = sizeof($retrieve_data);
                $res = array(
                    'error' => $error,
                    'data' => $retrieve_data,
                    'total' => sizeof($retrieve_data),
                    'success' => 1
                );
            } else {
                $sql = "SELECT *, $table_messages.create_at AS creat FROM $table_messages LEFT JOIN $table_hosts ON $table_messages.r_uid = $table_hosts.h_id LEFT JOIN $table_name_profile ON $table_hosts.h_uid = $table_name_profile.uf_uid WHERE r_is_delete = '0' AND r_allow = '1' AND r_uid = $host_id ORDER BY $table_messages.create_at DESC";
                $retrieve_data = $wpdb->get_results($sql);
                $_SESSION["total"] = sizeof($retrieve_data);
                $res = array(
                    'error' => $error,
                    'data' => $retrieve_data,
                    'total' => sizeof($retrieve_data),
                    'success' => 3
                );
            }
        } else {
            if($host_id == "") {
                $sql = "SELECT * FROM $table_messages LEFT JOIN $table_hosts ON $table_messages.r_uid = $table_hosts.h_id LEFT JOIN $table_name_profile ON $table_hosts.h_uid = $table_name_profile.uf_uid WHERE r_is_delete = '0' ORDER BY $table_messages.create_at DESC";
                $retrieve_data = $wpdb->get_results($sql);
                $_SESSION["total"] = sizeof($retrieve_data);
                $res = array(
                    'error' => $error,
                    'data' => $retrieve_data,
                    'total' => sizeof($retrieve_data),
                    'success' => 2
                );
            } else {
                $sql = "SELECT *, $table_messages.create_at AS creat FROM $table_messages LEFT JOIN $table_hosts ON $table_messages.r_uid = $table_hosts.h_id LEFT JOIN $table_name_profile ON $table_hosts.h_uid = $table_name_profile.uf_uid WHERE r_is_delete = '0' AND r_uid = $host_id ORDER BY $table_messages.create_at DESC";
                $retrieve_data = $wpdb->get_results($sql);
                $_SESSION["total"] = sizeof($retrieve_data);
                $res = array(
                    'error' => $error,
                    'data' => $retrieve_data,
                    'total' => sizeof($retrieve_data),
                    'success' => 3
                );
            }
        }
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