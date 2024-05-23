<?php
/*
Template Name: diarys get api
*/

require_once 'testinput.php';

global $wpdb;
$table_name = "user_profile";
$table_diary = "diary";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $user_id = "";
    $error = "";
    
    if(empty($_POST["user_id"])) {
    }
    else {
        $user_id = $_POST["user_id"];
    }

    if($user_id == "") {
        if(empty($_POST["diary_id"])) {
            if($error == "") {
                $sql = "SELECT $table_diary.d_title, $table_diary.d_id, $table_diary.d_image, $table_name.uf_firstname, $table_name.uf_lastname, $table_diary.update_at FROM $table_diary LEFT JOIN $table_name ON $table_diary.d_uid = $table_name.uf_uid WHERE d_is_delete = '0' ORDER BY $table_diary.create_at DESC";
                $retrieve_data = $wpdb->get_results($sql);
                $_SESSION["total"] = sizeof($retrieve_data);
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
                    'success' => 0
                );
                echo json_encode($res);
            }
        } else {
            $diary_id = $_POST["diary_id"];
    
            if($error == "") {
                $sql = "SELECT * FROM $table_diary WHERE d_is_delete = '0' AND d_id='$diary_id'";
                $retrieve_data = $wpdb->get_results($sql);
                $res = array(
                    'error' => $error,
                    'data' => $retrieve_data[0],
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
    } else {
        if(empty($_POST["diary_id"])) {
            if($error == "") {
                $sql = "SELECT * FROM $table_diary WHERE d_is_delete = '0' AND d_uid='$user_id'";
                $retrieve_data = $wpdb->get_results($sql);
                $_SESSION["total"] = sizeof($retrieve_data);
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
                    'success' => 0
                );
                echo json_encode($res);
            }
        }
        else {
            $diary_id = $_POST["diary_id"];
    
            if($error == "") {
                $sql = "SELECT * FROM $table_diary WHERE d_is_delete = '0' AND d_id='$diary_id'";
                $retrieve_data = $wpdb->get_results($sql);
                $res = array(
                    'error' => $error,
                    'data' => $retrieve_data[0],
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
    }

}
          
?>