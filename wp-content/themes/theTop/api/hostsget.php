<?php
/*

Template Name: hosts get api

*/

session_start();

require_once 'testinput.php';

global $wpdb;
$table_name = "users";
$table_hosts = "hosts";
$table_name_profile = "user_profile"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = "";
    $error = "";
    $host_id = "";

    if(empty($_POST["user_id"])) {
    }
    else {
        $user_id = $_POST["user_id"];
    }

    if(empty($_POST["host_id"])) {
    }
    else {
        $host_id = $_POST["host_id"];
    }

    $new_hosts = "";
    if(empty($_POST["new_hosts"])) {
    }
    else {
        $new_hosts = $_POST["new_hosts"];
    }

    $host_id_d = "";
    if(empty($_POST["host_id_d"])) {
    }
    else {
        $host_id_d = $_POST["host_id_d"];
    }

    if($error == "") {
        if($host_id == "") {
            if($host_id_d != "") {
                $sql = "SELECT * FROM $table_hosts LEFT JOIN $table_name_profile ON $table_hosts.h_uid = $table_name_profile.uf_uid WHERE $table_hosts.h_uid = $host_id_d AND $table_hosts.h_is_delete = '0'";
                $retrieve_data = $wpdb->get_results($sql);
                if (sizeof($retrieve_data) > 0) {
                    $_SESSION["total"] = sizeof($retrieve_data);
                    $res = array(
                        'error' => $error,
                        'data' => $retrieve_data,
                        'total' => sizeof($retrieve_data),
                        'success' => 3
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
                if($new_hosts == "") {
                    $sql = "SELECT * FROM $table_hosts LEFT JOIN $table_name_profile ON $table_hosts.h_uid = $table_name_profile.uf_uid WHERE $table_hosts.h_is_delete = '0' ORDER BY h_ranking";
                    $retrieve_data = $wpdb->get_results($sql);
                } else {
                    $sql = "SELECT $table_name_profile.uf_image, $table_name_profile.uf_firstname, $table_name_profile.uf_lastname, $table_hosts.create_at FROM $table_hosts LEFT JOIN $table_name_profile ON $table_hosts.h_uid = $table_name_profile.uf_uid WHERE $table_hosts.h_is_delete = '0' ORDER BY $table_hosts.create_at DESC";
                    $retrieve_data = $wpdb->get_results($sql);
                }
                if (sizeof($retrieve_data) > 0) {
                    $_SESSION["total"] = sizeof($retrieve_data);
                    $res = array(
                        'error' => $error,
                        'data' => $retrieve_data,
                        'total' => sizeof($retrieve_data),
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
        } else {
            $sql = "SELECT * FROM $table_hosts LEFT JOIN $table_name_profile ON $table_hosts.h_uid = $table_name_profile.uf_uid WHERE $table_hosts.h_id = $host_id AND $table_hosts.h_is_delete = '0'";
            $retrieve_data = $wpdb->get_results($sql);
            if (sizeof($retrieve_data) > 0) {
                $_SESSION["total"] = sizeof($retrieve_data);
                $res = array(
                    'error' => $error,
                    'data' => $retrieve_data,
                    'total' => sizeof($retrieve_data),
                    'success' => 2
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