<?php
/*

Template Name: profile get api

*/

require_once 'testinput.php';

global $wpdb;
$table_name = "users";
$table_hosts = "hosts";
$table_name_profile = "user_profile";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = "";
    $error = "";

    $type = "";
    if(empty($_POST["type"])) {
    }
    else {
        $type = $_POST["type"]; 
    }

    if($type == "gone") {
        if(empty($_POST["user_id"])) {
            $error = "User is required.";
        }
        else {
            $user_id = $_POST["user_id"]; 
        }

        $host_id = "";
        if(empty($_POST["host_id"])) {
            $error = "";
        } else {
            $host_id = $_POST["host_id"]; 
        }

        if($host_id == "") {
            $table_gone = "gone";
            $sql = "SELECT * FROM $table_gone WHERE g_is_delete = '0' AND g_uid = $user_id";
            $retrieve_data = $wpdb->get_results($sql);
            if (sizeof($retrieve_data) > 0) {
                $res = array(
                    'error' => $error,
                    'data' => $retrieve_data[0],
                    'success' => 1
                );
                echo json_encode($res);
            } else {
                $error = "No data";
                $res = array(
                    'error' => $error,
                    'data' => [],
                    'success' => 0
                );
                echo json_encode($res);
            }
        } else {
            $table_gone = "gone";
            $sql = "SELECT * FROM $table_gone LEFT JOIN $table_hosts ON $table_hosts.h_uid = $table_gone.g_uid WHERE $table_gone.g_is_delete = '0' AND $table_hosts.h_id = $host_id";
            $retrieve_data = $wpdb->get_results($sql);
            if (sizeof($retrieve_data) > 0) {
                $res = array(
                    'error' => $error,
                    'data' => $retrieve_data[0],
                    'success' => 1
                );
                echo json_encode($res);
            } else {
                $error = "No data";
                $res = array(
                    'error' => $error,
                    'data' => [],
                    'success' => 0
                );
                echo json_encode($res);
            }
        }


    } else {
        if(empty($_POST["user_id"])) {
            $error = "User is required.";
        }
        else {
            $user_id = $_POST["user_id"]; 
        }
        
        if($error == "") {
            $sql = "SELECT * FROM $table_hosts LEFT JOIN $table_name_profile ON $table_hosts.h_uid = $table_name_profile.uf_uid LEFT JOIN $table_name ON $table_name.u_id = $table_hosts.h_uid WHERE $table_hosts.h_uid='$user_id' AND $table_hosts.h_is_delete = '0'";
            $retrieve_data = $wpdb->get_results($sql);
            if (sizeof($retrieve_data) > 0) {
                $res = array(
                    'error' => $error,
                    'data' => $retrieve_data[0],
                    'success' => 1
                );
                echo json_encode($res);
            }
            else {
                $error = "No data";
                $res = array(
                    'error' => $error,
                    'data' => [],
                    'success' => 0
                );
                echo json_encode($res);
            }
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

}
          
?>